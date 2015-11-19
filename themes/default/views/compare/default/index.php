

<div class="col-xs-12">
    <?php if (!empty($this->model->products)) { ?>
        <table width="100%" cellpadding="3" cellspacing="3" class="compareTable table table-bordered table-striped">
            <thead>
                <tr>
                    <td width="200px"></td>
                    <?php foreach ($this->model->products as $p) { ?>
                        <td>
                            <div class="row product_view_grid">
                                <?php $this->renderPartial('//shop/category/_view_grid', array('data' => $p)) ?>
                            </div>
                        </td>
                    <?php } ?>
                </tr>
            </thead>
            <?php if (!empty($this->model->attributes)) { ?>
                <tbody>
                    <?php foreach ($this->model->attributes as $attribute) { ?>
                        <tr>
                            <td class="attr"><?php echo $attribute->title ?></td>
                            <?php foreach ($this->model->products as $product) { ?>
                                <td>
                                    <?php
                                    $value = $product->{'eav_' . $attribute->name};
                                    echo $value === null ? Yii::t('ShopModule.core', 'Не указано') : $value;
                                    ?>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            <?php } ?>
        </table>
    <?php } else { ?>
        <?php Yii::app()->tpl->alert('info', Yii::t('CompareModule.default', 'COMPARE_EMPTY')); ?>
    <?php } ?>
</div>
