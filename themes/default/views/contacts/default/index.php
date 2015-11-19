
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'contact_form',
    'clientOptions' => array(
        'validateOnSubmit' => true
    ),
    'htmlOptions' => array('name' => 'contact_form')
        ));
?>
<div class="col-md-12">
      <?php
    echo Html::errorSummary($model, '<i class="fa fa-warning fa-3x"></i>', null, array('class' => 'errorSummary alert alert-danger'));
    ?>
</div>
<div class="col-md-9 contact-form">




  

    <div class="col-md-12 contact-title">
        <h4>Обратная связь</h4>
    </div>
    <div class="col-md-4 ">
        <div class="form-group">
            <?= $form->labelEx($model, 'name', array('class' => 'info-title')); ?>
            <?= $form->textField($model, 'name', array('class' => 'form-control unicase-form-control text-input')); ?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <?= $form->labelEx($model, 'email', array('class' => 'info-title')); ?>
            <?= $form->textField($model, 'email', array('class' => 'form-control unicase-form-control text-input')); ?>
        </div>
    </div>
    <div class="col-md-2">
        <?php
        $this->widget('CCaptcha', array(
            'imageOptions' => array('class' => 'captcha'),
            'clickableImage' => true,
            'showRefreshButton' => false,
        ))
        ?>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <?= Html::activeLabelEx($model, 'verifyCode', array('class' => 'info-title')) ?>
            <?php echo Html::activeTextField($model, 'verifyCode', array('class' => 'form-control unicase-form-control text-input')) ?>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <?= $form->labelEx($model, 'msg', array('class' => 'info-title')); ?>
            <?= $form->textArea($model, 'msg', array('class' => 'form-control unicase-form-control')); ?>
        </div>
    </div>
    <div class="col-md-12 outer-bottom-small m-t-20">
        <a class="btn-upper btn btn-primary checkout-page-button" href="javascript:$('#contact_form').submit();"><?= Yii::t('default', 'SEND') ?></a>

    </div>





</div>
<?php $this->endWidget(); ?>





