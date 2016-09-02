<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?php echo CSS_PATH;?>/common.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH;?>/tableV1.css">
    <script type="text/javascript" src="<?php echo JS_PATH;?>/menu.js"></script>
</head>
<body onload="level_on_load(<?php echo ($data["level"]); ?>)">
<div class="main_content_html">
    <div class="main_content_title">
        <?php if($action=='edit'){?>修改<?php }else{?>添加<?php }?>菜单
    </div>
    <div class="main_content_table">
        <form action="/Admin/Menu/add_menu_submit?action=<?php echo ($action); ?>" method="post">
            <input name="menuid" type="hidden" value="<?php echo ($data["menuid"]); ?>">
        <table class="table_add_edit">
            <tr>
                <td>父级菜单：</td>
                <div class="menu_select">
                <td><?php echo ($select_menu); ?></td>
                </div>
            </tr>
            <tr>
                <td>菜单名称：</td>
                <td><input name="info[name]" type="text" value="<?php echo ($data["name"]); ?>"></td>
            </tr>
            <tr>
                <td>菜单级别：</td>
                <div class="menu_select">
                <td id="on_load"><?php echo ($select_level); ?></td>
                </div>
            </tr>
            <tr>
                <td>m：</td>
                <td><input type="text" name="info[m]" value="<?php echo ($data["m"]); ?>"></td>
            </tr>
            <tr id="menu_c">
                <td>c：</td>
                <td><input type="text" name="info[c]" value="<?php echo ($data["c"]); ?>"></td>
            </tr>
            <tr id="menu_a">
                <td>a：</td>
                <td><input type="text" name="info[a]" value="<?php echo ($data["a"]); ?>"></td>
            </tr>
            <tr>
                <td>排序：</td>
                <td><input type="text" name="info[sort]" value="<?php echo ($data["sort"]); ?>"></td>
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