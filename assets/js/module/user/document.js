// ---------- Product page script file ----------------//


// ----function to preview selected image for portfolio------//
function readURL(input, id) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        var extension = $('#port_image_' + id).val().split('.').pop().toLowerCase();
        // image validation
        if ($.inArray(extension, ['jpeg', 'png', 'jpg']) == -1) {
            $('#ImagePreview_' + id).hide();
            $('#ImagePreview_' + id).attr('src', '');
            $('#image_error_' + id).html('<i class="fa fa-remove"></i> ERROR: Please Select Image File. (file should end with .jpg/ .png/ .jpeg extension!) ');
        } else {
            $('#ImagePreview_' + id).show();
            $('#image_error_' + id).html('');
            reader.onload = function (e) {
                $('#ImagePreview_' + id).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
}


// ----function to open modal product------//
function openModal(id) {
    var modal = $('#ProdModal_' + id);
    modal.addClass('in');
}

// ----function to open modal product------//
function openHelp(modal_id) {
    var modal = $('#' + modal_id);
    modal.addClass('in');
}
//-----fun for msg
function showMsg() {
    $('#table_msg').html('<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failure!</strong> Request For Document Deletion Already Raised.</div>');
    window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 5000);
}
// fucntion to delete document
function removeDocument(doc_id, key) {
    $.confirm({
        title: '<h4 class="w3-text-red">Please confirm the action!</h4><span class="w3-medium">Reuest For Deletion. Add Reasone For Delete Document.</span>',
        type: 'red',
        content: '' +
                '<form action="" class="formName">' +
                '<div class="form-group">' +
                '<input type="text" id="reason" name="reason" placeholder="Enter Reason For Delete The Document" value="" id="auto_passwd" class="w3-border auto_passwd w3-input" required>' +
//                '<br><span class="w3-small w3-text-red"><b>[NOTE: You can modify this Auto-generated Password.]</b></span>' +
                '</div>' +
                '</form>',
        buttons: {
            confirm: function () {
                $.ajax({
                    type: "GET",
                    url: BASE_URL + "modules/manage_documents/sendRequestForDeletion",
                    data: {
                        doc_id: doc_id,
                        reason: $('#reason').val()
                    },
                    cache: false,
                    beforeSend: function () {
                        $('#actionBtn_' + key).html('<i class="fa fa-circle-o-notch fa-spin"></i> Sending');
                    },
                    success: function (data) {
                        //alert(data);
                        $('#table_msg').html(data);
                        $('#actionBtn_' + key).html('Action <span class="caret"></span>');

                        window.setTimeout(function () {
                            $(".alert").fadeTo(500, 0).slideUp(500, function () {
                                $(this).remove();
                            });
                            window.location.reload();
                        }, 1500);
                    },
                    error: function (data) {
                        $('#table_msg').html('<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failure!</strong> Something went wrong. Please refresh the page and try once again.</div>');
                        $('#actionBtn_' + key).html('Action <span class="caret"></span>');
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

// update changes of document
$("#editDocument_form").on('submit', function (e) {
    e.preventDefault();
    dataString = $("#editDocument_form").serialize();
    $.ajax({
        url: BASE_URL + "modules/manage_documents/updateDocument", // point to server-side PHP script
        data: new FormData(this),
        type: 'POST',
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false,
        beforeSend: function () {
            $('#updateDocBtn').prop('disabled', true);
            $('#updateDocBtn').html('<i class="fa fa-circle-o-notch fa-spin"></i> Updating changes');
        },
        success: function (response) {
            $('#updateDocBtn').prop('disabled', false);
            $('#updateDocBtn').html('<i class="fa fa-edit"></i> Click here to Save Changes');
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
                    $("input[id='" + data.field + "']").focus();
                    $("input[name='" + data.field + "']").focus();
                    $("select[name='" + data.field + "']").focus();
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

// upload file form
$("#uploadFileForm").on('submit', function (e) {
    e.preventDefault();
    dataString = $("#uploadFileForm").serialize();
    $.ajax({
        url: BASE_URL + "modules/manage_documents/uploadFile", // point to server-side PHP script
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
                    $("input[id='" + data.field + "']").focus();
                    $("input[name='" + data.field + "']").focus();
                    $("select[name='" + data.field + "']").focus();
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

// remove files from gallery
function removeFile(key, document_id) {
    $.confirm({
        title: '<h4 class="w3-text-red">Please confirm the action!</h4><span class="w3-medium">Do you really want to remove this File?</span>',
        content: '',
        type: 'red',
        buttons: {
            confirm: function () {
                $.ajax({
                    type: "GET",
                    url: BASE_URL + "modules/manage_documents/removeFile",
                    data: {
                        key: key,
                        document_id: document_id
                    },
                    cache: false,
                    beforeSend: function () {
                        $('#fileBtn_' + key).html('<i class="fa fa-circle-o-notch fa-spin w3-medium"></i>');
                    },
                    success: function (data) {
                        $('#file_msg').html(data);
                        $('#fileBtn_' + key).html('<i class="fa fa-times"></i>');

                        window.setTimeout(function () {
                            $(".alert").fadeTo(500, 0).slideUp(500, function () {
                                $(this).remove();
                            });
                            window.location.reload();
                        }, 1500);
                    },
                    error: function (data) {
                        $('#file_msg').html('<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failure!</strong> Something went wrong. Please refresh the page and try once again.</div>');
                        $('#fileBtn_' + key).html('<i class="fa fa-times"></i>');
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

// Angular js for all product view
// var app = angular.module("portfolioApp", ['ngSanitize']); 
// app.controller("PortfolioCtrl", function($scope,$http,$window) {

// // // Download file code
// // $scope.downloadFile = function (file_path) {
// //   $http({
// //    method: 'get',
// //    url: 'product/downloadFile',
// //    params: {file_path: file_path},
// //  }).then(function successCallback(response) {
// //   alert(response.data);
// // });
// // }
// });


// remove image from portfolio gallery
// function removeImage(key,portfolio_id) {
//   $.confirm({
//     title: '<h4 class="w3-text-red">Please confirm the action!</h4><span class="w3-medium">Do you really want to remove this Image?</span>',
//     content: '',
//     type: 'red',
//     buttons: {
//       confirm: function () {
//         $.ajax({
//           type: "GET",
//           url: BASE_URL + "admin/manage_portfolio/removeImage",
//           data: {
//             key: key,
//             portfolio_id: portfolio_id
//           },
//           cache: false,
//           beforeSend: function(){
//             $('#imgBtn_'+key).html('<i class="fa fa-circle-o-notch fa-spin w3-large"></i>');
//           },
//           success: function(data){
//             $('#edit_formOutput').html(data);
//             $('#imgBtn_'+key).html('<i class="fa fa-times"></i>');

//             window.setTimeout(function() {
//              $(".alert").fadeTo(500, 0).slideUp(500, function(){
//                $(this).remove(); 
//              });
//              window.location.reload();
//            }, 2000);
//           },
//           error:function(data){
//            $('#edit_formOutput').html('<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failure!</strong> Something went wrong. Please refresh the page and try once again.</div>');
//            $('#imgBtn_'+key).html('<i class="fa fa-times"></i>');
//            window.setTimeout(function() {
//              $(".alert").fadeTo(500, 0).slideUp(500, function(){
//                $(this).remove(); 
//              });
//            }, 5000);
//          }
//        });
//       },
//       cancel: function () {
//       }
//     }
//   });
// }