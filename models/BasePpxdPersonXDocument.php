<?php

/**
 * This is the model base class for the table "ppxd_person_x_document".
 *
 * Columns in table "ppxd_person_x_document" available as properties of the model:
 * @property string $ppxd_id
 * @property integer $ppxd_pprs_id
 * @property integer $ppxd_pdcm_id
 * @property string $ppxd_number
 * @property string $ppxd_issue_date
 * @property string $ppxd_expire_date
 * @property string $ppxd_notes
 * @property string $ppxd_status
 *
 * Relations of table "ppxd_person_x_document" available as properties of the model:
 * @property PdcmDocumentType $ppxdPdcm
 * @property PprsPerson $ppxdPprs
 */
abstract class BasePpxdPersonXDocument extends CActiveRecord
{
    /**
    * ENUM field values
    */
    const PPXD_STATUS_ACTIVE = 'ACTIVE';
    const PPXD_STATUS_INVALID = 'INVALID';

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'ppxd_person_x_document';
    }

    public function rules()
    {
        return array_merge(
            parent::rules(), array(
                array('ppxd_pprs_id, ppxd_pdcm_id', 'required'),
                array('ppxd_number, ppxd_issue_date, ppxd_expire_date, ppxd_notes, ppxd_status', 'default', 'setOnEmpty' => true, 'value' => null),
                array('ppxd_pprs_id, ppxd_pdcm_id', 'numerical', 'integerOnly' => true),
                array('ppxd_number', 'length', 'max' => 100),
                array('ppxd_status', 'length', 'max' => 7),
                array('ppxd_issue_date, ppxd_expire_date, ppxd_notes', 'safe'),
                array('ppxd_id, ppxd_pprs_id, ppxd_pdcm_id, ppxd_number, ppxd_issue_date, ppxd_expire_date, ppxd_notes, ppxd_status', 'safe', 'on' => 'search'),
            )
        );
    }

    public function getItemLabel()
    {
        return (string) $this->ppxd_number;
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
                'ppxdPdcm' => array(self::BELONGS_TO, 'PdcmDocumentType', 'ppxd_pdcm_id'),
                'ppxdPprs' => array(self::BELONGS_TO, 'PprsPerson', 'ppxd_pprs_id'),
            )
        );
    }

    public function attributeLabels()
    {
        return array(
            'ppxd_id' => Yii::t('D2personModule.model', 'Ppxd'),
            'ppxd_pprs_id' => Yii::t('D2personModule.model', 'Ppxd Pprs'),
            'ppxd_pdcm_id' => Yii::t('D2personModule.model', 'Ppxd Pdcm'),
            'ppxd_number' => Yii::t('D2personModule.model', 'Ppxd Number'),
            'ppxd_issue_date' => Yii::t('D2personModule.model', 'Ppxd Issue Date'),
            'ppxd_expire_date' => Yii::t('D2personModule.model', 'Ppxd Expire Date'),
            'ppxd_notes' => Yii::t('D2personModule.model', 'Ppxd Notes'),
            'ppxd_status' => Yii::t('D2personModule.model', 'Ppxd Status'),
        );
    }

    public function enumLabels()
    {
        return array(
           'ppxd_status' => array(
               self::PPXD_STATUS_ACTIVE => Yii::t('D2personModule.model', 'PPXD_STATUS_ACTIVE'),
               self::PPXD_STATUS_INVALID => Yii::t('D2personModule.model', 'PPXD_STATUS_INVALID'),
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

        $criteria->compare('t.ppxd_id', $this->ppxd_id, true);
        $criteria->compare('t.ppxd_pprs_id', $this->ppxd_pprs_id);
        $criteria->compare('t.ppxd_pdcm_id', $this->ppxd_pdcm_id);
        $criteria->compare('t.ppxd_number', $this->ppxd_number, true);
        $criteria->compare('t.ppxd_issue_date', $this->ppxd_issue_date, true);
        $criteria->compare('t.ppxd_expire_date', $this->ppxd_expire_date, true);
        $criteria->compare('t.ppxd_notes', $this->ppxd_notes, true);
        $criteria->compare('t.ppxd_status', $this->ppxd_status, true);


        return $criteria;

    }

}
