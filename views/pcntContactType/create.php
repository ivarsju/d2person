<?php
$this->setPageTitle(
    Yii::t('D2personModule.model', 'Pcnt Contact Type')
    . ' - '
    . Yii::t('D2personModule.crud_static', 'Create')
);

$this->breadcrumbs[Yii::t('D2personModule.model', 'Pcnt Contact Types')] = array('admin');
$this->breadcrumbs[] = Yii::t('D2personModule.crud_static', 'Create');
?>
<?php $this->widget("TbBreadcrumbs", array("links" => $this->breadcrumbs)) ?>
    <h1>
        <?php echo Yii::t('D2personModule.model', 'Pcnt Contact Type'); ?>
        <small><?php echo Yii::t('D2personModule.crud_static', 'Create'); ?></small>

    </h1>

<?php $this->renderPartial("_toolbar", array("model" => $model)); ?>
<?php $this->renderPartial('_form', array('model' => $model, 'buttons' => 'create')); ?>
<?php $this->renderPartial("_toolbar", array("model" => $model)); ?>