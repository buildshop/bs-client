<?php $this->renderPartial('/category/_sorting', array('itemView' => $itemView, 'viewAction' => false)); ?>
<h1><?php echo CHtml::encode($this->model->name); ?></h1>
<div id="product_view_grid" class="row">	
    <?php
    $this->widget('ListView', array(
        //'id' => 'shop-products',
        'htmlOptions' => array('class' => ' filters-container'),
        'dataProvider' => $provider,
        'ajaxUpdate' => true, //$ajaxUpdate
        'itemsCssClass' => 'items clearfix',
        'pagerCssClass' => 'pagination-container',
        'template' => '{items} {pager}',
        'enableHistory' => true,
        'itemView' => '/category/_view_grid',
        'sortableAttributes' => array(
            'name', 'price'
        ),
        'pager' => array(
            'htmlOptions' => array('class' => 'list-inline list-unstyled'),
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
<?php if (!empty($this->model->description)) { ?>
    <div class="manufacturer-text">
        <?php echo $this->model->description ?>
    </div>
<?php } ?>

