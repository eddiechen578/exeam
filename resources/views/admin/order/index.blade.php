@extends('layouts.app')

@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                @include('layouts._messages')
                <h2>訂單主表 </h2>
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
                        <th>訂單編號</th>
                        <th>客戶名稱</th>
                        <th>狀況</th>
                        <th>付款方式</th>
                        <th>結單狀況</th>
                        <th class="text-center">查看</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $key => $order)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$order->no}}</td>
                            <td>{{$order->user->name}}</td>
                            <td>
                                @if($order->paid_at)
                                    <span class="badge badge-{{ $order->refund_status_color }}">
                                        @if($order->refund_status === \App\Entities\Order::REFUND_STATUS_PENDING)
                                            已付款
                                        @else
                                            {{ __("order.refund.{$order->refund_status}") }}
                                        @endif
                                    </span>
                                @elseif($order->closed)
                                    <span class="badge badge-info">已關閉</span>
                                @else
                                    <span class="badge badge-danger">未付款</span>
                                @endif
                            <td>{{$order->payment_method}}</td>
                            </td>
                            <td>
                                @if($order->status)
                                    <span>已結單</span>
                                @else
                                    <span>未結單</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @roles('Create Product')
                                <a href="{{route('adminOrder.show', $order)}}"><i class="fa fa-eye"></i></a>
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