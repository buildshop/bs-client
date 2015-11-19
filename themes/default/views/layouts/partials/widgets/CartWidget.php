<style>

    .small-cart .btn{
        text-align: left;
    }
    .small-cart .dropdown-menu{
        padding: 10px;
        width: 300px;
    }
    .small-cart .product {
        border-bottom: 1px solid #ccc;
        min-height: 70px;
        padding: 10px 0;
        position: relative;
    }
    .small-cart .product .image{
        float:left;
        width:60px;
    }
    .small-cart .product .info{
        float:left;
        width: 205px;
    }

    .small-cart .dropdown-menu .cart-total{
        font-size:12px;
        margin-top: 10px;
    }
    .small-cart-remove{
        position: absolute;
        right:0;
        top:10px;
        color: #a94442;
    }
    .product-title{
        display: block;
    }
</style>

            <a href="#" class="cart-test dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-shopping-cart fa-2x"></i>
                
                <span class="badge"><?=($count > 0)?$count:0; ?></span>

            </a>
   <?php if ($items) { ?>
        <div class="dropdown-menu pull-right ">
            <?php
            $i = 0;
            foreach ($items as $index => $product) {
                $i++;
                $price = ShopProduct::calculatePrices($product['model'], $product['variant_models'], $product['configurable_id']);
                $thumbSize = '50x50';
                if (isset($product['model']->mainImage)) {
                    $imgSource = $product['model']->mainImage->getUrl($thumbSize);
                    $img = Html::link(Html::image($imgSource, ''), $product['model']->mainImage->getUrl($thumbSize), array('class' => ''));
                } else {
                    $imgSource = 'http://placehold.it/' . $thumbSize;
                    $img = Html::link(Html::image($imgSource, ''), '#', array('class' => ''));
                }
                ?>
                <div class="product clearfix">
                    <div class="image">
                        <?= $img ?>
                    </div>
                    <div class="info">
                        <?= Html::link($product['model']['name'], $product['model']->getRelativeUrl(), array('class' => 'product-title')) ?>
                        <span class="price price-xs">
                            <span><?= $price ?></span>
                            <small><?= $currency->symbol; ?></small>
                        </span>
                    </div>
                    <?= Html::link('<i class="fa fa-remove"></i>', 'javascript:cart.remove(' . $index . ')', array('class' => 'small-cart-remove')) ?>
                </div>


            <?php } ?>
            <div class="cart-total">
                <div class="pull-left">
                    <span class="text">
                        <?= Yii::t('app', 'TOTAL_PAY'); ?>:</span><br/>
                    <span class="price price-xs">
                        <span><?= $total ?></span>
                        <small><?= $currency->symbol; ?></small>
                    </span>
                </div>
                <div class="pull-right">
                    <?= Html::link(Yii::t('app', 'BUTTON_CHECKOUT'), '/cart', array('class' => 'btn btn-primary')) ?>
                </div>  
            </div>
        </div>
    <?php } ?>
