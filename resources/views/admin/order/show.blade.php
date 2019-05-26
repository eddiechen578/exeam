@extends('layouts.app')

@section('content')
    <div class="col-md-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>訂單明細<small>different form elements</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    @if($order->status)
                        <h4 class="stamp-text">已結單</h4>
                    @endif
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form class="form-horizontal form-label-left" method="post" action="{{route('adminOrder.update', $order->id)}}">
                    {{ method_field('PUT') }}
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">訂單編號:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <span class="form-control">{{$order->no}}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">付款方式:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <span class="form-control">{{$order->payment_method}}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">收件人:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <span class="form-control">{{$order->user->name}}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">收件人地址:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <span class="form-control">{{join(' ', $order->address)}}</span>
                        </div>
                    </div>
                    <hr>
                    <div class="x_title">
                        <h2>訂購商品</h2>
                        <div class="clearfix"></div>
                    </div>
                    <table class="table">
                    <thead>
                        <tr>
                            <th>商品名稱</th>
                            <th>訂購數量</th>
                            <th>評價</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($order->orderItems as $index => $item)
                        <tr>
                            {{-- 商品名稱 --}}
                                <td class="product-info">
                                    <div class="preview">
                                        <img src="{{ $item->product->image_url }}" width="50" height="50">
                                    </div>
                                    <div>
                                        <span class="sku-title">{{ $item->productSku->title }}</span>
                                    </div>
                                </td>

                              {{-- 評分 --}}
                                <td>
                                    <span>
                                         {{ $item->amount}}
                                    </span>
                                </td>

                                {{-- 評價 --}}
                                <td>
                                   {{ $item->review }}
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-xs-6 col-xs-push-4">
                            @if(!$order->status)
                            <button id="submit" type="submit" class="btn btn-success">結單</button>
                            @else
                            <button id="submit" type="submit" class="btn btn-default" disabled>已結單</button>
                            @endif
                        </div>
                        <div class="col-xs-5">
                            <a href="{{route('adminOrder.index')}}" type="button" class="btn btn-primary">取消</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <link href='https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css' rel='stylesheet'>
    <style>
        h4{
            font-size:4em;
            color:red;
            display:inline-block;
            font-family:sans-serif;
            padding:10px 20px;
            margin:40px;
            transform:rotate(-5deg);
        }

        .stamp-text{
            border:10px solid red;
            -webkit-mask-size: contain;
            -webkit-mask-image: url("http://www.textures4photoshop.com/tex/thumbs/crack-grunge-texture-PNG-thumb24.png");
            -o-mask-image:url("http://www.textures4photoshop.com/tex/thumbs/crack-grunge-texture-PNG-thumb24.png");
            -moz-mask-image:url("http://www.textures4photoshop.com/tex/thumbs/crack-grunge-texture-PNG-thumb24.png");
            -ms-mask-image:url("http://www.textures4photoshop.com/tex/thumbs/crack-grunge-texture-PNG-thumb24.png");
            mask-image: url("http://www.textures4photoshop.com/tex/thumbs/crack-grunge-texture-PNG-thumb24.png");
        }
    </style>
@endsection