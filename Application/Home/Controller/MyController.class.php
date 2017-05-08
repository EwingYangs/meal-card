<?php
namespace Home\Controller;
use Think\Controller;
class MyController extends Controller{
    public function __construct(){
        parent :: __construct();
        //进入个人中心之前判断用户有没有登录，如果没有登录，就跳转到登录的界面
        $member_id = session('m_id');
        if(!$member_id){
            redirect(U('user/login'));
        }
    }
    
}