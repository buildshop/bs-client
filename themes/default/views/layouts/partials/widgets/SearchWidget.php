<?php
//$value = (isset($_GET['q'])) ? $_GET['q'] : '';
?>
<?= Html::form(Yii::app()->controller->createUrl('/shop/category/search'), 'post', array('id' => 'search-form', 'class' => 'form-inline')) ?>
<div class="input-group">
    <input type="text" value="<?= $value ?>" placeholder="Поиск..." name="q" class="form-control" id="searchQuery" />
    <span class="input-group-btn">
        <a href="javascript:document.forms['search-form'].submit()" class="btn btn-default"><i class="fa fa-search"></i></a>

    </span>
</div>
<?= Html::endForm() ?>


<script>
    $(function(){
        $('#searchQuery').keydown(function(event){ 
            if (event.which == 13) {
                $('#search-form').submit();
            }
        });
    });
</script>