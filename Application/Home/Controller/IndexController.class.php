<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends MyController{
    public function index(){
        //获取信息总数
        $sno = session('m_sno');
        $number = D('Home/Message')->where(['sno' => $sno])->count();
        $info = D('Home/Publish')->search();
        // var_dump($_POST);die;
        //获取快讯
        $news = D('Home/News')->select();
        $this->assign(array(
            'sno' => session('m_sno'),
            'info' => $info,
            'number' => $number,
            'news' => $news,
        ));
        $this->display();
    }

    
    

    //ajax一键找饭卡
    public function ajaxPublish(){
        $sno = session('m_sno');//获取学号
        $userInfo = D('Home/User')->where(['sno' => $sno])->find();
        $model = D('Home/Publish');
        $model->sno = $sno;
        $model->message = $sno.'+'.$userInfo['sname'].'+'.$userInfo['dep'];
        $model->type = 0;
        if($id = $model->add()){
            //成功
            $info = D('Home/Publish')->find($id);
            $arr = ['msg' => 'success' ,'info'=> $info];
            echo json_encode($arr);
        }else{
            //失败
            $error = $model->getError();
            $arr = ['msg' => 'error' ,'error'=> $error];
            echo json_encode($arr);
        }
    }

    public function ajaxFabu(){
        if(IS_POST){
            $Publish = D('Home/Publish');
            //接受数据，校验
            if($Publish->create(I('post.'),1)){
                  if($Publish->add()){
                       echo 'success';
                       exit();
                  }
            }
            //获取模型中的报错信息
            echo 'error';
            exit();
        }
    }
    


    public function ajaxContact(){
        $sno = I('post.sno');
        $sid = I('post.id');
        $fromSno = session('m_sno');
        $fromContact = D('Home/User')->field('snum,sname')->where(['sno' => $fromSno])->find();
        $message_model = D('Home/Message');
        $message_model->sno = $sno;
        $message_model->message = '有人联系你了，详情请联系'.$fromContact['sname'].',手机号码'.$fromContact['snum'];
        if($message_model->add()){
            //成功
            //删除发布信息
            D('Home/Publish')-> where(['id' => $sid])->setField('is_delete','1');
            echo 'success';
            exit();
        }else{
            echo 'error';
            exit();
        }
    }

    public function ajaxFind(){
        $sno = I('post.sno');
        $snoList = D('Home/User')->Field('sno')->select();
        $sno_arr = array();
        foreach ($snoList as $key => $value) {
            $sno_arr[] = $value['sno'];
        }
        if(!in_array($sno, $sno_arr)){
            echo '失主还没有注册账号';
            exit();
        }
        $fromSno = session('m_sno');
        $fromContact = D('Home/User')->field('snum,sname')->where(['sno' => $fromSno])->find();
        $message_model = D('Home/Message');
        $message_model->sno = $sno;

        $message_model->message = '有拾获者联系你了，详情请联系'.$fromContact['sname'].',手机号码'.$fromContact['snum'];
        if($message_model->add()){
            //成功
            echo 'success';
            exit();
        }else{
            echo 'error';
            exit();
        }
    }


    public function userCenter(){
        //获取所有的信息
        $sno = session('m_sno');
        $message = D('Home/Message')->where(['sno' => $sno])->select();
        $this->assign(array(
            'message' => $message,
        ));
        $this->display();
    }

    public function read(){
        $mid = I('post.mid');
        if(D('Home/Message')->delete($mid)){
            echo 'success';
        }
    }
}