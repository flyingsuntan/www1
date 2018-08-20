<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>管理中心 - 商品列表 </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Public/Admin/Styles/general.css" rel="stylesheet" type="text/css" />
<link href="/Public/Admin/Styles/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/Public/umeditor1_2_2-utf8-php/third-party/jquery.min.js"></script>
</head>
<body>
<h1>
	<?php if($_page_btn_name): ?>
    <span class="action-span"><a href="<?php echo $_page_btn_link; ?>"><?php echo $_page_btn_name; ?></a></span>
    <?php endif; ?>
    <span class="action-span1"><a href="#">管理中心</a></span>
    <span id="search_id" class="action-span1"> - <?php echo $_page_title; ?> </span>
    <div style="clear:both"></div>
</h1>

<!--  内容  -->


<div class="tab-div">
    <div id="tabbar-div">
        <p>
            <span class="tab-front">通用信息</span>
            <span class="tab-back" >商品描述</span>
            <span class="tab-back" >会员价格</span>
            <span class="tab-back" >商品属性</span>
            <span class="tab-back" >商品相册</span>
        </p>
    </div>
    <div id="tabbody-div">
        <form enctype="multipart/form-data" action="/index.php/Admin/Goods/edit/id/32.html" method="post">
        	<input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
            <table width="90%" class="tab_table" align="center">
                <tr>
                    <td class="label">商品名称：</td>
                    <td><input type="text" name="goods_name" size="60" value="<?php echo $data['goods_name']; ?>" />
                    <span class="require-field">*</span></td>
                </tr>
                <tr>
                    <td class="label">商品品牌：</td>
                    <td>
                        <?php buildSelect('brand','brand_id','id','brand_name',$data['brand_id']);?>
                    </td>
                </tr>
                <tr>
                    <td class="label">商品主分类：</td>
                    <td>
                        <select name="cat_id">
                            <option value="">选择分类...</option>
                            <?php foreach($cats as $k => $v):?>
                            <option value="<?php echo $v['id']?>" <?php if($v['id'] == $data['cat_id']){echo 'selected = "selected"';} ?>><?php echo str_repeat("&nbsp;&nbsp;",$v['level']).$v['cat_name']; ?></option>
                            <?php endforeach;?>
                        </select><span class="require-field">*</span>
                    </td>
                </tr>
                <tr>
                    <td class="label">商品扩展分类：<input onclick="$('#cat_list').append($('#cat_list').find('select').eq(0).clone());" type="button" id="btn_add_cat" value="添加一个"></td>
                    <td id="cat_list">
                        <?php if($cat_id){?>
                        <?php foreach( $cat_id as $k1 => $v1):?>
                        <select name="ext_cat_id[]" id="cat_lists">
                            <option value="">选择分类...</option>
                            <?php foreach($cats as $k => $v):?>
                            <option value="<?php echo $v['id']?>" <?php if($v1['cat_id'] == $v['id']){echo 'selected = "selected"';} ?>><?php echo str_repeat("&nbsp;&nbsp;",$v['level']).$v['cat_name']; ?></option>
                            <?php endforeach;?>
                        </select>
                        <?php endforeach;?>
                        <?php }else { ?>
                        <select name="ext_cat_id[]" >
                            <option value="">选择分类...</option>
                            <?php foreach($cats as $k => $v):?>
                            <option value="<?php echo $v['id']?>" ><?php echo str_repeat("&nbsp;&nbsp;",$v['level']).$v['cat_name']; ?></option>
                            <?php endforeach;?>
                        </select>
                        <?php }?>
                    </td>
                </tr>
                <tr>
                    <td class="label">LOGO：</td>
                    <td>
                    <?php showImage($data['mid_logo']); ?><br />
                    <input type="file" name="logo" size="60" /></td>
                </tr>
                <tr>
                    <td class="label">市场售价：</td>
                    <td>
                        <input type="text" name="market_price" value="<?php echo $data['market_price']; ?>" size="20" />
                        <span class="require-field">*</span>
                    </td>
                </tr>
                <tr>
                    <td class="label">本店售价：</td>
                    <td>
                        <input type="text" name="shop_price" value="<?php echo $data['shop_price']; ?>" size="20"/>
                        <span class="require-field">*</span>
                    </td>
                </tr>
                <tr>
                    <td class="label">是否上架：</td>
                    <td>
                        <input type="radio" name="is_on_sale" value="yes" <?php if($data['is_on_sale'] == 'yes') echo 'checked="checked"'; ?> /> 是
                        <input type="radio" name="is_on_sale" value="yes" <?php if($data['is_on_sale'] == 'no') echo 'checked="checked"'; ?> /> 否
                    </td>
                </tr>
                <tr>
                    <td class="label">促销价格：</td>
                    <td>
                        价格：￥<input type="text" name="promote_price"  size="8" value="<?php echo $data['promote_price'];?>"/>
                        开始时间：<input type="text" id="start_time" name="promote_start_date"  value="<?php echo $data['promote_start_date'];?>" />
                        结束时间：<input type="text" id="end_time" name="promote_end_date"  value="<?php echo $data['promote_end_date'];?>" />
                    </td>
                </tr>
                <tr>
                    <td class="label">是否新品：</td>
                    <td>
                        <input type="radio" name="is_new" value="yes" <?php if($data['is_new'] == 'yes') echo 'checked="checked"'; ?>/> 是
                        <input type="radio" name="is_new" value="no"  <?php if($data['is_new'] == 'no') echo 'checked="checked"'; ?> /> 否
                    </td>
                </tr>
                <tr>
                    <td class="label">是否精品：</td>
                    <td>
                        <input type="radio" name="is_best" value="yes" <?php if($data['is_best'] == 'yes') echo 'checked="checked"'; ?> /> 是
                        <input type="radio" name="is_best" value="no"  <?php if($data['is_best'] == 'no') echo 'checked="checked"'; ?> /> 否
                    </td>
                </tr>
                <tr>
                    <td class="label">是否热卖：</td>
                    <td>
                        <input type="radio" name="is_hot" value="yes" <?php if($data['is_hot'] == 'yes') echo 'checked="checked"'; ?> /> 是
                        <input type="radio" name="is_hot" value="no" <?php if($data['is_hot'] == 'no') echo 'checked="checked"'; ?> /> 否
                    </td>
                </tr>
                <tr>
                    <td class="label">排序：</td>
                    <td>
                        <input type="text" name="sort_num" value="<?php echo $data['sort_num'];?>" size="8"/>

                    </td>
                </tr>
                <tr>
                    <td class="label">是否推荐楼层：</td>
                    <td>
                        <input type="radio" name="is_floor" value="yes" <?php if($data['is_floor'] == 'yes') echo 'checked="checked"'; ?> /> 是
                        <input type="radio" name="is_floor" value="no" <?php if($data['is_floor'] == 'no') echo 'checked="checked"'; ?> /> 否
                    </td>
                </tr>
            </table>
            <!--商品描述-->
            <table style="display: none" width="100%" class="tab_table"  align="center">

                <tr>
                    <td>
                        <textarea id="goods_desc" name="goods_desc"><?php echo $data['goods_desc']?></textarea>
                    </td>
                </tr>
            </table>
            <!--会员价格-->
            <table style="display: none" width="90%" class="tab_table"  align="center">

                <tr>
                    <td>
                        <?php foreach ($mlData as $k => $v): ?>
                        <p>
                            <strong><?php echo $v['level_name']; ?></strong> :
                            ￥<input value="<?php echo $mpData[$v['id']] ; ?>" type="text" name="member_price[<?php echo $v['id']; ?>]" size="8" />元
                        </p>
                        <?php endforeach; ?>
                    </td>
                </tr>
            </table>
            <!--商品属性-->
            <table style="display: none" width="90%" class="tab_table"  align="center">
            <tr>
                <td>商品类性：<?php buildSelect('type','type_id','id','type_name',$data['type_id']);?></td>
            </tr>
            <tr>
                <td><ul id="attr_list">
                    <!-- 循环所有原属性值 -->
                    <?php
 $attrId = array(); foreach ($gaData as $k => $v): if(in_array($v['attr_id'], $attrId)) $opt = '-'; else { $opt = '+'; $attrId[] = $v['attr_id']; } ?>
                    <li>
                        <input type="hidden" name="goods_attr_id[]" value="<?php echo $v['id']; ?>" />
                        <?php if($v['attr_type'] == '1'): ?>
                        <a onclick="addNewAttr(this);" href="#">[<?php echo $opt; ?>]</a>
                        <?php endif; ?>
                        <?php echo $v['attr_name']; ?> :
                        <?php if($v['attr_options_values']): $attr = explode(',', $v['attr_options_values']); ?>
                        <select name="attr_value[<?php echo $v['attr_id']; ?>][]">
                            <option value="">请选择</option>
                            <?php foreach ($attr as $k1 => $v1): if($v1 == $v['attr_value']) $select = 'selected="selected"'; else $select = ''; ?>
                            <option <?php echo $select; ?> value="<?php echo $v1; ?>"><?php echo $v1; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php else: ?>
                        <input type="text" name="attr_value[<?php echo $v['attr_id']; ?>][]" value="<?php echo $v['attr_value']; ?>" />
                        <?php endif; ?>
                    </li>
                    <?php endforeach; ?>
                </ul></td>
            </tr>
            </table>
            <!-- 商品相册 -->
            <table style="display:none;" width="100%" class="tab_table" align="center">
                <tr>
                    <td>
                        <input id="btn_add_pic" type="button" value="添加一张" />
                        <hr />
                        <ul id="ul_pic_list"></ul>

                        <ul id="old_pic_list">
                            <?php foreach ($gpData as $k => $v): ?>
                            <li>
                                <input pic_id="<?php echo $v['id']; ?>" class="btn_del_pic" type="button" value="删除" /><br />
                                <?php showImage($v['mid_pic'], 150); ?>
                            </li>
                            <?php endforeach; ?>
                        </ul>
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
/*******************切换的代码**********************/
$("#tabbar-div p span").click(function () {
    //点击的第几个按钮
    var i = $(this).index();
    //先隐藏所有的table
    $(".tab_table").hide();
    //显示第I个table
    $(".tab_table").eq(i).show();
    //隐藏其他四个
    //$(".tab_table").eq(i).siblings().hide();
    //先取消原按钮的选中状态
    $(".tab-front").removeClass("tab-front").addClass("tab-back");
    //设置当前按钮选中
    $(this).removeClass("tab-back").addClass("tab-front");



});
// 选择类型获取属性的AJAX
$("select[name=type_id]").change(function(){
    // 获取当前选中的类型的id
    var typeId = $(this).val();
    // 如果选择了一个类型就执行AJAX取属性
    if(typeId > 0)
    {
        // 根据类型ID执行AJAX取出这个类型下的属性，并获取返回的JSON数据
        $.ajax({
            type : "GET",
            url : "<?php echo U('ajaxGetAttr', '', FALSE); ?>/type_id/"+typeId,
            dataType : "json",
            success : function(data)
            {
                /** 把服务器返回的属性循环拼成一个LI字符串，并显示在页面中 **/
                var li = "";
                // 循环每个属性
                $(data).each(function(k,v){
                    li += '<li>';

                    // 如果这个属性类型是可选的就有一个+
                    if(v.attr_type == '1')
                        li += '<a onclick="addNewAttr(this);" href="#">[+]</a>';
                    // 属性名称
                    li += v.attr_name + ' : ';
                    // 如果属性有可选值就做下拉框，否则做文本框
                    if(v.attr_options_values == "")
                        li += '<input type="text" name="attr_value['+v.id+'][]" />';
                    else
                    {
                        li += '<select name="attr_value['+v.id+'][]"><option value="">请选择...</option>';
                        // 把可选值根据,转化成数组
                        var _attr = v.attr_options_values.split(',');
                        // 循环每个值制作option
                        for(var i=0; i<_attr.length; i++)
                        {
                            li += '<option value="'+_attr[i]+'">';
                            li += _attr[i];
                            li += '</option>';
                        }
                        li += '</select>';
                    }

                    li += '</li>'
                });
                // 把拼好的LI放到 页面中
                $("#attr_list").html(li);
            }
        });
    }
    else
        $("#attr_list").html("");  // 如果选的是请 选择就直接清空
});

// 点击属性的+号
function addNewAttr(a)
{
    // $(a)  --> 把a转换成jquery中的对象，然后才能调用jquery中的方法
    // 先获取所在的li
    var li = $(a).parent();
    if($(a).text() == '[+]')
    {
        var newLi = li.clone();
        //去掉选中状态
        newLi.find("option:selected").removeAttr("selected");
        //把克隆出来的隐藏域中的ID清空
        newLi.find("input[name='goods_attr_id[]']").val("");
        // +变-
        newLi.find("a").text('[-]');
        // 新的放在li后面
        li.after(newLi);
    }
    else {
        //先获取这个属性值的ID
        var gaid = li.find("input[name='goods_attr_id[]']").val();
        if(gaid == ''){
            li.remove();
        }else{
            if(confirm('如果删除了这个属性，那么相关的库存量数据也会被一起删除，确定要删除吗?')){
                $.ajax({
                    type:"GET",
                    url:"<?php echo U('ajaxDelAttr?goods_id='.$data['id'],'',FALSE);?>/gaid/"+gaid,
                    success:function (data) {
                        //在把页面中的记录删除
                        li.remove();
                    }
                });
            }
        }

    }
}
</script>
<!-- 引入时间插件 -->
<link href="/Public/datetimepicker/jquery-ui-1.9.2.custom.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" charset="utf-8" src="/Public/datetimepicker/jquery-ui-1.9.2.custom.min.js"></script>
<script type="text/javascript" charset="utf-8" src="/Public/datetimepicker/datepicker-zh_cn.js"></script>
<link rel="stylesheet" media="all" type="text/css" href="/Public/datetimepicker/time/jquery-ui-timepicker-addon.min.css" />
<script type="text/javascript" src="/Public/datetimepicker/time/jquery-ui-timepicker-addon.min.js"></script>
<script type="text/javascript" src="/Public/datetimepicker/time/i18n/jquery-ui-timepicker-addon-i18n.min.js"></script>
<script>
    // 添加时间插件
    $.timepicker.setDefaults($.timepicker.regional['zh-CN']);  // 设置使用中文

    $("#start_time").datetimepicker();
    $("#end_time").datetimepicker();
</script>
<script>
// 添加一张
$("#btn_add_pic").click(function(){
var file = '<li><input type="file" name="pic[]" /></li>';
$("#ul_pic_list").append(file);
});

// 删除图片
$(".btn_del_pic").click(function(){
    if(confirm('确定要删除吗？'))
    {
        // 先选中删除按钮所在的li标签
        var li = $(this).parent();
        // 从这个按钮上获取pic_id属性
        var pid = $(this).attr("pic_id");
        /**
        php中的大U函数三个参数：
        U('ajaxDelPic')                    ==>   /index.php/Admin/Goods/ajaxDelPic.html
        U('ajaxDelPic?id=1')                  ==>   /index.php/Admin/Goods/ajaxDelPic/id/1.html
        U('ajaxDelPic', array('id'=>1))      ==>   /index.php/Admin/Goods/ajaxDelPic/id/1.html
        U('ajaxDelPic', array('id'=>1), FALSE)      ==>   /index.php/Admin/Goods/ajaxDelPic/id/1
        **/
        $.ajax({
            type : "GET",
            url : "<?php echo U('ajaxDelPic', '', FALSE); ?>/picid/"+pid,
            success : function(data)
            {
            // 把图片从页面中删除掉
            li.remove();
            }
        });
    }
});
</script>






















<div id="footer"> @2018 39.com </div>
</body>
</html>