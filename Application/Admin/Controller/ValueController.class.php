<?php
namespace Admin\Controller;
use Think\Controller;
class ValueController extends IndexController{
    
    public function add(){
        if(IS_POST){
            $valueModel=D('Value');
            if($valueModel->create()){
               
                                    $valueModel->value_name=I('post.value_name');
                                    $valueModel->attr_id=(int)I('post.attr_id');
                        if($valueModel->add()){
                            $this->success('添加成功',U('lst'));
                                exit;
                        }
                        $this->error('添加失败');
                
            }
            $this->error($valueModel->getError());
            
        }
       //取出所有属性
        $attrModel=D('Attr');
        $attr_list=$attrModel->select();
        $this->assign('attr_list',$attr_list);
        $this->display();
    }
    
    //属性列表
    public function lst(){
        
        
        //取出所有属性
        $valueModel=D('Value');
        $sql="select * from v_value a left join v_attr b on a.attr_id=b.id";
        $value_list=$valueModel->alias('a')->field('a.*,b.attr_name')->join(' left join v_attr b on a.attr_id=b.id')->select();
    
        $this->assign('value_list',$value_list);
        $this->display();
    }
    public function update($id){
              $valueModel=D('Value');
                if(IS_POST){
                        if($valueModel->create()){
                                $valueModel->id=I('post.id');
                                $valueModel->value_name=I('post.value_name');
                                $valueModel->attr_id=(int)I('post.attr_id');
                                if($valueModel->save()!==FALSE){
                                    $this->success('修改成功',U('lst'));
                                        exit;
                                }
                                $this->error('修改失败',U('lst'));
                        }   
                        $this->error($valueModel->getError());
                    
                }
                
                    //取属性值
                $value_info=$valueModel->find($id);
                $this->assign('value_info',$value_info);
                
                //取出所有属性
        $attrModel=D('Attr');
        $attr_list=$attrModel->select();
        $this->assign('attr_list',$attr_list);
        $this->display();
    }
    public function del($id){
        
            $valueModel=D('Value');
            
            if($valueModel->delete($id)){
                
                $this->success('删除成功');
                exit;
            }
            
            $this->error('删除失败');
    }
    //批量删除
    public function mdel(){
          $valueModel=D('Value');
        $ids=  implode(',',I('post.delid'));
            if($valueModel->delete($ids)){
                   $this->success('删除成功');
                exit;
                
            }
              $this->error('删除失败');
    }
    
}
