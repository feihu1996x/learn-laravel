<?php
/*
* @file:  TestModel.php
* @brief:  自定义模型
* @author: feihu1996.cn
* @date:  下午15:53 18-08-06
* @version: 1.0
*/

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestModel extends Model{
    public static function getTestInfo(){
        return "自定义模型";
    }
}