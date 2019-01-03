$(document).ready(function () {
   
    $('#btn-group').click(function () {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

        if (!$('#group-name').val() || $('#group-name').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the group name",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!$('#email').val() || $('#email').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter your email",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!emailReg.test($('#email').val())) {
            swal({
                title: "Error!",
                text: "Please enter a valid email",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!$('#select-business-category').val() || $('#select-business-category').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please select the category",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!$('#sub-category').val() || $('#sub-category').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please select the sub category",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!$('#address').val() || $('#address').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the address",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;

        } else if (!$('#district').val() || $('#district').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the district",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!$('#city').val() || $('#city').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the city",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else {
                return true;
        }
    });
});

