<?php
$this->setPageTitle(
    Yii::t('D2personModule.model', 'Ppcn Person Contact')
    . ' - '
    . Yii::t('D2personModule.crud_static', 'Create')
);

$this->breadcrumbs[Yii::t('D2personModule.model', 'Ppcn Person Contacts')] = array('admin');
$this->breadcrumbs[] = Yii::t('D2personModule.crud_static', 'Create');
?>
<?php $this->widget("TbBreadcrumbs", array("links" => $this->breadcrumbs)) ?>
    <h1>
        <?php echo Yii::t('D2personModule.model', 'Ppcn Person Contact'); ?>
        <small><?php echo Yii::t('D2personModule.crud_static', 'Create'); ?></small>

    </h1>

<?php $this->renderPartial("_toolbar", array("model" => $model)); ?>
<?php $this->renderPartial('_form', array('model' => $model, 'buttons' => 'create')); ?>
<?php $this->renderPartial("_toolbar", array("model" => $model)); ?>
