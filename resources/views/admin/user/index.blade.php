@extends('layouts.app')

@section('title', '會員管理')

@section('css')

@endsection

@section('main')
    <a href="{{ route('user.create') }}" type="button" class="btn btn-block btn-success btn-sm w-25 mb-3">新增會員資料</a>
    <table id="user" class="display " style="width:100%">
        <thead>
        <tr>
            <th>姓名</th>
            <th>角色</th>
            <th>信箱</th>
            <th>電話</th>
            <th>地址</th>
            <th>操作</th>
        </tr>
        </thead>
{{--        <tbody>--}}
{{--        @foreach($userData as $key => $userData)--}}
{{--        <tr>--}}
{{--            <td>{{ $userData->name }}</td>--}}
{{--            <td>{{ $userData->role??'' }}</td>--}}
{{--            <td>{{ $userData->email }}</td>--}}
{{--            <td>{{ $userData->client->phone??'' }}</td>--}}
{{--            <td>{{ $userData->client->address??'' }}</td>--}}
{{--            <td>--}}
{{--                <a href="{{ route('user.edit', $userData->id) }}" type="button" class="btn btn-block btn-outline-primary btn-xs">編輯</a>--}}
{{--                <form action="{{ route('user.destroy', $userData->id) }}" method="POST">--}}
{{--                    @csrf--}}
{{--                    @method('DELETE')--}}
{{--                    <button type="submit" class="btn btn-block btn-outline-danger btn-xs mt-2">刪除</button>--}}
{{--                </form>--}}

{{--            </td>--}}
{{--        </tr>--}}
{{--        @endforeach--}}
{{--        </tbody>--}}
        <tfoot>
        <tr>
            <th>姓名</th>
            <th>角色</th>
            <th>信箱</th>
            <th>電話</th>
            <th>地址</th>
            <th>操作</th>
        </tr>
        </tfoot>
    </table>
@endsection

@section('js')
    <script>
        $.ajaxSetup({
            headers: {
                // 去拿
                // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                // 設定全域的 CSRF-TOKEN 給 ajax 用
                'X-CSRF-TOKEN': '{{csrf_token()}}',
            }
        });
        $(document).ready(function() {
            $('#user').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('user.list') }}",
                columns: [
                    {
                        data:"name",
                    },
                    {
                        data:"role",
                    },
                    {
                        data:"email",
                    },
                    {
                        data:"user_client.phone",
                        defaultContent:""
                    },
                    {
                        data:"user_client.address",
                        defaultContent:""
                    },
                    {
                        // 指定某個欄位排序
                        // name:"role",
                        data:"action",
                        // 不可被排序及搜尋
                        searchable:"false",
                        ordering:'false'
                    },
                    // {
                    //     "data":"action",
                    // }
                ],
                success: function () {
                    let del_btn = document.querySelector('.del-btn');

                }
            });
            // 必須寫在 ready 之內，但是 ajax 送出後並沒有回傳，所以這裡還是抓不到 class
            // let del_btn = document.querySelector('.del-btn');
            // console.log(del_btn);
            // del_btn.addEventListener('click', function () {
            //     // $.ajax({
            //     //     success: function(response){
            //     //         console.log(response)
            //     //     }
            //     // })
            //     console.log('aaa');
            // });
        } );

        // 必須解決拿到 id 的問題，或許用data-set?
        // 寫在這因為 datatable 還未生成，所以 querySelector 找不到該 class
        {{--var token = {{ csrf_token() }};--}}
        {{--var edit_btn = document.querySelector('.edit-btn');--}}
        {{--edit_btn.addEventListener('click', function () {--}}
        {{--    $.ajax({--}}
        {{--        --}}{{--url: '{{ route('user.index')}}',--}}
        {{--        type: 'GET',--}}
        {{--        headers: token,--}}
        {{--    })--}}
        {{--})--}}


        // let del_btn = document.querySelector('.del-btn');
        // del_btn.addEventListener('click', function () {
        //     $.ajax({
        //         method:'DELETE',
        //     })
        //     console.log('aaa');
        // });
    </script>
@endsection
