<?php
namespace Admin\Controller;
use Think\Controller;
class GoodsController extends  IndexController{
    
    
    //添加商品
    public function add(){
        $goodsModel=D('Goods');
                if(IS_POST){
                   
                  
                            if($goodsModel->create($_POST['Goods'])){
                               $rec_id=implode(',',$_POST['Goods']['rec_id']);
                                $goodsModel->rec_id=  implode(',',$_POST['Goods']['rec_id']);
                                $goodsModel->addtime=time();
                                //用户自增长的排序的
                                $auth_idModel=D('AutoId');
                                $auth_idModel->rec_id=$rec_id;
                                $auth_idModel->add();
                                    if($goodsModel->add()){
                                        $this->success('添加成功',U('lst'));
                                            exit;
                                    }
                              
                                    $this->error('添加失败');
                            }
                          
                            $this->error($goodsModel->getError());
                    
                    
                }
                
                //取出推荐名称
                $recModel=D('Recommend');
                $rec_list=$recModel->select();
        
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
                    'category_list'=>$category_list, //分类列表
                    'attr_value'=>$value_arr,  //属性值
                    'brand_list'=>$brand_list,  //品牌
                    'member_level_list'=>$member_level_list, //会员等级
                    'type_list'=>$type_list, //商品类型
                    'rec_list'=>$rec_list, //推荐名称列表
                    
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
        $goodslist=$goodsModel->order('id desc')->select();
        $this->assign('goodslist',$goodslist);
        $this->display();
    }
    
    public function update($id){
             //取出商品基本信息
  
        
        $goodsModel=D('Goods');
                if($_POST){
                        
           
                        if($goodsModel->create($_POST['Goods'])){
                         
                             $goodsModel->id=$_POST['id'];
                           $goodsModel->addtime=time();
                                       $rec_id=implode(',',$_POST['Goods']['rec_id']);
                                $goodsModel->rec_id=  implode(',',$_POST['Goods']['rec_id']);
                                //用户自增长的排序的
                                $auth_idModel=D('AutoId');
                                $auth_idModel->rec_id=$rec_id;
                                $auth_idModel->add();
                                if($goodsModel->save()!==false){
                                        $this->success('修改成功',U('lst'));
                                        exit;
                                }
                                
                                $this->error('修改失败');
                            
                        }
                        $this->error($goodsModel->getError());
                    
                }
        
   
        $goods_info=$goodsModel->find($id);
        
           //取出推荐名称
                $recModel=D('Recommend');
                $rec_list=$recModel->select();
       
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
       //$member_price_info=$member_priceModel->where('goods_id='.$id)->select();
       $sql='select a.level_id,a.price,a.id,b.level_name from v_member_price a left join v_member_level b on a.level_id=b.id where goods_id='.$id;
       $member_price_info=$member_priceModel->query($sql);

       //取商品类型
       $typeModel=D('Type');
       $type_list=$typeModel->select();
       
       $type_info=$typeModel->find($id);
       
       //取属性
       $attrModel=D('Attr');
       $attr_list=$attrModel->select();
       
       //联表取商品属性
       $goods_attrModel=D('GoodsAttr');
       
       $sql='select a.id,a.attr_price,a.attr_id,a.attr_value,b.attr_name,b.attr_type,b.attr_value opv from v_goods_attr a left join v_attr b on a.attr_id=b.id  where goods_id='.$id;
      $goods_attr_info=$goods_attrModel->query($sql);
  
       //取出图片
       $picModel=D('Pics');
       $pic_info=$picModel->where('goods_id='.$id)->select();
       
        $this->assign(array(
            'goods_info'=>$goods_info,
            'category_list'=>$category_list,
            'brand_list'=>$brand_list,
            'member_level_list'=>$member_level_list,
            'member_price_info'=>$member_price_info,
            'type_list'=>$type_list,
            'attr_list'=>$attr_list,
            'type_info'=>$type_info,
            'goods_attr_info'=>$goods_attr_info,
            'pic_info'=>$pic_info,
            'rec_list'=>$rec_list,
        ));
        

        $this->display();
    }
    //ajax删除图片
    public function ajaxDelPic($picid){
        
        //实例化商品图片
        $picsModel=D('Pics');
        $pics_list=$picsModel->delete($picid);
        if($pics_list){
            echo '删除成功';
        }
    }
    //更新商品
   
    //删除商品
    public function del($id){
        
        $goodsModel=D('Goods');
            if($goodsModel->delete($id)){
                $this->success('删除成功',U('lst'));
                exit;
            }
        
        
    }
    //批量删除商品
    public function mdel(){
        
        $goodsModel=D('Goods');
        $ids=I('post.delid');
        //遍历查找图片path
     
        //商品属性
           $goods_attrModel=D('GoodsAttr');
           //会员价格
              $member_priceModel=D('MemberPrice');
              
               $picsModel=D('Pics');//Pic图片
        foreach ($ids as $k=>$v){
            $goodsModel->field('o_img,b_img,m_img,s_img')->where('id='.(int)$v)->find();
            //批量删除图片
                    unlink('./Uploads/'.$goodsModel->o_img);
                    unlink('./Uploads/'.$goodsModel->b_img);
                    unlink('./Uploads/'.$goodsModel->m_img);
                    unlink('./Uploads/'.$goodsModel->s_img);
                     
                        //批量删除多个属性
                        $goods_attrModel->where('goods_id='.(int)$v)->delete();
                        
                                    //批量删除会员价格
                
                    $member_priceModel->where('goods_id='.(int)$v)->delete();
                    
                                    //批量删除pic图片
                    
                    
      //删除实体的商品图片
      
     $pics= $picsModel->where('goods_id='.$v)->select();
        foreach($pics as $kk=>$vv){
            
            
                    unlink('./Uploads/'.$vv['o_pic']);//删除原图片

                   unlink('./Uploads/'.$vv['m_pic']);//删除中图片
                    unlink('./Uploads/'.$vv['s_pic']);//删除小图片

               
            
        }
            $picsModel->where('goods_id='.$v)->delete();


        }
         
        $ids=  implode(',',$ids);
     
        if($goodsModel->delete($ids)){
            
            $this->success('批量删除成功');
            exit;
        }
        
    }
}

