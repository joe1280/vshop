<?php
namespace Admin\Controller;
use Think\Controller;
class AttrController extends IndexController{
    
    public function add(){
        if(IS_POST){
            $attrModel=D('Attr');
            if($attrModel->create()){
                     $this->attr_name=I('post.attr_name');
                        if($attrModel->add()){
                            $this->success('添加成功',U('lst'));
                                exit;
                        }
                        $this->error('添加失败');
                
            }
            $this->error($attrModel->getError());
            
        }
       
        $this->display();
    }
    
    //属性列表
    public function lst(){
        
        
        //取出所有属性
        $attrModel=D('Attr');
        $attr_list=$attrModel->select();
    
        $this->assign('attr_list',$attr_list);
        $this->display();
    }
    public function update($id){
              $attrModel=D('Attr');
                if(IS_POST){
                        if($attrModel->create()){
                                $attrModel->id=I('post.id');
                                $attrModel->attr_name=I('post.attr_name');
                                if($attrModel->save()!==FALSE){
                                    $this->success('修改成功',U('lst'));
                                        exit;
                                }
                                $this->error('修改失败',U('lst'));
                        }   
                        $this->error($attrModel->getError());
                    
                }
                
          
                $attr_info=$attrModel->find($id);
                $this->assign('attr_info',$attr_info);
        $this->display();
    }
    public function del($id){
        
            $attrModel=D('Attr');
            
            if($attrModel->delete($id)){
                
                $this->success('删除成功');
                exit;
            }
            
            $this->error('删除失败');
    }
    //批量删除
    public function mdel(){
          $attrModel=D('Attr');
        $ids=  implode(',',I('post.delid'));
            if($attrModel->delete($ids)){
                   $this->success('删除成功');
                exit;
                
            }
              $this->error('删除失败');
    }
    
}
