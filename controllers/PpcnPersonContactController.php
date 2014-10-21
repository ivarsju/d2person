<?php

class PpcnPersonContactController extends Controller
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
                'roles' => array('D2person.PpcnPersonContact.*'),
            ),
            array(
                'allow',
                'actions' => array('create','ajaxCreate'),
                'roles' => array('D2person.PpcnPersonContact.Create'),
            ),
            array(
                'allow',
                'actions' => array('view', 'admin'), // let the user view the grid
                'roles' => array('D2person.PpcnPersonContact.View'),
            ),
            array(
                'allow',
                'actions' => array('update', 'editableSaver'),
                'roles' => array('D2person.PpcnPersonContact.Update'),
            ),
            array(
                'allow',
                'actions' => array('delete'),
                'roles' => array('D2person.PpcnPersonContact.Delete'),
            ),
            //user can edit self contacts 
            array(
                'allow',
                'actions' => array('editableSaver','ajaxCreate','delete'),
                'expression' => 'PpcnPersonContactController::isItSelfContact()',
            ),

            array(
                'deny',
                'users' => array('*'),
            ),
        );
    }

    /**
     * validate, if its actual user contacts sor actions:
     *  - editableSaver
     *  - ajaxCreate
     *  - delete
     * @return boolean
     */
    public static function isItSelfContact(){

        $ppcn_id = false;
        $action = Yii::app()->controller->action->id;
        switch (Yii::app()->controller->action->id) {
            
            //update
            case 'editableSaver':
                $ppcn_id = yii::app()->request->getParam('pk');
            //delete
            case 'delete':                
                if(!$ppcn_id){
                    $ppcn_id = yii::app()->request->getParam('ppcn_id');
                }
                if(!$ppcn_id){
                    return false;
                }
                
                $ppcn = PpcnPersonContact::model()->findByPk($ppcn_id);
                if(!$ppcn || $ppcn->ppcnPprs->pprs_id != Yii::app()->getModule('user')->user()->profile->person_id){
                    return false;            
                }
                
                break;

            //create
            case 'ajaxCreate':
                if(yii::app()->request->getParam('value') != Yii::app()->getModule('user')->user()->profile->person_id){
                    return false;            
                }

                break;

            default:
                return false;
                break;
        }

        return true;
        
    }
    
    public function beforeAction($action)
    {
        parent::beforeAction($action);
        if ($this->module !== null) {
            $this->breadcrumbs[$this->module->Id] = array('/' . $this->module->Id);
        }

        return true;
    }

    public function actionView($ppcn_id)
    {
        $model = $this->loadModel($ppcn_id);
        $this->render('view', array('model' => $model,));
    }

    public function actionCreate()
    {
        $model = new PpcnPersonContact;
        $model->scenario = $this->scenario;

        $this->performAjaxValidation($model, 'ppcn-person-contact-form');

        if (isset($_POST['PpcnPersonContact'])) {
            $model->attributes = $_POST['PpcnPersonContact'];

            try {
                if ($model->save()) {
                    if (isset($_GET['returnUrl'])) {
                        $this->redirect($_GET['returnUrl']);
                    } else {
                        $this->redirect(array('view', 'ppcn_id' => $model->ppcn_id));
                    }
                }
            } catch (Exception $e) {
                $model->addError('ppcn_id', $e->getMessage());
            }
        } elseif (isset($_GET['PpcnPersonContact'])) {
            $model->attributes = $_GET['PpcnPersonContact'];
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($ppcn_id)
    {
        $model = $this->loadModel($ppcn_id);
        $model->scenario = $this->scenario;

        $this->performAjaxValidation($model, 'ppcn-person-contact-form');

        if (isset($_POST['PpcnPersonContact'])) {
            $model->attributes = $_POST['PpcnPersonContact'];

            try {
                if ($model->save()) {
                    if (isset($_GET['returnUrl'])) {
                        $this->redirect($_GET['returnUrl']);
                    } else {
                        $this->redirect(array('view', 'ppcn_id' => $model->ppcn_id));
                    }
                }
            } catch (Exception $e) {
                $model->addError('ppcn_id', $e->getMessage());
            }
        }

        $this->render('update', array('model' => $model,));
    }

    public function actionEditableSaver($pprs_id = false)
    {
        $es = new EditableSaver('PpcnPersonContact'); // classname of model to be updated
        $es->update();
    }

    public function actionAjaxCreate($field, $value, $no_ajax = 0)
    {
        $model = new PpcnPersonContact;
        $model->$field = $value;
        try {
            if ($model->save()) {
                if ($no_ajax) {
                    $this->redirect(Yii::app()->request->urlReferrer);
                }

                return TRUE;
            }
        } catch (Exception $e) {
            throw new CHttpException(500, $e->getMessage());
        }
    }

    public function actionDelete($ppcn_id)
    {
        if (Yii::app()->request->isPostRequest) {
            try {
                $this->loadModel($ppcn_id)->delete();
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
        $model = new PpcnPersonContact('search');
        $scopes = $model->scopes();
        if (isset($scopes[$this->scope])) {
            $model->{$this->scope}();
        }
        $model->unsetAttributes();

        if (isset($_GET['PpcnPersonContact'])) {
            $model->attributes = $_GET['PpcnPersonContact'];
        }

        $this->render('admin', array('model' => $model,));
    }

    public function loadModel($id)
    {
        $m = PpcnPersonContact::model();
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
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'ppcn-person-contact-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
