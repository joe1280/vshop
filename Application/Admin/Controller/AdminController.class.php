<?php
namespace Admin\Controller;
use Think\Controller;
class AdminController extends IndexController{
    
    //添加管理员
    public function add(){
        
                if(IS_POST){
                    
                    $adminModel=D('Admin');
                        if($adminModel->create()){//收集表单
                                    $adminModel->username=I('post.username');
                                    $adminModel->pwd=md5(I('post.pwd'));
                                    $adminModel->role_id=I('post.role_id');
                                  
                                  
                                    $adminModel->status=I('post.status');
                                        if($adminModel->add()){//插入数据库
                                            $this->success('添加成功',U('lst'));
                                                exit;
                                    
                                }
                                $this->error('添加失败,SQL:'.$adminModel->getLastSql());//插入失败返回错误信息
                        }
                        $this->error($adminModel->getError());//验证表单出错时，返回错误信息
                }
                
                //取出所有角色
               $roleModel=D('Role');
               $role_list=$roleModel->select();
               $this->assign('role_list',$role_list);
        $this->display();
    }
    
    //删除管理员
    public function del($id){
        $adminModel=D('Admin');
            if($adminModel->delete($id)){
                
                $this->success('删除成功',U('lst'));
                    exit;
            }
            $this->error('删除失败');
               
          $this->display();
        
    }
    
    public function mdel(){
        $adminModel=D('Admin');
        
        $ids=implode(',',I('post.delid'));
                if($adminModel->delete($ids)){
                    $this->success('删除成功');
                    exit;
                }
                    $this->error('删除失败');
                            
    }

        //修改管理员
    public function update($id){
          $adminModel=D('Admin');
                if(IS_POST){
                
                            if($adminModel->create()){
                                        $adminModel->usename=I('post.username');
                                        $adminModel->pwd=md5(I('post.pwd'));
                                        $adminModel->status=I('post.status');
                                        $adminModel->role_id=I('post.role_id');
                                    if($adminModel->save()){
                                        $this->success('修改成功',U('lst'));
                                        exit;
                                    }
                                    $this->error('修改失败SQL:'.$adminModel->getLastSql());
                            }
                            $this->error($adminModel->getError());
                }
                
         
           //取出管员
           $admin_info=$adminModel->find($id);
           
           //取出所有角色
           $roleModel=D('Role');
                   $role_list=$roleModel->select();
                   $this->assign(array(
                       'admin_info'=>$admin_info,
                       'role_list'=>$role_list,
                   ));
          $this->display();
    }
    
    //管理员列表
    public function lst(){
        
        
        $adminModel=D('Role');
            //联表v_role查出角色中文名
        $sql="select a.*,b.name role_name from v_admin a left join v_role b on a.role_id=b.id";
        
        $admin_list=$adminModel->query($sql);
        
        $this->assign('admin_list',$admin_list);
                
        
          $this->display();
        
    }

}



