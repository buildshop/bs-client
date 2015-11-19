<div class="col-md-4 col-sm-6">
    <div class="product">
        <?php
        $this->widget('ext.admin.frontControl.FrontControlWidget', array(
            'data' => $data,
            'widget' => $widget
        ))
        ?>
        <div class="corner-right-purple stock"></div>
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
        <div class="text-center">
            <span class="price">
                <span><?php echo $data->priceRange() ?></span>
                <small><?= Yii::app()->currency->active->symbol ?></small>
            </span>
            <?php
            if (Yii::app()->hasModule('discounts')) {
                if ($data->appliedDiscount) {
                    ?>
                    <span class="price price-sm price-through">
                        <span><?= $data->toCurrentCurrency('originalPrice') ?></span>
                        <small><?= Yii::app()->currency->active->symbol ?></small>
                    </span>
                    <?php
                }
            }
            ?>                                       
            <?php
            echo Html::form(array('/cart/add'), 'post', array('id' => 'form-add-cart-' . $data->id));
            echo Html::hiddenField('product_id', $data->id);
            echo Html::hiddenField('product_price', $data->price);
            echo Html::hiddenField('use_configurations', $data->use_configurations);
            echo Html::hiddenField('currency_rate', Yii::app()->currency->active->rate);
            echo Html::hiddenField('currency_id', $data->currency_id);
            echo Html::hiddenField('supplier_id', $data->supplier_id);
            echo Html::hiddenField('pcs', $data->pcs);
            echo Html::hiddenField('configurable_id', 0);
            ?>
            <div class="text-center product-action">
                <div class="btn-group btn-group-sm">
                    <?php
                    if (Yii::app()->hasModule('compare')) {
                        echo Html::link('<i class="fa fa-compress"></i>', 'javascript:compare.add(' . $data->id . ');', array(
                            'data-toggle' => 'tooltip',
                            'data-placement' => 'top',
                            'title' => 'В сравнение',
                            'class' => 'btn btn-default'
                        ));
                    }

                    if ($data->isAvailable) {
                        echo Html::link(Yii::t('app', 'BUY'), 'javascript:cart.add("#form-add-cart-' . $data->id . '")', array('class' => 'btn btn-success'));
                    } else {
                        echo Html::link(Yii::t('app', 'NOT_AVAILABLE'), 'javascript:cart.notifier(' . $data->id . ');', array('class' => 'btn btn-link'));
                    }
                    if ($this->model->getUserId() === Yii::app()->user->id) {
                        echo Html::link(Yii::t('app', 'DELETE'), array('remove', 'id' => $data->id), array(
                            'class' => 'btn btn-danger remove',
                        ));
                    }
                    ?>
                </div>
            </div>
            <?php echo Html::endForm(); ?>
        </div>
    </div>
</div>


