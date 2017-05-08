<?php
namespace Admin\Controller;
class IndexController extends BaseController{
    public function index(){
        $this->display();
    }


    public function top(){
        //C函数使得头部不要跟踪信息
        C('SHOW_PAGE_TRACE',false);
        $this->display();
    }
    public function menu(){
        //分配显示的数据
        // $btns = D('privilege')->getBtn();
        // $this->assign('btns',$btns);
        $this->display();
    }
    public function main(){
        $this->display();
    }

    public function news(){
         //获取新闻
        $news = D('Home/News')->select();
        $this->assign(array(
           'news' => $news,
        ));
        $this->display();
    }


    public function add(){
        //判断是否提交表单，相当于isset($_POST)
        if(IS_POST){
            //接受数据，校验
            $model = D('Home/News');
            $model->content = $_POST['content'];
            if($model->add()){
                //成功
                $this->success('操作成功',U('news'));
                exit();
            }
            //获取模型中的报错信息
        }
        //不提交就显示
        $this->display();
    }

    public function lst(){
        //获取用户
        $userInfo = D('Home/User')->select();
        $this->assign(array(
           'userInfo' => $userInfo,
        ));
        $this->display();
    }

    public function delete(){
        $id = I('get.id');
        $user = D('Home/User');
        $flag = $user->delete($id);
        if($flag !== false){
            $this->success('删除成功！',U('lst'));
        }else{
            $this->error('删除失败，原因是：'.$goods->getError());   
        }
    }


    public function del(){
        $id = I('get.id');
        $user = D('Home/News');
        $flag = $user->delete($id);
        if($flag !== false){
            $this->success('删除成功！',U('news'));
        }else{
            $this->error('删除失败，原因是：'.$goods->getError());   
        }
    }

    public function edit(){
             //获取id
        $id = I('get.id');
        //生成模型
        $goods = D('Home/News');
        //var_dump($_POST);die;
        //判断是否提交表单，相当于isset($_POST)
        if(IS_POST){
            //接受数据，校验
            if($goods->create(I('post.'),2)){
                if($goods->save() !== false){
                    $this->success('操作成功',U('news'));
                    exit;
                }
            }
            //获取模型中的报错信息
            $error = $goods->getError();
            //默认跳回上一个页面
            $this->error($error);
        }
        $newsInfo = D('Home/News')->where(['id' => $id])->find();
        $this->assign('newsInfo',$newsInfo);
        //不提交就显示
        $this->display();
    }


}