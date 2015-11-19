<?php
$cs = Yii::app()->clientScript;
$cs->registerScriptFile($this->assetsUrl . "/js/jquery.flexslider-min.js");
$cs->registerScriptFile($this->assetsUrl . "/js/jquery.elevatezoom.min.js");
//$cs->registerScriptFile($this->baseAssetsUrl . "/js/jquery.elevatezoom.js");


$cs->registerCssFile($this->assetsUrl . "/css/flexslider.css");

?>


<script>


    $(window).load(function() {
        
        $('.slides li img').on('click',function(){
            var large = $(this).attr('data-zoom-image');
            var src = $(this).attr('src');
     
            var ez = $('.zoom').data('elevateZoom');
            ez.swaptheimage(src, large);
        });
    
        $('.zoom').elevateZoom();

        // The slider being synced must be initialized first
        // API docs https://github.com/woothemes/FlexSlider/wiki/FlexSlider-Properties
        $('#carousel').flexslider({
            animation: "slide",
            controlNav: true,
            animationLoop: true,
            slideshow: false,
            itemWidth: 100
            //asNavFor: '#slider'
        });
 

    });

</script>







<div class="product-view">


    <div class="row">
        <div class="col-sm-5 col-xs-12">
            <?php if (isset($model->mainImage)) { ?>
                <?php
                echo Html::image($model->mainImage->getUrl('500x500'), $model->mainImage->title, array(
                    'data-zoom-image' => $model->mainImage->getUrl('900x900'),
                    'class' => 'zoom'
                ));
                ?>
            <?php } ?>
            <?php if (isset($model->images)) { ?>
                <div id="carousel" class="flexslider row">
                    <ul class="slides">

                        <?php foreach ($model->images as $k => $image) { ?>
                            <li class="col-md-3 col-xs-4"><a href="#" class="thumbnail">
                                    <?php
                                    echo Html::image($image->getUrl('300x300'), $image->title, array(
                                        'data-zoom-image' => $image->getUrl('900x900'),
                                        'class' => 'img-responsive'
                                    ));
                                    ?></a>
                            </li>
                        <?php } ?>

                    </ul>
                </div>
            <?php } ?>

        </div>
        <div class="col-sm-7 col-xs-12">

            <div class="row">
                <div class="col-md-8">
                    <h1><?php echo Html::encode($model->name); ?></h1>
                    <?php
                    Yii::app()->controller->renderPartial('_configurations', array('model' => $model));
                    ?>

                    <div class="product-view-rating">
                        <?php
                        echo $this->widget("ext.rating.StarRating", array(
                            'name' => 'rating_' . $model->id,
                            'id' => 'rating_' . $model->id,
                            'allowEmpty' => false,
                            'readOnly' => isset(Yii::app()->request->cookies['rating_' . $model->id]),
                            'minRating' => 1,
                            'maxRating' => 5,
                            'value' => ($model->rating + $model->votes) ? round($model->rating / $model->votes) : 0,
                            'callback' => 'js:function(){rating(' . $model->id . ')}',
                                ), true);
                        ?>
                    </div>
                    <div class="row product-view-param">
                        <div class="col-sm-4 col-md-4 col-xs-6 text-muted"><?= $model::t('SKU'); ?>:</div>
                        <div class="col-sm-8 col-md-8 col-xs-6"><?= $model->sku ?></div>
                    </div>
                    <div class="row product-view-param">
                        <div class="col-sm-4 col-md-4 col-xs-6 text-muted"><?= $model::t('MANUFACTURER_ID'); ?>:</div>
                        <div class="col-sm-8 col-md-8 col-xs-6"><?= $model->manufacturer->name ?></div>
                    </div>
                    <div class="row product-view-param">
                        <div class="col-sm-4 col-md-4 col-xs-6 text-muted">Наличие:</div>
                        <div class="col-sm-8 col-md-8 col-xs-6">
                            <?php if ($model->isAvailable) { ?>
                                <span class="text-success"><?= $model->availabilityList[1]; ?></span>
                            <?php } else { ?>
                                <span class="text-danger"><?= $model->availabilityList[2]; ?></span>
                            <?php } ?>
                        </div>
                    </div>
                    <?= $model->short_description; ?>

                    <span class="price">
                        <span id="productPrice">
                            <?php echo $model->priceRange() ?></span>
                        <?= Yii::app()->currency->active->symbol; ?>
                    </span>
                    <?php
                    if (Yii::app()->hasModule('discounts')) {
                        if ($model->appliedDiscount) {
                            echo '<span class="price-strike">' . $model->toCurrentCurrency('originalPrice') . '</span>';
                        }
                    }
                    ?>
                    <?php
                    $this->widget('ext.admin.frontControl.FrontControlWidget', array(
                        'data' => $model,
                    ))
                    ?>


                    <div class="product-view-action">
                        <?php
                        if (Yii::app()->hasModule('cart')) {
                            echo Html::form(array('/cart/add'), 'post', array(
                                'id' => 'form-add-cart-' . $model->id,
                                'class' => ' form-horizontal'
                            ));
                            echo Html::hiddenField('product_id', $model->id);
                            echo Html::hiddenField('product_price', $model->price);
                            echo Html::hiddenField('use_configurations', $model->use_configurations);
                            echo Html::hiddenField('currency_rate', Yii::app()->currency->active->rate);
                            echo Html::hiddenField('currency_id', $model->currency_id);
                            echo Html::hiddenField('supplier_id', $model->supplier_id);
                            echo Html::hiddenField('pcs', $model->pcs);
                            echo Html::hiddenField('configurable_id', 0);
                            ?>
                            <div class="row">
                                <div class="col-xs-12">






                                    <div class="input-group input-group-lg">
                                        <?php if ($model->isAvailable) { ?><?= Html::textField('quantity', 1, array('class' => 'spinner form-control text-center')); ?><?php } ?>
                                        <div class="input-group-btn btn-group-lg">
                                            <?php
                                            if (Yii::app()->hasModule('compare')) {
                                                echo Html::link('<i class="fa fa-compress"></i>', 'javascript:compare.add(' . $model->id . ');', array(
                                                    'data-toggle' => 'tooltip',
                                                    'data-placement' => 'top',
                                                    'title' => 'В сравнение',
                                                    'class' => 'btn btn-default'
                                                ));
                                            }
                                            if (Yii::app()->hasModule('wishlist') && !Yii::app()->user->isGuest) {

                                                echo Html::link('<i class="fa fa-heart"></i>', 'javascript:wishlist.add(' . $model->id . ');', array(
                                                    'data-toggle' => 'tooltip',
                                                    'data-placement' => 'top',
                                                    'title' => 'В избранное',
                                                    'class' => 'btn btn-default'
                                                ));
                                            }


                                            if ($model->isAvailable) {
                                                echo Html::link(Yii::t('app', 'BUY'), 'javascript:cart.add("#form-add-cart-' . $model->id . '")', array('class' => 'btn btn-primary'));
                                            } else {
                                                echo Html::link(Yii::t('app', 'NOT_AVAILABLE'), 'javascript:cart.notifier(' . $model->id . ');', array('class' => 'btn btn-link'));
                                            }
                                            ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <?php
                            echo Html::endForm();
                        }
                        ?>
                    </div>

                </div>
                <div class="col-md-4 hidden-xs hidden-sm">
                    <?php echo Html::image($model->manufacturer->getImageUrl('image', 'manufacturer', '200x100', 'resize'), $model->manufacturer->name, array('class' => 'img-responsive')); ?>
                </div>
            </div>











        </div>
    </div>
</div>
<script>

</script>




<script>
    $('#product-tabs a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });
</script>
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#description" aria-controls="description" role="tab" data-toggle="tab">Описание</a></li>
    <li role="presentation"><a href="#video" aria-controls="video" role="tab" data-toggle="tab">Видео</a></li>
    <?php if ($model->getEavAttributes()) { ?>
        <li role="presentation"><a href="#attributes" aria-controls="attributes" role="tab" data-toggle="tab">Характеристики</a></li>
    <?php } ?>
    <li role="presentation"><a href="#comments" aria-controls="comments" role="tab" data-toggle="tab">Отзывы (<?= $model->commentsCount ?>)</a></li>
    <?php if (isset($model->relatedProducts)) { ?>
        <li role="presentation"><a href="#related" aria-controls="related" role="tab" data-toggle="tab">related</a></li>
    <?php } ?></ul>


<!-- Tab panes -->
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="description"><?= $model->full_description ?></div>
    <div role="tabpanel" class="tab-pane" id="video">YOUTUBE</div>
    <?php if ($model->getEavAttributes()) { ?>
        <div role="tabpanel" class="tab-pane" id="attributes">
            <?php $this->renderPartial('_attributes', array('model' => $model)) ?>
        </div>
    <?php } ?>
    <div role="tabpanel" class="tab-pane" id="comments">
        <?php $this->renderPartial('_comments', array('model' => $model)); ?>
    </div>
    <?php if (isset($model->relatedProducts)) { ?>
        <div role="tabpanel" class="tab-pane" id="related">
            <?php $this->renderPartial('_related', array('model' => $model)); ?>
        </div>
    <?php } ?>
</div>

