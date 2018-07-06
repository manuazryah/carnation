//$(document).ready(function () {
//    $("#add_category").click(function () {add_category
//$(document).on('click', '.add_category', function () {
//    $('#modal-1').modal('show', {backdrop: 'fade'});
//});


/****      Add Category     *****/
$(document).on('submit', '#add_category', function (event) {
    event.preventDefault();
    if (valid()) {
        var main_category = $('#product-main_category').val();
//        var main_category = $('input:radio[name="Product[main_category]"]:checked').val();
        var category = $('#subcategory-category').val();
        var code = $('#subcategory-categorycode').val();
        var form = $('.modal-title').attr('field_id');
//        addcategory(main_category,category,code);
        $.ajax({
            url: homeUrl + 'product/category/ajaxaddcategory',
            type: "post",
            data: {main_category: main_category, cat: category, code: code},
            success: function (data) {
                var $data = JSON.parse(data);
                if ($data.con === "1") {
                    $('#' + form).append($('<option value="' + $data.id + '" selected="selected">' + $data.category + '</option>'));
                    $('#product-prcat').append($('<option value="' + $data.id + '" selected="selected">' + $data.category + '</option>'));
//                    $('#'+form).val('');
//                    $('#subcategory-category_id').append($('<option value="' + $data.id + '" selected="selected">' + $data.category + '</option>'));
//                    $('#subcategory-category').val('');
                    $('#modal-1').modal('toggle');
                } else {
                    alert($data.msg['category'] + ' or ' + $data.msg['category_code']);
                }

            }, error: function () {

            }
        });
    } else {
        alert('Please fill the Field');
    }

//$("#add_category").on(submit(function () {

});
/****      Add Sub Category     *****/
$(document).on('submit', '#add_subcategory', function (event) {
    event.preventDefault();
    var main_category = $('#product-main_category').val();
//    var main_category = $('input:radio[name="Product[main_category]"]:checked').val();
    var category = $('#product-prcat').val();
    var catname = $('#product-prcat option:selected').text();
    var subcat = $('#product_subcat').val();
    var form = $('.modal-title').attr('field_id');
    $.ajax({
        url: homeUrl + 'product/sub-category/ajaxaddsubcat',
        type: "post",
        data: {main_category: main_category, cat: category, subcat: subcat},
        success: function (data) {
            var $data = JSON.parse(data);
            if ($data.con === "1") {
                $('#product-category').append($('<option value="' + category + '" selected="selected">' + catname + '</option>'));
                $('#product-subcategory').append($('<option value="' + $data.id + '" selected="selected">' + $data.subcategory + '</option>'));
                $('#modal-2').modal('toggle');
            } else {

            }

        }, error: function () {

        }
    })
});
/****      Add Unit     *****/
$(document).on('submit', '#add_unit', function (event) {
    event.preventDefault();
    var unit = $('#product_unit').val();
    var form = $('.modal-title').attr('field_id');
    $.ajax({
        url: homeUrl + 'product/unit/ajaxaddunit',
        type: "post",
        data: {unit: unit},
        success: function (data) {
            var $data = JSON.parse(data);
            if ($data.con === "1") {
                $('#' + form).append($('<option value="' + $data.id + '" selected="selected">' + $data.unit + '</option>'));
                $('#modal-3').modal('toggle');
            } else {

            }

        }, error: function () {

        }
    })
});
/****      Add Search tag     *****/
$(document).on('submit', '#add_searchtag', function (event) {
        event.preventDefault();
        var tag = $('#search-tag').val();
        var form = $('.modal-title4').attr('field_id');
        $.ajax({
                url: homeUrl + 'product/master-search-tag/ajaxaddtag',
                type: "post",
                data: {tag: tag},
                success: function (data) {
                        var $data = JSON.parse(data);
                        if ($data.con === "1") {

                                var newOption = $('<option value="' + $data.id + '">' + $data.tag + '</option>');
                                $('#product-search_tag').append(newOption);
                                $('#product-search_tag' + ' option[value=' + $data.id + ']').attr("selected", "selected");
                                var vals = $('#product-search_tag').val();
                                $('#product-search_tag').select2('val', vals);

                                $('#modal-4').modal('toggle');
                        } else if ($data.con === "2") {
                                alert($data.error);
                        }

                }, error: function () {

                }
        });


//$("#add_category").on(submit(function () {

});
/****      Add brand    *****/
$(document).on('submit', '#add_brand', function (event) {
    event.preventDefault();
    var brand = $('#brand-name').val();
    var form = $('.modal-title5').attr('field_id');
    $.ajax({
        url: homeUrl + 'brand/ajaxaddbrand',
        type: "post",
        data: {brand: brand},
        success: function (data) {
            var $data = JSON.parse(data);
            if ($data.con === "1") {
                $('#' + form).append($('<option value="' + $data.id + '" selected="selected">' + $data.brand + '</option>'));
                $('#brand-name').val('');
                $('#modal-5').modal('toggle');
            } else if ($data.con === "0") {
                alert($data.error);
            }

        }, error: function () {

        }
    });



});
/****      Add Fragrance    *****/
$(document).on('submit', '#add_fragrance', function (event) {
    event.preventDefault();
    var fragrance = $('#fragrance-name').val();
    var form = $('.modal-title6').attr('field_id');
    $.ajax({
        url: homeUrl + 'fregrance/ajaxaddfragrance',
        type: "post",
        data: {fragrance: fragrance},
        success: function (data) {
            var $data = JSON.parse(data);
            if ($data.con === "1") {
                $('#' + form).append($('<option value="' + $data.id + '" selected="selected">' + $data.fragrance + '</option>'));
                $('#fragrance-name').val('');
                $('#modal-6').modal('toggle');
            } else if ($data.con === "0") {
                alert($data.error);
            }

        }, error: function () {

        }
    });



});

/****price>offerprice*****/
$('#product-offer_price').keyup(function () {
    $('#offer_price').addClass('hide');
    var offer = parseInt($(this).val());
    var price = parseInt($('#product-price').val());
    if (price != '') {
        if (offer >= price) {
            $('#product-offer_price').val('0.00');
            $('#offer_price').removeClass('hide');
        }
    }
});
/**/

$('.add_unit').click(function () {
    var unit = $(this).attr('attr_id');
    $('.modal-title').attr('field_id', unit);
});


$('#product-main_category').change(function () {
    var $ids = $(this).attr('id');
    var ids = $ids.split('-');
    var main_category = $(this).val();
//    var main_category = $('input:radio[name="Product[main_category]"]:checked').val();
    main_category_(main_category, ids);

});
$('#subcategory-main_category').click(function () {
    var $ids = $(this).attr('id');
    var ids = $ids.split('-');
    var main_category = $(this).val();
//    var main_category = $('input:radio[name="SubCategory[main_category]"]:checked').val();
    main_category_(main_category, ids);

});

$("#product-category").change(function () {
    $.ajax({
//            url: $base_url + 'event_item/select_event',
        url: 'subcategory',
        type: "post",
        data: {category: this.value},
        success: function (data) {

            $('#product-subcategory ').html("").html(data);
        }, error: function () {

        }
    });
});
/****      Add brand    *****/
$("#brand-image").change(function (e) {
    var form_data = new FormData();
    var ins = document.getElementById('brand-image').files.length;
    for (var x = 0; x < ins; x++) {
        form_data.append("files[]", document.getElementById('brand-image').files[x]);
    }
    showLoader();
    $.ajax({
        url: homeUrl + 'brand/ajaxaddimage', // Upload Script
        dataType: 'text', // what to expect back from the PHP script
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function (data) {
            if (data === 0) {
                alert("error");
                hideLoader();
            } else {
                hideLoader();
            }
        },
        error: function (data) {
        }
    });
});
//$('#product-sort').keyup(function () {
//    var sort = $(this).val();
//});


var valid = function () { //Validation Function - Sample, just checks for empty fields
    var valid;
    $("input").each(function () {
        if ($('#subcategory-category').val() === "") {
            var a = $(this).val();
            valid = false;
        }
    });
    if (valid !== false) {
        return true;
    } else {
        return false;
    }
}
//    });
//});

function main_category_(main_category, ids) {
    $.ajax({
        url: homeUrl + 'product/product/category',
//        url: 'category',
        type: "post",
        data: {main_cat: main_category},
        success: function (data) {
            if (ids[0] === 'subcategory') {
                var idr = '-category_id';
            } else {
                var idr = '-category';
            }
            $('#' + ids[0] + idr).html("").html(data);
            $('#product-prcat ').html("").html(data);
        }, error: function () {

        }
    }
    );
}

function showLoader() {
    $('.page-loading-overlay').removeClass('loaded');
}
function hideLoader() {
    $('.page-loading-overlay').addClass('loaded');
}