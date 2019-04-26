@extends('layouts.app')

@section('content')
    <div class="col-md-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>新增商品 <small>different form elements</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form class="form-horizontal form-label-left">
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">商品名稱</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" class="form-control" placeholder="輸入商品名稱">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">選擇類別</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select class="form-control">
                                <option>----選擇類別----</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">商品說明 <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <textarea class="form-control" rows="3" placeholder='商品說明'></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">價格</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="number" name="country" id="autocomplete-custom-append" class="form-control col-md-10"/>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <p>副件檔案</p>
                            </div>
                            <div class="col-md-1 pull-right">
                                <a href="" title="新增圖片"><i class="fa fa-plus fa-2x"></i></a>
                            </div>
                        </div>
                        <div class="col-md-55">
                            <div class="thumbnail">
                                <div class="image view view-first">
                                    <img style="width: 100%; display: block;" src="#" alt="image" />
                                    <div class="mask">
                                        <p>Your Text</p>
                                        <div class="tools tools-bottom">
                                            <a href="#" title="預覽圖片"><i class="fa fa-link"></i></a>
                                            <a href="#" title="更改圖片"><i class="fa fa-pencil"></i></a>
                                            <a href="#" title="刪除圖片"><i class="fa fa-times"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="caption">
                                    <p>Snow and Ice Incoming for the South</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-xs-7 col-xs-push-5">
                            <button type="submit" class="btn btn-success">確定</button>
                        </div>
                        <div class="col-xs-5">
                            <button type="button" class="btn btn-primary">取消</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection