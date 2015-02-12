<?php
namespace Admin\Controller;
use Think\Controller;
class AttrController extends IndexController{
    
    public function add(){
        if(IS_POST){
           // show_bug($_POST);die;
            $attrModel=D('Attr');
            if($attrModel->create()){
                   $attr_value= trim(str_replace('，',',',I('post.attr_value')));
                   $attrModel->attr_value=$attr_value;
                        if($attrModel->add()){
                            $this->success('添加成功',U('lst'));
                                exit;
                        }
                        $this->error('添加失败');
                
            }
            $this->error($attrModel->getError());
            
        }
       //取出所有商品类型
        $TypeModel=D('Type');
        $type_list=$TypeModel->select();
        $this->assign('type_list',$type_list);
        
        $this->display();
    }
    
    //属性列表
    public function lst(){
        
        
        //取出所有属性
        $attrModel=D('Attr');
        
        $sql=
      
        //$sql='SELECT * FROM v_attr a LEFT JOIN v_type b ON a.type_id=b.id ';
      $attr_list=$attrModel->alias('a')->field('a.*,b.type_name')->join(' LEFT JOIN v_type b ON a.type_id=b.id')->select();
        $this->assign('attr_list',$attr_list);
        $this->display();
    }
    public function update($id){
              $attrModel=D('Attr');
                if(IS_POST){
                        if($attrModel->create()){
                               $attr_value= trim(str_replace('，',',',I('post.attr_value')));
                              $attrModel->attr_value=$attr_value;
                                if($attrModel->save()!==FALSE){
                                    $this->success('修改成功',U('lst'));
                                        exit;
                                }
                                $this->error('修改失败',U('lst'));
                        }   
                        $this->error($attrModel->getError());
                    
                }
                
                        //取出所有商品类型
               $TypeModel=D('Type');
               $type_list=$TypeModel->select();
              

                //取出要修改的属性
                $attr_info=$attrModel->find($id);
                
              
                $this->assign(array(
                    'type_list'=>$type_list,
                    'attr_info'=>$attr_info,
                    
                ));
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
