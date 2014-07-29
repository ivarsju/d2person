<?php

/**
 * This is the model base class for the table "pprs_person".
 *
 * Columns in table "pprs_person" available as properties of the model:
 * @property integer $pprs_id
 * @property string $pprs_first_name
 * @property string $pprs_second_name
 *
 * Relations of table "pprs_person" available as properties of the model:
 * @property CcucUserCompany[] $ccucUserCompanies
 * @property PpcnPersonContact[] $ppcnPersonContacts
 * @property PpxdPersonXDocument[] $ppxdPersonXDocuments
 * @property PpxsPersonXSetting[] $ppxsPersonXSettings
 * @property PpxtPersonXType[] $ppxtPersonXTypes
 * @property VxprVoyageXPerson[] $vxprVoyageXPeople
 */
abstract class BasePprsPerson extends CActiveRecord
{

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
                array('pprs_first_name, pprs_second_name', 'default', 'setOnEmpty' => true, 'value' => null),
                array('pprs_first_name, pprs_second_name', 'length', 'max' => 100),
                array('pprs_id, pprs_first_name, pprs_second_name', 'safe', 'on' => 'search'),
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
                'vxprVoyageXPeople' => array(self::HAS_MANY, 'VxprVoyageXPerson', 'vxpr_pprs_id'),
            )
        );
    }

    public function attributeLabels()
    {
        return array(
            'pprs_id' => Yii::t('D2personModule.model', 'Pprs'),
            'pprs_first_name' => Yii::t('D2personModule.model', 'Pprs First Name'),
            'pprs_second_name' => Yii::t('D2personModule.model', 'Pprs Second Name'),
        );
    }

    public function searchCriteria($criteria = null)
    {
        if (is_null($criteria)) {
            $criteria = new CDbCriteria;
        }

        $criteria->compare('t.pprs_id', $this->pprs_id);
        $criteria->compare('t.pprs_first_name', $this->pprs_first_name, true);
        $criteria->compare('t.pprs_second_name', $this->pprs_second_name, true);


        return $criteria;

    }

}
