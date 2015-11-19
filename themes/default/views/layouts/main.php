<?php
$this->renderPartial('//layouts/inc/registerAssets');
$config = Yii::app()->settings->get('core');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <title><?= Html::encode($this->pageTitle) ?></title>
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <meta name="robots" content="all">
    </head>
    <body>

        <?php $this->renderPartial('//layouts/partials/header', array('config' => $config)); ?>
        <?php $this->renderPartial('//layouts/partials/nav'); ?>

        <script>
            $(function () {
                $('[data-toggle="tooltip"]').tooltip();
                $('.selectpicker').selectpicker();
            })
        </script>

        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3">
                    <?php
                    $this->widget('mod.news.blocks.latast.NewsLatastBlock');
                    ?>
                    <div class="row">
                        <div class="col-xs-12">
                            <h3 class="slider-title text-uppercase">Популярные</h3>
                        </div>
                    </div>
                    <div class="row">   
                        <div class="product_view_grid owl-carousel sidebar-slider custom-carousel">
                            <?php
                            $model = ShopProduct::model()->findAll();
                            if (isset($model)) {
                                foreach ($model as $data) {
                                    ?>
                                    <div class=" item item-carousel owl-item col-md-4 col-sm-6">

                                        <div class="product" style="border-width:10px;">
                                            <?php
                                            if ($data->productLabel) {
                                                if ($data->productLabel['class'] == 'new') {
                                                    $color = 'green';
                                                } elseif ($data->productLabel['class'] == 'hit') {
                                                    $color = 'purple';
                                                } else {
                                                    $color = 'blue';
                                                }
                                                echo Html::tag('div', array('class' => 'corner-right-' . $color . ' ' . $data->productLabel['class']), '', true);
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
                                                    </div>
                                                </div>
                                                <?php echo Html::endForm(); ?>

                                            </div>
                                        </div>
                                    </div>              
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="poroduct-list col-md-9 col-sm-9 product_view_grid">
                    <?php
                    if (Yii::app()->package->demo)
                        Yii::app()->tpl->alert('danger', Yii::t('app', 'DEMO_MESSAGE'), false);
                    ?>
                    <?= $content ?>
                </div>
            </div>
        </div>
        <?php $this->renderPartial('//layouts/partials/footer'); ?>

    </body>
</html>