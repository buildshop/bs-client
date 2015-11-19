
            <div class="form-group">
                <?= Html::activeLabel($form, 'payment_id', array('required' => true, 'class' => 'info-title control-label')); ?>
                <?php
                echo Html::activeDropDownList($form, 'payment_id', Html::listData($paymenyMethods, 'id', 'name'), array(
                   // 'id' => 'payment_id_' . $delivery->id,
                    'data-style' => 'btn-inverse',
                   // 'data-value' => Html::encode($pay->name),
                    //'onChange' => 'cart.recountTotalPrice(this);',
                    'class' => 'payment_checkbox selectpicker',
                    'empty' => '---'
                ));
                ?>
            </div>


