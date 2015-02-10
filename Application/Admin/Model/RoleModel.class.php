<?php
namespace Admin\Model;
use Think\Model;
class RoleModel extends Model{
    
            protected $_validate = array(
        array('name','require','角色名称不能为空',1),
    array('name','','角色已经存在',1,'unique',1),
        array('status','require','状态不能为空',1),
        
      
          //array('controller','require','控制名称不能为空',1),
        
            // array('action','require','方法名称不能为空',1),
           // array('action','','操作方法已经存在',1,'unique',1),
    );
}