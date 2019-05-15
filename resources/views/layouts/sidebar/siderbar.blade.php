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
                    <li><a href="{{route('categories.index')}}">類別主表</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-user"></i> 顧客</a>
            </li>
            <li><a><i class="fa fa-shopping-cart"></i> 訂單 </a>
            </li>
            <li><a><i class="fa fa-trash"></i>垃圾桶 <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{route('categories.trashed')}}">類別</a></li>
                    <li><a href="fixed_footer.html">Fixed Footer</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-user-secret"></i> 管理者 <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
                <li><a href="index.html">Dashboard</a></li>
                <li><a href="index2.html">Dashboard2</a></li>
                <li><a href="index3.html">Dashboard3</a></li>
            </ul>
            </li>
        </ul>
    </div>
</div>
<!-- /sidebar menu -->