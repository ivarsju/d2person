<?php
$this->setPageTitle(Yii::t('D2personModule.model', 'Persons'));
//$a = $model->searchPersons()->getData();
//var_dump($a[0]);exit;
?>

<div class="clearfix">
    <div class="btn-toolbar pull-left">
        <div class="btn-group">
        <?php
        if(Yii::app()->user->checkAccess("D2tasks.TprsPersons.Create")
                || Yii::app()->user->checkAccess('D2person.PprsPerson.*') 
                || Yii::app()->user->checkAccess('D2person.PprsPerson.Create')
        ){        
            $this->widget('bootstrap.widgets.TbButton', array(
                 'label'=>Yii::t('D2personModule.crud_static','Create'),
                 'icon'=>'icon-plus',
                 'size'=>'large',
                 'type'=>'success',
                 'url'=>array('create'),
            ));
        }
        ?>
</div>
        <div class="btn-group">
            <h1>
                <i class="icon-user"></i>
                <?php echo Yii::t('D2personModule.model', 'Persons');?>            </h1>
        </div>
    </div>
</div>

<?php Yii::beginProfile('PprsPerson.view.grid'); 
$roles = Yii::app()->getModule('user')->UserAdminRoles;
$itemname_filter =[];
foreach($roles as $role){
    $itemname_filter[$role] = $role;
}        

$this->widget('TbGridView',
    array(
        'id' => 'ccuc-user-company-grid',
        'dataProvider' => $model->searchPersons(),
        'filter' => $model,
        'template' => '{items}{pager}',
        'pager' => array(
            'class' => 'TbPager',
            'displayFirstAndLast' => true,
        ),
        'columns' => array(
            array(
                'name' => 'pprs_second_name',
                'value' => '$data["pprs_second_name"]',
            ),            
            array(
                'name' => 'pprs_first_name',
                'value' => '$data["pprs_first_name"]',
            ),            
            array(
                'name' => 'ccmp_name',
                'value' => '$data["ccmp_name"]',
            ),
            array(
                'name' => 'itemname',
                'value' => '$data["itemname"]',
                'filter' => $itemname_filter,
            ),
            array(
                'class' => 'TbButtonColumn',
                'buttons' => array(
                    'view' => array('visible' => 'Yii::app()->user->checkAccess("D2person.PprsPerson.View")'
                                              . ' || Yii::app()->user->checkAccess("D2person.PprsPerson.*")'
                                              . ' || Yii::app()->user->checkAccess("D2person.PprsPerson.Update")'),
                    'update' => array('visible' => 'FALSE'),
                    'delete' => array('visible' => 'FALSE'),
                ),
                'viewButtonUrl' => 'Yii::app()->controller->createUrl("view", array("pprs_id" => $data->ccuc_person_id))',

            ),
        )
    )
);
?>
<?php Yii::endProfile('PprsPerson.view.grid'); ?>
