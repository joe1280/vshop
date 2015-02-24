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
                
                //取出所有商品类型
                $typeModel=D('Type');
                $type_list=$typeModel->select();
                
                
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
                    'type_list'=>$type_list,
                    
                ));
        
        
        $this->display();
    }
    
    //添加时使用
    public function ajaxGetAttr($type_id){
        
        //取出商品属性
        $attrModel=D('Attr');
        $attr_info=$attrModel->where('type_id='.$type_id)->select();
        
        echo json_encode($attr_info);
    }
    
//        public function ajaxEditAttr($type_id){
//        
//        //取出商品属性
//        $attrModel=D('Attr');
//        $attr_info=$attrModel->where('type_id='.$type_id)->select();
//        
//       // echo json_encode($attr_info);
//       show_bug($attr_info);
//        //取出商品属性
//        $goodsModel=D('Goods');
//       $goods=$goodsModel->field('id')->where('type_id='.$type_id)->find();
//       show_bug($goods);
//        $goods_attrModel=D('GoodsAttr');
//        $goods_attr_info=$goods_attrModel->where('goods_id='.$goods['id'])->select();
//    
//  
//    }
    //商品列表
    public function lst(){
        
        //取出所有商品
        $goodsModel=D('Goods');
        $goodslist=$goodsModel->select();
        $this->assign('goodslist',$goodslist);
        $this->display();
    }
    
    public function update($id){
        
        
        //取出商品基本信息
        $goodsModel=D('Goods');
        $goods_info=$goodsModel->find($id);
        
       
        //取出所有分类
        $categoryModel=D('Category');
        $category_list=$categoryModel->select();
                //取出商品品牌
       $brandModel=D('Brand');
       $brand_list=$brandModel->select();
       
       //取出会员等级
       $member_levelModel=D('MemberLevel');
       $member_level_list=$member_levelModel->select();
       
       //取出会员价格
       $member_priceModel=D('MemberPrice');
       //取出要所修改的会员价格
       $member_price_info=$member_priceModel->where('id='.$id)->select();
       
       //取商品类型
       $typeModel=D('Type');
       $type_list=$typeModel->select();
       
       $type_info=$typeModel->find($id);
       
       //取属性
       $attrModel=D('Attr');
       $attr_list=$attrModel->select();
       
       //取商品属性
       $goods_attrModel=D('GoodsAttr');
       $goods_attr_list=$goods_attrModel->find($id);
    
       
    
        $this->assign(array(
            'goods_info'=>$goods_info,
            'category_list'=>$category_list,
            'brand_list'=>$brand_list,
            'member_level_list'=>$member_level_list,
            'member_price_info'=>$member_price_info,
            'type_list'=>$type_list,
            'attr_list'=>$attr_list,
            'type_info'=>$type_info,
            'goods_attr_list'=>$goods_attr_list,
        ));
        

        $this->display();
    }
    
}

