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

// add new activity in checklist
$("#addActivityDiv").on('submit', function(e) {
 e.preventDefault(); 
 $.ajax({
    url: BASE_URL+"modules/site_inspection/addActivity", // point to server-side PHP script
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


// add new architect
$("#addArchitectForm").on('submit', function(e) {
 e.preventDefault(); 
 $.ajaxSetup({
  headers: {
    'X-CSRF-Token': $('#_token').val()
  }
});
 $.ajax({
    url: "/addArch", // point to server-side PHP script
    data: new FormData(this),
    type: 'POST',
    contentType: false, // The content type used when sending data to the server.
    cache: false, // To unable request pages to be cached
    processData: false,
    beforeSend: function(){
      $('#archSubmit').html('<span class="w3-card w3-padding-small theme_text w3-margin-bottom w3-round"><i class="fa fa-spinner fa-spin w3-large"></i> <b>Adding Architect...</b></span>');
    },
    success: function(data){
      $('#archOutput').html(data);
      $('#archSubmit').html('<button class="btn theme_bg w3-center" type="submit"><i class="fa fa-plus"></i>  Add Architect </button>');

      window.setTimeout(function() {
       $(".alert").fadeTo(500, 0).slideUp(500, function(){
         $(this).remove(); 
       });
       location.reload();
     }, 1500);
    },
    error:function(data){
     $('#archOutput').html('<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failure!</strong> Something went wrong. Please refresh the page and try once again.</div>');
     $('#archSubmit').html('<button class="btn theme_bg w3-center" type="submit"><i class="fa fa-plus"></i>  Add Architect </button>');
     window.setTimeout(function() {
       $(".alert").fadeTo(500, 0).slideUp(500, function(){
         $(this).remove(); 
       });
     }, 5000);
   }
 });
return false;  //stop the actual form post !important!
});

// add new architect
$("#subscriberMailForm").on('submit', function(e) {
 e.preventDefault(); 
 $.ajaxSetup({
  headers: {
    'X-CSRF-Token': $('#_token').val()
  }
});
 $.ajax({
    url: "upload/uploadMailFile", // point to server-side PHP script
    data: new FormData(this),
    type: 'POST',
    contentType: false, // The content type used when sending data to the server.
    cache: false, // To unable request pages to be cached
    processData: false,
    beforeSend: function(){
      $("#addMailFormatBtn").attr("disabled", true);
      $('#addMailFormatBtn').html('<i class="fa fa-spinner fa-spin w3-medium"></i> Uploading...');
    },
    success: function(data){
      $('#errMailerMsg').html(data);
      $('#addMailFormatBtn').removeAttr("disabled");
      $('#addMailFormatBtn').html('<i class="fa fa-upload"></i>');
      window.setTimeout(function() {
        window.location.reload();
      }, 1500);
    },
    error:function(data){
      $('#addMailFormatBtn').removeAttr("disabled");
      $('#errMailerMsg').html('<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failure!</strong> Something went wrong. Please refresh the page and try once again.</div>');

      $('#addMailFormatBtn').html('<i class="fa fa-upload"></i>');
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

// fucntion to delete document
function removeDocument(doc_id,key) {
  $.confirm({
    title: '<h4 class="w3-text-red">Please confirm the action!</h4><span class="w3-medium">Do you really want to remove this Document?</span>',
    content: '',
    type: 'red',
    buttons: {
      confirm: function () {
        $.ajax({
          type: "GET",
          url: BASE_URL + "modules/manage_documents/removeDoc",
          data: {
            doc_id: doc_id
          },
          cache: false,
          beforeSend: function(){
            $('#actionBtn_'+key).html('<i class="fa fa-circle-o-notch fa-spin"></i> Deleting');
          },
          success: function(data){
            $('#table_msg').html(data);
            $('#actionBtn_'+key).html('Action <span class="caret"></span>');

            window.setTimeout(function() {
             $(".alert").fadeTo(500, 0).slideUp(500, function(){
               $(this).remove(); 
             });
             window.location.reload();
           }, 1500);
          },
          error:function(data){
           $('#table_msg').html('<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failure!</strong> Something went wrong. Please refresh the page and try once again.</div>');
           $('#actionBtn_'+key).html('Action <span class="caret"></span>');
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