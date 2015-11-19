<div class="poroducts-panel">
    <div class="row">
        <div class="col-md-4">
            <?php
            echo Yii::t('app', 'SORT', 1);
            echo Html::dropDownList('sorter', Yii::app()->request->url, array(
                Yii::app()->request->addUrlParam('/shop/category/view', array('sort' => 'date_create.desc')) => Yii::t('app', 'SORT_BY', 2),
                Yii::app()->request->addUrlParam('/shop/category/view', array('sort' => 'price')) => Yii::t('app', 'SORT_BY', 0),
                Yii::app()->request->addUrlParam('/shop/category/view', array('sort' => 'price.desc')) => Yii::t('app', 'SORT_BY', 1),
                    ), array(
                'data-style' => 'btn-sm btn-link',
                'data-width' => '100px',
                'class' => 'selectpicker',
                'onchange' => 'applyCategorySorter(this)'
            ));
            ?>
        </div>
        <div class="col-md-4 text-center">
            <?= Yii::t('app', 'OUTPUT_ON'); ?>
            <?php
            $limits = array(Yii::app()->request->removeUrlParam('/shop/category/view', 'per_page') => $this->allowedPageLimit[0]);
            array_shift($this->allowedPageLimit);
            foreach ($this->allowedPageLimit as $l)
                $limits[Yii::app()->request->addUrlParam('/shop/category/view', array('per_page' => $l))] = $l;
            ?>
            <?php
            echo Html::dropDownList('per_page', Yii::app()->request->url, $limits, array(
                'data-width' => 'auto',
                'data-style' => 'btn-sm btn-link',
                'class' => 'selectpicker',
                'onchange' => 'applyCategorySorter(this)'
            ));
            ?>

            <?= Yii::t('app', 'PRODUCTS'); ?>
        </div>
        <?php if ($viewAction) { ?>
            <div class="col-md-4 text-right">
                <div class="" role="group">
                    <a href="<?= Yii::app()->request->removeUrlParam('/shop/category/view', 'view') ?>" class="btn btn-link <?php if ($itemView === '_view_grid') echo 'active'; ?>" data-toggle="tooltip" data-placement="bottom" title="Плитка"><i class="fa fa-th-large"></i></a>
                    <a href="<?= Yii::app()->request->addUrlParam('/shop/category/view', array('view' => 'list')) ?>" class="btn btn-link <?php if ($itemView === '_view_list') echo 'active'; ?>" data-toggle="tooltip" data-placement="bottom" title="Подробно"><i class="fa fa-bars"></i></a>
                    <a href="<?= Yii::app()->request->addUrlParam('/shop/category/view', array('view' => 'table')) ?>" class="btn btn-link <?php if ($itemView === '_view_table') echo 'active'; ?>" data-toggle="tooltip" data-placement="bottom" title="Список"><i class="fa fa-list-alt"></i></a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>



