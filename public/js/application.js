var datafile = new plupload.Uploader({
	runtimes : 'html5,flash,silverlight,html4',
	browse_button : 'uploadFile', // you can pass in id...
	container: document.getElementById('container'), // ... or DOM Element itself
	chunk_size: '500mb', 
	url : BASE_URL + 'modules/manage_documents/uploadtoserver',
	max_file_count: 1,

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
			alert('vaidhei');
			
			document.getElementById('filelist').innerHTML = '';	 
			document.getElementById('upload').onclick = function() {
				alert('bizmo');
				// $("#document_uploadForm").submit(function(e ) {
			 	alert('joshi');
                //e.preventDefault();
                //e.stopPropagation();
                // form validation
                var doc_type=$('#document_type').val();

                if(doc_type=='0'){
                    $('#response_msg').html('<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Warning-</strong> Choose Document Type first !</div>');
                    $("#document_type").focus();
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
			console.log(up);
			console.log(file);
			return false;
			document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
		},

		Error: function(up, err) {
			document.getElementById('console').innerHTML += "\nError #" + err.code + ": " + err.message;
		}
	}
});

datafile.init();