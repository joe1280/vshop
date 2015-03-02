<?php
namespace Home\Controller;
use Think\Controller;
class MemberController extends Controller{
    
    
    public function register(){
        
        $memberModel=D('Member');
                if($_POST){
                        if($memberModel->create()){//表单验证
                            if($this->check_verify($_POST['checkcode'])){  //验证码验证
                                 $memberModel->token= substr(uniqid(),3,8);//随机产生激活码
                                     $memberModel->token_expire_time=time()+24*60*60;//激活码到期是时间
                                    
                                      $memberModel->reg_time=time();//注册时间
                                if($memberModel->add()){
                                        $this->success('注册成功');
                                            exit;
                                    
                                }
                                $this->error('注册失败');
                            }
                            $this->error('验证码错误');
                                    
                        }
                        $this->error($memberModel->getError());
                    
                }
        
        
        $this->display();
    }
    
    //生成验证码
public function verify(){
    $config =    array( 
     'fontSize'    =>  20,    // 验证码字体大小    
    'length'      =>    4,     // 验证码位数    
    'useNoise'    =>    false,// 关闭验证码杂点
        );
    $Verify =     new \Think\Verify($config);
    $Verify->entry();
    }
    
    //验证验证码
    function check_verify($code, $id = '')
        {    $verify = new \Think\Verify();    
        return $verify->check($code, $id);
        
        }
        //ajax验证用户名
        public function ajaxCheckUser($user){
            //实例化会员表
            $memberModel=D('Member');
           $user= $memberModel->field('m_name')->where("m_name='$user'")->find();
           if($user){
             echo json_encode(array(
                   'msg'=>'用户名已经存在',
                   'color'=>'red',
               ));
               exit;
           }else{
               //echo '恭喜你用户名可以用';
               echo json_encode(array(
                   'msg'=>'恭喜你用户名可以用',
                   'color'=>'green',
               ));
           }
        }
}
