<?php
if(!$ajax){
    Yii::app()->clientScript->registerCss('rel_grid',' 
            .rel-grid-view {margin-top:-60px;}
            .rel-grid-view div.summary {height: 60px;}
            ');     
}
?>
<?php
if(FALSE &&  (!$ajax || $ajax == 'ccuc-user-company-grid')){
    Yii::beginProfile('ccuc_person_id.view.grid');
?>

<div class="table-header">
    <?=Yii::t('D2personModule.model', 'Ccuc User Company')?>
    <?php    
        
    $this->widget(
        'bootstrap.widgets.TbButton',
        array(
            'buttonType' => 'ajaxButton', 
            'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size' => 'mini',
            'icon' => 'icon-plus',
            'url' => array(
                '//d2person/ccucUserCompany/ajaxCreate',
                'field' => 'ccuc_person_id',
                'value' => $modelMain->primaryKey,
                'ajax' => 'ccuc-user-company-grid',
            ),
            'ajaxOptions' => array(
                    'success' => 'function(html) {$.fn.yiiGridView.update(\'ccuc-user-company-grid\');}'
                    ),
            'htmlOptions' => array(
                'title' => Yii::t('D2personModule.crud_static', 'Add new record'),
                'data-toggle' => 'tooltip',
            ),                 
        )
    );        
    ?>
</div>
 
<?php 

    if (empty($modelMain->ccucUserCompanies)) {
        $model = new CcucUserCompany;
        $model->ccuc_person_id = $modelMain->primaryKey;
        $model->save();
        unset($model);
    } 
    
    $model = new CcucUserCompany();
    $model->ccuc_person_id = $modelMain->primaryKey;

    // render grid view

    $this->widget('TbGridView',
        array(
            'id' => 'ccuc-user-company-grid',
            'dataProvider' => $model->search(),
            'template' => '{summary}{items}',
            'summaryText' => '&nbsp;',
            'htmlOptions' => array(
                'class' => 'rel-grid-view'
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
                    'deleteConfirmation'=>Yii::t('D2personModule.crud_static','Do you want to delete this item?'),   
                    'deleteButtonOptions'=>array('data-toggle'=>'tooltip'),                    
                ),
            )
        )
    );
    ?>

<?php
    Yii::endProfile('CcucUserCompany.view.grid');
}    
?>

<?php
if(!$ajax || $ajax == 'ppcn-person-contact-grid'){
    Yii::beginProfile('ppcn_pprs_id.view.grid');
?>

<div class="table-header">
    <?=Yii::t('D2personModule.model', 'Ppcn Person Contact')?>
    <?php    
        
    $this->widget(
        'bootstrap.widgets.TbButton',
        array(
            'buttonType' => 'ajaxButton', 
            'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size' => 'mini',
            'icon' => 'icon-plus',
            'url' => array(
                '//d2person/ppcnPersonContact/ajaxCreate',
                'field' => 'ppcn_pprs_id',
                'value' => $modelMain->primaryKey,
                'ajax' => 'ppcn-person-contact-grid',
            ),
            'ajaxOptions' => array(
                    'success' => 'function(html) {$.fn.yiiGridView.update(\'ppcn-person-contact-grid\');}'
                    ),
            'htmlOptions' => array(
                'title' => Yii::t('D2personModule.crud_static', 'Add new record'),
                'data-toggle' => 'tooltip',
            ),                 
        )
    );        
    ?>
</div>
 
<?php 

    if (empty($modelMain->ppcnPersonContacts)) {
        $model = new PpcnPersonContact;
        $model->ppcn_pprs_id = $modelMain->primaryKey;
        $model->save();
        unset($model);
    } 
    
    $model = new PpcnPersonContact();
    $model->ppcn_pprs_id = $modelMain->primaryKey;

    // render grid view

    $this->widget('TbGridView',
        array(
            'id' => 'ppcn-person-contact-grid',
            'dataProvider' => $model->search(),
            'template' => '{summary}{items}',
            'summaryText' => '&nbsp;',
            'htmlOptions' => array(
                'class' => 'rel-grid-view'
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
                'class' => 'editable.EditableColumn',
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
                    'deleteConfirmation'=>Yii::t('D2personModule.crud_static','Do you want to delete this item?'),   
                    'deleteButtonOptions'=>array('data-toggle'=>'tooltip'),                    
                ),
            )
        )
    );
    ?>

<?php
    Yii::endProfile('PpcnPersonContact.view.grid');
}    
?>

<?php
if(!$ajax || $ajax == 'ppxd-person-xdocument-grid'){
    Yii::beginProfile('ppxd_pprs_id.view.grid');
?>

<div class="table-header">
    <?=Yii::t('D2personModule.model', 'Ppxd Person Xdocument')?>
    <?php    
        
    $this->widget(
        'bootstrap.widgets.TbButton',
        array(
            'buttonType' => 'ajaxButton', 
            'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size' => 'mini',
            'icon' => 'icon-plus',
            'url' => array(
                '//d2person/ppxdPersonXDocument/ajaxCreate',
                'field' => 'ppxd_pprs_id',
                'value' => $modelMain->primaryKey,
                'ajax' => 'ppxd-person-xdocument-grid',
            ),
            'ajaxOptions' => array(
                    'success' => 'function(html) {$.fn.yiiGridView.update(\'ppxd-person-xdocument-grid\');}'
                    ),
            'htmlOptions' => array(
                'title' => Yii::t('D2personModule.crud_static', 'Add new record'),
                'data-toggle' => 'tooltip',
            ),                 
        )
    );        
    ?>
</div>
 
<?php 

    if (empty($modelMain->ppxdPersonXDocuments)) {
        $model = new PpxdPersonXDocument;
        $model->ppxd_pprs_id = $modelMain->primaryKey;
        $model->save();
        unset($model);
    } 
    
    $model = new PpxdPersonXDocument();
    $model->ppxd_pprs_id = $modelMain->primaryKey;

    // render grid view

    $this->widget('TbGridView',
        array(
            'id' => 'ppxd-person-xdocument-grid',
            'dataProvider' => $model->search(),
            'template' => '{summary}{items}',
            'summaryText' => '&nbsp;',
            'htmlOptions' => array(
                'class' => 'rel-grid-view'
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
                    'deleteConfirmation'=>Yii::t('D2personModule.crud_static','Do you want to delete this item?'),   
                    'deleteButtonOptions'=>array('data-toggle'=>'tooltip'),                    
                ),
            )
        )
    );
    ?>

<?php
    Yii::endProfile('PpxdPersonXDocument.view.grid');
}    
?>

<?php
if(!$ajax || $ajax == 'ppxt-person-xtype-grid'){
    Yii::beginProfile('ppxt_pprs_id.view.grid');
?>

<div class="table-header">
    <?=Yii::t('D2personModule.model', 'Ppxt Person Xtype')?>
    <?php    
        
    $this->widget(
        'bootstrap.widgets.TbButton',
        array(
            'buttonType' => 'ajaxButton', 
            'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size' => 'mini',
            'icon' => 'icon-plus',
            'url' => array(
                '//d2person/ppxtPersonXType/ajaxCreate',
                'field' => 'ppxt_pprs_id',
                'value' => $modelMain->primaryKey,
                'ajax' => 'ppxt-person-xtype-grid',
            ),
            'ajaxOptions' => array(
                    'success' => 'function(html) {$.fn.yiiGridView.update(\'ppxt-person-xtype-grid\');}'
                    ),
            'htmlOptions' => array(
                'title' => Yii::t('D2personModule.crud_static', 'Add new record'),
                'data-toggle' => 'tooltip',
            ),                 
        )
    );        
    ?>
</div>
 
<?php 

    if (empty($modelMain->ppxtPersonXTypes)) {
        $model = new PpxtPersonXType;
        $model->ppxt_pprs_id = $modelMain->primaryKey;
        $model->save();
        unset($model);
    } 
    
    $model = new PpxtPersonXType();
    $model->ppxt_pprs_id = $modelMain->primaryKey;

    // render grid view

    $this->widget('TbGridView',
        array(
            'id' => 'ppxt-person-xtype-grid',
            'dataProvider' => $model->search(),
            'template' => '{summary}{items}',
            'summaryText' => '&nbsp;',
            'htmlOptions' => array(
                'class' => 'rel-grid-view'
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
                    'deleteConfirmation'=>Yii::t('D2personModule.crud_static','Do you want to delete this item?'),   
                    'deleteButtonOptions'=>array('data-toggle'=>'tooltip'),                    
                ),
            )
        )
    );
    ?>

<?php
    Yii::endProfile('PpxtPersonXType.view.grid');
}    
?>
<?php
if(!$ajax || $ajax == 'ppxs-person-xsetting-grid'){
    Yii::beginProfile('ppxs_pprs_id.view.grid');
?>

<div class="table-header">
    <?=Yii::t('D2personModule.model', 'Ppxs Person Xsetting')?>
    <?php    
        
    $this->widget(
        'bootstrap.widgets.TbButton',
        array(
            'buttonType' => 'ajaxButton', 
            'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size' => 'mini',
            'icon' => 'icon-plus',
            'url' => array(
                '//d2person/ppxsPersonXSetting/ajaxCreate',
                'field' => 'ppxs_pprs_id',
                'value' => $modelMain->primaryKey,
                'ajax' => 'ppxs-person-xsetting-grid',
            ),
            'ajaxOptions' => array(
                    'success' => 'function(html) {$.fn.yiiGridView.update(\'ppxs-person-xsetting-grid\');}'
                    ),
            'htmlOptions' => array(
                'title' => Yii::t('D2personModule.crud', 'Add new record'),
                'data-toggle' => 'tooltip',
            ),                 
        )
    );        
    ?>
</div>
 
<?php 

    if (empty($modelMain->ppxsPersonXSettings)) {
        $model = new PpxsPersonXSetting;
        $model->ppxs_pprs_id = $modelMain->primaryKey;
        $model->save();
        unset($model);
    } 
    
    $model = new PpxsPersonXSetting();
    $model->ppxs_pprs_id = $modelMain->primaryKey;

    // render grid view

    $this->widget('TbGridView',
        array(
            'id' => 'ppxs-person-xsetting-grid',
            'dataProvider' => $model->search(),
            'template' => '{summary}{items}',
            'summaryText' => '&nbsp;',
            'htmlOptions' => array(
                'class' => 'rel-grid-view'
            ),            
            'columns' => array(
                array(
                'class' => 'editable.EditableColumn',
                'name' => 'ppxs_psty_id',
                'editable' => array(
                    'type' => 'select',
                    'url' => $this->createUrl('//d2person/ppxsPersonXSetting/editableSaver'),
                    'source' => CHtml::listData(PstySettingType::model()->findAll(array('limit' => 1000)), 'psty_id', 'itemLabel'),
                    //'placement' => 'right',
                )
            ),
            array(
                //varchar(256)
                'class' => 'editable.EditableColumn',
                'name' => 'ppxs_value',
                'editable' => array(
                    'url' => $this->createUrl('//d2person/ppxsPersonXSetting/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'ppxs_notes',
                'editable' => array(
                    'type' => 'textarea',
                    'url' => $this->createUrl('//d2person/ppxsPersonXSetting/editableSaver'),
                    //'placement' => 'right',
                )
            ),
//            array(
//                //tinyint(3) unsigned
//                'class' => 'editable.EditableColumn',
//                'name' => 'ppxs_hidded',
//                'editable' => array(
//                    'url' => $this->createUrl('//d2person/ppxsPersonXSetting/editableSaver'),
//                    //'placement' => 'right',
//                )
//            ),

                array(
                    'class' => 'TbButtonColumn',
                    'buttons' => array(
                        'view' => array('visible' => 'FALSE'),
                        'update' => array('visible' => 'FALSE'),
                        'delete' => array('visible' => 'Yii::app()->user->checkAccess("D2person.PprsPerson.DeleteppxsPersonXSettings")'),
                    ),
                    'deleteButtonUrl' => 'Yii::app()->controller->createUrl("/d2person/ppxsPersonXSetting/delete", array("ppxs_id" => $data->ppxs_id))',
                    'deleteConfirmation'=>Yii::t('D2personModule.crud','Do you want to delete this item?'),   
                    'deleteButtonOptions'=>array('data-toggle'=>'tooltip'),                    
                ),
            )
        )
    );
    ?>

<?php
    Yii::endProfile('PpxsPersonXSetting.view.grid');
}    
?>
