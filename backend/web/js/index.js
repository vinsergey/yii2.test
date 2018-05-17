$(document).ready(function () {
    // alert("Hello world");

    $(".send").click(function () {
        $.ajax({
            url:"http://localhost/yii-application/backend/web/index.php?r=post/test",
            method:"GET",
            success:function (data) {
                console.log(data);
            }
        });
    });
});