<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;

Modal::begin([
    'header' => '',
    'id' => 'modal',
    'size' => 'modal-lg',
]);
echo "<div id = 'modalContent'></div>";
Modal::end();
?>
<script>
        $(document).ready(function () {
                $(".user-profile").click(function () {

                        $(".user-profile").toggleClass("open");
                });
                $(".hover-line").click(function () {

                        $(".hover-line").toggleClass("open");
                });
        });
</script>