<?php
$this->renderPartial('//layouts/inc/registerAssets');
$config = Yii::app()->settings->get('core');
$cs = Yii::app()->clientScript;


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
                <div class="col-xs-12">
                    <div class="row">

                        <?php
                        $this->widget('BootstrapBreadcrumbs', array(
                            'links' => $this->breadcrumbs,
                        ));
                        ?>

                    </div>
                    <div class="row">
                        <?php
                        if (Yii::app()->package->demo)
                            Yii::app()->tpl->alert('danger', Yii::t('app', 'DEMO_MESSAGE'), false);
                        ?>
                        <?= $content; ?>
                    </div>
                </div>
            </div>
        </div>
<?php $this->renderPartial('//layouts/partials/footer'); ?>

    </body>
</html>