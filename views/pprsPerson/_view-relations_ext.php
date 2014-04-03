
<!--
<h2>
    <?php echo Yii::t('D2personModule.crud', 'Relations') ?></h2>
-->


<h2>
    <?php echo Yii::t('D2personModule.model', 'ppcn_pprs_ids'); ?>
</h2> 

<?php Yii::beginProfile('ppcn_pprs_id.view.grid'); ?>
 
<?php 
$model = new PpcnPersonContact();
$model->ppcn_pprs_id = $modelMain->primaryKey;

// render grid view

$this->widget('\TbGridView',
    array(
        'id' => 'ppcn-person-contact-grid',
        'dataProvider' => $model->search(),
        'template' => '{items}',
        'pager' => array(
            'class' => '\TbPager',
            'displayFirstAndLast' => true,
        ),
        'columns' => array(
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'ppcn_pcnt_type',
                'value' => 'CHtml::value($data, \'ppcnPcntType.itemLabel\')',                    
                'editable' => array(
                    'type' => 'select',
                    'url' => $this->createUrl('//d2person/ppcnPersonContact/editableSaver'),
                    'source' => CHtml::listData(PcntContactType::model()->findAll(array('limit' => 1000)), 'pcnt_id', 'itemLabel'),                        
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'ppcn_value',
                'editable' => array(
                    'url' => $this->createUrl('//d2person/ppcnPersonContact/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'ppcn_notes',
                'editable' => array(
                    'url' => $this->createUrl('//d2person/ppcnPersonContact/editableSaver'),
                    //'placement' => 'right',
                )
            ),            
            array(
                'name' => 'ppcn_modified',
            ),

            array(
                'class' => '\TbButtonColumn',
                'template'=>'{delete}',
                'buttons' => array(
                    'delete' => array('visible' => 'Yii::app()->user->checkAccess("D2person.PprsPerson.DeleteppcnPersonContacts")'),
                ),
                'deleteButtonUrl' => 'Yii::app()->controller->createUrl("delete", array("ppcn_id" => $data->ppcn_id))',
            ),
        )
    )
);
?>

<?php Yii::endProfile('ppcn_pprs_id.view.grid'); ?>

<h2>
    <?php echo Yii::t('D2personModule.model', 'ppxd_pprs_ids'); ?>
</h2> 

<?php Yii::beginProfile('ppxd_pprs_id.view.grid'); ?>
 
<?php 
$model = new PpxdPersonXDocument();
$model->ppxd_pprs_id = $modelMain->primaryKey;

// render grid view

$this->widget('TbGridView',
    array(
        'id' => 'ppxd-person-xdocument-grid',
        'dataProvider' => $model->search(),
        //'responsiveTable' => true,
        'template' => '{items}',
        'pager' => array(
            'class' => '\TbPager',
            'displayFirstAndLast' => true,
        ),
        'columns' => array(
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'ppxd_pdcm_id',
                'value' => 'CHtml::value($data, \'ppxdPdcm.itemLabel\')',                    
                'editable' => array(
                    'type' => 'select',
                    'url' => $this->createUrl('//d2person/ppxdPersonXDocument/editableSaver'),
                    'source' => CHtml::listData(PdcmDocumentType::model()->findAll(array('limit' => 1000)), 'pdcm_id', 'itemLabel'),                        
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'ppxd_number',
                'editable' => array(
                    'url' => $this->createUrl('//d2person/ppxdPersonXDocument/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'ppxd_issue_date',
                //'value' => '$data->ppxd_issue_date',
                'editable' => array(
                    'type' => 'date',                    
                    'url' => $this->createUrl('//d2person/ppxdPersonXDocument/editableSaver'),
                    'format' => 'yyyy-mm-dd',
                    'viewformat' => 'yyyy-mm-dd',
                    //'placement' => 'right',

                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'ppxd_expire_date',
                'editable' => array(
                    'url' => $this->createUrl('//d2person/ppxdPersonXDocument/editableSaver'),
                    'format' => 'yyyy-mm-dd',
                    'viewformat' => 'yyyy-mm-dd',
                    //'placement' => 'right',
                )
            ),
            #'ppxd_notes',
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'ppxd_status',
                'value' => '$data->getEnumLabel(\'ppxd_status\',$data->ppxd_status)',
                'editable' => array(
                    'type' => 'select',
                    'url' => $this->createUrl('/d2person/ppxdPersonXDocument/editableSaver'),
                    'source' => $model->getEnumFieldLabels('ppxd_status'),
                    //'placement' => 'right',
                ),
            ),

            array(
                'class' => '\TbButtonColumn',
                'template'=>'{delete}',
                'buttons' => array(
                    'delete' => array('visible' => 'Yii::app()->user->checkAccess("D2person.PprsPerson.DeleteppxdPersonXDocuments")'),
                ),
                'deleteButtonUrl' => 'Yii::app()->controller->createUrl("delete", array("ppxd_id" => $data->ppxd_id))',
            ),
        )
    )
);
?>

<?php Yii::endProfile('ppxd_pprs_id.view.grid'); ?>

<h2>
    <?php echo Yii::t('D2personModule.model', 'ppxt_pprs_ids'); ?>
</h2> 

<?php Yii::beginProfile('ppxt_pprs_id.view.grid'); ?>
 
<?php 
$model = new PpxtPersonXType();
$model->ppxt_pprs_id = $modelMain->primaryKey;

// render grid view

$this->widget('\TbGridView',
    array(
        'id' => 'ppxt-person-xtype-grid',
        'dataProvider' => $model->search(),
        #'responsiveTable' => true,
        'template' => '{items}',
        'pager' => array(
            'class' => '\TbPager',
            'displayFirstAndLast' => true,
        ),
        'columns' => array(
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'ppxt_ptyp_id',
                'value' => 'CHtml::value($data, \'ppxtPtyp.itemLabel\')',                    
                'editable' => array(
                    'type' => 'select',
                    'url' => $this->createUrl('//d2person/ppxtPersonXType/editableSaver'),
                    'source' => CHtml::listData(PtypType::model()->findAll(array('limit' => 1000)), 'ptyp_id', 'itemLabel'),                        
                    //'placement' => 'right',
                )
            ),

            array(
                'class' => '\TbButtonColumn',
                'template'=>'{delete}',
                'buttons' => array(
                    'delete' => array('visible' => 'Yii::app()->user->checkAccess("D2person.PprsPerson.DeleteppxtPersonXTypes")'),
                ),
                'deleteButtonUrl' => 'Yii::app()->controller->createUrl("delete", array("ppxt_id" => $data->ppxt_id))',
            ),
        )
    )
);
?>

<?php Yii::endProfile('ppxt_pprs_id.view.grid'); ?>
