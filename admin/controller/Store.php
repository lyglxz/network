<?php

/**
 *  登陆页
 * @file    
 * @date    
 * @author  
 * @version    
 */

namespace app\admin\controller;

use think\Request;
use think\Db;
use think\Session;

class Store extends Common {

    /**
     * 主页面
     */
    public function index() {
        //echo Session::get('userid');
        $result=db('user')->select();
        $this->assign('lists', $result);
        return $this->fetch();
        
    }

    public function miaosha() {
        //echo Session::get('userid');
        $result=db('user')->select();
        $this->assign('lists', $result);
        return $this->fetch();
        
    }

    /**
     * 修改密码
     */
    public function changepassword(){
        
    }
    
    public function checkInput(){
        $q=$_GET['q'];
        $result=Db::table('student')->where('id',$q)->select();
        foreach ($result as $row) {
            if($row['id']==$q){
                $responce="nice";
            }
        }
        if(!isset($responce)){
            $responce="bad";
        }
        
        echo $responce;
    }
    
    public function signup(){
        return $this->fetch();
    }
    

}
