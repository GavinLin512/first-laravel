@extends('layouts.app')

@section('title', '編輯會員資料')

@section('css')

@endsection

@section('main')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">編輯會員資料</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('user.update', $old_userData->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="role">修改角色權限</label>
                    <select class="form-control" id="role" name="role">
                        <option @if ($old_userData->role == 'admin') selected @endif>admin</option>
                        <option @if ($old_userData->role == 'user') selected @endif>user</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="name">修改姓名</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="請輸入姓名" value="{{ $old_userData ->name }}">
                </div>

                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <label for="email">修改信箱</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="請輸入信箱" value="{{ $old_userData ->email }}">
                </div>

                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <label for="password">修改密碼</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="請輸入密碼">
{{--                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="請輸入密碼" onkeyup="this.value=this.value.replace(/\s+/g,'')">--}}
                </div>

                @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <label for="password-confirm">驗證修改後密碼</label>
                    <input type="password" class="form-control" id="password-confirm" name="password_confirmation" placeholder="請再次輸入密碼">
{{--                    <input type="password" class="form-control" id="password-confirm" name="password_confirmation" placeholder="請再次輸入密碼" onkeyup="this.value=this.value.replace(/\s+/g,'')">--}}
                </div>

                <div class="form-group">
                    <label for="phone">修改聯絡電話</label>
                    <input type="number" class="form-control" id="phone" name="phone" placeholder="請輸入密碼" value="{{ $old_userData ->client-> phone??'' }}">
                </div>

                <div class="form-group">
                    <label for="address">修改通訊地址</label>
                    <textarea class="form-control" id="address" name="address" rows="5" placeholder="請輸入地址">{{ $old_userData ->client-> address??'' }}</textarea>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-sm bg-gradient-success px-3">編輯</button>
            </div>
        </form>
    </div>
@endsection

@section('js')

@endsection
