<?php

/**
 * This is the model base class for the table "psty_setting_type".
 *
 * Columns in table "psty_setting_type" available as properties of the model:
 * @property integer $psty_id
 * @property string $psty_name
 * @property string $psty_field_type
 * @property integer $psty_hidded
 *
 * Relations of table "psty_setting_type" available as properties of the model:
 * @property PpxsPersonXSetting[] $ppxsPersonXSettings
 */
abstract class BasePstySettingType extends CActiveRecord
{
    /**
    * ENUM field values
    */
    const PSTY_FIELD_TYPE_INT = 'int';
    const PSTY_FIELD_TYPE_CHAR = 'char';
    const PSTY_FIELD_TYPE_DATE = 'date';
    const PSTY_FIELD_TYPE_EMAIL = 'email';
    const PSTY_FIELD_TYPE_MONEY = 'money';

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'psty_setting_type';
    }

    public function rules()
    {
        return array_merge(
            parent::rules(), array(
                array('psty_name, psty_field_type', 'required'),
                array('psty_hidded', 'default', 'setOnEmpty' => true, 'value' => null),
                array('psty_hidded', 'numerical', 'integerOnly' => true),
                array('psty_name', 'length', 'max' => 256),
                array('psty_field_type', 'length', 'max' => 5),
                array('psty_id, psty_name, psty_field_type, psty_hidded', 'safe', 'on' => 'search'),
            )
        );
    }

    public function getItemLabel()
    {
        return (string) $this->psty_name;
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
                'ppxsPersonXSettings' => array(self::HAS_MANY, 'PpxsPersonXSetting', 'ppxs_psty_id'),
            )
        );
    }

    public function attributeLabels()
    {
        return array(
            'psty_id' => Yii::t('D2personModule.model', 'Psty'),
            'psty_name' => Yii::t('D2personModule.model', 'Psty Name'),
            'psty_field_type' => Yii::t('D2personModule.model', 'Psty Field Type'),
            'psty_hidded' => Yii::t('D2personModule.model', 'Psty Hidded'),
        );
    }

    public function enumLabels()
    {
        return array(
           'psty_field_type' => array(
               self::PSTY_FIELD_TYPE_INT => Yii::t('D2personModule.model', 'PSTY_FIELD_TYPE_INT'),
               self::PSTY_FIELD_TYPE_CHAR => Yii::t('D2personModule.model', 'PSTY_FIELD_TYPE_CHAR'),
               self::PSTY_FIELD_TYPE_DATE => Yii::t('D2personModule.model', 'PSTY_FIELD_TYPE_DATE'),
               self::PSTY_FIELD_TYPE_EMAIL => Yii::t('D2personModule.model', 'PSTY_FIELD_TYPE_EMAIL'),
               self::PSTY_FIELD_TYPE_MONEY => Yii::t('D2personModule.model', 'PSTY_FIELD_TYPE_MONEY'),
           ),
            );
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


    public function searchCriteria($criteria = null)
    {
        if (is_null($criteria)) {
            $criteria = new CDbCriteria;
        }

        $criteria->compare('t.psty_id', $this->psty_id);
        $criteria->compare('t.psty_name', $this->psty_name, true);
        $criteria->compare('t.psty_field_type', $this->psty_field_type, true);
        $criteria->compare('t.psty_hidded', $this->psty_hidded);


        return $criteria;

    }

}
