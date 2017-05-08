<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>饭卡系统管理中心 - <?php echo $_page_title?> </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Public/Admin/Styles/general.css" rel="stylesheet" type="text/css" />
<link href="/Public/Admin/Styles/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/Public/umeditor1_2_2-utf8-php/third-party/jquery.min.js"></script>
</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo $_page_btn_link;?>"><?php echo $_page_btn_name?></a>
    </span>
    <span class="action-span1"><a href="__GROUP__">饭卡系统管理中心</a></span>
    <span id="search_id" class="action-span1"> - <?php echo $_page_title?> </span>
    <div style="clear:both"></div>
</h1>

<!-- 内容 -->


<div class="form-div">
    <form action="/index.php/Admin/Index/lst" method="get" name="searchForm">
        <img id="img_icon" src="/Public/Admin/Images/icon_search.gif" width="26" height="22" border="0" alt="search" />
       用户名称： <input type="text" name="goods_name" size="10" value="<?php echo I('get.goods_name')?>" />
        <input type="submit" value=" 搜索 " class="button" />
        
		
    </form>
</div>

<!-- 商品列表 -->

    <div class="list-div" id="listDiv">
        <table cellpadding="3" cellspacing="1">
            <tr>
                <th>编号</th>
                <th>用户名称</th>
                <th>学号</th>
                <th>手机</th>
                <th>系名称</th>
                <th width="78">操作</th>
            </tr>
            <?php foreach($userInfo as $key=>$v){?>
            <tr class="tron">
                <td align="center"><?php echo $v['id']?></td>
                <td align="center" class="first-cell"><span><?php echo $v['sname']?></span></td>
                <td align="center"><span onclick=""><?php echo $v['sno']?></span></td>
                <td align="center"><span onclick=""><?php echo $v['snum']?></span></td>
                <td align="center"><span onclick=""><?php echo $v['dep']?></span></td>
                <td>
                
                <a href="delete?id=<?php echo $v['id']?>" onclick="return confirm('你确定要删除吗？');" title="回收站"><img id="img_trash" src="/Public/Admin/Images/icon_trash.gif" width="16" height="16" border="0" /></a></td>
            </tr>
            <?php }?>
        </table>

    <!-- 分页开始 -->
        <table id="page-table" cellspacing="0">
            <tr>
                <td width="80%">&nbsp;</td>
                <td align="center" nowrap="true">
                    <?php echo $data['page']; ?>
                </td>
            </tr>
        </table>
    <!-- 分页结束 -->
    </div>

<!-- 时间插件 -->
<script type="text/javascript" src="/Public/umeditor1_2_2-utf8-php/third-party/jquery.min.js"></script>
<link href="/Public/datetimepicker/jquery-ui-1.9.2.custom.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" charset="utf-8" src="/Public/datetimepicker/jquery-ui-1.9.2.custom.min.js"></script>
<script type="text/javascript" charset="utf-8" src="/Public/datetimepicker/datepicker-zh_cn.js"></script>
<link rel="stylesheet" media="all" type="text/css" href="/Public/datetimepicker/time/jquery-ui-timepicker-addon.min.css" />
<script type="text/javascript" src="/Public/datetimepicker/time/jquery-ui-timepicker-addon.min.js"></script>
<script type="text/javascript" src="/Public/datetimepicker/time/i18n/jquery-ui-timepicker-addon-i18n.min.js"></script>
<script>
$.timepicker.setDefaults($.timepicker.regional['zh-CN']);
$("#fa").datetimepicker();
$("#dao").datetimepicker();
</script>
<script type="text/javascript" src="/Public/Admin/js/tron.js">
</script>







<div id="footer">
共执行 9 个查询，用时 0.025161 秒，Gzip 已禁用，内存占用 3.258 MB<br />
版权所有 &copy; 2016-2017 广州市倾出于蓝科技有限公司，并保留所有权利。</div>
</body>
</html>