<div class="wide form">

    <?php
    $form = $this->beginWidget('TbActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    )); ?>

    
    <div class="row">
        <?php echo $form->label($model, 'ppcn_id'); ?>
        <?php ; ?>
    </div>


    
    <div class="row">
        <?php echo $form->label($model, 'ppcn_pprs_id'); ?>
        <?php echo $form->textField($model, 'ppcn_pprs_id'); ?>
    </div>


    
    <div class="row">
        <?php echo $form->label($model, 'ppcn_pcnt_type'); ?>
        <?php echo $form->textField($model, 'ppcn_pcnt_type'); ?>
    </div>


    
    <div class="row">
        <?php echo $form->label($model, 'ppcn_value'); ?>
        <?php echo $form->textField($model, 'ppcn_value', array('size' => 60, 'maxlength' => 500)); ?>
    </div>


    
    <div class="row">
        <?php echo $form->label($model, 'ppcn_notes'); ?>
        <?php echo $form->textArea($model, 'ppcn_notes', array('rows' => 6, 'cols' => 50)); ?>
    </div>


    
    <div class="row">
        <?php echo $form->label($model, 'ppcn_modified'); ?>
        <?php echo $form->textField($model, 'ppcn_modified'); ?>
    </div>


    <div class="row buttons">
        <?php echo CHtml::submitButton(Yii::t('D2personModule.crud_static', 'Search')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->
