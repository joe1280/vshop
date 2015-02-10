<?php
namespace Admin\Model;
use Think\Model;
class AuthModel extends Model{
    
        protected $_validate = array(
        array('name','require','权限名称不能为空',1),
        array('name','','权限已经存在',1,'unique',1),
        array('pid','require','上级权限不为空',1),
        array('module','require','模块名称不能为空',1),
          //array('controller','require','控制名称不能为空',1),
        
            // array('action','require','方法名称不能为空',1),
           // array('action','','操作方法已经存在',1,'unique',1),
    );
        
        //无限级分类方法取出所有权限
        public function sort($auth_list,$pid=0,$level=0){
            static  $ret=array();
            
                    foreach($auth_list as $k=>$v){
                            if($v['pid']==$pid){
                                $v['level']=$level;
                           
                               
                                $ret[]=$v;
                            
                                 $this-> sort($auth_list,$v['id'],$level+1);
                                
                            }
                             
                    }
                       
                    return $ret;
        }
        
        //无限级取出子类ID
        public function idSort($auth_list,$pid=0){
            static $ret=array();
            foreach($auth_list as $k=>$v){
                    if($v['pid']==$pid){
                            $ret[]=$v['id'];
                            $this->idSort($auth_list,$v['id']);
                        
                    }
                    
                
            }
            return $ret;
            
        }


        protected function _before_insert(&$data, $options) {
           
           
           if($data['pid']==0){
               $data['level']==0;
           }  else {
              
               
               
              $level= $this->where('id='.$data['pid'])->find();
            
                $data['level']=$level['level']+1;
           }
           
        
       
        }
        
               //更新要递归调度
           protected function _before_update(&$data, $options) {
               
               show_bug($options);
                    if($data['pid']=='0'){
                        $data['level']=0; 
                        
                       $auth_list=$this->select();
                       $this->_update_child_auth($auth_list,$options['where']['id'],$data['level']);
                        
                    }else{
                        $this->field('level')->find($data['pid']);
                        $data['level']=  $this->level+1;
                       // echo $data['level'];
                   
                        $auth_list=$this->select();
                       $this->_update_child_auth($auth_list,$options['where']['id'],$data['level']);
                      
                        
                    }
                    
                    
                    
                //$auth_list=$this->select();
//              $auth= $this->sort($auth_list);
//              foreach($auth as $k=>$v){
//                  
//                  $sql="update v_auth set level=".$v['level'].' where id='.$k;
//                  
//              }
//              show_bug($auth_list);die;
               
           }




           //更新要递归调度
        public function _update_child_auth($auth_list,$pid=0,$level=0){
            
            static $ret=array();
                    foreach($auth_list as $k=>$v){
                        if($v['pid']==$pid){
                            $v['level']=$level;
                                    $sql="update v_auth set level=".($level+1).' where id='.$v['id'];
                                    $this->execute($sql);
                                    $this->_update_child_auth($auth_list,$v['id'],$level+1);
                        }
                    }
        }
                
                
                
                
                
                
        
   
        
          
}
