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
    public function info($id){
        return "test-info-$id";  // 获取路由参数
    }    
}
