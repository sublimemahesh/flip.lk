$(document).ready(function () {
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
                
                html += '<option value="">--Please Select Sub Category -- </option>';

                if (subcategories.length > 0) {
                    $.each(subcategories, function (key, subcategory) {
                        html += '<option value="' + subcategory.id + '">' + subcategory.name + '</option>';
                    });
                } else {
                    html += 'No items';
                }

                $('.sub-category-select').empty();
                $('.sub-category-select').append(html);
            }
        });
    });
});