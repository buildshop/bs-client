<div class="h4"><?php
echo Yii::t('ShopModule.core', 'Результаты поиска');
if (($q = Yii::app()->request->getParam('q')))
    echo ' "' . Html::encode($q) . '"';
?></div>


<?php
echo Yii::app()->controller->action->id;
echo Yii::app()->controller->id;

$this->renderPartial('_sorting', array(
    'itemView' => '_grid',
    'viewAction' => false
));
?>

<div class=" product_view_grid">	
    <?php
    $classRow = ($provider->itemCount > 0) ? 'row' : '';
    $this->widget('ListView', array(
        'id' => 'shop-products',
        'htmlOptions' => array('class' => 'filters-container'),
        'dataProvider' => $provider,
        'ajaxUpdate' => true,
        'itemsCssClass' => 'items clearfix ' . $classRow,
        'template' => '{items} {pager}',
        'enableHistory' => true,
        'itemView' => $itemView,
        'sortableAttributes' => array(
            'name', 'price'
        ),
        'pagerCssClass' => 'col-xs-12 text-center',
        'pager' => array(
            //'htmlOptions' => array('class' => 'pagination'),
            'header' => '',
            'cssFile' => false,
            'nextPageLabel' => '<i class="fa fa-angle-right"></i>',
            'prevPageLabel' => '<i class="fa fa-angle-left"></i>',
            'firstPageLabel' => false,
            'lastPageLabel' => false,
        )
    ));
    ?>
</div>
