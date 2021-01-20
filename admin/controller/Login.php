<?php

/**
 *  登陆页
 * @file   Login.php  
 * @date   2016-8-23 19:52:46 
 * @author Zhenxun Du<5552123@qq.com>  
 * @version    SVN:$Id:$ 
 */

namespace app\admin\controller;

use think\Jwt;
use think\Controller;
use think\Loader;
use think\Cookie;
use think\Session;
use think\Request;

class Login extends Controller {

    /**
     * 登入
     */
    public function index() {
        // if(Cookie::has('token')){
        //     $token=Cookie::get('token');
        //     $uid=Jwt::verifyToken($token);
        //     echo $uid;
        //     if($uid!==false){
        //         // Session::set('userid',Cookie::get('id'));
        //         $rolelist=db('user_role')->where('UserId',$uid)->select();
        //         foreach ($rolelist as $e){
        //             //echo $e['UserId'];
        //             echo $e['UserId']+'  '+$uid;
        //             if($e['UserId']==$uid)
        //                 return $this->success('登录成功', 'main/index');
                    
        //         }
        //     }
        //     else echo"false";
            
        // }
        return $this->redirect('main/index');
        
    }
    
    /**
     * 处理登录
     */
    public function dologin() {
        //验证密码流程
        // $inserthtml='<td>3</td>
        // <td>2</td>
        // <td>9</td>
        // <td>0</td>
        // <td>8</td>';
        // foreach($_POST as $name=>$value){
        //     echo $name.":".$value.'<br>';
        // } 
        $result=db('user')->where('UserName',$_POST['username'])->select();
        foreach($result as $row){
            // echo $row["UserId"]." : ".$row["Password"].'<br>';
            if($row['Password']==$_POST['password']){
                $rolelist=db('user_role')->where('UserId',$row['UserId'])->select();
                $role=array(0);
                foreach ($rolelist as $e){
                        array_push($role,$e['roleid']);
                }
                print_r($_POST);
                if(isset($_POST['isremember'])){
                    // Cookie::set('id',$row['UserId'],3600*24*7);
                    $payload=array(
                        'iat'=>time(),
                        'exp'=>time()+3600*24*7,
                        'jti'=>md5(uniqid('JWT').time()),
                        'uid'=>$row['UserId']
                        );
                    
                    $gettoken=Jwt::gettoken($payload);
                    echo $payload['uid'];
                    Cookie::set('token',$gettoken);
                }
                else echo "no cookie";
                // Session::set('userid',$row['UserId']);
                // Session::set('role',$role);

                return $this->success('登录成功', 'main/index');
            }
        }
        $this->error('用户名或密码错误');
        //$this->success('登录成功', 'main/index');
    }

    /**
     * 登出
     */
    public function logout() {
        Cookie::delete('token');
        $this->success('退出成功', 'login/index');
    }

    public function test(){
        echo 'test';
    }

}
