<?php
$this->setPageTitle(
    Yii::t('D2personModule.model', 'Ppxd Person Xdocuments')
    . ' - '
    . Yii::t('D2personModule.crud_static', 'Manage')
);

$this->breadcrumbs[] = Yii::t('D2personModule.model', 'Ppxd Person Xdocuments');
Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function () {
        $('.search-form').toggle();

        return false;
    });
    $('.search-form form').submit(function () {
        $.fn.yiiGridView.update(
            'ppxd-person-xdocument-grid',
            {data: $(this).serialize()}
        );

        return false;
    });
    ");
?>

<?php $this->widget("TbBreadcrumbs", array("links" => $this->breadcrumbs)) ?>
    <h1>

        <?php echo Yii::t('D2personModule.model', 'Ppxd Person Xdocuments'); ?>
        <small><?php echo Yii::t('D2personModule.crud_static', 'Manage'); ?></small>

    </h1>

<?php $this->renderPartial("_toolbar", array("model" => $model)); ?>
<?php Yii::beginProfile('PpxdPersonXDocument.view.grid'); ?>

<?php
$this->widget('TbGridView',
    array(
        'id' => 'ppxd-person-xdocument-grid',
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
                'class' => 'CLinkColumn',
                'header' => '',
                'labelExpression' => '$data->itemLabel',
                'urlExpression' => 'Yii::app()->controller->createUrl("view", array("ppxd_id" => $data["ppxd_id"]))'
            ),
            array(
                //int(10) unsigned
                'class' => 'editable.EditableColumn',
                'name' => 'ppxd_id',
                'editable' => array(
                    'url' => $this->createUrl('/d2person/ppxdPersonXDocument/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'ppxd_pprs_id',
                'editable' => array(
                    'type' => 'select',
                    'url' => $this->createUrl('/d2person/ppxdPersonXDocument/editableSaver'),
                    'source' => CHtml::listData(PprsPerson::model()->findAll(array('limit' => 1000)), 'pprs_id', 'itemLabel'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'ppxd_pdcm_id',
                'editable' => array(
                    'type' => 'select',
                    'url' => $this->createUrl('/d2person/ppxdPersonXDocument/editableSaver'),
                    'source' => CHtml::listData(PdcmDocumentType::model()->findAll(array('limit' => 1000)), 'pdcm_id', 'itemLabel'),
                    //'placement' => 'right',
                )
            ),
            array(
                //varchar(100)
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
                    'type' => 'date',
                    'url' => $this->createUrl('/d2person/ppxdPersonXDocument/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'ppxd_expire_date',
                'editable' => array(
                    'type' => 'date',
                    'url' => $this->createUrl('/d2person/ppxdPersonXDocument/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'ppxd_notes',
                'editable' => array(
                    'type' => 'textarea',
                    'url' => $this->createUrl('/d2person/ppxdPersonXDocument/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                    'class' => 'editable.EditableColumn',
                    'name' => 'ppxd_status',
                    'editable' => array(
                        'type' => 'select',
                        'url' => $this->createUrl('/d2person/ppxdPersonXDocument/editableSaver'),
                        'source' => $model->getEnumFieldLabels('ppxd_status'),
                        //'placement' => 'right',
                    ),
                   'filter' => $model->getEnumFieldLabels('ppxd_status'),
                ),

            array(
                'class' => 'TbButtonColumn',
                'buttons' => array(
                    'view' => array('visible' => 'Yii::app()->user->checkAccess("D2person.PpxdPersonXDocument.View")'),
                    'update' => array('visible' => 'Yii::app()->user->checkAccess("D2person.PpxdPersonXDocument.Update")'),
                    'delete' => array('visible' => 'Yii::app()->user->checkAccess("D2person.PpxdPersonXDocument.Delete")'),
                ),
                'viewButtonUrl' => 'Yii::app()->controller->createUrl("view", array("ppxd_id" => $data->ppxd_id))',
                'updateButtonUrl' => 'Yii::app()->controller->createUrl("update", array("ppxd_id" => $data->ppxd_id))',
                'deleteButtonUrl' => 'Yii::app()->controller->createUrl("delete", array("ppxd_id" => $data->ppxd_id))',
            ),
        )
    )
);
?>
<?php Yii::endProfile('PpxdPersonXDocument.view.grid'); ?>
