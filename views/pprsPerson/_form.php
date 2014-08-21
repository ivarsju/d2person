<div class="crud-form">
    <?php  ?>
    <?php
        Yii::app()->bootstrap->registerPackage('select2');
        Yii::app()->clientScript->registerScript('crud/variant/update','$("#pprs-person-form select").select2();');

        $form=$this->beginWidget('TbActiveForm', array(
            'id' => 'pprs-person-form',
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
                                 title='<?php echo (($t = Yii::t('D2personModule.model', 'tooltip.pprs_id')) != 'tooltip.pprs_id')?$t:'' ?>'>
                                <?php
                            ;
                            echo $form->error($model,'pprs_id')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>

                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'pprs_first_name') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('D2personModule.model', 'tooltip.pprs_first_name')) != 'tooltip.pprs_first_name')?$t:'' ?>'>
                                <?php
                            echo $form->textField($model, 'pprs_first_name', array('size' => 60, 'maxlength' => 100));
                            echo $form->error($model,'pprs_first_name')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>

                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'pprs_second_name') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('D2personModule.model', 'tooltip.pprs_second_name')) != 'tooltip.pprs_second_name')?$t:'' ?>'>
                                <?php
                            echo $form->textField($model, 'pprs_second_name', array('size' => 60, 'maxlength' => 100));
                            echo $form->error($model,'pprs_second_name')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'pprs_ccmp_id') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('D2tasksModule.model', 'tooltip.ttsk_ccmp_id')) != 'tooltip.ttsk_ccmp_id')?$t:'' ?>'>
                                <?php
                                echo $form->dropDownList(
                                          $model,
                                          'pprs_ccmp_id',
                                          CHtml::listData(CcmpCompany::model()->findAll(array('order'=>'ccmp_name')), 'ccmp_id', 'itemLabel')
//                                          ,array(
//                                              'class' => 'span3'
//                                          )
                                      );
                            echo $form->error($model,'pprs_ccmp_id')
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
