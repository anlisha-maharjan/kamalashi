(function () {
    'use strict';
var startDate = new Date();
    $('#start_date').datepicker({
            format: 'yyyy-mm-dd',
            startDate:"2016/02/10" ,
            autoclose: true
        })
        .on('changeDate', function(selected){
            var startDate = new Date(selected.date.valueOf());
            $('#end_date').datepicker('setStartDate', startDate);
        });
    $('#end_date').datepicker({
            format: 'yyyy-mm-dd',
            startDate: startDate,
            autoclose: true
        })
        .on('changeDate', function(selected){
            var endDate = new Date(selected.date.valueOf());
            $('#start_date').datepicker('setEndDate', endDate);
        });
    $('#publish_date').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    });
})();
