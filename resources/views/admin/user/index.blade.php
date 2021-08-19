@extends('layouts.app')

@section('title', '會員管理')

@section('css')

@endsection

@section('content')
<div class="container pt-5">
    <a href="{{ route('user.create') }}" type="button" class="btn btn-block btn-success btn-sm w-25 mb-3">新增會員資料</a>
    <div class="d-flex mb-2">
        <span class="my-auto mr-2">選擇日期區間:</span>
        <input type="text" name="date" id="date_start" class="date">
        <span class="my-auto mx-2">~</span>
        <input type="text" name="date" id="date_end" class="date">
        <button class="btn btn-warning btn-sm ml-3 search-btn">查詢資料清單</button>
    </div>

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
</div>
@endsection

@section('js')
    <script>
        moment().format();
        $.ajaxSetup({
            headers: {
                // 去拿
                // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                // 設定全域的 CSRF-TOKEN 給 ajax 用
                'X-CSRF-TOKEN': '{{csrf_token()}}',
            }
        });
        $(document).ready(function () {
            setTimeout(function () {
                $('#message').remove();
            }, 3000);


            let table = $('#user').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('user.list') }}",
                    data: function (d) {
                        // d 是 function 內的參數，用 d.variable 去自訂要回傳 ajax 的參數
                        // console.log(d);
                        // 取到日期的值，回傳給 $request ，在 controller 呼叫
                        d.date_start = $("#date_start").val();
                        d.date_end = $("#date_end").val();

                        // 選擇方式要寫在後端 controller 去判斷
                        // $( ".date" ).datepicker({
                        //     onSelect: function (){
                        //         let date_start = $( "#date_start" ).datepicker( "getDate" );
                        //         let date_end = $( "#date_end" ).datepicker( "getDate" );
                        //         // console.log(date_end, date_start)
                        //         $(".search-btn").on("click", function (){
                        //             // console.log($.datepicker.formatDate("yy-mm-dd", date_start), $.datepicker.formatDate("yy-mm-dd",date_end));
                        //             let f_date_start = $.datepicker.formatDate("yy-mm-dd", date_start);
                        //             let f_date_end = $.datepicker.formatDate("yy-mm-dd",date_end);
                        //             table
                        //                 .columns(3)
                        //                 .search('admin')
                        //                 .draw();
                        //         })
                        //     }
                        // });
                    },
                },
                columns: [
                    {
                        data: "name",
                        name: "role"
                    },
                    {
                        data: "role",
                    },
                    {
                        data: "email",
                    },
                    {
                        data: "user_client.phone",
                        defaultContent: "",
                        searchable: false,
                        orderable: false,
                    },
                    {
                        data: "user_client.address",
                        defaultContent: "",
                        searchable: false,
                        orderable: false,
                    },
                    {
                        data: "created_at",
                    },
                    {
                        data: "updated_at"
                    },
                    {
                        // action 要寫在前面就是要把 function 寫在 data 裏，用 data-id 抓 id
                        // 指定某個欄位排序
                        // name:"role",
                        // button 也可以長在這
                        data: "action",
                        // 不可被排序及搜尋
                        searchable: false,
                        orderable: false,
                    },
                ],
                language: {
                    processing: '資料處理中...'
                }


            });
            // console.log($('table'));
            // $('.del-btn').on('click').each(function (){
            //     console.log($(this).data('id'))});
            // 選到已經生成的 table 標籤，製作刪除功能
            $('table').on('click', '.del-btn', function () {
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
                    cancelButtonText: '取消'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                            '已刪除!',
                            '您所選的資料已被刪除',
                            'success'
                        )
                        $.ajax({
                            type: "POST",
                            // 可能不支援此方法(?
                            // method:"delete",
                            url: "user" + '/' + user_id,
                            data: {
                                // 生成隱藏的 form 表單並傳入 method 與 value
                                _method: 'DELETE',
                                // _token:'token'
                                // success 不是寫在 data 內，他是 ajax 的參數
                                // success: function (response){
                                //     console.log(response);
                                // },
                            },
                            success: function () {
                                // console.log(response)
                                // 匯出 table 刪除過後的 datatable
                                table.draw()
                            },
                        })
                    }

                })
                // console.log(user_id);

            });
            // 獨立每個 input 與 btn 事件
            $("#date_start").datepicker({
                onSelect:function (){
                    let date_start = $(this).datepicker("getDate");
                    // console.log(date_start)
                    let f_date_start = $.datepicker.formatDate("yy-mm-dd", date_start);
                    $("#date_start").val(f_date_start);
                }
            });
            $("#date_end").datepicker({
                onSelect:function (){
                    let date_end = $(this).datepicker("getDate");
                    let f_date_end = $.datepicker.formatDate("yy-mm-dd", date_end);
                    $("#date_end").val(f_date_end);
                }
            })
            $(".search-btn").on("click", function () {
                // console.log($("#date_start").val() == '',$("#date_start").val() != '' )
                // console.log([$("#date_start").val() !== ''] && [$("#date_end").val() !== ''])
                // 判斷初始條件，有才查詢
                if (($("#date_start").val() !== '') && ($("#date_end").val() !== '')){
                    // alert('456')
                    table.draw();
                } else {
                    Swal.fire('請先選擇日期區間');
                };


                // 用 moment.js 讓前端直接擋掉選擇錯誤
                let m_start = moment($("#date_start").val());
                let m_end = moment($("#date_end").val());
                // console.log(m_start, m_end)
                // console.log(m_start.diff(m_end), m_end.diff(m_start))
                if (m_end.diff(m_start) < 0 ) {
                    Swal.fire('選擇錯誤，請重新選擇日期區間');
                };
            });

            // 同時選擇兩個 input 去 onSelect，同時去做 onclick 事件監聽
            // 導致所有的事件重複掩蓋，所以選擇日期會出錯
            // $(".date").datepicker({
            //     onSelect: function () {
            //         let date_start = $("#date_start").datepicker("getDate");
            //         // $("#date_start").datepicker("option", "defaultDate");
            //         let date_end = $("#date_end").datepicker("getDate");
            //         let f_date_start = $.datepicker.formatDate("yy-mm-dd", date_start);
            //         let f_date_end = $.datepicker.formatDate("yy-mm-dd", date_end);
            //         console.log(123,f_date_start, f_date_end);
            //         $("#date_start").val(f_date_start);
            //         $("#date_end").val(f_date_end);
            //         // console.log(date_end, date_start)
            //         $(".search-btn").on("click", function () {
            //             // console.log($.datepicker.formatDate("yy-mm-dd", date_start), $.datepicker.formatDate("yy-mm-dd", date_end));
            //             // let f_date_start = $.datepicker.formatDate("yy-mm-dd", date_start);
            //             // console.log(f_date_start);
            //             // let f_date_end = $.datepicker.formatDate("yy-mm-dd", date_end);
            //             // console.log(f_date_end);
            //             // // 這樣只會透過前端已經有了資料去搜尋
            //             table.draw();
            //         });
            //     },
            //
            //     // defaultDate: new Date(),
            // });
            // let day1 = new Date(2021, 7, 1);
            // $("#date_start").datepicker('setDate', day1);
            // let day2 = new Date(2021, 7,31);
            // $("#date_end").datepicker('setDate', day2);
        });

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
