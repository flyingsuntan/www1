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

<style>
    #ul-pic_list li{margin:5px;list-style-type:none;}
    #cat_lists li{margin:#EEE }
    #cat_lists li{background:1px }
</style>

<div class="tab-div">
    <div id="tabbar-div">
        <p>
            <span class="tab-front" >通用信息</span>
            <span class="tab-back" >商品描述</span>
            <span class="tab-back" >会员价格</span>
            <span class="tab-back" >商品属性</span>
            <span class="tab-back" >商品相册</span>
        </p>
    </div>
    <div id="tabbody-div">
        <form enctype="multipart/form-data" action="/index.php/Admin/Goods/add.html" method="post">
            <!-- 基本信息 -->
            <table width="90%" class="tab_table"  align="center">
                <tr>
                    <td class="label">商品品牌：</td>
                    <td>
                        <?php buildSelect('brand','brand_id','id','brand_name');?>
                    </td>
                </tr>
                <tr>
                    <td class="label">商品主分类：</td>
                    <td>
                        <select name="cat_id">
                            <option value="">选择分类...</option>
                            <?php foreach($cats as $k => $v):?>
                            <option value="<?php echo $v['id']?>"><?php echo str_repeat("&nbsp;&nbsp;",$v['level']).$v['cat_name']; ?></option>
                            <?php endforeach;?>
                        </select><span class="require-field">*</span>
                    </td>
                </tr>
                <tr>
                    <td class="label">商品扩展分类：<input onclick="$('#cat_list').append($('#cat_list').find('select').eq(0).clone());" type="button" id="btn_add_cat" value="添加一个"></td>
                    <td id="cat_list">
                        <select name="ext_cat_id[]" id="cat_lists">
                            <option value="">选择分类...</option>
                            <?php foreach($cats as $k => $v):?>
                            <option value="<?php echo $v['id']?>"><?php echo str_repeat("&nbsp;&nbsp;",$v['level']).$v['cat_name']; ?></option>
                            <?php endforeach;?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="label">商品名称：</td>
                    <td><input type="text" name="goods_name" size="60" />
                    <span class="require-field">*</span></td>
                </tr>
                <tr>
                    <td class="label">LOGO：</td>
                    <td><input type="file" name="logo" size="60" /></td>
                </tr>
                <tr>
                    <td class="label">市场售价：</td>
                    <td>
                        <input type="text" name="market_price" value="0" size="20" />
                        <span class="require-field">*</span>
                    </td>
                </tr>
                <tr>
                    <td class="label">本店售价：</td>
                    <td>
                        <input type="text" name="shop_price" value="0" size="20"/>
                        <span class="require-field">*</span>
                    </td>
                </tr>

                <tr>
                    <td class="label">是否上架：</td>
                    <td>
                        <input type="radio" name="is_on_sale" value="yes" checked="checked" /> 是
                        <input type="radio" name="is_on_sale" value="no" /> 否
                    </td>
                </tr>
                <tr>
                    <td class="label">促销价格：</td>
                    <td>
                        价格：￥<input type="text" name="promote_price"  size="8" />
                        开始时间：<input type="text" id="start_time" name="promote_start_date"   />
                        结束时间：<input type="text" id="end_time" name="promote_end_date"   />
                    </td>
                </tr>
                <tr>
                    <td class="label">是否新品：</td>
                    <td>
                        <input type="radio" name="is_new" value="yes" /> 是
                        <input type="radio" name="is_new" value="no"  checked="checked" /> 否
                    </td>
                </tr>
                <tr>
                    <td class="label">是否精品：</td>
                    <td>
                        <input type="radio" name="is_best" value="yes"  /> 是
                        <input type="radio" name="is_best" value="no"  checked="checked" /> 否
                    </td>
                </tr>
                <tr>
                    <td class="label">是否热卖：</td>
                    <td>
                        <input type="radio" name="is_hot" value="yes"  /> 是
                        <input type="radio" name="is_hot" value="no" checked="checked" /> 否
                    </td>
                </tr>
                <tr>
                    <td class="label">排序：</td>
                    <td>
                        <input type="text" name="sort_num" value="100" size="8"/>

                    </td>
                </tr>
                <tr>
                    <td class="label">是否推荐楼层：</td>
                    <td>
                        <input type="radio" name="is_floor" value="yes"  /> 是
                        <input type="radio" name="is_floor" value="no" checked="checked" /> 否
                    </td>
                </tr>

            </table>
            <!--商品描述-->
            <table style="display: none" width="100%" class="tab_table"  align="center">

                <tr>
                    <td>
                        <textarea id="goods_desc" name="goods_desc"></textarea>
                    </td>
                </tr>
            </table>
            <!--会员价格-->
            <table style="display: none" width="90%" class="tab_table"  align="center">

                <?php memberLevel('member_level','id','level_name');?>
            </table>
            <!--商品属性-->
            <table style="display: none" width="90%" class="tab_table"  ">

                <!--foreach循环--><!--
                <tr>
                    <td width="100%" align="center">
                        <select name="type_id" onchange="getAttrList(this.value)" >
                            <option value="0">请选择商品类型</option>
                            <?php foreach($types as $type):?>
                            <option value="<?php echo $type['id'];?>"><?php echo $type['type_name'];?></option>

                            <?php endforeach;?>
                        </select><br>
                        <span class="notice-span" style="display:block" id="noticeGoodsType">请选择商品的所属类型，进而完善此商品的属性</span>
                    </td>
                </tr>
                <tr>
                    <td id="tbody-goodsAttr" colspan="2" style="padding:0"></td>
                </tr>-->
                    <!--生成筛选框-->

                    <tr>
                    <td>商品属性：<?php buildSelect('type','type_id','id','type_name');?></td>
                    </tr>
                    <tr>
                        <td align="center"><ul id="attr_list" ></ul></td>
                </tr>
            </table>
            <!--商品相册-->
            <table style="display: none" width="90%" class="tab_table"  align="center">
                <tr>
                    <td>
                        <input id="btn_add_pic" type="button" value="添加一张" />
                        <hr />
                        <ul id="ul_pic_list"></ul>
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
<!--创建iframe--><!--
<iframe src="" frameborder="0" width="0" height="0" id="ifr"></iframe>-->

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

/******** 切换的代码 *******/
$("#tabbar-div p span").click(function(){
    // 点击的第几个按钮
    var i = $(this).index();
    // 先隐藏所有的table
    $(".tab_table").hide();
    // 显示第i个table
    $(".tab_table").eq(i).show();
    // 先取消原按钮的选中状态
    $(".tab-front").removeClass("tab-front").addClass("tab-back");
    // 设置当前按钮选中
    $(this).removeClass("tab-back").addClass("tab-front");
});

// 添加一张
$("#btn_add_pic").click(function(){
    var file = '<li><input type="file" name="pic[]" /></li>';
    $("#ul_pic_list").append(file);
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
        // +变-
        newLi.find("a").text('[-]');
        // 新的放在li后面
        li.after(newLi);
    }
    else
        li.remove();
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



























<div id="footer"> @2018 39.com </div>
</body>
</html>