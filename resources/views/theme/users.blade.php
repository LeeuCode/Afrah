@extends('theme.master')

@section('container')
    <div class="page-header">
        <h1>
            المستخدمون
            <small>
                <i class="ace-icon fa fa-angle-double-left"></i>
                جميع المستخدمون في النظام
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
                <th>اسم المستخدم</th>
                <th>البريد الإلكتروني</th>
                <th>تاريخ الإنشاء</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if(count($users) > 0)
                @foreach ($users as $ky=>$user)
                    <tr>
                        <td><p>{{ $user->name }}</p></td>
                        <td>
                            <p>{{ $user->email }}</p>
                        </td>
                        <td>{{ date('d/m/Y',strtotime($user->created_at)) }}</td>
                        <td>
                            <form action="{{ url('user/delete/').'/'.$user->id }}" method="POST" >
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <a href="{{ url('user/edit').'/'.$user->id }}" class="btn btn-xs btn-info">
                                    <i class="fa fa-pencil-square"></i>
                                </a>
                                @if (Auth::user()->id != $user->id & $user->role != 1)
                                    <button type="submit" class="btn btn-xs btn-danger">
                                        <i class="fa fa-trash-o"></i>
                                    </button>
                                @endif
                            </form>
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

    {{ $users->links() }}


@endsection