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
        <button style="width: auto" onclick="get_tpl_inside('/Extra/Index/add_poster_place?action=add')">添加广告位置</button>
    </div>
    <div class="main_content_table">
        <table class="menu_table">
            <tr>
                <th width="10%">广告位置id</th>
                <th width="25%">广告位置英文名</th>
                <th width="25%">广告位置中文名</th>
                <th width="10%">是否显示</th>
                <th width="30%">操作</th>
            </tr>
            <?php foreach($poster_place as $value){ ?>
            <tr>
                <td><?php echo ($value["id"]); ?></td>
                <td><?php echo ($value["name"]); ?></td>
                <td><?php echo ($value["cname"]); ?></td>
                <td><?php echo ($value["is_show"]); ?></td>
                <td>
                    <button onclick="get_tpl_inside('/Extra/Index/add_poster_place?action=edit&id=<?php echo ($value["id"]); ?>')">修改</button>
                    <button onclick="get_tpl_inside('/Extra/Index/delete_poster_place?id=<?php echo ($value["id"]); ?>')">删除</button>
                    <button onclick="get_tpl_inside('/Extra/Index/poster?id=<?php echo ($value["id"]); ?>')">查看广告</button>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</div>
</body>
</html>