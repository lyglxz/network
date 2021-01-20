<?php

/**
 *  登陆页
 * @file   
 * @date    
 * @author   
 * @version     
 */

namespace app\admin\controller;

use app\admin\controller\Main;
use think\Request;
use think\Db;
use think\Session;


class User extends Common {

    /**
     * 主页面
     */
    public function changepassword(){
        $row=db('user')->where('UserId',Session::get('userid'))->select();
        $truepass=null;
        foreach($row as $e){
            $truepass=$e['Password'];
        }
        $this->assign('password',$truepass);
        return $this->fetch('changepassword');
    }
    
    public function dochange(){
        $newpass=$_POST['newpass'];
        echo Session::get('userid');
        db('user')->where('UserId',Session::get('userid'))->update(['Password'=>$newpass]);
        return $this->redirect('/admin/main/index');
    }
    public function dorminfo(){
        return $this->fetch();
    }
    

}
