
    <h2>
        <?php echo Yii::t('crud','Relations') ?>    </h2>

    
        <?php 
        echo '<h3>PpxtPersonXTypes ';
            $this->widget(
                'bootstrap.widgets.TbButtonGroup',
                array(
                    'type'=>'', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'size'=>'mini',
                    'buttons'=>array(
                        array(
                            'icon'=>'icon-list-alt',
                            'url'=> array('//d2person/ppxtPersonXType/admin')
                        ),
                        array(
                'icon'=>'icon-plus',
                'url'=>array(
                    '//d2person/ppxtPersonXType/create',
                    'PpxtPersonXType' => array('ppxt_ptyp_id'=>$model->{$model->tableSchema->primaryKey})
                )
            ),
            
                    )
                )
            );
        echo '</h3>' ?>
        <ul>

            <?php
            $records = $model->ppxtPersonXTypes(array('limit'=>250, 'scopes' => ''));
            if (is_array($records)) {
                foreach($records as $i => $relatedModel) {
                    echo '<li>';
                    echo CHtml::link(
                        '<i class="icon icon-arrow-right"></i> '.$relatedModel->itemLabel,
                        array('/d2person/ppxtPersonXType/view','ppxt_id'=>$relatedModel->ppxt_id)
                    );
                    echo CHtml::link(
                        ' <i class="icon icon-pencil"></i>',
                        array('/d2person/ppxtPersonXType/update','ppxt_id'=>$relatedModel->ppxt_id)
                    );
                    echo '</li>';
                }
            }
            ?>
        </ul>

    