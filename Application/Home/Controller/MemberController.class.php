<?php
namespace Home\Controller;
use Think\Controller;
class MemberController extends Controller{
    
    
    public function register(){
        
        $memberModel=D('Member');
                if($_POST){
                        if($memberModel->create()){//表单验证
                            if($this->check_verify($_POST['checkcode'])){  //验证码验证
                                    $code= substr(uniqid(),3,8);
                                 $memberModel->token=$code;//随机产生激活码
                                        $memberModel->token_expire_time=time()+3600;//激活码到期是时间
                                     $memberModel->pwd=md5(I('post.pwd'));
                                      $memberModel->reg_time=time();//注册时间
                                if($memberModel->add()){
                                  
                                        $memberModel->sendEmail($_POST['m_email'], $code);
                                     echo   "注册成功,邮件已经发送,请邮件:".$_POST['m_email']." 激活账号";
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
    
    
    //验证邮件
 public function checkEmail($email,$code){
        $memberModel=D('Member');
        //找数据库token是否和$code相等
        $token=$memberModel->field('token,token_expire_time,reg_time')->where("token='$code'")->find();
      
        if($token){
          
               $token_expire_time=(int)$token['token_expire_time'];
                        if(time()<$token_expire_time){
                            $memberModel->execute("update v_member set status=1 where token='$code'");
                             $this->success('账号已经激活,请重新登录',U('login'));
                             //清空session  重新登录
                             session(null);

                        }else{
                            
                           
                            echo  "验证码已经过期,请重新发送邮件<a href='".__CONTROLLER__.'/resendEmail/email/'.$email."'>重新发送邮件</a>";
                            //更新数据库的验码有效期
                             $token_expire_time=  time()+C('token_expire_time');
                            $memberModel->execute("update v_member set token_expire_time=$token_expire_time where token='{$token['token']}'");
                        }
                
         
            
         
        }else{
            
               echo  "验证码无效,请重新发送邮件<a href='".__CONTROLLER__.'/resendEmail/email/'.$email."'>重新发送邮件</a>";
        }
    }
//重新发送邮件
 public function resendEmail($email){
     $memberModel=D('Member');
     $code=  substr(uniqid(),3,8);
    $memberModel->execute("update v_member set token='$code' where m_email='$email'");
    
        $title='用户注册';
     $content="<a href='http://vshop.com/index.php/Home/Member/checkEmail/email/$email/code/$code'>点击激活你的账号</a>";
        
        sendMail($title,$content,$email);
        $this->success("邮件已经发送，请到邮箱:$email 激活账号",U('login'));
        session(null);//清空session
 }

    //用户登录方法
    public function login(){
        $memberModel=D('Member');
                if($_POST){
                        if($memberModel->create()){//表单验证
                              //  if($this->check_verify($_POST['checkcode'])){ //验码证验证
                                    
                                        $res=$memberModel->checkLogin($_POST['m_name'],$_POST['pwd']);
                                       
                                      if($memberModel->checkLogin($_POST['m_name'],$_POST['pwd'])==1){
                                                
                                          
                                       
                                          $memberModel->field('m_email,token,status')->find(session('id'));
                                                    if($memberModel->status==0){
                                                                 
                                          
                                                           echo "用户尚未激活,请重新发送邮件进行激活<a href='".__CONTROLLER__.'/resendEmail/email/'.$memberModel->m_email."'>重新发送邮件</a>";
                                                        
                                                             exit;
                                                        
                                                    }
                                                    if(session('url')){
                                                             $this->success('登录成功',  session('url'));
                                                             session('url',null); //清空sessionurl
                                                                exit;
                                                        
                                                    }else{
                                                        
                                                             $this->success('登录成功',U('Index/index'));
                                                                exit;
                                                    }
                                                            
                                                
                                               
                                 
                                           
                                      }elseif($memberModel->checkLogin($_POST['m_name'],$_POST['pwd'])==2){
                                          $this->error('用户不存在');
                                      }else{
                                            $this->error('密码错误');
                                      }
                                        
                                          
                                   
                                      
                              //  }
                               // $this->error('验证码不正确');//验证码错误
                        }
                        $this->error($memberModel->getError());//验证错误时提示信息
                }
        
        $this->display();
    }

//用户退出方法
    public function logout(){
        
        session(null);
        $this->success('退出成功',U('Index/index'));
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
        //通过ajax验证邮箱和唯一性
        public function ajaxCheckEmail($email){
            $memberModel=D('Member');
            $email=$memberModel->field('m_email')->where("m_email='$email'")->find();
            if($email){
            
                
                //如果邮箱已经被使用
                echo json_encode(array(
                    'msg'=>'邮箱已经存在',
                    'color'=>'red',
                ));
                exit;
                
            }else{
                
                    //如果邮箱没有被使用
                     echo json_encode(array(
                    'msg'=>'恭喜你邮箱可以使用',
                    'color'=>'green',
                
            ));
            } 
        }
}
