<?php
/*
* @file:  TestController.php
* @brief:  自定义控制器
* @author: feihu1996.cn
* @date:  下午15:08 18-08-06
* @version: 1.0
*/

namespace App\Http\Controllers;

class TestController extends Controller{
    // public function info(){
    //     return '自定义控制器';
    // }
    // public function info(){
    //     return route('test-info');  // 返回路由地址
    // }
    // public function info($id){
    //     return "test-info-$id";  // 获取路由参数
    // }   
    // public function info(){
    //     return view('test-info');  // 路由中输出视图(普通php文件)
    // } 
    // public function info(){
    //     return view('test-info-blade');  // 路由中输出视图(blade模板文件)
    // }   
    // public function info(){
    //     return view('test/info');  // 路由中输出视图(含目录)
    // }         
    public function info(){  // 向blade模板文件传递参数
        return view('test/info-blade', [
            "name" => "feihu1996",
            "age" => 18
        ]);
    }
}
