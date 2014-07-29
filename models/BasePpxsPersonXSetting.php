<?php

/**
 * This is the model base class for the table "ppxs_person_x_setting".
 *
 * Columns in table "ppxs_person_x_setting" available as properties of the model:
 * @property string $ppxs_id
 * @property integer $ppxs_pprs_id
 * @property integer $ppxs_psty_id
 * @property string $ppxs_value
 * @property string $ppxs_notes
 * @property integer $ppxs_hidded
 *
 * Relations of table "ppxs_person_x_setting" available as properties of the model:
 * @property PprsPerson $ppxsPprs
 * @property PstySettingType $ppxsPsty
 */
abstract class BasePpxsPersonXSetting extends CActiveRecord
{

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'ppxs_person_x_setting';
    }

    public function rules()
    {
        return array_merge(
            parent::rules(), array(
                array('ppxs_pprs_id', 'required'),
                array('ppxs_psty_id, ppxs_value, ppxs_notes, ppxs_hidded', 'default', 'setOnEmpty' => true, 'value' => null),
                array('ppxs_pprs_id, ppxs_psty_id, ppxs_hidded', 'numerical', 'integerOnly' => true),
                array('ppxs_value', 'length', 'max' => 256),
                array('ppxs_notes', 'safe'),
                array('ppxs_id, ppxs_pprs_id, ppxs_psty_id, ppxs_value, ppxs_notes, ppxs_hidded', 'safe', 'on' => 'search'),
            )
        );
    }

    public function getItemLabel()
    {
        return (string) $this->ppxs_value;
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
                'ppxsPprs' => array(self::BELONGS_TO, 'PprsPerson', 'ppxs_pprs_id'),
                'ppxsPsty' => array(self::BELONGS_TO, 'PstySettingType', 'ppxs_psty_id'),
            )
        );
    }

    public function attributeLabels()
    {
        return array(
            'ppxs_id' => Yii::t('D2personModule.model', 'Ppxs'),
            'ppxs_pprs_id' => Yii::t('D2personModule.model', 'Ppxs Pprs'),
            'ppxs_psty_id' => Yii::t('D2personModule.model', 'Ppxs Psty'),
            'ppxs_value' => Yii::t('D2personModule.model', 'Ppxs Value'),
            'ppxs_notes' => Yii::t('D2personModule.model', 'Ppxs Notes'),
            'ppxs_hidded' => Yii::t('D2personModule.model', 'Ppxs Hidded'),
        );
    }

    public function searchCriteria($criteria = null)
    {
        if (is_null($criteria)) {
            $criteria = new CDbCriteria;
        }

        $criteria->compare('t.ppxs_id', $this->ppxs_id, true);
        $criteria->compare('t.ppxs_pprs_id', $this->ppxs_pprs_id);
        $criteria->compare('t.ppxs_psty_id', $this->ppxs_psty_id);
        $criteria->compare('t.ppxs_value', $this->ppxs_value, true);
        $criteria->compare('t.ppxs_notes', $this->ppxs_notes, true);
        $criteria->compare('t.ppxs_hidded', $this->ppxs_hidded);


        return $criteria;

    }

}
