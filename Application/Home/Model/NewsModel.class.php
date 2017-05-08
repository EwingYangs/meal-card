<?php
namespace Home\Model;
use Think\Model;
use Tools\Page;
class NewsModel extends Model
{
	protected $insertFields = array('content,create_at');
	protected $_validate = array(
		array('content', 'require', '信息不能为空！', 1, 'regex', 3),
	);
	

	public function search($pageSize = 3)
	{
		$where = ['is_delete' => 0];
		/************************************* 翻页 ****************************************/
		$count = $this->where($where)->count();
		$page = new Page($count, $pageSize);
		
		$data['page'] = $page->fpage(array(3,4,5,6,7,8));
		$limit = strchr($page->limit," ");
		
		$data['data'] = $this
		->where($where)
		->order('id desc')
		->limit($limit)
		->select();
		return $data;
	}
	// 添加前
	protected function _before_insert(&$data, $option)
	{      
	    $data['create_at'] = date('Y-m-d H:i:s');
	    $data['content'] = removeXXS($_POST['content']);
	}
	// 添加后
	protected function _after_insert($data, $options)
	{  
	    
	}
	// 修改前
	protected function _before_update(&$data, $option)
	{
	   
	    
	}
	
	// 删除前
	protected function _before_delete($option)
	{
       
	}
	/************************************ 其他方法 ********************************************/
}