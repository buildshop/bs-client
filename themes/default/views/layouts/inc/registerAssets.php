<?php

$min = YII_DEBUG ? '' : '.min';
$cs = Yii::app()->clientScript;
//$cs->registerCoreScript('jquery');
$cs->registerCoreScript('jquery.ui');
$cs->registerCssFile("http://fonts.googleapis.com/css?family=Exo+2:300,400,500,600&subset=latin,cyrillic");
$cs->registerScriptFile($this->baseAssetsUrl . "/js/application.js");
$cs->registerScriptFile($this->assetsUrl . "/js/number_format.js");
$cs->registerScriptFile($this->assetsUrl . "/js/bootstrap.min.js");
$cs->registerScriptFile($this->assetsUrl . "/js/bootstrap-select.min.js");
$cs->registerScriptFile($this->assetsUrl . "/js/jquery.bootstrap-touchspin.min.js");
$cs->registerCssFile($this->assetsUrl . "/css/jquery.bootstrap-touchspin.css");
$cs->registerScriptFile($this->assetsUrl . "/js/cart.js");
$cs->registerScriptFile($this->assetsUrl . "/js/owl.carousel.min.js");

$cs->registerScriptFile($this->assetsUrl . "/js/bootstrap-slider.min.js");
$cs->registerScriptFile($this->assetsUrl . "/js/scripts.js");
$cs->registerScriptFile($this->assetsUrl . "/js/bootstrap-hover-dropdown.min.js");

$cs->registerCssFile($this->assetsUrl . "/css/owl.carousel.css");
$cs->registerCssFile($this->assetsUrl . "/css/ui.css");
$cs->registerCssFile($this->assetsUrl . "/css/font-awesome.min.css");
$cs->registerCssFile($this->assetsUrl . "/css/bootstrap.css");
$cs->registerCssFile($this->assetsUrl . "/css/bootstrap-select.min.css");

$cs->registerCssFile($this->assetsUrl . "/css/theme.css");



if (Yii::app()->hasModule('wishlist')) {
    Yii::import('mod.wishlist.WishlistModule');
    WishlistModule::registerAssets();
}
if (Yii::app()->hasModule('compare')) {
    Yii::import('mod.compare.CompareModule');
    CompareModule::registerAssets();
}
Yii::import('mod.shop.ShopModule');
Yii::import('ext.jgrowl.Jgrowl');
Jgrowl::register();
/**
 * Global js vars
 */
$config = Yii::app()->settings->get('shop');
$cs->registerScript('app2', "
app.language = 'ru';
app.token = '" . Yii::app()->request->csrfToken . "';
app.debug = true;
app.flashMessage = true;


    
", CClientScript::POS_HEAD);
?>