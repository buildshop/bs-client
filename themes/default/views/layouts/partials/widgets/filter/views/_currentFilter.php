<?php
$active = $this->getActiveFilters();

if (!empty($active)) {
    ?>
    <div class="container-filter">
        <div class="widget-header">
            <h4 class="widget-title"><?=Yii::t('ShopModule.default', 'CURRENT_FILTER_TITLE')?></h4>
        </div>
        <div class="sidebar-widget-body m-t-10">
            <?php
            $this->widget('zii.widgets.CMenu', array(
                'htmlOptions' => array('class' => 'list-filter current-select'),
                'items' => $active,
            ));
            echo Html::link(Yii::t('ShopModule.default', 'RESET_FILTERS_BTN'), $this->getOwner()->model->viewUrl, array('class' => 'btn btn-xs btn-primary'));
            ?>
        </div>
    </div>

<?php }
?>
