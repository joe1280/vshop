<?php
namespace Home\Controller;
use Think\Controller;
class OrderController extends Controller{
    
    //提交订单
    public function add(){
        
        //取商品购物车的数据
         if(session('id')){  //只有登录后才可以提交订单
                      $cartModel=D('Cart');
                    $cart_info=$cartModel->getCartList();
             
         }else{ //否则跳到登录页面
                  session('url',__SELF__);
                 $this->error('请登录后再操作',U('Member/login'));
         }
         
            $this->assign('cart_info',$cart_info);
            $this->display();  //显示模板
        
    }
}