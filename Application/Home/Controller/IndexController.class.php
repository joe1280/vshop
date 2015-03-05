<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    
    
    public function __construct() {
        parent::__construct();
//                    if(cookie('id')){//取出ID
//             //查数据库
//            $memberModel=D('Member');
//           $id= $memberModel->field('id='.cookies('id'))->find();
//                        if($id){
//
//                                  session('id',$id['id']);
//                        }
//                        
//                        //如果存在COOKIE 的用户名
//                        if(cookie('m_name')){
//                            $m_name=  cookie('m_name');
//                                 $m_name= $memberModel->field("m_name='$m_name'")->find();
//                            
//                        }
//          
//        } 
  
                if(!session('id')){//如果不存在sessionID，就从cookie中取得用户ID
                       
                       $username=  cookie('m_name');//用户名
                       $pwd=  cookie('pwd');//密码
                        
                        if($username&&$pwd){//如果cookies同时存在用户和密码
                               echo 11; 
                                $memberModel=D('Member');
                            
                                if($memberModel->create(array( 'm_pwd'=>$username,'pwd'=>$pwd,))){ //字段验证
                                        if($memberModel->checkLogin($username,$pwd)==1){
                                                       
                                                    $this->success('登录成功',U('index'));
                                            
                                        }else{
                                            //清空cookies
                                            setcookie('m_name','',1);
                                            setcookie('pwd','',1);         
                                        }
                                }
                                   
                                    
                              
                                
                                
                                
                        }
                    
                }
        
        
        
    }


    public function index(){

            //初始化页面
        
               $goodsModel=D('Goods');
               //取出所有的商品
               
        //取出疯狂抢购的商品
       $sql="select a.id as gid,a.goods_name,a.m_img,a.shop_price,b.* from v_goods a left join v_recommend b   on FIND_IN_SET(b.id,a.rec_id) where b.rec_name='疯狂抢购' order by a.id  desc limit 5 ";
           //$sql="select c.id cid,a.id goods_id,a.goods_name,b.* from v_goods a left join v_recommend b on FIND_IN_SET(b.id,a.rec_id)  left join v_auto_id c  on FIND_IN_SET(b.id,c.rec_id) where b.rec_name='疯狂抢购'";
       $rec_goods= $goodsModel->query($sql);
    
    // show_bug($rec_goods);
     //传递到模板去
       $this->assign('rec_goods',$rec_goods);
       
        

        
    //显示分类
   $this->assign('display','show'); 
   
   //显示标题
   $this->assign('title','首页');
   $this->assign('css',array('index'));
   $this->assign('js',array('index'));
        $this->display();
    }
    
        public function goods($id){
        //隐藏分类
           //显示标题
            //取出所有商器
            $goodsModel=D('Goods');
           $goods_info=$goodsModel->where("is_on_sale='1' AND id=".$id)->find();
            
       //取出所有浏览的图片图片
           $picsModel=D('Pics');
           $pics_info=$picsModel->where('goods_id='.$id)->select();
           
            $this->assign(array(
                'title'=>'商品页面',
                'js'=>array('goods','jqzoom-core'),
                'css'=>array('goods','common','jqzoom'), //商品样式
                'goods_info'=>$goods_info, //商品基本信息
                'pics_info'=>$pics_info,
            ));
        $this->display();
    }
    
    //推出位商品
    public function recGoods(){
        
        $goodsModel=D('Goods');
        //取出疯狂抢购
       $sql="select a.*,b.* from v_goods a left join v_recommend b   on FIND_IN_SET(b.id,a.rec_id) where b.rec_name='疯狂抢购' order by a.id  desc limit 5 ";
           //$sql="select c.id cid,a.id goods_id,a.goods_name,b.* from v_goods a left join v_recommend b on FIND_IN_SET(b.id,a.rec_id)  left join v_auto_id c  on FIND_IN_SET(b.id,c.rec_id) where b.rec_name='疯狂抢购'";
       $rec_goods= $goodsModel->query($sql);
    
     //传递到模板去
       $this->assign('rec_goods',$rec_goods);
       $this->display();
        
    }
}