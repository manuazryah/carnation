<?php

use yii\helpers\Html;
use common\models\Fregrance;
use common\components\ProductLinksWidget;
?>
<?php

if (!empty($recently_viewed)) {
    ?>


    <?php

    foreach ($recently_viewed as $featured) {
        $class = '';
        ?>

        <?= ProductLinksWidget::widget(['id' => $featured->product_id, 'div_id' => $class]) ?> 
        <?php

    }
}
?>

