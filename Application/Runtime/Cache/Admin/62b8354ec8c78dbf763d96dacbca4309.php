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
        <button onclick="get_tpl_inside('/Admin/Menu/add_menu?action=add')">添加菜单</button>
    </div>
    <div class="main_content_table">
        <table class="menu_table">
            <tr>
                <th width="6%">菜单id</th>
                <th width="10%">菜单名称</th>
                <th width="6%">菜单级别</th>
                <th width="10%">父级菜单</th>
                <th width="6%">m</th>
                <th width="6%">c</th>
                <th width="10%">a</th>
                <th width="6%">修改者</th>
                <th width="9%">修改时间</th>
                <th width="19%">操作</th>
            </tr>
            <?php foreach($data as $value){?>
            <tr class="tr_menu_level_{$value.level}">
                <td><?php echo ($value["menuid"]); ?></td>
                <td><?php echo ($value["name"]); ?></td>
                <td><?php echo ($value["level"]); ?></td>
                <td><?php echo ($value["father_name"]); ?></td>
                <td><?php echo ($value["m"]); ?></td>
                <td><?php echo ($value["c"]); ?></td>
                <td><?php echo ($value["a"]); ?></td>
                <td><?php echo ($value["update_name"]); ?></td>
                <td>
                    <?php
 if(!empty($value['update_time'])){ echo date("Y-m-d",$value['update_time']); } ?>
                </td>
                <td>
                    <button onclick="get_tpl_inside('/Admin/Menu/add_menu?action=edit&menuid=<?php echo ($value["menuid"]); ?>')">修改</button>
                    <button onclick="get_tpl_inside('/Admin/Menu/delete?menuid=<?php echo ($value["menuid"]); ?>')">删除</button>
                    <?php if($value['level']!=3){ ?>
                    <button onclick="get_tpl_inside('/Admin/Menu/add_menu?action=addson&menuid=<?php echo ($value["menuid"]); ?>')">添加子菜单</button>
                    <?php } ?>>
                </td>
            </tr>
            <?php }?>
        </table>
    </div>
</div>
</body>
</html>