<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Http\Requests\StoreUserData;
use App\Models\User;
use App\Models\UserClient;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * @var string
     */
    private $index;
    private $create;
    private $edit;

    public function __construct()
    {
        $this->index = 'admin.user.index';
        $this->create = 'admin.user.create';
        $this->edit = 'admin.user.edit';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $userData = User::with('client')->get();

        return view($this->index, compact('userData'));
    }

    public function datatable(): \Illuminate\Http\JsonResponse
    {
        return datatables()->eloquent(User::query())->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view($this->create);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserData $request)
    {
        // 全域驗證規則
        $validatedUserData = $request->validated();
//        dd($validatedUserData);
        // 自訂區域驗證規則才需要，視情況而定
        // if($validatedData->fails()) {
        // return  redirect('/user/create')->withErrors($validatedData->errors());
        // }

        $user = new User;
        $userClient = new UserClient;
//        $password = Hash::make($validatedUserData ['password']);

        // 前端資料驗證後，後端再去取得
        foreach ($validatedUserData as $key => $value) {

            $user->role = $validatedUserData['role'];
            $user->name = $validatedUserData['name'];
            $user->email = $request['email'];
            $user->password = Hash::make($request['password']);
//            dd($user);
            $user->save();

            $userClient->phone = $validatedUserData['phone'];
            $userClient->address = $validatedUserData['address'];
            // 用 new 的方式必須先讓user save 才能取得 id
            $userClient->user_id = $user->id;
            $userClient->save();
        }


//        User::create($record);

        $status = '您已成功新增會員資料';
        return redirect()->route('user.index')->with(['message' => $status]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $old_userData = User::with('client')->find($id);
//        dd($old_userData);
        return view($this->edit, compact('old_userData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUserData $request, $id)
    {
        //
        $user = User::find($id);
        $userClient = UserClient::where('user_id', $user->id)->first();
//        dd($userClient);
        $validatedUserData = $request->validated();
//        dd($validatedUserData);

        // 這樣會變雙重驗證
//        Validator::make($validatedUserData, [
        // 自定義驗證，忽略不改信箱時的唯一性
//            'email' => [
//                'required',
//                Rule::unique('users')->ignore($user->id),
//            ]
//        ]);


        // 前端資料驗證後，後端再去取得
        foreach ($validatedUserData as $key => $value) {
            $user->role = $validatedUserData['role'];
            $user->name = $validatedUserData['name'];
            $user->email = $validatedUserData['email'];

            // 判斷密碼是否為 null
            $trimPassword = trim($validatedUserData['password']);
            $hasPassword = isset($trimPassword);
            // 判斷密碼是否為空值
            $emptyPassword = empty($trimPassword);
            if ($trimPassword == null) {
                dd(123);
            }
            dd($trimPassword,$hasPassword, $emptyPassword);
//            dd($emptyPassword);
            if ($hasPassword == true) {
//                dd('123');
                if ($emptyPassword == false) {
//                    dd('456');
                    $user->password = Hash::make($validatedUserData['password']);
                }
            }
            // 判斷變數是否有被改變
//            dd($user->wasChanged('password'));
            $user->save();

            $userClient->phone = $validatedUserData['phone'];
            $userClient->address = $validatedUserData['address'];
            // 用 new 的方式必須先讓user save 才能取得 id
            $userClient->user_id = $user->id;
            $userClient->save();
        }
        $status = '您已成功修改會員資料';
        return redirect()->route('user.index')->with(['message' => $status]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $old_userData = User::find($id);
        if ($old_userData->client) {
            $old_userData->client->delete();
        }

//        dd($old_userData);
        $old_userData->delete();

        $status = '您已成功刪除此筆會員資料';
        return  redirect()->route('user.index')->with(['message' => $status]);
    }
}
