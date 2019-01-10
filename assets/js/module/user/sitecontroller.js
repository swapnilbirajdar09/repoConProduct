// site controller js

// script to delete work item form list
function delWitem(witem_id)
{
 $.confirm({
  title: '<label class="w3-large w3-text-red"><i class="fa fa-envelope"></i> Please confirm your action.</label>',
  content: '<span class="w3-medium">Do You really want to delete this Work Item permanantly?</span>',
  type: 'red',
  buttons: {
    confirm: function () {
      $.ajax({
        type:'get',
        url:BASE_URL+"modules/site_inspection/delWitem?item_id="+witem_id,                                    
        success:function(response) {
          $('#errWitemMsg').html(response);  
          window.setTimeout(function() {
           $(".alert").fadeTo(500, 0).slideUp(500, function(){
             $(this).remove(); 
           });
           location.reload();
         }, 1000);                                  }
        });
    },
    cancel: function () {}
  }
});
}

// function to upload images for checklist
function checklistImageForm(activity_id){
  var formData = new FormData($('#uploadChecklistImage_'+activity_id)[0]);
  $.ajax({
    url: BASE_URL+"modules/site_inspection/uploadImageInfo", // point to server-side PHP script
    data: formData,
    type: 'POST',
    contentType: false, // The content type used when sending data to the server.
    cache: false, // To unable request pages to be cached
    processData: false,
    beforeSend: function(){
      $('#uploadFilebtn_'+activity_id).html('<i class="fa fa-circle-o-notch fa-spin w3-large"></i> Uploading...');
      $('#uploadFilebtn_'+activity_id).attr('disabled',true);
    },
    success: function(response){
      var data =JSON.parse(response);
      $('#uploadFilebtn_'+activity_id).html('<i class="fa fa-upload"></i> Save and Upload Image');
      $('#uploadFilebtn_'+activity_id).removeAttr('disabled');
      $('#uploadImageMsg_'+activity_id).html(data.message);  
     // response message
     switch(data.status){
      case 'success':
      setTimeout(function() {
        window.location.reload();
              }, 1500); // <-- time in milliseconds 
      break;

      case 'error':
      setTimeout(function() {
        $('.alert_message').fadeOut('fast');
            }, 10000); // <-- time in milliseconds
      break;

      case 'validation':
      setTimeout(function() {
        $('.alert_message').fadeOut('fast');
            }, 8000); // <-- time in milliseconds
      break;
    }
  },
  error:function(data){
    $('#uploadFilebtn_'+activity_id).html('<i class="fa fa-upload"></i> Save and Upload Image');
    $('#uploadImageMsg_'+activity_id).html('<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failure!</strong> Something went wrong. Please refresh the page and try once again.</div>');
    $('#uploadFilebtn_'+activity_id).removeAttr('disabled');
    window.setTimeout(function() {
     $(".alert").fadeTo(500, 0).slideUp(500, function(){
       $(this).remove(); 
     });
   }, 5000);
  }
});
  return false;
}

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
            $('#deleteImageMsg_'+activity_id).html(data);
            $('#image_' + key).html('<i class="fa fa-close"></i>');

            window.setTimeout(function () {
              $(".alert").fadeTo(500, 0).slideUp(500, function () {
                $(this).remove();
              });
              window.location.reload();
            }, 1500);
          },
          error: function (data) {
            $('#deleteImageMsg_'+activity_id).html('<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failure!</strong> Something went wrong. Please refresh the page and try once again.</div>');
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

// Angular js for all product view
var app = angular.module("siteApp", ['ngSanitize']); 
app.controller("siteCtrl", function($scope,$http,$window) {


// remove architect from db
$scope.removeArch = function (arch_id) {
  $.confirm({
    title: '<h4 class="w3-text-red">Please confirm the action!</h4><span class="w3-medium">Do yo really want to delete this architect?</span>',
    content: '',
    type: 'red',
    buttons: {
      confirm: function () {
       $http({
         method: 'get',
         url: '/delArch/'+arch_id,
         //params: {product_id: product_id},
       }).then(function successCallback(response) {
        $window.setTimeout(function() {
          $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove(); 
          });
          location.reload();
        }, 10);

        // $scope.getServices();
      }); 
     },
     cancel: function () {
     }
   }
 });
}

// remove architect from db
$scope.delSubscriber = function (sub_id) {
  $.confirm({
    title: '<h4 class="w3-text-red">Please confirm the action!</h4><span class="w3-medium">Do yo really want to delete this subscriber?</span>',
    content: '',
    type: 'red',
    buttons: {
      confirm: function () {
       $http({
         method: 'get',
         url: '/delSubscriber/'+sub_id,
         //params: {product_id: product_id},
       }).then(function successCallback(response) {
        $window.setTimeout(function() {
          $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove(); 
          });
          location.reload();
        }, 10);

        // $scope.getServices();
      }); 
     },
     cancel: function () {
     }
   }
 });
}


// add new product
$("#addWitemForm").on('submit', function(e) {
 e.preventDefault(); 
 $.ajax({
    url: BASE_URL+"modules/site_inspection/addWitem", // point to server-side PHP script
    data: new FormData(this),
    type: 'POST',
    contentType: false, // The content type used when sending data to the server.
    cache: false, // To unable request pages to be cached
    processData: false,
    beforeSend: function(){
      $('#errWitemMsg').html('<span class="w3-small w3-padding-small theme_text w3-margin-bottom w3-round"><i class="fa fa-circle-o-notch fa-spin w3-large"></i> <b>Adding category...</b></span>');
      $('#addWitemBtn').attr('disabled',true);
    },
    success: function(data){
      $('#addWitemBtn').removeAttr('disabled');
      $('#errWitemMsg').html(data);  
      $('#work_item').val('');
      $("#allWitemDiv").load(location.href + " #allWitemDiv>*", ""); 
      $("#addActivityDiv").load(location.href + " #addActivityDiv>*", ""); 
      window.setTimeout(function() {
       $(".alert").fadeTo(500, 0).slideUp(500, function(){
         $(this).remove(); 
       });
     }, 1500);   
    },
    error:function(data){
     $('#errWitemMsg').html('<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failure!</strong> Something went wrong. Please refresh the page and try once again.</div>');
     $('#addWitemBtn').removeAttr('disabled');
     window.setTimeout(function() {
       $(".alert").fadeTo(500, 0).slideUp(500, function(){
         $(this).remove(); 
       });
     }, 5000);
   }
 });
return false;  //stop the actual form post !important!
});

// add new product
$("#addChecklistForm").on('submit', function(e) {
 e.preventDefault();  
 $.ajax({
    url: BASE_URL+"modules/site_inspection/addActivity", // point to server-side PHP script
    data: new FormData(this),
    type: 'POST',
    contentType: false, // The content type used when sending data to the server.
    cache: false, // To unable request pages to be cached
    processData: false,
    beforeSend: function(){
      $('#btnsubmit').html('<span class="w3-card w3-padding-small theme_text w3-margin-bottom w3-round"><i class="fa fa-spinner fa-spin w3-large"></i> <b>Adding...</b></span>');
    },
    success: function(data){
      $('#formOutput').html(data);
      $('#btnsubmit').html('<button class="btn w3-button theme_bg" id="addActivityBtn" type="submit"><i class="fa fa-plus"></i> Add Activity </button>');

      window.setTimeout(function() {
       $(".alert").fadeTo(500, 0).slideUp(500, function(){
         $(this).remove(); 
       });
       location.reload();
     }, 1500);
    },
    error:function(data){
     $('#formOutput').html('<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failure!</strong> Something went wrong. Please refresh the page and try once again.</div>');
     $('#btnsubmit').html('<button class="btn w3-button theme_bg" id="addActivityBtn" type="submit"><i class="fa fa-plus"></i> Add Activity </button>');
     window.setTimeout(function() {
       $(".alert").fadeTo(500, 0).slideUp(500, function(){
         $(this).remove(); 
       });
     }, 5000);
   }
 });
return false;  //stop the actual form post !important!
});


});

// ----function to open modal product------//
function openModal(id) {
  var modal=$('#ProdModal_'+id);
  modal.addClass('in');
}

// ----function to open modal product------//
function openHelp(modal_id) {
  var modal=$('#'+modal_id);
  modal.addClass('in');
}

//----------fun for add comment
function savecomment(activity_id) {
    //alert(query_id);
    if (activity_id == '') {
        $('.comment_msg').html('<p class="w3-red w3-padding-small w3-small">Warning! Invalid query! Reload the page to resolve the issue.</p>');
        return false;
    }
    var comment_posted = $('#comment_posted_' + activity_id).val();
    if (comment_posted == '') {
        $('.comment_msg').html('<p class="w3-red w3-padding-small w3-small">Warning! Please Add Comment first..</p>');
        return false;
    }
    $.ajax({
        type: "POST",
        url: BASE_URL + "modules/site_inspection/addComment",
        data: {
            activity_id: activity_id,
            comment_posted: comment_posted
        },
        return: false,
        beforeSend: function () {
            $('.comment_msg').html('');
            // $('#commentBtn').prop('disabled', true);
        },
        success: function (response) {
           // alert(response);
            $('#comment_posted_' + activity_id).val('');
            var data = JSON.parse(response);
            $('#commentBtn').prop('disabled', false);
            // response message
            switch (data.status) {
                case 'success':
                    $('.comment_msg').html(data.message);
                    getComments(activity_id);
                    // $('#comment_list').load(location.href + " #comment_list>*", "");
                    break;
                case 'error':
                    $('.comment_msg').html(data.message);
                    break;
                case 'validation':
                    $('.comment_msg').html(data.message);
                    break;
                default:
                    $('.comment_msg').html('<p class="w3-red w3-padding-small w3-small"><strong><b>Error:</b> Something went wrong! Try refreshing page and Save again.</strong></p>');
                    break;
            }
        },
        error: function (response) {
            // Re_Enabling the Elements
            $('#commentBtn').prop('disabled', false);
            $('.comment_msg').html('<p class="w3-red w3-padding-small w3-small"><strong><b>Error:</b> Something went wrong! Try refreshing page and Save again.</strong></p>');
            setTimeout(function () {
                $('.comment_msg').fadeOut('fast');
            }, 4000); // <-- time in milliseconds  
        }
    });
}

// get associated comments
function getComments(activity_id) {
    $('#comment_list_' + activity_id).html("<span class='w3-text-grey'><i class='fa fa-circle-o-notch fa-spin'></i> Loading comments. Please wait... </span>")
    $.ajax({
        type: "GET",
        url: BASE_URL + "modules/site_inspection/getQueryComments",
        data: {
            activity_id: activity_id
        },
        cache: false,
        success: function (response) {
            //alert(response);
            // console.log(response);
            $('#comment_list_' + activity_id).html(response);
            // var data = JSON.parse(response);
        }
    });
}
// fucntion to delete document
function removeActivity(act_id,key) {
  $.confirm({
    title: '<h4 class="w3-text-red">Please confirm the action!</h4><span class="w3-medium">Do you really want to remove this Activity?</span>',
    content: '',
    type: 'red',
    buttons: {
      confirm: function () {
        $.ajax({
          type: "GET",
          url: BASE_URL + "modules/site_inspection/removeActivity",
          data: {
            act_id: act_id
          },
          cache: false,
          beforeSend: function(){
            $('#delBtn_'+key).html('<i class="fa fa-circle-o-notch fa-spin"></i> Deleting');
          },
          success: function(data){
            $('#checklistmsg').html(data);
            $('#delBtn_'+key).html('<i class="fa fa-trash"></i> Delete');

            window.setTimeout(function() {
             $(".alert").fadeTo(500, 0).slideUp(500, function(){
               $(this).remove(); 
             });
             window.location.reload();
           }, 1500);
          },
          error:function(data){
           $('#checklistmsg').html('<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failure!</strong> Something went wrong. Please refresh the page and try once again.</div>');
           $('#delBtn_'+key).html('<i class="fa fa-trash"></i> Delete');
           window.setTimeout(function() {
             $(".alert").fadeTo(500, 0).slideUp(500, function(){
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

// fucntion to mark activity dne or undone
function mark(act_id,status,key) {
  var prompt='<h4 class="w3-text-red">Please confirm the action!</h4><span class="w3-medium">Do you really want to mark this activity <b>Undone</b>?</span>';
  var url=BASE_URL + "modules/site_inspection/markChecklistUndone";
  if(status=='done'){
    var prompt='<h4 class="w3-text-red">Please confirm the action!</h4><span class="w3-medium">Do you really want to mark this activity <b>Done</b>?</span>';
    var url=BASE_URL + "modules/site_inspection/markChecklistDone";
  }
  $.confirm({
    title: prompt,
    content: '',
    type: 'red',
    buttons: {
      confirm: function () {
        $.ajax({
          type: "GET",
          url: url,
          data: {
            act_id: act_id
          },
          cache: false,
          beforeSend: function(){
          },
          success: function(data){
            $('#checklistmsg').html(data);

            window.setTimeout(function() {
             $(".alert").fadeTo(500, 0).slideUp(500, function(){
               $(this).remove(); 
             });
             window.location.reload();
           }, 1500);
          },
          error:function(data){
           $('#checklistmsg').html('<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failure!</strong> Something went wrong. Please refresh the page and try once again.</div>');
           window.setTimeout(function() {
             $(".alert").fadeTo(500, 0).slideUp(500, function(){
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
$("#editDocument_form").on('submit', function(e) {
 e.preventDefault(); 
 dataString = $("#editDocument_form").serialize();
 $.ajax({
    url: BASE_URL+"modules/manage_documents/updateDocument", // point to server-side PHP script
    data: new FormData(this),
    type: 'POST',
    contentType: false, // The content type used when sending data to the server.
    cache: false, // To unable request pages to be cached
    processData: false,
    beforeSend: function(){
      $('#updateDocBtn').prop('disabled', true);
      $('#updateDocBtn').html('<i class="fa fa-circle-o-notch fa-spin"></i> Updating changes');
    },
    success: function(response){
      $('#updateDocBtn').prop('disabled', false);
      $('#updateDocBtn').html('<i class="fa fa-edit"></i> Click here to Save Changes');
      var data=JSON.parse(response);
      // response message
      switch(data.status){
        case 'success':
        $('#response_msg').html(data.message);
        setTimeout(function() {
          window.location.reload();
                        }, 1500); // <-- time in milliseconds 
        
        break;

        case 'error':
        $('#response_msg').html(data.message);
        setTimeout(function() {
          $('.alert').fadeOut('fast');
                        }, 10000); // <-- time in milliseconds
        break;

        case 'validation':
        $('#response_msg').html(data.message);
        $("input[id='"+data.field+"']").focus();
        $("input[name='"+data.field+"']").focus();
        $("select[name='"+data.field+"']").focus();
        setTimeout(function() {
          $('.alert').fadeOut('fast');
                        }, 8000); // <-- time in milliseconds
        break;
        default:
        $('#response_msg').html('<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Fatal Error-</strong> Something went wrong. Please Logout your account and Try Logging in again.</div>');
        setTimeout(function() {
          $('.alert').fadeOut('fast');
                        }, 8000); // <-- time in milliseconds
        break;
      }
    },
    error:function(data){
      $('#updateDocBtn').prop('disabled', false);
      $('#response_msg').html('<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failure!</strong> Something went wrong. Please refresh the page and try once again.</div>');
      $('#updateDocBtn').html('<i class="fa fa-edit"></i> Click here to Save Changes');
      window.setTimeout(function() {
       $(".alert").fadeTo(500, 0).slideUp(500, function(){
         $(this).remove(); 
       });
     }, 5000);
    }
  });
return false;  //stop the actual form post !important!
});

// upload file form
$("#uploadFileForm").on('submit', function(e) {
 e.preventDefault(); 
 dataString = $("#uploadFileForm").serialize();
 $.ajax({
    url: BASE_URL+"modules/manage_documents/uploadFile", // point to server-side PHP script
    data: new FormData(this),
    type: 'POST',
    contentType: false, // The content type used when sending data to the server.
    cache: false, // To unable request pages to be cached
    processData: false,
    beforeSend: function(){
      $('#uploadFile').prop('disabled', true);
      $('#uploadFile').html('<i class="fa fa-circle-o-notch fa-spin"></i> Uploading...');
    },
    success: function(response){
      $('#uploadFile').prop('disabled', false);
      $('#uploadFile').html('<i class="fa fa-upload"></i> Upload File');
      var data=JSON.parse(response);
      // response message
      switch(data.status){
        case 'success':
        $('#file_msg').html(data.message);
        setTimeout(function() {
          window.location.reload();
                        }, 1500); // <-- time in milliseconds 
        
        break;

        case 'error':
        $('#file_msg').html(data.message);
        setTimeout(function() {
          $('.alert').fadeOut('fast');
                        }, 10000); // <-- time in milliseconds
        break;

        case 'validation':
        $('#file_msg').html(data.message);
        $("input[id='"+data.field+"']").focus();
        $("input[name='"+data.field+"']").focus();
        $("select[name='"+data.field+"']").focus();
        setTimeout(function() {
          $('.alert').fadeOut('fast');
                        }, 8000); // <-- time in milliseconds
        break;
        default:
        $('#file_msg').html('<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Fatal Error-</strong> Something went wrong. Please Logout your account and Try Logging in again.</div>');
        setTimeout(function() {
          $('.alert').fadeOut('fast');
                        }, 8000); // <-- time in milliseconds
        break;
      }
    },
    error:function(data){
      $('#uploadFile').prop('disabled', false);
      $('#file_msg').html('<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failure!</strong> Something went wrong. Please refresh the page and try once again.</div>');
      $('#uploadFile').html('<i class="fa fa-upload"></i> Upload File');
      window.setTimeout(function() {
       $(".alert").fadeTo(500, 0).slideUp(500, function(){
         $(this).remove(); 
       });
     }, 5000);
    }
  });
return false;  //stop the actual form post !important!
});

// remove woork item
function removeFile(key,document_id) {
  $.confirm({
    title: '<h4 class="w3-text-red">Please confirm the action!</h4><span class="w3-medium">Do you really want to remove this File?</span>',
    content: '',
    type: 'red',
    buttons: {
      confirm: function () {
        $.ajax({
          type: "GET",
          url: BASE_URL+"modules/manage_documents/removeFile",
          data: {
            key: key,
            document_id: document_id
          },
          cache: false,
          beforeSend: function(){
            $('#fileBtn_'+key).html('<i class="fa fa-circle-o-notch fa-spin w3-medium"></i>');
          },
          success: function(data){
            $('#file_msg').html(data);
            $('#fileBtn_'+key).html('<i class="fa fa-times"></i>');

            window.setTimeout(function() {
             $(".alert").fadeTo(500, 0).slideUp(500, function(){
               $(this).remove(); 
             });
             window.location.reload();
           }, 1500);
          },
          error:function(data){
           $('#file_msg').html('<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failure!</strong> Something went wrong. Please refresh the page and try once again.</div>');
           $('#fileBtn_'+key).html('<i class="fa fa-times"></i>');
           window.setTimeout(function() {
             $(".alert").fadeTo(500, 0).slideUp(500, function(){
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

// add more imae div
// $(document).ready(function () {
//   var max_fields = 5;
//   var wrapper = $("#addedmore_imageDiv");
//   var add_button = $("#add_moreimage");
//   var x = 1;

//   $(add_button).click(function (e) {
//     e.preventDefault();
//     if (x < max_fields) {
//       x++;
//       $(wrapper).append('<div>\n\
//         <div class="w3-col l12 s12 m12 w3-small w3-margin-top">\n\
//         <div class="w3-col l6 ">\n\
//         <label>Images:</label>\n\
//         <input type="file" name="image[]" id="image" class="w3-input w3-border" onchange="readURLNEW(this,'+x+');">\n\
//         </div>\n\
//         <div class="w3-col l6 w3-padding-small w3-margin-top">\n\
//         <img width="auto" id="ImagePreview_'+x+'" height="150px" alt="Image will be displayed here once chosen." class=" w3-center img img-thumbnail">\n\
//         </div>\n\        
//         <a href="#" class="delete btn w3-text-black w3-left w3-small" title="remove image">remove <i class="fa fa-remove"></i>\n\
//         </a>\n\
//         </div>\n\
//         </div>'); //add input box
//     } else {
//         $.alert('<label class="w3-label w3-text-red"><i class="fa fa-warning w3-xxlarge"></i> You Reached the maximum limit of adding ' + max_fields + ' fields</label>');   //alert when added more than 4 input fields
//       }
//     });
//   $(wrapper).on("click", ".delete", function (e) {
//     e.preventDefault();
//     $(this).parent('div').remove();
//     x--;
//   })
// });

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