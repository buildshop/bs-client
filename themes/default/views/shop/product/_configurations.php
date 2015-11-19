<?php
$processVariants = $model->processVariants();

if (count($processVariants)) {
    ?>
    <div class="errors" id="productErrors"></div>

    <table class="configurations">
        <?php
        $jsVariantsData = array();

        foreach ($processVariants as $variant) {
            $dropDownData = array();
            echo '<tr><td class="attr_name">';
            echo $variant['attribute']->title . ':';
            echo '</td><td>';

            foreach ($variant['options'] as $v) {
                $jsVariantsData[$v->id] = $v;
                $dropDownData[$v->id] = $v->option->value;
            }
            echo Html::dropDownList('eav[' . $variant['attribute']->id . ']', null, $dropDownData, array('data-width' => '60px', 'data-style' => 'btn-sm btn-inverse', 'class' => 'variantData selectpicker', 'empty' => '---'));
            echo '</td></tr>';
        }

        // Register variant prices script
        Yii::app()->clientScript->registerScript('jsVariantsData', '
			var jsVariantsData = ' . CJavaScript::jsonEncode($jsVariantsData) . ';
		', CClientScript::POS_END);

        // Display product configurations
        if ($model->use_configurations) {
            // Get data
            $confData = $this->getConfigurableData();

            // Register configuration script
            Yii::app()->clientScript->registerScript('productPrices', strtr('
							var productPrices = {prices};
						', array(
                        '{prices}' => CJavaScript::encode($confData['prices'])
                    )), CClientScript::POS_END);

            foreach ($confData['attributes'] as $attr) {
                if (isset($confData['data'][$attr->name])) {
                    echo '<tr><td class="attr_name">';
                    echo $attr->title . ':';
                    echo '</td><td>';
                    echo Html::dropDownList('configurations[' . $attr->name . ']', null, array_flip($confData['data'][$attr->name]), array('data-width' => '60px', 'data-style' => 'btn-sm btn-inverse', 'class' => 'eavData selectpicker'));
                    echo '</td></tr>';
                }
            }
        }
        ?>
    </table>

    <?php
} else {
    echo '';
}
?>