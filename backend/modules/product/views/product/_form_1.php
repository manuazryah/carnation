<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Category;
use common\models\SubCategory;
use common\models\Unit;
use common\models\Currency;
use common\models\MasterSearchTag;
use common\models\Product;
use common\models\Brand;
use common\models\Fregrance;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form form-inline">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->errorSummary($model); ?>
    <ul class="nav nav-tabs">
        <!--        <li class="active">
                    <a href="#general" data-toggle="tab">
                        <span class="visible-xs"><i class="fa-home"></i></span>
                        <span class="hidden-xs">General</span>
                    </a>
                </li>
                <li>
                    <a href="#meta" data-toggle="tab">
                        <span class="visible-xs"><i class="fa-home"></i></span>
                        <span class="hidden-xs">Meta</span>
                    </a>
                </li>
                <li>
                    <a href="#image" data-toggle="tab">
                        <span class="visible-xs"><i class="fa-user"></i></span>
                        <span class="hidden-xs">Image</span>
                    </a>
                </li>
                <li style="float: right;">
        <?php // echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-success', 'style' => 'margin-top: 5px; height: 36px; width:100px;']) ?>

                </li>-->
    </ul>


    <div class="tab-content">
        <div class="tab-pane active" id="general">
            <div class="row" style="margin: 0 auto; padding: 15px 15px;">
                <div class='col-md-12 col-sm-6 col-xs-12 '>
                    <?php if ($model->isNewRecord) $model->main_category = '1'; ?>
                    <?= $form->field($model, 'main_category')->radioList(['1' => 'Our Products', '2' => 'International Products'], ['class' => 'main_category']); ?>
                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 '>
                    <?php
                    if (!$model->isNewRecord) {
                        $cat = Category::find()->where(['main_category' => $model->main_category, 'status' => '1'])->all();
                        echo $form->field($model, 'category')->dropDownList(ArrayHelper::map($cat, 'id', 'category'), ['prompt' => 'select']);
                    } else {
                        ?>
                        <?=
                        $form->field($model, 'category')->dropDownList(ArrayHelper::map(Category::find()->where(['main_category' => '1'])->all(), 'id', 'category'), ['prompt' => 'select']);
                    }
                    ?>
                    <label onclick="jQuery('#modal-1').modal('show', {backdrop: 'fade'});" class="btn btn-icon btn-white extra_btn add_category">Add Category</label>
                </div>
                <div class='col-md-4 col-sm-6 col-xs-12'>
                    <?php
                    if (!$model->isNewRecord) {
                        $subcat = SubCategory::find()->where(['category_id' => $model->category, 'status' => '1'])->all();
                    } else {
                        $subcat = [];
                    }
                    echo $form->field($model, 'subcategory')->dropDownList(ArrayHelper::map($subcat, 'id', 'sub_category'), ['prompt' => 'Select']);
                    ?>
                    <label onclick="jQuery('#modal-2').modal('show', {backdrop: 'fade'});" class="btn btn-icon btn-white extra_btn add_subcat">Add Subcategory</label>
                </div>
                <div class='col-md-4 col-sm-6 col-xs-12'>
<?= $form->field($model, 'product_name')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>
                </div>
                <div class='col-md-4 col-sm-6 col-xs-12'>
                <?= $form->field($model, 'canonical_name')->textInput(['maxlength' => true, 'readOnly' => true]) ?>
                </div>
                <?php
                if ($model->isNewRecord) {
                    $serial_no = \common\models\Settings::findOne(3)->value;
                    $model->item_ean = $this->context->generateProductEan($serial_no);
                }
                ?>
                <div class='col-md-4 col-sm-6 col-xs-12'>
<?= $form->field($model, 'item_ean')->textInput(['maxlength' => true, 'readOnly' => true]) ?>
                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 '>
<?= $form->field($model, 'brand')->dropDownList(ArrayHelper::map(Brand::find()->all(), 'id', 'brand'), ['prompt' => 'select']) ?>
                    <label onclick="jQuery('#modal-5').modal('show', {backdrop: 'fade'});" class="btn btn-icon btn-white extra_btn add_brand">Add Brand</label>
                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 '>
<?= $form->field($model, 'gender_type')->dropDownList(['0' => 'Men', '1' => 'Women', '2' => 'Unisex']) ?>
                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 '>
<?= $form->field($model, 'price')->textInput(['type' => 'number', 'min' => '0', 'autocomplete' => 'off']) ?>
                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 '>
<?= $form->field($model, 'offer_price')->textInput(['type' => 'number', 'min' => '0', 'autocomplete' => 'off']) ?>
                    <label id="offer_price" style="color:#cc3f44"class="hide">Offer price must be less than price</label>
                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 '>
<?= $form->field($model, 'currency')->dropDownList(ArrayHelper::map(Currency::find()->all(), 'id', 'currency_name')) ?>
                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 '>
<?= $form->field($model, 'stock')->textInput(['type' => 'number', 'min' => '0', 'autocomplete' => 'off']) ?>
                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 '>
<?= $form->field($model, 'stock_unit')->dropDownList(ArrayHelper::map(Unit::find()->all(), 'id', 'unit_name')) ?>
                    <label onclick="jQuery('#modal-3').modal('show', {backdrop: 'fade'});" class="btn btn-icon btn-white extra_btn add_unit" attr_id="product-stock_unit">Add Unit</label>
                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 '>
<?= $form->field($model, 'stock_availability')->dropDownList(['1' => 'Available', '0' => 'Not Available']) ?>
                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 '>
<?= $form->field($model, 'tax')->textInput(['autocomplete' => 'off']) ?>
                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 '>
<?= $form->field($model, 'free_shipping')->dropDownList(['1' => 'Yes', '0' => 'No'], ['prompt' => 'Select']) ?>
                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 '>
<?= $form->field($model, 'product_type')->dropDownList(ArrayHelper::map(Fregrance::find()->all(), 'id', 'name'), ['prompt' => 'select']) ?>
                    <label onclick="jQuery('#modal-6').modal('show', {backdrop: 'fade'});" class="btn btn-icon btn-white extra_btn add_fragrance" attr_id="product-stock_unit">Add Fragrance</label>
                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 '>
<?= $form->field($model, 'size')->textInput(['autocomplete' => 'off']) ?>
                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 '>
<?= $form->field($model, 'size_unit')->dropDownList(ArrayHelper::map(Unit::find()->all(), 'id', 'unit_name')) ?>
                    <label onclick="jQuery('#modal-3').modal('show', {backdrop: 'fade'});" class="btn btn-icon btn-white extra_btn add_unit" attr_id="product-size_unit">Add Unit</label>
                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 '>
<?= $form->field($model, 'condition')->dropDownList(['1' => 'New', '0' => 'Refurbished']) ?>
                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 '>
                    <?php
                    if (!$model->isNewRecord) {
                        if (isset($model->related_product)) {
                            $model->related_product = explode(',', $model->related_product);
                        }
                    }
                    ?>
<?= $form->field($model, 'related_product')->dropDownList(ArrayHelper::map(Product::find()->where(['status' => '1'])->all(), 'id', 'product_name'), ['class' => 'form-control', 'id' => 'product-related_product', 'multiple' => 'multiple']) ?>

                </div>
                <div class='col-md-12 col-sm-6 col-xs-12 '>
<?= $form->field($model, 'main_description')->textArea(['rows' => '6'], ['maxlength' => '453']); ?>

                </div>
                <div class='col-md-12 col-sm-6 col-xs-12 '>
                    <?=
                    $form->field($model, 'product_detail')->widget(CKEditor::className(), [
                        'options' => ['rows' => 6],
                        'preset' => 'basic'
                    ])
                    ?>
                </div>

                <div class='col-md-12 col-sm-6 col-xs-12 '>
<?= $form->field($model, 'featured_product')->dropDownList(['0' => 'No', '1' => 'Yes']) ?>
                </div>
                <div class='col-md-12 col-sm-6 col-xs-12 '>
<?= $form->field($model, 'status')->dropDownList(['1' => 'Enable', '0' => 'Disable']) ?>
                </div>
                <!--Meta--->
                <div class='col-md-4 col-sm-6 col-xs-12 '>
                    <?php
                    if (!$model->isNewRecord) {
                        if (isset($model->search_tag)) {
                            $model->search_tag = explode(',', $model->search_tag);
                        }
                    }
                    ?>
<?= $form->field($model, 'search_tag')->dropDownList(ArrayHelper::map(MasterSearchTag::find()->where(['status' => '1'])->all(), 'id', 'tag_name'), ['class' => 'form-control', 'id' => 'product-search_tag', 'multiple' => 'multiple']) ?>
                    <label onclick="jQuery('#modal-4').modal('show', {backdrop: 'fade'});" class="btn btn-icon btn-white extra_btn add_tag">Add Search Tag</label>
                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 '>
<?= $form->field($model, 'meta_title')->textInput(['maxlength' => true]) ?>
                </div>
                <div class='col-md-12 col-sm-6 col-xs-12 '>
<?= $form->field($model, 'meta_description')->textArea(['rows' => '6'], ['maxlength' => true]) ?>
                </div>
                <div class='col-md-12 col-sm-6 col-xs-12 '>
<?= $form->field($model, 'meta_keywords')->textArea(['rows' => '6'], ['maxlength' => true]) ?>

                </div>
                <!--Image-->
                <div class='col-md-4 col-sm-6 col-xs-12 '>
<?= $form->field($model, 'profile_alt')->textInput(['maxlength' => true]) ?>
                </div>

                <div class='col-md-4 col-sm-6 col-xs-12 '>
<?= $form->field($model, 'gallery_alt')->textInput(['maxlength' => true]) ?>
                </div>
                <div class='col-md-6 col-sm-6 col-xs-12 '>
                    <?= $form->field($model, 'profile')->fileInput()->label('profile Picture<i> (455*315)</i>') ?>
                    <?php
                    if (!$model->isNewRecord) {
                        echo "<hr class='appoint_history'/> <h4 class='sub-heading'>Profile Image</h4>";
                        ?>

                        <div class = "col-md-2 img-box">
                            <a href="<?= Yii::$app->homeUrl . '../uploads/product/' . $model->id . '/profile/' . $model->canonical_name . '.' . $model->profile ?>" target="_blank">
                                <img src="<?= Yii::$app->homeUrl . '../uploads/product/' . $model->id . '/profile/' . $model->canonical_name . '_thumb.' . $model->profile ?>" width="60px" height="60px"></a>

                        </div>
<?php } ?>
                </div>
                <div class='col-md-6 col-sm-6 col-xs-12 '>
                    <?= $form->field($model, 'other_image[]')->fileInput(['multiple' => true, 'accept' => 'image/*'])->label('Gallery Images<i> (455*315)</i>') ?>
<?php if (!$model->isNewRecord) { ?>
                                                                                                                                                                                                    <!--<a href=''><img src="<?= yii::$app->homeUrl ?>/../../uploads/product/1/dasda_0.jpg" width="100" alt="Delete"></a>-->
                        <div class="row">
                            <?php
                            $path = Yii::getAlias('@paths') . '/product/' . $model->id . '/gallery_thumb';
                            if (count(glob("{$path}/*")) > 0) {
                                echo "<hr class='appoint_history'/> <h4 class='sub-heading'>Uploaded Files</h4>";

                                $k = 0;
                                foreach (glob("{$path}/*") as $file) {
                                    $k++;
                                    $arry = explode('/', $file);
                                    $img_nmee = end($arry);

                                    $img_nmees = explode('.', $img_nmee);
                                    if ($img_nmees['1'] != '') {
                                        ?>

                                        <div class = "col-md-2 img-box" id="<?= $k; ?>">
                                            <a href="<?= Yii::$app->homeUrl . '../uploads/product/' . $model->id . '/gallery_thumb/' . end($arry) ?>" target="_blank">
                                                <img src="<?= Yii::$app->homeUrl . '../uploads/product/' . $model->id . '/gallery_thumb/' . end($arry) ?>" width="50px" height="50px"></a>
                                            <a  title="Delete" class="img-remove product_image" id="<?= $model->id . "@" . $img_nmee . '@' . $k; ?>" style="cursor:pointer"><i class="fa fa-remove" style="position: absolute;left: 75px;top: 3px;"></i></a>
                                        </div>


                                        <?php
                                    }
                                }
                            }
                            ?>
                        </div>
                        <!--</div>-->
                        <?php
                        //  \yii\helpers\FileHelper::findFiles('uploads/product/'.$model->id.'/',['only'=>['*.jpg','*.png']]);
                    }
                    ?>
                </div>
            </div>
        </div>


    </div>
    <li style="float: right;">
<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-success', 'style' => 'margin-top: 5px; height: 36px; width:100px;']) ?>

    </li>



<?php ActiveForm::end(); ?>

</div>
<div class="modal fade" id="modal-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"  field_id="product-category">Add Category</h4>
            </div>

            <div class="modal-body">
<?php $form = ActiveForm::begin(['id' => 'add_category']); ?>
                <label  for="subcategory-category">Category</label>
                <input type="text" id="subcategory-category" autocomplete="off" class="form-control" >
                <label class="control-label" for="subcategory-category">Category code</label>
                <input type="text" id="subcategory-categorycode" readonly="readonly" class="form-control" >
                <div class="form-group" style="float: right;">
<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-success', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
                </div>

<?php ActiveForm::end(); ?>
            </div>

            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-2">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"  field_id="product-subcategory">Add Sub Category</h4>
            </div>

            <div class="modal-body">
                <?php $form = ActiveForm::begin(['id' => 'add_subcategory']); ?>
<?= $form->field($model, 'category')->dropDownList(ArrayHelper::map(Category::find()->all(), 'id', 'category'), ['prompt' => 'select', 'id' => 'product-prcat']) ?>
                <label class="control-label">Sub Category</label>
                <input type="text" id="product_subcat" autocomplete="off" class="form-control" >
                <div class="form-group" style="float: right;">
<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-success', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
                </div>

<?php ActiveForm::end(); ?>
            </div>

            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-3">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"  field_id="">Add Unit</h4>
            </div>

            <div class="modal-body">
<?php $form = ActiveForm::begin(['id' => 'add_unit']); ?>
                <label class="control-label">Unit</label>
                <input type="text" id="product_unit" autocomplete="off" class="form-control" >
                <div class="form-group" style="float: right;">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-success', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
                </div>
<?php ActiveForm::end(); ?>
            </div>

            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-4">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title4"  field_id="product-search_tag">Add Search Tag</h4>
            </div>

            <div class="modal-body">
<?php $form = ActiveForm::begin(['id' => 'add_searchtag']); ?>
                <label class="control-label" for="Search-tag">Tag name</label>
                <input type="text" id="search-tag" autocomplete="off" class="form-control" >
                <div class="form-group" style="float: right;">
<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-success', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
                </div>

<?php ActiveForm::end(); ?>
            </div>

            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-5">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title5"  field_id="product-brand">Add Brand</h4>
            </div>

            <div class="modal-body">
<?php $form = ActiveForm::begin(['id' => 'add_brand']); ?>
                <label class="control-label" for="Brand">Brand name</label>
                <input type="text" id="brand-name" autocomplete="off" class="form-control" >
                <div class="form-group" style="float: right;">
<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-success', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
                </div>

<?php ActiveForm::end(); ?>
            </div>

            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-6">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title6"  field_id="product-product_type">Add Fragrance</h4>
            </div>

            <div class="modal-body">
<?php $form = ActiveForm::begin(['id' => 'add_fragrance']); ?>
                <label class="control-label" for="Fragrance">Name</label>
                <input type="text" id="fragrance-name" autocomplete="off" class="form-control" >
                <div class="form-group" style="float: right;">
<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-success', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
                </div>

<?php ActiveForm::end(); ?>
            </div>

            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#product-product_name').keyup(function () {
            var name = slug($(this).val());
//            var size= slug($('#product-size').val());
//            var canonical= name+-+size;
//            $('#product-canonical_name').val(canonical);
            $('#product-canonical_name').val(slug($(this).val()));
        });
        $('#subcategory-category').keyup(function () {
            var name = slug($(this).val());
            $('#subcategory-categorycode').val(slug($(this).val()));
        });
        $('.product_image').click(function () {
            var id = this.id;
            $.ajax({
//            url: $base_url + 'event_item/select_event',
                url: 'ajax_imgdelete',
                type: "post",
                data: {image: id},
                success: function (data) {
                    var $data = JSON.parse(data);
                    if ($data.msg == "success") {
                        $('#' + $data.id).hide();
                    } else {
                        alert($data.title);
                    }
                }, error: function () {
                    alert('Image Cannot be delete');
                }
            });
        });

    });

    var slug = function (str) {
        var $slug = '';
        var trimmed = $.trim(str);
        $slug = trimmed.replace(/[^a-z0-9-]/gi, '-').
                replace(/-+/g, '-').
                replace(/^-|-$/g, '');
        return $slug.toLowerCase();
    }
</script>
<script type="text/javascript">
    jQuery(document).ready(function ($)
    {
        $("#product-search_tag").select2({
            placeholder: 'Choose product search Tag',
            allowClear: true
        }).on('select2-open', function ()
        {
            // Adding Custom Scrollbar
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });
        $("#product-related_product").select2({
            placeholder: 'Choose Related product',
            allowClear: true
        }).on('select2-open', function ()
        {
            // Adding Custom Scrollbar
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });




    });
</script>
