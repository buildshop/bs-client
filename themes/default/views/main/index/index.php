
<div class="row">
    <div class="col-xs-12">
        <h3 class="slider-title">Популярные</h3>
    </div>
</div>
<div class="row">
    <div class="owl-carousel home-slider custom-carousel owl-theme" data-item="3">
        <?php
        $this->renderPartial('//layouts/partials/_slider_hit', array(
            'id' => 'featured',
            'model' => ShopProduct::model()->newest()->findAll(array('limit' => 16))
        ));
        ?>
    </div> 
</div>


<div class="row">
    <div class="col-xs-12">
        <h3 class="slider-title">Популярные</h3>
    </div>
</div>
<div class="row">
    <div class="owl-carousel home-slider custom-carousel owl-theme" data-item="3">
        <?php
        $this->renderPartial('//layouts/partials/_slider_hit', array(
            'id' => 'featured',
            'model' => ShopProduct::model()->newest()->findAll(array('limit' => 16))
        ));
        ?>

    </div> 
</div>
