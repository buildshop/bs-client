<div class="product_view_grid">
        <?php
        foreach ($model->relatedProducts as $data) {
            $this->renderPartial('/category/_view_grid', array('data' => $data));
        }
        ?>
</div>
