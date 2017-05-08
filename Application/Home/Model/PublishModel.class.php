<?php
namespace Home\Model;
use Think\Model;
use Tools\Page;
class PublishModel extends Model 
{
	protected $insertFields = array('sno','message','img_url','type','create_at');
	protected $_validate = array(
		array('message', 'require', '发布信息不能为空！', 1, 'regex', 3),
		array('sno', 'require', '还未登陆，不能发布！', 1, 'regex', 3),
	);
	

	public function search($pageSize = 3)
	{
		$where = array();
		$where['is_delete'] = array('eq',0);
		$content = I('post.content');
        if($content){
            $where['message'] = array('like',"%$content%");//where goods_name like'%%';
        }
        // var_dump($where);die;
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
	    if(isset($_FILES['img']) && $_FILES['img']['error'] == 0){
            $ret = uploadOne('img', 'Publish', array(
                array(50, 50),
            ));
            if($ret['ok'] == 1)
            {
                //把路径放到表单中
                $data['img_url'] = $ret['images'][0];
            }
            else
            {
                $this->error = $ret['error'];
                return FALSE;
            }
        } 
	    $data['create_at'] = date('Y-m-d H:i:s');
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