<style>

</style>

<?php
$config = Yii::app()->settings->get('shop');
echo $this->render('currentTheme.views.layouts.partials.widgets.filter.views._currentFilter', array(), true);
echo $this->render('currentTheme.views.layouts.partials.widgets.filter.views._priceFilter', array('config' => $config), true);
echo $this->render('currentTheme.views.layouts.partials.widgets.filter.views._manufacturerFilter', array(
    'config' => $config,
    'manufacturers' => $manufacturers
        ), true);
echo $this->render('currentTheme.views.layouts.partials.widgets.filter.views._attributesFilter', array(
    'config' => $config,
    'attributes' => $attributes
        ), true);
?>
