<div class="crud-form">

    
    <?php
        Yii::app()->bootstrap->registerAssetCss('../select2/select2.css');
        Yii::app()->bootstrap->registerAssetJs('../select2/select2.js');
        Yii::app()->clientScript->registerScript('crud/variant/update','$(".crud-form select").select2();');

        $form=$this->beginWidget('TbActiveForm', array(
            'id'=>'ppxd-person-xdocument-form',
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
                            echo $form->error($model,'ppxd_id')
                            ?>
                            <span class="help-block">
                                <?php echo ($t = Yii::t('crud', 'PpxdPersonXDocument.ppxd_id') != 'PpxdPersonXDocument.ppxd_id')?$t:'' ?>
                            </span>
                        </div>
                    </div>
                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model,'ppxd_pprs_id') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            $this->widget(
                        '\GtcRelation',
                        array(
                            'model' => $model,
                            'relation' => 'ppxdPprs',
                            'fields' => 'itemLabel',
                            'allowEmpty' => true,
                            'style' => 'dropdownlist',
                            'htmlOptions' => array(
                                'checkAll' => 'all'),
                            )
                        );
                            echo $form->error($model,'ppxd_pprs_id')
                            ?>
                            <span class="help-block">
                                <?php echo ($t = Yii::t('crud', 'PpxdPersonXDocument.ppxd_pprs_id') != 'PpxdPersonXDocument.ppxd_pprs_id')?$t:'' ?>
                            </span>
                        </div>
                    </div>
                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model,'ppxd_pdcm_id') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            $this->widget(
                        '\GtcRelation',
                        array(
                            'model' => $model,
                            'relation' => 'ppxdPdcm',
                            'fields' => 'itemLabel',
                            'allowEmpty' => true,
                            'style' => 'dropdownlist',
                            'htmlOptions' => array(
                                'checkAll' => 'all'),
                            )
                        );
                            echo $form->error($model,'ppxd_pdcm_id')
                            ?>
                            <span class="help-block">
                                <?php echo ($t = Yii::t('crud', 'PpxdPersonXDocument.ppxd_pdcm_id') != 'PpxdPersonXDocument.ppxd_pdcm_id')?$t:'' ?>
                            </span>
                        </div>
                    </div>
                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model,'ppxd_number') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->textField($model,'ppxd_number',array('size'=>60,'maxlength'=>100));
                            echo $form->error($model,'ppxd_number')
                            ?>
                            <span class="help-block">
                                <?php echo ($t = Yii::t('crud', 'PpxdPersonXDocument.ppxd_number') != 'PpxdPersonXDocument.ppxd_number')?$t:'' ?>
                            </span>
                        </div>
                    </div>
                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model,'ppxd_issue_date') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            $this->widget('zii.widgets.jui.CJuiDatePicker',
                         array(
                                 'model'=>$model,
                                 'attribute'=>'ppxd_issue_date',
                                 'language'=> substr(Yii::app()->language,0,strpos(Yii::app()->language,'_')),
                                 'htmlOptions'=>array('size'=>10),
                                 'options'=>array(
                                     'showButtonPanel'=>true,
                                     'changeYear'=>true,
                                     'changeYear'=>true,
                                     'dateFormat'=>'yy-mm-dd',
                                     ),
                                 )
                             );
                    ;
                            echo $form->error($model,'ppxd_issue_date')
                            ?>
                            <span class="help-block">
                                <?php echo ($t = Yii::t('crud', 'PpxdPersonXDocument.ppxd_issue_date') != 'PpxdPersonXDocument.ppxd_issue_date')?$t:'' ?>
                            </span>
                        </div>
                    </div>
                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model,'ppxd_expire_date') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            $this->widget('zii.widgets.jui.CJuiDatePicker',
                         array(
                                 'model'=>$model,
                                 'attribute'=>'ppxd_expire_date',
                                 'language'=> substr(Yii::app()->language,0,strpos(Yii::app()->language,'_')),
                                 'htmlOptions'=>array('size'=>10),
                                 'options'=>array(
                                     'showButtonPanel'=>true,
                                     'changeYear'=>true,
                                     'changeYear'=>true,
                                     'dateFormat'=>'yy-mm-dd',
                                     ),
                                 )
                             );
                    ;
                            echo $form->error($model,'ppxd_expire_date')
                            ?>
                            <span class="help-block">
                                <?php echo ($t = Yii::t('crud', 'PpxdPersonXDocument.ppxd_expire_date') != 'PpxdPersonXDocument.ppxd_expire_date')?$t:'' ?>
                            </span>
                        </div>
                    </div>
                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model,'ppxd_notes') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->textArea($model,'ppxd_notes',array('rows'=>6, 'cols'=>50));
                            echo $form->error($model,'ppxd_notes')
                            ?>
                            <span class="help-block">
                                <?php echo ($t = Yii::t('crud', 'PpxdPersonXDocument.ppxd_notes') != 'PpxdPersonXDocument.ppxd_notes')?$t:'' ?>
                            </span>
                        </div>
                    </div>
                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model,'ppxd_status') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo CHtml::activeDropDownList($model, 'ppxd_status', array(
            'ACTIVE' => 'ACTIVE' ,
            'INVALID' => 'INVALID' ,
));
                            echo $form->error($model,'ppxd_status')
                            ?>
                            <span class="help-block">
                                <?php echo ($t = Yii::t('crud', 'PpxdPersonXDocument.ppxd_status') != 'PpxdPersonXDocument.ppxd_status')?$t:'' ?>
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
                'submit' => (isset($_GET['returnUrl']))?$_GET['returnUrl']:array('ppxdPersonXDocument/admin'),
                'class' => 'btn'
            ));
            echo ' '.CHtml::submitButton(Yii::t('crud', 'Save'), array(
                'class' => 'btn btn-primary'
            ));
        ?>
    </div>

    <?php $this->endWidget() ?>
</div> <!-- form -->