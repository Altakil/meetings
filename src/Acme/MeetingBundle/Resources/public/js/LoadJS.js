$(document).ready(function () {
    $("#send").fadeOut(1);

    $("#form_file").change(function(){
        $("#formLoadImage").submit();
    });
});