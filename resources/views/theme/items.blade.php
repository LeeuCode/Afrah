@extends('theme.master')

@section('container')
    <div class="page-header">
        <h1>
            الأصناف
            <small>
                <i class="ace-icon fa fa-angle-double-left"></i>
                جميع الأنصاف في النظام
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
    <table id="simple-table" class="table  table-bordered table-hover">
        <thead>
            <tr>
                <th>اسم الصنف</th>
                <th>السعر</th>
                <th>التسليم بعد</th>
                <th>تاريخ الإنشاء</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if(count($items) > 0)
                @foreach ($items as $item)
                    <tr>
                        <td><p>{{ $item->name }}</p></td>
                        <td>{{ $item->price }}</td>
                        <td>
                            <span class="badge badge-success">{{ $item->delivery }}</span>
                        </td>
                        <td>{{ date('d/m/Y',strtotime($item->created_at)) }}</td>
                        <td>
                            <a href="{{ url('item/edit').'/'.$item->id }}" class="btn btn-xs btn-info">
                                <i class="fa fa-pencil-square"></i>
                            </a>
                            {{-- <button type="button" class="btn btn-xs btn-danger">
                                <i class="fa fa-trash-o"></i>
                            </button> --}}
                        </td>
                    </tr>
                @endforeach
            @else 
                <tr>
                    <td class="text-center" colspan="5" >
                        <i>لا توجد اي أصناف تم أضافتها حتي الأن.</i>
                    </td>
                </tr>
            @endif
        </tbody>
    </table>

    {{ $items->links() }}


@endsection