<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'notify-form',
    'action' => '/notify/index',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => '')
        ));
echo Html::hiddenField('product_id', $product->id);
?>
<div class="form-group">
    <?php echo $form->labelEx($model, 'email', array('class' => 'control-label')) ?>
    <?php echo $form->textField($model, 'email', array('class' => 'form-control','value'=> (!Yii::app()->user->isGuest) ? Yii::app()->user->email : NULL)) ?>
    <?php echo $form->error($model, 'email') ?>
</div>
<?php $this->endWidget(); ?>

