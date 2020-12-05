@extends('theme.master')

@section('breadcrumb')
    {{-- <li class="active">الرئيسة</li> --}}
@endsection

@section('container')

    <div class="page-header">
        <h1>
            تكويد الأصناف
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
        <form action="{{ url('item/store') }}" method="POST" class="form-horizontal" role="form">
            {{ csrf_field() }}

            <div class="form-group" >
                <label class="col-sm-3 control-label no-padding-right" for="item-name"> اسم الصنف </label>

                <div class="col-sm-9">
                    <input name="name" type="text" id="item-name" placeholder="أكتب اسم الصنف هنا" class="col-xs-10 col-sm-5">
                </div>
            </div>

            <div class="form-group" >
                <label class="col-sm-3 control-label no-padding-right" for="item-price"> السعر </label>

                <div class="col-sm-1">
                    <input name="price" type="text" id="item-price" placeholder="00" class="col-xs-10 col-sm-12 text-center">
                </div>
            </div>

            <div class="form-group" >
                <label class="col-sm-3 control-label no-padding-right" for="item-delivery"> تسليم بعد </label>

                <div class="col-sm-1">
                    <input name="delivery" type="text" id="item-delivery" placeholder="00" class="col-xs-10 col-sm-12 text-center">
                </div>
                <label class="col-sm-2 control-label no-padding-right" style="text-align: right" for="item-delivery">  يوم  </label>
                
            </div>

            <div class="form-group" >
                <label class="col-sm-3 control-label no-padding-right" for="item-delivery"> الغاء العنصر </label>

                <div class="col-xs-3">
                    <label>
                        <input name="close_item" class="ace ace-switch ace-switch-6" type="checkbox" />
                        <span class="lbl"></span>
                    </label>
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