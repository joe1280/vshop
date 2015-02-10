<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller{
    
    public function index(){
                if(IS_POST){
              
                   $adminModel=D('Admin');
                   if($adminModel->create()){
                  
                                //    if($this->check_verify(I('post.code'))){
                                            if($this->checkLogin(I('post.username'),I('post.pwd'))===true){
                                                    $adminModel->save(array(
                                                        'id'=>  session('id'),
                                                        'ip'=>$_SERVER['REMOTE_ADDR'],
                                                        'login_time'=>time(),
                                                    ));
                                                $this->success('登录成功',U('Index/index'));
                                                    exit;
                                                    
                                                    
                                            }elseif($this->checkLogin(I('post.username'),I('post.pwd'))==2){
                                                
                                                $this->error('账号已经禁用,请联系管理员');
                                            }
                                                   
                                            $this->error('密码或用户名不存在');
                                     //}
                                     $this->error('验证码错误');//验证码错误
                           }            
                                 $this->error($adminModel->getError());//表单出错
                        }
                       
                   $this->display();
                  
                     }                   
                            
                      
                    
               
        
        
        
  
    
    
    
    //验证用户密码
    public function checkLogin($username,$pwd){
            
            $adminModel=D('Admin');
            
            $res=$adminModel->where("username='$username'")->find();
                if($res){
                        if(md5($pwd)==$res['pwd']){
                                    if($res['status']=='1'){
                                        
                                        session('username',$res['username']);
                                        session('id',$res['id']);
                                        
                                        //取出角色的所有权限
                                        $roleModel=D('Role');
                                        $role_info=$roleModel->find($res['role_id']);
                                        //取表
                                        $authModel=D('Auth');
                                        $sql='select  *  from v_auth where id in('.$role_info['auth_list'].')' ;
                                      $role_auth=  $authModel->query($sql);
                                     
                                        session('role_auth',$role_auth);
                                            return true;
                                    }
                                    return 2;
                                    
                             //把用户名 ID存在session中
                         
                        }
                }
                return false;
    }

    //生成验码
        public function verify(){
        $config =    array(    'fontSize'    =>    50,    // 验证码字体大小   
   
        'length'      =>   4,     // 验证码位数   
         'useNoise'    =>    false, // 关闭验证码杂点
         );
         $Verify =     new \Think\Verify($config);
            $Verify->entry();
        
    }
    //验证验证码
    function check_verify($code){    
        $verify = new \Think\Verify();    
        return $verify->check($code);
        
    }
    //退出
    public function logout(){
        
        session(null);
        $this->success('退出成功',U('index'));
    }
    
    
 
        
    
    
}