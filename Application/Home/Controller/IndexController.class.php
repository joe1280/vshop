<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    
    
    public function __construct() {
        parent::__construct();
//                    if(cookie('id')){//取出ID
//             //查数据库
//            $memberModel=D('Member');
//           $id= $memberModel->field('id='.cookies('id'))->find();
//                        if($id){
//
//                                  session('id',$id['id']);
//                        }
//                        
//                        //如果存在COOKIE 的用户名
//                        if(cookie('m_name')){
//                            $m_name=  cookie('m_name');
//                                 $m_name= $memberModel->field("m_name='$m_name'")->find();
//                            
//                        }
//          
//        }
                if(!session('id')){//如果不存在sessionID，就从cookie中取得用户ID
                       $username=  cookie('m_name');//用户名
                       $pwd=  cookie('pwd');//密码
                        if($username&&$pwd){//如果cookies同时存在用户和密码
                                $memberModel=D('Member');
                                if($memberModel->create(array( 'm_pwd'=>$username,'pwd'=>$pwd,))){ //字段验证
                                        if($memberModel->checkLogin($username,$pwd)==1){
                                           
                                                    $this->success('登录成功',U('index'));
                                            
                                        }else{
                                            //清空cookies
                                            setcookie('m_name','',1);
                                            setcookie('pwd','',1);         
                                        }
                                }
                                   
                                    
                              
                                
                                
                                
                        }
                    
                }
        
        
        
    }


    public function index(){

            //初始化页面

        
    //显示分类
   $this->assign('display','show'); 
   
   //显示标题
   $this->assign('title','首页');
   $this->assign('css',array('index'));
   $this->assign('js',array('index'));
        $this->display();
    }
    
        public function goods(){
        //隐藏分类
           //显示标题
   $this->assign('title','商品页面');
            $this->assign('css',array('goods','common','jqzoom'));
            $this->assign('js',array('goods','jqzoom-core'));
        $this->display();
    }
}