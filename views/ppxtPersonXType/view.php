<?php
    $this->setPageTitle(
        Yii::t('D2personModule.model', 'Ppxt Person Xtype')
        . ' - '
        . Yii::t('D2personModule.crud_static', 'View')
        . ': '
        . $model->getItemLabel()
);
$this->breadcrumbs[Yii::t('D2personModule.model','Ppxt Person Xtypes')] = array('admin');
$this->breadcrumbs[$model->{$model->tableSchema->primaryKey}] = array('view','id' => $model->{$model->tableSchema->primaryKey});
$this->breadcrumbs[] = Yii::t('D2personModule.crud_static', 'View');
?>

<?php $this->widget("TbBreadcrumbs", array("links"=>$this->breadcrumbs)) ?>
    <h1>
        <?php echo Yii::t('D2personModule.model','Ppxt Person Xtype')?>
        <small>
            <?php echo $model->itemLabel ?>

        </small>

        </h1>

<?php $this->renderPartial("_toolbar", array("model"=>$model)); ?>

<div class="row">
    <div class="span7">
        <h2>
            <?php echo Yii::t('D2personModule.crud_static','Data')?>            <small>
                #<?php echo $model->ppxt_id ?>            </small>
        </h2>

        <?php
        $this->widget(
            'TbDetailView',
            array(
                'data' => $model,
                'attributes' => array(
                array(
                        'name' => 'ppxt_id',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'EditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'ppxt_id',
                                'url' => $this->createUrl('/d2person/ppxtPersonXType/editableSaver'),
                            ),
                            true
                        )
                    ),
        array(
            'name' => 'ppxt_pprs_id',
            'value' => ($model->ppxtPprs !== null)?CHtml::link(
                            '<i class="icon icon-circle-arrow-left"></i> '.$model->ppxtPprs->itemLabel,
                            array('/d2person/pprsPerson/view','pprs_id' => $model->ppxtPprs->pprs_id),
                            array('class' => '')).' '.CHtml::link(
                            '<i class="icon icon-pencil"></i> ',
                            array('/d2person/pprsPerson/update','pprs_id' => $model->ppxtPprs->pprs_id),
                            array('class' => '')):'n/a',
            'type' => 'html',
        ),
        array(
            'name' => 'ppxt_ptyp_id',
            'value' => ($model->ppxtPtyp !== null)?CHtml::link(
                            '<i class="icon icon-circle-arrow-left"></i> '.$model->ppxtPtyp->itemLabel,
                            array('/d2person/ptypType/view','ptyp_id' => $model->ppxtPtyp->ptyp_id),
                            array('class' => '')).' '.CHtml::link(
                            '<i class="icon icon-pencil"></i> ',
                            array('/d2person/ptypType/update','ptyp_id' => $model->ppxtPtyp->ptyp_id),
                            array('class' => '')):'n/a',
            'type' => 'html',
        ),
           ),
        )); ?>
    </div>

    <div class="span5">
        <div class="well">
            <?php $this->renderPartial('_view-relations',array('model' => $model)); ?>        </div>
        <div class="well">
            <?php $this->renderPartial('_view-relations_grids',array('modelMain' => $model)); ?>        </div>
    </div>
</div>

<?php $this->renderPartial("_toolbar", array("model"=>$model)); ?>
