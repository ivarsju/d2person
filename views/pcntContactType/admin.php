<?php
$this->setPageTitle(Yii::t('D2personModule.model', 'Contact Types'));
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
             'visible'=>(Yii::app()->user->checkAccess('D2person.PcntContactType.*') || Yii::app()->user->checkAccess('D2person.PcntContactType.Create'))
        ));
        ?>
</div>
        <div class="btn-group">
            <h1>
                <i class=""></i>
                <?php echo Yii::t('D2personModule.model', 'Contact Types');?>            </h1>
        </div>
    </div>
</div>

<?php Yii::beginProfile('PcntContactType.view.grid'); ?>

<?php
$this->widget('TbGridView',
    array(
        'id' => 'pcnt-contact-type-grid',
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
                //char(40)
                'class' => 'editable.EditableColumn',
                'name' => 'pcnt_name',
                'editable' => array(
                    'url' => $this->createUrl('/d2person/pcntContactType/editableSaver'),
                    //'placement' => 'right',
                )
            ),

//            array(
//                'class' => 'TbButtonColumn',
//                'buttons' => array(
//                    'view' => array('visible' => 'Yii::app()->user->checkAccess("D2person.PcntContactType.View")'),
//                    'update' => array('visible' => 'FALSE'),
//                    'delete' => array('visible' => 'Yii::app()->user->checkAccess("D2person.PcntContactType.Delete")'),
//                ),
//                'viewButtonUrl' => 'Yii::app()->controller->createUrl("view", array("pcnt_id" => $data->pcnt_id))',
//                'deleteButtonUrl' => 'Yii::app()->controller->createUrl("delete", array("pcnt_id" => $data->pcnt_id))',
//                'deleteConfirmation'=>Yii::t('D2personModule.crud_static','Do you want to delete this item?'),
//                'viewButtonOptions'=>array('data-toggle'=>'tooltip'),
//                'deleteButtonOptions'=>array('data-toggle'=>'tooltip'),
//            ),
        )
    )
);
?>
<?php Yii::endProfile('PcntContactType.view.grid'); ?>
