<?php
    $this->setPageTitle(
        Yii::t('D2personModule.model', 'Pdcm Document Type')
        . ' - '
        . Yii::t('D2personModule.crud_static', 'View')
        . ': '   
        . $model->getItemLabel()            
);    
$this->breadcrumbs[Yii::t('D2personModule.model','Pdcm Document Types')] = array('admin');
$this->breadcrumbs[$model->{$model->tableSchema->primaryKey}] = array('view','id' => $model->{$model->tableSchema->primaryKey});
$this->breadcrumbs[] = Yii::t('D2personModule.crud_static', 'View');
?>

<?php $this->widget("TbBreadcrumbs", array("links"=>$this->breadcrumbs)) ?>
    <h1>
        <?php echo Yii::t('D2personModule.model','Pdcm Document Type')?>
        <small>
            <?php echo $model->itemLabel ?>

        </small>

        </h1>



<?php $this->renderPartial("_toolbar", array("model"=>$model)); ?>


<div class="row">
    <div class="span7">
        <h2>
            <?php echo Yii::t('D2personModule.crud_static','Data')?>            <small>
                #<?php echo $model->pdcm_id ?>            </small>
        </h2>

        <?php
        $this->widget(
            'TbDetailView',
            array(
                'data' => $model,
                'attributes' => array(
                array(
                        'name' => 'pdcm_id',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'EditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'pdcm_id',
                                'url' => $this->createUrl('/d2person/pdcmDocumentType/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name' => 'pdcm_name',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'EditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'pdcm_name',
                                'url' => $this->createUrl('/d2person/pdcmDocumentType/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name' => 'pdcm_hidded',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'EditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'pdcm_hidded',
                                'url' => $this->createUrl('/d2person/pdcmDocumentType/editableSaver'),
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