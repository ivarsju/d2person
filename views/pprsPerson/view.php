<?php
    $this->setPageTitle(
        Yii::t('model', 'Pprs Person')
        . ' - '
        . Yii::t('crud', 'View')
        . ': '   
        . $model->getItemLabel()            
);    
$this->breadcrumbs[Yii::t('model','Pprs People')] = array('admin');
$this->breadcrumbs[$model->{$model->tableSchema->primaryKey}] = array('view','id' => $model->{$model->tableSchema->primaryKey});
$this->breadcrumbs[] = Yii::t('crud', 'View');
?>

<?php $this->widget("TbBreadcrumbs", array("links"=>$this->breadcrumbs)) ?>
    <h1>
        <?php echo Yii::t('model','Pprs Person')?>
        <small>
            <?php echo $model->itemLabel ?>

        </small>

        </h1>



<?php $this->renderPartial("_toolbar", array("model"=>$model)); ?>


<div class="row">
    <div class="span7">
        <h2>
            <?php echo Yii::t('crud','Data')?>            <small>
                #<?php echo $model->pprs_id ?>            </small>
        </h2>

        <?php
        $this->widget(
            'TbDetailView',
            array(
                'data' => $model,
                'attributes' => array(
                array(
                        'name' => 'pprs_id',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'EditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'pprs_id',
                                'url' => $this->createUrl('/d2person/pprsPerson/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name' => 'pprs_first_name',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'EditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'pprs_first_name',
                                'url' => $this->createUrl('/d2person/pprsPerson/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name' => 'pprs_second_name',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'EditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'pprs_second_name',
                                'url' => $this->createUrl('/d2person/pprsPerson/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name' => 'pprs_declared_place_of_residence',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'EditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'pprs_declared_place_of_residence',
                                'url' => $this->createUrl('/d2person/pprsPerson/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name' => 'pprs_real_pleace_of_residence',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'EditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'pprs_real_pleace_of_residence',
                                'url' => $this->createUrl('/d2person/pprsPerson/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name' => 'pprs_salary',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'EditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'pprs_salary',
                                'url' => $this->createUrl('/d2person/pprsPerson/editableSaver'),
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