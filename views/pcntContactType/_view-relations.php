
<!--
<h2>
    <?php echo Yii::t('D2personModule.crud_static', 'Relations') ?></h2>
-->


<?php 
        echo '<h3>';
            echo Yii::t('D2personModule.model','relation.PpcnPersonContacts').' ';
            $this->widget(
                'bootstrap.widgets.TbButtonGroup',
                array(
                    'type' => '', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'size' => 'mini',
                    'buttons' => array(
                        array(
                            'icon' => 'icon-list-alt',
                            'url' =>  array('//d2person/ppcnPersonContact/admin','PpcnPersonContact' => array('ppcn_pcnt_type' => $model->{$model->tableSchema->primaryKey}))
                        ),
                        array(
                'icon' => 'icon-plus',
                'url' => array(
                    '//d2person/ppcnPersonContact/create',
                    'PpcnPersonContact' => array('ppcn_pcnt_type' => $model->{$model->tableSchema->primaryKey})
                )
            ),
            
                    )
                )
            );
        echo '</h3>' ?>
<ul>

    <?php
    $records = $model->ppcnPersonContacts(array('scopes' => ''));
    if (is_array($records)) {
        foreach ($records as $i => $relatedModel) {
            echo '<li>';
            echo CHtml::link(
                '<i class="icon icon-arrow-right"></i> ' . $relatedModel->itemLabel,
                array('/d2person/ppcnPersonContact/view', 'ppcn_id' => $relatedModel->ppcn_id)
            );
            echo CHtml::link(
                ' <i class="icon icon-pencil"></i>',
                array('/d2person/ppcnPersonContact/update', 'ppcn_id' => $relatedModel->ppcn_id)
            );
            echo '</li>';
        }
    }
    ?>
</ul>

