
<!DOCTYPE html>
<html class="h-100" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="google-adsense-account" content="ca-pub-9499062034028644">
    <meta name="_token" content="{!! csrf_token() !!}" />
    <meta name="_url" content="{!! URL::to('/') !!}" />
    <meta name="theme" content="light">
    <title> {{ config('app.name') }} </title>

    <link rel="shortcut icon" href="{{ asset('assets/system/images/acrtfm_logo.png') }}" type="image/x-icon">

    <link href="{{ asset('assets/system/plugins/fontawesome/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/system/plugins/toastr/css/toastr.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/system/css/style.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('assets/system/css/override.css') }}" rel="stylesheet" type="text/css">
</head>

<body class="h-100">