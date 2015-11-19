<?php
if ($config['filter_enable_attr']) {
    foreach ($attributes as $attrData) {
        ?>

 <div class="container-filter">
        <div class="widget-header">
            <h4 class="widget-title"><?= Html::encode($attrData['title']) ?></h4>
        </div>

        <ul class="list-filter">
            <?php
            foreach ($attrData['filters'] as $filter) {
                $url = Yii::app()->request->addUrlParam('/shop/category/view', array($filter['queryKey'] => $filter['queryParam']), $attrData['selectMany']);
                $queryData = explode(',', Yii::app()->request->getQuery($filter['queryKey']));

                echo Html::openTag('li');
                $count = ($filter['count'] > 0) ? '<span>(' . $filter['count'] . ')</span>' : '<span>(0)</span>';
                if ($filter['count'] > 0) {
                    if (in_array($filter['queryParam'], $queryData)) {
                        $url = Yii::app()->request->removeUrlParam('/shop/category/view', $filter['queryKey'], $filter['queryParam']);
                        echo Html::link($filter['title'], $url, array('class' => 'active'));
                    } else {
                        echo Html::link($filter['title'], $url);
                    }
                } else {
                    echo $filter['title'];
                }
                echo $count;
                echo Html::closeTag('li');
            }
            ?>
        </ul>


 </div>
        <?php
    }
}
