<?php
namespace Home\Model;
use Think\Model;
class MemberModel extends Model{
    
    
        protected $_validate = array(
        array('m_name','require','会员名称不能为空',1),
      //  array('m_name','','会员名称已经存在',0,'unique',1),
         array('pwd','require','密码不能为空',1),
          array('pwd2','require','确认密码不能为空'),
        array('pwd2','pwd','两次密码不一致',0,'confirm'),
         //array('code','require','验证码不能为空'),
        array('m_email','email','邮箱格式不正确'),
       // array('checkcode','require','验证码不能为空',1),
       //array('role_id','require','角色不能为空'),
       // array('code','require','验证码不能为空'),
  
    );
        
        //用户名验证方法
        public function checkLogin($username,$pwd){
            
            $user=$this->field('id,m_name,pwd,jifen')->where("m_name='$username'")->find();
                
                if($user){//如果存在用户名的话
                                    if($user['pwd']==md5($pwd)){    //用用户名和密码都正确
                                        
                                        //将用户名和密码存在入session中去
                                                 session('id',$user['id']);
                                                session('m_name',$user['m_name']);
                                                
                                          //通过查找积分，查出等级
                                             $member_level=D('MemberLevel');
                                         
                                                $jifen=$user['jifen'];
                                            
                                             $res= $member_level->where("$jifen between top and bottom")->find();
                                             
                                              session('level_id',$member_level->id);
                                              session('rate',$member_level->rate/100);
                                        //将用户名和密码存进cookies
                                               if($_POST['remember']=='1'){
                                                    $time=time()+30*24*60*60;
                                                $key = C('DES_KEY');
				$un = \Think\Crypt::encrypt($user['m_name'], $key);
				$pd = \Think\Crypt::encrypt($pwd, $key);
				$aMonth = 30 * 3600 * 24;
				setcookie('username', $un, time() + $aMonth, '/', '.vshop.com');
				setcookie('password', $pd, time() + $aMonth, '/', '.vshop.com');
                                                                                            
                                                 
                                                   
                                                   
                                               }
                                            
                                                 return 1;
                                       
                                               
                                     
                                     
                                       

                           }
                           return 3;//密码错误返回3
                }
                 
                    return 2;//用户名不存在
                
        }
        
            //注册时发送邮件
    public function sendEmail($email,$code){
        $title='用户注册';
        $content="<a href='http://vshop.com/index.php/Home/Member/checkEmail/email/$email/code/$code'>点击激活你的账号</a>";
        sendMail($title,$content,$email);
    }
 
       
    
}