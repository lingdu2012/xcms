<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>登录页面</title>
    <meta name="description" content="">
    <meta name="keywords" content="index">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="icon" type="image/png" href="">
    <link rel="apple-touch-icon-precomposed" href="">
    <meta name="apple-mobile-web-app-title" content="" />
    <link rel="stylesheet" href="/admin/css/amazeui.min.css" />
    <link rel="stylesheet" href="/admin/css/amazeui.datatables.min.css" />
    <link rel="stylesheet" href="/admin/css/app.css">
    <script src="/admin/js/jquery.min.js"></script>

</head>

<body data-type="login" class="theme-white">
    <div class="am-g tpl-g">
        <div class="tpl-login">
            <div class="tpl-login-content">
                <div class="tpl-login-logo">

                </div>
                <form class="am-form tpl-form-line-form" method="post" action="">
                    {{ csrf_field() }}
                    @if(isset($error))
                    <div class="am-alert am-alert-danger" data-am-alert id="tip">
                        <button type="button" class="am-close">&times;</button>
                        用户或密码错误，请重新输入！
                    </div>
                    @endif
                    <div class="am-form-group">
                        <input id="user" type="text" class="tpl-form-input"  placeholder="请输入账号" name="userName">
                    </div>
                    <div class="am-form-group">
                        <input type="password" class="tpl-form-input"  placeholder="请输入密码" name="userPWD">
                    </div>
                    <div class="am-form-group">
                        <button type="submit" class="am-btn am-btn-primary  am-btn-block tpl-btn-bg-color-success  tpl-login-btn">登录系统</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="/admin/js/amazeui.min.js"></script>
    <script>
    $(function(){
        $("#user").focus(function(){
            if($("#tip").length>0){
                $("#tip").hide();
            }
        });
    });
    </script>
</body>

</html>