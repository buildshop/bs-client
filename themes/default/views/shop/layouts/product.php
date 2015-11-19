<?php
$this->renderPartial('//layouts/inc/registerAssets');
$config = Yii::app()->settings->get('core');
$cs = Yii::app()->clientScript;
$cs->registerScriptFile($this->assetsUrl . "/js/jquery.bootstrap-touchspin.min.js");
$cs->registerCssFile($this->assetsUrl . "/css/jquery.bootstrap-touchspin.css");
$configShop = Yii::app()->settings->get('shop');
$cs->registerScript('app', "


fp_penny = " . $configShop['fp_penny'] . ";
fp_separator_thousandth = '" . chr($configShop['fp_separator_thousandth']) . "';
fp_separator_hundredth = '" . chr($configShop['fp_separator_hundredth']) . "';
    
", CClientScript::POS_HEAD);
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
        <div class="container">
            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12 col-xs-12">

                    <?php
                    $this->widget('BootstrapBreadcrumbs', array(
                        'links' => $this->breadcrumbs,
                    ));
                    ?>


                    <?php if (Yii::app()->user->hasFlash('success')) { ?>
                        <div class="alert alert-success">
                            <i class="fa fa-check-circle"></i>
                            <?= Yii::app()->user->getFlash('success'); ?>
                        </div>
                    <?php } ?>
                    <?php if (Yii::app()->user->hasFlash('error')) { ?>
                        <div class="alert alert-danger">
                            <i class="fa fa-warning"></i>
                            <?= Yii::app()->user->getFlash('error'); ?>
                        </div>
                    <?php } ?>
                    <?= $content ?>

                </div>
            </div>
        </div>
        <?php $this->renderPartial('//layouts/partials/footer'); ?>
    </body>
</html>