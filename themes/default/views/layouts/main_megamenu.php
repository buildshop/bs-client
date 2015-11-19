<?php
$this->renderPartial('//layouts/inc/registerAssets');
$config = Yii::app()->settings->get('core');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <title><?= Html::encode($this->pageTitle) ?></title>
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <meta name="robots" content="all">
    </head>
    <body>




        <div class="container">
            <nav class="navbar navbar-default">


                <div class="collapse navbar-collapse js-navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="dropdown mega-dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Collection1</a>

                            <div class="dropdown-menu mega-dropdown-menu row">
                                <div class="col-sm-3">
                                    <ul>
                                        <li class="dropdown-header">Dresses</li>
                                        <li><a href="#">Unique Features</a></li>
                                        <li><a href="#">Image Responsive</a></li>
                                        <li><a href="#">Auto Carousel</a></li>
                                        <li><a href="#">Newsletter Form</a></li>
                                        <li><a href="#">Four columns</a></li>
                                        <li class="divider"></li>
                                        <li class="dropdown-header">Tops</li>
                                        <li><a href="#">Good Typography</a></li>
                                         <li><a href="#">Good Typography 2</a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-3">
                                    <ul class="list-unstyled">
                                        <li class="dropdown-header">Jackets</li>
                                        <li><a href="#">Easy to customize</a></li>
                                        <li><a href="#">Glyphicons</a></li>
                                        <li><a href="#">Pull Right Elements</a></li>
                                        <li class="divider"></li>
                                        <li class="dropdown-header">Pants</li>
                                        <li><a href="#">Coloured Headers</a></li>
                                        <li><a href="#">Primary Buttons & Default</a></li>
                                        <li><a href="#">Calls to action</a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-3">
                                    <ul class="list-unstyled">
                                        <li class="dropdown-header">Accessories</li>
                                        <li><a href="#">Default Navbar</a></li>
                                        <li><a href="#">Lovely Fonts</a></li>
                                        <li><a href="#">Responsive Dropdown </a></li>							
                                                     
                                    </ul>
                                    <ul class="list-unstyled">
                                        <li class="dropdown-header">Accessories</li>
                                        <li><a href="#">Default Navbar</a></li>
                                        <li><a href="#">Lovely Fonts</a></li>
                                        <li><a href="#">Responsive Dropdown </a></li>							
                                                     
                                    </ul>
                                </div>
                            </div>

                        </li>
                        
                        
                        <li class="dropdown mega-dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Collection</a>

                            <div class="dropdown-menu mega-dropdown-menu">
                                
                    <?php
                    $this->widget('mod.shop.widgets.megamenu.CategoriesWidget', array(
                        'htmlOptions' => array('class' => ''),
                        'totalCount' => false,
                        'itemOptions' => array('class' => ''),
                        'submenuHtmlOptions' => array('class' => 'dropdown-menu')
                    ));
                    ?>
                                

                            </div>

                        </li>
                        
                    </ul>

                </div><!-- /.nav-collapse -->
            </nav>
        </div>





















        <?php $this->renderPartial('//layouts/partials/header', array('config' => $config)); ?>




        <?= $this->renderPartial('//layouts/partials/nav'); ?>



        <script>
            $(function () {
                $('[data-toggle="tooltip"]').tooltip();
                $('.selectpicker').selectpicker();
            })
        </script>

        <div class="container">
            <div class="row">
                <div class="filters col-md-3 col-sm-3">
                    <div class="side-heading">Каталог</div>
                    <div class="list-group">
                        <a class="list-group-item" href="category-grid.html">dasadsasd</a>
                        <a class="list-group-item" href="category-grid.html">dasadsasd</a>
                        <a class="list-group-item" href="category-grid.html">dasadsasd</a>
                        <a class="list-group-item" href="category-grid.html">dasadsasd</a>
                        <a class="list-group-item" href="category-grid.html">dasadsasd</a>
                    </div>
                    <?php
                    $this->widget('mod.shop.widgets.categories.CategoriesWidget', array(
                        'htmlOptions' => array('class' => ''),
                        'totalCount' => false,
                        'itemOptions' => array('class' => ''),
                        'submenuHtmlOptions' => array('class' => 'dropdown-menu')
                    ));
                    ?>
                </div>
                <div class="col-md-9 col-sm-9">
                    <div class="poroducts-panel">
                        <div class="row">
                            <div class="col-md-4">
                                сортировать:<select class="selectpicker" data-width="auto" data-style="btn-sm btn-link">
                                    <option>Mustard</option>
                                    <option>Ketchup</option>
                                    <option>Relish</option>
                                </select>
                            </div>
                            <div class="col-md-4 text-center">
                                на странице по:
                                <select class="selectpicker" data-width="auto" data-style="btn-sm btn-link">
                                    <option>10</option>
                                    <option>20</option>
                                </select>товаров
                            </div>
                            <div class="col-md-4 text-right">
                                <div class="btn-group" role="group">
                                    <a href="#" class="btn btn-sm btn-default"><i class="fa fa-bars"></i></a>
                                    <a href="#" class="btn btn-sm btn-default"><i class="fa fa-th"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="poroduct-list col-md-9 col-sm-9">
                    <div class="row">
                        <?php for ($x = 0; $x <= 11; $x++) { ?>
                            <div class="col-md-4 col-sm-6">
                                <div class="product">
                                    <div class="corner-right-purple stock"></div>
                                    <a href="#" class="product-image"><img src="<?= $this->assetsUrl ?>/images/product.jpg" alt="" /></a>
                                    <div class="text-center product-title">
                                        <a href="#">Супер товар 133</a>
                                    </div>
                                    <div class="text-center">
                                        <span class="price">
                                            <span>150</span><small>грн.</small>
                                        </span>
                                        <span class="price price-sm price-through">
                                            <span>150</span><small>грн.</small>
                                        </span>
                                    </div>
                                    <div class="text-center product-action">
                                        <a href="#" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="В избранное"><i class="fa fa-heart"></i></a>
                                        <a href="#" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="В сравнение"><i class="fa fa-compress"></i></a>
                                        <a href="#" class="btn btn-sm btn-success">Купить</a>
                                    </div>
                                </div>
                            </div>



                        <?php } ?>
                    </div>
                </div>


                <?= $content; ?>
            </div>
        </div>
        <?php $this->renderPartial('//layouts/partials/footer'); ?>

    </body>
</html>