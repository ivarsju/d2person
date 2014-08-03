<?php


class PcntContactTypeController extends Controller
{
    #public $layout='//layouts/column2';

    public $defaultAction = "admin";
    public $scenario = "crud";
    public $scope = "crud";
    public $menu_route = "d2Person/PcntContactType";       

public function filters()
{
    return array(
        'accessControl',
    );
}

public function accessRules()
{
     return array(
        array(
            'allow',
            'actions' => array('create', 'admin', 'editableSaver', 'delete','ajaxCreate'),
            'roles' => array('D2person.PcntContactType.*'),
        ),
        array(
            'allow',
            'actions' => array('create','ajaxCreate'),
            'roles' => array('D2person.PcntContactType.Create'),
        ),
        array(
            'allow',
            'actions' => array( 'admin'), // let the user view the grid
            'roles' => array('D2person.PcntContactType.View'),
        ),
        array(
            'allow',
            'actions' => array('editableSaver'),
            'roles' => array('D2person.PcntContactType.Update'),
        ),
        array(
            'allow',
            'actions' => array('delete'),
            'roles' => array('D2person.PcntContactType.Delete'),
        ),
        array(
            'deny',
            'users' => array('*'),
        ),
    );
}

    public function beforeAction($action)
    {
        parent::beforeAction($action);
        if ($this->module !== null) {
            $this->breadcrumbs[$this->module->Id] = array('/' . $this->module->Id);
        }
        return true;
    }

    public function actionCreate()
    {
        $model = new PcntContactType;
        $model->scenario = $this->scenario;

        $this->performAjaxValidation($model, 'pcnt-contact-type-form');

        if (isset($_POST['PcntContactType'])) {
            $model->attributes = $_POST['PcntContactType'];

            try {
                if ($model->save()) {
                    if (isset($_GET['returnUrl'])) {
                        $this->redirect($_GET['returnUrl']);
                    } else {
                        $this->redirect(array('admin'));
                    }
                }
            } catch (Exception $e) {
                $model->addError('pcnt_id', $e->getMessage());
            }
        } elseif (isset($_GET['PcntContactType'])) {
            $model->attributes = $_GET['PcntContactType'];
        }

        $this->render('create', array('model' => $model));
    }

    public function actionEditableSaver()
    {
        $es = new EditableSaver('PcntContactType'); // classname of model to be updated
        $es->update();
    }

    public function actionAjaxCreate($field, $value) 
    {
        $model = new PcntContactType;
        $model->$field = $value;
        try {
            if ($model->save()) {
                return TRUE;
            }else{
                return var_export($model->getErrors());
            }            
        } catch (Exception $e) {
            throw new CHttpException(500, $e->getMessage());
        }
    }
    
    public function actionDelete($pcnt_id)
    {
        if (Yii::app()->request->isPostRequest) {
            try {
                $this->loadModel($pcnt_id)->delete();
            } catch (Exception $e) {
                throw new CHttpException(500, $e->getMessage());
            }

            if (!isset($_GET['ajax'])) {
                if (isset($_GET['returnUrl'])) {
                    $this->redirect($_GET['returnUrl']);
                } else {
                    $this->redirect(array('admin'));
                }
            }
        } else {
            throw new CHttpException(400, Yii::t('D2personModule.crud_static', 'Invalid request. Please do not repeat this request again.'));
        }
    }

    public function actionAdmin()
    {
        $model = new PcntContactType('search');
        $scopes = $model->scopes();
        if (isset($scopes[$this->scope])) {
            $model->{$this->scope}();
        }
        $model->unsetAttributes();

        if (isset($_GET['PcntContactType'])) {
            $model->attributes = $_GET['PcntContactType'];
        }

        $this->render('admin', array('model' => $model));
    }

    public function loadModel($id)
    {
        $m = PcntContactType::model();
        // apply scope, if available
        $scopes = $m->scopes();
        if (isset($scopes[$this->scope])) {
            $m->{$this->scope}();
        }
        $model = $m->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, Yii::t('D2personModule.crud_static', 'The requested page does not exist.'));
        }
        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'pcnt-contact-type-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
