<?php
    $this->setPageTitle(
        Yii::t('D2personModule.model', 'Ppcn Person Contact')
        . ' - '
        . Yii::t('D2personModule.crud_static', 'View')
        . ': '   
        . $model->getItemLabel()            
);    
$this->breadcrumbs[Yii::t('D2personModule.model','Ppcn Person Contacts')] = array('admin');
$this->breadcrumbs[$model->{$model->tableSchema->primaryKey}] = array('view','id' => $model->{$model->tableSchema->primaryKey});
$this->breadcrumbs[] = Yii::t('D2personModule.crud_static', 'View');
?>

<?php $this->widget("TbBreadcrumbs", array("links"=>$this->breadcrumbs)) ?>
    <h1>
        <?php echo Yii::t('D2personModule.model','Ppcn Person Contact')?>
        <small>
            <?php echo $model->itemLabel ?>

        </small>

        </h1>



<?php $this->renderPartial("_toolbar", array("model"=>$model)); ?>


<div class="row">
    <div class="span7">
        <h2>
            <?php echo Yii::t('D2personModule.crud_static','Data')?>            <small>
                #<?php echo $model->ppcn_id ?>            </small>
        </h2>

        <?php
        $this->widget(
            'TbDetailView',
            array(
                'data' => $model,
                'attributes' => array(
                array(
                        'name' => 'ppcn_id',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'EditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'ppcn_id',
                                'url' => $this->createUrl('/d2person/ppcnPersonContact/editableSaver'),
                            ),
                            true
                        )
                    ),
        array(
            'name' => 'ppcn_pprs_id',
            'value' => ($model->ppcnPprs !== null)?CHtml::link(
                            '<i class="icon icon-circle-arrow-left"></i> '.$model->ppcnPprs->itemLabel,
                            array('/d2person/pprsPerson/view','pprs_id' => $model->ppcnPprs->pprs_id),
                            array('class' => '')).' '.CHtml::link(
                            '<i class="icon icon-pencil"></i> ',
                            array('/d2person/pprsPerson/update','pprs_id' => $model->ppcnPprs->pprs_id),
                            array('class' => '')):'n/a',
            'type' => 'html',
        ),
        array(
            'name' => 'ppcn_pcnt_type',
            'value' => ($model->ppcnPcntType !== null)?CHtml::link(
                            '<i class="icon icon-circle-arrow-left"></i> '.$model->ppcnPcntType->itemLabel,
                            array('/d2person/pcntContactType/view','pcnt_id' => $model->ppcnPcntType->pcnt_id),
                            array('class' => '')).' '.CHtml::link(
                            '<i class="icon icon-pencil"></i> ',
                            array('/d2person/pcntContactType/update','pcnt_id' => $model->ppcnPcntType->pcnt_id),
                            array('class' => '')):'n/a',
            'type' => 'html',
        ),
array(
                        'name' => 'ppcn_value',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'EditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'ppcn_value',
                                'url' => $this->createUrl('/d2person/ppcnPersonContact/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name' => 'ppcn_notes',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'EditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'ppcn_notes',
                                'url' => $this->createUrl('/d2person/ppcnPersonContact/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name' => 'ppcn_modified',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'EditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'ppcn_modified',
                                'url' => $this->createUrl('/d2person/ppcnPersonContact/editableSaver'),
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