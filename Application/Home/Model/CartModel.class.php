<?php
namespace Home\Model;
use Think\Model;
class CartModel extends Model{
    
    public function addCart($gid,$gn,$gaid){
        
        if($gaid){
            
            $sql="select group_concat(concat(b.attr_name, ':' ,a.attr_value) separator '<br/>') gastr from v_goods_attr a  left join v_attr  b on a.attr_id=b.id where a.id IN($gaid)";
            //$sql='select * from v_goods_attr a  left join v_attr  b on a.attr_id=a.id where a.id IN('.$gaid.')';
            
            $ga=$this->query($sql);
            $gastr=$ga[0]['gastr'];
            
            //如果用户登录的话，就数据存在数据库
            if(session('id')){
                    
                        
                        $cart_info=$this->where('gid='.$gid." AND gaid='$gaid' AND mid=".session('id'))->find();
                            if($cart_info){ //如果购物已经有这个件商品，那么直接叠加他的数量
                                            //查库存
                                            $gnModel=D('Goods');
                                           $gn_info= $gnModel->getGN($gid,$gaid);
                                         
                                           $amount=$cart_info['amount']+$gn; //购物车总数量
                                     
                                           if($amount>$gn_info){  //如果购物数量大于库存
                                                      return 2;
                                               }
                                            
                                       
                                        
                                //   用这个也用的 $this->where('gid='.$gid." AND gaid='$gaid' AND mid=".session('id'))->setInc('amount', $gn);
                                $this->save(array(
                                    'id'=>$cart_info['id'],
                                    'amount'=>$cart_info['amount']+$gn,
                                ));
                                
                            }else{
                                        //如果没有购物车没有这件商品，就直接插入
                                        $this->add(array(
                                       'mid'=>session('id'),
                                       'gid'=>$gid,
                                       'amount'=>$gn,
                                       'gaid'=>$gaid,
                                       'gastr'=>$gastr,
                    ));
                            }
                  
            }
          
        return 1;
        }
        
    }
    
    //获取购物车列表
    public function getCartList(){
        
        if(session('id')){//登录用户的话，就从数据中取出购物车列表
            $goods=array();
              $cart_list=  $this->where('mid='.  session('id'))->select(); //取出购物车列表
              $mpModel=D('MemberPrice');
              $goodsModel=D('Goods');
              foreach($cart_list as $k=>$v){
                     $price=$mpModel->getMemberPrice($v['gid']); //取出会员价格
                     $g=$goods->field('m_img,goods_name')->find($v['gid']);
                  $goods[]=array(
                      'amount'=>$v['amount'],
                      'gastr'=>$v['gastr'],
                      'price'=>$price,
                      'm_img'=>$g['m_img'],
                      'goods_name'=>$g['goods_name'],
                      'xj'=>$price*$v['amount'],
                  );
                  
              }
                
            
        }
    }
}