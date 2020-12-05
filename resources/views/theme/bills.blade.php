@extends('theme.master')

@section('container')
    <div class="page-header">
        <h1>
            الفواتير
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

    <div class="" id="widget-container-col-1">
        <div class="widget-box ui-sortable-handle collapsed" id="widget-box-1">
            <div class="widget-header">
                <h5 class="widget-title">البحث</h5>
                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-down"></i>
                    </a>
                </div>
            </div>

            <div class="widget-body" style="display: none;">
                <div class="widget-main">
                    <p class="alert alert-info">
                        Nunc aliquam enim ut arcu aliquet adipiscing. Fusce dignissim volutpat justo non consectetur. Nulla fringilla eleifend consectetur.
                    </p>
                    <p class="alert alert-success">
                        Raw denim you probably haven't heard of them jean shorts Austin.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <table id="bills" class="table  table-bordered table-hover">
        <thead>
            <tr>
                <th>رقم الفاتورة</th>
                <th>اسم العميل</th>
                <th>المدفوع</th>
                <th>الإجمالي</th>
                <th>تاريخ الإنشاء</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if(count($bills) > 0)
                @foreach ($bills as $bill)
                    <tr>
                        <td style="width: 80px" class="text-center">
                            <span class="badge badge-grey" >{{ $bill->id }}</span>
                        </td>
                        <td><p>{{ $bill->agentName }}</p></td>
                        <td>
                            <span class="badge badge-primary">{{ $bill->paid }}</span>
                        </td>
                        <td>
                            <span class="badge badge-success">{{ $bill->turnover }}</span>
                        </td>
                        <td>{{ date('Y-m-d',strtotime($bill->created_at)) }}</td>
                        <td class="text-center" >
                            <a href="{{ url('bill/view').'/'.$bill->id }}" class="btn btn-xs btn-info">
                                <i class="fa fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            @else 
                <tr>
                    <td class="text-center" colspan="6" >
                        <i>لا توجد اي فواتير تم أضافتها حتي الأن.</i>
                    </td>
                </tr>
            @endif
        </tbody>
    </table>

    {{ $bills->links() }}


@endsection