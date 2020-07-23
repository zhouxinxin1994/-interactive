

window.onload = function () {

        window.islog = false;
   
    //  判断是否登陆
    $.ajax({
        url: 'php/session.php',
        type: "get",
        dataType: "json",
        success: function (data) {
            console.log(data);

            if (data.code) {
                $('#usericon').html(`你好，${data.user_name}`);
                islog = true;
            } else {
                islog = false;
            }
        },
        error: function (error) {
            console.log(error)
        }
    })

    //  登出请求
    $('#logout').click(function () {
        $.ajax({
            url: `php/login.php`,
            dataType: 'json',
            data: { 'act': 'logout' },
            type: 'post',
            success: function (data) {
                if (data.msg) {
                    swal("成功退出", {
                        icon: "success",
                        buttons: false,
                        timer: 2000
                    }).then((value) => {
                        window.location.href = "index.html";
                    })
                }

            },
            error: function (err) {
                window.console.log(err)
            }
        })
    })



}