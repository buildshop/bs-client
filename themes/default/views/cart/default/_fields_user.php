<div class="form-group">
    <?= Html::activeLabel($form, 'name', array('required' => true, 'class' => 'control-label')); ?>
    <?= Html::activeTextField($form, 'name', array('class' => 'form-control')); ?>
    <?= Html::error($form, 'name'); ?>
</div>
<div class="form-group">
    <?= Html::activeLabel($form, 'phone', array('required' => true, 'class' => 'control-label')); ?>
    <?= Html::activeTextField($form, 'phone', array('class' => 'form-control')); ?>
    <?= Html::error($form, 'phone'); ?>
</div>
<div class="form-group">
    <?= Html::activeLabel($form, 'email', array('required' => true, 'class' => 'control-label')); ?>
    <?= Html::activeTextField($form, 'email', array('class' => 'form-control')); ?>
    <?= Html::error($form, 'email'); ?>
</div>
<div class="form-group">
    <?= Html::activeLabel($form, 'address', array('required' => true, 'class' => 'control-label')); ?>
    <?= Html::activeTextField($form, 'address', array('class' => 'form-control')); ?>
</div>
<div class="form-group">
    <?= Html::activeLabel($form, 'comment', array('required' => true, 'class' => 'control-label')); ?>
    <?= Html::activeTextArea($form, 'comment', array('class' => 'form-control')); ?>
</div>
<?php if (Yii::app()->user->isGuest && $form->registerGuest) { ?>
    <div class="form-group">
        <?= Html::activeLabel($form, 'registerGuest', array('required' => true, 'class' => 'control-label')); ?>
        <?= Html::activeCheckBox($form, 'registerGuest', array('class' => 'form-inline')); ?>
    </div>
<?php } ?>



