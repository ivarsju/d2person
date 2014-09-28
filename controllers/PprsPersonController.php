<?php

class PprsPersonController extends Controller
{
    #public $layout='//layouts/column2';

    public $defaultAction = "admin";
    public $scenario = "crud";
    public $scope = "crud";
    public $menu_route = "d2Person/PprsPerson";

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
            'roles' => array('D2person.PprsPerson.*'),
        ),
        array(
            'allow',
            'actions' => array('create','ajaxCreate'),
            'roles' => array('D2person.PprsPerson.Create'),
        ),
        array(
            'allow',
            'actions' => array('view', 'admin'), // let the user view the grid
            'roles' => array('D2person.PprsPerson.View'),
        ),
        array(
            'allow',
            'actions' => array('update', 'editableSaver'),
            'roles' => array('D2person.PprsPerson.Update'),
        ),
        array(
            'allow',
            'actions' => array('delete'),
            'roles' => array('D2person.PprsPerson.Delete'),
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

    public function actionView($pprs_id, $ajax = false)
    {
        $model = $this->loadModel($pprs_id);
        if ($ajax) {
            $this->renderPartial('_view-relations_grids',
                    array(
                        'modelMain' => $model,
                        'ajax' => $ajax,
                        )
                    );
        } else {
            $this->render('view', array('model' => $model,));
        }
    }

    public function actionCreate()
    {
        $model = new PprsPerson;
        $model->scenario = $this->scenario;

        $this->performAjaxValidation($model, 'pprs-person-form');
        $post_atributes = Yii::app()->request->getPost('PprsPerson');
        if (!empty($post_atributes)) {
            $model->attributes = $post_atributes;
            if(isset($post_atributes['pprs_ccmp_id'])){
                $model->pprs_ccmp_id = $post_atributes['pprs_ccmp_id'];
            }

            
            
            try {
                if ($model->save()) {
                    if (isset($_GET['returnUrl'])) {
                        $this->redirect($_GET['returnUrl']);
                    } else {
                        $this->redirect(array('view', 'pprs_id' => $model->pprs_id));
                    }
                }
            } catch (Exception $e) {
                $model->addError('pprs_id', $e->getMessage());
            }
        } elseif (isset($_GET['PprsPerson'])) {
            $model->attributes = $_GET['PprsPerson'];
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($pprs_id)
    {
        $model = $this->loadModel($pprs_id);
        $model->scenario = $this->scenario;

        $this->performAjaxValidation($model, 'pprs-person-form');

        if (isset($_POST['PprsPerson'])) {
            $model->attributes = $_POST['PprsPerson'];

            try {
                if ($model->save()) {
                    if (isset($_GET['returnUrl'])) {
                        $this->redirect($_GET['returnUrl']);
                    } else {
                        $this->redirect(array('view', 'pprs_id' => $model->pprs_id));
                    }
                }
            } catch (Exception $e) {
                $model->addError('pprs_id', $e->getMessage());
            }
        }

        $this->render('update', array('model' => $model));
    }

    public function actionEditableSaver()
    {
        $es = new EditableSaver('PprsPerson'); // classname of model to be updated
        $es->update();
    }

    public function actionAjaxCreate($field, $value)
    {
        $model = new PprsPerson;
        $model->$field = $value;
        try {
            if ($model->save()) {
                return TRUE;
            } else {
                return var_export($model->getErrors());
            }
        } catch (Exception $e) {
            throw new CHttpException(500, $e->getMessage());
        }
    }

    /**
     * crreate person for company
     * @param int $ccmp_id company id
     * @return type
     * @throws CHttpException
     */
    public function actionAjaxCreateSpec($ccmp_id)
    {
        $model = new PprsPerson;
        $model->$field = $value;
        try {
            if (!$model->save()) {
                return var_export($model->getErrors());
            }
        } catch (Exception $e) {
            throw new CHttpException(500, $e->getMessage());
        }
        
        $ccuc = new CcucUserCompany;
        $ccuc->ccuc_ccmp_id = $ccmp_id;
        $ccuc->ccuc_person_id = $model->pprs_id;
        $ccuc->ccuc_status = CcucUserCompany::CCUC_STATUS_PERSON;
        $ccuc->save();
        
    }

    public function actionDelete($pprs_id)
    {
        if (Yii::app()->request->isPostRequest) {
            try {
                $this->loadModel($pprs_id)->delete();
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
//        $model = new PprsPerson('search');
//        $scopes = $model->scopes();
//        if (isset($scopes[$this->scope])) {
//            $model->{$this->scope}();
//        }
//        $model->unsetAttributes();
//
//        if (isset($_GET['PprsPerson'])) {
//            $model->attributes = $_GET['PprsPerson'];
//        }
//
//        $this->render('admin', array('model' => $model));
        $model = new CcucUserCompany('search');
        $scopes = $model->scopes();
        if (isset($scopes[$this->scope])) {
            $model->{$this->scope}();
        }
        $model->unsetAttributes();

        if (isset($_GET['CcucUserCompany'])) {
            $model->attributes = $_GET['CcucUserCompany'];
        }
        $model->ccuc_status = CcucUserCompany::CCUC_STATUS_PERSON;
        $this->render('admin', array('model' => $model,));        
    }

    public function loadModel($id)
    {
        $m = PprsPerson::model();
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
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'pprs-person-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
