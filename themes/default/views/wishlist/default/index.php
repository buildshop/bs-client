<div class="text-right">
    <a class="btn btn-primary" href="mailto:?body=<?php echo $this->model->getPublicLink() ?>&subject=<?php echo Yii::t('WishlistModule.default', 'MY_WISHLIST') ?>"><?php echo Yii::t('ShopModule.core', 'Отправить') ?></a>
</div>
<?php if (!empty($this->model->products)) { ?>
    <div class="row product_view_grid">
        <?php
        foreach ($this->model->products as $p) {
            $this->renderPartial('_product', array(
                'data' => $p,
            ));
        }
        ?>
    </div>
<?php } else { ?>
    <?php Yii::app()->tpl->alert('info',Yii::t('WishlistModule.default', 'WISHLIST_EMPTY')); ?>
<?php } ?>