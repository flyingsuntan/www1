<?php
namespace Admin\Model;
use Think\Model;
class AttributeModel extends Model 
{
	protected $insertFields = array('attr_name','attr_type','attr_options_values','type_id');
	protected $updateFields = array('id','attr_name','attr_type','attr_options_values','type_id');
	protected $_validate = array(
		array('attr_name', 'require', '属性名称不能为空！', 1, 'regex', 3),
		array('attr_name', '1,30', '属性名称的值最长不能超过 30 个字符！', 1, 'length', 3),
		array('attr_type', 'require', '属性类型,0代表唯一，1代表可选不能为空！', 1, 'regex', 3),
		array('attr_type', '0,1', "属性类型,0代表唯一，1代表可选的值只能是在 '0,1' 中的一个值！", 1, 'in', 3),
		array('attr_options_values', '1,30', '属性可选值的值最长不能超过 30 个字符！', 2, 'length', 3),
		array('type_id', 'require', '类型Id不能为空！', 1, 'regex', 3),
		array('type_id', 'number', '类型Id必须是一个整数！', 1, 'regex', 3),
	);
	public function search($pageSize = 20)
	{
		/**************************************** 搜索 ****************************************/
		$where = array();
		if($attr_name = I('get.attr_name'))
			$where['attr_name'] = array('like', "%$attr_name%");
		$attr_type = I('get.attr_type');
		if($attr_type != '' && $attr_type != '-1')
			$where['attr_type'] = array('eq', $attr_type);
		if($type_id = I('get.type_id'))
			$where['type_id'] = array('eq', $type_id);
		/************************************* 翻页 ****************************************/
		$count = $this->alias('a')->where($where)->count();
		$page = new \Think\Page($count, $pageSize);
		// 配置翻页的样式
		$page->setConfig('prev', '上一页');
		$page->setConfig('next', '下一页');
		$data['page'] = $page->show();
		/************************************** 取数据 ******************************************/
		$data['data'] = $this->field('a.*,b.*,a.id attr_id')->alias('a')->join('LEFT JOIN __TYPE__ b ON  a.type_id=b.id')->where($where)->group('a.id')->limit($page->firstRow.','.$page->listRows)->select();
		return $data;
	}
	// 添加前
	protected function _before_insert(&$data, $option)
	{
	    //把中文逗号换成英文逗号
        //$data['attr_option_values'] = str_replace('，',',',$data['attr_option_values']);
	}
	// 修改前
	protected function _before_update(&$data, $option)
	{
	}
	// 删除前
	protected function _before_delete($option)
	{
		if(is_array($option['where']['id']))
		{
			$this->error = '不支持批量删除';
			return FALSE;
		}
	}
	/************************************ 其他方法 ********************************************/
	/*
	public function getAttrsForm($typ_id){
	    var_dump($typ_id);
        $attrs = $this->where(array(
            'type_id'=> array('eq',$typ_id)
        ))->select();
        $res = "<table width='100%' id='attrTable'>";
        foreach ($attrs as $attr){
            $res .="<tr >";
            $res .="<td class='label'align='right' width='70%'>{$attr['attr_name']}：</td>";
            $res .="<td>";
            $res .="<input type='hidden' name='attr_id_list[]' value='{$attr['attr_id']}'>";
            switch ($attr['attr_type']){
                case 0://唯一
                    $res .="<input name='attr_value_list[]' type='text' size='40'>";
                    break;
                case 1://可选
                    $opts = explode(',',$attr['attr_options_values']);
                    foreach ($opts as $opt){
                        $res .="<input type='radio' width='50%' align='left' name='attr_type' value='$opt' />$opt";
                    }
                    break;
                case 2://文本域
                    $res .="<textarea name='attr_value_list[]'></textarea>";
                    break;

            }
            $res .="<input type='hidden' name='attr_price_list[]' value='0'>";
            $res .="</td>";
            $res .="</tr>";
        }
        $res .="</table>";

        return $res;
    }
	*/
}