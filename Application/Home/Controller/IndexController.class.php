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
       $sql="select a.id as gid,a.goods_name,a.m_img,a.shop_price,b.* from v_goods a left join v_recommend b   on FIND_IN_SET(b.id,a.rec_id) where b.rec_name='疯狂抢购' and is_on_sale='1' order by a.id  desc limit 5 ";
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
           //
           
            //取出所有商器
            $goodsModel=D('Goods');
            //联会员价格表
            $level_id=  session('level_id');
            $rate=  session('rate')/100;
           // show_bug($rate);
            
            
            
           // $sql="select a.*,b.* from v_goods a left join v_member_price b on a.id=b.goods_id where a.is_on_sale='1' AND a.id=$id AND level_id='$level_id'";
            if($level_id){//如果用户登录的话
                
                           $goods_info= $goodsModel->alias('a')->field('a.*,b.level_id,b.goods_id,price')->join('left join v_member_price b on a.id=b.goods_id')->where("a.is_on_sale='1' AND a.id=$id AND level_id='$level_id'")->find();
            }else{
                
                //用户没有登录时
               // $sql="select a.*,b.attr_value,b.attr_price,c.attr_name from v_goods a left join v_goods_attr b on a.id=b.goods_id  left join  v_attr c  on b.attr_id=c.id  where a.is_on_sale='1' AND a.id=$id group by b.goods_id";
               // $goods_info=$goodsModel->query($sql);
                  $goods_info= $goodsModel->where("is_on_sale='1' AND id=$id")->find();
            
            }
            
     
               // show_bug($goods_info);
           //$goods_info= $goodsModel->query($sql);
           
         ///  $goods_info=$goodsModel->where("is_on_sale='1' AND id=".$id)->find();
        //   show_bug($goods_info);
            //取出属性和属性值
            
           $sql='select a.attr_name,a.attr_value bav,a.attr_type ,b.* from v_attr a left join v_goods_attr b on a.id=b.attr_id where goods_id='.$id.' and attr_id in(select attr_id from v_goods_attr where goods_id='.$id.' group by attr_id HAVING count(*)>1'. ')';
           
      
            $ga=$goodsModel->query($sql);
            
          
                //商品属性
                 $rga=array();
                 $uga=array();
                 
            //  show_bug($ga);
                 //组成一个新三维的数姐
                 foreach($ga as $k=>$v){
                     if($v['attr_type']=='单选'){
                           $rga[$v['attr_id']][]=$v;
                     }else{
                         $uga[]=$v;
                     }
                   
                     
                 }
              //   show_bug($rga);
       //取出所有浏览的图片图片
              //   show_bug($uga);
           $picsModel=D('Pics');
           $pics_info=$picsModel->where('goods_id='.$id)->select();
         
           
                    //取出商品评论
            $comModel=D('Comment');
            
            //实化分页类
        
            
            //联用户名查询用户可
          $sql="select a.*,b.m_name from v_comment a left join v_member b on a.mid=b.id where a.gid=$id order by a.id desc";
          //$com_list=   $comModel->where('gid='.$id)->select();
            
        //  $com_list=$comModel->query($sql);
          $total=$comModel->count();
          $offset=5;
         $page=new \Think\Page($total,$offset);
          
         $page_list=$page->fpage();
            $sql="select a.*,b.m_name from v_comment a left join v_member b on a.mid=b.id where a.gid=$id order by a.id desc ".$page->limit;
           $com_list= $comModel->query($sql);
          
          //找出浏览的商品有多少分
          $starts=$comModel->field('score')->where('gid='.$id)->order('id desc')->select();
      
          $count=count($starts);
          
          //计算好评 、中评、差评
          $hao=0;
          $zhong=0;
          $chai=0;
          
          foreach($starts as $k=>$v){
                    if($v['score']>=4){
                        $hao++;
                    }elseif($v['score']==3){
                        $zhong++;
                    }else{
                        $chai++;
                    }
              
          }
    
         //计算好评率、中评率、差评率
            $hao_rate=  round($hao/$count,1)*100; //好评率
            $zhong_rate=  round($zhong/$count,1)*100; //中评率
              $chai_rate=  round($chai/$count,1)*100; //差评率
              
              //取出印象
              $impressionModel=D('Impression');
              $impression_info=$impressionModel->where('gid='.$id)->select();
            //  show_bug($impression_info);
         // echo mysql_error();
          //show_bug($com_list);
            $this->assign(array(
                'title'=>'商品页面',
                'js'=>array('goods','jqzoom-core'),
                'css'=>array('goods','common','jqzoom'), //商品样式
                'goods_info'=>$goods_info, //商品基本信息
                'pics_info'=>$pics_info,
                'rate'=>$rate,   //折扣率
                'rga'=>$rga, //单选属性
                'uga'=>$uga, //唯一属性
                'com_list'=>$com_list ,//评论列表
                 'hao_rate'=>$hao_rate, //好评率
                'zhong_rate'=>$zhong_rate, //中评率
                'chai_rate'=>$chai_rate, //差评率
                'impression_info'=>$impression_info, //印象
                'page_list'=>$page_list, //页码列表
                
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
    
    //通过ajax获得库存
    public function ajaxGetGN($gaid,$gid){
        
        $goods_numberModel=D('GoodsNumber');
        
       $gn =$goods_numberModel->where("goods_attr_id='$gaid' AND goods_id=$gid")->find();
        
     if($gn)
            echo $goods_numberModel->goods_number;
     else
         echo 0;
     
    }
    
    //商品评论
    public function remark($gid,$score,$content,$impression){
        
        $commentModel=D('Comment');
        $mid=  session('id');
        //将数据存入评论表
        $commentModel->gid=$gid; //商品ID
        $commentModel->score=$score;
        $commentModel->mid=session('id');
        $commentModel->content=$content;
        $commentModel->addtime=time();
        
        $imModel=D('Impression'); //印象
        $im_info=$imModel->where("name='$impression'")->find();
        
        if($im_info){
                $imModel->where("name='$impression'")->setInc('count');
            
        }else{
            
                $imModel->add(array(
                    'name'=>$impression,
                    'gid'=>$gid,
                    'count'=>1,
                ));
        }
             
        //一个用户只能评论一次
        
      // $com= $commentModel->where('gid='.$gid.' AND mid='.session('id'))->find();
//    $com= $commentModel->where("gid=$gid AND mid=$mid")->find();
//
//                if($com){
//                    
//                    echo '抱歉，你已经评论过';
//                    exit;
//                    
//                }else{
                    
                                        if($commentModel->add()){

                                         echo '评论成功';
                             }
               // }
        
         
        
        
        
    }
}