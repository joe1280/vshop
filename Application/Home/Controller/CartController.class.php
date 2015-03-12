<?php
namespace Home\Controller;
use Think\Controller;
class CartController extends Controller{
    
    //添加类型
    public function addCart($id){
            $CartModel=D('Cart');
            if(IS_POST){
                
          
                    if($CartModel->create()){
                           //show_bug($_POST);die;
//                        $CartModel->mid=session('id'); //会员ID
//                        $CartModel->gid=$id;  //商品ID
//                        $CartModel->gaid=  implode(',', I('gaId'));
                        
                       
                       
                        $gaid=I('gaId'); //接收属性ID
                     
                         sort($gaid); //升序排序
                         
                        $gaid= implode(',', $gaid); //商品属性ID
                        $gn=I('amount');  //购买数量
                        
                          $cart=$CartModel->addCart($id,$gn,$gaid);    //加入购物车的该
                         if($cart==1){
                        
                      
                            
                       
                                $this->success('加入成功',U('index'));
                                exit;
                        }elseif($cart==2){
                            
                                $this->error('抱歉,你的购物车数量已经超过库存量'); //购买数量超过库存时
                        }
                      
                   }
                    
                    $this->error($CartModel->getError());
                
            }
        
       $this->display();
    }
    
   //删除类型
    public function del($id){
        
        $CartModel=D('Cart');
        if($CartModel->delete($id)){
            
            $this->success('删除成功',U('lst'));
            exit;
        }
        $this->error('删除成功');
            
        
        $this->display();
    }
    
    //修改类型
    public function update($id){
         $CartModel=D('Cart');
      
            if(IS_POST){
                
                  if($CartModel->create()){
                            $CartModel->id=$id;
                            $CartModel->cart_name=I('post.cart_name');
                                if($CartModel->save()!==FALSE){
                                    $this->success('修改成功',U('lst'));
                                    exit;
                                }
                                $this->error('修改失败');
                     }
                     $this->error($CartModel->getError());
            }
       

        //取出要修改的类型
         $cart_info=$CartModel->find($id);
         
         //传到模板上去
         $this->assign('cart_info',$cart_info);
           $this->display();
    }
    
    //查看类型列表
    public function index(){
        
            $CartModel=D('Cart');
            
            $cart_list=$CartModel->getCartList();
            
            session('url',__ACTION__);
          
       
        
          
          $this->assign('cart_list',$cart_list);
          $this->display();
    }


    //批量删除
    public function mdel(){
        
        $ids=I('post.ids');
        $ids=  implode(',', $ids);
            $CartModel=D('Cart');
            if($CartModel->delete($ids)){
                $this->success('删除成功',U('删除成功'));
                exit;
            }
            $this->error($CartModel->getLastSql());
            
        $this->display();
    }
    
    
    //更新购物车的库存
            public function ajaxUpGN($gid,$gn,$gaid){
                    
                $cartModel=D('Cart');
                //取出商品总库存
                $total_gn=D('Goods')->getGN($gid,$gaid);
                if($gn>$total_gn){
                      $cartModel->upGN($gid,$total_gn,$gaid);
                   
                        echo $total_gn;
                }else{
                         $cartModel->upGN($gid,$gn,$gaid);
                       echo $total_gn;
                }
              

            }
            
      //删除购物车的方式
      public function ajaxDelCart($gid,$gaid){
            
          $cartModel=D('Cart');
         $cartModel->delCart($gid,$gaid);
            
        
          
      }
      
      //清空购物车
      public function ajaxClearCart(){
          D('Cart')->clearCart();
      }
    
    }
    
