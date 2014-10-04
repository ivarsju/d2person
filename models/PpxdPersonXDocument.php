<?php

// auto-loading
Yii::setPathOfAlias('PpxdPersonXDocument', dirname(__FILE__));
Yii::import('PpxdPersonXDocument.*');

class PpxdPersonXDocument extends BasePpxdPersonXDocument
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
        if (empty($this->ppxd_pdcm_id)) return '';
        return (string) $this->ppxdPdcm->pdcm_name . ' ' . $this->ppxd_number;
    }

    public function getItemLabelExtended()
    {
        if (empty($this->ppxd_pdcm_id)) return '';
        return (string) $this->ppxdPprs->itemLabel . ' ' . $this->ppxdPdcm->pdcm_name . ' ' . $this->ppxd_number;
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

    public function filterByDocTypeAndPerson($type,$person)
    {
        if (is_array($type)) {
            $this->getDbCriteria()->mergeWith(array(
                    'condition'=>'ppxd_pdcm_id in (' . implode(',',$type).')',
            ));
        } else {
            $this->getDbCriteria()->mergeWith(array(
                    'condition'=>'ppxd_pdcm_id = ' . $type,
            ));
        }

        if (is_array($person)) {
            $this->getDbCriteria()->mergeWith(array(
                    'condition'=>'ppxd_pprs_id in (' . implode(',',$person).')',
            ));
        } else {
            $this->getDbCriteria()->mergeWith(array(
                    'condition'=>'ppxd_pprs_id = ' . $person,
            ));
        }

        return $this;
    }

}
