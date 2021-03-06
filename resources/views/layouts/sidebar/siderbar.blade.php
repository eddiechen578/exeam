<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="#" class="site_title"><i class="fa fa-paw"></i> <span>Gentelella Alela!</span></a>
        </div>

        <div class="clearfix"></div>
        <br />

<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
            <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="index.html">Dashboard</a></li>
                    <li><a href="index2.html">Dashboard2</a></li>
                    <li><a href="index3.html">Dashboard3</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-edit"></i> 商品基本資料 <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{route('products.index')}}">商品主表</a></li>
                    <li><a href="{{route('productSkuses.index')}}">單品主表</a></li>
                    <li><a href="{{route('categories.index')}}">類別主表</a></li>
                </ul>
            </li>
            <li><a href="{{route('users.index')}}"><i class="fa fa-user"></i> 顧客</a>
            </li>
            <li><a href="{{route('adminOrder.index')}}"><i class="fa fa-shopping-cart"></i> 訂單 </a>
            </li>
            <li><a><i class="fa fa-trash"></i>垃圾桶 <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{route('categories.trashed')}}">類別</a></li>
                    <li><a href="{{route('products.trashed')}}">商品</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-user-secret"></i> 管理者 <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
                <li><a href="{{route('adminUsers.index')}}">人員管理</a></li>
                <li><a href="{{route('roles.index')}}">角色管理</a></li>
            </ul>
            </li>
        </ul>
    </div>
</div>
<!-- /sidebar menu -->
        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <a href="javascript:;" onclick="parentNode.submit();"><span class="glyphicon glyphicon-off" aria-hidden="true"></span></a>
            </form>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>
