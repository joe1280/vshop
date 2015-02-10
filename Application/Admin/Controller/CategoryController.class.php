<?php
namespace Admin\Controller;
use Think\Controller;
class CategoryController extends IndexController{
    
    public function add(){
         $categoryModel=D('Category');
        if(IS_POST){
           
         
            if($categoryModel->create()){
               
                                    $categoryModel->cat_name=I('post.cat_name');
                                    $categoryModel->pid=(int)I('post.pid');
                                    
                        if($categoryModel->add()){
                            $this->success('添加成功',U('lst'));
                                exit;
                        }
                        $this->error('添加失败');
                
            }
            $this->error($categoryModel->getError());
            
        }
       //取出分类属性
   
       $category_list=$categoryModel->select();
  
       $category_list=$categoryModel->catSort($category_list);
      
        $this->assign('category_list',$category_list);
        $this->display();
    }
    
    //属性列表2
    public function lst(){
        
        
        //取出所有属性
        $categoryModel=D('Category');
        //$sql="select * from v_category a left join v_attr b on a.attr_id=b.id";
            $category_list=$categoryModel->select();
          
          
       $category_list=$categoryModel->catSort($category_list);
      
       
       //show_bug($category_list);die;
        $this->assign('category_list',$category_list);
        $this->display();
    }
    public function update($id){
              $categoryModel=D('Category');
                if(IS_POST){
             
                    
                        if($categoryModel->create()){
                           
                                $categoryModel->id=I('post.id');
                                 $categoryModel->cat_name=I('post.cat_name');
                             $categoryModel->pid=(int)I('post.pid');
                           
                                if($categoryModel->save()!==FALSE){
                                    $this->success('修改成功',U('lst'));
                                        exit;
                                }
                                $this->error('修改失败',U('lst'));
                        }   
                        $this->error($categoryModel->getError());
                    
                }
                
                    //取分类
                $category_info=$categoryModel->find($id);
                $this->assign('category_info',$category_info);
                
                
       //取出分类属性
                
   
          $category_list=$categoryModel->select();
       
       $category_list=$categoryModel->catSort($category_list);
   
       //取出所有子类ID
       $cat_ids=$categoryModel->childSort($category_list,$id);
       $cat_ids[]=$id;
      
       $this->assign('cat_ids',$cat_ids);
        $this->assign('category_list',$category_list);
        $this->display();
    }
    public function del($id){
        
            $categoryModel=D('Category');
            
            if($categoryModel->delete($id)){
                
                $this->success('删除成功');
                exit;
            }
            
            $this->error('删除失败');
    }
    //批量删除
    public function mdel(){
          $categoryModel=D('Category');
        $ids=  implode(',',I('post.delid'));
            if($categoryModel->delete($ids)){
                   $this->success('删除成功');
                exit;
                
            }
              $this->error('删除失败');
    }
    
}
