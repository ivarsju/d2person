<?php

/**
 * This is the model base class for the table "pdcm_document_type".
 *
 * Columns in table "pdcm_document_type" available as properties of the model:
 * @property integer $pdcm_id
 * @property string $pdcm_name
 * @property integer $pdcm_hidded
 *
 * Relations of table "pdcm_document_type" available as properties of the model:
 * @property PpxdPersonXDocument[] $ppxdPersonXDocuments
 */
abstract class BasePdcmDocumentType extends CActiveRecord
{

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'pdcm_document_type';
    }

    public function rules()
    {
        return array_merge(
            parent::rules(), array(
                array('pdcm_name', 'required'),
                array('pdcm_hidded', 'default', 'setOnEmpty' => true, 'value' => null),
                array('pdcm_hidded', 'numerical', 'integerOnly' => true),
                array('pdcm_name', 'length', 'max' => 50),
                array('pdcm_id, pdcm_name, pdcm_hidded', 'safe', 'on' => 'search'),
            )
        );
    }

    public function getItemLabel()
    {
        return (string) $this->pdcm_name;
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
                'ppxdPersonXDocuments' => array(self::HAS_MANY, 'PpxdPersonXDocument', 'ppxd_pdcm_id'),
            )
        );
    }

    public function attributeLabels()
    {
        return array(
            'pdcm_id' => Yii::t('D2personModule.model', 'Pdcm'),
            'pdcm_name' => Yii::t('D2personModule.model', 'Pdcm Name'),
            'pdcm_hidded' => Yii::t('D2personModule.model', 'Pdcm Hidded'),
        );
    }

    public function searchCriteria($criteria = null)
    {
        if (is_null($criteria)) {
            $criteria = new CDbCriteria;
        }

        $criteria->compare('t.pdcm_id', $this->pdcm_id);
        $criteria->compare('t.pdcm_name', $this->pdcm_name, true);
        $criteria->compare('t.pdcm_hidded', $this->pdcm_hidded);

        return $criteria;

    }

}
