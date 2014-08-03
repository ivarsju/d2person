<?php

/**
 * This is the model base class for the table "pcnt_contact_type".
 *
 * Columns in table "pcnt_contact_type" available as properties of the model:
 * @property integer $pcnt_id
 * @property string $pcnt_name
 *
 * Relations of table "pcnt_contact_type" available as properties of the model:
 * @property PpcnPersonContact[] $ppcnPersonContacts
 */
abstract class BasePcntContactType extends CActiveRecord
{

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'pcnt_contact_type';
    }

    public function rules()
    {
        return array_merge(
            parent::rules(), array(
                array('pcnt_name', 'required'),
                array('pcnt_name', 'length', 'max' => 40),
                array('pcnt_id, pcnt_name', 'safe', 'on' => 'search'),
            )
        );
    }

    public function getItemLabel()
    {
        return (string) $this->pcnt_name;
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
                'ppcnPersonContacts' => array(self::HAS_MANY, 'PpcnPersonContact', 'ppcn_pcnt_type'),
            )
        );
    }

    public function attributeLabels()
    {
        return array(
            'pcnt_id' => Yii::t('D2personModule.model', 'Pcnt'),
            'pcnt_name' => Yii::t('D2personModule.model', 'Pcnt Name'),
        );
    }

    public function searchCriteria($criteria = null)
    {
        if (is_null($criteria)) {
            $criteria = new CDbCriteria;
        }

        $criteria->compare('t.pcnt_id', $this->pcnt_id);
        $criteria->compare('t.pcnt_name', $this->pcnt_name, true);

        return $criteria;

    }

}
