<!-- 继承父模板layouts -->
@extends("layouts")

@section('header')
    @parent <!--将父模板中的内容加载进来-->
    <p>重写父模板header section</p>
@endsection

@section('sidebar')
    <p>重写父模板sidebar section</p>
@endsection

@section('title', 'yield子模板的title section')

@section('content', 'yield子模板的content section')

@section('footer')
    @parent
    <p>重写父模板footer section</p>
    <hr>
    <p>
        1. 模板中输出PHP变量: {{ $hint }}
    </p>
    <hr>
    <p>
        2. 模板中调用PHP代码: <br>
        {{ date("Y-m-d H:i:s", time()) }} <br>
        {{ in_array($hint, $arr) ? 'true' : 'false' }} <br>
        {{ $notexistedvar or 'notexistedvar' }}
    </p>
    <hr>
    <p>
        3. 原样输出<br>
        @{{ $hint }}
    </p>
    <hr>
    <p>
        4. 模板注释<br>
        {{-- 模板注释 --}}
    </p>
    <hr>
    <p>
        5. 引入子视图 include<br>
        @include("student.common1", [
            'message' => $message,
        ])
    </p>
@endsection