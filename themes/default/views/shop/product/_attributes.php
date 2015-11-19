<table class="table table-striped">
<?php

$this->widget('mod.shop.components.AttributesRender', array(
    'model' => $model,
    'tagName'=>false,
    'htmlOptions' => array(
        'class' => 'row'
    ),
    'template' => '<tr><td>{title}:</td><td>{value}</td></tr>'
));
?>

</table>
