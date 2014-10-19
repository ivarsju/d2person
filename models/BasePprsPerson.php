<?php

/**
 * This is the model base class for the table "pprs_person".
 *
 * Columns in table "pprs_person" available as properties of the model:
 * @property integer $pprs_id
 * @property string $pprs_first_name
 * @property string $pprs_second_name
 * @property string $pprs_status 
 *
 * Relations of table "pprs_person" available as properties of the model:
 * @property CcucUserCompany[] $ccucUserCompanies
 * @property PpcnPersonContact[] $ppcnPersonContacts
 * @property PpxdPersonXDocument[] $ppxdPersonXDocuments
 * @property PpxsPersonXSetting[] $ppxsPersonXSettings
 * @property PpxtPersonXType[] $ppxtPersonXTypes
 */
abstract class BasePprsPerson extends CActiveRecord
{
    /**
    * ENUM field values
    */
    const PPRS_STATUS_ACTIVE = 'active';
    const PPRS_STATUS_INACTIVE = 'inactive';
    
    var $enum_labels = false;      

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'pprs_person';
    }

    public function rules()
    {
        return array_merge(
            parent::rules(), array(
                array('pprs_first_name, pprs_second_name, pprs_status', 'default', 'setOnEmpty' => true, 'value' => null),
                array('pprs_first_name, pprs_second_name', 'length', 'max' => 100),
                array('pprs_status', 'length', 'max' => 8),
                array('pprs_id, pprs_first_name, pprs_second_name, pprs_status', 'safe', 'on' => 'search'),
            )
        );
    } 

    public function getItemLabel()
    {
        return (string) $this->pprs_first_name;
    }

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(), array(
                'savedRelated' => array(
                    'class' => '\GtcSaveRelationsBehavior'
                )
            )
        );
    }

    public function relations()
    {
        return array_merge(
            parent::relations(), array(
                'ccucUserCompanies' => array(self::HAS_MANY, 'CcucUserCompany', 'ccuc_person_id'),
                'ppcnPersonContacts' => array(self::HAS_MANY, 'PpcnPersonContact', 'ppcn_pprs_id'),
                'ppxdPersonXDocuments' => array(self::HAS_MANY, 'PpxdPersonXDocument', 'ppxd_pprs_id'),
                'ppxsPersonXSettings' => array(self::HAS_MANY, 'PpxsPersonXSetting', 'ppxs_pprs_id'),
                'ppxtPersonXTypes' => array(self::HAS_MANY, 'PpxtPersonXType', 'ppxt_pprs_id'),
            )
        );
    }

    public function attributeLabels()
    {
        return array(
            'pprs_id' => Yii::t('D2personModule.model', 'Pprs'),
            'pprs_first_name' => Yii::t('D2personModule.model', 'Pprs First Name'),
            'pprs_second_name' => Yii::t('D2personModule.model', 'Pprs Second Name'),
            'pprs_status' => Yii::t('D2personModule.model', 'Pprs Status'),            
        );
    }

    public function enumLabels()
    {
        if($this->enum_labels){
            return $this->enum_labels;
        }    
        $this->enum_labels =  array(
           'pprs_status' => array(
               self::PPRS_STATUS_ACTIVE => Yii::t('D2personModule.model', 'PPRS_STATUS_ACTIVE'),
               self::PPRS_STATUS_INACTIVE => Yii::t('D2personModule.model', 'PPRS_STATUS_INACTIVE'),
           ),
            );
        return $this->enum_labels;
    }

    public function getEnumFieldLabels($column){

        $aLabels = $this->enumLabels();
        return $aLabels[$column];
    }

    public function getEnumLabel($column,$value){

        $aLabels = $this->enumLabels();

        if(!isset($aLabels[$column])){
            return $value;
        }

        if(!isset($aLabels[$column][$value])){
            return $value;
        }

        return $aLabels[$column][$value];
    }

    public function getEnumColumnLabel($column){
        return $this->getEnumLabel($column,$this->$column);
    } 
    
    public function searchCriteria($criteria = null)
    {
        if (is_null($criteria)) {
            $criteria = new CDbCriteria;
        }

        $criteria->compare('t.pprs_id', $this->pprs_id);
        $criteria->compare('t.pprs_first_name', $this->pprs_first_name, true);
        $criteria->compare('t.pprs_second_name', $this->pprs_second_name, true);
        $criteria->compare('t.pprs_status', $this->pprs_status);

        return $criteria;

    }

}
