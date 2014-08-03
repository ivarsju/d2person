<div class="wide form">

    <?php
    $form = $this->beginWidget('TbActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    )); ?>

    <div class="row">
        <?php echo $form->label($model, 'ppxd_id'); ?>
        <?php ; ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'ppxd_pprs_id'); ?>
        <?php echo $form->textField($model, 'ppxd_pprs_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'ppxd_pdcm_id'); ?>
        <?php echo $form->textField($model, 'ppxd_pdcm_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'ppxd_number'); ?>
        <?php echo $form->textField($model, 'ppxd_number', array('size' => 60, 'maxlength' => 100)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'ppxd_issue_date'); ?>
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker',
                         array(
                                 'model' => $model,
                                 'attribute' => 'ppxd_issue_date',
                                 'language' =>  strstr(Yii::app()->language.'_','_',true),
                                 'htmlOptions' => array('size' => 10),
                                 'options' => array(
                                     'showButtonPanel' => true,
                                     'changeYear' => true,
                                     'changeYear' => true,
                                     'dateFormat' => 'yy-mm-dd',
                                     ),
                                 )
                             );
                    ; ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'ppxd_expire_date'); ?>
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker',
                         array(
                                 'model' => $model,
                                 'attribute' => 'ppxd_expire_date',
                                 'language' =>  strstr(Yii::app()->language.'_','_',true),
                                 'htmlOptions' => array('size' => 10),
                                 'options' => array(
                                     'showButtonPanel' => true,
                                     'changeYear' => true,
                                     'changeYear' => true,
                                     'dateFormat' => 'yy-mm-dd',
                                     ),
                                 )
                             );
                    ; ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'ppxd_notes'); ?>
        <?php echo $form->textArea($model, 'ppxd_notes', array('rows' => 6, 'cols' => 50)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'ppxd_status'); ?>
        <?php echo CHtml::activeDropDownList($model, 'ppxd_status', $model->getEnumFieldLabels('ppxd_status')); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton(Yii::t('D2personModule.crud_static', 'Search')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->
