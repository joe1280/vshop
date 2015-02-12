<?php
namespace Admin\Model;
use Think\Model;
class AttrModel extends Model{
    
    
        protected $_validate = array(
        array('attr_name','require','属性名称不能为空',1),
//        array('attr_name','','属性已经存在',0,'unique',1),
//        array('attr_name','','属性已经存在',0,'unique',2),
        array('type_id','require','商品类型不能为空',1),    
         array('attr_value','require','属性可选值不能为空',1), 
        array('attr_type','require','属性类型不能为空',1), 
    );
}
