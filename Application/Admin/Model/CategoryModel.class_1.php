<?php
namespace Admin\Model;
use Think\Model;
class CategoryModel extends Model{
    
    
        protected $_validate = array(
        array('cat_name','require','分类名称不能为空',1),
     
       
       
    );
        //分类路径方法
    protected function _before_insert(&$data, $options) {
       
        //取出分类路径方法
         $res=$this->field('cat_path')->find($data['pid']);
         
       if(!$res){
           
           $data['cat_path']=$data['pid'];
       }elseif($res['cat_path']=='0'){
          // $sql="select max(id) from v_category";
           //$aa=$this->max('id');
           //show_bug($aa);die;
         
           $this->field('cat_path')->find($data['pid']);
       $data['cat_path']= $this->cat_path.'-'.$data['pid'];
           //$this->where('id>max(id)')->find()
          
       }else{
           
               $this->field('cat_path')->find($data['pid']);
           
           $data['cat_path']= $this->cat_path.'-'.$data['pid'];
           
       }     
      
       
      
    }
    protected function _before_update(&$data, $options) {
              //$aa=$this->where('id='.$data['pid'])->select();
             
         //以前本身的ID作为查询条件
        $id=$options['where']['id'];
      
        if($data['pid']==0){
         
            $data['cat_path']='0';
                
           $this->field('cat_path')->find($id);//查出原来的路径
       
            $old_path_head=  $this->cat_path.'-'. $id;//原来旧的子类路径头
            
               $this->field('cat_path')->find($data['pid']);
            
                  $son_head=$data['pid'].'-'.$id;//新的子类数路径头
         $sql="update  v_category  set cat_path=replace(cat_path,'$old_path_head','$son_head') where cat_path like '$old_path_head%'";
                $this->execute($sql);
             
         
            
           
            
          
            //子类的头
       
        }else{ 
            
            $this->field('cat_path')->find($data['pid']);
            
             $data['cat_path']=$this->cat_path.'-'.$data['pid'];//父类的cat_path
            
             
            $son_head=$this->cat_path.'-'.$data['pid'].'-'.$id;//新的子类路径头
                $this->field('cat_path')->find($id);  //查找旧的
        //旧path头
                    $old_path_head=  $this->cat_path.'-'. $id;
               $sql="update  v_category  set cat_path=replace(cat_path,'$old_path_head','$son_head') where cat_path like '$old_path_head%'";
           $this->execute($sql);
           
           
      
            
         
       
           
            
           
          }   
           
            
       
     
           //子类根新path头
//            $ppath=$path.'-'.$options['where']['id'];//
//            
//            $likepath=  $this->cat_path.'-'.$options['where']['id'].'%';
//            
//            $replacepath=$this->cat_path.'-'.$options['where']['id'];
//            show_bug($likepath);
//            show_bug($ppath);die;
//             $sql="update v_category set `cat_path`=replace(`cat_path`,'{$replacepath}','{$cpath}') where `category_path` like '{$likepath}'";
//             $this->execute($sql);
    }

//    protected function _before_update(&$data, $options) {
//        
//        //取出分类路径方法
//         $res=$this->field('cat_path')->find($data['pid']);
//         
//       if(!$res){
//           
//           $data['cat_path']=$data['pid'];
//           $category=$this->select();
//           $this->pathSort3($category);
//       }elseif($res['cat_path']=='0'){
//          // $sql="select max(id) from v_category";
//           //$aa=$this->max('id');
//           //show_bug($aa);die;
//           $category=$this->select();
//          $this->field('cat_path')->find($data['pid']);
//          $cat_path= $this->cat_path.'-'.$data['pid'].'-'.$options['where']['id'];
//          
//        // echo $data['cat_path'];die;
//          
//          $sql="update v_category set cat_path='$cat_path' where id=".$options['where']['id'];
//          $this->execute($sql);
//      $this->field('cat_path')->find($data['pid']);
//     // show_bug($this->cat_path);die;
//         
//          $aa= $this->pathSort1($category,$options['where']['id'],$this->cat_path);
//          
//         
//      }else{
//           
//              $this->field('cat_path')->find($data['pid']);
//          $data['cat_path']= $this->cat_path.'-'.$options['where']['id'];
//          
//      }     
//          $sql="update v_category set cat_path='$cat_path' where id=".$options['where']['id'];
//          $this->execute($sql);
//        $this->pathSort1($category,$options['where']['id']);
//    }

        //写一个递归函数无限级分类
    public function catSort($category,$pid=0,$level=0){
        static $ret=array();
        
            foreach($category as $k=>$v){
                if($v['pid']==$pid){
                        $v['level']=$level;
                        $ret[]=$v;
                        //$ret[]=$v['id'];
                        $this->catSort($category, $v['id'],$level+1);
                }
            }
            return $ret;
    }
    
    
    //将上级设0
    //
    //全路径的递归 如果cat_path为０
//    public function pathSort3($category,$pid=0){
//        //static $ret=array();
//      
//        foreach($category as $k=>$v){
//               static $ret=array();
//                if($v['pid']==$pid){
//                    
//                   $this->field('cat_path')->find($pid);
//                 
//                   $cat_path= $this->cat_path.'-'.$v['id'];
//                 //   $cat_path=  $this->cat_path.'-'.$v['id'];
//                   $ret[]=  $this->cat_path;
//                  //$ret[]=$cat_path;
//                    $sql="update v_category set cat_path='$cat_path' where id=".$v['id'];
//                   
//                   $bb= $this->execute($sql);
//              
//                    $this->pathSort3($category,$v['id']);
//              //  show_bug($sql);
//                 
//                } 
//           
//                
//        }
//             return $ret;
//        
//    }
    //全路径的递归 如果cat_path为０
//    public function pathSort1($category,$pid=0,$cat_path='0'){
//        //static $ret=array();
//      
//        foreach($category as $k=>$v){
//               static $ret=array();
//                if($v['pid']==$pid){
//                    
//                   //$this->field('cat_path')->find($pid);
//                 
//                   $cat_path= $cat_path.'-'.$v['id'];
//                 //   $cat_path=  $this->cat_path.'-'.$v['id'];
//                   $ret[]=  $this->cat_path;
//                  //$ret[]=$cat_path;
//                    $sql="update v_category set cat_path='$cat_path' where id=".$v['id'];
//                   
//                   $bb= $this->execute($sql);
//              
//                    $this->pathSort1($category,$v['id'],$cat_path);
//              //  show_bug($sql);
//                 
//                } 
//           
//                
//        }
//             return $ret;
//        
//    }
     //通过子类找父类
    public function pathSort2($category,$pid=0){
        static $ret=array();
      
        foreach($category as $k=>$v){
               
                if($v['id']==$pid){
                    $ret[]=$v['pid'];
                    
                   $this->pathSort2($category,$v['pid']);
                  
              }       
                
             
                    
               
              
                
        }
        
         return $ret;
    }
    
//    protected function _after_update($data, $options) {
//        show_bug($data);
//             $category_list=$this->select();
//       //通过子类找出父类
//       $cat_path=$this->pathSort2($category_list,$data['id']);
//      // $cat_path[]=$data['id'];
//    
//    $cat_path=array_reverse($cat_path);
//     $cat_path= implode('-', $cat_path);
//       // $cat_path=$cat_path.'-'.$data['id'];
//     if($data['pid']==0){
//          
//          $cat_path='0';
//      }
//      show_bug($cat_path);die;
//        $sql="update v_category set cat_path='$cat_path' where id=".$data['id'];
//       $this->query($sql);
//            // $aa=$this->upSort($category, $data['id']);   
//            //show_bug($aa);die;
//        
//       
//       
//    }
    
    //递归更新
//    public function upSort($category,$pid){
//                
//                    foreach($category as $k=>$v){
//                        
//                                if($v['pid']==$pid){
//                                           $category_list=$this->select();
//       //通过子类找出父类
//                                         $cat_path=$this->pathSort2($category_list,$pid);
//                                         
//                                                        $cat_path=array_reverse($cat_path);
//                                                         $cat_path= implode('-', $cat_path);
//                                                        $cat_path=$cat_path.'-'.$data['id'];
//                                                       // $this->field('pid')->find($)
//                                                        
//                                                        $sql="update v_category set cat_path='$cat_path' where id=".$pid;
//                                                         $this->execute($sql);
//                                                         $this->upSort($category, $v['id']);
//                                }
//                    }
//        
//    }
    //找出所有子类
    public function childSort($category,$pid){
        static $ret=array();
        
            foreach($category as $k=>$v){
                        if($v['pid']==$pid){
                                $ret[]=$v['id'];
                                $this->childSort($category, $v['id']);
                            
                        }
            }
            return $ret;
    }
   
    
}
