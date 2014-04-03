<div class="wide form">

    
    <?php
    $form=$this->beginWidget('TbActiveForm', array(
        'action'=>Yii::app()->createUrl($this->route),
        'method'=>'get',
    )); ?>

    
    
        <div class="row">
            <?php echo $form->label($model,'pcnt_id'); ?>
            <?php ; ?>

        </div>

    
        <div class="row">
            <?php echo $form->label($model,'pcnt_name'); ?>
            <?php echo $form->textField($model,'pcnt_name',array('size'=>40,'maxlength'=>40)); ?>

        </div>

    
    <div class="row buttons">
        <?php echo CHtml::submitButton(Yii::t('crud', 'Search')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->
