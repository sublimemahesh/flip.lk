$(document).ready(function () {
    
    $('#autocomplete').keyup(function () {
        
       if($('#autocomplete').val() == '')   {
           $('#city').val('');
       }
    });
    $("#ad-slider").owlCarousel({
        autoPlay: 3000, //Set AutoPlay to 3 seconds
        items: 4,
        itemsDesktop: [1199, 3],
        itemsDesktopSmall: [979, 3],
        nav : true,
        dot: true,
        margin:10
    });
    
    
    


});
