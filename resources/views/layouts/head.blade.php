<!-- Title -->
<title>@yield("title", "Default Title")</title> <!-- إضافة عنوان افتراضي في حال عدم تحديده -->

<!-- Favicon -->
<link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.ico') }}" type="image/x-icon" />

<!-- Font -->
<link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">

<!-- Custom CSS (Page-specific CSS) -->
@yield('css')

<!-- Main Style CSS -->
<link href="{{ URL::asset('assets/css/style.css') }}" rel="stylesheet">

<!-- Directional CSS based on Locale -->
@if (App::getLocale() == 'en')
    <link href="{{ URL::asset('assets/css/ltr.css') }}" rel="stylesheet">
@else
    <link href="{{ URL::asset('assets/css/rtl.css') }}" rel="stylesheet">
@endif
