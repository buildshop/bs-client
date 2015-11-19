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
        <title><?= Html::encode($this->pageTitle) ?>E</title>
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <meta name="robots" content="all">
    </head>
    <body>
                <?php $this->renderPartial('//layouts/partials/header',array('config'=>$config)); ?>




        <?= $this->renderPartial('//layouts/partials/nav'); ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <?= $content; ?>
                </div>
            </div>
        </div>
        <?php $this->renderPartial('//layouts/partials/footer'); ?>

    </body>
</html>