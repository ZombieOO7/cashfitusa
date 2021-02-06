// SEND BULK EMAILS
var checkArray = [];
$(document).on('change', '.checkAll', function() {
    $('.checkAll').each(function(ind, item) {
        var email = $(this).attr('data-email');
        if($(this).is(':checked')) {
            if($.inArray(email, checkArray) == -1)
                checkArray.push(email);
        } else {
            if($.inArray(email, checkArray) !== -1)
                checkArray.splice(checkArray.indexOf(email),1);
        }
    });
});

$(document).on('click', '#bulk_mail_btn', function() {
    if(checkArray.length == 0)
	{
		swal('Info','Please select atleast one email', 'info');
	}
	else
	{
		var to = checkArray[0];
		window.location.href='mailto:?bcc='+checkArray.toString()+'';
	}
});
/////
function CheckUncheckAll(chkAll) {
    //Fetch all rows of the Table.
    var rows = document.getElementById("contact_us_table").rows;

    //Execute loop on all rows excluding the Header row.
    for (var i = 1; i < rows.length; i++) {
        rows[i].getElementsByTagName("INPUT")[0].checked = chkAll.checked;
        var email = rows[i].getElementsByTagName("INPUT")[0].getAttribute('data-email');
        if(rows[i].getElementsByTagName("INPUT")[0].checked == true) {
            if($.inArray(email, checkArray) == -1)
                checkArray.push(email);
        }
    }
    if(chkAll.checked == false) {
        checkArray.length = 0;
    }
};
function CheckUncheckHeader() {
    //Determine the reference CheckBox in Header row.
    var chkAll = document.getElementById("contact_us_checkbox");

    //By default set to Checked.
    chkAll.checked = true;

    //Fetch all rows of the Table.
    var rows = document.getElementById("contact_us_table").rows;

    //Execute loop on all rows excluding the Header row.
    for (var i = 1; i < rows.length; i++) {
        if (!rows[i].getElementsByTagName("INPUT")[0].checked) {
            chkAll.checked = false;
            break;
        }
    }
};


// This function is used to initialize the data table.
(function ($) {
    var oppenIppsAssessment = function () {
        $(document).ready(function () {
            c._initialize();
        });
    };
    var c = oppenIppsAssessment.prototype;

    c._initialize = function () {
        c._listingView();
    };

    c._listingView = function () {
        var field_coloumns = [
            { "data": "checkbox", orderable: false, searchable: false },
            // { "data": "id" },
            { "data": "full_name" },
            {"data":"email"},
            // { "data": "subject"},
             { "data": "message" },
             { "data": "created_at" },
            { "data": "action", orderable: false, searchable: false },
        ];
        var order_coloumns = [[4, "desc"]];
        oppenIpps._generateDataTable('contact_us_table', contact_us_list_url, field_coloumns, order_coloumns);
    };
    window.oppenIppsAssessment = new oppenIppsAssessment();
})(jQuery);