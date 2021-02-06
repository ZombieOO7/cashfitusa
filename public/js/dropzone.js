var DropzoneDemo = {
    init: function () {
        Dropzone.options.mDropzoneOne = {
            paramName: "file",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrfToken"]').attr('content')
            },
            params:{
                'loan_id':loanId,
            },
            maxFiles: 1,
            maxFilesize: 5,
            thumbnailWidth: null,
            thumbnailHeight: null,
            addRemoveLinks: !0,
            accept: function (file, done) {
                // if (file.type != "image/jpeg" && file.type != "image/png" && file.type != "pdf") {
                //     done("Error! Files of this type are not accepted");
                // }else{
                //     $('input[name=front_licence]').val(1);
                    done();
                // }
            },
            removedfile: function(file) {
                var fileName = file.name;
                var _ref;
                $('input[name=front_licence]').val('');
                return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
            }
        }, 
        Dropzone.options.mDropzoneTwo = {
            paramName: "file",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrfToken"]').attr('content')
            },
            params:{
                'loan_id':loanId,
            },
            maxFiles: 1,
            maxFilesize: 5,
            addRemoveLinks: !0,
            accept: function (file, done) {
                // if (file.type != "image/jpeg" && file.type != "image/png" && file.type != "pdf") {
                //     done("Error! Files of this type are not accepted");
                // }else{
                //     $('input[name=back_licence]').val(1);
                    done();
                // }
            },
            removedfile: function(file) {
                var fileName = file.name;
                var _ref;
                $('input[name=back_licence]').val('');
                return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
            }
        },
        Dropzone.options.mDropzoneThree = {
            paramName: "file",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrfToken"]').attr('content')
            },
            params:{
                'loan_id':loanId,
            },
            maxFiles: 1,
            maxFilesize: 5,
            addRemoveLinks: !0,
            accept: function (file, done) {
                // if (file.type != "image/jpeg" && file.type != "image/png" && file.type != "pdf") {
                //     done("Error! Files of this type are not accepted");
                // }else{
                //     $('input[name=address_proof]').val(1);
                    done();
                // }
            },
            removedfile: function(file) {
                var fileName = file.name;
                var _ref;
                $('input[name=address_proof]').val('');
                return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
            }
        }
        Dropzone.options.mDropzoneFour = {
            paramName: "file",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrfToken"]').attr('content')
            },
            params:{
                'loan_id':loanId,
            },
            maxFiles: 1,
            maxFilesize: 5,
            addRemoveLinks: !0,
            accept: function (file, done) {
                // if (file.type != "image/jpeg" && file.type != "image/png" && file.type != "pdf") {
                //     done("Error! Files of this type are not accepted");
                // }else{
                //     $('input[name=selfie]').val(1);
                    done();
                // }
            },
            removedfile: function(file) {
                var fileName = file.name;
                var _ref;
                $('input[name=selfie]').val('');
                return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
            }
        }
    }
};
DropzoneDemo.init();

// Dropzone.autoDiscover = false;
url1 = $("#m-dropzone-one").attr('data-url');
size1 = $("#m-dropzone-one").attr('data-size');
status1 = $("#m-dropzone-one").attr('data-status');

$("#m-dropzone-one").dropzone({
  init: function() {
    myDropzone = this;
    var mockFile = { name: "Front Licence" ,size:size1};
    if(status1 != 2 && url1 != null && size1 != null && url1 != '' && size1 != ''){
        myDropzone.emit("addedfile", mockFile);
        myDropzone.emit("thumbnail", mockFile, url1);
        myDropzone.emit("complete", mockFile);
    }
    this.on("maxfilesexceeded", function(file){
        swal("No more files please!", {
            icon: 'info',
            closeOnClickOutside: false,
        });
    });
    this.on("addedfile", function (file) {
        if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
            if (mockFile) {
                this.removeFile(mockFile);
            }
        }
    })
  }
});
url2 = $("#m-dropzone-two").attr('data-url');
size2 = $("#m-dropzone-two").attr('data-size');
status2 = $("#m-dropzone-two").attr('data-status');

$("#m-dropzone-two").dropzone({
  init: function() { 
    myDropzone = this;
    var mockFile = { name: "Back Licence" ,size:size2};
    if(status2 != 2 && url2 != null && size2 != null && url2 != '' && size2 != ''){
        myDropzone.emit("addedfile", mockFile);
        myDropzone.emit("thumbnail", mockFile, url2);
        myDropzone.emit("complete", mockFile);
    }
    this.on("maxfilesexceeded", function(file){
        swal("No more files please!", {
            icon: 'info',
            closeOnClickOutside: false,
        });
    });
    this.on("addedfile", function (file) {
        if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
            if (mockFile) {
                this.removeFile(mockFile);
            }
        }
    });
  }
});
url3 = $("#m-dropzone-three").attr('data-url');
size3 = $("#m-dropzone-three").attr('data-size');
status3 = $("#m-dropzone-three").attr('data-status');

$("#m-dropzone-three").dropzone({
  init: function() { 
    myDropzone = this;
    var mockFile = { name: "Address Proof" ,size:size3};
    if(status3 != 2 && url3 != null && size3 != null && url3 != '' && size3 != ''){
        myDropzone.emit("addedfile", mockFile);
        myDropzone.emit("thumbnail", mockFile, url3);
        myDropzone.emit("complete", mockFile);
    }
    this.on("maxfilesexceeded", function(file){
        swal("No more files please!", {
            icon: 'info',
            closeOnClickOutside: false,
        });
    });
    this.on("addedfile", function (file) {
        if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
            if (mockFile) {
                this.removeFile(mockFile);
            }
        }
    });
  }
});
url4 = $("#m-dropzone-four").attr('data-url');
size4 = $("#m-dropzone-four").attr('data-size');
status4 = $("#m-dropzone-four").attr('data-status');

$("#m-dropzone-four").dropzone({
  init: function() {
    myDropzone = this;
    var mockFile = { name: "Selfie" ,size:size4};
    if(status4 != 2 && url4 != '' && size4 != '' && url4 != null && size4 != null){
        myDropzone.emit("addedfile", mockFile);
        myDropzone.emit("thumbnail", mockFile, url4);
        myDropzone.emit("complete", mockFile);
    }
    this.on("maxfilesexceeded", function(file){
        swal("No more files please!", {
            icon: 'info',
            closeOnClickOutside: false,
        });
    });
    this.on("addedfile", function (file) {
        if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
            if (mockFile) {
                this.removeFile(mockFile);
            }
        }
    });
  }
});