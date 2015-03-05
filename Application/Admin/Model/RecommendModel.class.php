<?php
namespace Admin\Model;
use Think\Model;
class RecommendModel extends Model {
    
   protected $_validate = array(
        array('rec_name','require','推荐名称必须填写',1),
       array('rec_name','','推荐名称已经存在',1,'unique',1),
        array('rec_type','require','推荐类型必须填写',1),
      
    );
}