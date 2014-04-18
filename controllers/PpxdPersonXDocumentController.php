<?php


class PpxdPersonXDocumentController extends Controller
{
    #public $layout='//layouts/column2';

    public $defaultAction = "admin";
    public $scenario = "crud";
    public $scope = "crud";


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
            'actions' => array('create', 'admin', 'view', 'update', 'editableSaver', 'delete','ajaxCreate'),
            'roles' => array('D2person.PpxdPersonXDocument.*'),
        ),
        array(
            'allow',
            'actions' => array('create','ajaxCreate'),
            'roles' => array('D2person.PpxdPersonXDocument.Create'),
        ),
        array(
            'allow',
            'actions' => array('view', 'admin'), // let the user view the grid
            'roles' => array('D2person.PpxdPersonXDocument.View'),
        ),
        array(
            'allow',
            'actions' => array('update', 'editableSaver'),
            'roles' => array('D2person.PpxdPersonXDocument.Update'),
        ),
        array(
            'allow',
            'actions' => array('delete'),
            'roles' => array('D2person.PpxdPersonXDocument.Delete'),
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

    public function actionView($ppxd_id)
    {
        $model = $this->loadModel($ppxd_id);
        $this->render('view', array('model' => $model,));
    }

    public function actionCreate()
    {
        $model = new PpxdPersonXDocument;
        $model->scenario = $this->scenario;

        $this->performAjaxValidation($model, 'ppxd-person-xdocument-form');

        if (isset($_POST['PpxdPersonXDocument'])) {
            $model->attributes = $_POST['PpxdPersonXDocument'];

            try {
                if ($model->save()) {
                    if (isset($_GET['returnUrl'])) {
                        $this->redirect($_GET['returnUrl']);
                    } else {
                        $this->redirect(array('view', 'ppxd_id' => $model->ppxd_id));
                    }
                }
            } catch (Exception $e) {
                $model->addError('ppxd_id', $e->getMessage());
            }
        } elseif (isset($_GET['PpxdPersonXDocument'])) {
            $model->attributes = $_GET['PpxdPersonXDocument'];
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($ppxd_id)
    {
        $model = $this->loadModel($ppxd_id);
        $model->scenario = $this->scenario;

        $this->performAjaxValidation($model, 'ppxd-person-xdocument-form');

        if (isset($_POST['PpxdPersonXDocument'])) {
            $model->attributes = $_POST['PpxdPersonXDocument'];


            try {
                if ($model->save()) {
                    if (isset($_GET['returnUrl'])) {
                        $this->redirect($_GET['returnUrl']);
                    } else {
                        $this->redirect(array('view', 'ppxd_id' => $model->ppxd_id));
                    }
                }
            } catch (Exception $e) {
                $model->addError('ppxd_id', $e->getMessage());
            }
        }

        $this->render('update', array('model' => $model,));
    }

    public function actionEditableSaver()
    {
        Yii::import('TbEditableSaver');
        $es = new TbEditableSaver('PpxdPersonXDocument'); // classname of model to be updated
        $es->update();
    }

    public function actionAjaxCreate($field, $value, $no_ajax = 0) 
    {
        $model = new PpxdPersonXDocument;
        $model->$field = $value;
        try {
            if ($model->save()) {
                if($no_ajax){
                    $this->redirect(Yii::app()->request->urlReferrer);
                }            
                return TRUE;
            }
        } catch (Exception $e) {
            throw new CHttpException(500, $e->getMessage());
        }
    }
    
    public function actionDelete($ppxd_id)
    {
        if (Yii::app()->request->isPostRequest) {
            try {
                $this->loadModel($ppxd_id)->delete();
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
        $model = new PpxdPersonXDocument('search');
        $scopes = $model->scopes();
        if (isset($scopes[$this->scope])) {
            $model->{$this->scope}();
        }
        $model->unsetAttributes();

        if (isset($_GET['PpxdPersonXDocument'])) {
            $model->attributes = $_GET['PpxdPersonXDocument'];
        }

        $this->render('admin', array('model' => $model,));
    }

    public function loadModel($id)
    {
        $m = PpxdPersonXDocument::model();
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
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'ppxd-person-xdocument-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
