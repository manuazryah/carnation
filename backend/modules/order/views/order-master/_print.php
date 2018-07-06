<?php ?>
<div id="print">
    <style type="text/css">
        tfoot{display: table-footer-group;}
        table { page-break-inside:auto;}
        tr{ page-break-inside:avoid; page-break-after:auto; }

        @page {
            size: A4;
        }
        @media print {
            thead {display: table-header-group;}
            tfoot {display: table-footer-group}
            /*tfoot {position: absolute;bottom: 0px;}*/
            .main-tabl{width: 100%}
            .footer {position: fixed ; left: 0px; bottom: 0px; right: 0px; font-size:10px; }
            .main-tabl{
                -webkit-print-color-adjust: exact;
                margin: auto;
                /*tr{ page-break-inside:avoid; page-break-after:auto; }*/
            }

        }
        @media screen{
            .main-tabl{
                width: 60%;
            }
        }
        body h6,h1,h2,h3,h4,h5,p,b,tr,td,span,div{
            color:#525252 !important;
        }
        .main-tabl{
            margin: auto;
        }
        .main-left{
            float: left;
        }
        .main-right{
            float: right;

        }
        .heading{
            width: 100%;
            text-align: center;
            font-weight: bold;
            font-size: 17px;
        }
        .print{
            margin-top: 20px;
            margin-left: 530px;
        }
        .save{
            margin-top: 18px;
            margin-left: 6px !important;
        }
        .heading p{
            font-size: 11px;
            line-height: 5px;
        }
        .left-address p{
            font-size: 11px;
            line-height: 5px;
        }
        .footer {
            width: 100%;
            display: inline-block;
            font-size: 15px;
            color: #4e4e4e;
            border-top: 1px solid #a09c9c;
            padding: 9px 0px 3px 0px;
        }
        .footer p {
            text-align: center;
            font-size: 9px;
            margin: 0px !important;
            color: #525252 !important;
            font-weight: 600;
        }
    </style>
    <table class="main-tabl" border="0" style="font-family: Roboto, sans-serif !important;">
        <thead>
            <tr>
                <th style="width:100%">
                    <div class="header">
                        <div class="main-left">
                            <img width="" height="" src="<?= Yii::$app->homeUrl ?>images/logo.png"/>
                        </div>
                        <div class="main-right" style="padding-top: 12px;">
                            <div class="heading" style="font-weight:normal">
                                <strong style="text-transform:uppercase;font-size:25px;">ORDER SUMMARY</strong>
                            </div>
                        </div>
                        <br/>
                    </div>
                </th>
            </tr>

        </thead>
        <tbody>
            <tr>
                <td>
                    <div class="close-estimate-heading-top" style="margin-bottom:30px;">
                        <div class="main-left left-address" style="padding-top: 10px;">
                            <table class="tb2">
                                <tr>
                                    <td style="max-width: 405px;font-size: 11px;">
                                        <p><label style="font-weight:bold;text-decoration: underline">CONSIGNOR</label></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="max-width: 405px;font-size: 11px;">
                                        <p style="padding-top: 15px;font-weight: 700;">CARNATION CITY PERFUMES LLC</p>
                                        <p >Dubai Zip Code: 84606 City of Dubai</p>
                                        <p >Email : info@carnation.com</p>
                                        <p >Tel : +9714-3217112, Fax : +9714-3217127</p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="main-right left-address" style="margin: 0px 16px 0px 0px;">
                            <table class="tb2">
                                <tr>
                                    <td style="max-width: 405px;">
                                        <table>
                                            <tr style="font-size: 11px;">
                                                <td style="max-width: 405px;font-size: 11px;">
                                                    <?php if (($order_master->payment_status == 3 || $order_master->payment_status == 1) || ( $order_master->admin_status != 0 && $order_master->admin_status != 5)) { ?>
                                                                                                                <p style="padding-top: 15px;font-weight: 700;text-transform: uppercase">INV:- CRL/<?= date('Md', strtotime($order_master->order_date)) ?>/<?= sprintf('%04d', $order_master->invoice_no); ?></p>
                                                                                                        <?php } ?>
                                                    <p >Date: <?= date('d-m-Y', strtotime($order_master->order_date)) ?></p>
                                                    <p >Order No: <?= $order_master->order_id ?></p>
                                                    <p >TRN : 100240029700003</p>
                                                </td>
                                            </tr>

                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <br/>
                </td>
            </tr>


            <tr>
                <td>
                    <div class="close-estimate-heading-top" style="margin-bottom:30px;">
                        <div class="main-left left-address" style="padding-top: 10px;">
                            <table class="tb2">
                                <tr>
                                    <td style="max-width: 405px;font-size: 11px;">
                                        <p><label style="font-weight:bold;text-decoration: underline">BILLING ADDRESS</label></p>
                                    </td>
                                </tr>
                                <?php
                                $bill_address = \common\models\UserAddress::findOne($order_master->bill_address_id);
                                ?>
                                <tr>
                                    <td style="max-width: 405px;font-size: 11px;">
                                        <p style="padding-top: 15px;"><?= $bill_address->name ?></p>
                                        <p ><?= $bill_address->address ?></p>
                                        <p ><?= $bill_address->location ?></p>
                                        <p ><?= $bill_address->landmark ?></p>
                                        <p >Tel : <?= $bill_address->mobile_number ?></p>
                                        <p ><?= $order_master->other_details ?></p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="main-right left-address" style="padding-top: 10px;margin: 0px 30px 0px 0px;">
                            <table class="tb2">
                                <tr>
                                    <td style="max-width: 405px;font-size: 11px;">
                                        <p><label style="font-weight:bold;text-decoration: underline">PAYMENT METHOD</label></p>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td style="max-width: 405px;font-size: 11px;">
                                        <?php
                                        $status_payment = '';
                                        if ($order_master->payment_status == 3)
                                            $status_payment = "Cash on Delivery";
                                        if ($order_master->payment_status == 1)
                                            $status_payment = "Credit/Debit Card Payment";
                                        if ($order_master->payment_status == 0)
                                            $status_payment = "Pending";
                                        if ($order_master->payment_status == 2)
                                            $status_payment = "Failed";
                                        ?>
                                        <p style="padding-top: 15px;"> <?= $status_payment ?></p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <br/>
                </td>
            </tr>



            <tr>
                <td>
                    <div class="invoice-details"style="margin-top: 10px;min-height: 375px;">
                        <table style="width:100%;border-collapse: collapse;text-align: left;">
                            <tr style="background: #4e5254;color: white !important;">
                                <th style="width: 5%;font-size: 12px;padding: 10px 5px;">Sl No.</th>
                                <th style="width: 20%;font-size: 12px;padding: 10px 2px;">Product</th>
                                <th style="width: 5%;font-size: 12px;padding: 10px 2px;">Qty</th>
                                <th style="width: 12%;font-size: 12px;padding: 10px 2px;">Price</th>
                                <th style="width: 10%;font-size: 12px;padding: 10px 2px;">Amount</th>
                                <!--<th style="width: 10%;font-size: 12px;padding: 10px 2px;">Tax </th>-->
                                <th style="width: 15%;font-size: 12px;padding: 10px 2px;">Tax Amount</th>
                                <th style="width: 20%;font-size: 12px;padding: 10px 2px;">Total Amount</th>
                            </tr>

                            <?php
                            $i = 0;
                            foreach ($order_details as $value) {
                                $i++;
                                if ($value->item_type == 1) {
                                    $product = common\models\CreateYourOwn::find()->where(['id' => $value->product_id])->one();
                                } else {
                                    $product = common\models\Product::find()->where(['id' => $value->product_id])->one();
                                    $value->amount = $value->amount - ($value->tax / $value->quantity);
                                    $price = $value->quantity * $value->amount;
                                }
                                ?>

                                <tr>
                                    <td style="width: 8%;font-size: 11px;padding: 10px 5px;"><?= $i ?></td>
                                    <td style="width: 25%;font-size: 11px;padding: 10px 2px;"><?= $value->item_type == 1 ? 'Custom Perfume' : $product->product_name; ?></td>
                                    <td style="width: 8%;font-size: 11px;padding: 10px 2px;"><?= $value->quantity ?></td>
                                    <td style="width: 11%;font-size: 11px;padding: 10px 2px;"><?= sprintf('%0.2f', $value->amount); ?></td>
                                    <td style="width: 15%;font-size: 11px;padding: 10px 2px;"><?= sprintf('%0.2f', $value->quantity * $value->amount); ?></td>
                                    <td style="width: 11%;font-size: 11px;padding: 10px 2px;"><?= sprintf('%0.2f', $value->tax); ?></td>
                                    <td style="width: 20%;font-size: 11px;padding: 10px 2px;"><?= sprintf('%0.2f', $value->rate); ?></td>
                                </tr>
                                <?php
                            }
                            ?>






                        </table>
                    </div>
                    <br/>

                    <div class="invoice-details"style="margin-top: 10px;">
                        <table style="width:100%;border-collapse: collapse;text-align: left;">
                            <tr style="border-top: 1px solid #a09c9c;">
                                <th colspan="3"style="width: 30%;font-size: 12px;padding: 10px 2px;"></th>
                                <th  style="width: 20%;font-size: 12px;padding: 10px 2px;text-align: right;">Subtotal : </th>
                                <th style="width: 15%;font-size: 12px;padding: 10px 13px;"><?= sprintf('%0.2f', $order_master->tax_amount); ?>  (Tax)</th>
                                <th style="width: 15%;font-size: 12px;padding: 10px 18px;text-align: right;"><?= sprintf('%0.2f', $order_master->total_amount); ?></th>
                            </tr>


                            <?php
                            $promotion_disvount = 0;
                            if (isset($promotions) && $promotions > 0) {
                                $promotion_disvount = $promotions;
                                ?>
                                <tr style="">
                                    <th colspan="3"style="width: 50%;font-size: 12px;padding: 10px 2px;"></th>
                                    <th colspan="" style="width: 30%;font-size: 12px;padding: 10px 2px;text-align: right;">Coupon Code  Added (-): </th>
                                    <th style="width: 15%;font-size: 12px;padding: 10px 2px;text-align: right;"></th>
                                    <th style="width: 15%;font-size: 12px;padding: 10px 18px;text-align: right;"><?= sprintf('%0.2f', $promotions); ?> </th>
                                </tr>
                            <?php } ?>

                            <tr style="">
                                <th colspan="3"style="width: 50%;font-size: 12px;padding: 10px 2px;"></th>
                                <th colspan="" style="width: 30%;font-size: 12px;padding: 10px 2px;text-align: right;">Delivery Charges : </th>
                                <th style="width: 15%;font-size: 12px;padding: 10px 2px;text-align: right;border-bottom: 1px solid #000;"></th>
                                <th style="width: 15%;font-size: 12px;padding: 10px 18px;text-align: right;border-bottom: 1px solid #000;"><?= sprintf('%0.2f', $order_master->shipping_charge); ?> </th>
                            </tr>
                            <?php if ($order_master->gift_wrap == "1") { ?>
                            <tr style="">
                                <th colspan="3"style="width: 50%;font-size: 12px;padding: 10px 2px;"></th>
                                <th colspan="" style="width: 30%;font-size: 12px;padding: 10px 2px;text-align: right;">Gift Wrap Charges : </th>
                                <th style="width: 15%;font-size: 12px;padding: 10px 2px;text-align: right;border-bottom: 1px solid #000;"></th>
                                <th style="width: 15%;font-size: 12px;padding: 10px 18px;text-align: right;border-bottom: 1px solid #000;"><?= sprintf('%0.2f', $order_master->gift_wrap_value); ?> </th>
                            </tr>
                            <?php } ?>
                            
                            <tr style="">
                                <th colspan="3"style="width: 50%;font-size: 12px;padding: 10px 2px;"></th>
                                <th colspan="" style="width: 30%;font-size: 12px;padding: 10px 2px;text-align: right;">Grand Total : </th>
                                <th style="width: 15%;font-size: 12px;padding: 10px 2px;text-align: right;"></th>
                                <th style="width: 15%;font-size: 12px;padding: 10px 18px;text-align: right;"><?= sprintf('%0.2f', $order_master->net_amount); ?> </th>
                            </tr>

                        </table>
                    </div>
                    <div style="clear:both"></div>
                    <br/>


                    <div class="invoice-details"style="margin-bottom: 10px">
                        <table style="width:100%;">
                            <tr>
                                <th style="width:50%;font-size: 10px;padding: 10px 0px;text-align: justify;font-weight: normal">
                                    If there is a problem with the delivery of the item , kindly do let us know so that
                                    it can be fixed as soon as possible. Upon the receipt of the products, we kindly insist you to leave a feedback to
                                    info@carnation.com.
                                </th>
                                <th style="width:50%;font-size: 10px;padding: 10px 0px;text-align: right">


                                </th>

                            </tr>



                        </table>
                    </div>

                </td></tr>
        </tbody>

    </table>
</div>

<script             type="text/javascript">

    window.print();
    setTimeout(function () {
        window.close();
    }, 500);
</script>