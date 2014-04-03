<div class="crud-form">

    
    <?php
        Yii::app()->bootstrap->registerAssetCss('../select2/select2.css');
        Yii::app()->bootstrap->registerAssetJs('../select2/select2.js');
        Yii::app()->clientScript->registerScript('crud/variant/update','$(".crud-form select").select2();');

        $form=$this->beginWidget('TbActiveForm', array(
            'id'=>'ppcn-person-contact-form',
            'enableAjaxValidation'=>true,
            'enableClientValidation'=>true,
        ));

        echo $form->errorSummary($model);
    ?>
    
    <div class="row">
        <div class="span7"> <!-- main inputs -->
            <h2>
                <?php echo Yii::t('crud','Data')?>                <small>
                    <?php echo $model->itemLabel ?>
                </small>

            </h2>


            <div class="form-horizontal">

                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php  ?>
                        </div>
                        <div class='controls'>
                            <?php
                            ;
                            echo $form->error($model,'ppcn_id')
                            ?>
                            <span class="help-block">
                                <?php echo ($t = Yii::t('crud', 'PpcnPersonContact.ppcn_id') != 'PpcnPersonContact.ppcn_id')?$t:'' ?>
                            </span>
                        </div>
                    </div>
                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model,'ppcn_pprs_id') ?>
                        </div>
                        <div class='controls'>
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
                                'checkAll' => 'all'),
                            )
                        );
                            echo $form->error($model,'ppcn_pprs_id')
                            ?>
                            <span class="help-block">
                                <?php echo ($t = Yii::t('crud', 'PpcnPersonContact.ppcn_pprs_id') != 'PpcnPersonContact.ppcn_pprs_id')?$t:'' ?>
                            </span>
                        </div>
                    </div>
                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model,'ppcn_pcnt_type') ?>
                        </div>
                        <div class='controls'>
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
                                'checkAll' => 'all'),
                            )
                        );
                            echo $form->error($model,'ppcn_pcnt_type')
                            ?>
                            <span class="help-block">
                                <?php echo ($t = Yii::t('crud', 'PpcnPersonContact.ppcn_pcnt_type') != 'PpcnPersonContact.ppcn_pcnt_type')?$t:'' ?>
                            </span>
                        </div>
                    </div>
                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model,'ppcn_value') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->textField($model,'ppcn_value',array('size'=>60,'maxlength'=>500));
                            echo $form->error($model,'ppcn_value')
                            ?>
                            <span class="help-block">
                                <?php echo ($t = Yii::t('crud', 'PpcnPersonContact.ppcn_value') != 'PpcnPersonContact.ppcn_value')?$t:'' ?>
                            </span>
                        </div>
                    </div>
                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model,'ppcn_notes') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->textArea($model,'ppcn_notes',array('rows'=>6, 'cols'=>50));
                            echo $form->error($model,'ppcn_notes')
                            ?>
                            <span class="help-block">
                                <?php echo ($t = Yii::t('crud', 'PpcnPersonContact.ppcn_notes') != 'PpcnPersonContact.ppcn_notes')?$t:'' ?>
                            </span>
                        </div>
                    </div>
                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model,'ppcn_modified') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->textField($model,'ppcn_modified');
                            echo $form->error($model,'ppcn_modified')
                            ?>
                            <span class="help-block">
                                <?php echo ($t = Yii::t('crud', 'PpcnPersonContact.ppcn_modified') != 'PpcnPersonContact.ppcn_modified')?$t:'' ?>
                            </span>
                        </div>
                    </div>
                
            </div>
        </div>
        <!-- main inputs -->

        <div class="span5"> <!-- sub inputs -->
            <h2>
                <?php echo Yii::t('crud','Relations')?>
            </h2>
                                            
        </div>
        <!-- sub inputs -->
    </div>

    <p class="alert">
        <?php echo Yii::t('crud','Fields with <span class="required">*</span> are required.');?>
    </p>

    <div class="form-actions">
        
        <?php
            echo CHtml::Button(
            Yii::t('crud', 'Cancel'), array(
                'submit' => (isset($_GET['returnUrl']))?$_GET['returnUrl']:array('ppcnPersonContact/admin'),
                'class' => 'btn'
            ));
            echo ' '.CHtml::submitButton(Yii::t('crud', 'Save'), array(
                'class' => 'btn btn-primary'
            ));
        ?>
    </div>

    <?php $this->endWidget() ?>
</div> <!-- form -->