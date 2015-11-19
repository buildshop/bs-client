
<?php
$model = $this->model->children()->findAll();
?>
Еще категории: 
<ul class="list-inline">
    <?php foreach ($model as $t) { ?>
        <li>
            <?php echo Html::link($t->name, $t->getViewUrl()); ?>
        </li>
        <?php
    }
    ?>
</ul>



<?php $this->renderPartial('_sorting', array('itemView' => $itemView, 'viewAction' => true)); ?>
<?php
?>


<script>
    $(function(){
        $('.grid-table-row').hover(function(){
            //   $(this).toggleClass('active');

        });
    })
</script>

<div class=" product<?= $itemView ?>">		
    <?php if ($itemView == '_view_table') { ?>

            <table class="table">
                <tr>
                    <th style="width:5%"></th>
                    <th style="width:50%">Наименование</th>
                    <th style="width:15%"></th>
                    <th style="width:20%">цена</th>
                    <th style="width:10%"></th>
                </tr>
            <?php } ?>
            <?php

            $classRow = ($provider->itemCount > 0)?'row':'';
            $this->widget('ListView', array(
                'id' => 'shop-products',
                'htmlOptions' => array('class' => 'filters-container'),
                'dataProvider' => $provider,
                'ajaxUpdate' => true,
                'itemsCssClass' => 'items clearfix '.$classRow,
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
            <?php if ($itemView == '_view_table') { ?>
            </table>

    <?php } ?>
</div>



<?php $this->widget('mod.shop.widgets.brands.BrandsWidget'); ?>


<?php $this->widget('mod.shop.widgets.sessionView.SessionViewWidget'); ?>








