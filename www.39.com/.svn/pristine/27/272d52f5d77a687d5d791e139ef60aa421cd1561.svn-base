<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ECSHOP 管理中心 - 商品列表 </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Public/Admin/Styles/general.css" rel="stylesheet" type="text/css" />
<link href="/Public/Admin/Styles/main.css" rel="stylesheet" type="text/css" />
</head>
<body>
<h1>
    <span class="action-span"><a href="__GROUP__/Goods/goodsAdd">添加新商品</a></span>
    <span class="action-span1"><a href="__GROUP__">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 商品列表 </span>
    <div style="clear:both"></div>
</h1>
<div class="form-div">
    <form action="/index.php/Admin/Goods/lst" method="get" name="searchForm">
        <p>
            商品名称：
            <input type="text" name="gn" size="60" value="<?php echo I('get.gn');?>"/>
        </p>
        <p>
            价      &nbsp;&nbsp;&nbsp; &nbsp; 格：
            从<input type="text" name="fp" size="8" value="<?php echo I('get.fp');?>" />
            到<input type="text" name="tp" size="8" value="<?php echo I('get.tp');?>" />
        </p>
        <p>
            是否上架：
            <?php $ios = I('get.ios');?>"
            <input type="radio" name="ios" value=""  <?php if($ios == "") echo 'checked="checked"';?> />全部
            <input type="radio" name="ios" value="yes" <?php if($ios == "yes") echo 'checked="checked"';?> />上架
            <input type="radio" name="ios" value="no" <?php if($ios == "no") echo 'checked="checked"';?> />下架
        </p>
        <p>
            添加时间：
            从<input id="fa" type="text" name="fa" size="20" value="<?php echo I('get.fa');?>"/>
            到<input id="ta" type="text" name="ta" size="20" value="<?php echo I('get.ta');?>"/>
        </p>
        <p>
            排序方式：
            <?php $odby = I('get.odby','id_desc'); ?>
            <input onclick="this.parentNode.parentNode.submit();" type="radio" name="odby" value="id_desc" <?php if($odby == "id_desc") echo 'checked="checked"';?>/>以添加时间降序
            <input onclick="this.parentNode.parentNode.submit();" type="radio" name="odby" value="id_asc" <?php if($odby == "id_asc") echo 'checked="checked"';?>/>以添加时间升序
            <input onclick="this.parentNode.parentNode.submit();" type="radio" name="odby" value="price_desc" <?php if($odby == "price_desc") echo 'checked="checked"';?>/>以价格降序
            <input onclick="this.parentNode.parentNode.submit();" type="radio" name="odby" value="price_asc" <?php if($odby == "price_asc") echo 'checked="checked"';?>/>以价格升序

        </p>
        <p>
            <input type="submit" value="搜索" />
        </p>

    </form>
</div>

<!-- 商品列表 -->
<form method="post" action="" name="listForm" onsubmit="">
    <div class="list-div" id="listDiv">
        <table cellpadding="3" cellspacing="1">
            <tr>
                <th>编号</th>
                <th>商品名称</th>
                <th>LOGO</th>
                <th>市场价格</th>
                <th>本店价格</th>
                <th>上架</th>
                <th>添加时间</th>
                <th>操作</th>
            </tr>
            <?php foreach($data as $k => $v): ?>
            <tr class="tron">
                <td align="center"><?php echo $v['id']?></td>
                <td align="center" class="first-cell"><span><?php echo $v['goods_name']?></span></td>
                <td align="center"><img src="/Public/Uploads/<?php echo $v[sm_logo]?>"></td>
                <td align="center"><?php echo $v['market_price']?></td>
                <td align="center"><?php echo $v['shop_price']?></td>
                <td align="center"><?php echo $v['is_on_sale']?></td>
                <td align="center"><?php echo $v['addtime']?></td>
                <td align="center">
                    <a href="<?php echo U('edit?id='.$v['id']);?>">修改</a>
                    <a href="">删除</a>
                </td>
            </tr>
            <?php endforeach;?>
        </table>

    <!-- 分页开始 -->
        <table id="page-table" cellspacing="0">
            <tr>
                <td width="80%">&nbsp;</td>
                <td align="center" nowrap="true">
                    <?php echo $page;?>
                </td>
            </tr>
        </table>
    <!-- 分页结束 -->
    </div>
</form>

<div id="footer">
共执行 7 个查询，用时 0.028849 秒，Gzip 已禁用，内存占用 3.219 MB<br />
版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>
</body>
</html>
<!--引入JQ-->
<link rel="stylesheet" type="text/css" href="/Public/datetimepicker//jquery.datetimepicker.css"/>
<script  src="/Public/datetimepicker/jquery.js"></script>
<script  src="/Public/datetimepicker/jquery.datetimepicker.js"></script>
<script >

   // $("#fa").datetimepicker({dateFormat:"YY-mm-dd"});
   // $("#fa").datetimepicker();
    //$("#ta").datetimepicker();
   // $("#ta").datetimepicker();

  // $('#fa').datetimepicker({dateFormat:"YY-mm-dd H:i:s"});
   var logic = function( currentDateTime ){
       if( currentDateTime.getDay()==6 ){
           this.setOptions({
               minTime:'11:00'
           });
       }else
           this.setOptions({
               minTime:'8:00'
           });
   };
    $("#fa").datetimepicker({
        onChangeDateTime:logic,
        onShow:logic
    });
   // $("#ta").datetimepicker({
      // onChangeDateTime:logic,
       // onShow:logic
    //});
</script>
<!--引入行高显示-->
<script type="text/javascript" src="/Public/Admin/Js/tron.js"></script>