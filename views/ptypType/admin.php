<?php
$this->setPageTitle(
    Yii::t('D2personModule.model', 'Ptyp Types')
    . ' - '
    . Yii::t('D2personModule.crud_static', 'Manage')
);

$this->breadcrumbs[] = Yii::t('D2personModule.model', 'Ptyp Types');
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

<?php $this->widget("TbBreadcrumbs", array("links" => $this->breadcrumbs)) ?>
    <h1>

        <?php echo Yii::t('D2personModule.model', 'Ptyp Types'); ?>
        <small><?php echo Yii::t('D2personModule.crud_static', 'Manage'); ?></small>

    </h1>


<?php $this->renderPartial("_toolbar", array("model" => $model)); ?>
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
                'class' => 'CLinkColumn',
                'header' => '',
                'labelExpression' => '$data->itemLabel',
                'urlExpression' => 'Yii::app()->controller->createUrl("view", array("ptyp_id" => $data["ptyp_id"]))'
            ),
            array(
                //tinyint(3) unsigned
                'class' => 'editable.EditableColumn',
                'name' => 'ptyp_id',
                'editable' => array(
                    'url' => $this->createUrl('/d2person/ptypType/editableSaver'),
                    //'placement' => 'right',
                )
            ),
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

            array(
                'class' => 'TbButtonColumn',
                'buttons' => array(
                    'view' => array('visible' => 'Yii::app()->user->checkAccess("D2person.PtypType.View")'),
                    'update' => array('visible' => 'Yii::app()->user->checkAccess("D2person.PtypType.Update")'),
                    'delete' => array('visible' => 'Yii::app()->user->checkAccess("D2person.PtypType.Delete")'),
                ),
                'viewButtonUrl' => 'Yii::app()->controller->createUrl("view", array("ptyp_id" => $data->ptyp_id))',
                'updateButtonUrl' => 'Yii::app()->controller->createUrl("update", array("ptyp_id" => $data->ptyp_id))',
                'deleteButtonUrl' => 'Yii::app()->controller->createUrl("delete", array("ptyp_id" => $data->ptyp_id))',
            ),
        )
    )
);
?>
<?php Yii::endProfile('PtypType.view.grid'); ?>