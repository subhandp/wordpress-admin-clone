 Dropzone.autoDiscover = false;
$("#dropzone_media").dropzone({
	url: base_url+'admin/proses_uploads/upload_file',
	acceptedFiles: 'image/*,application/vnd.ms-powerpoint,application/vnd.ms-excel,application/msword,application/pdf,application/zip,application/x-rar-compressed,application/vnd.oasis.opendocument.text,application/vnd.oasis.opendocument.spreadsheet',
	addRemoveLinks: true,
	paramName: "media",
	maxFilesize:2, //Mb
	init: function(){
		var dropzoneku=this;
        dropzoneku.on("success", function (file, response) {
			if (file.status == 'success') {
				handleDropzoneUpload.handleSuccess(response);
				console.log(response);
			} else{
				handleDropzoneUpload.handleError(response);
			};
	        
	        console.log(response);	
		});
	}

});

var handleDropzoneUpload={
	handleError: function(response){
		console.log(response);	
	},
	handleSuccess: function(response){
		var mediaList = $('div.media-body');
		mediaList.prepend(response);
	}
}



