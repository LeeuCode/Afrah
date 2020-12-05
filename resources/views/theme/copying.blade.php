@extends('theme.master')

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.gritter.min.css') }}">
@endsection

@section('breadcrumb')
    {{-- <li class="active">الرئيسة</li> --}}
@endsection

@section('container')

    <div class="page-header">
        <h1>
            نسخ الصور للتصميم
            <small>
                <i class="ace-icon fa fa-angle-double-left"></i>
                أضافة اصناف جديده إلي النظام
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

    <div class="col-xs-12">
        <form action="{{ url('copying/store') }}" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="form-group" >
                <label class="col-sm-3 control-label no-padding-right" for="bill-id">رقم الوصل </label>

                <div class="col-sm-3">
                    <select name="bill_id" type="text" id="bill-id" class="form-control">
                        <option value="">إختار  رقم الوصل من فضلك</option>
                        @foreach ($bills as $id)
                        <option value="{{ $id }}">{{ $id }}</option>  
                        @endforeach 
                    </select>
                </div>
            </div>

            <div class="form-group" >
                <label class="col-sm-3 control-label no-padding-right" for="item-id">المطلوب</label>

                <div class="col-sm-3">
                    <select name="item_id" type="text" id="item-id" class="form-control">
                        <option value="">إختار</option>
                    </select>
                </div>
            </div>

            <div class="form-group" >
                <label class="col-sm-3 control-label no-padding-right" for="item-price"> الصورة </label>

                <div class="col-sm-3">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input name="image[]" type="file" id="id-input-file-2" multiple />
                        </div>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>
            <div class="clearfix form-actions">
                <div class="col-md-offset-5 col-md-9">
                    <button class="btn btn-info" type="submit">
                        <i class="ace-icon fa  fa-save bigger-110"></i>
                        حفظ
                    </button>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('custom-script')

    {{-- <script src="{{ asset('assets/js/jquery.inputlimiter.min.js') }}"></script> --}}
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.gritter.min.js') }}"></script>

    <script>
    (function($) {

        // Option to select input
        $('select[name=bill_id]').select2({
            dir: "rtl",
            placeholder: "إختار  رقم الوصل من فضلك",
        });


        $('#id-input-file-1 , #id-input-file-2').ace_file_input({
            no_file:'لا يوجد ملف ....',
            btn_choose:'إختار',
            btn_change:'تغير',
            droppable:false,
            onchange:null,
            thumbnail:false, //| true | large
            whitelist:'gif|png|jpg|jpeg',
            blacklist:'exe|php'
            //onchange:''
            //
        });

        $('#bill-id').on('change',function() {
            var id = $(this).val();

            $.get('{{ url('getBill/items/') }}/'+id, function(data){
                $('#item-id').html(data);
            });
        });

        $(document).on('change','input[name=image]',function(){
            // if(validation() == true){
            //     alert('yes');
            // }
        });

        function validation() {
            var billID = $('select[name=bill_id]').val(),
                itemID = $('select[name=item_id]').val();

                console.log(billID);

            if(billID == ''){
                $.gritter.add({
                    // (string | mandatory) the heading of the notification
                    title: 'خطأ',
                    // (string | mandatory) the text inside the notification
                    text: 'يجب اختيار رقم الفاتورةأولاً',
                    class_name: 'gritter-error'
                });
                $('input[name=image]').val('');
                return false;
            } else if (itemID == '') {
                $.gritter.add({
                    // (string | mandatory) the heading of the notification
                    title: 'خطأ',
                    // (string | mandatory) the text inside the notification
                    text: 'يجب اختيار الصنف المطلوب اضافة الصورة له',
                    class_name: 'gritter-error'
                });
                return false;
            } else {
                return true;
            }
        }
    })(jQuery)
    </script>
@endsection