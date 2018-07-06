<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserAddressSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Addresses';
$this->params['breadcrumbs'][] = $this->title;
?>
<link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>admin/css/custom.css">
<div class="user-address-index">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="panel-body">
                        <div class="user-address-create">
                            <?=
                            $this->render('_form', [
                                'model' => $model,
                            ])
                            ?>
                        </div>
                    </div>
                    <div>
                        <h4 style="padding: 10px 15px;font-weight: 600;">Your Saved Addresses :</h4>
                        <?php foreach ($user_address as $value) { ?>
                            <div class="col-md-4" id="useraddress-<?= $value->id ?>">
                                <div class="box" style="background: #edf7f6;padding: 15px 15px;margin-bottom: 15px;">
                                    <p><strong><?= $value->name ?></strong></p>
                                    <p><?= $value->address ?></p>
                                    <p><?= $value->mobile_number ?></p>
                                    <p><input type="radio" name="default-address" value="<?= $value->id ?>" <?php
                                        if ($value->status == 1) {
                                            echo checked;
                                        }
                                        ?> > Default address<br></p>
                                    <p><a class="delete-address" data-val="<?= $value->id ?>" style="cursor: pointer;"> Delete address</a></p>
                                </div>
                            </div>
                        <?php }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('input[type=radio][name=default-address]').change(function () {
            var idd = $(this).val();
            $.ajax({
                url: '<?= Yii::$app->homeUrl; ?>myaccounts/user-address/change-status',
                type: "POST",
                data: {id: idd},
                success: function (data) {
                }
            });
        });
        $('.delete-address').on('click', function () {
            var idd = $(this).attr('data-val');
            $.ajax({
                url: '<?= Yii::$app->homeUrl; ?>myaccounts/user-address/remove-address',
                type: "POST",
                data: {id: idd},
                success: function (data) {
                    if (data == 1) {
                        $("#useraddress-" + idd).remove();
                    }
                }
            });
        });
    });
</script>

