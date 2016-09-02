<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?php echo CSS_PATH;?>/common.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH;?>/tableV1.css">
    <script type="text/javascript" src="<?php echo JS_PATH;?>/menu.js"></script>
    <script type="text/javascript" src="<?php echo JS_PATH;?>/showdate.js"></script>
</head>
<body>
<div class="main_content_html">
    <div class="main_content_title">
        <?php if($action=='add'){ ?>添加<?php }else{ ?>修改<?php } ?>广告
    </div>
    <div class="main_content_table">
        <form action="/Extra/Index/add_poster_submit" method="post">
            <table class="table_add_edit">
                <input type="hidden" name="action" value="<?php echo ($action); ?>">
                <input type="hidden" name="id" value="<?php echo ($id); ?>">
                <?php if($action=='edit'){ ?>
                <tr>
                    <td>广告id：</td>
                    <td><?php echo ($id); ?></td>
                </tr>
                <?php } ?>
                <tr>
                    <td>广告名称：</td>
                    <td><input type="text" name="info[name]" value="<?php echo ($name); ?>" ></td>
                </tr>
                <tr>
                    <td>广告类型：</td>
                    <td><?php echo ($type); ?></td>
                </tr>
                <tr>
                    <td>广告投放开始时间：</td>
                    <td><input type="text" id="st" name="info[start_time]" onclick="return Calendar('st');" value=""/></td>
                </tr>
                <tr>
                    <td>广告投放结束时间：</td>
                    <td><input type="text" id="et" name="info[end_time]" onclick="return Calendar('et');" value=""/></td>
                </tr>
                <tr>
                    <td>是否显示：</td>
                    <td><?php echo ($is_show); ?></td>
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