<?php
namespace Admin\Controller;
use Think\Controller;
class GoodsController extends  IndexController{
    
    
    //添加商品
    public function add(){
        $goodsModel=D('Goods');
                if(IS_POST){
                   
                            if($goodsModel->create($_POST['Goods'])){
                                    if($goodsModel->add()){
                                        $this->success('添加成功');
                                            exit;
                                    }
                                    $this->error('添加失败');
                            }
                          
                            $this->error($goodsModel->getError());
                    
                    
                }
        
        //取出所有分类
                $categoryModel=D('Category');
                $category_list=$categoryModel->catSort($categoryModel->select());
                
                //取出所有品牌
                $brandModel=D('Brand');
                $brand_list=$brandModel->select();
                
                //取出会员等级
                $member_levelModel=D('MemberLevel');
                $member_level_list=$member_levelModel->select();
                
                
                //取出所有属性和和属性值 
                $attrModel=D('Attr');
                $sql="select a.*,b.attr_name from v_value a left join v_attr b on b.id=a.attr_id";
               $attr_value=$attrModel->query($sql);
               //把$attr_value变成三维数组
               //show_bug($attr_value);
               $value_arr=array();
               foreach($attr_value as $k=>$v){
                   
             $value_arr[$v['attr_name']][]=array('id'=>$v['id'],'attr_value'=>$v['value_name']);
                
                   
               }
                    
               
                $this->assign(array(
                    'category_list'=>$category_list,
                    'attr_value'=>$value_arr,
                    'brand_list'=>$brand_list,
                    'member_level_list'=>$member_level_list,
                    
                ));
        
        
        $this->display();
    }
    
}

