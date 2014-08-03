<?php
    $this->setPageTitle(
        Yii::t('D2personModule.model', 'Ptyp Type')
        . ' - '
        . Yii::t('D2personModule.crud_static', 'View')
        . ': '
        . $model->getItemLabel()
);
$this->breadcrumbs[Yii::t('D2personModule.model','Ptyp Types')] = array('admin');
$this->breadcrumbs[$model->{$model->tableSchema->primaryKey}] = array('view','id' => $model->{$model->tableSchema->primaryKey});
$this->breadcrumbs[] = Yii::t('D2personModule.crud_static', 'View');
?>

<?php $this->widget("TbBreadcrumbs", array("links"=>$this->breadcrumbs)) ?>
    <h1>
        <?php echo Yii::t('D2personModule.model','Ptyp Type')?>
        <small>
            <?php echo $model->itemLabel ?>

        </small>

        </h1>

<?php $this->renderPartial("_toolbar", array("model"=>$model)); ?>

<div class="row">
    <div class="span7">
        <h2>
            <?php echo Yii::t('D2personModule.crud_static','Data')?>            <small>
                #<?php echo $model->ptyp_id ?>            </small>
        </h2>

        <?php
        $this->widget(
            'TbDetailView',
            array(
                'data' => $model,
                'attributes' => array(
                array(
                        'name' => 'ptyp_id',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'EditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'ptyp_id',
                                'url' => $this->createUrl('/d2person/ptypType/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name' => 'ptyp_name',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'EditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'ptyp_name',
                                'url' => $this->createUrl('/d2person/ptypType/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name' => 'ptyp_hidden',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'EditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'ptyp_hidden',
                                'url' => $this->createUrl('/d2person/ptypType/editableSaver'),
                            ),
                            true
                        )
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
