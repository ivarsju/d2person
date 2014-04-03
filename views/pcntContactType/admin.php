
<?php
$this->breadcrumbs[] = Yii::t('crud','Pcnt Contact Types');
Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
        $('.search-form').toggle();
        return false;
    });
    $('.search-form form').submit(function(){
        $.fn.yiiGridView.update(
            'pcnt-contact-type-grid',
            {data: $(this).serialize()}
        );
        return false;
    });
    ");
?>

<?php $this->widget("TbBreadcrumbs", array("links"=>$this->breadcrumbs)) ?>
<h1>
    
    <?php echo Yii::t('crud', 'Pcnt Contact Types'); ?>
    <small><?php echo Yii::t('crud', 'Manage'); ?></small>
    
</h1>

<?php $this->renderPartial("_toolbar", array("model"=>$model)); ?>



<?php
$this->widget('TbGridView',
    array(
        'id'=>'pcnt-contact-type-grid',
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
                'urlExpression'=> 'Yii::app()->controller->createUrl("view", array("pcnt_id" => $data["pcnt_id"]))'
            ),
                    array(
            'class' => 'editable.EditableColumn',
            'name' => 'pcnt_id',
            'editable' => array(
                'url' => $this->createUrl('/d2person/pcntContactType/editableSaver'),
                //'placement' => 'right',
            )
        ),
        array(
            'class' => 'editable.EditableColumn',
            'name' => 'pcnt_name',
            'editable' => array(
                'url' => $this->createUrl('/d2person/pcntContactType/editableSaver'),
                //'placement' => 'right',
            )
        ),

            array(
                'class'=>'TbButtonColumn',
                'buttons' => array(
                    'view' => array('visible' => 'Yii::app()->user->checkAccess("D2person.PcntContactType.View")'),
                    'update' => array('visible' => 'Yii::app()->user->checkAccess("D2person.PcntContactType.Update")'),
                    'delete' => array('visible' => 'Yii::app()->user->checkAccess("D2person.PcntContactType.Delete")'),
                ),
                'viewButtonUrl'   => 'Yii::app()->controller->createUrl("view", array("pcnt_id" => $data->pcnt_id))',
                'updateButtonUrl' => 'Yii::app()->controller->createUrl("update", array("pcnt_id" => $data->pcnt_id))',
                'deleteButtonUrl' => 'Yii::app()->controller->createUrl("delete", array("pcnt_id" => $data->pcnt_id))',
            ),
        )
    )
);
?>