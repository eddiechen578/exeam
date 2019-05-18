@extends('layouts.app')

@section('content')
    <div class="col-md-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                @include('layouts._alertMessages')
                <h2>更新管理者 <small>different form elements</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form class="form-horizontal form-label-left" method="post" action="{{route('adminUsers.update', $user->id)}}">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-4 col-xs-12">用戶名稱</label>
                        <div class="col-md-8 col-sm-8 col-xs-10">
                            <input type="text" class="form-control" name="name" placeholder="輸入用戶名稱" value="{{$user->name}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-4 col-xs-12">用戶EMAIL</label>
                        <div class="col-md-8 col-sm-8 col-xs-10">
                            <input type="email" class="form-control" name="email" placeholder="輸入用戶email" value="{{$user->email}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-4 col-xs-12">密碼</label>
                        <div class="col-md-8 col-sm-8 col-xs-10">
                            <input type="password" class="form-control" name="password" placeholder="輸入用戶密碼" value="{{$user->password}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-4 col-xs-12">確認密碼</label>
                        <div class="col-md-8 col-sm-8 col-xs-10">
                            <input type="password" class="form-control" name="password_confirmation" placeholder="輸入確認密碼" value="{{$user->password}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">角色</label>
                        <div class="col-md-6 col-sm-6 col-xs-10">
                            <input id="roles" type="text" name="roles" value="{{$roles}}" class="form-control">
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-xs-7 col-xs-push-5">
                            <button id="submit" type="submit" class="btn btn-success">確定</button>
                        </div>
                        <div class="col-xs-5">
                            <a href="{{route('adminUsers.index')}}" type="button" class="btn btn-primary">取消</a>
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
        function getRoles() {
            var suggestionsArr = [];
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                async: false,
                type: 'get',
                url: '/admin/get_roles',
                success: function (data) {
                    data.forEach(function (item) {
                        suggestionsArr.push(item.slug)
                    });
                },
                error: function (xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    console.log(err.Message);
                }
            });
            return suggestionsArr;
        }
        let suggestion = getRoles();

        $('#roles').amsifySuggestags({
            type: 'bootstrap',
            suggestions: suggestion,
            backgrounds: ['#1ABB9C'],
            colors: ['white']
        });
    </script>
@endsection
