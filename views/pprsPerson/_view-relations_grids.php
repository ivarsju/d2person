<?php

if (!$ajax) {
    Yii::app()->clientScript->registerCss('rel_grid','
            .rel-grid-view {margin-top:-60px;}
            .rel-grid-view div.summary {height: 60px;}
            ');
}

if ((!$ajax || $ajax == 'ccuc-user-company-grid') 
        && Yii::app()->user->checkAccess("D2company.CcucUserCompany.View")) {

    Yii::beginProfile('ccuc_person_id.view.grid');
?>

<div class="table-header">
    <?=Yii::t('D2personModule.model', 'Ccuc User Company')?>
    <?php
    if(Yii::app()->user->checkAccess("D2company.CcucUserCompany.Create")){
        $this->widget(
            'bootstrap.widgets.TbButton',
            array(
                'buttonType' => 'ajaxButton',
                'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                'size' => 'mini',
                'icon' => 'icon-plus',
                'url' => array(
                    '//d2company/ccucUserCompany/ajaxCreate',
                    'field' => 'ccuc_person_id',
                    'value' => $modelMain->primaryKey,
                    'ajax' => 'ccuc-user-company-grid',
                ),
                'ajaxOptions' => array(
                        'success' => 'function (html) {$.fn.yiiGridView.update(\'ccuc-user-company-grid\');}'
                        ),
                'htmlOptions' => array(
                    'title' => Yii::t('D2personModule.crud_static', 'Add new record'),
                    'data-toggle' => 'tooltip',
                ),
            )
        );
    }
    ?>
</div>

<?php
    $criteria = new CDbCriteria;
    $criteria->compare('ccuc_person_id',$modelMain->primaryKey);
    $criteria->compare('ccuc_status',CcucUserCompany::CCUC_STATUS_PERSON);
    $m = CcucUserCompany::model()->find($criteria);
    if (empty($m)) {
        $model = new CcucUserCompany;
        $model->ccuc_person_id = $modelMain->primaryKey;
        $model->ccuc_status = CcucUserCompany::CCUC_STATUS_PERSON;            
        $model->save();
        unset($model);
    }

    $model = new CcucUserCompany();
    $model->ccuc_person_id = $modelMain->primaryKey;
    $model->ccuc_status = CcucUserCompany::CCUC_STATUS_PERSON;    

    // render grid view
    $can_edit_ccuc = Yii::app()->user->checkAccess("D2company.CcucUserCompany.Update");    
    $bft = (!$can_edit_ccuc)?'false':'true';
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
                'value' => '(!'.$bft.' && !empty($data->ccuc_ccmp_id))?$data->ccucCcmp->itemLabel:""',
                'editable' => array(
                    'type' => 'select',
                    'url' => $this->createUrl('//d2company/ccucUserCompany/editableSaver'),
                    'source' => CHtml::listData(CcmpCompany::model()->findAll(array('limit' => 1000,'order'=>'ccmp_name')), 'ccmp_id', 'itemLabel'),
                    'apply' => $can_edit_ccuc,                    
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'ccuc_cucp_id',
                'value' => '(!'.$bft.' && !empty($data->ccuc_cucp_id))?$data->ccucCucp->cucp_name:""',                
                'editable' => array(
                    'type' => 'select',
                    'url' => $this->createUrl('//d2company/ccucUserCompany/editableSaver'),
                    'source' => CHtml::listData(CucpUserCompanyPosition::model()->findAll(array('limit' => 1000)), 'cucp_id', 'itemLabel'),
                    'apply' => $can_edit_ccuc,
                    //'placement' => 'right',
                )
            ),                
//            array(
//                    'class' => 'editable.EditableColumn',
//                    'name' => 'ccuc_status',
//                    'editable' => array(
//                        'type' => 'select',
//                        'url' => $this->createUrl('//d2person/ccucUserCompany/editableSaver'),
//                        'source' => $model->getEnumFieldLabels('ccuc_status'),
//                        //'placement' => 'right',
//                    ),
//                   'filter' => $model->getEnumFieldLabels('ccuc_status'),
//                ),

                array(
                    'class' => 'TbButtonColumn',
                    'buttons' => array(
                        'view' => array('visible' => 'FALSE'),
                        'update' => array('visible' => 'FALSE'),
                        'delete' => array('visible' => 'TRUE'),
                    ),
                    'deleteButtonUrl' => 'Yii::app()->controller->createUrl("/d2company/ccucUserCompany/delete", array("ccuc_id" => $data->ccuc_id))',
                    'deleteConfirmation'=>Yii::t('D2personModule.crud_static','Do you want to delete this item?'),
                    'deleteButtonOptions'=>array('data-toggle'=>'tooltip'),
                    'visible' => Yii::app()->user->checkAccess("D2company.CcucUserCompany.Delete"),
                ),
            )
        )
    );

    Yii::endProfile('CcucUserCompany.view.grid');
}

if ((!$ajax || $ajax == 'ppcn-person-contact-grid')
        && Yii::app()->user->checkAccess("D2person.PpcnPersonContact.View")) {
    $can_edit_ppcn = (boolean)Yii::app()->user->checkAccess("D2person.PpcnPersonContact.Update");     
    Yii::beginProfile('ppcn_pprs_id.view.grid');
?>

<div class="table-header">
    <?=Yii::t('D2personModule.model', 'Ppcn Person Contact')?>
    <?php
    if(Yii::app()->user->checkAccess("D2person.PpcnPersonContact.Create")){
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
                        'success' => 'function (html) {$.fn.yiiGridView.update(\'ppcn-person-contact-grid\');}'
                        ),
                'htmlOptions' => array(
                    'title' => Yii::t('D2personModule.crud_static', 'Add new record'),
                    'data-toggle' => 'tooltip',
                ),
            )
        );
    }
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
    $bft = (!$can_edit_ppcn)?'false':'true';
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
                'value' => '(!'.$bft.' && !empty($data->ppcn_pcnt_type))?$data->ppcnPcntType->pcnt_name:""',
                'editable' => array(
                    'type' => 'select',
                    'url' => $this->createUrl('//d2person/ppcnPersonContact/editableSaver'),
                    'source' => CHtml::listData(PcntContactType::model()->findAll(array('limit' => 1000)), 'pcnt_id', 'itemLabel'),
                    'apply' => $can_edit_ppcn,
                    //'placement' => 'right',
                )
            ),
            array(
                //varchar(500)
                'class' => 'editable.EditableColumn',
                'name' => 'ppcn_value',
                'editable' => array(
                    'url' => $this->createUrl('//d2person/ppcnPersonContact/editableSaver'),
                    'apply' => $can_edit_ppcn,
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'ppcn_notes',
                'editable' => array(
                    'type' => 'textarea',
                    'url' => $this->createUrl('//d2person/ppcnPersonContact/editableSaver'),
                    'apply' => $can_edit_ppcn,
                    //'placement' => 'right',
                ),
                
            ),
            array(
                'name' => 'ppcn_modified',
            ),

                array(
                    'class' => 'TbButtonColumn',
                    'buttons' => array(
                        'view' => array('visible' => 'FALSE'),
                        'update' => array('visible' => 'FALSE'),
                        'delete' => array('visible' => 'TRUE'),
                    ),
                    'deleteButtonUrl' => 'Yii::app()->controller->createUrl("/d2person/ppcnPersonContact/delete", array("ppcn_id" => $data->ppcn_id))',
                    'deleteConfirmation'=>Yii::t('D2personModule.crud_static','Do you want to delete this item?'),
                    'deleteButtonOptions'=>array('data-toggle'=>'tooltip'),
                    'visible' => Yii::app()->user->checkAccess("D2person.PpcnPersonContact.Delete"),
                ),
            )
        )
    );

    Yii::endProfile('PpcnPersonContact.view.grid');
}

if ((!$ajax || $ajax == 'ppxd-person-xdocument-grid')
        && Yii::app()->user->checkAccess("D2person.PpxdPersonXDocument.View")) {
    Yii::beginProfile('ppxd_pprs_id.view.grid');
?>

<div class="table-header">
    <?=Yii::t('D2personModule.model', 'Ppxd Person Xdocument')?>
    <?php
    if(Yii::app()->user->checkAccess("D2person.PpxdPersonXDocument.Create")){
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
                        'success' => 'function (html) {$.fn.yiiGridView.update(\'ppxd-person-xdocument-grid\');}'
                        ),
                'htmlOptions' => array(
                    'title' => Yii::t('D2personModule.crud_static', 'Add new record'),
                    'data-toggle' => 'tooltip',
                ),
            )
        );
    }
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
    $can_edit_ppxd = Yii::app()->user->checkAccess("D2person.PpxdPersonXDocument.Update");         
    $bft = (!$can_edit_ppxd)?'false':'true';    
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
                'value' => '(!'.$bft.' && !empty($data->ppxd_pdcm_id))?$data->ppxdPdcm->pdcm_name:""',                    
                'editable' => array(
                    'type' => 'select',
                    'url' => $this->createUrl('//d2person/ppxdPersonXDocument/editableSaver'),
                    'source' => CHtml::listData(PdcmDocumentType::model()->findAll(array('limit' => 1000)), 'pdcm_id', 'itemLabel'),
                    'apply' => $can_edit_ppxd,
                    //'placement' => 'right',
                )
            ),
            array(
                //varchar(100)
                'class' => 'editable.EditableColumn',
                'name' => 'ppxd_number',
                'editable' => array(
                    'url' => $this->createUrl('//d2person/ppxdPersonXDocument/editableSaver'),
                    'apply' => $can_edit_ppxd,
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'ppxd_issue_date',
                'editable' => array(
                    'type' => 'date',
                    'url' => $this->createUrl('//d2person/ppxdPersonXDocument/editableSaver'),
                    'apply' => $can_edit_ppxd,
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'ppxd_expire_date',
                'editable' => array(
                    'type' => 'date',
                    'url' => $this->createUrl('//d2person/ppxdPersonXDocument/editableSaver'),
                    'apply' => $can_edit_ppxd,
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'ppxd_notes',
                'editable' => array(
                    'type' => 'textarea',
                    'url' => $this->createUrl('//d2person/ppxdPersonXDocument/editableSaver'),
                    'apply' => $can_edit_ppxd,
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
                        'apply' => $can_edit_ppxd,
                        //'placement' => 'right',
                    ),
                ),

                array(
                    'class' => 'TbButtonColumn',
                    'buttons' => array(
                        'view' => array('visible' => 'FALSE'),
                        'update' => array('visible' => 'FALSE'),
                        'delete' => array('visible' => 'TRUE'),
                    ),
                    'deleteButtonUrl' => 'Yii::app()->controller->createUrl("/d2person/ppxdPersonXDocument/delete", array("ppxd_id" => $data->ppxd_id))',
                    'deleteConfirmation'=>Yii::t('D2personModule.crud_static','Do you want to delete this item?'),
                    'deleteButtonOptions'=>array('data-toggle'=>'tooltip'),
                    'visible' => Yii::app()->user->checkAccess("D2person.PpxdPersonXDocument.Delete"),
                ),
            )
        )
    );

    Yii::endProfile('PpxdPersonXDocument.view.grid');
}

if ((!$ajax || $ajax == 'ppxt-person-xtype-grid')
        && Yii::app()->user->checkAccess("D2person.PpxtPersonXType.View")) {
    $can_edit_ppxt = Yii::app()->user->checkAccess("D2person.PpxtPersonXType.Update");             
    $bft = (!$can_edit_ppxt)?'false':'true'; 
    Yii::beginProfile('ppxt_pprs_id.view.grid');
?>

<div class="table-header">
    <?=Yii::t('D2personModule.model', 'Ppxt Person Xtype')?>
    <?php
    //D2person.PpxtPersonXType.Create
    if(Yii::app()->user->checkAccess("D2person.PpxtPersonXType.Create")){
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
                        'success' => 'function (html) {$.fn.yiiGridView.update(\'ppxt-person-xtype-grid\');}'
                        ),
                'htmlOptions' => array(
                    'title' => Yii::t('D2personModule.crud_static', 'Add new record'),
                    'data-toggle' => 'tooltip',
                ),
            )
        );
    }    
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
                'value' => '(!'.$bft.' && !empty($data->ppxt_ptyp_id))?$data->ppxtPtyp->ptyp_name:""',
                'editable' => array(
                    'type' => 'select',
                    'url' => $this->createUrl('//d2person/ppxtPersonXType/editableSaver'),
                    'source' => CHtml::listData(PtypType::model()->findAll(array('limit' => 1000)), 'ptyp_id', 'itemLabel'),
                    'apply' => $can_edit_ppxt,                    
                    //'placement' => 'right',
                )
            ),

                array(
                    'class' => 'TbButtonColumn',
                    'buttons' => array(
                        'view' => array('visible' => 'FALSE'),
                        'update' => array('visible' => 'FALSE'),
                        'delete' => array('visible' => 'TRUE'),
                    ),
                    'deleteButtonUrl' => 'Yii::app()->controller->createUrl("/d2person/ppxtPersonXType/delete", array("ppxt_id" => $data->ppxt_id))',
                    'deleteConfirmation'=>Yii::t('D2personModule.crud_static','Do you want to delete this item?'),
                    'deleteButtonOptions'=>array('data-toggle'=>'tooltip'),
                    'visible' => Yii::app()->user->checkAccess("D2person.PpxtPersonXType.Delete"),
                ),
            )
        )
    );

    Yii::endProfile('PpxtPersonXType.view.grid');
}

if ((!$ajax || $ajax == 'ppxs-person-xsetting-grid')
        && Yii::app()->user->checkAccess("D2person.PpxsPersonXSetting.View")) {
    Yii::beginProfile('ppxs_pprs_id.view.grid');
?>

<div class="table-header">
    <?=Yii::t('D2personModule.model', 'Ppxs Person Xsetting')?>
    <?php
    if(Yii::app()->user->checkAccess("D2person.PpxsPersonXSetting.Create")){
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
                        'success' => 'function (html) {$.fn.yiiGridView.update(\'ppxs-person-xsetting-grid\');}'
                        ),
                'htmlOptions' => array(
                    'title' => Yii::t('D2personModule.crud_static', 'Add new record'),
                    'data-toggle' => 'tooltip',
                ),
            )
        );
    }    
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
    $can_edit_ppxs = Yii::app()->user->checkAccess("D2person.PpxsPersonXSetting.Update");     
    $bft = (!$can_edit_ppxs)?'false':'true'; 
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
                'value' => '(!'.$bft.' && !empty($data->ppxs_psty_id))?$data->ppxsPsty->itemLabel:""',
                'editable' => array(
                    'type' => 'select',
                    'url' => $this->createUrl('//d2person/ppxsPersonXSetting/editableSaver'),
                    'source' => CHtml::listData(PstySettingType::model()->findAll(array('limit' => 1000)), 'psty_id', 'itemLabel'),
                    'apply' => $can_edit_ppxs,
                    //'placement' => 'right',
                )
            ),
            array(
                //varchar(256)
                'class' => 'editable.EditableColumn',
                'name' => 'ppxs_value',
                'editable' => array(
                    'url' => $this->createUrl('//d2person/ppxsPersonXSetting/editableSaver'),
                    'apply' => $can_edit_ppxs,
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'ppxs_notes',
                'editable' => array(
                    'type' => 'textarea',
                    'url' => $this->createUrl('//d2person/ppxsPersonXSetting/editableSaver'),
                    'apply' => $can_edit_ppxs,
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
                        'delete' => array('visible' => 'TRUE'),
                    ),
                    'deleteButtonUrl' => 'Yii::app()->controller->createUrl("/d2person/ppxsPersonXSetting/delete", array("ppxs_id" => $data->ppxs_id))',
                    'deleteConfirmation'=>Yii::t('D2personModule.crud_static','Do you want to delete this item?'),
                    'deleteButtonOptions'=>array('data-toggle'=>'tooltip'),
                    'visible' => Yii::app()->user->checkAccess("D2person.PpxsPersonXSetting.Delete"),
                ),
            )
        )
    );

    Yii::endProfile('PpxsPersonXSetting.view.grid');
}