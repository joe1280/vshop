<?php
namespace Admin\Controller;
use Think\Controller;
class AuthController extends IndexController{
    
    //添加权限
    public function add(){
                $authModel=D('Auth');
                if(IS_POST){
                           
                                    
                                    
                    
                  
                       
                            if($authModel->create()){
                                   $aa= $authModel->add(array(
                                        'name'=>I('post.name'),
                                        'pid'=>I('post.pid'),
                                        'module'=>I('post.module'),
                                        'controller'=>I('post.controller'),
                                        'action'=>I('post.action'),
                                       
                                    ));
                                
                                    $this->success('添加成功',U('lst'));
                                    exit;
                            }
                            $this->error($authModel->getError());
                    
                }
           //取出有所有权限
              $auth_list= $authModel->select();
              $auth_list=$authModel->sort($auth_list);
              $this->assign('auth_list',$auth_list);
        $this->display();
        
    }
        //删除权限
      //删除权限
    public function del($id){
        
        $authModel=D('Auth');
        //取出所有子孙ID
        $child_ids=$authModel->idSort($authModel->select(),$id);
        
        //当前ID也放进去
        $child_ids[]=$id;
        
        //把数组转化成字符串
        $child_ids=  implode(',', $child_ids);
        
       
        
        if($authModel->delete($child_ids)){
            
            $this->success('删除成功',U('lst'));
            exit;
        }
        $this->error('删除失败');
    }
    
    
    //批量删除
    public function mdel(){
        
        
        if(IS_POST&&!empty($_POST)){
            $authModel=D('Auth');
            $ids=I('post.delid');
          
                $ids_arr=array();
                    foreach($ids as $k=>$v){
                        
                       //$ids_arr[]=$authModel->idSort($authModel->select(),$v);
                        $son_ids=$authModel->idSort($authModel->select(),$v);
                        $ids_arr=array_merge($ids_arr,$son_ids);
                       $ids_arr[]=$v;
                         
                     
                    }
                       $son_ids=  implode(',',$ids_arr);
                           
                                    if($authModel->delete($son_ids)) {
                                          $this->success('删除成功');
                                        exit;
                                    }
                    
                  
                    
            
        }
        $this->error('删除失败');
        
    }





    //修改权限
    public function update($id){
         $authModel=D('Auth');
            if(IS_POST){     var_dump($_POST['pid']);
                
                            if($authModel->create()){
                                   $aa= $authModel->save(array(
                                       'id'=>$id,
                                        'name'=>I('post.name'),
                                        'pid'=>I('post.pid'),
                                        'module'=>I('post.module'),
                                        'controller'=>I('post.controller'),
                                        'action'=>I('post.action'),
                                     
                                    ));
                                 
                                    $this->success('修改成功',U('lst'));
                                    exit;
                            }
                            $this->error($authModel->getError());
            }
       
        
        $authModel=D('Auth');
        //取出权限
            $auth_info=$authModel->find($id);
            $auth_list= $authModel->select();
            $auth_list=$authModel->sort($auth_list);
              $this->assign(array(
                  'auth_info'=>$auth_info,
                  'auth_list'=>$auth_list,
              ));
        $this->display();
        
    }
        //权限列表
    public function lst(){
         $authModel=D('Auth');
        //取出有所有权限
              $auth_list= $authModel->select();
             $auth_list= $authModel->sort($auth_list);
           
           
              $this->assign('auth_list',$auth_list);
        $this->display();
        
    }
    
}

