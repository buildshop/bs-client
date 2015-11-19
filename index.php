<?php
//Timezone
date_default_timezone_set("UTC");

defined('DS') or define('DS', DIRECTORY_SEPARATOR);
$webRoot = dirname(__FILE__);


if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1') {
    defined('YII_DEBUG') or define('YII_DEBUG', true);
    $yii = $webRoot.'/../../framework/yii.php';
}else{
    $yii = $webRoot.'/../framework/yiilite.php';
}

$config = $webRoot . '/protected/config/client.php';

require_once $yii;
require_once $webRoot.'/../common/components/Application.php';

// Create application
Yii::createApplication('Application', $config)->run();


