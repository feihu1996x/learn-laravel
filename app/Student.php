<?php
/*
* @file:  StudentsModel.php
* @brief:  students模型
* @author: feihu1996.cn
* @date:  下午12:31 18-08-07
* @version: 1.0
*/

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model{
    // 手动关联数据表
    // 默认情况下, 模型名称的复数形式等于表名
    protected $table = "students";

    // 手动指定表的主键
    // 默认是id字段
    protected $primaryKey = "id";

    //  指定允许批量赋值的字段
    protected $fillable = ["name", "age"];

    //  指定不允许批量赋值的字段
    // protected $guarded = ["id"];    

    // 关闭时间戳(created_at和updated_at)自动化处理
    // 默认值是true
    // public $timestamps = false;

    // 自定义时间戳格式
    // protected function getDateFormat(){
        // return time();
    // }

    // 禁用时间戳自动格式化输出
    // protected function asDateTime($val){
        // return $val;
    // }

}