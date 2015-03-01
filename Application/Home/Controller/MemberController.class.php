<?php
namespace Home\Controller;
use Think\Controller;
class MemberController extends Controller{
    
    
    public function register(){
        
        $memberModel=D('Member');
                if($_POST){
                        if($memberModel->create()){
                                     $memberModel->token= substr(uniqid(),3,8);//随机产生激活码
                                     $memberModel->token_expire_time=time()+24*60*60;//激活码到期是时间
                                    
                                      $memberModel->reg_time=time();//注册时间
                                if($memberModel->add()){
                                        $this->success('注册成功');
                                            exit;
                                    
                                }
                                $this->error('注册失败');
                        }
                        $this->error($memberModel->getError());
                    
                }
        
        
        $this->display();
    }
}
