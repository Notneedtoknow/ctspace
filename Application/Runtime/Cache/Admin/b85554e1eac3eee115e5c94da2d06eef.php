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
        <button style="width: auto" onclick="get_tpl_inside('/Admin/Admin/add_admin?action=add')">添加管理员</button>
    </div>
    <div class="main_content_table">
        <table class="menu_table">
            <tr>
                <th width="8%">管理员id</th>
                <th width="13%">管理员英文名</th>
                <th width="13%">管理员中文名</th>
                <th width="8%">级别</th>
                <th width="8%">部门</th>
                <th width="18%">最后一次登录时间</th>
                <th width="11%">最后一次登录ip</th>
                <th width="6%">状态</th>
                <th width="15%">操作</th>
            </tr>
            <?php foreach($admin_lists as $value){ ?>
            <tr>
                <td><?php echo ($value["id"]); ?></td>
                <td><?php echo ($value["admin_name"]); ?></td>
                <td><?php echo ($value["admin_cname"]); ?></td>
                <td><?php echo ($admin_level[$value['level']]); ?></td>
                <td><?php echo ($value["deptment"]); ?></td>
                <?php if(!empty($value['login_time'])){ ?>
                <td><?php echo (date('Y-m-d H:i:s',$value["login_time"])); ?></td>
                <?php }else{ ?>
                <td></td>
                <?php } ?>
                <td><?php echo ($value["login_ip"]); ?></td>
                <td><?php if($value['trash']==0){echo "可用";}else{echo "不可用";} ?></td>
                <td>
                    <button onclick="get_tpl_inside('/Admin/Admin/add_admin?action=edit&id=<?php echo ($value["id"]); ?>')">修改</button>
                    <?php if($value['trash']==0){ ?>
                    <button onclick="get_tpl_inside('/Admin/Admin/delete?id=<?php echo ($value["id"]); ?>')">删除</button>
                    <?php }else{ ?>
                    <button onclick="get_tpl_inside('/Admin/Admin/cancel_delete?id=<?php echo ($value["id"]); ?>')">恢复</button>
                    <?php } ?>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</div>
</body>
</html>