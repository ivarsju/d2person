<div class="crud-form">

    
    <?php
        Yii::app()->bootstrap->registerAssetCss('../select2/select2.css');
        Yii::app()->bootstrap->registerAssetJs('../select2/select2.js');
        Yii::app()->clientScript->registerScript('crud/variant/update','$(".crud-form select").select2();');

        $form=$this->beginWidget('TbActiveForm', array(
            'id'=>'pdcm-document-type-form',
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
                            echo $form->error($model,'pdcm_id')
                            ?>
                            <span class="help-block">
                                <?php echo ($t = Yii::t('crud', 'PdcmDocumentType.pdcm_id') != 'PdcmDocumentType.pdcm_id')?$t:'' ?>
                            </span>
                        </div>
                    </div>
                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model,'pdcm_name') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->textField($model,'pdcm_name',array('size'=>50,'maxlength'=>50));
                            echo $form->error($model,'pdcm_name')
                            ?>
                            <span class="help-block">
                                <?php echo ($t = Yii::t('crud', 'PdcmDocumentType.pdcm_name') != 'PdcmDocumentType.pdcm_name')?$t:'' ?>
                            </span>
                        </div>
                    </div>
                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model,'pdcm_hidded') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->textField($model,'pdcm_hidded');
                            echo $form->error($model,'pdcm_hidded')
                            ?>
                            <span class="help-block">
                                <?php echo ($t = Yii::t('crud', 'PdcmDocumentType.pdcm_hidded') != 'PdcmDocumentType.pdcm_hidded')?$t:'' ?>
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
                                            
                <h3>
                    <?php echo Yii::t('crud', 'PpxdPersonXDocuments'); ?>
                </h3>
                <?php echo '<i>Switch to view mode to edit related records.</i>' ?>
                            
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
                'submit' => (isset($_GET['returnUrl']))?$_GET['returnUrl']:array('pdcmDocumentType/admin'),
                'class' => 'btn'
            ));
            echo ' '.CHtml::submitButton(Yii::t('crud', 'Save'), array(
                'class' => 'btn btn-primary'
            ));
        ?>
    </div>

    <?php $this->endWidget() ?>
</div> <!-- form -->