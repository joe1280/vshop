<?php
namespace Admin\Model;
use Think\Model;
class GoodsModel extends Model{
    
    
        protected $_validate = array(
        array('goods_name','require','商品名称不能为空',1),

    );
        
        
    protected function _before_insert(&$data, $options) {
       //商品类型
                $type_id=I('post.type_id');
    
        //上传商品logo
            if($_FILES['o_img']['error']==0){
                
                $upload=new \Think\Upload();
                
                $max_size=(int)  ini_get('upload_max_filesize');
                            if($max_size>=4)
                                $max_size=4;
                $upload->maxSize=$max_size*1024*1024 ;// 设置附件上传大小
                $upload->exts=array('jpg','gif','png','jpeg');
                $upload->rootPath='./Uploads/';
                $upload->savePath='pic/';
                
                //上传文件
                $info=$upload->upload(array('o_img'=>$_FILES['o_img']));
               
                if(!$info){
                    echo $upload->getError();
                }else{
                    //原图路径
                     $o_img=$info['o_img']['savepath'].$info['o_img']['savename'];
                    //小图路径
                    $s_img=$info['o_img']['savepath'].'_s_'.$info['o_img']['savename'];
                    //中图路径
                    $m_img=$info['o_img']['savepath'].'_m_'.$info['o_img']['savename'];
                    //生成大图
                    $b_img=$info['o_img']['savepath'].'_b_'.$info['o_img']['savename'];
                    //生成缩略图
                    $image=new \Think\Image();
                    //打开原图
              
                    $image->open('./Uploads/'.$o_img);
                   
                   
                   
                    
                    //生成大图片
                    $image->thumb(350, 350)->save('./Uploads/'.$b_img);
                    
                          //生成中图片
                    $image->thumb(130, 130)->save('./Uploads/'.$m_img);
                    
                     //生成小图片
                       
                $image->thumb(50, 50)->save('./Uploads/'.$s_img);
                    
                    //将成生成图片的相对路径存入数据库中
                    $data['o_img']=$o_img;
                    
                    $data['s_img']=$s_img;
                     $data['m_img']=$m_img;
                      $data['b_img']=$b_img;
                }
            }
          
           
    }
    
    //添加会员价格
    protected function _after_insert($data, $options) {
      
                $goods_id=$data['id'];
              $member_price=I('post.MemberPrice');
              $member_priceModel=D('MemberPrice');
              
              //遍布插入数据中
              foreach ($member_price as $k=>$v){
                  $member_priceModel->add(array(
                      'goods_id'=>$goods_id,
                      'level_id'=>$k,
                      'price'=>$v[0],
                  ));
                  
              }
              
              //上传商品图片
              
                $upload=new \Think\Upload();
                
                $max_size=(int)  ini_get('upload_max_filesize');
                            if($max_size>=4)
                                $max_size=4;
                $upload->maxSize=$max_size*1024*1024 ;// 设置附件上传大小
                $upload->exts=array('jpg','gif','png','jpeg');
                $upload->rootPath='./Uploads/';
                $upload->savePath='Goods/';
                
                //上传商品图片
                
                $info=$upload->upload(array('o_pic'=>$_FILES['o_pic']));
                
                //遍历将所有图片的路径存进数据库中
                //实例化图片类
                $picsModel=M('Pics');
                    //生成缩略图
                 $image=new \Think\Image();
                 
                 
                foreach ($info as $k=>$v){
                    //原图路径
                    $o_pic_path=$v['savepath'].$v['savename'];
                    //中图路径
                    $m_pic_path=$v['savepath'].'_M_'.$v['savename'];
                    //小图片路径
                  $s_pic_path=$v['savepath'].'_S_'.$v['savename'];
                  
                  //打开原图
                  $image->open('./Uploads/'.$o_pic_path);
                  
                  //生成中图
                  $image->thumb(150, 150)->save('./Uploads/'.$m_pic_path);
                    
                       //生成小图
                  $image->thumb(50, 50)->save('./Uploads/'.$s_pic_path);
                        $picsModel->add(array(
                            'o_pic'=>$o_pic_path,
                            'm_pic'=>$m_pic_path,
                            's_pic'=>$s_pic_path,
                        ));
                }
                
                //处理商品属性
                //商品属性ID
                $goods_attr_id=I('post.goods_attr_id');
                //属性价格
                $attr_price=I('attr_price');
                
               
                
                //实例化商品属性模型
                $goods_attrModel=D('GoodsAttr');
                
                //遍历存进数据库
                //先遍历商品属性
                $i=0;
                foreach($goods_attr_id as $k=>$v){
                    
                        foreach($v as $kk=>$vv){
                                
                                  $goods_attrModel->add(array(
                                 'goods_id'=>$goods_id,
                                 'attr_id'=>$k,
                                 'attr_value'=>$vv,
                                 'attr_price'=>$attr_price[$i],
                            
                        ));
                            $i++;
                        }
                    
                }
                
                
            
           
    }
}
