<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
   @include('layouts.header.header')
</head>
 <div id="app">
     <body class="nav-md">
     <div class="container body">
         <div class="main_container">

           @include('layouts.sidebar.siderbar')

           @include('layouts.header.head')
           <!-- page content -->
             <div class="right_col" role="main">
                 <div>
           @yield('content')
                 </div>
                 @yield('photowipe')
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
