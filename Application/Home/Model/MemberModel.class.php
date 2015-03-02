<?php
namespace Home\Model;
use Think\Model;
class MemberModel extends Model{
    
    
        protected $_validate = array(
        array('m_name','require','会员名称不能为空',1),
        array('m_name','','会员名称已经存在',0,'unique',1),
         array('pwd','require','密码不能为空',1),
          array('pwd2','require','确认密码不能为空'),
        array('pwd2','pwd','两次密码不一致',0,'confirm'),
         //array('code','require','验证码不能为空'),
        array('m_email','email','邮箱格式不正确',1),
        array('checkcode','require','验证码不能为空',1),
       //array('role_id','require','角色不能为空'),
       // array('code','require','验证码不能为空'),
  
    );
}