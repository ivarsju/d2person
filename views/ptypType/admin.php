<?php
$this->setPageTitle(Yii::t('D2personModule.model', 'Person Types'));
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
             'visible'=>(Yii::app()->user->checkAccess('D2person.PtypType.*') || Yii::app()->user->checkAccess('D2person.PtypType.Create'))
        ));  
        ?>
</div>
        <div class="btn-group">
            <h1>
                <i class=""></i>
                <?php echo Yii::t('D2personModule.model', 'Person Types');?>
            </h1>
        </div>
    </div>
</div>

<?php Yii::beginProfile('PtypType.view.grid'); ?>


<?php
$this->widget('TbGridView',
    array(
        'id' => 'ptyp-type-grid',
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
                //char(50)
                'class' => 'editable.EditableColumn',
                'name' => 'ptyp_name',
                'editable' => array(
                    'url' => $this->createUrl('/d2person/ptypType/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                //tinyint(3) unsigned
                'class' => 'editable.EditableColumn',
                'name' => 'ptyp_hidden',
                'editable' => array(
                    'url' => $this->createUrl('/d2person/ptypType/editableSaver'),
                    //'placement' => 'right',
                )
            ),

//            array(
//                'class' => 'TbButtonColumn',
//                'buttons' => array(
//                    'view' => array('visible' => 'Yii::app()->user->checkAccess("D2person.PtypType.View")'),
//                    'update' => array('visible' => 'FALSE'),
//                    'delete' => array('visible' => 'Yii::app()->user->checkAccess("D2person.PtypType.Delete")'),
//                ),
//                'viewButtonUrl' => 'Yii::app()->controller->createUrl("view", array("ptyp_id" => $data->ptyp_id))',
//                'deleteButtonUrl' => 'Yii::app()->controller->createUrl("delete", array("ptyp_id" => $data->ptyp_id))',
//                'deleteConfirmation'=>Yii::t('D2personModule.crud_static','Do you want to delete this item?'),                    
//                'viewButtonOptions'=>array('data-toggle'=>'tooltip'),   
//                'deleteButtonOptions'=>array('data-toggle'=>'tooltip'),   
//            ),
        )
    )
);
Yii::endProfile('PtypType.view.grid');