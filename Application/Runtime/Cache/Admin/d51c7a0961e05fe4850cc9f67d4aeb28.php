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


<div class="tab-div">
   
    <div id="tabbody-div">
        <form enctype="multipart/form-data" action="/index.php/Admin/Index/edit?id=4" method="post">
            
            <!-- 商品描述 -->
            <table width="80%" id="describe-tab-tb" align="center" style="">
            	<tr>
                    <td>
                        <textarea id="goods_desc" name="content"><?=$newsInfo['content']?></textarea>
                        <input type="hidden" name="id" value="<?=$newsInfo['id']?>">
                    </td>
                </tr>
            </table>
            
            
            <div class="button-div">
                <input type="submit" value=" 确定 " class="button"/>
                <input type="reset" value=" 重置 " class="button" />
            </div>
        </form>
    </div>
</div>


    
    <!--导入在线编辑器 -->
<link href="/Public/umeditor1_2_2-utf8-php/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
<script type="text/javascript" charset="utf-8" src="/Public/umeditor1_2_2-utf8-php/umeditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/Public/umeditor1_2_2-utf8-php/umeditor.min.js"></script>
<script type="text/javascript" src="/Public/umeditor1_2_2-utf8-php/lang/zh-cn/zh-cn.js"></script>
<script>
UM.getEditor('goods_desc', {
	initialFrameWidth : "100%",
	initialFrameHeight : 350
});
</script>
    <!-- 实现点击添加扩展分类的效果 -->
    <script>
    	$('#cat_btn').click(function(){
    		//获取span
    		$('#cat_td').append($('#clone_cat').clone());
    		$('#cat_td').append('</br>');
    	});
    </script>
    <!-- 实现标签栏点击效果 -->
    <script>
    	$("#tabbar-div p span").click(function(){
    		//全部变标签变暗
    		$("#tabbar-div p span").attr('class','tab-back');
    		//当前的标签高亮显示
    		$(this).attr('class','tab-front');
    		//全部table隐藏
    		$('table').hide();
    		//当前的table显示
    		var id = $(this).attr('id');
    		$("#"+id+"-tb").show();
    	});
    </script>
    
    <!-- 实现点击属性下拉框效果 -->
    <script>
    	$("select[name='type_id']").change(function(){
    		//获取选中的value值，即type_id的值
    		var typeId = $(this).val();
    		//利用ajax根据该type_id的值找出对应的商品属性
    		if(typeId>0){
    			$.ajax({
        			type 		:	'get',
        			url 		:	"<?php echo U('ajaxGetAttr','',false)?>/type_id/"+typeId,
        			dataType 	:	'json',
        			success 	:	function(data){
        				var table = "";
        				//拼装html语句table
        				table += "<table width='100%' id='attrTable'>";
        				//循环data
        				$(data).each(function(k,v){
        					table += "<tr>";
        					table += "<td>"+v.attr_name+"：</td>";
        					table += "<td>";
        					if(v.attr_input_type == 0){
        						//这里拼装的是文本框
        						table += "<input name='attr_value["+v.attr_id+"][]' type='text' size='15'>";
        					}else if(v.attr_type == 0 && v.attr_input_type == 1 && v.attr_value !=''){
        						//这里拼装的是下拉列表
        						table += "<select name='attr_value["+v.attr_id+"][]'>";
        						table += "<option value=''>请选择...</option>";
        						var _attr_value = v.attr_value.split('\r\n');
        						for(var i=0;i<_attr_value.length;i++){
        							table += "<option value='"+_attr_value[i]+"'>"+_attr_value[i]+"</option>";
        						}
        						table += "</select>";
        					}else if(v.attr_type == 1 && v.attr_input_type == 1 && v.attr_value !=''){
        						//这里拼装的是多选框
        						var _attr_value = v.attr_value.split('\r\n');
        						for(var i=0;i<_attr_value.length;i++){
        							table += _attr_value[i]+"<input type='checkbox' name='attr_value["+v.attr_id+"][]' value='"+_attr_value[i]+"'>";
        						}
        					}
        					table += "</td>";
        					table += "</tr>";
        				});
        				table += "</table>";
        				$('#tbody-goodsAttr').html(table);
        			}
        			
        		});
    			
    		}
    		else{
				$('#tbody-goodsAttr').html('');
			}
    	});
    </script>
    <!-- 相册的js代码 -->
     <script type="text/javascript">
                $(function(){
                	new uploadPreview({ UpBtn: "goods_logo", DivShow: "goods_logo_dv", ImgShow: "goods_logo_im" });
                	new uploadPreview({ UpBtn: "goods_pics_0", DivShow: "goods_pics_dv_0", ImgShow: "goods_pics_im_0" });
                });
    </script>
    <script type="text/javascript" src="/Public/Admin/Js/uploadPreview.js"></script>
    <script type="text/javascript">
                var p_num = 1;  //相册计数器
                function add_item(){
                    //增加相册的项目
                    var s = "<tr><td><span style='cursor:pointer;' onclick='$(this).parent().parent().remove()'>[-]</span>商品相册</td><td><input type='file' name='goods_pics[]' id='goods_pics_"+p_num+"'/><div id='goods_pics_dv_"+p_num+"'><img src='' alt='' width='160' height='160' id='goods_pics_im_"+p_num+"'/></div></td></tr>";
                    $('#gallery-tab-tb').append(s);

                    //设置立即显示上传好的图片效果
                    new uploadPreview({ UpBtn: "goods_pics_"+p_num, DivShow: "goods_pics_dv_"+p_num, ImgShow: "goods_pics_im_"+p_num });

                    p_num++;  //每增加一个相册，计数器的值要累加
                }
    </script>
    
    <!-- 时间插件 -->
<link href="/Public/datetimepicker/jquery-ui-1.9.2.custom.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" charset="utf-8" src="/Public/datetimepicker/jquery-ui-1.9.2.custom.min.js"></script>
<script type="text/javascript" charset="utf-8" src="/Public/datetimepicker/datepicker-zh_cn.js"></script>
<link rel="stylesheet" media="all" type="text/css" href="/Public/datetimepicker/time/jquery-ui-timepicker-addon.min.css" />
<script type="text/javascript" src="/Public/datetimepicker/time/jquery-ui-timepicker-addon.min.js"></script>
<script type="text/javascript" src="/Public/datetimepicker/time/i18n/jquery-ui-timepicker-addon-i18n.min.js"></script>
<script>
$.timepicker.setDefaults($.timepicker.regional['zh-CN']);
$("#promote_start_date").datetimepicker();
$("#promote_end_date").datetimepicker();
</script>

<div id="footer">
共执行 9 个查询，用时 0.025161 秒，Gzip 已禁用，内存占用 3.258 MB<br />
版权所有 &copy; 2016-2017 广州市倾出于蓝科技有限公司，并保留所有权利。</div>
</body>
</html>