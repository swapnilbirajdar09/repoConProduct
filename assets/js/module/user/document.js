// ---------- Product page script file ----------------//


// ----function to preview selected image for portfolio------//
function readURL(input,id) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

    var extension = $('#port_image_'+id).val().split('.').pop().toLowerCase();
    // image validation
    if ($.inArray(extension, ['jpeg', 'png', 'jpg']) == -1) {
      $('#ImagePreview_'+id).hide();
      $('#ImagePreview_'+id).attr('src', '');
      $('#image_error_'+id).html('<i class="fa fa-remove"></i> ERROR: Please Select Image File. (file should end with .jpg/ .png/ .jpeg extension!) ');
    } else {
      $('#ImagePreview_'+id).show();
      $('#image_error_'+id).html('');
      reader.onload = function (e) {
        $('#ImagePreview_'+id).attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }
}


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