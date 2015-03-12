<?php
namespace Home\Model;
use Think\Model;
class GoodsModel extends Model{
    
    
    
    
    //获取商品库存的方法
    public function getGN($gid,$gaid){
        
        $gnModel=D('GoodsNumber');
        $gnModel->field('goods_number')->where("goods_id=$gid AND goods_attr_id='$gaid'")->find();
        return $gnModel->goods_number;
    }


    //获取会员价格
    public function getMemberPrice($id){
        
        if(session('id')){
            
            $level_id=session('level_id');
            $rate=session('rate');
        }else{
            $level_id=0;
            $rate=1;
        }
        
        //如果设会员价格就用会员价格
        $mpModel=D('MemberPrice');
        $mp=$mpModel->where('goods_id='.$id.' AND level_id='.$level_id)->find();
       
        if($mp&&$mp['price']!='0.00'){
           
            return $mp['price'];
        }else{
           
             //如果没有设会员价格就使用折扣率*本店店
              $this->field('shop_price')->find($id);
       
               return $this->shop_price*$rate;
        }
        
       
    }
    
}