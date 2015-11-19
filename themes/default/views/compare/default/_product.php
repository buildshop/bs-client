<div class="col-md-4 col-sm-6">
    <div class="product">		
        <?php
        if ($data->mainImage) {
            $imgSource = $data->mainImage->getUrl('270x347');
        } else {
            $imgSource = 'http://placehold.it/270x347';
        }
        echo Html::link(Html::image($imgSource, $data->mainImageTitle, array()), $data->getRelativeUrl(), array('class' => 'product-image'));
        ?>


        <div class="text-center product-title">
            <?php echo Html::link(Html::encode($data->name), $data->getRelativeUrl()) ?>
        </div>


        <div class="product-price">	
            <span class="price"><?php echo $data->priceRange() ?> <?= Yii::app()->currency->active->symbol ?></span>
            <?php
            if (Yii::app()->hasModule('discounts')) {
                if ($data->appliedDiscount) {
                    ?>
                    <span class="price-before-discount"><?= $data->toCurrentCurrency('originalPrice') ?> <?= Yii::app()->currency->active->symbol ?></span>
                    <?php
                }
            }
            ?>


        </div>
        <div class="text-center product-action">
            <div class="btn-group btn-group-sm">
                <?php
                echo Html::form(array('/cart/add'), 'post', array('id' => 'form-add-cart' . $data->id));
                echo Html::hiddenField('product_id', $data->id);
                echo Html::hiddenField('product_price', $data->price);
                echo Html::hiddenField('use_configurations', $data->use_configurations);
                echo Html::hiddenField('currency_rate', Yii::app()->currency->active->rate);
                echo Html::hiddenField('currency_id', $data->currency_id);
                echo Html::hiddenField('supplier_id', $data->supplier_id);
                echo Html::hiddenField('pcs', $data->pcs);
                echo Html::hiddenField('configurable_id', 0);
                echo Html::endForm();
                if (Yii::app()->hasModule('wishlist')) {
                    echo Html::link('<i class="fa fa-heart"></i>', 'javascript:wishlist.add(' . $data->id . ');', array(
                        'data-toggle' => 'tooltip',
                        'data-placement' => 'top',
                        'title' => 'В избранное',
                        'class' => 'btn btn-default'
                    ));
                }
                if ($data->isAvailable) {

                    echo Html::link(Yii::t('app', 'BUY'), 'javascript:cart.add(' . $data->id . ')', array('class' => 'btn btn-primary', 'style' => 'display:block'));
                } else {
                    echo Html::link(Yii::t('app', 'NOT_AVAILABLE'), 'javascript:cart.notifier(' . $data->id . ');', array('class' => 'btn btn-link'));
                }
                echo Html::link(Yii::t('app', 'DELETE'), array('/compare/default/remove', 'id' => $data->id), array(
                    'class' => 'remove btn btn-danger',
                ));
                ?>

            </div>  
        </div>
    </div>
</div>





