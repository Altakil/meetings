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

    var objectCity;

    getRequest("#manForm");
    getRequest("#womanForm");
    function getRequest(element){

        $('#form_Country', element).change(function (e) {

            var data = {request: $(this).val()};
            $.ajax({
                type: "POST",
                url: "ajax",
                data: data,
                success: function (data, dataType) {
                    $('#form_city', element).find('option').remove();
                    objectCity = JSON.parse(data);
                    for(var key in objectCity){
                        $('#form_city', element).append('<option value="4">' + objectCity[key] + '</option>');
                    }
                }
            });
        });


        var data = {request: $('#form_Country', element).val()};
        $.ajax({
            type: "POST",
            url: "ajax",
            data: data,
            success: function (data, dataType) {
                objectCity = JSON.parse(data);
                for(var key in objectCity){
                    $('#form_city', element).append('<option value="4">' + objectCity[key] + '</option>');
                }
            }
        });
    }

});