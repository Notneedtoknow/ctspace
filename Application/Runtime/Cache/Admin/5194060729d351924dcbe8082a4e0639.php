<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?php echo CSS_PATH;?>/common.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH;?>/tableV1.css">
    <script type="text/javascript" src="<?php echo JS_PATH;?>/menu.js"></script>
</head>
<body>
<div class="main_content_html">
    <div class="main_content_title">
        修改密码
    </div>
    <div class="main_content_table">
        <form action="/Admin/Admin/change_pwd_submit" method="post">
            <table class="table_add_edit">
                <tr>
                    <td>管理员id：</td>
                    <td><?php echo ($id); ?></td>
                </tr>
                <tr>
                    <td>管理员英文名：</td>
                    <td><input type="text" name="info[admin_name]" value="<?php echo ($admin_name); ?>" ></td>
                </tr>
                <tr>
                    <td>管理员中文名：</td>
                    <td><input type="text" name="info[admin_cname]" value="<?php echo ($admin_cname); ?>" ></td>
                </tr>
                <tr>
                    <td>级别：</td>
                    <td><?php echo ($admin_level[$level]); ?></td>
                </tr>
                <tr>
                    <td>部门：</td>
                    <td><?php echo ($deptment); ?></td>
                </tr>
                <tr>
                    <td>邀请人姓名：</td>
                    <td><?php echo ($invite_cname); ?></td>
                </tr>
                <tr>
                    <td>最后一次登录时间：</td>
                    <td><?php echo (date('Y-m-d H:i:s',$login_time)); ?></td>
                </tr>
                <tr>
                    <td>最后一次登录ip：</td>
                    <td><?php echo ($login_ip); ?></td>
                </tr>
                <tr>
                    <td>重置密码：</td>
                    <td><input type="password" name="info[password]" ></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" /></td>
                </tr>
            </table>
        </form>
    </div>
</div>
</body>
</html>