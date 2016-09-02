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
        <?php if($action=='add'){ ?>添加<?php }else{ ?>修改<?php } ?>管理员
    </div>
    <div class="main_content_table">
        <form action="/Admin/Admin/add_admin_submit" method="post">
            <table class="table_add_edit">
                <input type="hidden" name="action" value="<?php echo ($action); ?>">
                <input type="hidden" name="id" value="<?php echo ($id); ?>">
                <?php if($action=='edit'){ ?>
                <tr>
                    <td>管理员id：</td>
                    <td><?php echo ($id); ?></td>
                </tr>
                <?php } ?>
                <tr>
                    <td>管理员英文名：</td>
                    <?php if($action == 'edit'){ ?>
                    <td><?php echo ($admin_name); ?></td>
                    <?php }else{ ?>
                    <td><input type="text" name="info[admin_name]" value="" ></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td>管理员中文名：</td>
                    <td><input type="text" name="info[admin_cname]" value="<?php echo ($admin_cname); ?>" ></td>
                </tr>
                <tr>
                    <td>级别：</td>
                    <?php if($action == 'edit'){ ?>
                    <td><?php echo ($admin_level[$level]); ?></td>
                    <?php }else{ ?>
                    <td><?php echo ($select_level); ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td>部门：</td>
                    <td><input type="text" name="info[deptment]" value="<?php echo ($deptment); ?>" ></td>
                </tr>
                <tr>
                    <td>密码：</td>
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