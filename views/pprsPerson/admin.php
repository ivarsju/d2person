<?php
$this->setPageTitle(Yii::t('D2personModule.model', 'Persons'));

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
                <i class=""></i>
                <?php echo Yii::t('D2personModule.model', 'Persons');?>            </h1>
        </div>
    </div>
</div>

<?php Yii::beginProfile('PprsPerson.view.grid'); ?>

<?php
$this->widget('TbGridView',
    array(
        'id' => 'ccuc-user-company-grid',
        'dataProvider' => $model->searchPersons(),
        'filter' => $model,
        'template' => '{pager}{summary}{items}{pager}',
        'pager' => array(
            'class' => 'TbPager',
            'displayFirstAndLast' => true,
        ),
        'columns' => array(
            array(
                'name' => 'ccuc_person_id',
                'value' => 'CHtml::value($data, \'ccucPerson.itemLabel\')',
                'filter' => CHtml::listData(PprsPerson::model()->findAll(array('order'=>'pprs_second_name,pprs_first_name')), 'pprs_id', 'itemLabel'),                
            ),            
            array(
                'name' => 'ccuc_ccmp_id',
                'value' => 'CHtml::value($data, \'ccucCcmp.itemLabel\')',
                'filter' => CHtml::listData(CcmpCompany::model()->findAll(array('order'=>'ccmp_name')), 'ccmp_id', 'itemLabel'),
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
