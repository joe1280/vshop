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
              
                //删除原来的库存
              $gnModel->where('goods_id='.$gid)->delete();
                $goods_attr_id=I('post.goods_attr_id');//商品属性ID
                  
                $goods_number=I('post.goods_number');
                  $new_gn=array();
                 foreach($goods_attr_id as $k=>$v){
                          
                        foreach($v as $kk=>$vv){
                            $new_gn[$kk][]=$vv;
                            //升序排列
                           
                   }         
                            
                 }            
                            
                
                     
                
                    
                  //升序排列
                  sort($new_gn);
             
               //  show_bug($_POST);die;
                 // die;
                 
                      
              
                        
                                          foreach($new_gn as $k=>$v){
                                              $gnModel->goods_id=$goods_id;
                                              $gnModel->goods_attr_id=  implode(',', $v);
                                               $gnModel->goods_number=$goods_number[$k];
                                                $gnModel->add();
                                       
                            
                                          
                 }
                 $this->success('添加成功');
                 exit;
                               
                                      
                                        
                          
                              
                        
                       
                      
                           
                            
                    
  
            }
            
            
                //联表取出所有属性
            $attrModel=D('Attr');
           
           // $attr_info=$gaModel->where('goods_id='.$goods_id)->select();
            $sql='select a.attr_name,a.attr_value bav,b.* from v_attr a left join v_goods_attr b on a.id=b.attr_id where goods_id='.$goods_id.' and attr_id in(select attr_id from v_goods_attr where goods_id='.$goods_id.') group by attr_id';
            $ga_info=$attrModel->query($sql);
           // show_bug($gn_info);
            //传到模板去
        

            //取商品库的数据
            $gn_info=$gnModel->where('goods_id='.$gid)->select();
       //   show_bug($gn_info);
            $this->assign(array(
                'ga_info'=>$ga_info,
                'gn_info'=>$gn_info,
            ));
               $this->display();
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
