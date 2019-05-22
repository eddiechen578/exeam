@extends('layouts.front')

@section('title', $product->title)

@section('content')

    @card
    <product-show inline-template user-favor="{{$favored}}">
        <div class="product-info">
            <div class="d-flex justify-content-between">
                {{-- 商品圖片 --}}
              <div class="col-md-6">
                    <img class="cover" id="mainImg" src="{{ $product->image_url }}" alt="" width="200" height="200">
                   <div class="row">
                       @foreach($product->featureds as $featured)
                       <div class="col-md-4">
                           <div class="thumbnail">
                               <a href="#" onclick="changeImg(this)">
                                   <img class="img-thumbnail" src="/upload/product_{{$product->id}}/{{$featured->name}}"  style="width:100%">
                               </a>
                           </div>
                       </div>
                       @endforeach
                   </div>
              </div>
                {{-- 商品主要資訊 --}}
              <div class="col-md-6">
                    <div class="title">{{ $product->name }}</div>
                    <div class="price"><label>價格</label><em>$</em><span ref="price">{{ $product->price }}</span></div>
                    <div class="sales_and_reviews">
                        <div class="sold_count">累計銷量 <span class="count">{{ $product->sold_count }}</span></div>
                        <div class="review_count">累計評價 <span class="count">{{ $product->review_count }}</span></div>
                        <div class="rating" title="評分 {{ $product->rating }}">
                            評分 <span class="count">{{ str_repeat('★', floor($product->rating)) }}{{ str_repeat('☆', 5 - floor($product->rating)) }}</span>
                        </div>
                    </div>
                    <div class="skus">
                        <label>選擇</label>
                        <div class="btn-group btn-group-sm btn-group-toggle" data-toggle="buttons">
                            @foreach($product->product_skuses as $sku)
                                <label class="btn btn-outline-primary sku-btn"
                                       title="{{ $sku->description }}"
                                       data-toggle="tooltip"
                                       data-placement="bottom"
                                       @click="skuSelected({{ $sku->price }}, {{ $sku->stock }})">
                                    <input type="radio" name="skus" autocomplete="off" value="{{ $sku->id }}"> {{ $sku->title }}
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <div class="cart_amount">
                        <label>數量</label>
                        <input type="number" class="form-control form-control-sm" value="1" min="0" max="9999">
                        <span>件</span>
                        <span class="stock" v-if="showStock">庫存：@{{ stock }}件</span>
                    </div>
                    <div class="buttons">

                       <button class="btn btn-danger btn-disfaver" v-if="userFavor">取消收藏</button>

                       <button class="btn btn-success btn-faver" v-else>❤ 收藏</button>

                       <button class="btn btn-primary btn-add-to-cart">加入購物車</button>
                    </div>
                </div>
            </div>

            {{-- 商品詳細資訊 --}}
            <div class="product-detail mt-3">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a href="#detail" class="nav-link active" role="tab" data-toggle="tab" aria-controls="detail">商品介紹</a>
                    </li>
                    <li class="nav-item">
                        <a href="#reviews" class="nav-link" role="tab" data-toggle="tab" aria-controls="reviews">用戶評價</a>
                    </li>
                </ul>
                <div class="tab-content">

                    {{-- 商品介紹 --}}
                    <div class="tab-pane fade show active" id="detail" role="tabpanel">
                        {!! $product->description !!}
                    </div>

                    {{-- 用戶評價 --}}
                    <div class="tab-pane fade" id="reviews" role="tabpanel">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <td>用戶</td>
                                <td>商品</td>
                                <td>評分</td>
                                <td>評價</td>
                                <td>時間</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($reviews as $review)
                                <tr>
                                    <td>{{ $review->order->user->name }}</td>
                                    <td>{{ $review->productSku->title }}</td>
                                    <td>{{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}</td>
                                    <td>{{ $review->review }}</td>
                                    <td>{{ $review->reviewed_at->format('Y-m-d H:i') }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </product-show>
    @endcard

@endsection

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script>
        function changeImg(e) {
           let src = $(e).find('img').attr('src');
           $('#mainImg').attr('src', src);
        }
        $(function () {

            $('[data-toggle="tooltip"]').tooltip({ trigger: 'hover' })
            $('.btn-faver').click(function () {
                axios.post('{{ route('merchandise.favor', ['product' => $product->id]) }}').then((res) =>{
                    location.reload()
                  })
                });
            $('.btn-disfaver').click(function () {
                axios.delete('{{ route('merchandise.disfavor', ['product' => $product->id]) }}').then(function () {
                    location.reload()
                })
            });
            $('.btn-add-to-cart').click(function () {
                axios.post('{{ route('cart.add') }}', {
                    sku_id: $('label.active input[name=skus]').val(),
                    amount: $('.cart_amount input').val()
                }).then(function () {
                    swal('成功加入購物車', '', 'success').then(function () {
                        location.href = '{{route('cart.index')}}';
                    });
                }).catch(function (error) {
                    if (error.response.status === 401) {
                        swal('請先登入', '', 'error').then(function () {
                            location.href = '{{ route('login') }}'
                        })
                    } else if (error.response.status === 422) {
                        var html = ''
                        var ers = error.response.data.errors
                        Object.keys(ers).forEach(function (key) {
                            ers[key].forEach(function (error) {
                                html += error + '<br>'
                            })
                        })
                        html = '<div>' + html.replace(/<br>$/, '') + '</div>'
                        swal({ content: $(html).get(0), icon: 'error' })
                    } else {
                        swal('系統錯誤', '', 'error')
                    }
                })
            })
        })
    </script>
@endpush