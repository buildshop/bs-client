<?php
if ($data->mainImage) {
    $imgSource = $data->mainImage->getUrl('150x150');
} else {
    $imgSource = 'http://placehold.it/150x150';
}
?>


<tr data-image="<?= $imgSource ?>" class="grid-table-row">
    <td>
        <div class="photo"><?= Html::image($imgSource, $data->mainImageTitle, array('data-echo' => $imgSource)) ?></div>
        <div class="btn-group-vertical">
            <a href="#" class="btn btn-default btn-xs view_table_image">
                <i class="fa fa-image"></i>
                <img src="<?= $imgSource ?>" alt="" />
            </a>
            <?php
            if (Yii::app()->hasModule('compare')) {
                echo Html::link('<i class="fa fa-compress"></i>', 'javascript:compare.add(' . $data->id . ');', array(
                    'data-toggle' => 'tooltip',
                    'data-placement' => 'top',
                    'title' => 'В сравнение',
                    'class' => 'btn btn-default btn-xs'
                ));
            }
            if (Yii::app()->hasModule('wishlist') && !Yii::app()->user->isGuest) {
                echo Html::link('<i class="fa fa-heart"></i>', 'javascript:wishlist.add(' . $data->id . ');', array(
                    'data-toggle' => 'tooltip',
                    'data-placement' => 'top',
                    'title' => 'В избранное',
                    'class' => 'btn btn-default btn-xs'
                ));
            }
            ?>


        </div>
    </td>
    <td>
        <?php echo Html::link(Html::encode($data->name), array('product/view', 'seo_alias' => $data->seo_alias)) ?>
        <?php if (!empty($data->sku)) { ?>
            <div class="hint small"><?= $data->getAttributeLabel('sku') ?>: <?= $data->sku ?></div>
        <?php } ?>
        <div style="margin-top: 5px;">


            <?php
            if ($data->productLabel) {
                if ($data->productLabel['class'] == 'new') {
                    $color = 'label-success';
                } elseif ($data->productLabel['class'] == 'hit') {
                    $color = 'label-warning';
                } else {
                    $color = 'label-primary';
                }
                echo Html::tag('span', array('class' => 'label ' . $color), $data->productLabel['label'], true);
            }
            ?>


            <?php
            if (Yii::app()->hasModule('discounts')) {
                if ($data->appliedDiscount) {
                    ?>
                    <span class="label label-success">скидка <?= $data->discountSum ?></span>
                    <?php
                }
            }
            ?> 
        </div>
    </td>
    <td>
    </span>
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
    ?>
</td>
<td>

    <span class="price">
        <span><?php echo $data->priceRange() ?></span>
        <small><?= Yii::app()->currency->active->symbol ?></small>
    </span>

    <?php
    if (Yii::app()->hasModule('discounts')) {
        if ($data->appliedDiscount) {
            ?>
            <div>
                <span class="price price-xs price-through">
                    <span><?= $data->toCurrentCurrency('originalPrice') ?></span>
                    <small><?= Yii::app()->currency->active->symbol ?></small>
                </span>
            </div>
            <?php
        }
    }
    ?>   


</td>
<td class="text-right">
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
        <div class="btn-group btn-group-sm">
            <?php
            if ($data->isAvailable) {
                echo Html::link(Yii::t('app', 'BUY'), 'javascript:cart.add("#form-add-cart-' . $data->id . '")', array('class' => 'btn btn-success'));
            } else {
                echo Html::link(Yii::t('app', 'NOT_AVAILABLE'), 'javascript:cart.notifier(' . $data->id . ');', array('class' => 'btn btn-link'));
            }
            ?>
        </div>
    </div>
    <?php echo Html::endForm(); ?>
</td>
</tr>


