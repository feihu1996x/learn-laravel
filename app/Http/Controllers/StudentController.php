<?php
/*
* @file:  StudentController.php
* @brief:  学生控制器
* @author: feihu1996.cn
* @date:  下午16:46 18-08-06
* @version: 1.0
*/

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class StudentController extends Controller {
    public function test1(){
        /*
        使用DB facade对students表进行CURD
        */
        
        // return "test-db-facade1";

        // insert: 插入成功，返回true，否则，返回false
        $res = DB::insert(
            "insert into students(name, age) values(?, ?)",
            ["feihu1996", 18]
        );
        var_dump($res);

        // select: 有记录，返回一个数组，否则，返回空数组
        $students = DB::select("select * from students"); 
        dd($students);        

        // update:  更新成功，返回受影响的行的数量
        $num = DB::update(
            "update students set age = ? where name = ?",
            [20, 'feihu1996']
        );
        var_dump($num);

        // delete: 删除成功, 返回受影响的行的数量
        $num = DB::delete(
            "delete from students where name = ?",
            ["feihu1996"]
        );
        dd($num);

    }
}
