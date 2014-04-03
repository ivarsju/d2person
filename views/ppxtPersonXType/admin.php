
<?php
$this->breadcrumbs[] = Yii::t('crud','Ppxt Person Xtypes');
Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
        $('.search-form').toggle();
        return false;
    });
    $('.search-form form').submit(function(){
        $.fn.yiiGridView.update(
            'ppxt-person-xtype-grid',
            {data: $(this).serialize()}
        );
        return false;
    });
    ");
?>

<?php $this->widget("TbBreadcrumbs", array("links"=>$this->breadcrumbs)) ?>
<h1>
    
    <?php echo Yii::t('crud', 'Ppxt Person Xtypes'); ?>
    <small><?php echo Yii::t('crud', 'Manage'); ?></small>
    
</h1>

<?php $this->renderPartial("_toolbar", array("model"=>$model)); ?>



<?php
$this->widget('TbGridView',
    array(
        'id'=>'ppxt-person-xtype-grid',
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
                'urlExpression'=> 'Yii::app()->controller->createUrl("view", array("ppxt_id" => $data["ppxt_id"]))'
            ),
                    array(
            'class' => 'editable.EditableColumn',
            'name' => 'ppxt_id',
            'editable' => array(
                'url' => $this->createUrl('/d2person/ppxtPersonXType/editableSaver'),
                //'placement' => 'right',
            )
        ),
        array(
                    'name'=>'ppxt_pprs_id',
                    'value'=>'CHtml::value($data,\'ppxtPprs.itemLabel\')',
                            'filter'=>CHtml::listData(PprsPerson::model()->findAll(array('limit'=>1000)), 'pprs_id', 'itemLabel'),
                            ),
        array(
                    'name'=>'ppxt_ptyp_id',
                    'value'=>'CHtml::value($data,\'ppxtPtyp.itemLabel\')',
                            'filter'=>CHtml::listData(PtypType::model()->findAll(array('limit'=>1000)), 'ptyp_id', 'itemLabel'),
                            ),

            array(
                'class'=>'TbButtonColumn',
                'buttons' => array(
                    'view' => array('visible' => 'Yii::app()->user->checkAccess("D2person.PpxtPersonXType.View")'),
                    'update' => array('visible' => 'Yii::app()->user->checkAccess("D2person.PpxtPersonXType.Update")'),
                    'delete' => array('visible' => 'Yii::app()->user->checkAccess("D2person.PpxtPersonXType.Delete")'),
                ),
                'viewButtonUrl'   => 'Yii::app()->controller->createUrl("view", array("ppxt_id" => $data->ppxt_id))',
                'updateButtonUrl' => 'Yii::app()->controller->createUrl("update", array("ppxt_id" => $data->ppxt_id))',
                'deleteButtonUrl' => 'Yii::app()->controller->createUrl("delete", array("ppxt_id" => $data->ppxt_id))',
            ),
        )
    )
);
?>