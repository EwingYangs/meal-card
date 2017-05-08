<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller{
    public function login(){
        if(IS_POST){
            $model = D('Home/User');
            if($model->validate($model->_login_validata)->create()){
                if($model->login()){
                    $url = U('/');
                    if(session('returnUrl')){
                        //如果存在跳回的地址就传进去
                        $url = session('returnUrl');
                        session('returnUrl',null);
                    }
                    $this->success('登录成功！',$url);
                    exit;
                }
            }
            $this->error($model->getError());
        }
        $this->assign(array(
            
        ));
        $this->display();
    }
    public function register(){
        if(IS_POST){
            $model = D('Home/User');
            if($model->create(I('post.'),1)){
                if($model->add()){
                    $this->success('注册成功',U('login'));
                    exit;
                }
            }
            $this->error($model->getError());
        }
        $this->display();
    }
    public function logout(){
        session('m_id',null);
        session('m_sno',null);
        redirect('login');
    }
    
    
}