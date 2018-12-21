
// Angular js for all product view
var app = angular.module("genericApp", ['ngSanitize']); 
app.controller("genericCtrl", function($scope,$http,$window) {


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

// add new project
$("#addProjectForm").on('submit', function(e) {
 e.preventDefault(); 
 $.ajax({
    url: BASE_URL+"user/create_project/create_Newproject", // point to server-side PHP script
    data: new FormData(this),
    type: 'POST',
    contentType: false, // The content type used when sending data to the server.
    cache: false, // To unable request pages to be cached
    processData: false,
    beforeSend: function(){
      $('#errProjectMsg').html('<span class="w3-small w3-padding-small theme_text w3-margin-bottom w3-round"><i class="fa fa-circle-o-notch fa-spin w3-large"></i> <b>Adding category...</b></span>');
      $('#project_done').attr('disabled',true);
    },
    success: function(data){
      $('#project_done').removeAttr('disabled');
      $('#errProjectMsg').html(data);        
      window.setTimeout(function() {
       $(".alert").fadeTo(500, 0).slideUp(500, function(){
         $(this).remove(); 
       });
     }, 1500);   
    },
    error:function(data){
     $('#errProjectMsg').html('<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failure!</strong> Something went wrong. Please refresh the page and try once again.</div>');
     $('#project_done').removeAttr('disabled');
     window.setTimeout(function() {
       $(".alert").fadeTo(500, 0).slideUp(500, function(){
         $(this).remove(); 
       });
     }, 5000);
   }
 });
return false;  //stop the actual form post !important!
});

// add new work item
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
