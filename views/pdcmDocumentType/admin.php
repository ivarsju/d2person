
<?php
$this->breadcrumbs[] = Yii::t('crud','Pdcm Document Types');
Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
        $('.search-form').toggle();
        return false;
    });
    $('.search-form form').submit(function(){
        $.fn.yiiGridView.update(
            'pdcm-document-type-grid',
            {data: $(this).serialize()}
        );
        return false;
    });
    ");
?>

<?php $this->widget("TbBreadcrumbs", array("links"=>$this->breadcrumbs)) ?>
<h1>
    
    <?php echo Yii::t('crud', 'Pdcm Document Types'); ?>
    <small><?php echo Yii::t('crud', 'Manage'); ?></small>
    
</h1>

<?php $this->renderPartial("_toolbar", array("model"=>$model)); ?>



<?php
$this->widget('TbGridView',
    array(
        'id'=>'pdcm-document-type-grid',
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
                'urlExpression'=> 'Yii::app()->controller->createUrl("view", array("pdcm_id" => $data["pdcm_id"]))'
            ),
                    array(
            'class' => 'editable.EditableColumn',
            'name' => 'pdcm_id',
            'editable' => array(
                'url' => $this->createUrl('/d2person/pdcmDocumentType/editableSaver'),
                //'placement' => 'right',
            )
        ),
        array(
            'class' => 'editable.EditableColumn',
            'name' => 'pdcm_name',
            'editable' => array(
                'url' => $this->createUrl('/d2person/pdcmDocumentType/editableSaver'),
                //'placement' => 'right',
            )
        ),
        array(
            'class' => 'editable.EditableColumn',
            'name' => 'pdcm_hidded',
            'editable' => array(
                'url' => $this->createUrl('/d2person/pdcmDocumentType/editableSaver'),
                //'placement' => 'right',
            )
        ),

            array(
                'class'=>'TbButtonColumn',
                'buttons' => array(
                    'view' => array('visible' => 'Yii::app()->user->checkAccess("D2person.PdcmDocumentType.View")'),
                    'update' => array('visible' => 'Yii::app()->user->checkAccess("D2person.PdcmDocumentType.Update")'),
                    'delete' => array('visible' => 'Yii::app()->user->checkAccess("D2person.PdcmDocumentType.Delete")'),
                ),
                'viewButtonUrl'   => 'Yii::app()->controller->createUrl("view", array("pdcm_id" => $data->pdcm_id))',
                'updateButtonUrl' => 'Yii::app()->controller->createUrl("update", array("pdcm_id" => $data->pdcm_id))',
                'deleteButtonUrl' => 'Yii::app()->controller->createUrl("delete", array("pdcm_id" => $data->pdcm_id))',
            ),
        )
    )
);
?>