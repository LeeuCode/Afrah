@extends('theme.master')


@section('custom-css')
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
@endsection

@section('breadcrumb')
    {{-- <li class="active">الرئيسة</li> --}}
@endsection

@section('container')
    <div class="page-header">
        <h1>
            البحث
            <small>
                <i class="ace-icon fa fa-angle-double-left"></i>
                البحث في ارشيف الصور
            </small>
        </h1>
    </div>

    <div class="col-md-12">
        @if (Session::has('status')) 
            <div class="alert alert-block alert-success">
                <button type="button" class="close" data-dismiss="alert">
                    <i class="ace-icon fa fa-times"></i>
                </button>
                <p>
                    <strong>
                        <i class="ace-icon fa fa-check"></i>
                        تم بنجاح!
                    </strong>
                    {{ Session::get('status') }}
                </p>
            </div>
        @endif
    </div>

    <div class="container-fluid" >
        <div class="row">
            <form id="search-form" action="{{ url('copying/searchResult') }}" method="POST" >
                {{ csrf_field() }}
                <div class="col-xs-12">
                    <div class="widget-box" id="widget-box-1">
                        <div class="widget-header">
                            <h5 class="widget-title">
                                <i class="fa fa-wpforms"></i>
                                بحث متقدم
                            </h5>
                        </div>
        
                        <div class="widget-body">
                            <div class="widget-main" style="overflow: auto">
                                <div class="col-md-1 col-xs-12">  
                                    <div class="form-group">
                                        <label for="id-bill">رقم الفاتورة</label>
                                        <input name="bill_id" type="text" class="form-control text-center" id="id-bill" placeholder="00" autofocus autocomplete="off">
                                    </div>
                                </div>

                                <div class="col-md-4 col-xs-12">
                                    {{-- Agent Name --}}
                                    <div class="form-group">
                                        <label for="agent-name">اسم العميل</label>
                                        <input name="agent_name" type="text" class="form-control" id="agent-name" placeholder="أكتب اسم العميل هنا" autocomplete="off" >
                                    </div>
                                    {{-- /.Agent Name --}}
                                </div>

                                <div class="col-md-3 col-xs-12">
                                    {{-- Item Name --}}
                                    <div class="form-group">
                                        <label for="item-name">الصنف</label>
                                        <select name="item_id" class="form-control" id="item-name">
                                            <option value="">أختار صنف من هنا</option>
                                            @foreach ($items as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- /.Item Name --}}
                                </div>

                                <div class="col-md-2 col-xs-12">
                                    <div class="form-group">
                                        <label for="bill-date">تاريخ الفاتورة</label>
                                        <input name="bill_date" type="text" class="form-control date-picker" id="bill-date" value="" autocomplete="off">
                                    </div>
                                </div>

                                <div class="col-md-2 col-xs-12">
                                    {{-- Add To Bill --}}
                                    <div class="form-group">
                                        <label for="item-price" style="display: block;color: transparent;">الكمية</label>
                                        <button id="add-to-bill" class="btn btn-primary btn-block btn-xs" style="padding: 4px 6px 5px;">
                                            <i class="ace-icon fa fa-search align-top bigger-125"></i>
                                            البحث في الارشيف
                                        </button>
                                    </div>
                                    {{-- /.Add To Bill --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <div class="col-xs-12">
                <div class="load">
                    <i class="fa fa-refresh fa-spin" style="font-size: 45px;"></i>
                </div>
                <table class="table table-bordered table-hover archive-search-table">
                    <thead>
                        <tr>
                            <th>الصورة</th>
                            <th>رقم الصنف</th>
                            <th>اسم العميل</th>
                            <th>عدد الصور في المجلد</th>
                            <th>مسار الصورة</th>
                            <th>الباقي / المتبقي</th>
                            <th>تاريخ الانشاء</th>
                        </tr>
                    </thead>
                    <tbody class="search-result" >
                        <tr>
                            <td class="text-center" colspan="7"><i>لم تقم بإجاراء إي عملية بحث حتي الأن.</i></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('custom-script')
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/clipboard.min.js') }}"></script>
    
    <script>
        (function($) {
            // Option to select input
            $('#item-name').select2({
                dir: "rtl",
                placeholder: "أختار الصنف من هنا",
            });

            //datepicker plugin
            $('.date-picker').datepicker({
                lang: 'ar',
                autoclose: true,
                todayHighlight: true,
                format: 'yyyy-mm-dd'
            });

            $(document).on('submit', '#search-form',function (e) {
                e.preventDefault();

                var url = $(this).attr('action'),
                    data = $(this).serialize();

                getResult(url,data)
            });

            $(document).on('click','.pagination li a',function(e) {
                e.preventDefault();

                $('.load').css('visibility','visible');

                var url = $(this).attr('href'),
                    data = $('#search-form').serialize();
                    
                getResult(url,data);
            });


            function getResult(url,data)
            {
                $.post(url, data, function(data, status){
                    $('.search-result').html(data);
                    $('.load').css('visibility','hidden');
                });
            }

            var clipboard = new ClipboardJS('.copy');

            clipboard.on('success', function(e) {

                $.gritter.add({
                // (string | mandatory) the heading of the notification
                title: 'تم بنجاح !',
                // (string | mandatory) the text inside the notification
                text: 'نسخ المسار ' + e.text,
                class_name: 'gritter-success'
            });
                // console.log(e.text);
            });

            clipboard.on('error', function(e) {
                console.log(e);
            });

        })(jQuery)
    </script>
@endsection