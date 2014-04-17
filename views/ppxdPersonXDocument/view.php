<?php
    $this->setPageTitle(
        Yii::t('D2personModule.model', 'Ppxd Person Xdocument')
        . ' - '
        . Yii::t('D2personModule.crud_static', 'View')
        . ': '   
        . $model->getItemLabel()            
);    
$this->breadcrumbs[Yii::t('D2personModule.model','Ppxd Person Xdocuments')] = array('admin');
$this->breadcrumbs[$model->{$model->tableSchema->primaryKey}] = array('view','id' => $model->{$model->tableSchema->primaryKey});
$this->breadcrumbs[] = Yii::t('D2personModule.crud_static', 'View');
?>

<?php $this->widget("TbBreadcrumbs", array("links"=>$this->breadcrumbs)) ?>
    <h1>
        <?php echo Yii::t('D2personModule.model','Ppxd Person Xdocument')?>
        <small>
            <?php echo $model->itemLabel ?>

        </small>

        </h1>



<?php $this->renderPartial("_toolbar", array("model"=>$model)); ?>


<div class="row">
    <div class="span7">
        <h2>
            <?php echo Yii::t('D2personModule.crud_static','Data')?>            <small>
                #<?php echo $model->ppxd_id ?>            </small>
        </h2>

        <?php
        $this->widget(
            'TbDetailView',
            array(
                'data' => $model,
                'attributes' => array(
                array(
                        'name' => 'ppxd_id',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'EditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'ppxd_id',
                                'url' => $this->createUrl('/d2person/ppxdPersonXDocument/editableSaver'),
                            ),
                            true
                        )
                    ),
        array(
            'name' => 'ppxd_pprs_id',
            'value' => ($model->ppxdPprs !== null)?CHtml::link(
                            '<i class="icon icon-circle-arrow-left"></i> '.$model->ppxdPprs->itemLabel,
                            array('/d2person/pprsPerson/view','pprs_id' => $model->ppxdPprs->pprs_id),
                            array('class' => '')).' '.CHtml::link(
                            '<i class="icon icon-pencil"></i> ',
                            array('/d2person/pprsPerson/update','pprs_id' => $model->ppxdPprs->pprs_id),
                            array('class' => '')):'n/a',
            'type' => 'html',
        ),
        array(
            'name' => 'ppxd_pdcm_id',
            'value' => ($model->ppxdPdcm !== null)?CHtml::link(
                            '<i class="icon icon-circle-arrow-left"></i> '.$model->ppxdPdcm->itemLabel,
                            array('/d2person/pdcmDocumentType/view','pdcm_id' => $model->ppxdPdcm->pdcm_id),
                            array('class' => '')).' '.CHtml::link(
                            '<i class="icon icon-pencil"></i> ',
                            array('/d2person/pdcmDocumentType/update','pdcm_id' => $model->ppxdPdcm->pdcm_id),
                            array('class' => '')):'n/a',
            'type' => 'html',
        ),
array(
                        'name' => 'ppxd_number',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'EditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'ppxd_number',
                                'url' => $this->createUrl('/d2person/ppxdPersonXDocument/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name' => 'ppxd_issue_date',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'EditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'ppxd_issue_date',
                                'url' => $this->createUrl('/d2person/ppxdPersonXDocument/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name' => 'ppxd_expire_date',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'EditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'ppxd_expire_date',
                                'url' => $this->createUrl('/d2person/ppxdPersonXDocument/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name' => 'ppxd_notes',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'EditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'ppxd_notes',
                                'url' => $this->createUrl('/d2person/ppxdPersonXDocument/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name' => 'ppxd_status',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'EditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'ppxd_status',
                                'url' => $this->createUrl('/d2person/ppxdPersonXDocument/editableSaver'),
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