@extends('layouts.app')

@section('content')
    <div class="col-md-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>新增單品 <small>different form elements</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form class="form-horizontal form-label-left" method="post" action="{{route('productSkuses.store')}}">
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">選擇商品</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select id="product_id" name="product_id" class="form-control">
                                    <option>------請選擇商品------</option>
                                @foreach($products as $product)
                                    <option value="{{$product->id}}">{{$product->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="x_content">
                      <div class="dashboard-widget-content">
                       <div class="col-md-2 ">
                           <div class="thumbnail">
                               <div class="image view view-first demo-gallery">
                                   <img id="img_name" style="width: 100%; height:80%;display: block;" src="#" alt="image" uuid=""/>
                                   <div class="mask">
                                   </div>
                               </div>
                               <div class="caption">
                                   <p>商品圖</p>
                               </div>
                           </div>
                       </div>
                        <div class="col-md-8 hidden-small">
                          <h2 class="line_30" id="product_name"></h2>
                            <table class="countries_list">
                              <tbody>
                                <tr>
                                    <td>類別</td>
                                    <td id="category_name" class="fs15 fw700 text-right"></td>
                                </tr>
                                <tr>
                                    <td>敘述</td>
                                    <td id="description" class="fs15 fw700 text-right"></td>
                                </tr>
                                <tr>
                                    <td>上架</td>
                                    <td id="on_sale" class="fs15 fw700 text-right"></td>
                                </tr>
                          </tbody>
                        </table>
                       </div>
                      <div class="col-md-2 "></div>
                     </div>
                  </div>
                  <div class="form-group">
                          <label class="control-label col-md-2 col-sm-2 col-xs-2">單品名稱</label>
                          <div class="col-md-8 col-sm-8 col-xs-8">
                              <input type="text" class="form-control" name="title"
                                placeholder="輸入單品名稱"
                              >
                          </div>
                  </div>
                  <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-2">敘述</label>
                        <div class="col-md-8 col-sm-8 col-xs-8">
                            <input type="text" class="form-control" name="description"
                                   placeholder="輸入敘述"
                            >
                        </div>
                  </div>
                  <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-2">價格</label>
                        <div class="col-md-8 col-sm-8 col-xs-8">
                            <input type="number" class="form-control" name="price"
                                   placeholder="輸入價格"
                            >
                        </div>
                  </div>
                  <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-2">庫存
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-8">
                            <input type="number" class="form-control" name="stock"
                                   placeholder="輸入庫存"
                            >
                        </div>
                  </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-xs-7 col-xs-push-5">
                            <button id="submit" type="submit" class="btn btn-success">確定</button>
                        </div>
                        <div class="col-xs-5">
                            <a href="{{route('productSkuses.index')}}" type="button" class="btn btn-primary">取消</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#product_id').on('change', function () {
            let product_id = $(this).val();

            ajax_get(product_id);
        })

        function ajax_get(product_id) {

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: '/admin/products/product_details',
                data: {
                    'product_id': product_id
                },

                success: function(res){
                   $('#img_name').attr('src', '/upload/product_'+product_id+'/'+res.status.img_name);
                   $('#category_name').html(res.status.category_name);
                   $('#product_name').html(res.status.product_name);
                   $('#description').html(res.status.description);
                   $('#on_sale').html(res.status.on_sale);
                },

                error: function(xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    console.log(err.Message);
                }
            });
        }
    </script>
@endsection