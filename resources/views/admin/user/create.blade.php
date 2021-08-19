@extends('layouts.app')

@section('title', '新增會員資料')

@section('css')

@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">新增會員資料</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('user.index')}}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="role">角色權限</label>
                    <select class="form-control" id="role" name="role">
                        <option>admin</option>
                        <option selected>user</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="name">姓名</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="請輸入姓名" >
                </div>

                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <label for="email">信箱</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="請輸入信箱">
                </div>

                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <label for="password">密碼</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="請輸入密碼">
                </div>

                @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
.
                <div class="form-group">
                    <label for="password-confirm">驗證密碼</label>
                    <input type="password" class="form-control" id="password-confirm" name="password_confirmation" placeholder="請再次輸入密碼">
                </div>

                <div class="form-group">
                    <label for="phone">聯絡電話</label>
                    <input type="number" class="form-control" id="phone" name="phone" placeholder="請輸入密碼">
                </div>

                <div class="form-group">
                    <label for="address">通訊地址</label>
                    <textarea class="form-control" id="address" name="address" rows="5" placeholder="請輸入地址"></textarea>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-sm bg-gradient-success px-3">新增</button>
            </div>
        </form>
    </div>
@endsection

@section('js')

@endsection
