<?php
namespace Admin\Model;
use Think\Model;
class TypeModel extends Model {
    
   protected $_validate = array(
        array('type_name','require','类型不能为空',1),
     //  array('type_name','','类型名称已存在',1,'unique',1),
      
    );
}