@extends('layouts.app')

@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                @include('layouts._messages')
                <h2>顧客主表 </h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="datatable-buttons" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>顧客信箱</th>
                    </tr>
                    </thead>
                    <tbody>
                       @foreach($users as $user)
                        <tr>
                            <td class="details-control"></td>
                            <td>{{$user->email}}</td>
                            <input type="hidden" class="created_hidden" value="{{$user->created_at}}">
                            <input type="hidden" class="name_hidden" value="{{$user->name}}">
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <style>
        td.details-control {
            background: url('https://cdn.rawgit.com/DataTables/DataTables/6c7ada53ebc228ea9bc28b1b216e793b1825d188/examples/resources/details_open.png') no-repeat center center;
            cursor: pointer;
        }
        tr.shown td.details-control {
            background: url('https://cdn.rawgit.com/DataTables/DataTables/6c7ada53ebc228ea9bc28b1b216e793b1825d188/examples/resources/details_close.png') no-repeat center center;
        }
    </style>
@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script>

        function format (n, t ) {
            // `d` is the original data object for the row
            return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
                '<tr>'+
                '<td>顧客姓名:</td>'+
                '<td>'+n+'</td>'+
                '</tr>'+
                '<tr>'+
                '<td>建立時間:</td>'+
                '<td>'+t+'</td>'+
                '</tr>'+
                '</table>';
        }

        var table = $('#datatable-buttons').DataTable({
            language: {
                url: "{{asset('js/plug-ins/Chinese-traditional.json')}}",
            }
        });

        $('#datatable-buttons tbody').on('click', 'td.details-control', function () {
            let tr = $(this).closest('tr');
            let row = table.row(tr);
            let created_at = $(this).closest('tr').find('.created_hidden').val();
            let name = $(this).closest('tr').find('.name_hidden').val();

            if ( row.child.isShown() ) {
                row.child.hide();
                tr.removeClass('shown');
            }
            else {
                row.child(format(name, created_at)).show();
                tr.addClass('shown');
            }
        })
    </script>
@endsection