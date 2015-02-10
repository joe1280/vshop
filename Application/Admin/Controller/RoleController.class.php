<?php
namespace Admin\Controller;
use Think\Controller;
class RoleController extends IndexController{
   
    
    //添加角色
    public function add(){
        
                if(IS_POST){
                   
                    $roleModel=D('Role');
                    $auth_list=  implode(',', I('post.auth_list'));
                   
                        if($roleModel->create()){
                                $roleModel->add(array(
                                    'name'=>I('post.name'),
                                    'auth_list'=>$auth_list,
                                    'add_time'=>time(),
                                    'status'=>I('post.status'),
                                        
                                ));
                                $this->success('添加成功',U('lst'));
                                        exit;
                        }
                        $this->error($roleModel->getError());
                    
                }
        
        
        //取出所有权限
        $authModel=D('Auth');
        $auth_list=$authModel->select();
        
        $auth_list=$authModel->sort($auth_list);
   
        $this->assign('auth_list',$auth_list);
        
        
        
           $this->display();
    }
    
    //删除角色
    public function del($id){
        
        $roleModel=D('Role');
        if($roleModel->delete($id)){
            $this->success('删除成功',U('lst'));
            exit;
        }
            
        $this->display();
                
        
    }
    public function mdel(){
        
            if(IS_POST){
                $roleModel=D('Role');
                $ids=  implode(',', I('post.delid'));
                    if($roleModel->delete($ids)){
                        $this->success('删除成功',U('lst'));
                        exit;
                    }
                    $this->error('删除失败',U('lst'));
            }
    }
            
    
    
    //修改角色
    public function update($id){
                
        
                    if(IS_POST){
                        $roleModel=D('Role');
                       
                       $auth_list= implode(',',I('post.auth_list'));
                     
                            if($roleModel->create()){
                                   $aa= $roleModel->save(array(
                                        'id'=>$id,
                                        'name'=>I('post.name'),
                                        'auth_list'=>$auth_list,
                                        'status'=>I('post.status'),
                                        'update_time'=>time(),
                                    ));  
                                 
                                    
                                    $this->success('修改成功',U('lst'));
                                    exit;
                                
                            }
                            $this->error($roleModel->getError());
                        
                    }
        
        
        //取出角色
        $roleModel=D('Role');
        $role_info=$roleModel->find($id);
        
        //取出所有权限
        $authModel=D('Auth');
        $auth_list=$authModel->select();
        
        $auth_list=$authModel->sort($auth_list);
   
        $this->assign('auth_list',$auth_list);
        $this->assign('role_info',$role_info);
        
        
        $this->display();
                
        
    }
    
    
    //角色列表
    public function lst(){
        
        
        //取出所有角色
        $roleModel=D('Role');
        
        //联表查出角色中文名字
        $sql="select a.*,group_concat(b.name) an from v_role a left join  v_auth b on FIND_IN_SET(b.id,a.auth_list) group by a.id";
        //取出
       // $role_list=$roleModel->select()
      $role_list=  $roleModel->query($sql);
        $this->assign('role_list',$role_list);
        $this->display();
                
        
    }
    ///删除角色

}