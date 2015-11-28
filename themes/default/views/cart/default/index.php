<?php
$cs = Yii::app()->clientScript;
$config = Yii::app()->settings->get('shop');
$cs->registerScript('cart', "
//cart.selectorTotal = '#total';
var orderTotalPrice = '$totalPrice';
cart.spinnerRecount = true;
fp_penny='" . $config['fp_penny'] . "';
fp_separator_thousandth='" . chr($config['fp_separator_thousandth']) . "';
fp_separator_hundredth='" . chr($config['fp_separator_hundredth']) . "';

", CClientScript::POS_HEAD);
?>
<script>
    $(function () {

        $('.payment_checkbox').click(function () {
            $('#payment').text($(this).attr('data-value'));
        });
        $('.delivery_checkbox').click(function () {
            $('#delivery').text($(this).attr('data-value'));

        });
        // if($('#cart-check').length > 0){
        //     $('#cart-check').stickyfloat({ duration: 800 });
        // }
        hasChecked('.payment_checkbox', '#payment');
        hasChecked('.delivery_checkbox', '#delivery');
    });

    function hasChecked(selector, div) {
        $(selector).each(function (k, i) {
            var inp = $(i).attr('checked');
            if (inp == 'checked') {
                $(div).text($(this).attr('data-value'))
            }
        });
    }
    function submitform() {
        if (document.cartform.onsubmit &&
                !document.cartform.onsubmit())
        {
            return;
        }
        document.cartform.submit();
    }
</script>

<div class="row">
    <?php
    if (empty($items)) {
        echo Html::openTag('div', array('id' => 'container-cart', 'class' => 'indent'));
        echo Html::openTag('h1');
        echo Yii::t('app', 'CART_EMPTY');
        echo Html::closeTag('h1');
        echo Html::closeTag('div');
        return;
    }
    $this->widget('ext.fancybox.Fancybox', array('target' => 'a.thumbnail'));
    $config = Yii::app()->settings->get('shop');
    ?>





    <?php echo Html::form(array('/cart'), 'post', array('id' => 'cart-form', 'name' => 'cartform')) ?>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 shopping-cart-table">

        <div class="table-responsive">
            <table id="cart-table" class="table table-striped" width="100%" border="0" cellspacing="0" cellpadding="5">
                <thead>
                    <tr>
                        <th></th>
                        <th style="width:30%"><?= Yii::t('CartModule.default', 'TABLE_NAME') ?></th>
                        <th style="width:30%"><?= Yii::t('CartModule.default', 'TABLE_NUM') ?></th>
                        <th style="width:30%">Сумма</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $index => $product) { ?>
                        <?php
                        $price = ShopProduct::calculatePrices($product['model'], $product['variant_models'], $product['configurable_id']);
                        ?>
                        <tr id="product-<?= $index ?>">
                            <td width="110px" align="center">
                                <?php
                                // Display image
                                //    $config = Yii::app()->settings->get('shop', 'img_view_thumbs_size'); //img_view_thumbs_size
                                if (isset($product['model']->mainImage)) {
                                    $imgSource = $product['model']->mainImage->getUrl($config['img_view_thumbs_size']);
                                    echo Html::link(Html::image($imgSource, 'шшш'), $product['model']->mainImage->getUrl($config['maximum_image_size']), array('class' => 'thumbnail222'));
                                } else {
                                    $imgSource = 'http://placehold.it/' . $config['img_view_thumbs_size'];
                                    echo Html::image($imgSource, '', array('class' => 'thumbnail img-responsive'));
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                // Display product name with its variants and configurations
                                echo Html::link(Html::encode($product['model']->name), array('/shop/product/view', 'seo_alias' => $product['model']->seo_alias));
                                ?>
                                <br/>
                                <?php
                                // Price

                                echo Html::openTag('span', array('class' => 'price'));
                                echo ShopProduct::formatPrice(Yii::app()->currency->convert($price));
                                echo ' ' . Yii::app()->currency->active->symbol;
                                //echo ' '.($product['currency_id']) ? Yii::app()->currency->getSymbol($product['currency_id']) : Yii::app()->currency->active->symbol;
                                echo Html::closeTag('span');

                                // Display variant options
                                if (!empty($product['variant_models'])) {
                                    echo Html::openTag('span', array('class' => 'cartProductOptions'));
                                    foreach ($product['variant_models'] as $variant)
                                        echo ' - ' . $variant->attribute->title . ': ' . $variant->option->value . '<br/>';
                                    echo Html::closeTag('span');
                                }

                                // Display configurable options
                                if (isset($product['configurable_model'])) {
                                    $attributeModels = ShopAttribute::model()->findAllByPk($product['model']->configurable_attributes);
                                    echo Html::openTag('span', array('class' => 'cartProductOptions'));
                                    foreach ($attributeModels as $attribute) {
                                        $method = 'eav_' . $attribute->name;
                                        echo ' - ' . $attribute->title . ': ' . $product['configurable_model']->$method . '<br/>';
                                    }
                                    echo Html::closeTag('span');
                                }
                                ?>
                            </td>
                            <td>

                                <?php echo Html::textField("quantities[$index]", $product['quantity'], array('class' => 'spinner btn-group form-control', 'product_id' => $index)) ?>

                            </td>
                            <td id="price-<?= $index ?>" class="cart-product-sub-total">
                                <?php
                                echo Html::openTag('span', array('class' => 'cart-sub-total-price', 'id' => 'row-total-price' . $index));
                                echo (Yii::app()->settings->get('shop', 'wholesale')) ? ShopProduct::formatPrice(ShopProduct::formatPrice(Yii::app()->currency->convert($price * $product['model']->pcs * $product['quantity']))) : ShopProduct::formatPrice(Yii::app()->currency->convert($price * $product['quantity']));
                                echo Html::closeTag('span');
                                //echo $convertTotalPrice;// echo ShopProduct::formatPrice(Yii::app()->currency->convert($convertPrice, $product['currency_id']));
                                echo ' ' . Yii::app()->currency->active->symbol;
                                //echo ' '.($product['currency_id'])? Yii::app()->currency->getSymbol($product['currency_id']): Yii::app()->currency->active->symbol;
                                ?>
                            </td>
                            <td width="20px" class="romove-item">
                                <?= Html::link('<i class="fa close"></i>', array('/cart/default/remove', 'id' => $index), array('class' => 'remove icon')) ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>


        </div>
        <?php
        // Yii::app()->tpl->alert('info', Yii::t('CartModule.default', 'ALERT_CART'))
        ?>
    </div>


    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php
        // Yii::app()->tpl->alert('info', Yii::t('CartModule.default', 'ALERT_CART'))
        echo Html::errorSummary($this->form, '', null, array('class' => 'errorSummary alert alert-danger'));
        ?>
    </div>


    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading"><?= Yii::t('CartModule.default', 'USER_DATA'); ?></div>
            <div class="panel-body">
                <p class="hint">Поля отмеченные <span class="required">*</span> обязательны для заполнения</p>
                <?php $this->renderPartial('_fields_user', array('form' => $this->form)); ?>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">Оплата / доставка</div>
            <div class="panel-body">
                <p class="hint">Поля отмеченные <span class="required">*</span> обязательны для заполнения</p>
                <?php
                $this->renderPartial('_fields_delivery', array(
                    'form' => $this->form,
                    'deliveryMethods' => $deliveryMethods)
                );
                $this->renderPartial('_fields_payment', array(
                    'form' => $this->form,
                    'paymenyMethods' => $paymenyMethods)
                );
                ?>
            </div>
        </div>
    </div>



    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">dsadsadsa</div>
            <div class="panel-body">
                <div class="cart-grand-total">
                    Сумма заказа <span id="total"><?= ShopProduct::formatPrice($totalPrice) ?></span> <?php echo Yii::app()->currency->active->symbol; ?>
                </div>
                <div id="cart-check" class="text-center padding-tb">
                    <div style="font-size:14px"><?= Yii::t('CartModule.default', 'PAYMENT'); ?>:</div>
                    <div id="payment" style="font-size:14px;margin-bottom:20px;font-weight:bold">---</div>
                    <div style="font-size:14px"><?= Yii::t('CartModule.default', 'DELIVERY'); ?>:</div>
                    <div id="delivery" style="font-size:14px;margin-bottom:20px;font-weight:bold">---</div>
                    <a href="javascript:submitform();" class="btn btn-primary btn-lg"><?= Yii::t('app', 'BUTTON_CHECKOUT'); ?></a>
                </div>
                <input type="hidden" name="create" value="1">
            </div>
        </div>

    </div>



    <?php echo Html::endForm() ?>

</div>