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
        <?= $this->renderPartial('//layouts/partials/nav'); ?>
        <script>
            $(function () {
                $('[data-toggle="tooltip"]').tooltip();
                $('.selectpicker').selectpicker();
            })
        </script>

        <div class="container">

            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <?php
                    $this->widget('Breadcrumbs', array(
                        'links' => $this->breadcrumbs,
                    ));
                    ?>

                    <h1><?= $this->pageName ?></h1>
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
                    <?php
                    if (Yii::app()->package->demo)
                        Yii::app()->tpl->alert('danger', Yii::t('app', 'DEMO_MESSAGE'), false);
                    ?>
                </div>
                <?= $content ?>

            </div>
        </div>
        <?php $this->renderPartial('//layouts/partials/footer'); ?>
    </body>
</html>