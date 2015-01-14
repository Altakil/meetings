$(document).ready(function () {
    $("#womanForm").fadeOut(1);
    $('#form_gender').val('man');
    $("input[name='gender']").change(function (e) {
        var currentValue = e.target.value;
        if (currentValue == "woman") {
            $("#manForm").fadeOut(700);
            $("#womanForm").delay(700).fadeIn(700);
            $('#form_gender', '#womanForm ').val('woman');
        }
        else if (currentValue == "man") {
            $("#womanForm").fadeOut(700);
            $("#manForm").delay(700).fadeIn(700);
            $('#form_gender').val('man');
        }
    });
});