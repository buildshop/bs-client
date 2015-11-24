
<nav class="navbar navbar-static-top">
    <div class="">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="fa fa-bars"></span>

            </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">

            <?php
            $this->widget('ext.bootstrap.NestedMenu', array(
                'htmlOptions' => array('class' => 'nav navbar-nav'),
                    //  'items' => $items
            ));

            /*
              $this->widget('ext.menu.MenuWidget', array(
              'htmlOptions' => array('class' => 'nav navbar-nav'),
              'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
              'items' => array(
              array(
              'label' => Yii::t('app', 'CONTACTS') . ' <span class="caret"></span>',
              'url' => array('/contacts'),
              'encodeLabel' => false,
              'itemOptions' => array('class' => 'dropdown'),
              'linkOptions' => array(
              'class' => 'dropdown-toggle',
              'data-toggle' => 'dropdown',
              'aria-haspopup' => 'true',
              'aria-expanded' => 'false',
              ),
              'items' => array(
              array(
              'label' => Yii::t('app', 'CONTACTS'),
              'url' => array('/contacts'),
              'items' => array(
              array(
              'label' => Yii::t('app', 'CONTACTS111'),
              'url' => array('/contacts')
              )
              ),
              )
              ),
              ),
              ),
              )); */
            ?>

        </div>
    </div>
</nav>