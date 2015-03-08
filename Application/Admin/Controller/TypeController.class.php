<?php
namespace Admin\Controller;
use Think\Controller;
class TypeController extends Controller{
    
    //添加类型
    public function add(){
            $TypeModel=D('Type');
            if(IS_POST){
                    if($TypeModel->create()){
                            $TypeModel->type_name=I('type_name');
                        if($TypeModel->add()){
                                $this->success('添加成功',U('lst'));
                                exit;
                        }
                        $this->error('添加失败SQL:'.$TypeModel->getLastSql());
                    }
                    $this->error($TypeModel->getError());
                
            }
        
       $this->display();
    }
    
   //删除类型
    public function del($id){
        
        $TypeModel=D('Type');
        if($TypeModel->delete($id)){
            
            $this->success('删除成功',U('lst'));
            exit;
        }
        $this->error('删除成功');
            
        
        $this->display();
    }
    
    //修改类型
    public function update($id){
         $TypeModel=D('Type');
      
            if(IS_POST){
                
                  if($TypeModel->create()){
                            $TypeModel->id=$id;
                            $TypeModel->type_name=I('post.type_name');
                                if($TypeModel->save()!==FALSE){
                                    $this->success('修改成功',U('lst'));
                                    exit;
                                }
                                $this->error('修改失败');
                     }
                     $this->error($TypeModel->getError());
            }
       

        //取出要修改的类型
         $type_info=$TypeModel->find($id);
         
         //传到模板上去
         $this->assign('type_info',$type_info);
           $this->display();
    }
    
    //查看类型列表
    public function lst(){
        
            $TypeModel=D('Type');
            //取出所有类型
          $type_list=  $TypeModel->select();
          
          $this->assign('type_list',$type_list);
          $this->display();
    }


    //批量删除
    public function mdel(){
        
        $ids=I('post.ids');
        $ids=  implode(',', $ids);
            $TypeModel=D('Type');
            if($TypeModel->delete($ids)){
                $this->success('删除成功',U('删除成功'));
                exit;
            }
            $this->error($TypeModel->getLastSql());
            
        $this->display();
    }
    
    
    }
    
