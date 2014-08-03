<?php
$this->setPageTitle(
    Yii::t('D2personModule.model', 'Ppcn Person Contacts')
    . ' - '
    . Yii::t('D2personModule.crud_static', 'Manage')
);

$this->breadcrumbs[] = Yii::t('D2personModule.model', 'Ppcn Person Contacts');
Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function () {
        $('.search-form').toggle();

        return false;
    });
    $('.search-form form').submit(function () {
        $.fn.yiiGridView.update(
            'ppcn-person-contact-grid',
            {data: $(this).serialize()}
        );

        return false;
    });
    ");
?>

<?php $this->widget("TbBreadcrumbs", array("links" => $this->breadcrumbs)) ?>
    <h1>

        <?php echo Yii::t('D2personModule.model', 'Ppcn Person Contacts'); ?>
        <small><?php echo Yii::t('D2personModule.crud_static', 'Manage'); ?></small>

    </h1>

<?php $this->renderPartial("_toolbar", array("model" => $model)); ?>
<?php Yii::beginProfile('PpcnPersonContact.view.grid'); ?>

<?php
$this->widget('TbGridView',
    array(
        'id' => 'ppcn-person-contact-grid',
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
                'urlExpression' => 'Yii::app()->controller->createUrl("view", array("ppcn_id" => $data["ppcn_id"]))'
            ),
            array(
                //smallint(5) unsigned
                'class' => 'editable.EditableColumn',
                'name' => 'ppcn_id',
                'editable' => array(
                    'url' => $this->createUrl('/d2person/ppcnPersonContact/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'ppcn_pprs_id',
                'editable' => array(
                    'type' => 'select',
                    'url' => $this->createUrl('/d2person/ppcnPersonContact/editableSaver'),
                    'source' => CHtml::listData(PprsPerson::model()->findAll(array('limit' => 1000)), 'pprs_id', 'itemLabel'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'ppcn_pcnt_type',
                'editable' => array(
                    'type' => 'select',
                    'url' => $this->createUrl('/d2person/ppcnPersonContact/editableSaver'),
                    'source' => CHtml::listData(PcntContactType::model()->findAll(array('limit' => 1000)), 'pcnt_id', 'itemLabel'),
                    //'placement' => 'right',
                )
            ),
            array(
                //varchar(500)
                'class' => 'editable.EditableColumn',
                'name' => 'ppcn_value',
                'editable' => array(
                    'url' => $this->createUrl('/d2person/ppcnPersonContact/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'ppcn_notes',
                'editable' => array(
                    'type' => 'textarea',
                    'url' => $this->createUrl('/d2person/ppcnPersonContact/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'ppcn_modified',
                'editable' => array(
                    'url' => $this->createUrl('/d2person/ppcnPersonContact/editableSaver'),
                    //'placement' => 'right',
                )
            ),

            array(
                'class' => 'TbButtonColumn',
                'buttons' => array(
                    'view' => array('visible' => 'Yii::app()->user->checkAccess("D2person.PpcnPersonContact.View")'),
                    'update' => array('visible' => 'Yii::app()->user->checkAccess("D2person.PpcnPersonContact.Update")'),
                    'delete' => array('visible' => 'Yii::app()->user->checkAccess("D2person.PpcnPersonContact.Delete")'),
                ),
                'viewButtonUrl' => 'Yii::app()->controller->createUrl("view", array("ppcn_id" => $data->ppcn_id))',
                'updateButtonUrl' => 'Yii::app()->controller->createUrl("update", array("ppcn_id" => $data->ppcn_id))',
                'deleteButtonUrl' => 'Yii::app()->controller->createUrl("delete", array("ppcn_id" => $data->ppcn_id))',
            ),
        )
    )
);
?>
<?php Yii::endProfile('PpcnPersonContact.view.grid'); ?>
