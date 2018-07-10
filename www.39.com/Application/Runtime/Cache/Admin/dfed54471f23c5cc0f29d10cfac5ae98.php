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

<!-- $Id: category_info.htm 16752 2009-10-20 09:59:38Z wangleisvn $ -->

<div class="main-div">
    <form action="__GROUP__/Category/categoryAdd" method="post" name="theForm" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
        <table width="100%" id="general-table">
            <tr>
                <td class="label">分类名称:</td>
                <td>
                    <input type='text' name='cat_name' maxlength="20" value="<?php echo $data['cat_name']?>" size='27' /> <font color="red">*</font>
                </td>
            </tr>
            <tr>
                <td class="label">上级分类:</td>
                <td>
                    <select name="parent_id">
                        <option value="0">顶级分类</option>
                        <?php foreach ($cats as $k => $v): if($v['id'] == $data['id'] || in_array($v['id'],$children)) continue; ?>

                            <option value="<?php echo $v['id']?>" <?php if ($v['id'] == $data['parent_id']) echo 'selected="selected"'?>><?php echo str_repeat("&nbsp;&nbsp;&nbsp;",$v['level']); echo $v['cat_name']?></option>
                        <?php endforeach;?>
                    </select>
                </td>
            </tr>
        </table>
        <div class="button-div">
            <input type="submit" value=" 确定 " />
            <input type="reset" value=" 重置 " />
        </div>
    </form>
</div>


<div id="footer"> @2018 39.com </div>
</body>
</html>