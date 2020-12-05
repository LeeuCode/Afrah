@extends('theme.master')

@section('breadcrumb')
    {{-- <li class="active">الرئيسة</li> --}}
@endsection

@section('container')

    <div class="page-header">
        <h1>
            تعديل المستخدم
            <small>
                <i class="ace-icon fa fa-angle-double-left"></i>
            تعديل المستخدم "{{ $user->name }}"
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
        <form id="add-user" action="{{ url('user/update').'/'.$user->id }}" method="POST" class="form-horizontal" role="form">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <div class="form-group" >
                <label class="col-sm-3 control-label no-padding-right" for="name"> اسم المستخدم </label>

                <div class="col-sm-9">
                    <input name="name" value="{{ $user->name }}" type="text" id="name" placeholder="أكتب اسم المستخدم هنا" class="col-xs-10 col-sm-5" required autofocus autocomplete="off" >
                </div>
            </div>

            <div class="form-group" >
                <label class="col-sm-3 control-label no-padding-right" for="email"> البريد الالكتروني </label>

                <div class="col-sm-9">
                    <input name="email" value="{{ $user->email }}" type="text" id="email" placeholder="أكتب البريد الإلكتروني للمستخدم هنا" class="col-xs-10 col-sm-5" required autocomplete="off" >
                </div>
            </div>

            <div class="form-group" >
                <label class="col-sm-3 control-label no-padding-right" for="password"></label>

                <div class="col-sm-9">
                    <label class="middle">
                        <input name="change-password" class="ace" type="checkbox" id="id-disable-check">
                        <span class="lbl"> تغير كلمة المرور</span>
                    </label>
                    <br>
                    <input name="password" type="password" id="password" placeholder="**********" class="col-xs-10 col-sm-5 hidden">
                </div>
            </div>

            @if(Auth::user()->id != $user->id)
            <div class="form-group" >
                <label class="col-sm-3 control-label no-padding-right" for="role">صلحية المستخدم</label>

                <div class="col-sm-4">
                    <select name="role" id="role" class="form-control col-xs-10 col-sm-5" required >
                        <option value="">أختار الصلحية للمستخدم</option>
                        <option value="1" {{ ($user->role == 1) ? 'selected' : ''  }} >مدير</option>
                        <option value="2" {{ ($user->role == 2) ? 'selected' : ''  }} >بائع</option>
                        <option value="3" {{ ($user->role == 3) ? 'selected' : ''  }} >مصمم</option>
                    </select>
                </div>
            </div>
            @endif

            <div class="clearfix"></div>
            <div class="clearfix form-actions">
                <div class="col-md-offset-5 col-md-9">
                    <button class="btn btn-info save" type="submit">
                        <i class="ace-icon fa fa-refresh bigger-110"></i>
                        تحديث
                    </button>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('custom-script')

    <script>
        (function($) {
            // $('#add-user').on('submit',function (e) {
                

            //     var pass = $('input[name=password]').val(),
            //         password_repat = $('input[name=password_repat]').val();

            //     if (pass != password_repat) {
            //        alert('كلمت السر غير متطابقة');
            //        e.preventDefault();
            //        return false;
            //     } else {
            //         return true;
            //     }
            // });

            $('input[name=change-password]').on('change',function () {
                $('input[name=password]').toggleClass('hidden');
            })

        })(jQuery)
    </script>

@endsection