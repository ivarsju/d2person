<?php
$this->setPageTitle(
        Yii::t('D2personModule.model', 'Ppxt Person Xtype')
        . ' - '
        . Yii::t('D2personModule.crud_static', 'Update')
        . ': '
        . $model->getItemLabel()
);
$this->breadcrumbs[Yii::t('D2personModule.model','Ppxt Person Xtypes')] = array('admin');
$this->breadcrumbs[$model->{$model->tableSchema->primaryKey}] = array('view','id' => $model->{$model->tableSchema->primaryKey});
$this->breadcrumbs[] = Yii::t('D2personModule.crud_static', 'Update');
?>

<?php $this->widget("TbBreadcrumbs", array("links"=>$this->breadcrumbs)) ?>
    <h1>

        <?php echo Yii::t('D2personModule.model','Ppxt Person Xtype'); ?>
        <small>
            <?php echo $model->itemLabel ?>

        </small>

    </h1>

<?php $this->renderPartial("_toolbar", array("model"=>$model)); ?>

<?php
    $this->renderPartial('_form', array('model' => $model));
?>

<?php $this->renderPartial("_toolbar", array("model"=>$model)); ?>
