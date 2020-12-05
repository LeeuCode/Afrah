@extends('theme.master')

@section('container')
    <div class="page-header">
        <h1>
            النسخ الاحطياتي
            <small>
                <i class="ace-icon fa fa-angle-double-left"></i>
                كل الفواتير بالنظام
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

    <ul class="nav nav-tabs">
        <li class="active">
            <a data-toggle="tab" href="#home">
                <i class="blue ace-icon fa fa-upload bigger-120"></i>
                تصدير
            </a>
        </li>
        <li>
            <a data-toggle="tab" href="#menu1">
                <i class="green ace-icon  fa fa-download  bigger-120"></i>
                استيراد
            </a>
        </li>
    </ul>
    
    <div class="tab-content">
        <div id="home" class="tab-pane fade in active">
            <h3>تصدير البيانات</h3>
            <p></p>
            <form action="{{ url('backUp/export') }}" method="POST">
                {{ csrf_field() }}
                <input type="submit" class="btn btn-info" name="export" id="" value="تصدير  قاعدة البيانات">
            </form>
        </div>
        <div id="menu1" class="tab-pane fade">
            <form method="post" action="{{ url('backUp/import') }}" enctype="multipart/form-data" id="frm-restore">
                {{ csrf_field() }}
                <div class="form-row">
                    <div>Choose Backup File</div>
                    <div>
                        <input type="file" name="backup_file" class="input-file" />
                    </div>
                </div>
                <div>
                    <input type="submit" name="restore" value="Restore"
                        class="btn-action" />
                </div>
            </form>
        </div>
    </div>
        
@endsection