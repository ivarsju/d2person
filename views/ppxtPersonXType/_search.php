<div class="wide form">

    <?php
    $form = $this->beginWidget('TbActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    )); ?>

    
    <div class="row">
        <?php echo $form->label($model, 'ppxt_id'); ?>
        <?php ; ?>
    </div>


    
    <div class="row">
        <?php echo $form->label($model, 'ppxt_pprs_id'); ?>
        <?php echo $form->textField($model, 'ppxt_pprs_id'); ?>
    </div>


    
    <div class="row">
        <?php echo $form->label($model, 'ppxt_ptyp_id'); ?>
        <?php echo $form->textField($model, 'ppxt_ptyp_id'); ?>
    </div>


    <div class="row buttons">
        <?php echo CHtml::submitButton(Yii::t('D2personModule.crud_static', 'Search')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->
