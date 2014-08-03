<div class="crud-form">

    <?php
        Yii::app()->bootstrap->registerPackage('select2');
        Yii::app()->clientScript->registerScript('crud/variant/update','$("#ppcn-person-contact-form select").select2();');

        $form=$this->beginWidget('TbActiveForm', array(
            'id' => 'ppcn-person-contact-form',
            'enableAjaxValidation' => true,
            'enableClientValidation' => true,
            'htmlOptions' => array(
                'enctype' => ''
            )
        ));

        echo $form->errorSummary($model);
    ?>

    <div class="row">
        <div class="span7">
            <h2>
                <?php echo Yii::t('D2personModule.crud_static','Data')?>                <small>
                    #<?php echo $model->ppcn_id ?>                </small>

            </h2>

            <div class="form-horizontal">

                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php  ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('D2personModule.model', 'tooltip.ppcn_id')) != 'tooltip.ppcn_id')?$t:'' ?>'>
                                <?php
                            ;
                            echo $form->error($model,'ppcn_id')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>

                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'ppcn_pprs_id') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('D2personModule.model', 'tooltip.ppcn_pprs_id')) != 'tooltip.ppcn_pprs_id')?$t:'' ?>'>
                                <?php
                            $this->widget(
                '\GtcRelation',
                array(
                    'model' => $model,
                    'relation' => 'ppcnPprs',
                    'fields' => 'itemLabel',
                    'allowEmpty' => true,
                    'style' => 'dropdownlist',
                    'htmlOptions' => array(
                        'checkAll' => 'all'
                    ),
                )
                );
                            echo $form->error($model,'ppcn_pprs_id')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>

                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'ppcn_pcnt_type') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('D2personModule.model', 'tooltip.ppcn_pcnt_type')) != 'tooltip.ppcn_pcnt_type')?$t:'' ?>'>
                                <?php
                            $this->widget(
                '\GtcRelation',
                array(
                    'model' => $model,
                    'relation' => 'ppcnPcntType',
                    'fields' => 'itemLabel',
                    'allowEmpty' => true,
                    'style' => 'dropdownlist',
                    'htmlOptions' => array(
                        'checkAll' => 'all'
                    ),
                )
                );
                            echo $form->error($model,'ppcn_pcnt_type')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>

                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'ppcn_value') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('D2personModule.model', 'tooltip.ppcn_value')) != 'tooltip.ppcn_value')?$t:'' ?>'>
                                <?php
                            echo $form->textField($model, 'ppcn_value', array('size' => 60, 'maxlength' => 500));
                            echo $form->error($model,'ppcn_value')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>

                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'ppcn_notes') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('D2personModule.model', 'tooltip.ppcn_notes')) != 'tooltip.ppcn_notes')?$t:'' ?>'>
                                <?php
                            echo $form->textArea($model, 'ppcn_notes', array('rows' => 6, 'cols' => 50));
                            echo $form->error($model,'ppcn_notes')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>

                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'ppcn_modified') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('D2personModule.model', 'tooltip.ppcn_modified')) != 'tooltip.ppcn_modified')?$t:'' ?>'>
                                <?php
                            echo $form->textField($model, 'ppcn_modified');
                            echo $form->error($model,'ppcn_modified')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>

            </div>
        </div>
        <!-- main inputs -->

        <div class="span5"><!-- sub inputs -->
            <div class="well">
            <!--<h2>
                <?php echo Yii::t('D2personModule.crud_static','Relations')?>            </h2>-->
                                                        </div>
        </div>
        <!-- sub inputs -->
    </div>

    <p class="alert">
        <?php echo Yii::t('D2personModule.crud_static','Fields with <span class="required">*</span> are required.');?>
    </p>

    <!-- TODO: We need the buttons inside the form, when a user hits <enter> -->
    <div class="form-actions" style="visibility: hidden; height: 1px">

        <?php
            echo CHtml::Button(
            Yii::t('D2personModule.crud_static', 'Cancel'), array(
                'submit' => (isset($_GET['returnUrl']))?$_GET['returnUrl']:array('ppcnPersonContact/admin'),
                'class' => 'btn'
            ));
            echo ' '.CHtml::submitButton(Yii::t('D2personModule.crud_static', 'Save'), array(
                'class' => 'btn btn-primary'
            ));
        ?>
    </div>

    <?php $this->endWidget() ?>
</div> <!-- form -->
