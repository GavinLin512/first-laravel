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
        $(document).ready(function() {
            $('#user').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('user.list') }}",
                "columns": [
                    {
                        "data":"name",
                    },
                    {
                        "data":"role",
                    },
                    {
                        "data":"email",
                    },
                    {
                        "data":"user_client.phone",
                        "defaultContent":""
                    },
                    {
                        "data":"user_client.address",
                        "defaultContent":""
                    },
                    {
                        "data":'action',
                    }
                ]
            });
            // console.log($('#user').DataTable())
        } );
    </script>
@endsection
