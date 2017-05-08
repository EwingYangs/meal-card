<?php
namespace Home\Model;
use Think\Model;
use Tools\Page;
class UserModel extends Model 
{
	protected $insertFields = array('sname','password','password2','snum','dep','sno');
	protected $updateFields = array('id','username','password','cpassword');
	protected $_validate = array(
		array('sname', 'require', '用户名不能为空！', 1, 'regex', 3),
		array('sno', 'require', '学号不能为空！', 1, 'regex', 3),
		array('password', 'require', '密码不能为空！', 1, 'regex', 1),
        array('password2', 'password', '两次密码不一致！', 1, 'confirm', 3),
	    array('sname', 'chk_username', '姓名的已经存在！', 1, 'callback', 3),
	    array('sno', 'chk_no', '学号的已经存在！', 1, 'callback', 3),
	);
	public function chk_username(){
	    $username = I('post.sname');
	    $info = $this->where(array(
	        'sname' => array('eq',$username),
	    ))->find();
	    if($info){
	       return false;
	    }else{
	        return true;
	    }
	}

	public function chk_no(){
	    $sno = I('post.sno');
	    $info = $this->where(array(
	        'sno' => array('eq',$sno),
	    ))->find();
	    if($info){
	       return false;
	    }else{
	        return true;
	    }
	}
	
	
	public $_login_validata = array(
	    array('sno', 'require', '学号不能为空！', 1, 'regex', 3),
	    array('password', 'require', '密码不能为空！', 1, 'regex', 3),
	);
	//登录验证的方法
	public function login(){
	    //获取表单中的用户名和密码
	    $sno = $this->sno;//相当于I('post.username')
	    $password = $this->password;
	    $user = $this->where(array('sno' => array('eq',$sno)))->find();
	    if($user){
	        if($user['password'] == md5($password)){
	            //登录成功！return true
	            //把信息传到session中
	            session('m_id',$user['id']);
	            session('m_sno',$user['sno']);
	            return true;
	        }else{
	            $this->error = "密码不正确！";
	            return false;
	        }
	    }else{
	        $this->error = "学号不正确！";
	        return false;
	    }
	    
	}
	public function search($pageSize = 20)
	{
		/**************************************** 搜索 ****************************************/
		$where = array();
		//用户名
		if($username = I('get.username'))
			$where['a.username'] = array('like', "%$username%");
		
		//角色
		if($role_id = I('get.role_id')){
		    //获取admin的id
		    $arData = D('admin_role')->field('admin_id')->where(array('role_id' => array('eq',$role_id)))->select();
		    $_arData = array();
		    foreach($arData as $k=>$v){
		        $_arData[] = $v['admin_id'];
		    }
		    $arData = implode(',', $_arData);
		    $where['a.id'] = array('in', $arData);
		}
		/************************************* 翻页 ****************************************/
		$count = $this->alias('a')->where($where)->count();
		$page = new Page($count, $pageSize);
		// 配置翻页的样式
		//$page->setConfig('prev', '上一页');
		//$page->setConfig('next', '下一页');
		//$data['page'] = $page->show();
		$data['page'] = $page->fpage(array(3,4,5,6,7,8));
		$limit = strchr($page->limit," ");
		/************************************** 取数据 ******************************************/
		$data['data'] = $this
		->alias('a')
		->field('a.*,group_concat(c.role_name separator " | ") as role_name')
		->where($where)
		->join('LEFT JOIN __ADMIN_ROLE__ b on a.id=b.admin_id
		        LEFT JOIN __ROLE__ c on b.role_id=c.id')
		->group('a.id')
		->limit($limit)
		->select();
		return $data;
	}
	// 添加前
	protected function _before_insert(&$data, $option)
	{      
	    //插入之前先加密
	    $data['password'] = md5($data['password']);
	    
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