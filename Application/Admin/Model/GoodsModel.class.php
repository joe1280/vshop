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
                $upload->savePath='Goods/';
                
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
                $upload->savePath='Pics/';
                
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
                            'goods_id'=>$goods_id,
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
    public function _before_update(&$data, $options) {
        
      //show_bug($_POST);die;
    
          //上传商品logo
            if($_FILES['o_img']['error']==0){
                
                //修改之前删除原来图片
                unlink('./Uploads/'.I('o_img'));
                unlink('./Uploads/'.I('b_img'));
                unlink('./Uploads/'.I('m_img'));
                unlink('./Uploads/'.I('s_img'));
                
                $upload=new \Think\Upload();
                
                $max_size=(int)  ini_get('upload_max_filesize');
                            if($max_size>=4)
                                $max_size=4;
                $upload->maxSize=$max_size*1024*1024 ;// 设置附件上传大小
                $upload->exts=array('jpg','gif','png','jpeg');
                $upload->rootPath='./Uploads/';
                $upload->savePath='Goods/';
                
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
    //更新之后
    public function _after_update($data, $options) {
        

             $goods_id=$data['id'];
              $member_price=I('post.MemberPrice');
              $member_priceModel=D('MemberPrice');
              
              //遍布插入数据中
              foreach ($member_price as $k=>$v){
                   //再遍历一次
                    foreach($v as $kk=>$vv){
                              $member_priceModel->save(array(
                            'id'=>$k,
                             'goods_id'=>$goods_id,
                              'level_id'=>$kk,
                               'price'=>$vv,
                  ));
                        
                    }
                  
              }
              
                     //处理商品属性
                    //新增商品属性时
                //商品属性ID
                $new_goods_attr_id=I('post.new_goods_attr_id');
                if($new_goods_attr_id){
                    //如果是新增商品属性的话
                                  //属性价格
                $attr_price=I('attr_price');
                
               
                
                //实例化商品属性模型
                $goods_attrModel=D('GoodsAttr');
                
                //遍历存进数据库
                //先遍历商品属性
                $i=0;
                foreach($new_goods_attr_id as $k=>$v){
                    
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
                //如果删除商品属性
                $del_gaid=I('post.del_gaid');
                    if($del_gaid){
                        //如果存在的话，就删除
                                   //去掉重复的字符串
               $del_gaid=array_unique(explode(',', $del_gaid));
              
                //删除元素是undefined
                foreach($del_gaid as $k=>$v){
                    
                            if($v=='undefined')
                                unset($del_gaid[$k]);
                }
                
                //把数组变成字符串
                $del_gaid=  implode(',', $del_gaid);
                //删除商品属性
                $goods_attrModel=D('GoodsAttr');
                $goods_attrModel->delete($del_gaid);
                    
                    }
                    
                    //如果是修复商品属性
                                //处理商品属性
                //商品属性ID
                
                $goods_attr_id=I('post.goods_attr_id');
             
                        if($goods_attr_id){
                                    //属性价格
                $attr_price=I('attr_price');
                
               
                
                //实例化商品属性模型
                $goods_attrModel=D('GoodsAttr');
                
                //遍历存进数据库
                //先遍历商品属性
                $i=0;
                foreach($goods_attr_id as $k=>$v){
                    
                        foreach($v as $kk=>$vv){
                                
                                  $goods_attrModel->save(array(
                                 'id'=>$kk,
                                 'attr_id'=>$k,
                                 'attr_value'=>$vv,
                                 'attr_price'=>$attr_price[$i],
                            
                        ));
                            $i++;
                        }
                    
                }
                            
                        }
                        
                         //上传商品图片
              
                $upload=new \Think\Upload();
                
                $max_size=(int)  ini_get('upload_max_filesize');
                            if($max_size>=4)
                                $max_size=4;
                $upload->maxSize=$max_size*1024*1024 ;// 设置附件上传大小
                $upload->exts=array('jpg','gif','png','jpeg');
                $upload->rootPath='./Uploads/';
                $upload->savePath='Pics/';
                        
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
                            'goods_id'=>$goods_id,
                        ));
                }
            
                
                    
                    
        
        
                            
                
        
    }
    //删除商品
    protected function _before_delete($options) {
        
       
        $goods_id=$options['where']['id'];
        
       $this->field('o_img,b_img,m_img,s_img')->where('id='.$goods_id)->find();
       
       
       //删除商品之前先删除图片
       unlink('./Uploads/'.$this->o_img);//删除原图片
        unlink('./Uploads/'.$this->b_img);//删除大图片
         unlink('./Uploads/'.$this->m_img);//删除中图片
          unlink('./Uploads/'.$this->s_img);//删除小图片
       
          //删除单个商品属性
    $goods_attrModel=D('GoodsAttr');
    
    $goods_attrModel->where('goods_id='.$goods_id)->delete();
    
    //删除单个会员价格
    $member_priceModel=D('MemberPrice');
     $member_priceModel->where('goods_id='.$goods_id)->delete();
     
     //删除单个商品Pic图片路程
     
      $picsModel=D('Pics');
      //删除实体的商品图片
      
     $pics= $picsModel->where('goods_id='.$goods_id)->select();
        foreach($pics as $k=>$v){
            
            
                    unlink('./Uploads/'.$v['o_pic']);//删除原图片

                   unlink('./Uploads/'.$v['m_pic']);//删除中图片
                    unlink('./Uploads/'.$v['s_pic']);//删除小图片

               
            
        }
            $picsModel->where('goods_id='.$goods_id)->delete();
     
     
     
    }
  
    
}
