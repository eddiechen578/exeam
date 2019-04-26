<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
   @include('layouts.header.header')
</head>
 <div id="app">
     <body class="nav-md">
     <div class="container body">
         <div class="main_container">
             <div class="col-md-3 left_col">
                 <div class="left_col scroll-view">
                     <div class="navbar nav_title" style="border: 0;">
                         <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Gentelella Alela!</span></a>
                     </div>

                     <div class="clearfix"></div>

                     <!-- menu profile quick info -->
                     <div class="profile clearfix">
                         <div class="profile_pic">
                             <img src="images/img.jpg" alt="..." class="img-circle profile_img">
                         </div>
                         <div class="profile_info">
                             <span>Welcome,</span>
                             <h2>John Doe</h2>
                         </div>
                     </div>
                     <!-- /menu profile quick info -->
                     <br />
                   @include('layouts.sidebar.siderbar')
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
                         <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                             <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                         </a>
                     </div>
                     <!-- /menu footer buttons -->
                 </div>
             </div>
           @include('layouts.header.head')
           <!-- page content -->
             <div class="right_col" role="main">
           @yield('content')
             </div>
         <!-- footer content -->
             <footer>
                 <div class="pull-right">
                     Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
                 </div>
                 <div class="clearfix"></div>
             </footer>
         </div>
     </div>
  @include('layouts.footer.footer')
  </body>
 </div>
</html>
