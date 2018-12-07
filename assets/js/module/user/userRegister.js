function save_section(section)
{
    $.ajax({
        type: "POST",
        url: BASE_URL + "user/user_profile/update_" + section,
        cache: false,
        data: $('#form_' + section).serialize(),
        beforeSend: function () {
            // For Safety Disabling Section Elements for Slow Internet Connections
            $('#section_' + section).find('.form-control').prop('readonly', true);
            $('#section_' + section).find('.btn').prop('disabled', true);
        },
        success: function (response) {
            // console.log(response);return false;
            var data = JSON.parse(response);

            // Re_Enabling the Elements
            $('#section_' + section).find('.form-control').prop('readonly', false);
            $('#section_' + section).find('.btn').prop('disabled', false);

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
                    $("input[name='" + data.field + "']").focus();
                    $("input[id='" + data.field + "']").focus();
                    $("select[name='" + data.field + "']").focus();
                    setTimeout(function () {
                        $('.alert_message').fadeOut('fast');
                    }, 8000); // <-- time in milliseconds
                    break;
            }

        },
        error: function (response) {
            // Re_Enabling the Elements
            $('#section_' + section).find('.btn').prop('disabled', false);
            $('#ajax_danger_alert').show();
            $('.ajax_danger_alert').html(' Something went wrong! Try refreshing page and Save again.');
            setTimeout(function () {
                $('.alert_message').fadeOut('fast');
            }, 4000); // <-- time in milliseconds  
        }
    });
}
