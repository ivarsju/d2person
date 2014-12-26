<?php
$this->setPageTitle(Yii::t('D2personModule.model', 'Persons Document Types'));
?>

<div class="clearfix">
    <div class="btn-toolbar pull-left">
        <div class="btn-group">
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
             'label'=>Yii::t('D2personModule.crud_static','Create'),
             'icon'=>'icon-plus',
             'size'=>'large',
             'type'=>'success',
             'url'=>array('create'),
        ));
        ?>
</div>
        <div class="btn-group">
            <h1>
                <i class=""></i>
                <?php echo Yii::t('D2personModule.model', 'Persons Document Types');?></h1>
        </div>
    </div>
</div>

<?php Yii::beginProfile('PdcmDocumentType.view.grid'); ?>

<?php
$this->widget('TbGridView',
    array(
        'id' => 'pdcm-document-type-grid',
        'dataProvider' => $model->search(),
        'filter' => $model,
        #'responsiveTable' => true,
        'template' => '{summary}{pager}{items}{pager}',
        'pager' => array(
            'class' => 'TbPager',
            'displayFirstAndLast' => true,
        ),
        'columns' => array(
            array(
                //varchar(50)
                'class' => 'editable.EditableColumn',
                'name' => 'pdcm_name',
                'editable' => array(
                    'url' => $this->createUrl('/d2person/pdcmDocumentType/editableSaver'),
                    'placement' => 'right',
                )
            ),
            array(
                //tinyint(4)
                'class' => 'editable.EditableColumn',
                'name' => 'pdcm_hidded',
                'editable' => array(
                    'url' => $this->createUrl('/d2person/pdcmDocumentType/editableSaver'),
                    //'placement' => 'right',
                )
            ),

//            array(
//                'class' => 'TbButtonColumn',
//                'buttons' => array(
//                    'view' => array('visible' => 'Yii::app()->user->checkAccess("D2person.PdcmDocumentType.View")'),
//                    'update' => array('visible' => 'FALSE'),
//                    'delete' => array('visible' => 'Yii::app()->user->checkAccess("D2person.PdcmDocumentType.Delete")'),
//                ),
//                'viewButtonUrl' => 'Yii::app()->controller->createUrl("view", array("pdcm_id" => $data->pdcm_id))',
//                'deleteButtonUrl' => 'Yii::app()->controller->createUrl("delete", array("pdcm_id" => $data->pdcm_id))',
//                'deleteConfirmation'=>Yii::t('D2personModule.crud_static','Do you want to delete this item?'),
//                'viewButtonOptions'=>array('data-toggle'=>'tooltip'),
//                'deleteButtonOptions'=>array('data-toggle'=>'tooltip'),
//            ),
        )
    )
);

Yii::endProfile('PdcmDocumentType.view.grid');
