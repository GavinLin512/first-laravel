<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserClient;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'string', 'digits:10'],
            'address' => ['required', 'string', 'max:255']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     * @return \App\Models\UserClient
     */
    protected function create(array $data)
    {
//        dd($data);
        // $data 是已經經過驗證的資料
        // transaction:資料庫交易，若有任何一步出錯，將返回上一動作，不會新增資料到DB
        // RegistersUsers.php 內有寫到，他會抓這個 $request 資料，並不是驗證過的，並且登入
        // 登入時找不到回傳 User Model 的資料，才會報錯登入為 null
         $user = \DB::transaction(function ()use ($data){
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => $data['role'],
            ]);

//        dd($user);

            UserClient::create([
                'user_id' => $user->id,
                'phone' => $data['phone'],
                'address' => $data['address'],
            ]);
            // 回傳 create 的資料
//             dd($user);
            return $user;
        });
        // 回傳 create User 這個 Model 的資料
        return $user;
//        dd($userClient);
//        $user->save();
//        $userClient->save();
    }
}
