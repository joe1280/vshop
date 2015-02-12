<?php
namespace Admin\Model;
use Think\Model;
class BrandModel extends Model{
    
    
        protected $_validate = array(
        array('brand_name','require','品牌名称不能为空',1),
        //array('logo','require','品牌logo不能为空',1),
      array('brand_name','','品牌已经存在',0,'unique',1),
//        array('attr_name','','属性已经存在',0,'unique',2),
       
    );
        
    protected function _before_insert(&$data, $options) {
       // show_bug($_FILES);die;
      


                if($_FILES['logo']['error']==0){
                    $max_size=(int)ini_get('upload_max_filesize');//读取INI上传最大单个文件信息
                   // 实例化上传类    
                                   if($max_size>=4)
                                        $max_size=4;
                                          
                                  
                        $upload=new \Think\Upload();    
                      $upload->maxSize   =     $max_size*1024 *1024;// 设置附件上传大小
                    $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型  
                    $upload->rootPath='./Uploads';
                   $upload->savePath  =      'brand/'; // 设置附件上传目录    // 上传文件    
                   $info   =   $upload->upload();
        

                        if(!$info){
                            echo $upload->getError();die;
                        } else{
                            $data['logo']=$info['logo']['savepath'].$info['logo']['savename'];


                        }
                }
       
        

    }
    //更新之前，删除原来的图片
    protected function _before_update(&$data, $options) {
        
        if($_FILES['logo']['error']==0){
                $old_logo=I('post.old_logo');
                //删除原来的图片
                unlink('./UPloads/'.$old_logo);//删除实体文件
                //然后再上传图片
                   $max_size=(int)ini_get('upload_max_filesize');//读取INI上传最大单个文件信息
                   // 实例化上传类    
                                   if($max_size>=4)
                                        $max_size=4;
                                          
                                  
                        $upload=new \Think\Upload();    
                      $upload->maxSize   =     $max_size*1024 *1024;// 设置附件上传大小
                    $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型  
                    $upload->rootPath='./Uploads';
                   $upload->savePath  =      'brand/'; // 设置附件上传目录    // 上传文件    
                   $info   =   $upload->upload();
        

                        if(!$info){
                            echo $upload->getError();die;
                        } else{
                            $data['logo']=$info['logo']['savepath'].$info['logo']['savename'];


                        }
                
            
        }
    }
    //删除品牌之前，先删除图片
    protected function _before_delete($options) {
       $logo_path= $this->field('logo')->find($options['where']['id']);
       $delid=  implode(',',I('post.delid'));
       $m_logo_path=$this->field('logo')->where("id IN($delid)")->select();//查询多个图片的路径
      
       //删除单个图片
        if($logo_path){
            unlink('./Uploads/'.$logo_path['logo']);
        }
        //unlink('')
      
         if($m_logo_path){
        
             foreach ($m_logo_path as $k=>$v){
                 
                   unlink('./Uploads/'.$v['logo']);
             }
         }
       
    }
}
