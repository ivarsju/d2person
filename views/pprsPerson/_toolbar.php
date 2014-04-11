<?php Yii::beginProfile('PprsPerson.view.toolbar'); ?>

<?php
    $showDeleteButton = (Yii::app()->request->getParam("pprs_id"))?true:false;
    $showManageButton = true;
    $showCreateButton = true;
    $showUpdateButton = true;
    $showCancelButton = true;
    $showSaveButton   = true;
    $showViewButton   = true;

    switch($this->action->id){
        case "admin":
            $showCancelButton = false;
            $showSaveButton   = false;
            $showViewButton   = false;
            $showUpdateButton = false;
            break;
        case "update":
            $showCreateButton = false;
            $showUpdateButton = false;
            break;
        case "create":
            $showCreateButton = false;
            $showViewButton   = false;
            $showUpdateButton = false;
            break;
        case "view":
            $showViewButton   = false;
            $showSaveButton   = false;
            $showCreateButton = false;
            break;
    }
?>
<div class="clearfix">
    <div class="btn-toolbar pull-right">
        <!-- relations -->
                    <div class="btn-group">
                <?php $this->widget('bootstrap.widgets.TbButtonGroup', array(
                       'size'=>'large',
                       'buttons' => array(
                               array(
                                #'label'=>Yii::t('crud','Relations'),
                                'icon'=>'icon-random',
                                'items'=>array(array(
                    'icon' => 'arrow-right','label' => Yii::t('model','relation.PpcnPersonContacts'), 'url' =>array('/d2person/ppcnPersonContact/admin')),array(
                    'icon' => 'arrow-right','label' => Yii::t('model','relation.PpxdPersonXDocuments'), 'url' =>array('/d2person/ppxdPersonXDocument/admin')),array(
                    'icon' => 'arrow-right','label' => Yii::t('model','relation.PpxtPersonXTypes'), 'url' =>array('/d2person/ppxtPersonXType/admin')),array(
                    'icon' => 'circle-arrow-left','label' => Yii::t('model','relation.Profile'), 'url' =>array('/d2person/profile/admin')),
            )
          ),
        ),
    ));
?>            </div>

        
        <div class="btn-group">
            <?php
             $this->widget("bootstrap.widgets.TbButton", array(
                           "label"=>Yii::t("crud","Manage"),
                           "icon"=>"icon-list-alt",
                           "size"=>"large",
                           "url"=>array("admin"),
                           "visible"=>$showManageButton && (Yii::app()->user->checkAccess("D2person.PprsPerson.*") || Yii::app()->user->checkAccess("D2person.PprsPerson.View"))
                        ));
         ?>        </div>
    </div>

    <div class="btn-toolbar pull-left">
        <div class="btn-group">
            <?php
                   $this->widget("bootstrap.widgets.TbButton", array(
                       #"label"=>Yii::t("crud","Cancel"),
                       "icon"=>"chevron-left",
                       "size"=>"large",
                       "url"=>(isset($_GET["returnUrl"]))?$_GET["returnUrl"]:array("{$this->id}/admin"),
                       "visible"=>$showCancelButton && (Yii::app()->user->checkAccess("D2person.PprsPerson.*") || Yii::app()->user->checkAccess("D2person.PprsPerson.View")),
                       "htmlOptions"=>array(
                                       "class"=>"search-button",
                                       "data-toggle"=>"tooltip",
                                       "title"=>Yii::t("crud","Cancel"),
                                   )
                    ));
                   $this->widget("bootstrap.widgets.TbButton", array(
                        "label"=>Yii::t("crud","Create"),
                        "icon"=>"icon-plus",
                        "size"=>"large",
                        "type"=>"success",
                        "url"=>array("create"),
                        "visible"=>$showCreateButton && (Yii::app()->user->checkAccess("D2person.PprsPerson.*") || Yii::app()->user->checkAccess("D2person.PprsPerson.Create"))
                   ));
                    $this->widget("bootstrap.widgets.TbButton", array(
                        "label"=>Yii::t("crud","Delete"),
                        "type"=>"danger",
                        "icon"=>"icon-trash icon-white",
                        "size"=>"large",
                        "htmlOptions"=> array(
                            "submit"=>array("delete","pprs_id"=>$model->{$model->tableSchema->primaryKey}, "returnUrl"=>(Yii::app()->request->getParam("returnUrl"))?Yii::app()->request->getParam("returnUrl"):$this->createUrl("admin")),
                            "confirm"=>Yii::t("crud","Do you want to delete this item?")
                        ),
                        "visible"=> $showDeleteButton && (Yii::app()->user->checkAccess("D2person.PprsPerson.*") || Yii::app()->user->checkAccess("D2person.PprsPerson.Delete"))
                    ));
                    $this->widget("bootstrap.widgets.TbButton", array(
                        #"label"=>Yii::t("crud","Update"),
                        "icon"=>"icon-edit icon-white",
                        "type"=>"primary",
                        "size"=>"large",
                        "url"=>array("update","pprs_id"=>$model->{$model->tableSchema->primaryKey}),
                        "visible"=> $showUpdateButton &&  (Yii::app()->user->checkAccess("D2person.PprsPerson.*") || Yii::app()->user->checkAccess("D2person.PprsPerson.Update"))
                    ));
                    $this->widget("bootstrap.widgets.TbButton", array(
                        #"label"=>Yii::t("crud","View"),
                        "icon"=>"icon-eye-open",
                        "size"=>"large",
                        "url"=>array("view","pprs_id"=>$model->{$model->tableSchema->primaryKey}),
                        "visible"=>$showViewButton &&  (Yii::app()->user->checkAccess("D2person.PprsPerson.*") || Yii::app()->user->checkAccess("D2person.PprsPerson.View")),
                        "htmlOptions"=>array(
                                      "data-toggle"=>"tooltip",
                                      "title"=>Yii::t("crud","View Mode"),
                        )
                    ));
                    $this->widget("bootstrap.widgets.TbButton", array(
                       "label"=>Yii::t("crud","Save"),
                       "icon"=>"icon-thumbs-up icon-white",
                       "size"=>"large",
                       "type"=>"primary",
                       "htmlOptions"=> array(
                            "onclick"=>"$('.crud-form form').submit();",
                       ),
                       "visible"=>$showSaveButton &&  (Yii::app()->user->checkAccess("D2person.PprsPerson.*") || Yii::app()->user->checkAccess("D2person.PprsPerson.View"))
                    ));
             ?>        </div>
        <?php if($this->action->id == 'admin'): ?>        <div class="btn-group">
            
            <?php
                $this->widget(
                       "bootstrap.widgets.TbButton",
                       array(
                           #"label"=>Yii::t("crud","Search"),
                                   "icon"=>"icon-search",
                                   "size"=>"large",
                                   "htmlOptions"=>array(
                                       "class"=>"search-button",
                                       "data-toggle"=>"tooltip",
                                       "title"=>Yii::t("crud","Advanced Search"),
                                   )
                           )
                       );
                    ?>
                    <?php
                $this->widget(
                       "bootstrap.widgets.TbButton",
                       array(
                           #"label"=>Yii::t("crud","Clear"),
                                   "icon"=>"icon-remove-sign",
                                   "size"=>"large",
                                   "url"=>Yii::app()->baseURL."/".Yii::app()->request->getPathInfo(),
                                   "htmlOptions"=>array(
                                      "data-toggle"=>"tooltip",
                                      "title"=>Yii::t("crud","Clear Search"),
                                   )
                           )
                       );
                    ?>
                            </div>
        <?php endif; ?>
    </div>


</div>


<?php if($this->action->id == 'admin'): ?><div class="search-form" style="display:none">
    <?php Yii::beginProfile('PprsPerson.view.toolbar.search'); ?>    <?php $this->renderPartial('_search',array('model' => $model,)); ?>
    <?php Yii::endProfile('PprsPerson.view.toolbar.search'); ?></div>
<?php endif; ?>
<?php Yii::endProfile('PprsPerson.view.toolbar'); ?>