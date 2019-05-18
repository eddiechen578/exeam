@extends('layouts.app')

@section('content')
    <div class="col-md-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>新增管理者 <small>different form elements</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form class="form-horizontal form-label-left" method="post" action="{{route('roles.store')}}">
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">用戶名稱</label>
                        <div class="col-md-6 col-sm-6 col-xs-10">
                            <input type="text" class="form-control" name="name" placeholder="輸入用戶名稱">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">用戶EMAIL</label>
                        <div class="col-md-6 col-sm-6 col-xs-10">
                            <input type="email" class="form-control" name="email" placeholder="輸入用戶email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">密碼</label>
                        <div class="col-md-6 col-sm-6 col-xs-10">
                            <input type="password" class="form-control" name="email" placeholder="輸入用戶密碼">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">確認密碼</label>
                        <div class="col-md-6 col-sm-6 col-xs-10">
                            <input type="password" class="form-control" name="email" placeholder="輸入確認密碼">
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-xs-7 col-xs-push-5">
                            <button id="submit" type="submit" class="btn btn-success">確定</button>
                        </div>
                        <div class="col-xs-5">
                            <a href="" type="button" class="btn btn-primary">取消</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{asset('css/selected/amsify.suggestags.css')}}">
@endsection

@section('scripts')
    <script src="{{asset('js/selected/jquery.amsify.suggestags.js')}}"></script>
    <script>

    </script>
@endsection