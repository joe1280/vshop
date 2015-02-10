<?php
namespace Admin\Model;
use Think\Model;
class AdminModel extends Model{
    
    protected $_validate = array(
        array('username','require','用户名不能为空',1),
        // array('username','','管理员已经存在',0,'unique',1),
         array('pwd','require','密码不能为空',1),
          array('repwd','require','确认密码不能为空'),
        array('repwd','pwd','两次密码不一致',0,'confirm'),
         //array('code','require','验证码不能为空'),
        array('role_id','require','角色不能为空'),
       array('role_id','require','角色不能为空'),
       // array('code','require','验证码不能为空'),
  
    );
}


