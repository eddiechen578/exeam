@extends('layouts.front')

@section('title', '商品評價')

@section('content')

    @card(['body' => false])
    @slot('header')
        商品評價
        <a href="{{ route('orders.index') }}">返回訂單列表</a>
    @endslot

    <form action="{{ route('orders.review.store', $order) }}" method="post">
        @csrf

        <table class="table mb-0">
            <thead>
            <tr>
                <th>商品名稱</th>
                <th>評分</th>
                <th>評價</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order->orderItems as $index => $item)
                <tr>

                    {{-- 商品名稱 --}}
                    <td class="product-info">
                        <div class="preview">
                            <a target="_blank" href="{{ route('products.show', $item->product) }}">
                                <img src="{{ $item->product->image_url }}" width="50" height="50">
                            </a>
                        </div>
                        <div>
                <span class="product-title">
                  <a target="_blank" href="{{ route('products.show', $item->product) }}">
                    {{ $item->product->title }}
                  </a>
                </span>
                       <span class="sku-title">{{ $item->productSku->title }}</span>
                        </div>
                        <input type="hidden" name="reviews[{{ $index }}][id]" value="{{ $item->id }}">
                    </td>

                    {{-- 評分 --}}
                    <td class="align-middle pull-left">
                        @if($order->reviewed)
                            <span class="rating-star-yes">{{ str_repeat('★', $item->rating) }}</span><span class="rating-star-no">{{ str_repeat('★', 5 - $item->rating) }}</span>
                        @else
                                {{--@for ($i = 5; $i >= 1; $i--)--}}
                                    {{--<input type="radio" id="{{ $i }}-star-{{ $index }}" name="reviews[{{ $index }}][rating]" value="{{ $i }}" {{ $i == 5 ? 'checked' : '' }} />--}}
                                    {{--<label for="{{ $i }}-star-{{ $index }}"></label>--}}
                                {{--@endfor--}}
                                <div class="wrapper">
                                    @for($i = 5; $i >= 1; $i-- )
                                    <input type="checkbox" id="{{ $i }}-star-{{ $index }}" name="reviews[{{ $index }}][rating]" value="{{ $i }}" />
                                    <label for="{{ $i }}-star-{{ $index }}"></label>
                                    @endfor
                                    @if($errors->has("reviews.{$index}.rating"))
                                            <div>
                                                <span style="color: red">{{ $errors->first("reviews.{$index}.rating") }}</span>
                                            </div>
                                    @endif
                                </div>
                        @endif
                    </td>

                    {{-- 評價 --}}
                    <td class="{{ $errors->has('reviews.'.$index.'.review') ? 'has-error' : '' }}">
                        @if($order->reviewed)
                            {{ $item->review }}
                        @else
                            <textarea class="form-control @if($errors->has("reviews.{$index}.review")) is-invalid @endif" name="reviews[{{ $index }}][review]"></textarea>
                            @if($errors->has("reviews.{$index}.review"))
                                <span class="invalid-feedback">{{ $errors->first("reviews.{$index}.review") }}</span>
                            @endif
                        @endif
                    </td>

                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td colspan="3" class="text-center">
                    @if(!$order->reviewed)
                        <button type="submit" class="btn btn-primary center-block">提交</button>
                    @else
                        <a href="{{ route('orders.show', $order) }}" class="btn btn-primary">查看訂單</a>
                    @endif
                </td>
            </tr>
            </tfoot>
        </table>
    </form>
    @endcard

@endsection

@push('style')
    <link href='https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css' rel='stylesheet'>
    <style>
        .wrapper {
            position: relative;
            display: inline-block;
            border: none;
            font-size: 14px;
            margin: 20px 0px 20px 0px;
            left: 30%;
            transform: translateX(-50%);
        }

        .wrapper input {
            border: 0;
            width: 1px;
            height: 1px;
            overflow: hidden;
            position: absolute !important;
            clip: rect(1px 1px 1px 1px);
            clip: rect(1px, 1px, 1px, 1px);
            opacity: 0;
        }

        .wrapper label {
            position: relative;
            float: right;
            color: #C8C8C8;
        }

        .wrapper label:before {
            margin: 5px;
            font-family: FontAwesome;
            content: "\f005";
            display: inline-block;
            font-size: 1.5em;
            color: #ccc;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        .wrapper input:checked ~ label:before {
            color: #FFC107;
        }

        .wrapper label:hover ~ label:before {
            color: #ffdb70;
        }

        .wrapper label:hover:before {
            color: #FFC107;
        }

    </style>
@endpush