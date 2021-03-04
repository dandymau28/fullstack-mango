<!DOCTYPE html>
<html lang="en">
@include('templates.admin.head')

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
@include('templates.admin.navbar')
@include('templates.admin.sidebar')

<div class="content-wrapper">
{{-- @include('templates.admin.content-header') --}}
@include('templates.admin.header')
@yield('content')
</div>

@include('templates.admin.footer')
</div>
@include('templates.admin.foot')
</body>
</html>