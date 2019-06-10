

<link rel="stylesheet" href="{{ asset("assets/bower_components/bootstrap/dist/css/bootstrap.min.css") }}">
<link rel="stylesheet" href="{{ asset("assets/bower_components/font-awesome/css/font-awesome.min.css") }}">
<link rel="stylesheet" href="{{ asset("assets/bower_components/Ionicons/css/ionicons.min.css") }}">

{{-- custom css file replace form custom page --}}
@yield('custom-css-file')

<link rel="stylesheet" href="{{ asset("assets/dist/css/AdminLTE.min.css") }}">
<link rel="stylesheet" href="{{ asset("assets/dist/css/skins/skin-blue.min.css") }}">
<link rel="stylesheet" href="{{ asset("assets/admin.css") }}">

<!-- Google Font -->
<link rel="stylesheet" href="{{ asset("assets/fonts/google-fonts.css") }}">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->