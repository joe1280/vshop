<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends  Controller{
    
   // 定义一个初始化函数
    public function __construct() {
        parent::__construct();
        if(!session('id')){
            $this->error('请登录,再访问',U('Login/index'));
        }
        $role_auth=  session('role_auth');
                if(MODULE_NAME=='Admin'&&CONTROLLER_NAME=='Index'){
                  
                       return true;
                      echo 11;
                }
                 
                elseif(session('id')==1){
                    return true;
                    
                }
                        
                else{
                        foreach($role_auth as $k=>$v){
                                if($v['controller']==CONTROLLER_NAME&&$v['action']==ACTION_NAME)
                                    return true;
                            
                        }
                        $this->error('无权访问');
                }
        
      
    }  
  
    public function index(){
        
        
        
       
        $this->display();
    }
  
    //头部
    public function top(){
        $this->display();
    }
    public function left(){
        
        $authModel=D('Auth');
         
         
         if(session('id')==1){
             $auth_list=$authModel->select();
             
         }else{
             
             $auth_list=  session('role_auth');
         }
        $auth_list=$authModel->sort($auth_list);
        
        $this->assign('auth_list',$auth_list);
        
        $this->display();
    }
    public function right(){
        $this->display();
    }
}

