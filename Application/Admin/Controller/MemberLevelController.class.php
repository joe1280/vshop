<?php
namespace Admin\Controller;
use Think\Controller;
class MemberLevelController extends IndexController{
    
    //添加类型
    public function add(){
            $MemberLevelModel=D('MemberLevel');
            if(IS_POST){
                    if($MemberLevelModel->create()){
                           
                        if($MemberLevelModel->add()){
                                $this->success('添加成功',U('lst'));
                                exit;
                        }
                        $this->error('添加失败SQL:'.$MemberLevelModel->getLastSql());
                    }
                    $this->error($MemberLevelModel->getError());
                
            }
        
       $this->display();
    }
    
   //删除类型
    public function del($id){
        
        $MemberLevelModel=D('MemberLevel');
        if($MemberLevelModel->create()){
            
            $this->success('删除成功',U('lst'));
            exit;
        }
        $this->error('删除成功');
            
        
        $this->display();
    }
    
    //修改类型
    public function update($id){
         $MemberLevelModel=D('MemberLevel');
      
            if(IS_POST){
                
                  if($MemberLevelModel->create()){
                            $MemberLevelModel->id=$id;
                            $MemberLevelModel->memberlevel_name=I('post.memberlevel_name');
                                if($MemberLevelModel->save()!==FALSE){
                                    $this->success('修改成功',U('lst'));
                                    exit;
                                }
                                $this->error('修改失败');
                     }
                     $this->error($MemberLevelModel->getError());
            }
       

        //取出要修改的类型
         $member_level_info=$MemberLevelModel->find($id);
         
         //传到模板上去
         $this->assign('member_level_info',$member_level_info);
           $this->display();
    }
    
    //查看类型列表
    public function lst(){
        
            $MemberLevelModel=D('MemberLevel');
            //取出所有类型
          $member_level_list=  $MemberLevelModel->select();
          
          $this->assign('member_level_list',$member_level_list);
          $this->display();
    }


    //批量删除
    public function mdel(){
        
        $ids=I('post.ids');
        $ids=  implode(',', $ids);
            $MemberLevelModel=D('MemberLevel');
            if($MemberLevelModel->delete($ids)){
                $this->success('删除成功',U('删除成功'));
                exit;
            }
            $this->error($MemberLevelModel->getLastSql());
            
        $this->display();
    }
    
    
    }
    
