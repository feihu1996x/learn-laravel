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
        // dd($update_nums);

        // 查询：成功，返回表中所有记录组成的数组
        $select_students = DB::table("students")->get();
        // dd($select_students);

        // 查询: 成功, 返回结果集中的第一条数据构成的数组
        $select_students = DB::table("students")
            ->orderBy("id", "desc")
            ->first();
        // dd($select_students);

        // 查询: 成功, 返回符合where条件子句的结果集组成的数组
        $select_students = DB::table("students")
            ->where("id", ">=", "1")
            ->get();
        // dd($select_students);

        // 查询: 成功, 返回符合where条件子句(多重条件)的结果集组成的数组
        $select_students = DB::table("students")
            ->whereRaw("id >= ? and age > ?", [1,0])
            ->get();
        // dd($select_students);

        // 查询: 成功, 返回只包含指定字段(单个字段)的结果集组成的数组
        $select_students = DB::table("students")
            ->pluck("name");
        // dd($select_students);   

        // 查询: 成功, 返回只包含指定字段(多个字段)的结果集组成的数组
        $select_students = DB::table("students")
            ->select("name", "id", "age")
            ->get();
        // dd($select_students);           

        // 查询: 成功, 分批次返回结果集组成的数组
        // 每次查询2条记录
        DB::table("students")->orderBy('id')->chunk(2,function($select_students){
            foreach($select_students as $select_student){
                // 可以设定查询退出条件，当达到该条件时，查询退出，不再往下执行
                // if($select_student->name=='lanjie')
                    // return false;
                $name = $select_student->name.'<br>';
                // echo $name;
            }
        });
        
        // 查询: 成功, 返回只包含指定字段的结果集组成的数组
        // lists的第二个参数将结果集数组的下标指定为特定的字段值
        // $select_students = DB::table("students")
            // ->lists("name", "id");
        // dd($select_students);           

        // 聚合函数count(): 统计表中的记录数
        $item_nums =DB::table("students")->count();
        // dd($item_nums);

        // 聚合函数count(): 统计表中的所有记录的age字段的最大值\最小值\平均值\和
        $age_max =DB::table("students")->max("age");
        $age_min =DB::table("students")->min("age");
        $age_avg =DB::table("students")->avg("age");
        $age_sum =DB::table("students")->sum("age");
        dd([
            "age_max" => $age_max,
            "age_min" => $age_min,
            "age_avg" => $age_avg,
            "age_sum" => $age_sum,
        ]);

        // 删除: 删除成功, 返回受影响的行的数量
        // 删除students表中id字段为5的记录
        $delete_nums = DB::table("students")
            ->where('id', 15)
            ->delete();

        // 删除: 删除成功, 返回受影响的行的数量
        // 删除students表中id字段值大于等于15的记录
        $delete_nums = DB::table("students")
            ->where('id', '>=',15)
            ->delete();
        // dd($delete_nums);

        // 删除：清空数据表
        DB::table("students")->truncate();
    }
}
