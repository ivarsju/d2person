<div class="crud-form">

    
    <?php
        Yii::app()->bootstrap->registerPackage('select2');
        Yii::app()->clientScript->registerScript('crud/variant/update','$("#pcnt-contact-type-form select").select2();');


        $form=$this->beginWidget('TbActiveForm', array(
            'id' => 'pcnt-contact-type-form',
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
                    #<?php echo $model->pcnt_id ?>                </small>

            </h2>


            <div class="form-horizontal">

                                    
                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php  ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('D2personModule.model', 'tooltip.pcnt_id')) != 'tooltip.pcnt_id')?$t:'' ?>'>
                                <?php
                            ;
                            echo $form->error($model,'pcnt_id')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                                    
                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'pcnt_name') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('D2personModule.model', 'tooltip.pcnt_name')) != 'tooltip.pcnt_name')?$t:'' ?>'>
                                <?php
                            echo $form->textField($model, 'pcnt_name', array('size' => 40, 'maxlength' => 40));
                            echo $form->error($model,'pcnt_name')
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
                                            
                <h3>
                    <?php echo Yii::t('D2personModule.model', 'relation.PpcnPersonContacts'); ?>
                </h3>
                <?php echo '<i>'.Yii::t('D2personModule.crud_static','Switch to view mode to edit related records.').'</i>' ?>
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
                'submit' => (isset($_GET['returnUrl']))?$_GET['returnUrl']:array('pcntContactType/admin'),
                'class' => 'btn'
            ));
            echo ' '.CHtml::submitButton(Yii::t('D2personModule.crud_static', 'Save'), array(
                'class' => 'btn btn-primary'
            ));
        ?>
    </div>

    <?php $this->endWidget() ?>
</div> <!-- form -->
