<?php

// auto-loading
Yii::setPathOfAlias('PprsPerson', dirname(__FILE__));
Yii::import('PprsPerson.*');

class PprsPerson extends BasePprsPerson
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
        return (string) $this->pprs_second_name . ' ' . $this->pprs_first_name;
    }

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            array()
        );
    }

    public function relations()
    {
        return array_merge(
            parent::relations(), array(
                'profile' => array(self::BELONGS_TO, 'Profile', 'pprs_id'),
            )
        );
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

    public function scopes()
    {

    }

    public function filterGroup($group)
    {
        $this->getDbCriteria()->mergeWith(array(
                'join'=>' inner join ppxt_person_x_type on ppxt_pprs_id = t.pprs_id',
                'condition'=>'ppxt_ptyp_id = ' . $group,
        ));

        return $this;
    }

    public function search($criteria = null)
    {
        if (is_null($criteria)) {
            $criteria = new CDbCriteria;
        }

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $this->searchCriteria($criteria),
            'sort'=>array(
                'defaultOrder'=>'pprs_second_name,pprs_first_name',
            )

        ));
    }

   protected function beforeFind()
   {
        $criteria = new CDbCriteria;
        $criteria->join .= ' inner join ccuc_user_company  on ccuc_person_id = t.pprs_id ';
        $criteria->compare('ccuc_ccmp_id', Yii::app()->sysCompany->getActiveCompany());

        $this->dbCriteria->mergeWith($criteria);
        parent::beforeFind();
    }
}
