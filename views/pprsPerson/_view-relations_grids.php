
<!--
<h2>
    <?php echo Yii::t('D2personModule.crud_static', 'Relations') ?></h2>
-->


<?php Yii::beginProfile('ccuc_person_id.view.grid'); ?>
<h3>
    <?php 
    echo Yii::t('D2personModule.model', 'Ccuc User Company') . ' '; 
        
    if (empty($modelMain->ccucUserCompanies)) {
        // if no records, reload page
        $button_type = 'Button';
        $no_ajax = 1;
        $ajaxOptions = array();
    } else {
        // ajax button
        $button_type = 'ajaxButton';
        $no_ajax = 0;
        $ajaxOptions = array(
                'success' => 'function(html) {$.fn.yiiGridView.update(\'ccuc-user-company-grid\');}'
            );        
    }
    $this->widget(
        'bootstrap.widgets.TbButton',
        array(
            'buttonType' => $button_type, 
            'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size' => 'mini',
            'icon' => 'icon-plus',
            'url' => array(
                '//d2person/ccucUserCompany/ajaxCreate',
                'field' => 'ccuc_person_id',
                'value' => $modelMain->primaryKey,
                'no_ajax' => $no_ajax,
            ),
            'ajaxOptions' => $ajaxOptions,
            'htmlOptions' => array(
                'title' => Yii::t('D2personModule.crud_static', 'Add new record'),
                'data-toggle' => 'tooltip',
            ),                 
        )
    );        
    ?>
</h3> 
 
<?php 
$model = new CcucUserCompany();
$model->ccuc_person_id = $modelMain->primaryKey;

// render grid view

$this->widget('TbGridView',
    array(
        'id' => 'ccuc-user-company-grid',
        'dataProvider' => $model->search(),
        #'responsiveTable' => true,
        'template' => '{items}',
        'pager' => array(
            'class' => 'TbPager',
            'displayFirstAndLast' => true,
        ),
        'columns' => array(
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'ccuc_ccmp_id',
                'editable' => array(
                    'type' => 'select',
                    'url' => $this->createUrl('//d2person/ccucUserCompany/editableSaver'),
                    'source' => CHtml::listData(CcmpCompany::model()->findAll(array('limit' => 1000)), 'ccmp_id', 'itemLabel'),                        
                    //'placement' => 'right',
                )
            ),
            array(
                    'class' => 'editable.EditableColumn',
                    'name' => 'ccuc_status',
                    'editable' => array(
                        'type' => 'select',
                        'url' => $this->createUrl('//d2person/ccucUserCompany/editableSaver'),
                        'source' => $model->getEnumFieldLabels('ccuc_status'),
                        //'placement' => 'right',
                    ),
                   'filter' => $model->getEnumFieldLabels('ccuc_status'),
                ),

            array(
                'class' => 'TbButtonColumn',
                'buttons' => array(
                    'view' => array('visible' => 'FALSE'),
                    'update' => array('visible' => 'FALSE'),
                    'delete' => array('visible' => 'Yii::app()->user->checkAccess("D2person.PprsPerson.DeleteccucUserCompanies")'),
                ),
                'deleteButtonUrl' => 'Yii::app()->controller->createUrl("/d2person/ccucUserCompany/delete", array("ccuc_id" => $data->ccuc_id))',
                'deleteButtonOptions'=>array('data-toggle'=>'tooltip'),                    
            ),
        )
    )
);
?>

<?php Yii::endProfile('CcucUserCompany.view.grid'); ?>

<?php Yii::beginProfile('ppcn_pprs_id.view.grid'); ?>
<h3>
    <?php 
    echo Yii::t('D2personModule.model', 'Ppcn Person Contact') . ' '; 
        
    if (empty($modelMain->ppcnPersonContacts)) {
        // if no records, reload page
        $button_type = 'Button';
        $no_ajax = 1;
        $ajaxOptions = array();
    } else {
        // ajax button
        $button_type = 'ajaxButton';
        $no_ajax = 0;
        $ajaxOptions = array(
                'success' => 'function(html) {$.fn.yiiGridView.update(\'ppcn-person-contact-grid\');}'
            );        
    }
    $this->widget(
        'bootstrap.widgets.TbButton',
        array(
            'buttonType' => $button_type, 
            'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size' => 'mini',
            'icon' => 'icon-plus',
            'url' => array(
                '//d2person/ppcnPersonContact/ajaxCreate',
                'field' => 'ppcn_pprs_id',
                'value' => $modelMain->primaryKey,
                'no_ajax' => $no_ajax,
            ),
            'ajaxOptions' => $ajaxOptions,
            'htmlOptions' => array(
                'title' => Yii::t('D2personModule.crud_static', 'Add new record'),
                'data-toggle' => 'tooltip',
            ),                 
        )
    );        
    ?>
</h3> 
 
<?php 
$model = new PpcnPersonContact();
$model->ppcn_pprs_id = $modelMain->primaryKey;

// render grid view

$this->widget('TbGridView',
    array(
        'id' => 'ppcn-person-contact-grid',
        'dataProvider' => $model->search(),
        //'filter' => $model,
        #'responsiveTable' => true,
        'template' => '{items}',
        'pager' => array(
            'class' => 'TbPager',
            'displayFirstAndLast' => true,
        ),
          'columns' => array(
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'ppcn_pcnt_type',
                'editable' => array(
                    'type' => 'select',
                    'url' => $this->createUrl('//d2person/ppcnPersonContact/editableSaver'),
                    'source' => CHtml::listData(PcntContactType::model()->findAll(array('limit' => 1000)), 'pcnt_id', 'itemLabel'),                        
                    //'placement' => 'right',
                )
            ),
            array(
                //varchar(500)
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
                    'type' => 'textarea',
                    'url' => $this->createUrl('//d2person/ppcnPersonContact/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'TbEditableColumn',
                'name' => 'ppcn_modified',
                'editable' => array(
                    'url' => $this->createUrl('//d2person/ppcnPersonContact/editableSaver'),
                    //'placement' => 'right',
                )
            ),

            array(
                'class' => 'TbButtonColumn',
                'buttons' => array(
                    'view' => array('visible' => 'FALSE'),
                    'update' => array('visible' => 'FALSE'),
                    'delete' => array('visible' => 'Yii::app()->user->checkAccess("D2person.PprsPerson.DeleteppcnPersonContacts")'),
                ),
                'deleteButtonUrl' => 'Yii::app()->controller->createUrl("/d2person/ppcnPersonContact/delete", array("ppcn_id" => $data->ppcn_id))',
                'deleteButtonOptions'=>array('data-toggle'=>'tooltip'),                    
            ),
        )
    )
);
?>

<?php Yii::endProfile('PpcnPersonContact.view.grid'); ?>

<?php Yii::beginProfile('ppxd_pprs_id.view.grid'); ?>
<h3>
    <?php 
    echo Yii::t('D2personModule.model', 'Ppxd Person Xdocument') . ' '; 
        
    if (empty($modelMain->ppxdPersonXDocuments)) {
        // if no records, reload page
        $button_type = 'Button';
        $no_ajax = 1;
        $ajaxOptions = array();
    } else {
        // ajax button
        $button_type = 'ajaxButton';
        $no_ajax = 0;
        $ajaxOptions = array(
                'success' => 'function(html) {$.fn.yiiGridView.update(\'ppxd-person-xdocument-grid\');}'
            );        
    }
    $this->widget(
        'bootstrap.widgets.TbButton',
        array(
            'buttonType' => $button_type, 
            'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size' => 'mini',
            'icon' => 'icon-plus',
            'url' => array(
                '//d2person/ppxdPersonXDocument/ajaxCreate',
                'field' => 'ppxd_pprs_id',
                'value' => $modelMain->primaryKey,
                'no_ajax' => $no_ajax,
            ),
            'ajaxOptions' => $ajaxOptions,
            'htmlOptions' => array(
                'title' => Yii::t('D2personModule.crud_static', 'Add new record'),
                'data-toggle' => 'tooltip',
            ),                 
        )
    );        
    ?>
</h3> 
 
<?php 
$model = new PpxdPersonXDocument();
$model->ppxd_pprs_id = $modelMain->primaryKey;

// render grid view

$this->widget('TbGridView',
    array(
        'id' => 'ppxd-person-xdocument-grid',
        'dataProvider' => $model->search(),
        #'responsiveTable' => true,
        'template' => '{items}',
        'pager' => array(
            'class' => 'TbPager',
            'displayFirstAndLast' => true,
        ),
        'columns' => array(
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'ppxd_pdcm_id',
                'editable' => array(
                    'type' => 'select',
                    'url' => $this->createUrl('//d2person/ppxdPersonXDocument/editableSaver'),
                    'source' => CHtml::listData(PdcmDocumentType::model()->findAll(array('limit' => 1000)), 'pdcm_id', 'itemLabel'),                        
                    //'placement' => 'right',
                )
            ),
            array(
                //varchar(100)
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
                'editable' => array(
                    'type' => 'date',
                    'url' => $this->createUrl('//d2person/ppxdPersonXDocument/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'ppxd_expire_date',
                'editable' => array(
                    'type' => 'date',
                    'url' => $this->createUrl('//d2person/ppxdPersonXDocument/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'ppxd_notes',
                'editable' => array(
                    'type' => 'textarea',
                    'url' => $this->createUrl('//d2person/ppxdPersonXDocument/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                    'class' => 'editable.EditableColumn',
                    'name' => 'ppxd_status',
                    'editable' => array(
                        'type' => 'select',
                        'url' => $this->createUrl('//d2person/ppxdPersonXDocument/editableSaver'),
                        'source' => $model->getEnumFieldLabels('ppxd_status'),
                        //'placement' => 'right',
                    ),
                   'filter' => $model->getEnumFieldLabels('ppxd_status'),
                ),

            array(
                'class' => 'TbButtonColumn',
                'buttons' => array(
                    'view' => array('visible' => 'FALSE'),
                    'update' => array('visible' => 'FALSE'),
                    'delete' => array('visible' => 'Yii::app()->user->checkAccess("D2person.PprsPerson.DeleteppxdPersonXDocuments")'),
                ),
                'deleteButtonUrl' => 'Yii::app()->controller->createUrl("/d2person/ppxdPersonXDocument/delete", array("ppxd_id" => $data->ppxd_id))',
                'deleteButtonOptions'=>array('data-toggle'=>'tooltip'),                    
            ),
        )
    )
);
?>

<?php Yii::endProfile('PpxdPersonXDocument.view.grid'); ?>

<?php Yii::beginProfile('ppxt_pprs_id.view.grid'); ?>
<h3>
    <?php 
    echo Yii::t('D2personModule.model', 'Ppxt Person Xtype') . ' '; 
        
    if (empty($modelMain->ppxtPersonXTypes)) {
        // if no records, reload page
        $button_type = 'Button';
        $no_ajax = 1;
        $ajaxOptions = array();
    } else {
        // ajax button
        $button_type = 'ajaxButton';
        $no_ajax = 0;
        $ajaxOptions = array(
                'success' => 'function(html) {$.fn.yiiGridView.update(\'ppxt-person-xtype-grid\');}'
            );        
    }
    $this->widget(
        'bootstrap.widgets.TbButton',
        array(
            'buttonType' => $button_type, 
            'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size' => 'mini',
            'icon' => 'icon-plus',
            'url' => array(
                '//d2person/ppxtPersonXType/ajaxCreate',
                'field' => 'ppxt_pprs_id',
                'value' => $modelMain->primaryKey,
                'no_ajax' => $no_ajax,
            ),
            'ajaxOptions' => $ajaxOptions,
            'htmlOptions' => array(
                'title' => Yii::t('D2personModule.crud_static', 'Add new record'),
                'data-toggle' => 'tooltip',
            ),                 
        )
    );        
    ?>
</h3> 
 
<?php 
$model = new PpxtPersonXType();
$model->ppxt_pprs_id = $modelMain->primaryKey;

// render grid view

$this->widget('TbGridView',
    array(
        'id' => 'ppxt-person-xtype-grid',
        'dataProvider' => $model->search(),
        #'responsiveTable' => true,
        'template' => '{items}',
        'pager' => array(
            'class' => 'TbPager',
            'displayFirstAndLast' => true,
        ),
        'columns' => array(
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'ppxt_ptyp_id',
                'editable' => array(
                    'type' => 'select',
                    'url' => $this->createUrl('//d2person/ppxtPersonXType/editableSaver'),
                    'source' => CHtml::listData(PtypType::model()->findAll(array('limit' => 1000)), 'ptyp_id', 'itemLabel'),                        
                    //'placement' => 'right',
                )
            ),

            array(
                'class' => 'TbButtonColumn',
                'buttons' => array(
                    'view' => array('visible' => 'FALSE'),
                    'update' => array('visible' => 'FALSE'),
                    'delete' => array('visible' => 'Yii::app()->user->checkAccess("D2person.PprsPerson.DeleteppxtPersonXTypes")'),
                ),
                'deleteButtonUrl' => 'Yii::app()->controller->createUrl("/d2person/ppxtPersonXType/delete", array("ppxt_id" => $data->ppxt_id))',
                'deleteButtonOptions'=>array('data-toggle'=>'tooltip'),                    
            ),
        )
    )
);
?>

<?php Yii::endProfile('PpxtPersonXType.view.grid'); ?>
