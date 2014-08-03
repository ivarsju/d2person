<?php


class PdcmDocumentTypeController extends Controller
{
    #public $layout='//layouts/column2';

    public $defaultAction = "admin";
    public $scenario = "crud";
    public $scope = "crud";
    public $menu_route = "d2Person/PdcmDocumentType";       


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
            'roles' => array('D2person.PdcmDocumentType.*'),
        ),
        array(
            'allow',
            'actions' => array('create','ajaxCreate'),
            'roles' => array('D2person.PdcmDocumentType.Create'),
        ),
        array(
            'allow',
            'actions' => array('view', 'admin'), // let the user view the grid
            'roles' => array('D2person.PdcmDocumentType.View'),
        ),
        array(
            'allow',
            'actions' => array('update', 'editableSaver'),
            'roles' => array('D2person.PdcmDocumentType.Update'),
        ),
        array(
            'allow',
            'actions' => array('delete'),
            'roles' => array('D2person.PdcmDocumentType.Delete'),
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

    public function actionView($pdcm_id, $ajax = false)
    {
        $model = $this->loadModel($pdcm_id);
        if($ajax){
            $this->renderPartial('_view-relations_grids', 
                    array(
                        'modelMain' => $model,
                        'ajax' => $ajax,
                        )
                    );
        }else{
            $this->render('view', array('model' => $model,));
        }
    }

    public function actionCreate()
    {
        $model = new PdcmDocumentType;
        $model->scenario = $this->scenario;

        $this->performAjaxValidation($model, 'pdcm-document-type-form');

        if (isset($_POST['PdcmDocumentType'])) {
            $model->attributes = $_POST['PdcmDocumentType'];

            try {
                if ($model->save()) {
                    if (isset($_GET['returnUrl'])) {
                        $this->redirect($_GET['returnUrl']);
                    } else {
                        $this->redirect(array('admin'));
                    }
                }
            } catch (Exception $e) {
                $model->addError('pdcm_id', $e->getMessage());
            }
        } elseif (isset($_GET['PdcmDocumentType'])) {
            $model->attributes = $_GET['PdcmDocumentType'];
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($pdcm_id)
    {
        $model = $this->loadModel($pdcm_id);
        $model->scenario = $this->scenario;

        $this->performAjaxValidation($model, 'pdcm-document-type-form');

        if (isset($_POST['PdcmDocumentType'])) {
            $model->attributes = $_POST['PdcmDocumentType'];


            try {
                if ($model->save()) {
                    if (isset($_GET['returnUrl'])) {
                        $this->redirect($_GET['returnUrl']);
                    } else {
                        $this->redirect(array('view', 'pdcm_id' => $model->pdcm_id));
                    }
                }
            } catch (Exception $e) {
                $model->addError('pdcm_id', $e->getMessage());
            }
        }

        $this->render('update', array('model' => $model));
    }

    public function actionEditableSaver()
    {
        $es = new EditableSaver('PdcmDocumentType'); // classname of model to be updated
        $es->update();
    }

    public function actionAjaxCreate($field, $value) 
    {
        $model = new PdcmDocumentType;
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
    
    public function actionDelete($pdcm_id)
    {
        if (Yii::app()->request->isPostRequest) {
            try {
                $this->loadModel($pdcm_id)->delete();
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
        $model = new PdcmDocumentType('search');
        $scopes = $model->scopes();
        if (isset($scopes[$this->scope])) {
            $model->{$this->scope}();
        }
        $model->unsetAttributes();

        if (isset($_GET['PdcmDocumentType'])) {
            $model->attributes = $_GET['PdcmDocumentType'];
        }

        $this->render('admin', array('model' => $model));
    }

    public function loadModel($id)
    {
        $m = PdcmDocumentType::model();
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
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'pdcm-document-type-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
