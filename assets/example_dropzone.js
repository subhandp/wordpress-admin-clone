Dropzone.options.dropzone_media= {
    maxFilesize: 4,
    acceptedFiles: 'image/*,application/vnd.ms-powerpoint,application/vnd.ms-excel,application/msword,application/pdf,application/zip,application/x-rar-compressed,application/vnd.oasis.opendocument.text,application/vnd.oasis.opendocument.spreadsheet',
	success: function(file, response) {
			if (file.status == 'success') {
				handleDropzoneUpload.handleError(response);
				
			} else{
				handleDropzoneUpload.handleSuccess(response);
			};
	               	     
	    }
  };


   Dropzone.autoDiscover = false;
$("#dropzone_media").dropzone({
	url: base_url+'admin/proses_uploads/upload_file',
	acceptedFiles: 'image/*,application/vnd.ms-powerpoint,application/vnd.ms-excel,application/msword,application/pdf,application/zip,application/x-rar-compressed,application/vnd.oasis.opendocument.text,application/vnd.oasis.opendocument.spreadsheet',
	addRemoveLinks: true,
	paramName: "media",
	maxFilesize:2, //Mb
	success: function(file, response) {
			if (file.status == 'success') {
				handleDropzoneUpload.handleError(response);
				console.log(file);
			} else{
				handleDropzoneUpload.handleSuccess(response);
			};
	        
	        console.log(response);	       	     
	    }

});