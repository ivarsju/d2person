
<?php
$this->breadcrumbs[] = Yii::t('crud','Ptyp Types');
Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
        $('.search-form').toggle();
        return false;
    });
    $('.search-form form').submit(function(){
        $.fn.yiiGridView.update(
            'ptyp-type-grid',
            {data: $(this).serialize()}
        );
        return false;
    });
    ");
?>

<?php $this->widget("TbBreadcrumbs", array("links"=>$this->breadcrumbs)) ?>
<h1>
    
    <?php echo Yii::t('crud', 'Ptyp Types'); ?>
    <small><?php echo Yii::t('crud', 'Manage'); ?></small>
    
</h1>

<?php $this->renderPartial("_toolbar", array("model"=>$model)); ?>



<?php
$this->widget('TbGridView',
    array(
        'id'=>'ptyp-type-grid',
        'dataProvider'=>$model->search(),
        'filter'=>$model,
        'template'=>'{pager}{summary}{items}{pager}',
        'pager' => array(
            'class' => 'TbPager',
            'displayFirstAndLast' => true,
        ),
        'columns'=> array(
            array(
                'class'=>'CLinkColumn',
                'header'=>'',
                'labelExpression'=> '$data->itemLabel',
                'urlExpression'=> 'Yii::app()->controller->createUrl("view", array("ptyp_id" => $data["ptyp_id"]))'
            ),
                    array(
            'class' => 'editable.EditableColumn',
            'name' => 'ptyp_id',
            'editable' => array(
                'url' => $this->createUrl('/d2person/ptypType/editableSaver'),
                //'placement' => 'right',
            )
        ),
        array(
            'class' => 'editable.EditableColumn',
            'name' => 'ptyp_name',
            'editable' => array(
                'url' => $this->createUrl('/d2person/ptypType/editableSaver'),
                //'placement' => 'right',
            )
        ),
        array(
            'class' => 'editable.EditableColumn',
            'name' => 'ptyp_hidden',
            'editable' => array(
                'url' => $this->createUrl('/d2person/ptypType/editableSaver'),
                //'placement' => 'right',
            )
        ),

            array(
                'class'=>'TbButtonColumn',
                'buttons' => array(
                    'view' => array('visible' => 'Yii::app()->user->checkAccess("D2person.PtypType.View")'),
                    'update' => array('visible' => 'Yii::app()->user->checkAccess("D2person.PtypType.Update")'),
                    'delete' => array('visible' => 'Yii::app()->user->checkAccess("D2person.PtypType.Delete")'),
                ),
                'viewButtonUrl'   => 'Yii::app()->controller->createUrl("view", array("ptyp_id" => $data->ptyp_id))',
                'updateButtonUrl' => 'Yii::app()->controller->createUrl("update", array("ptyp_id" => $data->ptyp_id))',
                'deleteButtonUrl' => 'Yii::app()->controller->createUrl("delete", array("ptyp_id" => $data->ptyp_id))',
            ),
        )
    )
);
?>