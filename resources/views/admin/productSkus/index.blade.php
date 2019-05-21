@extends('layouts.app')

@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                @include('layouts._messages')
                <h2>單品主表 </h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    @roles('Create Product')
                    <li><a href="{{route('productSkuses.create')}}" title="新增商品"><i class=" fa fa-2x fa-plus-square-o"></i></a></li>
                    @endroles
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="datatable-buttons" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>商品名稱</th>
                        <th>單品名稱</th>
                        <th>單品價格</th>
                        <th>商品庫存</th>
                        <th class="text-center">編輯</th>
                        <th class="text-center">刪除</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($productSkuses as $key => $productSkus)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$productSkus->product->name}}</td>
                            <td>{{$productSkus->title}}</td>
                            <td>{{$productSkus->price}}<i class="fa fa-dollar"></i></td>
                            <td>{{$productSkus->stock}}</td>
                            <td class="text-center">
                                @roles('Create Product')
                                <a href="{{route('productSkuses.edit', $productSkus->id)}}"><i class="fa fa-pencil"></i></a>
                                @endroles
                            </td>
                            <td class="text-center">
                                @roles('Create Product')
                                <form action="{{route('productSkuses.destroy', $productSkus->id)}}" method="post">
                                    {{method_field('DELETE')}}
                                    @csrf
                                    <a href="javascript:;" onclick="parentNode.submit();" ><i class="fa fa-trash"></i></a>
                                </form>
                                @endroles
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