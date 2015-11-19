<h1><?= $error['code'] ?></h1>
<?php
$message = (empty($error['message'])) ? Yii::t('error', $error['code']) : $error['message'];
?>
<p><?= $message ?></p>
