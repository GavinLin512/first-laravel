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
            <th>建立於</th>
            <th>更新於</th>
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
            <th>建立於</th>
            <th>更新於</th>
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
            setTimeout(function (){
                $('#message').remove();
            }, 3000);

             let table = $('#user').DataTable({
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
                        defaultContent:"",
                        searchable:false,
                        orderable:false,
                    },
                    {
                        data:"user_client.address",
                        defaultContent:"",
                        searchable:false,
                        orderable:false,
                    },
                    {
                        data:"created_at",
                    },
                    {
                        data:"updated_at"
                    },
                    {
                        // 指定某個欄位排序
                        // name:"role",
                        // button 也可以長在這
                        data:"action",
                        // 不可被排序及搜尋
                        searchable:false,
                        orderable:false,
                    },
                ],
                language:{
                    processing:'資料處理中...'
                }


            });
            // console.log($('table'));
            // $('.del-btn').on('click').each(function (){
            //     console.log($(this).data('id'))});
            // 選到已經生成的 table 標籤，
           $('table').on('click','.del-btn', function (){
               // console.log( $(this).data('id'));
               let user_id = $(this).data('id');
               Swal.fire({
                   title: '確定要刪除此筆資料嗎?',
                   text: "此項操作不可逆!",
                   icon: 'warning',
                   showCancelButton: true,
                   confirmButtonColor: '#3085d6',
                   cancelButtonColor: '#d33',
                   confirmButtonText: '確定刪除?',
                   cancelButtonText:'取消'
               }).then((result) => {
                   if (result.isConfirmed) {
                       Swal.fire(
                           '已刪除!',
                           '您所選的資料已被刪除',
                           'success'
                       )
                       $.ajax({
                           type:"POST",
                           // 可能不支援此方法(?
                           // method:"delete",
                           url:"user"+'/'+ user_id,
                           data:{
                               // 生成隱藏的 form 表單並傳入 method 與 value
                               _method:'DELETE',
                               // _token:'token'
                               // success 不是寫在 data 內，他是 ajax 的參數
                               // success: function (response){
                               //     console.log(response);
                               // },
                           },
                           success:function (){
                               // console.log(response)
                               // 匯出 table 刪除過後的 datatable
                               table.draw()
                           },
                       })
                   }

               })
               // console.log(user_id);

           });
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
