<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style type="text/css">
        html,body{
            width: 100%;
            height: 100%;
        }
        body{
            margin: 0px auto;
            padding:0px auto;
            background-image: url("<?php echo IMAGE_PATH;?>/background/loginV2.jpg");
            -moz-background-size:100% 100%; /* 老版本的 Firefox */
            background-size:100% 100%;
            background-repeat:no-repeat;
            background-position: center;
        }
        .login_box{
            background-color: white;
            filter: alpha(opacity=75);
            -moz-opacity: 0.75;
            opacity: 0.75;
            width: 700px;
            height: 540px;
            margin: auto;
            position: absolute;
            top: 0; left: 0; bottom: 80px; right: 0;
            border-radius: 25px;
        }
        .login_box_image{
            background-image: url("<?php echo IMAGE_PATH;?>/background/loginV2.jpg");
            -moz-background-size:100% 100%; /* 老版本的 Firefox */
            background-size:100% 100%;
            background-repeat:no-repeat;
            background-position: center;
            width: 100%;
            height: 90%;
            border-radius: 25px 25px 0 0;
        }
        .login_box_font{
            margin: 0 auto;
            width: 100%;
            height: 10%;
            text-align: center;
            line-height: 50px;
        }
        img{
            width: 100px;
            height: 30px;
            vertical-align: middle;
        }
    </style>
    <title>CT-space</title
</head>
<body>
<div class="login_box">
    <div class="login_box_image"></div>
    <div class="login_box_font">
        <form method="post" action="/Admin/Index/ajax_check_login">
            <b>账号：</b>
            <input type="text" name="info[name]" size="10">
            <b>密码：</b>
            <input type="password" name="info[password]" size="10">
            <b>验证码</b>
            <input type="text" name="info[code]" size="6" autofocus="autofocus" />
            <img id="verify_img" alt="验证码" src="<?php echo U('Admin/Index/verify_c',array());?>" title="点击刷新" onclick='this.src=this.src+"?c="+Math.random()'>
            <input type="submit" value="登陆">
        </form>
    </div>
</div>
</body>
</html>