<?php
namespace Admin\Controller;
use Think\Controller;
class BrandController extends IndexController{
    
    public function add(){
        if(IS_POST){
       
          
            $brandModel=D('brand');
            if($brandModel->create()){
                  
                        if($brandModel->add()){
                            $this->success('添加成功',U('lst'));
                                exit;
                        }
                        $this->error('添加失败');
                
            }
            $this->error($brandModel->getError());
            
        }
       //取出所有商品类型
 
        
        $this->display();
    }
    
    //属性列表
    public function lst(){
        
        
        //取出所有属性
        $brandModel=D('brand');
        
       // $sql=
      
        //$sql='SELECT * FROM v_brand a LEFT JOIN v_type b ON a.type_id=b.id ';
    $brand_list=$brandModel->select();
        $this->assign('brand_list',$brand_list);
        $this->display();
    }
    public function update($id){
              $brandModel=D('Brand');
                if(IS_POST){
                        if($brandModel->create()){
                             
                                if($brandModel->save()!==FALSE){
                                    $this->success('修改成功',U('lst'));
                                        exit;
                                }
                                $this->error('修改失败',U('lst'));
                        }   
                        $this->error($brandModel->getError());
                    
                }
                
                

                //取出要修改的属性
                $brand_info=$brandModel->find($id);
                
              
                $this->assign(array(
                 
                    'brand_info'=>$brand_info,
                    
                ));
        $this->display();
    }
    public function del($id){
        
            $brandModel=D('brand');
            
            if($brandModel->delete($id)){
                
                $this->success('删除成功');
                exit;
            }
            
            $this->error('删除失败');
    }
    //批量删除
    public function mdel(){
          $brandModel=D('brand');
        $ids=  implode(',',I('post.delid'));
            if($brandModel->delete($ids)){
                   $this->success('删除成功');
                exit;
                
            }
              $this->error('删除失败');
    }
    
}
