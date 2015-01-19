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
    function getRequest(element) {

        $('#form_Country', element).change(function (e) {
            var data = {request: $(this).val()};
            $.ajax({
                type: "POST",
                url: "ajax",
                data: data,
                success: function (data, dataType) {
                    $('#form_city_display', element).find('option').remove();
                    objectCity = JSON.parse(data);
                    for (var key in objectCity) {
                        $('#form_city_display', element).append('<option value=' + objectCity[key] + '>' + objectCity[key] + '</option>');
                        $('#form_city', element).val($('#form_city_display', element).val());
                    }
                }
            });
        });

        $('#form_city_display', element).change(function () {
            $('#form_city', element).val($(this).val());
        });


        var data = {request: $('#form_Country', element).val()};
        $.ajax({
            type: "POST",
            url: "ajax",
            data: data,
            success: function (data, dataType) {
                objectCity = JSON.parse(data);
                for (var key in objectCity) {
                    $('#form_city_display', element).append('<option value=' + objectCity[key] + '>' + objectCity[key] + '</option>');
                    $('#form_city', element).val($('#form_city_display', element).val());
                }
            }
        });
    }



    function checkEmail(str, element) {
        var bool;
        var pattern = /((\w*)\d*)*@(\w)*\.{1}(\w){1,4}/;
        if (pattern.test(str) == false) {
            $(element).text("введите правильно email");
            bool = false;
        }
        else {
            bool = true;
            $(element).text("");
        }
        return bool;
    }

    $("#manForm").submit(function(){
        var str = $("#form_email", "#manForm").val();
        var result = checkEmail(str, "#error");
        return result;
    });

    $("#womanForm").submit(function(){
        var str = $("#form_email", "#womanForm").val();
        var result = checkEmail(str, "#error");
        return result;
    });


});