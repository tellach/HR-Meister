$(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
    /*
    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('yyyy/mm/dd', {'placeholder': 'yyyy/mm/dd'})
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('yyyy/mm/dd', {'placeholder': 'yyyy/mm/dd'})
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        format: 'MM/DD/YYYY h:mm A'
    })*/


    //Date picker
    $('#datepicker').datepicker({
        autoclose: true
    })
    $('#datepicker2').datepicker({
        autoclose: true
    })
    //iCheck for checkbox and radio inputs
    /*$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
        checkboxClass: 'icheckbox_minimal-red',
        radioClass: 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
        showInputs: false
    })

    //Custom datepickers
*/
})