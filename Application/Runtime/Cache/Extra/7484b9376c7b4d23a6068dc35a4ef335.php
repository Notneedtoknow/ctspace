<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?php echo CSS_PATH;?>/common.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH;?>/tableV1.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH;?>/date/dateV2.css">
    <script type="text/javascript" src="<?php echo JS_PATH;?>/jquery-3.0.0/jquery-3.0.0.js"></script>
    <script type="text/javascript" src="<?php echo JS_PATH;?>/menu.js"></script>
    <script type="text/javascript" src="<?php echo JS_PATH;?>/date/dateV2.js"></script>
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
                    <td>
                        <div class="date_select">
                            <input type="text" name="info[start_time]" value="<?php echo ($start_time); ?>" hidden>
                            <ul class="date">
                                <li class="data date_year">2016</li>
                                <li class="middle">-</li>
                                <li class="data date_month">8</li>
                                <li class="middle">-</li>
                                <li class="data date_day">30</li>
                                <li class="middle"></li>
                                <li class="data date_hour">15</li>
                                <li class="middle">:</li>
                                <li class="data date_minute">56</li>
                                <li class="middle">:</li>
                                <li class="data date_second">59</li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>广告投放结束时间：</td>
                    <td><input type="text" class="date" data-default="1472799999" name="info[start_time]" value="" readonly/></td>
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