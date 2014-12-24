<?php
$can_edit = Yii::app()->user->checkAccess("D2person.PprsPerson.*") 
        || Yii::app()->user->checkAccess("D2person.PprsPerson.Update") ;

$this->setPageTitle(Yii::t('D2personModule.model', 'Person Data'));
$cancel_buton = $this->widget("bootstrap.widgets.TbButton", array(
    "icon" => "chevron-left",
    "size" => "large",
    "url" => (isset($_GET["returnUrl"])) ? $_GET["returnUrl"] : array("{$this->id}/admin"),
    //"visible" => (Yii::app()->user->checkAccess("D2person.PprsPerson.*") || Yii::app()->user->checkAccess("D2person.PprsPerson.View")),
    "htmlOptions" => array(
        "class" => "search-button",
        "data-toggle" => "tooltip",
        "title" => Yii::t("D2personModule.crud_static", "Back"),
    )
        ), true);
?>

<div class="clearfix">
    <div class="btn-toolbar pull-left">
        <div class="btn-group"><?php echo $cancel_buton;?></div>
        <div class="btn-group">
            <h1>
                <i class="icon-user"></i>
                <?php echo Yii::t('D2personModule.model','Person Data');?>
            </h1>
        </div>
        <div class="btn-group">
            <?php
            $module_name = $this->module->id;
            if(Yii::app()->user->checkAccess("audittrail") 
                    && isset($this->module->options['audittrail']) 
                    && $this->module->options['audittrail']){        
                Yii::import('audittrail.*');
                $this->widget('EFancyboxWidget',array(
                    'selector'=>'a[href*=\'audittrail/show/fancybox\']',
                    'options'=>array(
                    ),
                ));        
                $this->widget("bootstrap.widgets.TbButton", array(
                    'type'=>'info',
                    "size"=>"large",
                    "url"=>array(
                        '/audittrail/show/fancybox',
                        'model_name' => get_class($model),
                        'model_id' => $model->getPrimaryKey(),
                    ),
                    "icon"=>"icon-info-sign",
                    "htmlOptions" => array(
                        "class" => "search-button",
                        "data-toggle" => "tooltip",
                        "title" => Yii::t("D2personModule.crud_static", "Audit Trail"),
                    )                    
                ));                        
            }

            ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="span5">
        <?php
        $this->widget(
            'TbDetailView',
            array(
                'data' => $model,
                'attributes' => array(

                array(
                    'name' => 'pprs_first_name',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'attribute' => 'pprs_first_name',
                            'url' => $this->createUrl('/d2person/pprsPerson/editableSaver'),
                            'apply' => $can_edit,
                        ),
                        true
                    )
                ),

                array(
                    'name' => 'pprs_second_name',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'attribute' => 'pprs_second_name',
                            'url' => $this->createUrl('/d2person/pprsPerson/editableSaver'),
                            'apply' => $can_edit,
                        ),
                        true
                    )
                ),
                array(
                    'name' => 'pprs_status',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'type' => 'select',
                            'url' => $this->createUrl('/d2person/pprsPerson/editableSaver'),
                            'source' => $model->getEnumFieldLabels('pprs_status'),
                            'attribute' => 'pprs_status',
                            //'placement' => 'right',
                        ),
                        true
                    )
                ),                    
           ),
        )); 
        
        //attachmenti
        $this->widget('d2FilesWidget',array('module'=>$this->module->id, 'model'=>$model)); 
        
        ?>
    </div>

    <div class="span7">
        <?php $this->renderPartial('_view-relations_grids',array('modelMain' => $model, 'ajax' => false,)); ?>    
    </div>
</div>

<?php 
$cancel_buton = $this->widget("bootstrap.widgets.TbButton", array(
    "icon" => "chevron-left",
    "size" => "large",
    "url" => (isset($_GET["returnUrl"])) ? $_GET["returnUrl"] : array("{$this->id}/admin"),
    //"visible" => (Yii::app()->user->checkAccess("D2person.PprsPerson.*") || Yii::app()->user->checkAccess("D2person.PprsPerson.View")),
    "htmlOptions" => array(
        "class" => "search-button",
        "data-toggle" => "tooltip",
        "title" => Yii::t("D2personModule.crud_static", "Back"),
    )
        ), true);
    
echo $cancel_buton;
