<?php
$this->setPageTitle(Yii::t('D2personModule.model', 'Persons'));

?>

<div class="clearfix">
    <div class="btn-toolbar pull-left">
        <div class="btn-group">
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
             'label'=>Yii::t('D2personModule.crud_static','Create'),
             'icon'=>'icon-plus',
             'size'=>'large',
             'type'=>'success',
             'url'=>array('create'),
             'visible'=>(Yii::app()->user->checkAccess('D2person.PprsPerson.*') || Yii::app()->user->checkAccess('D2person.PprsPerson.Create'))
        ));
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
        'dataProvider' => $model->search(),
        'filter' => $model,
        'template' => '{pager}{summary}{items}{pager}',
        'pager' => array(
            'class' => 'TbPager',
            'displayFirstAndLast' => true,
        ),
        'columns' => array(
            array(
                'name' => 'ccuc_person_id',
                'value' => '$data->ccucPerson->itemlabel',
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
                    'view' => array('visible' => 'Yii::app()->user->checkAccess("D2company.CcucUserCompany.View")'),
                    'update' => array('visible' => 'FALSE'),
                    'delete' => array('visible' => 'FALSE'),
                ),
                'viewButtonUrl' => 'Yii::app()->controller->createUrl("view", array("ccuc_id" => $data->ccuc_id))',

            ),
        )
    )
);
?>
<?php Yii::endProfile('PprsPerson.view.grid'); ?>
