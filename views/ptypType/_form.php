<div class="crud-form">
    <?php  ?>
    <?php
        Yii::app()->bootstrap->registerPackage('select2');
        Yii::app()->clientScript->registerScript('crud/variant/update','$("#ptyp-type-form select").select2();');

        $form=$this->beginWidget('TbActiveForm', array(
            'id' => 'ptyp-type-form',
            'enableAjaxValidation' => true,
            'enableClientValidation' => true,
            'htmlOptions' => array(
                'enctype' => ''
            )
        ));

        echo $form->errorSummary($model);
    ?>

    <div class="row">
        <div class="span5">
            <div class="form-horizontal">

                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php  ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('D2personModule.model', 'tooltip.ptyp_id')) != 'tooltip.ptyp_id')?$t:'' ?>'>
                                <?php
                            ;
                            echo $form->error($model,'ptyp_id')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>

                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'ptyp_name') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('D2personModule.model', 'tooltip.ptyp_name')) != 'tooltip.ptyp_name')?$t:'' ?>'>
                                <?php
                            echo $form->textField($model, 'ptyp_name', array('size' => 50, 'maxlength' => 50));
                            echo $form->error($model,'ptyp_name')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>

                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'ptyp_hidden') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('D2personModule.model', 'tooltip.ptyp_hidden')) != 'tooltip.ptyp_hidden')?$t:'' ?>'>
                                <?php
                            echo $form->textField($model, 'ptyp_hidden');
                            echo $form->error($model,'ptyp_hidden')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>

            </div>
        </div>
        <!-- main inputs -->

    </div>

    <p class="alert">

        <?php
            echo Yii::t('D2personModule.crud_static','Fields with <span class="required">*</span> are required.');

            /**
             * @todo: We need the buttons inside the form, when a user hits <enter>
             */
            echo ' '.CHtml::submitButton(Yii::t('D2personModule.crud_static', 'Save'), array(
                'class' => 'btn btn-primary',
                'style'=>'visibility: hidden;'
            ));

        ?>
    </p>

    <?php $this->endWidget() ?>    <?php  ?></div> <!-- form -->
