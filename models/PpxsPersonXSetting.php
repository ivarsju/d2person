<?php

// auto-loading
Yii::setPathOfAlias('PpxsPersonXSetting', dirname(__FILE__));
Yii::import('PpxsPersonXSetting.*');

class PpxsPersonXSetting extends BasePpxsPersonXSetting
{

    // Add your model-specific methods here. This file will not be overriden by gtc except you force it.
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function init()
    {
        return parent::init();
    }

    public function getItemLabel()
    {
        return parent::getItemLabel();
    }

    public function behaviors() {
        
        $behaviors = parent::behaviors();
        
        //auditrail  
        if(isset(Yii::app()->getModule('d2person')->options['audittrail']) 
            && Yii::app()->getModule('d2person')->options['audittrail'])
        { 
            $behaviors = array_merge(
                $behaviors, array(
            'LoggableBehavior' => array(
                'class' => 'LoggableBehavior'
            ),
        ));            
        }
        
        return $behaviors;
    }

    public function rules()
    {
        return array_merge(
            parent::rules()
        /* , array(
          array('column1, column2', 'rule1'),
          array('column3', 'rule2'),
          ) */
        );
    }

    public function search($criteria = null)
    {
        if (is_null($criteria)) {
            $criteria = new CDbCriteria;
        }

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $this->searchCriteria($criteria),
        ));
    }

    public function filterBySetingAndPerson($type,$person)
    {
        if (is_array($type)) {
            $this->getDbCriteria()->mergeWith(array(
                    'condition'=>'ppxs_psty_id in (' . implode(',',$type).')',
            ));
        } else {
            $this->getDbCriteria()->mergeWith(array(
                    'condition'=>'ppxs_psty_id = ' . $type,
            ));
        }

        if (is_array($person)) {
            $this->getDbCriteria()->mergeWith(array(
                    'condition'=>'ppxs_pprs_id in (' . implode(',',$person).')',
            ));
        } else {
            $this->getDbCriteria()->mergeWith(array(
                    'condition'=>'ppxs_pprs_id = ' . $person,
            ));
        }

        return $this;
    }
    
    /**
     * atgrie pirmo aktivas personas prasito settingu
     * @param int $type settinga tips
     * @return boolean
     */
    public static function getActivePersonSetingValue($type){
        $personId = Yii::app()->getModule('user')->user()->profile->person_id;
        $criteria = [
            'ppxs_pprs_id' => $personId,
            'ppxs_psty_id' => $type
            ];
        $model = PpxsPersonXSetting::model()->findByAttributes($criteria);
        if(!$model){
            return false;
        }
        
        return $model->ppxs_value;
    }
    

}
