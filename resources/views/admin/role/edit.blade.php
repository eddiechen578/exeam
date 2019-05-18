@extends('layouts.app')

@section('content')
    <div class="col-md-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>編輯角色 <small>different form elements</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form class="form-horizontal form-label-left" method="post" action="{{route('roles.update', $role->slug)}}">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">角色名稱</label>
                        <div class="col-md-6 col-sm-6 col-xs-10">
                            <input type="text" class="form-control" name="name" placeholder="輸入角色名稱" value="{{$role->name}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">權限</label>
                        <div class="col-md-10 col-sm-9 col-xs-12">
                            <div class="jp-multiselect">
                                <div class="from-panel">
                                    <select class="form-control" size="8" multiple="multiple">
                                        @foreach($permissions as $permission)
                                            <option value="{{$permission->id}}">{{$permission->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="move-panel">
                                    <button type="button" class="btn-move-selected-right"></button>
                                    <button type="button" class="btn-move-selected-left"></button>
                                </div>
                                <div class="to-panel">
                                    <select id="sites" name="permissions[]" class="form-control" size="8" multiple="multiple">
                                        @foreach($role->permissions as $permission)
                                            <option value="{{$permission->id}}" selected>{{$permission->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="control-panel">
                                    <button type="button" class="btn-delete"></button>
                                    <button type="button" class="btn-up"></button>
                                    <button type="button" class="btn-down"></button>
                                </div>
                            </div>
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
    <link rel="stylesheet" href="{{asset('css/selected/jquery-multi-selection.css')}}">
@endsection

@section('scripts')
    <script src="{{asset('js/selected/jquery.multi-selection.v1.js')}}"></script>
    <script>
        $(function(){

            $(".jp-multiselect").jQueryMultiSelection({autoListSelected: true});

        });
    </script>
@endsection