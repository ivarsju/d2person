<div class="wide form">

    
    <?php
    $form=$this->beginWidget('TbActiveForm', array(
        'action'=>Yii::app()->createUrl($this->route),
        'method'=>'get',
    )); ?>

    
    
        <div class="row">
            <?php echo $form->label($model,'pdcm_id'); ?>
            <?php ; ?>

        </div>

    
        <div class="row">
            <?php echo $form->label($model,'pdcm_name'); ?>
            <?php echo $form->textField($model,'pdcm_name',array('size'=>50,'maxlength'=>50)); ?>

        </div>

    
        <div class="row">
            <?php echo $form->label($model,'pdcm_hidded'); ?>
            <?php echo $form->textField($model,'pdcm_hidded'); ?>

        </div>

    
    <div class="row buttons">
        <?php echo CHtml::submitButton(Yii::t('crud', 'Search')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->
