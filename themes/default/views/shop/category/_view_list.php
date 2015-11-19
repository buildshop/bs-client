
<div class="col-xs-12">


    <div class="clearfix product">
        <div class=" ">
            <div class="col-sm-4">

                <?php
                if ($data->productLabel) {
                    if ($data->productLabel['class'] == 'new') {
                        $color = 'green';
                    } elseif ($data->productLabel['class'] == 'hit') {
                        $color = 'purple';
                    } else {
                        $color = 'blue';
                    }
                    echo Html::tag('div', array('class' => 'corner-left-' . $color . ' ' . $data->productLabel['class']), '', true);
                }
                ?>
                <?php
                if ($data->mainImage) {
                    $imgSource = $data->mainImage->getUrl('270x347');
                } else {
                    $imgSource = 'http://placehold.it/270x347';
                }
                echo Html::link(Html::image($imgSource, $data->mainImageTitle, array()), $data->getRelativeUrl(), array('class' => 'product-image'));
                ?>

            </div>
            <div class="col-sm-8">

                <div class="product-title">
                    <?php echo Html::link(Html::encode($data->name), $data->getRelativeUrl()) ?>
                    <div class="pull-right">
                        <?php
                        echo $this->widget("ext.rating.StarRating", array(
                            'name' => 'rating_' . $data->id,
                            'id' => 'rating_' . $data->id,
                            'allowEmpty' => false,
                            'readOnly' => isset(Yii::app()->request->cookies['rating_' . $data->id]),
                            'minRating' => 1,
                            'maxRating' => 5,
                            'value' => ($data->rating + $data->votes) ? round($data->rating / $data->votes) : 0,
                            'callback' => 'js:function(){rating(' . $data->id . ')}',
                                ), true);
                        ?></div>
                </div>
                <div class="clearfix"></div>
                <p class="text-muted">fsdaafdss
                    <?= $data->short_description ?>
                </p>

                <?php
                /*     $this->widget('ext.admin.frontControl.FrontControlWidget', array(
                  'data' => $data,
                  'widget' => $widget
                  )) */
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

                <div class="product-action">

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
                    <span class="btn-group btn-group-sm">
                        <?php
                        if (Yii::app()->hasModule('compare')) {
                            echo Html::link('<i class="fa fa-compress"></i>', 'javascript:compare.add(' . $data->id . ');', array(
                                'data-toggle' => 'tooltip',
                                'data-placement' => 'top',
                                'title' => 'В сравнение',
                                'class' => 'btn btn-default'
                            ));
                        }
                        if (Yii::app()->hasModule('wishlist') && !Yii::app()->user->isGuest) {
                            echo Html::link('<i class="fa fa-heart"></i>', 'javascript:wishlist.add(' . $data->id . ');', array(
                                'data-toggle' => 'tooltip',
                                'data-placement' => 'top',
                                'title' => 'В избранное',
                                'class' => 'btn btn-default'
                            ));
                        }

                        if ($data->isAvailable) {
                            echo Html::link(Yii::t('app', 'BUY'), 'javascript:cart.add("#form-add-cart-' . $data->id . '")', array('class' => 'btn btn-success'));
                        } else {
                            echo Html::link(Yii::t('app', 'NOT_AVAILABLE'), 'javascript:cart.notifier(' . $data->id . ');', array('class' => 'btn btn-link'));
                        }
                        ?>
                    </span>
                </div>
                <?php echo Html::endForm(); ?>

            </div>
        </div>
    </div>

</div>