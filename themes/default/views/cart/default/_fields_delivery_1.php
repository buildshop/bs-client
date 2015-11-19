

            <div class="form-group">
                <?= Html::activeLabel($form, 'delivery_id', array('required' => true, 'class' => 'info-title control-label')); ?>
                <?php
                echo Html::activeDropDownList($form, 'delivery_id', Html::listData($deliveryMethods, 'id', 'name'), array(
                  //  'id' => 'delivery_id_' . $delivery->id,
                    'data-style' => 'btn-inverse',
                   // 'data-price' => Yii::app()->currency->convert($delivery->price),
                   // 'data-free-from' => Yii::app()->currency->convert($delivery->free_from),
                    'onChange' => 'cart.recountTotalPrice(this);',
                    'class' => 'delivery_checkbox selectpicker',
                    'empty' => '---'
                ));
                ?>
            </div>


