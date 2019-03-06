$(document).ready(function () {
    
    // Configure/customize these variables.
    var showChar = 200;  // How many characters are shown by default
    var ellipsestext = "...";
    var moretext = "See More";
    var lesstext = "See Less";


    $('.more p').each(function () {
        var content = $(this).html();

        if (content.length > showChar) {
 
            var c = content.substr(0, showChar);

            var h = content.substr(showChar, content.length - showChar);

            var html = c + '<span class="moreellipses">' + ellipsestext + '&nbsp;</span><span class="morecontent"><span>' + h + '</span><a href="" class="morelink">' + moretext + '</a></span>';

            $(this).html(html);
        }

    });

    $(".morelink").click(function () {
        if ($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
//            $(".moreellipses").removeClass('display-none');
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
//            $(".moreellipses").addClass('display-none');
//            $(".morecontent").addClass('display-inline');
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
    });
});
