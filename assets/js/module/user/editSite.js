// update changes of document
$("#updateCheckListForm").on('submit', function (e) {
    e.preventDefault();
    dataString = $("#updateCheckListForm").serialize();
    $.ajax({
        url: BASE_URL + "modules/site_inspection/updateChecklist", // point to server-side PHP script
        data: new FormData(this),
        type: 'POST',
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false,
        beforeSend: function () {
            $('#editActivityBtn').prop('disabled', true);
            $('#editActivityBtn').html('<i class="fa fa-circle-o-notch fa-spin"></i> Updating changes');
        },
        success: function (response) {
            $('#editActivityBtn').prop('disabled', false);
            $('#editActivityBtn').html('<i class="fa fa-edit"></i> Click here to Save Changes');
            console.log(response);
            var data = JSON.parse(response);
            // response message
            switch (data.status) {
                case 'success':
                    $('#formOutput').html(data.message);
                    setTimeout(function () {
                        window.location.reload();
                    }, 1500); // <-- time in milliseconds 

                    break;

                case 'error':
                    $('#formOutput').html(data.message);
                    setTimeout(function () {
                        $('.alert').fadeOut('fast');
                    }, 10000); // <-- time in milliseconds
                    break;

                case 'validation':
                    $('#formOutput').html(data.message);
                    setTimeout(function () {
                        $('.alert').fadeOut('fast');
                    }, 8000); // <-- time in milliseconds
                    break;
                default:
                    $('#formOutput').html('<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Fatal Error-</strong> Something went wrong. Please Logout your account and Try Logging in again.</div>');
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
function removeImageInfo(key, activity_id) {
    $.confirm({
        title: '<h4 class="w3-text-red">Please confirm the action!</h4><span class="w3-medium">Do you really want to remove this Image?</span>',
        content: '',
        type: 'red',
        buttons: {
            confirm: function () {
                $.ajax({
                    type: "GET",
                    url: BASE_URL + "modules/site_inspection/removeImageInfo",
                    data: {
                        key: key,
                        activity_id: activity_id
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
$("#upload_imageForm").on('submit', function (e) {
    e.preventDefault();
    dataString = $("#upload_imageForm").serialize();
    $.ajax({
        url: BASE_URL + "modules/site_inspection/uploadImageInfo", // point to server-side PHP script
        data: new FormData(this),
        type: 'POST',
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false,
        beforeSend: function () {
            $('#uploadFilebtn').prop('disabled', true);
            $('#uploadFilebtn').html('<i class="fa fa-circle-o-notch fa-spin"></i> Uploading...');
        },
        success: function (response) {
            $('#uploadFilebtn').prop('disabled', false);
            $('#uploadFilebtn').html('<i class="fa fa-upload"></i> Upload File');
            //console.log(response); return false;
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
            $('#uploadFilebtn').prop('disabled', false);
            $('#file_msg').html('<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failure!</strong> Something went wrong. Please refresh the page and try once again.</div>');
            $('#uploadFilebtn').html('<i class="fa fa-upload"></i> Upload File');
            window.setTimeout(function () {
                $(".alert").fadeTo(500, 0).slideUp(500, function () {
                    $(this).remove();
                });
            }, 5000);
        }
    });
    return false;  //stop the actual form post !important!
});
