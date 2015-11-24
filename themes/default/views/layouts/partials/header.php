
<div class="container-fluid panel-top">
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="nav nav-pills pull-left">
                        <li><?php $this->widget('ext.checkCity.CheckCityWidget') ?></li>
                        <li class="hidden-xs"><a href="#">Гарантия</a></li>
                        <li class="hidden-xs"><a href="#">Доставка и оплата</a></li>
                        <li class="hidden-xs"><a href="#">Обратная связь</a></li>


                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Валюта <span class="label label-default"><?= Yii::app()->currency->active->symbol ?></span> <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <?php
                                foreach (Yii::app()->currency->currencies as $currency) {
                                    echo Html::openTag('li');
                                    echo Html::ajaxLink($currency->symbol, '/shop/ajax/activateCurrency/' . $currency->id, array(
                                        'success' => 'js:function(){window.location.reload(true)}',
                                            ), array('id' => 'sw' . $currency->id, 'class' => Yii::app()->currency->active->id === $currency->id ? 'active' : ''));
                                    echo Html::closeTag('li');
                                }
                                ?>
                            </ul>
                        </li>

                        <?php $this->widget('mod.users.widgets.login.LoginWidget'); ?>
                    </ul>
                    <ul class="nav nav-pills pull-right">

                        <?php
                        if (Yii::app()->hasModule('compare')) {

                            Yii::import('mod.compare.components.CompareProductsComponent');
                            ?>
                            <li>
                                <a href="<?php echo Yii::app()->createUrl('/compare/default/index') ?>">
                                    <i class="fa fa-compress"></i> <span class="hidden-xs"><?= Yii::t('CompareModule.default', 'COMPARE') ?></span> (<span id="countCompare"><?=CompareProductsComponent::countSession()?></span>)
                                </a>
                            </li>

                        <?php } ?>
                        <?php
                        if (Yii::app()->hasModule('wishlist') && !Yii::app()->user->isGuest) {
                            Yii::import('mod.wishlist.models.Wishlist');
                            WishlistModule::registerAssets();
                            ?>
                            <li>
                                <a href="<?= Yii::app()->createUrl('/wishlist/default/index') ?>">
                                    <i class="fa fa-heart"></i> <span class="hidden-xs"><?= Yii::t('WishlistModule.default', 'WISHLIST') ?></span> (<span id="countWishlist"><?=Wishlist::countByUser()?></span>)
                                </a>                  
                            </li>

                        <?php } ?>
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row header">
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
            <?= Html::link($config['site_name'], '/', array('class' => 'navbar-brand')); ?>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 col-lg-push-6 col-md-push-6 col-sm-push-6">
            <div class="pull-right">

            <?php
            if (!Yii::app()->request->isAjaxRequest)
                echo Html::openTag('div', array('id' => 'cart', 'class' => 'small-cart'));
            $this->widget('mod.cart.widgets.cart.CartWidget', array(
                'skin' => "currentTheme.views.layouts.partials.widgets.CartWidget"
            ));
            if (!Yii::app()->request->isAjaxRequest)
                echo Html::closeTag('div');
            ?>
                </div>
        </div>
        <div class="clearfix visible-xs-block"></div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-lg-pull-3 col-md-pull-3 col-sm-pull-3">
            <span id="header-phone"></span>
            <?php
            $this->widget('mod.shop.blocks.search.SearchWidget', array(
                'skin' => "currentTheme.views.layouts.partials.widgets.SearchWidget"
            ));
            ?>

        </div>
    </div>
</div>