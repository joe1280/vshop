<?php
namespace Admin\Model;
use Think\Model;
class ValueModel extends Model{
    
    
        protected $_validate = array(
        array('value_name','require','属性值名称不能为空',1),
        //array('value_name','','属性值已经存在',0,'unique',1),
       
        array('attr_id','require','属性值不能为空',0),
    );
}
