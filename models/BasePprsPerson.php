<?php

/**
 * This is the model base class for the table "pprs_person".
 *
 * Columns in table "pprs_person" available as properties of the model:
 * @property integer $pprs_id
 * @property string $pprs_first_name
 * @property string $pprs_second_name
 * @property string $pprs_declared_place_of_residence
 * @property string $pprs_real_pleace_of_residence
 * @property integer $pprs_salary
 *
 * Relations of table "pprs_person" available as properties of the model:
 * @property PpcnPersonContact[] $ppcnPersonContacts
 * @property PpxdPersonXDocument[] $ppxdPersonXDocuments
 * @property PpxtPersonXType[] $ppxtPersonXTypes
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
                array('pprs_first_name, pprs_second_name, pprs_declared_place_of_residence, pprs_real_pleace_of_residence, pprs_salary', 'default', 'setOnEmpty' => true, 'value' => null),
                array('pprs_salary', 'numerical', 'integerOnly' => true),
                array('pprs_first_name, pprs_second_name', 'length', 'max' => 100),
                array('pprs_declared_place_of_residence, pprs_real_pleace_of_residence', 'safe'),
                array('pprs_id, pprs_first_name, pprs_second_name, pprs_declared_place_of_residence, pprs_real_pleace_of_residence, pprs_salary', 'safe', 'on' => 'search'),
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
                'ppcnPersonContacts' => array(self::HAS_MANY, 'PpcnPersonContact', 'ppcn_pprs_id'),
                'ppxdPersonXDocuments' => array(self::HAS_MANY, 'PpxdPersonXDocument', 'ppxd_pprs_id'),
                'ppxtPersonXTypes' => array(self::HAS_MANY, 'PpxtPersonXType', 'ppxt_pprs_id'),
                'profile' => array(self::BELONGS_TO, 'Profile', 'pprs_id'),
            )
        );
    }

    public function attributeLabels()
    {
        return array(
            'pprs_id' => Yii::t('D2personModule.model', 'Pprs'),
            'pprs_first_name' => Yii::t('D2personModule.model', 'Pprs First Name'),
            'pprs_second_name' => Yii::t('D2personModule.model', 'Pprs Second Name'),
            'pprs_declared_place_of_residence' => Yii::t('D2personModule.model', 'Pprs Declared Place Of Residence'),
            'pprs_real_pleace_of_residence' => Yii::t('D2personModule.model', 'Pprs Real Pleace Of Residence'),
            'pprs_salary' => Yii::t('D2personModule.model', 'Pprs Salary'),
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
        $criteria->compare('t.pprs_declared_place_of_residence', $this->pprs_declared_place_of_residence, true);
        $criteria->compare('t.pprs_real_pleace_of_residence', $this->pprs_real_pleace_of_residence, true);
        $criteria->compare('t.pprs_salary', $this->pprs_salary);


        return $criteria;

    }

}
