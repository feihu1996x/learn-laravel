<?php
/*
* @file:  StudentController.php
* @brief:  数据库操作
* @author: feihu1996.cn
* @date:  下午16:46 18-08-06
* @version: 1.0
*/

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class StudentController extends Controller {
    public function test_db_facade(){
        /*
            数据库操作之DB facade
        */
        
        // return "test-db-facade";

        // insert: 插入成功，返回true，否则，返回false
        $insert_res = DB::insert(
            "insert into students(name, age) values(?, ?)",
            ["feihu1996", 18]
        );
        var_dump($insert_res);

        $insert_res = DB::insert(
            "insert into students(name, age) values(?, ?)",
            ["feihu1996x", 18]
        );
        var_dump($insert_res);        

        // update:  更新成功，返回受影响的行的数量
        $update_nums = DB::update(
            "update students set age = ? where name = ?",
            [20, 'feihu1996']
        );
        var_dump($update_nums);        

        // delete: 删除成功, 返回受影响的行的数量
        $delete_nums = DB::delete(
            "delete from students where name = ?",
            ["feihu1996"]
        );
        var_dump($delete_nums);

        // select: 有记录，返回一个数组，否则，返回空数组
        $select_students = DB::select("select * from students"); 
        dd($select_students);                

    }

    public function test_query_builder() {
        /*
            数据库操作之查询构造器
        */

        // 插入: 插入成功,返回true,否则返回false
        $insert_res = DB::table("students")->insert([
            "name" => "lanjie",
            "age" => 22
        ]);
        // var_dump($insert_res);

        // 插入: 插入成功,返回id字段
        $insert_res_id = DB::table("students")->insertGetId([
            "name" => "gsx",
            "age" => 22
        ]);
        // var_dump($insert_res_id);      
        
        // 批量插入:  插入成功,返回true,否则返回false
        $multi_insert_res = DB::table("students")->insert([
            ["name" => "lanjie1", "age" => 22],
            ["name" => "lanjie2", "age" => 23],
            ["name" => "lanjie3", "age" => 24],
        ]);
        // dd($multi_insert_res);

        //  更新为指定的内容： 更新成功，返回受影响的行的数量
        $update_nums = DB::table("students")
            ->where('id', 15)
            ->update(["age" => 30]);
        // dd($update_nums);

        // 更新为自增： 更新成功，返回受影响的行的数量
        $update_nums = DB::table("students")
            ->where('id', 15)
            ->increment("age", 3);  // 指定记录的age字段自增3，缺省第二个参数默认自增1
        // dd($update_nums);            

        // 更新为自减： 更新成功，返回受影响的行的数量
        $update_nums = DB::table("students")
            ->where('id', 15)
            ->decrement("age", 3);  // 指定记录的age字段自减3，缺省第二个参数默认自减1
        // dd($update_nums);                    

        // 更新为自增/减的同时修改其他字段： 更新成功，返回受影响的行的数量
        $update_nums = DB::table("students")
            ->where('id', 15)
            ->decrement("age", 3, ["name" => "younger lanjie"]); 
        dd($update_nums);                            
    }
}
