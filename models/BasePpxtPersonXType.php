<?php

/**
 * This is the model base class for the table "ppxt_person_x_type".
 *
 * Columns in table "ppxt_person_x_type" available as properties of the model:
 * @property integer $ppxt_id
 * @property integer $ppxt_pprs_id
 * @property integer $ppxt_ptyp_id
 *
 * Relations of table "ppxt_person_x_type" available as properties of the model:
 * @property PtypType $ppxtPtyp
 * @property PprsPerson $ppxtPprs
 */
abstract class BasePpxtPersonXType extends CActiveRecord
{

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'ppxt_person_x_type';
    }

    public function rules()
    {
        return array_merge(
            parent::rules(), array(
                array('ppxt_pprs_id, ppxt_ptyp_id', 'required'),
                array('ppxt_pprs_id, ppxt_ptyp_id', 'numerical', 'integerOnly' => true),
                array('ppxt_id, ppxt_pprs_id, ppxt_ptyp_id', 'safe', 'on' => 'search'),
            )
        );
    }

    public function getItemLabel()
    {
        return (string) $this->ppxt_id;
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
                'ppxtPtyp' => array(self::BELONGS_TO, 'PtypType', 'ppxt_ptyp_id'),
                'ppxtPprs' => array(self::BELONGS_TO, 'PprsPerson', 'ppxt_pprs_id'),
            )
        );
    }

    public function attributeLabels()
    {
        return array(
            'ppxt_id' => Yii::t('D2personModule.model', 'Ppxt'),
            'ppxt_pprs_id' => Yii::t('D2personModule.model', 'Ppxt Pprs'),
            'ppxt_ptyp_id' => Yii::t('D2personModule.model', 'Ppxt Ptyp'),
        );
    }

    public function searchCriteria($criteria = null)
    {
        if (is_null($criteria)) {
            $criteria = new CDbCriteria;
        }

        $criteria->compare('t.ppxt_id', $this->ppxt_id);
        $criteria->compare('t.ppxt_pprs_id', $this->ppxt_pprs_id);
        $criteria->compare('t.ppxt_ptyp_id', $this->ppxt_ptyp_id);


        return $criteria;

    }

}
