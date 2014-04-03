
<?php
$this->breadcrumbs[] = Yii::t('crud','Ppxd Person Xdocuments');
Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
        $('.search-form').toggle();
        return false;
    });
    $('.search-form form').submit(function(){
        $.fn.yiiGridView.update(
            'ppxd-person-xdocument-grid',
            {data: $(this).serialize()}
        );
        return false;
    });
    ");
?>

<?php $this->widget("TbBreadcrumbs", array("links"=>$this->breadcrumbs)) ?>
<h1>
    
    <?php echo Yii::t('crud', 'Ppxd Person Xdocuments'); ?>
    <small><?php echo Yii::t('crud', 'Manage'); ?></small>
    
</h1>

<?php $this->renderPartial("_toolbar", array("model"=>$model)); ?>



<?php
$this->widget('TbGridView',
    array(
        'id'=>'ppxd-person-xdocument-grid',
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
                'urlExpression'=> 'Yii::app()->controller->createUrl("view", array("ppxd_id" => $data["ppxd_id"]))'
            ),
                    array(
            'class' => 'editable.EditableColumn',
            'name' => 'ppxd_id',
            'editable' => array(
                'url' => $this->createUrl('/d2person/ppxdPersonXDocument/editableSaver'),
                //'placement' => 'right',
            )
        ),
        array(
                    'name'=>'ppxd_pprs_id',
                    'value'=>'CHtml::value($data,\'ppxdPprs.itemLabel\')',
                            'filter'=>CHtml::listData(PprsPerson::model()->findAll(array('limit'=>1000)), 'pprs_id', 'itemLabel'),
                            ),
        array(
                    'name'=>'ppxd_pdcm_id',
                    'value'=>'CHtml::value($data,\'ppxdPdcm.itemLabel\')',
                            'filter'=>CHtml::listData(PdcmDocumentType::model()->findAll(array('limit'=>1000)), 'pdcm_id', 'itemLabel'),
                            ),
        array(
            'class' => 'editable.EditableColumn',
            'name' => 'ppxd_number',
            'editable' => array(
                'url' => $this->createUrl('/d2person/ppxdPersonXDocument/editableSaver'),
                //'placement' => 'right',
            )
        ),
        array(
            'class' => 'editable.EditableColumn',
            'name' => 'ppxd_issue_date',
            'editable' => array(
                'url' => $this->createUrl('/d2person/ppxdPersonXDocument/editableSaver'),
                //'placement' => 'right',
            )
        ),
        array(
            'class' => 'editable.EditableColumn',
            'name' => 'ppxd_expire_date',
            'editable' => array(
                'url' => $this->createUrl('/d2person/ppxdPersonXDocument/editableSaver'),
                //'placement' => 'right',
            )
        ),
        #'ppxd_notes',
        array(
            'class' => 'editable.EditableColumn',
            'name' => 'ppxd_status',
            'editable' => array(
                'url' => $this->createUrl('/d2person/ppxdPersonXDocument/editableSaver'),
                //'placement' => 'right',
            )
        ),

            array(
                'class'=>'TbButtonColumn',
                'buttons' => array(
                    'view' => array('visible' => 'Yii::app()->user->checkAccess("D2person.PpxdPersonXDocument.View")'),
                    'update' => array('visible' => 'Yii::app()->user->checkAccess("D2person.PpxdPersonXDocument.Update")'),
                    'delete' => array('visible' => 'Yii::app()->user->checkAccess("D2person.PpxdPersonXDocument.Delete")'),
                ),
                'viewButtonUrl'   => 'Yii::app()->controller->createUrl("view", array("ppxd_id" => $data->ppxd_id))',
                'updateButtonUrl' => 'Yii::app()->controller->createUrl("update", array("ppxd_id" => $data->ppxd_id))',
                'deleteButtonUrl' => 'Yii::app()->controller->createUrl("delete", array("ppxd_id" => $data->ppxd_id))',
            ),
        )
    )
);
?>