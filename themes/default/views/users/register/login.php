<?php
echo Html::form($this->createUrl('/users/register'), 'post', array('id' => 'user-login-form', 'class' => 'register-form outer-top-xs', 'role' => 'form'));
echo Html::errorSummary($model);
?>
        <?php
        echo Html::errorSummary($model, '<i class="fa fa-warning fa-3x"></i>', null, array('class' => 'errorSummary alert alert-danger'));
        ?>
<div class="form-group">
    <?= Html::activeLabelEx($model, 'login', array('class' => 'info-title')); ?>
    <?= Html::activeTextField($model, 'login', array('class' => 'form-control unicase-form-control text-input')); ?>
</div>
<div class="form-group">
    <?= Html::activeLabelEx($model, 'password', array('class' => 'info-title')); ?>
    <?= Html::activePasswordField($model, 'password', array('class' => 'form-control unicase-form-control text-input')); ?>
</div>
<div class="radio outer-xs">
    <label>
        <?= Html::activeCheckBox($model, 'rememberMe', array('class' => '')); ?> <?= Yii::t('UsersModule.default', 'REMEMBER_ME') ?>
    </label>
    <?= Html::link(Yii::t('UsersModule.default', 'REMIN_PASS'), '/users/remind', array('class' => 'forgot-password pull-right')); ?>
</div>
<?= Html::submitButton(Yii::t('UsersModule.default', 'BTN_LOGIN'), array('class' => 'btn-upper btn btn-primary checkout-page-button')); ?>
<?= Html::endForm(); ?>