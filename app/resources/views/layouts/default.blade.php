<!DOCTYPE html>
<html lang="ind">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pembayaran Spp</title>
    @include('includes.head')
</head>
<body>
<div id="wrapper">
  @include('includes.sidebar')
  <div id="page-wrapper" class="gray-bg">
    <div class="row border-bottom">
      @include('includes.header')
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
      @yield('content')
    </div>
    <div class="footer">
      @include('includes.footer')
    </div>
  </div>
</div>
@include('includes.js')
</body>
</html>