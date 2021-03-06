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
        <?php if($action=='add'){ ?>添加<?php }else{ ?>修改<?php } ?>广告位置
    </div>
    <div class="main_content_table">
        <form action="/Extra/Index/add_poster_place_submit" method="post">
            <table class="table_add_edit">
                <input type="hidden" name="action" value="<?php echo ($action); ?>">
                <input type="hidden" name="id" value="<?php echo ($id); ?>">
                <?php if($action=='edit'){ ?>
                <tr>
                    <td>广告位置id：</td>
                    <td><?php echo ($id); ?></td>
                </tr>
                <?php } ?>
                <tr>
                    <td>广告位置英文名：</td>
                    <?php if($action == 'edit'){ ?>
                    <td><?php echo ($name); ?></td>
                    <?php }else{ ?>
                    <td><input type="text" name="info[name]" value="" ></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td>广告位置中文名：</td>
                    <td><input type="text" name="info[cname]" value="<?php echo ($cname); ?>" ></td>
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