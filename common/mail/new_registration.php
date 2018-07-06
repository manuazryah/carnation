<?php

use yii\helpers\Html;
use common\models\User;
use common\models\CountryCode;
?>
<div style="/* margin: 20px 200px 0px 300px; */border: 1px solid #9E9E9E;">
                        <div class="content" style="margin-left: 40px;">
                                <h2 style="text-align: center;">New User Registration</h2>

                                <p style="text-align:center"><?= $user->first_name . ' ' . $user->last_name ?> , is registered as new user.</p>
                                <p style="text-align:center">Here is the details of new user :</p>
                                <table style="margin:auto;">
                                        <tr>
                                                <td>Name </td>
                                                <td>:</td>
                                                <td><?= $user->first_name . ' ' . $user->last_name ?> </td>
                                        </tr>
                                        <tr>
                                                <td>Email </td>
                                                <td>:</td>
                                                <td><?= $user->email ?> </td>
                                        </tr>
                                        <?php
                                        if (isset($user->country) && $user->country != '') {
                                                $country = CountryCode::findOne($user->country);
                                                if (!empty($country)) {
                                                        ?>
                                                        <tr>
                                                                <td>Country </td>
                                                                <td>:</td>
                                                                <td><?= $country->country_name ?></td>
                                                        </tr>
                                                        <?php
                                                }
                                        }
                                        ?>

                                        <?php
                                        if (isset($user->gender) && $user->gender != '') {
                                                $gender = '';
                                                if ($user->gender == 1) {
                                                        $gender = 'Male';
                                                } else if ($user->gender == 2) {
                                                        $gender = 'Female';
                                                }
                                                ?>
                                                <tr>
                                                        <td>Gender </td>
                                                        <td>:</td>
                                                        <td><?= $gender ?></td>
                                                </tr>
                                        <?php }
                                        ?>

                                        <?php
                                        if (isset($user->mobile_no) && $user->mobile_no != '') {
                                                $mobile_no = $user->mobile_no;
                                                if (isset($user->country_code)) {
                                                        $country_code = CountryCode::findOne($user->country_code);
                                                        if (!empty($country_code))
                                                                $mobile_no = $country_code->country_code . ' - ' . $mobile_no;
                                                }
                                                ?>
                                                <tr>
                                                        <td>Mobile Number </td>
                                                        <td>:</td>
                                                        <td><?= $mobile_no ?></td>
                                                </tr>
                                        <?php }
                                        ?>
                                </table>


                        </div>
                </div>