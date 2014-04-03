<div class="crud-form">

    
    <?php
        Yii::app()->bootstrap->registerAssetCss('../select2/select2.css');
        Yii::app()->bootstrap->registerAssetJs('../select2/select2.js');
        Yii::app()->clientScript->registerScript('crud/variant/update','$(".crud-form select").select2();');

        $form=$this->beginWidget('TbActiveForm', array(
            'id'=>'ppxt-person-xtype-form',
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
                            echo $form->error($model,'ppxt_id')
                            ?>
                            <span class="help-block">
                                <?php echo ($t = Yii::t('crud', 'PpxtPersonXType.ppxt_id') != 'PpxtPersonXType.ppxt_id')?$t:'' ?>
                            </span>
                        </div>
                    </div>
                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model,'ppxt_pprs_id') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            $this->widget(
                        '\GtcRelation',
                        array(
                            'model' => $model,
                            'relation' => 'ppxtPprs',
                            'fields' => 'itemLabel',
                            'allowEmpty' => true,
                            'style' => 'dropdownlist',
                            'htmlOptions' => array(
                                'checkAll' => 'all'),
                            )
                        );
                            echo $form->error($model,'ppxt_pprs_id')
                            ?>
                            <span class="help-block">
                                <?php echo ($t = Yii::t('crud', 'PpxtPersonXType.ppxt_pprs_id') != 'PpxtPersonXType.ppxt_pprs_id')?$t:'' ?>
                            </span>
                        </div>
                    </div>
                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model,'ppxt_ptyp_id') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            $this->widget(
                        '\GtcRelation',
                        array(
                            'model' => $model,
                            'relation' => 'ppxtPtyp',
                            'fields' => 'itemLabel',
                            'allowEmpty' => true,
                            'style' => 'dropdownlist',
                            'htmlOptions' => array(
                                'checkAll' => 'all'),
                            )
                        );
                            echo $form->error($model,'ppxt_ptyp_id')
                            ?>
                            <span class="help-block">
                                <?php echo ($t = Yii::t('crud', 'PpxtPersonXType.ppxt_ptyp_id') != 'PpxtPersonXType.ppxt_ptyp_id')?$t:'' ?>
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
                'submit' => (isset($_GET['returnUrl']))?$_GET['returnUrl']:array('ppxtPersonXType/admin'),
                'class' => 'btn'
            ));
            echo ' '.CHtml::submitButton(Yii::t('crud', 'Save'), array(
                'class' => 'btn btn-primary'
            ));
        ?>
    </div>

    <?php $this->endWidget() ?>
</div> <!-- form -->