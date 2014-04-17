<?php
$this->setPageTitle(
    Yii::t('D2personModule.model', 'Pprs People')
    . ' - '
    . Yii::t('D2personModule.crud_static', 'Manage')
);

$this->breadcrumbs[] = Yii::t('D2personModule.model', 'Pprs People');
Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
        $('.search-form').toggle();
        return false;
    });
    $('.search-form form').submit(function(){
        $.fn.yiiGridView.update(
            'pprs-person-grid',
            {data: $(this).serialize()}
        );
        return false;
    });
    ");
?>

<?php $this->widget("TbBreadcrumbs", array("links" => $this->breadcrumbs)) ?>
    <h1>

        <?php echo Yii::t('D2personModule.model', 'Pprs People'); ?>
        <small><?php echo Yii::t('D2personModule.crud_static', 'Manage'); ?></small>

    </h1>


<?php $this->renderPartial("_toolbar", array("model" => $model)); ?>
<?php Yii::beginProfile('PprsPerson.view.grid'); ?>


<?php
$this->widget('TbGridView',
    array(
        'id' => 'pprs-person-grid',
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
                'urlExpression' => 'Yii::app()->controller->createUrl("view", array("pprs_id" => $data["pprs_id"]))'
            ),
            array(
                //smallint(5) unsigned
                'class' => 'editable.EditableColumn',
                'name' => 'pprs_id',
                'editable' => array(
                    'url' => $this->createUrl('/d2person/pprsPerson/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                //varchar(100)
                'class' => 'editable.EditableColumn',
                'name' => 'pprs_first_name',
                'editable' => array(
                    'url' => $this->createUrl('/d2person/pprsPerson/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                //varchar(100)
                'class' => 'editable.EditableColumn',
                'name' => 'pprs_second_name',
                'editable' => array(
                    'url' => $this->createUrl('/d2person/pprsPerson/editableSaver'),
                    //'placement' => 'right',
                )
            ),

            array(
                'class' => 'TbButtonColumn',
                'buttons' => array(
                    'view' => array('visible' => 'Yii::app()->user->checkAccess("D2person.PprsPerson.View")'),
                    'update' => array('visible' => 'Yii::app()->user->checkAccess("D2person.PprsPerson.Update")'),
                    'delete' => array('visible' => 'Yii::app()->user->checkAccess("D2person.PprsPerson.Delete")'),
                ),
                'viewButtonUrl' => 'Yii::app()->controller->createUrl("view", array("pprs_id" => $data->pprs_id))',
                'updateButtonUrl' => 'Yii::app()->controller->createUrl("update", array("pprs_id" => $data->pprs_id))',
                'deleteButtonUrl' => 'Yii::app()->controller->createUrl("delete", array("pprs_id" => $data->pprs_id))',
            ),
        )
    )
);
?>
<?php Yii::endProfile('PprsPerson.view.grid'); ?>