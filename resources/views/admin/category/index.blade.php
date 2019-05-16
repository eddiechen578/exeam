@extends('layouts.app')

@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                @include('layouts._messages')
                <h2>類別主表 </h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a href="{{route('categories.create')}}" title="新增類別"><i class=" fa fa-2x fa-plus-square-o"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="datatable-buttons" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>類別名稱</th>
                        <th class="text-center">編輯</th>
                        <th class="text-center">刪除</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $key => $category)
                          <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$category->name}}</td>
                            <td class="text-center">
                                <a href="{{route('categories.edit', $category->slug)}}"><i class="fa fa-pencil"></i></a>
                            </td>
                            <td class="text-center">
                                <form method="POST" action="{{route('categories.destroy', $category->slug)}}">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <a href="javascript:;" onclick="parentNode.submit();" ><i class="fa fa-trash"></i></a>
                                </form>
                            </td>
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
@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script>

        $('#datatable-buttons').DataTable({
            language: {
                url: "{{asset('js/plug-ins/Chinese-traditional.json')}}"
            }
        });
    </script>
@endsection