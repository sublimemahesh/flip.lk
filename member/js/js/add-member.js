$(document).ready(function () {
    $('.alert-position').addClass('hidden');
    $("#btnRegister").click(function (e) {
        var datastring = $("#register").serialize();
        $.ajax({
            url: "post-and-get/ajax/add-member.php",
            cache: false,
            dataType: "json",
            type: "POST",
            data: datastring,
            success: function (result) {
                if (result.status === 'error') {
                    $('.alert-position').removeClass('hidden');
                    $('#message').text(result.message);
                    return false;
                } else if (result.status === 'success') {
                    $('#registration-login-form').addClass('hidden');
                    $('#category-save-form').removeClass('hidden');
                } else if (result.status === 'notdelivered') {
                    if (result.back === '') {
                        window.location.replace('profile.php?message=22');
                    } else {
                        window.location = result.back;
                    }
                } else if (result.status === 'registered') {
                    window.location.replace('forgot-password.php?message=26');
                }
            }
        });
    });
    $('#select-business-category').change(function () {
        var business = $('#select-business-category').val();
        $.ajax({
            url: "post-and-get/ajax/business-sub-category.php",
            cache: false,
            dataType: "json",
            type: "POST",
            data: {
                category: business,
                option: 'GETSUBCATEGORY'
            },
            success: function (subcategories) {
                var html = '';
                html += '<div class="form-group">';
                html += '<label class="control-label">Your Business Sub Category</label>';

                html += '<select class="" id="select-business-sub-category" tabindex="-98">';
                html += '<option value="">--Please Select Sub Category -- </option>';

                if (subcategories.length > 0) {
                    $.each(subcategories, function (key, subcategory) {
                        html += '<option value="' + subcategory.id + '">' + subcategory.name + '</option>';
                    });
                } else {
                    html += 'No items';
                }
                html += '</select>';
                html += '</div>';




//                html += '<div class="form-group label-floating is-select is-empty">';
//                html += '<label class="control-label">Your Business Sub Category</label>';
//                html += '<div class="btn-group bootstrap-select form-control">';
//                html += '<button type="button" class="btn dropdown-toggle btn-secondary" data-toggle="dropdown" role="button" data-id="select-business-category" title="Category 03" aria-expanded="false">';
//                html += '<span class="filter-option pull-left"> -- Please Select Sub Category -- </span>&nbsp;';
//                html += '<span class="bs-caret"><span class="caret"></span></span>';
//                html += '</button>';
//                html += '<div class="dropdown-menu open" role="combobox" style="max-height: 170.8px; overflow: hidden; min-height: 0px; position: absolute; transform: translate3d(0px, 58px, 0px); top: 0px; left: 0px; will-change: transform;" x-placement="bottom-start">';
//                html += '<ul class="dropdown-menu inner" role="listbox" aria-expanded="false" style="max-height: 152.8px; overflow-y: auto; min-height: 0px;">';
//
//
//                $.each(subcategories, function (key, subcategory) {
//                    html += '<li data-original-index="' + key + '" class="subcat-li" cat-name="' + subcategory.name + '">';
//                    html += '<a tabindex="' + key + '" class=" dropdown-item " id="subcat" style="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false">';
//                    html += '<span class="text">' + subcategory.name + '</span>';
//                    html += '<span class="glyphicon glyphicon-ok check-mark"></span>';
//                    html += '</a>';
//                    html += '</li>';
//                });
//
//
//                html += '</ul>';
//                html += '</div>';
//                html += '<select class="selectpicker form-control" id="select-business-sub-category" tabindex="-98">';
//
//                $.each(subcategories, function (key1, subcategory1) {
//                    html += '<option value="' + subcategory1.id + '">' + subcategory1.name + '</option>';
//                });
//                html += '</select>';
//                html += '</div>';
//                html += '<span class="material-input"></span></div>';
//                html += '</div>';


//                html += '<select class="selectpicker form-control" id="select-business-sub-category">';

//                $.each(subcategories, function (key, subcategory) {
//                    html += '<option value="' + subcategory.id + '">' + subcategory.name + '</option>';
//                });
//
//                html += '</select>';
//                html += '</div>';
//alert(html);
                $('#subcategories').removeClass('hidden');
                $('#select-sub-category').empty();
                $('#select-sub-category').append(html);








            }
        });
    });
    
    $('#btnSelectCategory').click(function () {
        var category = $('#select-business-category').val();
        var subcategory = $('#select-business-sub-category').val();

        $.ajax({
            url: "post-and-get/ajax/add-member.php",
            cache: false,
            dataType: "json",
            type: "POST",
            data: {
                category: category,
                subcategory: subcategory,
                option: 'ADDBUSINESSCATEGORY'
            },
            success: function (result) {
                if (result.status === 'error') {
                    $('.alert-position').removeClass('hidden');
                    $('#message').text(result.message);
                    return false;
                } else if (result.status === 'success') {
                    window.location.replace('login2.php');
                }
            }
        });
    });

});