$(document).ready(function () {
    $('#frontLicence').on('click',function(){
        $('#frontLicenceId').click();
    })
    $('#backLicence').on('click',function(){
        $('#backLicenceId').click();
    })
    $('#addressProof').on('click',function(){
        $('#addressProofId').click();
    })
    $('#aselfieId').on('click',function(){
        $('#selfieId').click();
    })
    $('input[name="ssn"]').keyup(function() {
        jQuery.validator.addMethod("alphanumeric", function(value, element) {
            return this.optional(element) || /^[+]*[(]{0,1}[0-9]{1,3}[)]{0,1}[-\s\./0-9]*$/i.test(value);
        }, "Numbers and dashes only");
    });
    $('input[name="ssn"]').keyup(function() {
        o = $(this).val();
        n = o.replace(/(\d{3})(\d{3})(\d{3})/, "$1-$2-$3");
        $(this).val(n);
    })
    $.validator.addMethod("minAge", function(value, element, min) {
        var today = new Date();
        var birthDate = new Date(value);
        var age = today.getFullYear() - birthDate.getFullYear();
        if (age > min+1) { return true; }
        var m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) { age--; }
        return age >= min;
    }, "You must be at least 18 years of age.");
    $.validator.addMethod("noSpace", function (value, element) {
        return $.trim(value);
    }, "This field is required");
    /* Form Validation */
    $("#m_form_1").validate({
        rules: {
            first_name: {
                required: true,
                maxlength: rule.name_length,
                noSpace: true,
            },
            last_name: {
                required: true,
                maxlength: rule.name_length,
                noSpace: true,
            },
            // middle_name: {
            //     required: true,
            //     maxlength: rule.name_length,
            //     noSpace: true,
            // },
            address1: {
                required: !0,
                maxlength: rule.text_length,
            },
            city: {
                required: !0,
                maxlength: rule.name_length,
                noSpace: true,
            },
            state: {
                required: !0,
                maxlength: rule.name_length,
                noSpace: true,
            },
            zip_code: {
                required: !0,
                maxlength: rule.zip_code_length,
                noSpace: true,
            },
            front_licence:{
                    required: function (element) {
                        if ($("#m-dropzone-one .dz-preview").length > 0) {
                            return false;
                        } else {
                            return true;
                        }
                    },
                    // extension: "jpg|jpeg|png"
            },
            back_licence:{
                required: function (element) {
                    if ($("#m-dropzone-two .dz-preview").length > 0) {
                        return false;
                    } else {
                        return true;
                    }
                },
                // extension: "jpg|jpeg|png"
            },
            address_proof:{
                    required: function (element) {
                        if ($("#m-dropzone-three .dz-preview").length > 0) {
                            return false;
                        } else {
                            return true;
                        }
                    },
                    // extension: "jpg|jpeg|png"
            },
            ssn:{
                required:true,
                maxlength: rule.ssn_length,
                minlength: rule.ssn_length,
                noSpace:true,
                alphanumeric: true
            },
            dob:{
                required:true,
                minAge: 18,
            },
        },
        messages:{
            ssn:{
                maxlength:'Please enter no more than 9 characters.',
                minlength:'Please enter no more than 9 characters.',
            },
        },
        ignore: [],
        errorPlacement: function (error, element) {
            console.log(element);
            if(element.attr("name") == 'front_licence')
                error.insertAfter('.frontLicence');
            else if(element.attr("name") == 'address_proof')
                error.insertAfter('.addressProof');
            else if(element.attr("name") == 'term_and_condition'){
                error.insertAfter('.tnc');
            }else{
                error.insertAfter(element);
            }
        },
        invalidHandler: function (e, r) {
            $("#m_form_1_msg").removeClass("m--hide").show(),
                mUtil.scrollTop()
        },
        submitHandler: function (form) {
            if (!this.beenSubmitted) {
                $('.formData').hide();
                $('#process').show();
                setTimeout(function(){
                    this.beenSubmitted = true;
                    form.submit();
                },5000);
            }
        },
    })
});
$("#dob").datepicker({    
    startDate: new Date('1920'),
    endDate: new Date(),
    autoclose: true, 
    todayHighlight: true
})

var DropzoneDemo = {
    autoProcessQueue: false,
    init: function () {
        Dropzone.options.mDropzoneOne = {
            paramName: "file",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrfToken"]').attr('content')
            },
            params:{
                'earning_id':earningId,
            },
            maxFiles: 1,
            maxFilesize: 5,
            addRemoveLinks: !0,
            accept: function (e, o) {
                "justinbieber.jpg" == e.name ? o("Naha, you don't.") : o()
            },
        },
        Dropzone.options.mDropzoneTwo = {
            paramName: "file",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrfToken"]').attr('content')
            },
            params:{
                'earning_id':earningId,
            },
            maxFiles: 1,
            maxFilesize: 5,
            addRemoveLinks: !0,
            accept: function (e, o) {
                "justinbieber.jpg" == e.name ? o("Naha, you don't.") : o()
            },
        },
        Dropzone.options.mDropzoneThree = {
            paramName: "file",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrfToken"]').attr('content')
            },
            params:{
                'earning_id':earningId,
            },
            maxFiles: 1,
            maxFilesize: 5,
            addRemoveLinks: !0,
            accept: function (e, o) {
                "justinbieber.jpg" == e.name ? o("Naha, you don't.") : o()
            },
        }
    }
};
DropzoneDemo.init();
Dropzone.autoDiscover = false;

// Dropzone.autoDiscover = false;
url1 = $("#m-dropzone-one").attr('data-url');
size1 = $("#m-dropzone-one").attr('data-size');
status1 = $("#m-dropzone-one").attr('data-status');
var formData = new FormData();
// formData = $('form').serialize(); 
$("#m-dropzone-one").dropzone({
    maxFiles: 1,
    maxFilesize: 5,
    addRemoveLinks: !0,
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
    },
    success: function(file,response){
        $(document).find('#front_licence').val(response.filename);
    }
});

url1 = $("#m-dropzone-two").attr('data-url');
size1 = $("#m-dropzone-two").attr('data-size');
status1 = $("#m-dropzone-two").attr('data-status');
$("#m-dropzone-two").dropzone({
    maxFiles: 1,
    maxFilesize: 5,
    addRemoveLinks: !0,
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
    },
    success: function(file,response){
        $(document).find('#front_licence').val(response.filename);
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
        })
    },
    success: function(file,response){
        $(document).find('#address_proof').val(response.filename);
    }
});
// (function ($) {
//     var oppenIppsAssessment = function () {
//         $(document).ready(function () {
//             c._initialize();
//         });
//     };
//     var c = oppenIppsAssessment.prototype;

//     c._initialize = function () {
//         c._listingView();
//     };

//     c._listingView = function () {
//         var field_coloumns = [
//             {
//                 "data": "date"
//             },
//             {
//                 "data": "email"
//             },
//             {
//                 "data": "amount"
//             },
//         ];
//         var order_coloumns = [[1, "desc"]];
//         oppenIpps._generateDataTable('user_earning_table', url, field_coloumns, order_coloumns);
//     };
//     window.oppenIppsAssessment = new oppenIppsAssessment();
// })(jQuery);

var field_coloumns = [
    {
        "data": "date"
    },
    {
        "data": "full_name"
    },
    {
        "data": "amount"
    },
];
if($('#user_earning_table').length > 0){
    var table = $('#user_earning_table').DataTable({
        stateSave:true,
        // responsive: true,
        "processing": true,
        "order": [[1, "desc"]],
        "oLanguage": {
            "sProcessing":  '<img src="'+base_url +'/public/images/loader.gif" width="40">',
            "sEmptyTable":"No Record Found",
        },
        "lengthMenu": [10, 25, 50, 75, 100 ],
        "serverSide": true,
        "bInfo": false,
        "autoWidth": false,
        "searching": true,
        "orderCellsTop": true,
        "columns": field_coloumns,
        "bPaginate":true,
            dom: 'trilp',
        buttons:[],
        initComplete: function () {
        },
        "ajax": {
            url: url,
            type: "get", // method  , by default get
            global: false,
            "error":function(){
                // window.location.reload();
            }
        },
        "columnDefs": [
            {"className": "text-right", "targets": 2},
            {"className": "text-center", "targets": 1}
        ],
    });
}