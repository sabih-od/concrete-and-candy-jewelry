<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard-assets/css/all.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('dashboard-assets/css/custom.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('dashboard-assets/css/responsive.css') }}"/>
    <link href="{{ asset('admin-assets/css/icons.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- toastr --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>

    <header>
        <div class="topBar">
            <div class="container-fluid">
                <div class="deliveryList">
                    <ul>
                        <li>
                            <a href="{{ route('front.index') }}" class="logo"><img
                                    src="{{ asset('dashboard-assets/images/newlogo.png') }}"
                                    class="img-fluid" alt="img"></a>
                        </li>
                    </ul>
                    <ul class="subBtn">
                        <li class="notification position-relative">
                            <a href="{{ route('notifications') }}">
                                <img src="{{ asset('dashboard-assets/images/bellicon.png') }}" alt="">
                            </a>
                            <span class="badge badge-success notify-badge">
                                {{ \Illuminate\Support\Facades\Auth::user()->unReadNotifications()->count() ?? 0}}
                            </span>
                        </li>
                        <li>
                            <a href="#" class="user-avtar">
                                <figure>
                                    <img src="{{ \Illuminate\Support\Facades\Auth::user()->userImage() }}"
                                         class="img-fluid" alt="">
                                </figure>
                                <div>
                                    <h5>{{ \Illuminate\Support\Facades\Auth::user()->name ?? '' }}</h5>
                                    {{--                                    <small>User</small>--}}
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <title>Concrete and candy jewelry</title>
    <style>

    </style>
</head>

<body>

<div id="loader-container">
    <div id="loader-text">
        <span class="letter">P</span>
        <span class="letter">L</span>
        <span class="letter">E</span>
        <span class="letter">A</span>
        <span class="letter">S</span>
        <span class="letter">E</span>
        <span class="letter"> </span>
        <span class="letter">W</span>
        <span class="letter">A</span>
        <span class="letter">I</span>
        <span class="letter">T...</span>
    </div>
</div>
