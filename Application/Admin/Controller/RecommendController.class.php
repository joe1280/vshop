<?php
namespace Admin\Controller;
use Think\Controller;
class RecommendController extends Controller{
    
    //添加类型
    public function add(){
            $RecommendModel=D('Recommend');
            if(IS_POST){
                    if($RecommendModel->create()){
                          
                        if($RecommendModel->add()){
                                $this->success('添加成功',U('lst'));
                                exit;
                        }
                        $this->error('添加失败SQL:'.$RecommendModel->getLastSql());
                    }
                    $this->error($RecommendModel->getError());
                
            }
        
       $this->display();
    }
    
   //删除类型
    public function del($id){
        
        $RecommendModel=D('Recommend');
        if($RecommendModel->delete($id)){
            
            $this->success('删除成功',U('lst'));
            exit;
        }
        $this->error('删除成功');
            
        
        $this->display();
    }
    
    //修改类型
    public function update($id){
         $RecommendModel=D('Recommend');
      
            if(IS_POST){
                
                  if($RecommendModel->create()){
                            $RecommendModel->id=$id;
                            $RecommendModel->recommend_name=I('post.recommend_name');
                                if($RecommendModel->save()!==FALSE){
                                    $this->success('修改成功',U('lst'));
                                    exit;
                                }
                                $this->error('修改失败');
                     }
                     $this->error($RecommendModel->getError());
            }
       

        //取出要修改的类型
         $recommend_info=$RecommendModel->find($id);
         
         //传到模板上去
         $this->assign('recommend_info',$recommend_info);
           $this->display();
    }
    
    //查看类型列表
    public function lst(){
        
            $RecommendModel=D('Recommend');
            //取出所有类型
          $recommend_list=  $RecommendModel->select();
          
          $this->assign('recommend_list',$recommend_list);
          $this->display();
    }


    //批量删除
    public function mdel(){
        
        $ids=I('post.ids');
        $ids=  implode(',', $ids);
            $RecommendModel=D('Recommend');
            if($RecommendModel->delete($ids)){
                $this->success('删除成功',U('删除成功'));
                exit;
            }
            $this->error($RecommendModel->getLastSql());
            
        $this->display();
    }
    
    
    }
    
