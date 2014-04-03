<?php
$this->breadcrumbs[Yii::t('crud','Pdcm Document Types')] = array('admin');
$this->breadcrumbs[$model->{$model->tableSchema->primaryKey}] = array('view','id'=>$model->{$model->tableSchema->primaryKey});
$this->breadcrumbs[] = Yii::t('crud', 'View');
?>

<?php $this->widget("TbBreadcrumbs", array("links"=>$this->breadcrumbs)) ?>
<h1>
    <?php echo Yii::t('crud','Pdcm Document Type')?>
    <small><?php echo Yii::t('crud','View')?> #<?php echo $model->pdcm_id ?></small>
    </h1>



<?php $this->renderPartial("_toolbar", array("model"=>$model)); ?>


<div class="row">
    <div class="span7">
        <h2>
            <?php echo Yii::t('crud','Data')?>            <small>
                <?php echo $model->itemLabel?>            </small>
        </h2>

        <?php
        $this->widget(
            'TbDetailView',
            array(
                'data'=>$model,
                'attributes'=>array(
                array(
                        'name'=>'pdcm_id',
                        'type' => 'raw',
                        'value' =>$this->widget(
                            'EditableField',
                            array(
                                'model'=>$model,
                                'attribute'=>'pdcm_id',
                                'url' => $this->createUrl('/d2person/pdcmDocumentType/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name'=>'pdcm_name',
                        'type' => 'raw',
                        'value' =>$this->widget(
                            'EditableField',
                            array(
                                'model'=>$model,
                                'attribute'=>'pdcm_name',
                                'url' => $this->createUrl('/d2person/pdcmDocumentType/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name'=>'pdcm_hidded',
                        'type' => 'raw',
                        'value' =>$this->widget(
                            'EditableField',
                            array(
                                'model'=>$model,
                                'attribute'=>'pdcm_hidded',
                                'url' => $this->createUrl('/d2person/pdcmDocumentType/editableSaver'),
                            ),
                            true
                        )
                    ),
           ),
        )); ?>
    </div>

    <div class="span5">
        <?php $this->renderPartial('_view-relations',array('model'=>$model)); ?>    </div>
</div>