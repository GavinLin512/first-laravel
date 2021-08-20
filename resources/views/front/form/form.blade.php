@extends('layouts.app')

@section('title', '會員管理')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection

@section('content')
    {{--    <hr>--}}
    <div class="container">
        <div class="card card-lightblue card-outline mb-0">
            <div class="card-body">
                <ul class="nav nav-tabs" id="custom-content-above-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-content-above-home-tab" data-toggle="pill"
                           href="#custom-content-above-home" role="tab" aria-controls="custom-content-above-home"
                           aria-selected="true">逐一新增</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-content-above-profile-tab" data-toggle="pill"
                           href="#custom-content-above-profile" role="tab" aria-controls="custom-content-above-profile"
                           aria-selected="false">表單新增</a>
                    </li>
                </ul>

                <div class="tab-content" id="custom-content-above-tabContent">
                    <div class="tab-pane fade active show px-2" id="custom-content-above-home" role="tabpanel"
                         aria-labelledby="custom-content-above-home-tab">
                        <p class="lead border-bottom mt-3">基本資料</p>
                        {{-- 基本資料 --}}
                        <div class="form-group row mb-2 mb-md-3">
                            <div class="col-12 col-md-6 d-flex align-content-center mb-2 m-md-0">
                                <label for="country" class="mb-0 d-flex align-items-center col-3">*國別</label>
                                <select id="country" class="form-control col-3">
                                    <option>台灣</option>
                                    <option>美國</option>
                                    <option>日本</option>
                                    <option>韓國</option>
                                    <option>泰國</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6 d-flex align-content-center">
                                <label for="taxID" class="mb-0 d-flex align-items-center col-3">統一編號</label>
                                <input type="number" class="form-control col-9" id="taxID" placeholder="請填寫正確企業編號"
                                       onKeypress="return (/[\d\.]/.test(String.fromCharCode(event.keyCode)))"
                                       oninput="value=value.replace(/[^\d]/g,'')">
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <div class="col-12 col-md-6 d-flex align-content-center mb-2 m-md-0">
                                <label for="chi_name" class="mb-0 d-flex align-items-center col-3">*中文名稱</label>
                                <input type="text" class="form-control col-9" id="chi_name" placeholder="請填寫正確企業名稱">
                            </div>
                            <div class="col-12 col-md-6 d-flex align-content-center">
                                <label for="eng_name" class="mb-0 d-flex align-items-center col-3">英文名稱</label>
                                <input type="text" class="form-control col-9" id="eng_name" placeholder="請填寫正確企業名稱">
                            </div>
                        </div>

                        <div class="form-group row mb-3 px-2">
                            <div class="col-3 col-md-1 d-md-flex align-content-md-center mb-2">
                                <label for="address" class="mb-0 d-flex align-items-center ">*地址</label>
                            </div>
                            <input type="text" class="form-control col-12 col-md-11" id="address" placeholder="請填寫正確地址">
                        </div>

                        <div class="form-group row mb-3 px-2">
                            <div class="col-3 col-md-1 d-md-flex align-content-md-center mb-2 m-md-0">
                                <label for="phone" class="mb-0 d-flex align-items-center ">電話</label>
                            </div>
                            <input type="number" class="form-control col-12 col-md-11" id="phone" placeholder="請填寫有效電話">
                        </div>

                        <div class="form-group row mb-5">
                            <div class="col-12 col-md-6 d-md-flex">
                                <label for="exampleInputFile" class="m-md-0 d-flex align-items-center mb-2 col-3 col-md-2">附件</label>
                                <div class="input-group col-12 col-md-10 pl-0">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">請上傳檔案</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 d-flex align-content-center">
                                <p class="mb-0 mt-1 d-flex align-items-center">(檔案以jpg/gif/pdf為主，不超過10mb)</p>
                            </div>
                        </div>
                        {{-- 作業方式 --}}
                        <p class="lead border-bottom mt-5">作業方式</p>
                        <div class="form-group row mb-3">
                            <label class="mb-2 mb-md-0 d-flex col-12 col-md-1">*作業速度</label>
                            <div class="col-12 col-md-5 d-flex flex-wrap">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="radio1" checked="checked">
                                    <label class="form-check-label mr-2">普通(8~10個工作天)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="radio1">
                                    <label class="form-check-label">加急(5~8個工作天)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="radio1">
                                    <label class="form-check-label mr-2">特急(2~3個工作天)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="radio1">
                                    <label class="form-check-label">速急(1個工作天/限台灣地區)</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="mb-2 mb-md-0 d-flex col-12 col-md-1">*保密程度</label>
                            <div class="col-12 col-md-11 d-flex flex-column">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="radio2" checked="checked">
                                    <label class="form-check-label mr-2">確責保密</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input d-flex mt-2" type="radio" name="radio2">
                                    <label class="form-check-label d-flex align-items-center">
                                        可透露委託者(姓名
                                        <input type="text" class="form-control form-control-sm col-2">
                                        及連絡電話
                                        <input type="number" class="form-control form-control-sm col-3">
                                        )
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="invest" class="mb-2 mb-md-0 col-12 col-md-1">調查重點</label>
                            <textarea class="form-control mx-2" id="invest" name="invest" rows="2"
                                      placeholder="請填寫(字數1000字為上限)"></textarea>
                        </div>
                        {{-- 加購項目 --}}
                        <p class="lead border-bottom mt-5">加購項目</p>
                        <div class="form-group row mb-3">
                            <label class="mb-0 d-flex col-1">語言版本</label>
                            <div class="col-11 d-flex ">
                                <div class="form-check">
                                    <input class="form-check-input" id="chi" type="checkbox" checked="checked">
                                    <label class="form-check-label mr-5" for="chi">中文(預設)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="eng" type="checkbox">
                                    <label class="form-check-label mr-5" for="eng">英文</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="jp" type="checkbox">
                                    <label class="form-check-label" for="jp">日文</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="mb-0 d-flex ml-2 mr-3">第一類資訊查詢:</label>
                            <div class="col-10 d-flex ">
                                <div class="form-check">
                                    <input class="form-check-input" id="company-1" name="company" type="checkbox" checked="checked">
                                    <label class="form-check-label mr-5" for="company-1">公司</label>
                                </div>
                                <div class="form-check col-4">
                                    <input class="form-check-input" id="principal-1" name="principal" type="checkbox">
                                    <label class="form-check-label mr-5 d-flex m-label" for="principal-1">
                                        <p class="col-4 mb-0">負責人</p>
                                        <input type="number" class="form-control form-control-sm col-8 id" placeholder="請輸入身分證字號">
                                    </label>
                                </div>
                                <div class="form-check col-4">
                                    <input class="form-check-input" id="manager-1" name="manager" type="checkbox">
                                    <label class="form-check-label mr-5 d-flex m-label" for="manager-1">
                                        <p class="col-4 mb-0">總經理</p>
                                        <input type="number" class="form-control form-control-sm col-8" placeholder="請輸入身分證字號">
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="mb-0 d-flex ml-2 mr-3">第二類資訊查詢:</label>
                            <div class="col-10 d-flex ">
                                <div class="form-check">
                                    <input class="form-check-input info-check" id="company-2" name="company" type="checkbox">
                                    <label class="form-check-label mr-5" for="company-2">公司</label>
                                </div>
                                <div class="form-check col-4">
                                    <input class="form-check-input" id="principal-2" name="principal" type="checkbox">
                                    <label class="form-check-label mr-5 d-flex m-label" for="principal-2">
                                        <p class="col-4 mb-0">負責人</p>
                                        <input type="number" class="form-control form-control-sm col-8 info-check" placeholder="請輸入身分證字號">
                                    </label>
                                </div>
                                <div class="form-check col-4">
                                    <input class="form-check-input" id="manager-2" name="manager" type="checkbox">
                                    <label class="form-check-label mr-5 d-flex m-label" for="manager-2">
                                        <p class="col-4 mb-0">總經理</p>
                                        <input type="number" class="form-control form-control-sm col-8 info-check" placeholder="請輸入身分證字號">
                                    </label>
                                </div>
                            </div>
                        </div>
{{--                        <button class="btn btn-primary mt-5" id="upload">加入並繼續委託</button>--}}
                        <button type="button" class="btn btn-primary mt-5" id="upload" data-toggle="modal" data-target="#modal-default">加入並繼續委託</button>
                        <input type="text" id="test">
                        {{-- Modal --}}
                        <div class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">是否要繼續?</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body d-flex flex-column">
                                        <label for="y_n">請輸入是/否</label>
                                        <input type="text" id="y_n">
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                        <button type="button" class="btn btn-primary" id="continue" >繼續</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>

                        <div class="modal fade" id="static_load"
                             data-backdrop="static" tabindex="-1"
                             role="dialog"
                             {{--         aria-labelledby="staticBackdropLabel" --}}
                             aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">載入中...<i class="fas fa-sync fa-spin"></i></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade px-2" id="custom-content-above-profile" role="tabpanel"
                         aria-labelledby="custom-content-above-profile-tab">
                        <h6 class="lead border-bottom mt-3">調查對象</h6>
                        <p class="mb-3">您可以下載範例檔案，新增您需要的調查對象，整批上傳至委託清單進行委託。</p>
                        <br>
                        <a href="">下載檔案範例</a>
                        <br>
                        <div class="form-group row mt-5 px-2">
                            <div class="col-12 col-md-6 d-flex pl-0">
                                <label for="exampleInputFile" class="m-0 p-0 d-flex align-items-center col-2">檔案上傳</label>
                                <div class="input-group col-10 pl-0">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">請上傳檔案</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-10 col-md-6 mt-2 mt-md-0 ml-2 ml-md-0 d-flex justify-content-center justify-content-md-start align-content-center">
                                <p class="mb-0 d-flex align-items-center">(檔案以excel/csv為主，不超過10mb)</p>
                            </div>
                            <button class="btn btn-primary mt-5">上傳並加入委託</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>

    </div>
@endsection

@section('js')
    <script>
        $(function() {
            console.log(123);
            $("input:checkbox").on('click', function (){
                let $box = $(this);
                if ($box.is(":checked")) {
                    let group = "input:checkbox[name = '" + $box.attr("name") + "']";
                    // 全部先取消後，再勾選選擇的 input
                    $(group).prop("checked", false);
                    $box.prop("checked", true);
                } else {
                    $box.prop("checked", false);
                }
            });
                $("#continue").on('click',function (){
                    let y_n =  $("#y_n").val();
                    $("#test").val(y_n);
                    console.log($("#test").val());
                    // $(".modal").removeClass("show");
                    // console.log($(this).prev())
                    // 選到同層的前一個元素，並按下觸發事件
                    // $(this).prev().click();
                    $("#modal-default").modal('hide');
                });
        })
        // $(document).ready(
        //
        //
        // // $(".m-label").on('click', function (){
        // //         console.log(123)
        // //         $(".id").onfocus
        // //     })
        // )
    </script>
@stop
