<div class="wide form">

    <?php
    $form = $this->beginWidget('TbActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    )); ?>

    
    <div class="row">
        <?php echo $form->label($model, 'ptyp_id'); ?>
        <?php ; ?>
    </div>


    
    <div class="row">
        <?php echo $form->label($model, 'ptyp_name'); ?>
        <?php echo $form->textField($model, 'ptyp_name', array('size' => 50, 'maxlength' => 50)); ?>
    </div>


    
    <div class="row">
        <?php echo $form->label($model, 'ptyp_hidden'); ?>
        <?php echo $form->textField($model, 'ptyp_hidden'); ?>
    </div>


    <div class="row buttons">
        <?php echo CHtml::submitButton(Yii::t('D2personModule.crud_static', 'Search')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->
