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

<!-- $Id: category_list.htm 17019 2010-01-29 10:10:34Z liuhui $ -->
<form method="post" action="" name="listForm">
    <input type="hidden" name="pid" value="">
    <div class="list-div" id="listDiv">
        <table width="100%" cellspacing="1" cellpadding="2" id="list-table">
            <tr>
                <th>分类名称</th>
                <th>操作</th>
            </tr>
            <?php foreach ($data as $l => $v):?>
            <tr align="center" class="<?php echo $v['level']; ?>" id="<?php echo $v['level']; ?>_<?php echo $v['cat_id']; ?>">
            <td align="left" class="first-cell">
                <?php echo str_repeat("&nbsp;&nbsp;&nbsp;",$v['level']); ?>
                <img src="/Public/Admin/images/menu_minus.gif" id="icon_<?php echo $v['level']; ?>_<?php echo $v['cat_id']; ?>" width="9" height="9" border="0" style="margin-left:0em" onclick="rowClicked(this)">
                <span><a href="goods.php?act=list "><?php echo $v['cat_name']; ?></a></span>
            </td>
                <td width="30%" align="center">
                <a href="<?php echo U('edit?id='.$v['id']);?>">编辑</a> |
                <a onclick="return confirm('确定要删除吗？')" href="<?php echo U('delete?id='.$v['id']);?>" title="移除">移除</a>
                </td>
            </tr>
            <?php endforeach;?>
        </table>
    </div>
</form>
<script>
    /**
     * 折叠分类列表
     */
    var imgPlus = new Image();
    imgPlus.src = "/Public/Admin/images/menu_plus.gif";

    function rowClicked(obj)
    {
        // 当前图像
        img = obj;
        // 取得上二级tr>td>img对象
        obj = obj.parentNode.parentNode;
        // 整个分类列表表格
        var tbl = document.getElementById("list-table");
        // 当前分类级别
        var lvl = parseInt(obj.className);
        // 是否找到元素
        var fnd = false;
        var sub_display = img.src.indexOf('menu_minus.gif') > 0 ? 'none' : 'table-row' ;
        // 遍历所有的分类
        for (i = 0; i < tbl.rows.length; i++)
        {
            var row = tbl.rows[i];
            if (row == obj)
            {
                // 找到当前行
                fnd = true;
                //document.getElementById('result').innerHTML += 'Find row at ' + i +"<br/>";
            }
            else
            {
                if (fnd == true)
                {
                    var cur = parseInt(row.className);
                    var icon = 'icon_' + row.id;
                    if (cur > lvl)
                    {
                        row.style.display = sub_display;
                        if (sub_display != 'none')
                        {
                            var iconimg = document.getElementById(icon);
                            iconimg.src = iconimg.src.replace('plus.gif', 'minus.gif');
                        }
                    }
                    else
                    {
                        fnd = false;
                        break;
                    }
                }
            }
        }

        for (i = 0; i < obj.cells[0].childNodes.length; i++)
        {
            var imgObj = obj.cells[0].childNodes[i];
            if (imgObj.tagName == "IMG" && imgObj.src != '/Public/Admin//images/menu_arrow.gif')
            {
                imgObj.src = (imgObj.src == imgPlus.src) ? '/Public/Admin/images/menu_minus.gif' : imgPlus.src;
            }
        }
    }
</script>

<div id="footer"> @2018 39.com </div>
</body>
</html>