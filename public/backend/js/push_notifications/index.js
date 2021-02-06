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
            { "data": "title" },
            { "data": "slug" },
            { "data": "body" },
            { "data": "created_at" },
            { "data": "action", orderable: false, searchable: false },
        ];
        var order_coloumns = [[3, "desc"]];
        oppenIpps._generateDataTable('push_notification_table', push_notification_list_url, field_coloumns, order_coloumns);
    };
    window.oppenIppsAssessment = new oppenIppsAssessment();
})(jQuery);

/** Show description modal */
$(document).on('click','.shw-dsc',function(e) {
    $(document).find('.show_desc').html($(this).attr('data-description'));
});