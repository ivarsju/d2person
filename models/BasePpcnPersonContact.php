<?php

/**
 * This is the model base class for the table "ppcn_person_contact".
 *
 * Columns in table "ppcn_person_contact" available as properties of the model:
 * @property integer $ppcn_id
 * @property integer $ppcn_pprs_id
 * @property integer $ppcn_pcnt_type
 * @property string $ppcn_value
 * @property string $ppcn_notes
 * @property string $ppcn_modified
 *
 * Relations of table "ppcn_person_contact" available as properties of the model:
 * @property PprsPerson $ppcnPprs
 * @property PcntContactType $ppcnPcntType
 */
abstract class BasePpcnPersonContact extends CActiveRecord
{

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'ppcn_person_contact';
    }

    public function rules()
    {
        return array_merge(
            parent::rules(), array(
                array('ppcn_pprs_id', 'required'),
                array('ppcn_pcnt_type, ppcn_value, ppcn_notes, ppcn_modified', 'default', 'setOnEmpty' => true, 'value' => null),
                array('ppcn_pprs_id, ppcn_pcnt_type', 'numerical', 'integerOnly' => true),
                array('ppcn_value', 'length', 'max' => 500),
                array('ppcn_notes, ppcn_modified', 'safe'),
                array('ppcn_id, ppcn_pprs_id, ppcn_pcnt_type, ppcn_value, ppcn_notes, ppcn_modified', 'safe', 'on' => 'search'),
            )
        );
    }

    public function getItemLabel()
    {
        return (string) $this->ppcn_value;
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
                'ppcnPprs' => array(self::BELONGS_TO, 'PprsPerson', 'ppcn_pprs_id'),
                'ppcnPcntType' => array(self::BELONGS_TO, 'PcntContactType', 'ppcn_pcnt_type'),
            )
        );
    }

    public function attributeLabels()
    {
        return array(
            'ppcn_id' => Yii::t('D2personModule.model', 'Ppcn'),
            'ppcn_pprs_id' => Yii::t('D2personModule.model', 'Ppcn Pprs'),
            'ppcn_pcnt_type' => Yii::t('D2personModule.model', 'Ppcn Pcnt Type'),
            'ppcn_value' => Yii::t('D2personModule.model', 'Ppcn Value'),
            'ppcn_notes' => Yii::t('D2personModule.model', 'Ppcn Notes'),
            'ppcn_modified' => Yii::t('D2personModule.model', 'Ppcn Modified'),
        );
    }

    public function searchCriteria($criteria = null)
    {
        if (is_null($criteria)) {
            $criteria = new CDbCriteria;
        }

        $criteria->compare('t.ppcn_id', $this->ppcn_id);
        $criteria->compare('t.ppcn_pprs_id', $this->ppcn_pprs_id);
        $criteria->compare('t.ppcn_pcnt_type', $this->ppcn_pcnt_type);
        $criteria->compare('t.ppcn_value', $this->ppcn_value, true);
        $criteria->compare('t.ppcn_notes', $this->ppcn_notes, true);
        $criteria->compare('t.ppcn_modified', $this->ppcn_modified, true);


        return $criteria;

    }

}
