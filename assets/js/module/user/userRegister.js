function registerUser() {
    $.ajax({
        type: "POST",
        url: BASE_URL + "user/userregister/registerUser",
        cache: false,
        data: $('#userRegister').serialize(),
        beforeSend: function () {
            $('#register').prop('disabled', true);
        },
        success: function (response) {
            // console.log(response);return false;
            var data = JSON.parse(response);
            alert(data);
            // Re_Enabling the Elements
            $('#register').prop('disabled', false);
            // response message
            switch (data.status) {
                case 'success':
                    $('#ajax_success_alert').show();
                    $('.ajax_success_alert').html(data.message);
                    setTimeout(function () {
                        window.location.reload();
                    }, 1500); // <-- time in milliseconds 
                    break;

                case 'error':
                    $('#ajax_danger_alert').show();
                    $('.ajax_danger_alert').html(data.message);
                    setTimeout(function () {
                        $('.alert_message').fadeOut('fast');
                    }, 10000); // <-- time in milliseconds
                    break;

                case 'validation':
                    $('#ajax_validation_alert').show();
                    $('.ajax_validation_alert').html(data.message);
                    setTimeout(function () {
                        $('.alert_message').fadeOut('fast');
                    }, 8000); // <-- time in milliseconds
                    break;
            }
        },
        error: function (response) {
            // Re_Enabling the Elements
            $('#register').prop('disabled', false);
            $('#ajax_danger_alert').show();
            $('.ajax_danger_alert').html(' Something went wrong! Try refreshing page and Save again.');
            setTimeout(function () {
                $('.alert_message').fadeOut('fast');
            }, 4000); // <-- time in milliseconds  
        }
    });
}
