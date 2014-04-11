<div class="crud-form">

    
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
        <div class="span7">
            <h2>
                <?php echo Yii::t('crud','Data')?>                <small>
                    #<?php echo $model->pprs_id ?>                </small>

            </h2>


            <div class="form-horizontal">

                                    
                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php  ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('model', 'tooltip.pprs_id')) != 'tooltip.pprs_id')?$t:'' ?>'>
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
                                 title='<?php echo (($t = Yii::t('model', 'tooltip.pprs_first_name')) != 'tooltip.pprs_first_name')?$t:'' ?>'>
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
                                 title='<?php echo (($t = Yii::t('model', 'tooltip.pprs_second_name')) != 'tooltip.pprs_second_name')?$t:'' ?>'>
                                <?php
                            echo $form->textField($model, 'pprs_second_name', array('size' => 60, 'maxlength' => 100));
                            echo $form->error($model,'pprs_second_name')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                                    
                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'pprs_declared_place_of_residence') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('model', 'tooltip.pprs_declared_place_of_residence')) != 'tooltip.pprs_declared_place_of_residence')?$t:'' ?>'>
                                <?php
                            echo $form->textArea($model, 'pprs_declared_place_of_residence', array('rows' => 6, 'cols' => 50));
                            echo $form->error($model,'pprs_declared_place_of_residence')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                                    
                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'pprs_real_pleace_of_residence') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('model', 'tooltip.pprs_real_pleace_of_residence')) != 'tooltip.pprs_real_pleace_of_residence')?$t:'' ?>'>
                                <?php
                            echo $form->textArea($model, 'pprs_real_pleace_of_residence', array('rows' => 6, 'cols' => 50));
                            echo $form->error($model,'pprs_real_pleace_of_residence')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                                    
                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'pprs_salary') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('model', 'tooltip.pprs_salary')) != 'tooltip.pprs_salary')?$t:'' ?>'>
                                <?php
                            echo $form->textField($model, 'pprs_salary');
                            echo $form->error($model,'pprs_salary')
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
                <?php echo Yii::t('crud','Relations')?>            </h2>-->
                                            
                <h3>
                    <?php echo Yii::t('model', 'relation.PpcnPersonContacts'); ?>
                </h3>
                <?php echo '<i>'.Yii::t('crud','Switch to view mode to edit related records.').'</i>' ?>
                                                            
                <h3>
                    <?php echo Yii::t('model', 'relation.PpxdPersonXDocuments'); ?>
                </h3>
                <?php echo '<i>'.Yii::t('crud','Switch to view mode to edit related records.').'</i>' ?>
                                                            
                <h3>
                    <?php echo Yii::t('model', 'relation.PpxtPersonXTypes'); ?>
                </h3>
                <?php echo '<i>'.Yii::t('crud','Switch to view mode to edit related records.').'</i>' ?>
                                                        </div>
        </div>
        <!-- sub inputs -->
    </div>

    <p class="alert">
        <?php echo Yii::t('crud','Fields with <span class="required">*</span> are required.');?>
    </p>

    <!-- TODO: We need the buttons inside the form, when a user hits <enter> -->
    <div class="form-actions" style="visibility: hidden; height: 1px">
        
        <?php
            echo CHtml::Button(
            Yii::t('crud', 'Cancel'), array(
                'submit' => (isset($_GET['returnUrl']))?$_GET['returnUrl']:array('pprsPerson/admin'),
                'class' => 'btn'
            ));
            echo ' '.CHtml::submitButton(Yii::t('crud', 'Save'), array(
                'class' => 'btn btn-primary'
            ));
        ?>
    </div>

    <?php $this->endWidget() ?>
</div> <!-- form -->
