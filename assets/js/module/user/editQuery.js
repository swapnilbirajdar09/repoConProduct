// update changes of document
$("#editQuery_form").on('submit', function (e) {
    e.preventDefault();
    dataString = $("#editQuery_form").serialize();
    $.ajax({
        url: BASE_URL + "modules/raisequery_rfi/updateQueryDetails", // point to server-side PHP script
        data: new FormData(this),
        type: 'POST',
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false,
        beforeSend: function () {
            $('#updateQuryBtn').prop('disabled', true);
            $('#updateQuryBtn').html('<i class="fa fa-circle-o-notch fa-spin"></i> Updating changes');
        },
        success: function (response) {
            $('#updateQuryBtn').prop('disabled', false);
            $('#updateQuryBtn').html('<i class="fa fa-edit"></i> Click here to Save Changes');
            console.log(response);
            var data = JSON.parse(response);
            // response message
            switch (data.status) {
                case 'success':
                    $('#response_msg').html(data.message);
                    setTimeout(function () {
                        window.location.reload();
                    }, 1500); // <-- time in milliseconds 

                    break;

                case 'error':
                    $('#response_msg').html(data.message);
                    setTimeout(function () {
                        $('.alert').fadeOut('fast');
                    }, 10000); // <-- time in milliseconds
                    break;

                case 'validation':
                    $('#response_msg').html(data.message);
                    setTimeout(function () {
                        $('.alert').fadeOut('fast');
                    }, 8000); // <-- time in milliseconds
                    break;
                default:
                    $('#response_msg').html('<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Fatal Error-</strong> Something went wrong. Please Logout your account and Try Logging in again.</div>');
                    setTimeout(function () {
                        $('.alert').fadeOut('fast');
                    }, 8000); // <-- time in milliseconds
                    break;
            }
        },
        error: function (data) {
            $('#updateDocBtn').prop('disabled', false);
            $('#response_msg').html('<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failure!</strong> Something went wrong. Please refresh the page and try once again.</div>');
            $('#updateDocBtn').html('<i class="fa fa-edit"></i> Click here to Save Changes');
            window.setTimeout(function () {
                $(".alert").fadeTo(500, 0).slideUp(500, function () {
                    $(this).remove();
                });
            }, 5000);
        }
    });
    return false;  //stop the actual form post !important!
});


// remove files from gallery
function removeImage(key, query_id) {
    $.confirm({
        title: '<h4 class="w3-text-red">Please confirm the action!</h4><span class="w3-medium">Do you really want to remove this Image?</span>',
        content: '',
        type: 'red',
        buttons: {
            confirm: function () {
                $.ajax({
                    type: "GET",
                    url: BASE_URL + "modules/raisequery_rfi/removeImage",
                    data: {
                        key: key,
                        query_id: query_id
                    },
                    cache: false,
                    beforeSend: function () {
                        $('#image_' + key).html('<i class="fa fa-circle-o-notch fa-spin w3-medium"></i>');
                    },
                    success: function (data) {

                        $('#file_msg').html(data);
                        $('#image_' + key).html('<i class="fa fa-close"></i>');

                        window.setTimeout(function () {
                            $(".alert").fadeTo(500, 0).slideUp(500, function () {
                                $(this).remove();
                            });
                            window.location.reload();
                        }, 1500);
                    },
                    error: function (data) {
                        $('#file_msg').html('<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failure!</strong> Something went wrong. Please refresh the page and try once again.</div>');
                        $('#image_' + key).html('<i class="fa fa-close"></i>');
                        window.setTimeout(function () {
                            $(".alert").fadeTo(500, 0).slideUp(500, function () {
                                $(this).remove();
                            });
                        }, 5000);
                    }
                });
            },
            cancel: function () {
            }
        }
    });
}


// upload file form
$("#uploadFileForm").on('submit', function (e) {
    e.preventDefault();
    dataString = $("#uploadFileForm").serialize();
    $.ajax({
        url: BASE_URL + "modules/raisequery_rfi/uploadImage", // point to server-side PHP script
        data: new FormData(this),
        type: 'POST',
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false,
        beforeSend: function () {
            $('#uploadFile').prop('disabled', true);
            $('#uploadFile').html('<i class="fa fa-circle-o-notch fa-spin"></i> Uploading...');
        },
        success: function (response) {
            $('#uploadFile').prop('disabled', false);
            $('#uploadFile').html('<i class="fa fa-upload"></i> Upload File');
            console.log(response); return false;
            var data = JSON.parse(response);
            // response message
            switch (data.status) {
                case 'success':
                    $('#file_msg').html(data.message);
                    setTimeout(function () {
                        window.location.reload();
                    }, 1500); // <-- time in milliseconds 
                    break;

                case 'error':
                    $('#file_msg').html(data.message);
                    setTimeout(function () {
                        $('.alert').fadeOut('fast');
                    }, 10000); // <-- time in milliseconds
                    break;

                case 'validation':
                    $('#file_msg').html(data.message);
                    setTimeout(function () {
                        $('.alert').fadeOut('fast');
                    }, 8000); // <-- time in milliseconds
                    break;
                    
                default:
                    $('#file_msg').html('<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Fatal Error-</strong> Something went wrong. Please Logout your account and Try Logging in again.</div>');
                    setTimeout(function () {
                        $('.alert').fadeOut('fast');
                    }, 8000); // <-- time in milliseconds
                    break;
            }
        },
        error: function (data) {
            $('#uploadFile').prop('disabled', false);
            $('#file_msg').html('<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failure!</strong> Something went wrong. Please refresh the page and try once again.</div>');
            $('#uploadFile').html('<i class="fa fa-upload"></i> Upload File');
            window.setTimeout(function () {
                $(".alert").fadeTo(500, 0).slideUp(500, function () {
                    $(this).remove();
                });
            }, 5000);
        }
    });
    return false;  //stop the actual form post !important!
});
