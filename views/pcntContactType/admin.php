<?php
$this->setPageTitle(
    Yii::t('D2personModule.model', 'Pcnt Contact Types')
    . ' - '
    . Yii::t('D2personModule.crud_static', 'Manage')
);

$this->breadcrumbs[] = Yii::t('D2personModule.model', 'Pcnt Contact Types');
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

<?php $this->widget("TbBreadcrumbs", array("links" => $this->breadcrumbs)) ?>
    <h1>

        <?php echo Yii::t('D2personModule.model', 'Pcnt Contact Types'); ?>
        <small><?php echo Yii::t('D2personModule.crud_static', 'Manage'); ?></small>

    </h1>


<?php $this->renderPartial("_toolbar", array("model" => $model)); ?>
<?php Yii::beginProfile('PcntContactType.view.grid'); ?>


<?php
$this->widget('TbGridView',
    array(
        'id' => 'pcnt-contact-type-grid',
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
                'urlExpression' => 'Yii::app()->controller->createUrl("view", array("pcnt_id" => $data["pcnt_id"]))'
            ),
            array(
                //tinyint(3) unsigned
                'class' => 'editable.EditableColumn',
                'name' => 'pcnt_id',
                'editable' => array(
                    'url' => $this->createUrl('/d2person/pcntContactType/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                //char(40)
                'class' => 'editable.EditableColumn',
                'name' => 'pcnt_name',
                'editable' => array(
                    'url' => $this->createUrl('/d2person/pcntContactType/editableSaver'),
                    //'placement' => 'right',
                )
            ),

            array(
                'class' => 'TbButtonColumn',
                'buttons' => array(
                    'view' => array('visible' => 'Yii::app()->user->checkAccess("D2person.PcntContactType.View")'),
                    'update' => array('visible' => 'Yii::app()->user->checkAccess("D2person.PcntContactType.Update")'),
                    'delete' => array('visible' => 'Yii::app()->user->checkAccess("D2person.PcntContactType.Delete")'),
                ),
                'viewButtonUrl' => 'Yii::app()->controller->createUrl("view", array("pcnt_id" => $data->pcnt_id))',
                'updateButtonUrl' => 'Yii::app()->controller->createUrl("update", array("pcnt_id" => $data->pcnt_id))',
                'deleteButtonUrl' => 'Yii::app()->controller->createUrl("delete", array("pcnt_id" => $data->pcnt_id))',
            ),
        )
    )
);
?>
<?php Yii::endProfile('PcntContactType.view.grid'); ?>