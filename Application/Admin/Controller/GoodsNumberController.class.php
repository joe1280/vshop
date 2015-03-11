<?php
namespace Admin\Controller;
use Think\Controller;
class GoodsNumberController extends IndexController{
    
    //添加商品库存
    public function add($gid){
        
        //商品库存
        $gnModel=D('GoodsNumber');
        $goods_id=$gid;
        
 
            if($_POST){
         //  show_bug($_POST);
                //删除原来的库存
              $gnModel->where('goods_id='.$gid)->delete();
                $goods_attr_id=I('post.goods_attr_id');//商品属性ID
          
                $goods_number=I('post.goods_number');
                 
                  
                  foreach($goods_number as $k=>$v){
                       $new_gn=array();
                   
                      
                                foreach($goods_attr_id as $k1=>$v1){
                                            $new_gn[]=$v1[$k]; //组成一个新的数组
                                            
                                    

                                }
                                     sort($new_gn); //数据升序排序列
                                     
                                     //去掉重复的属性
                                     
                                 $new_gn=   implode(',', $new_gn);
                                     $gaid=$gnModel->field('goods_attr_id')->where("goods_attr_id='$new_gn'")->find();
                                     //不重复再存在进去
                                     if(!$gaid){ 
                                         
                                                            $gnModel->add(array(
                                                       'goods_id'=>$goods_id,
                                                      'goods_number'=>$v,
                                                      'goods_attr_id'=> $new_gn,

                                                 ));
                                         
                                     }
                                     
                               
                  }
            
            
                     
                
         
              
                        
                                       
                 $this->success('添加成功');
                 exit;
                               
                                      
                                        
                          
                              
                        
                       
                      
                           
                            
                    
  
            }
            
            
                //联表取出所有属性
            $attrModel=D('Attr');
           
           // $attr_info=$gaModel->where('goods_id='.$goods_id)->select();
            $sql='select a.attr_name,a.attr_value bav,b.* from v_attr a left join v_goods_attr b on a.id=b.attr_id where goods_id='.$goods_id.' and attr_id in(select attr_id from v_goods_attr where goods_id='.$goods_id.' group by attr_id HAVING count(*)>1'. ')';
            
      
            $ga_info=$attrModel->query($sql);
            //  show_bug($attrModel->getLastSql());
           // show_bug($gn_info);
            //传到模板去
            //show_bug($ga_info);
            //组成一个新的数据
            $attrData=array();
            foreach($ga_info as $k=>$v){
                
                $attrData[$v['attr_id']][]=$v;
            }
        //    show_bug($attrModel->getLastSql());
            //show_bug($gn_info);
           // show_bug($attrData);
            //show_bug($attrData);die;
            //取商品库的数据
            $gn_info=$gnModel->where('goods_id='.$gid)->select();
       
            $this->assign(array(
                'gn_info'=>$gn_info,
                'attrData'=>$attrData,
            ));
               $this->display();
    }
    
    public function update($id){
        
        
    }

    //ajax删除商品库存
    public function ajaxDelGn($gnid){
        
        $gnModel=D('GoodsNumber');
        if($gnModel->delete($gnid)){
            echo '删除成功';
        }else{
            
            echo '删除失败';
        }
    }
     
    
}
