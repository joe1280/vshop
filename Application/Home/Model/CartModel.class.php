<?php
namespace Home\Model;
use Think\Model;
class CartModel extends Model{
    
    
    //加入购物方法
    public function addCart($gid,$gn,$gaid){
        
        if($gaid){
                           //联表查到出属性字符串
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
                  
            }else{ //如果用户没有登录的话，就把购物的数据库存在cookies里面
                        
                     $cart=isset($_COOKIE['cart'])?unserialize($_COOKIE['cart']):array();
                  
                       $key=$gid.'-'.$gaid;  //以商品ID和属性ID作 key
                       
                       if(isset($cart[$key])){
                          $cart[$key][1]+=$gn;  //如果cookies 已经存在该商品，就累加起来
                       } else{
                             $cart[$key]=array($gastr,$gn);   //如果没有购物车没有这个商品的话
                           
                       }
                               
                          cookie('cart',  serialize($cart),3600); //将$cart组数序列化后，存进数组去
                           
                      
                              
                       
                       
                      
                       
                    
//                
//                    $cart=array(
//                        'gid'=>$gid,
//                        'amount'=>$gn,
//                        'gaid'=>$gaid,
//                        'gastr'=>$gastr,
//                    );
                  
                  
                
            }
          
        return 1;
        }
        
    }
    
    //获取购物车列表
    public function getCartList(){
        
        if(session('id')){//登录用户的话，就从数据中取出购物车列表
            $goods=array();
              $cart_list=  $this->where('mid='.  session('id'))->select(); //取出购物车列表
             
              $goodsModel=D('Goods');
              foreach($cart_list as $k=>$v){
                     $price=$goodsModel->getMemberPrice($v['gid']); //取出会员价格
                 
                     $g=$goodsModel->field('m_img,goods_name')->find($v['gid']);
                  $goods[]=array(
                      'id'=>$v['id'],
                      'gid'=>$v['gid'],
                      'gaid'=>$v['gaid'],
                      'amount'=>$v['amount'],
                      'gastr'=>$v['gastr'],
                      'price'=>$price,
                      'm_img'=>$g['m_img'],
                      'goods_name'=>$g['goods_name'],
                      'xj'=>$price*$v['amount'],
                      
                  );
                  
              }
              
            
        }else{
                //如果用户没有登录时，就购物车数据存在在COOKIE
               $cart_list=isset($_COOKIE['cart'])?unserialize($_COOKIE['cart']):array();
                $goods=array();
                 $goodsModel=D('Goods');
                            foreach($cart_list as $k=>$v){
                           
                                
                               $key=explode('-', $k);
                          
                                $price=$goodsModel->getMemberPrice($key[0]); //取出会员价格
                                
                               
                              $g=$goodsModel->field('m_img,goods_name')->find($key[0]);       //取出商品基本信息
                               
                                $goods[]=array(
                                    'gid'=>$key[0],  //商品ID
                                    'gaid'=>$key[1],  //商品属性ID
                                    'gastr'=>$v[0],
                                    'amount'=>$v[1], //购物的数量
                                    'price'=>$price,  //商品价格
                                    'xj'=>$price*$v[1],  //小计
                                    'm_img'=>$g['m_img'], // 商品中图
                                    'goods_name'=>$g['goods_name'],  //商品名称
                                );
                            }
         
                  
            
        }
        return $goods;
    }
    
    //更新购物车数量的方法
    public function upGN($gid,$gn,$gaid){
        
        if(session('id')){ //如果用户登录时 就把数据存进数据库中去
               $up_cart= $this->where(array('gid'=>$gid,'gaid'=>$gaid,'mid'=>session('id')))->find();
                 
                if($up_cart){
                    $this->save(array(
                        'id'=>$up_cart['id'],
                        'amount'=>$gn,
                    ));
                }
            
        }else{ //如果用户没有登录的话
            $cart=isset($_COOKIE['cart'])?unserialize($_COOKIE['cart']):array();
            $key=$gid.'-'.$gaid;
            if(isset($cart[$key])){
                 $cart[$key][1]=$gn;
                 cookie('cart',serialize($cart),3600);
            }
            
            
            
        }
    }
    
    //删除单个购物车商品的方法
    public function delCart($gid,$gaid){
            if(session('id')){   //如果用户登录的话
                
                    if($this->where(array('mid'=>session('id'),'gid'=>$gid,'gaid'=>$gaid))->delete()){
                          
                     }
            }else{  //如果用户没有登录的话 就删除cookies中的元素
                    $cart=  isset($_COOKIE['cart'])?unserialize($_COOKIE['cart']):array(); //将购物的COOKIES 反序化得到二维数组
                        $key=$gid.'-'.$gaid;
                        if(isset($cart[$key])){
                             unset($cart[$key]); //删除COOKIES
                             cookie('cart',serialize($cart),3600);
                          
                        }
                
            }
 
        
        
       
    }
    
    //清空购物车方法
    public function clearCart(){
        
            if(session('id')){ //如果用户登录的话，将数据库的商品清空
                $this->where('mid='.session('id'))->delete();
                
            }else{ //如果用户没有登录的话，就COOKIES清空
                cookie('cart',null);//清空购物车的COOKIE;
                    
                
            }
    }
    
    //用户登录将数据库存在数据库中，并清空cookies
    public function moveToDb(){
        
        if(session('id')){
            $cart_list=isset($_COOKIE['cart'])?unserialize($_COOKIE['cart']):array(); // 反序化
            foreach ($cart_list as $k=>$v){   //遍历存进数据库存
                $key=  explode('-',$k);  //$key=$gid.'-'gaid  商品ID-商品属性ID
               //如果数据已经存在这件商品，就合并COOKIE的数据
                $cart_info=$this->where(array('mid'=>  session('id'),'gid'=>$key[0],'gaid'=>$key[1]))->find();
                    if($cart_info){
                         $this->where(array('mid'=>  session('id'),'gid'=>$key[0],'gaid'=>$key[1]))->setInc('amount', $v[1]);
                             
                    }else{
                        /*如果数据中没有这个商品直接插进去*/
                                  $this->add(array(
                                  'mid'=>session('id'),  //会员ID
                                  'gid'=>$key[0],  //商品ID
                                  'gaid'=>$key[1], // 商品属性ID
                                  'gastr'=>$v[0], // 商品属性字符
                                  'amount'=>$v[1],  //购买数量
                   
  
                ));
                 }
            }
            cookie('cart',null); //清空购物车
            
        }
        
    }
}