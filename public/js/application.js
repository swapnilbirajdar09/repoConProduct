var allFiles=[];
var formData=[];
var datafile = new plupload.Uploader({
	runtimes : 'html5,flash,silverlight,html4',
	browse_button : 'uploadFile', // you can pass in id...
	container: document.getElementById('container'), // ... or DOM Element itself
	chunk_size: '10240mb', 
	url : BASE_URL + 'modules/manage_documents/uploadtoserver',
	max_file_count: 1,
	//max_file_size: '10mb',
	//multi_selection: true,

	//ADD FILE FILTERS HERE
	filters : {
		/* mime_types: [
				{title : "XML files", extensions : "xml"},
			]
			*/
		}, 

	// Flash settings
	flash_swf_url : BASE_URL + 'public/js/plupload/Moxie.swf',

	// Silverlight settings
	silverlight_xap_url : BASE_URL + 'public/js/plupload/Moxie.xap',
	 

	init: {
		PostInit: function() {
		//	alert('vaidehi');

		document.getElementById('filelist').innerHTML = '';	 
		document.getElementById('upload').onclick = function() {
				//alert('bizmo');
				// $("#document_uploadForm").submit(function(e ) {
			 //	alert('joshi');
                //e.preventDefault();
                //e.stopPropagation();
                // form validation
                var doc_type=$('#document_type').val();
                var document_title=$('#document_title').val();
                var revision_number=$('#revision_number').val();

                if(doc_type=='0'){
                	$('#response_msg').html('<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Warning-</strong> Choose Document Type first !</div>');
                	$("#document_type").focus();
                	setTimeout(function() {
                		$('.alert').fadeOut('fast');
                        }, 8000); // <-- time in milliseconds
                	return false;
                }
                if(document_title==''){
                	$('#response_msg').html('<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Warning-</strong> Please enter <b>Document Title</b> !</div>');
                	$("#document_title").focus();
                	setTimeout(function() {
                		$('.alert').fadeOut('fast');
                        }, 8000); // <-- time in milliseconds
                	return false;
                }
                if(revision_number==''){
                	$('#response_msg').html('<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Warning-</strong> Please enter <b>Revision Number</b> !</div>');
                	$("#revision_number").focus();
                	setTimeout(function() {
                		$('.alert').fadeOut('fast');
                        }, 8000); // <-- time in milliseconds
                	return false;
                }
                
                var checkedNum = $('input[name="shared_with[]"]:checked').length;
                //alert(checkedNum);return false;
                if (checkedNum == 0) {
                	$('#response_msg').html('<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Warning-</strong> Please Choose Atleast One Role  !</div>');
                	$("#document_type").focus();
                	setTimeout(function() {
                		$('.alert').fadeOut('fast');
                        }, 8000); // <-- time in milliseconds
                	return false;
                }
                

           // });
           datafile.start();
           return false;
       };
   },

   FilesAdded: function(up, files) {
   	plupload.each(files, function(file) {
   		document.getElementById('filelist').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
   	});
   },

   UploadProgress: function(up, file) {

   	document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";



   },
   FileUploaded: function(up,file){
			//formData=$('document_uploadForm').serializeArray();
			//console.log($('#document_uploadForm').serializeArray());
			var dataString = $("#document_uploadForm").serializeArray();
  			dataString.push({name: 'file_uploaded', value: 'uploads/'+file.name});
			//formData.push("file_uploaded", 'uploads/'+file.name);
			$.ajax({
        	url: BASE_URL + "modules/manage_documents/uploadFileData", // point to server-side PHP script
        	data: dataString,
        	type: 'POST',
        	cache: false, // To unable request pages to be cached
        	beforeSend: function () {
        		$('#upload').prop('disabled', true);
        		$('#upload').html('<i class="fa fa-circle-o-notch fa-spin"></i> Uploading document...');
        	},
        	success: function (response) {
        		$('#upload').prop('disabled', false);
        		$('#upload').html('Click here to Submit');
        		//console.log(response);return false;
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
            	$('#upload').prop('disabled', false);
            	$('#response_msg').html('<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failure!</strong> Something went wrong. Please refresh the page and try once again.</div>');
            	$('#upload').html('Click here to Submit');
            	window.setTimeout(function () {
            		$(".alert").fadeTo(500, 0).slideUp(500, function () {
            			$(this).remove();
            		});
            	}, 5000);
            }
        });
    return false;  //stop the actual form post !important!

},
Error: function(up, err) {
	document.getElementById('console').innerHTML += "\nError #" + err.code + ": " + err.message;
}
}
});

datafile.init();