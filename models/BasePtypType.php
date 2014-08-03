<?php

/**
 * This is the model base class for the table "ptyp_type".
 *
 * Columns in table "ptyp_type" available as properties of the model:
 * @property integer $ptyp_id
 * @property string $ptyp_name
 * @property integer $ptyp_hidden
 *
 * Relations of table "ptyp_type" available as properties of the model:
 * @property PpxtPersonXType[] $ppxtPersonXTypes
 */
abstract class BasePtypType extends CActiveRecord
{

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'ptyp_type';
    }

    public function rules()
    {
        return array_merge(
            parent::rules(), array(
                array('ptyp_name', 'required'),
                array('ptyp_hidden', 'default', 'setOnEmpty' => true, 'value' => null),
                array('ptyp_hidden', 'numerical', 'integerOnly' => true),
                array('ptyp_name', 'length', 'max' => 50),
                array('ptyp_id, ptyp_name, ptyp_hidden', 'safe', 'on' => 'search'),
            )
        );
    }

    public function getItemLabel()
    {
        return (string) $this->ptyp_name;
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
                'ppxtPersonXTypes' => array(self::HAS_MANY, 'PpxtPersonXType', 'ppxt_ptyp_id'),
            )
        );
    }

    public function attributeLabels()
    {
        return array(
            'ptyp_id' => Yii::t('D2personModule.model', 'Ptyp'),
            'ptyp_name' => Yii::t('D2personModule.model', 'Ptyp Name'),
            'ptyp_hidden' => Yii::t('D2personModule.model', 'Ptyp Hidden'),
        );
    }

    public function searchCriteria($criteria = null)
    {
        if (is_null($criteria)) {
            $criteria = new CDbCriteria;
        }

        $criteria->compare('t.ptyp_id', $this->ptyp_id);
        $criteria->compare('t.ptyp_name', $this->ptyp_name, true);
        $criteria->compare('t.ptyp_hidden', $this->ptyp_hidden);

        return $criteria;

    }

}
