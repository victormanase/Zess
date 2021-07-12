$(function () {
    'use strict';

    if ($('#datePickerExample').length) {
        var date = new Date();
        var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
        var val = $('#datePickerExample>input').val();
        var date = null;
        if (val) {
            date = new Date(val)
        }
        $('#datePickerExample').datepicker({
            format: "mm/dd/yyyy",
            todayHighlight: true,
            autoclose: true
        });
        $('#datePickerExample').datepicker('setDate', date ? date : today);
    }
});
