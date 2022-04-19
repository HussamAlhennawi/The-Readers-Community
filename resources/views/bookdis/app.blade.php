<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <link rel="icon" type="image/jpg" href="../assets/img/app_icon.jpg">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>READERS COMMUNITY</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
    <!--Fonts and icons-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- CSS Files -->
    <link href="{{asset('/assets/css/bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('/assets/css/now-ui-dashboard.css?v=1.5.0')}}" rel="stylesheet"/>

{{--    // from old--}}
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

{{--    magnafig--}}
<!-- Magnific Popup core CSS file -->
    <link rel="stylesheet" href="{{asset('css/magnific-popup/magnific-popup.css')}}">
    <!-- jQuery 1.7.2+ or Zepto.js 1.0+ -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<!-- Magnific Popup core JS file -->
    <script src="{{asset('js/magnific-popup/jquery.magnific-popup.js')}}"></script>


    <style>
        /* width */
        ::-webkit-scrollbar {
            width: 7px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #a7a7a7;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #929292;
        }

        /*ul {*/
        /*    margin: 0;*/
        /*    padding: 0;*/
        /*}*/

        /*li {*/
        /*    list-style: none;*/
        /*}*/

        .user-wrapper, .message-wrapper {
            border: 1px solid #dddddd;
            overflow-y: auto;
        }

        .user-wrapper {
            height: 600px;
        }

        .user {
            cursor: pointer;
            padding: 5px 0;
            position: relative;
        }

        .user:hover {
            background: #eeeeee;
        }

        .user:last-child {
            margin-bottom: 0;
        }

        .pending {
            position: absolute;
            left: 13px;
            top: 9px;
            background: #b600ff;
            margin: 0;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            line-height: 18px;
            padding-left: 5px;
            color: #ffffff;
            font-size: 12px;
        }

        .media-left {
            margin: 0 10px;
        }

        .media-left img {
            width: 64px;
            border-radius: 64px;
        }

        .media-body p {
            margin: 6px 0;
        }

        .message-wrapper {
            padding: 10px;
            height: 536px;
            background: #eeeeee;
        }

        .messages .message {
            margin-bottom: 15px;
        }

        .messages .message:last-child {
            margin-bottom: 0;
        }

        .received, .sent {
            width: 45%;
            padding: 3px 10px;
            border-radius: 10px;
        }

        .received {
            /*background: #ffffff;*/
            background: #db4e2a;
        }

        .sent {
            /*background: #3bebff;*/
            background: #5084a5 100%;
            float: right;
            text-align: right;
        }

        .message p {
            margin: 5px 0;
        }

        .date {
            color: white;
            font-size: 12px;
        }

        /*.active {*/
        /*    background: #eeeeee;*/
        /*}*/

        input[type=text] {
            width: 100%;
            padding: 12px 20px;
            margin: 15px 0 0 0;
            display: inline-block;
            border-radius: 4px;
            box-sizing: border-box;
            outline: none;
            border: 1px solid #cccccc;
        }

        input[type=text]:focus {
            border: 1px solid #aaaaaa;
        }
    </style>


</head>
{{--++++++++++++++++++++--}}


{{--<head>--}}
{{--    <meta charset="utf-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}

{{--    <!-- CSRF Token -->--}}
{{--    <meta name="csrf-token" content="{{ csrf_token() }}">--}}

{{--    <title>{{ config('app.name', 'Laravel') }}</title>--}}

{{--    <!-- Scripts -->--}}
{{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}

{{--    <!-- Fonts -->--}}
{{--    <link rel="dns-prefetch" href="//fonts.gstatic.com">--}}
{{--    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">--}}

{{--    <!-- Styles -->--}}
{{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}

{{--    --}}
{{--    --}}
{{--    <style>--}}
{{--        /* width */--}}
{{--        ::-webkit-scrollbar {--}}
{{--            width: 7px;--}}
{{--        }--}}

{{--        /* Track */--}}
{{--        ::-webkit-scrollbar-track {--}}
{{--            background: #f1f1f1;--}}
{{--        }--}}

{{--        /* Handle */--}}
{{--        ::-webkit-scrollbar-thumb {--}}
{{--            background: #a7a7a7;--}}
{{--        }--}}

{{--        /* Handle on hover */--}}
{{--        ::-webkit-scrollbar-thumb:hover {--}}
{{--            background: #929292;--}}
{{--        }--}}

{{--        ul {--}}
{{--            margin: 0;--}}
{{--            padding: 0;--}}
{{--        }--}}

{{--        li {--}}
{{--            list-style: none;--}}
{{--        }--}}

{{--        .user-wrapper, .message-wrapper {--}}
{{--            border: 1px solid #dddddd;--}}
{{--            overflow-y: auto;--}}
{{--        }--}}

{{--        .user-wrapper {--}}
{{--            height: 600px;--}}
{{--        }--}}

{{--        .user {--}}
{{--            cursor: pointer;--}}
{{--            padding: 5px 0;--}}
{{--            position: relative;--}}
{{--        }--}}

{{--        .user:hover {--}}
{{--            background: #eeeeee;--}}
{{--        }--}}

{{--        .user:last-child {--}}
{{--            margin-bottom: 0;--}}
{{--        }--}}

{{--        .pending {--}}
{{--            position: absolute;--}}
{{--            left: 13px;--}}
{{--            top: 9px;--}}
{{--            background: #b600ff;--}}
{{--            margin: 0;--}}
{{--            border-radius: 50%;--}}
{{--            width: 18px;--}}
{{--            height: 18px;--}}
{{--            line-height: 18px;--}}
{{--            padding-left: 5px;--}}
{{--            color: #ffffff;--}}
{{--            font-size: 12px;--}}
{{--        }--}}

{{--        .media-left {--}}
{{--            margin: 0 10px;--}}
{{--        }--}}

{{--        .media-left img {--}}
{{--            width: 64px;--}}
{{--            border-radius: 64px;--}}
{{--        }--}}

{{--        .media-body p {--}}
{{--            margin: 6px 0;--}}
{{--        }--}}

{{--        .message-wrapper {--}}
{{--            padding: 10px;--}}
{{--            height: 536px;--}}
{{--            background: #eeeeee;--}}
{{--        }--}}

{{--        .messages .message {--}}
{{--            margin-bottom: 15px;--}}
{{--        }--}}

{{--        .messages .message:last-child {--}}
{{--            margin-bottom: 0;--}}
{{--        }--}}

{{--        .received, .sent {--}}
{{--            width: 45%;--}}
{{--            padding: 3px 10px;--}}
{{--            border-radius: 10px;--}}
{{--        }--}}

{{--        .received {--}}
{{--            background: #ffffff;--}}
{{--        }--}}

{{--        .sent {--}}
{{--            background: #3bebff;--}}
{{--            float: right;--}}
{{--            text-align: right;--}}
{{--        }--}}

{{--        .message p {--}}
{{--            margin: 5px 0;--}}
{{--        }--}}

{{--        .date {--}}
{{--            color: #777777;--}}
{{--            font-size: 12px;--}}
{{--        }--}}

{{--        .active {--}}
{{--            background: #eeeeee;--}}
{{--        }--}}

{{--        input[type=text] {--}}
{{--            width: 100%;--}}
{{--            padding: 12px 20px;--}}
{{--            margin: 15px 0 0 0;--}}
{{--            display: inline-block;--}}
{{--            border-radius: 4px;--}}
{{--            box-sizing: border-box;--}}
{{--            outline: none;--}}
{{--            border: 1px solid #cccccc;--}}
{{--        }--}}

{{--        input[type=text]:focus {--}}
{{--            border: 1px solid #aaaaaa;--}}
{{--        }--}}
{{--    </style>--}}
{{--</head>--}}

<body class="user-profile">
<div class="wrapper ">
    <div class="sidebar" data-color="orange">
        <div class="logo">
            <a href="http://www.creative-tim.com" class="simple-text logo-normal">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-book-reader fa-2x"></i> &nbsp;&nbsp;&nbsp;READERS COMMUNITY
            </a>
        </div>
        <div class="sidebar-wrapper" id="sidebar-wrapper">
            <ul class="nav">
                <li>
                    <a href="{{ route('user.show', Auth::user())}}">
                        <i class="now-ui-icons users_single-02"></i>
                        <p>MY PROFILE</p>
                    </a>
                </li>
                <li class="active">
                    <a href="{{ route('book.index')}}">
                        <i style="margin-left: 50px;" class="fas fa-book"></i>
                        <p>BOOKS</p>
                    </a>
                    <br>
                    <ul style="list-style: none;">
                        <li class="active">
                            <a href= {{ route('book.show',$book)}}>
                                <p style="text-align: center">{{$book->title}}</p>
                            </a>
                        </li>
                        <br>
                        <ul style="list-style: none;">
                            <li><a href= {{ route('book.show',$book)}}>
                                    <i class="far fa-file-alt"></i>Posts</a></li>
                            <li  class="active"><a href= {{ route('book.dis',$book)}}>
                                    <i class="now-ui-icons ui-1_send"></i>Discussions</a></li>
                            <li><a href= {{ route('book.reading_plan.index',$book)}}>
                                    <i class="fas fa-swatchbook"></i>Reading Plans</a></li>
                            <li><a href= {{ route('book.reading_pre_info.index',$book)}}>
                                    <i class="fas fa-info"></i>Pre-Infos</a></li>
                        </ul>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('group.index')}}">
                        <i class="fas fa-users"></i>
                        <p>GROUPS</p>
                    </a>
                </li>
                <li>
                    <a href="{{ route('author.index')}}">
                        <i class="fas fa-pencil-alt"></i>
                        <p>authors</p>
                    </a>
                </li>
                <li>
                    <a href="{{ route('category.index')}}">
                        <i class="fas fa-layer-group"></i>
                        <p>categories</p>
                    </a>
                </li>
                <li>
                    <a href="{{ route('recommended.books')}}">
                        <i class="now-ui-icons education_glasses"></i>
                        <p>Recommended Books</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-panel" id="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <strong>Discussions Statistics :&nbsp;&nbsp;</strong>
{{--                    <i class="far fa-file-alt"></i>&nbsp;&nbsp;{{count($posts)}} Posts &nbsp;&nbsp;--}}
                    <i class="now-ui-icons ui-1_send"></i>&nbsp;{{count($discussions)}} Discussions &nbsp;&nbsp;
{{--                    <i class="far fa-calendar-alt"></i>&nbsp;{{$events_num}} Events &nbsp;&nbsp;--}}
{{--                    <i class="fas fa-user-friends"></i>&nbsp;&nbsp;{{count($active_members_ids_in_the_group)}} Members--}}
                    &nbsp;&nbsp;
                    {{--edit book info--}}

                        {{--popup edit info--}}
{{--                        <div class="edit-info">--}}
{{--                            <a class="popup-with-form"--}}
{{--                               href="#edit-in">--}}
{{--                                <button class="btn btn-primary btn-round btn-outline-primary btn-sm">Create New Discussion--}}
{{--                                </button>--}}
{{--                            </a>--}}
{{--                        </div>--}}

                <!-- link that opens popup -->
{{--                    <div class="card-body mfp-hide white-popup-block" id="edit-in"--}}
{{--                         style="background-color: #f0f0f0; width: 50%; margin: 0 auto">--}}
{{--                        <center><label class="form-group"><strong>{{ ('Create New Discussion') }}</strong></label>--}}
{{--                        </center>--}}
{{--                        <br>--}}
{{--                        <form id="edit-in" method="POST" action="{{ route('book.discussion.store', $book) }}">--}}
{{--                            @csrf--}}
{{--                            @method('PUT')--}}
{{--                            <input type="hidden" id="user_id" name="user_id" value={{Auth::user()->id}}>--}}

{{--                            <div class="form-group">--}}
{{--                                <label>{{ ('Discussion Title: ') }}</label>--}}
{{--                                <input class="form-control" id="title" type="text" name="title" value="{{ $book->title }}" style="width: 50%" disabled>--}}
{{--                                @error('title')--}}
{{--                                <strong style="color: #FF3636; padding-left: 18px;"> *{{ $message }}</strong>--}}
{{--                                @enderror--}}
{{--                            </div>--}}

{{--                            <div class="form-group">--}}
{{--                                <label>&nbsp;&nbsp;&nbsp;{{ ('Start: ') }}</label><br>--}}
{{--                                <input class="form-control" id="start_at" type="datetime-local" name="start_at" value="{{ old('start_at') }}" style="width: 50%">--}}
{{--                                @error('start_at')--}}
{{--                                <strong style="color: #FF3636; padding-left: 18px;"> *{{ $message }}</strong>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                            <br>--}}
{{--                            <div class="form-group">--}}
{{--                                <label>&nbsp;&nbsp;&nbsp;{{ ('End: ') }}</label><br>--}}
{{--                                <input class="form-control" id="end_at" type="datetime-local" name="end_at" value="{{ old('end_at') }}" style="width: 50%">--}}
{{--                                @error('end_at')--}}
{{--                                <strong style="color: #FF3636; padding-left: 18px;"> *{{ $message }}</strong>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                            <br>--}}
{{--                            <div>--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ ('CREATE') }}--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
                    {{--end popup--}}
                    {{--end of edit--}}
                </div>


                <div class="collapse navbar-collapse justify-content-end" id="navigation">
                    <form method="GET" action="{{ route('book.dis',$book)}}">
                        <div class="input-group no-border">
                            <input type="text" value="" class="form-control" placeholder="Discussions Search ..." name="discussion_title">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <i class="now-ui-icons ui-1_zoom-bold"></i>
                                </div>
                            </div>
                        </div>
                    </form>
{{--                    <ul class="navbar-nav">--}}
{{--                        <li class="nav-item dropdown">--}}
{{--                            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"--}}
{{--                               aria-haspopup="true" aria-expanded="false">--}}
{{--                                <i class="now-ui-icons location_world"></i>--}}
{{--                                <p>--}}
{{--                                    <span class="d-lg-none d-md-block">Some Actions</span>--}}
{{--                                </p>--}}
{{--                            </a>--}}
{{--                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">--}}
{{--                                <a class="dropdown-item" href="#">Action</a>--}}
{{--                                <a class="dropdown-item" href="#">Another action</a>--}}
{{--                                <a class="dropdown-item" href="#">Something else here</a>--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link" href="#pablo">--}}
{{--                                <i class="now-ui-icons users_single-02"></i>--}}
{{--                                <p>--}}
{{--                                    <span class="d-lg-none d-md-block">Account</span>--}}
{{--                                </p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="panel-header panel-header-sm">
        </div>

{{--        new dis--}}
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        {{--add new post--}}
                        <div class="card-header">
                            <h5 class="title">ADD NEW DISCUSSION</h5>
                        </div>
                        <div class="card-body">
                            {{--add new event for group members & not blocked--}}
                            <form method="POST" action="{{ route('book.discussion.store', $book) }}">
                                @csrf
                                <input type="hidden" id="user_id" name="user_id" value={{Auth::user()->id}}>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label><strong>{{ ('Discussion Title :') }}</strong></label>
                                        <input class="form-control" id="title" type="text" name="title"
                                               value="{{ old('title') }}" autofocus>
                                        @error('title')
                                        <strong style="color: #FF3636; padding-left: 18px;">
                                            *{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-5">
                                        <label><strong>{{ ('Start :') }}</strong></label>
                                        <input class="form-control" id="start_at" type="datetime-local"
                                               name="start_at" value="{{ old('start_at') }}">
                                        @error('start_at')
                                        <strong style="color: #FF3636; padding-left: 18px;">
                                            *{{ $message }}</strong>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-2">
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label><strong>{{ ('END :') }}</strong></label>
                                        <input class="form-control" id="end_at" type="datetime-local" name="end_at"
                                               value="{{ old('end_at') }}">
                                        @error('end_at')
                                        <strong style="color: #FF3636; padding-left: 18px;">
                                            *{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>



                                <button type="submit" class="btn btn-primary">ADD DIS</button>
                            </form>
                        </div>
                    </div>
                    {{--                    @endif--}}
                    {{--end of add new post--}}
                </div>
                {{--end of contents--}}
            </div>
        </div>

        <div class="content">
            <div class="row">
                <div class="col-md-12">
                        <div class="card">
                            {{--add new post--}}
                            <div class="card-header">
                                <main class="py-4">
                                    @yield('content')
                                </main>
                            </div>
                            <div class="card-body">

                            </div>
                        </div>
{{--                    @endif--}}
                    {{--end of add new post--}}
                </div>
                {{--end of contents--}}
            </div>
        </div>


    </div>

</div>



{{--<body>--}}
{{--<div id="app">--}}
{{--    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">--}}
{{--        <div class="container">--}}
{{--            <a class="navbar-brand" href="{{ url('/') }}">--}}
{{--                {{ config('app.name', 'Laravel') }}--}}
{{--            </a>--}}
{{--            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">--}}
{{--                <span class="navbar-toggler-icon"></span>--}}
{{--            </button>--}}

{{--            <div class="collapse navbar-collapse" id="navbarSupportedContent">--}}
{{--                <!-- Left Side Of Navbar -->--}}
{{--                <ul class="navbar-nav mr-auto">--}}

{{--                </ul>--}}

{{--                <!-- Right Side Of Navbar -->--}}
{{--                <ul class="navbar-nav ml-auto">--}}
{{--                    <!-- Authentication Links -->--}}
{{--                    @guest--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>--}}
{{--                        </li>--}}
{{--                        @if (Route::has('register'))--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
{{--                            </li>--}}
{{--                        @endif--}}
{{--                    @else--}}
{{--                        <li class="nav-item dropdown">--}}
{{--                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
{{--                                {{ Auth::user()->name }} <span class="caret"></span>--}}
{{--                            </a>--}}

{{--                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">--}}
{{--                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();--}}
{{--                                                     document.getElementById('logout-form').submit();">--}}
{{--                                    {{ __('Logout') }}--}}
{{--                                </a>--}}

{{--                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
{{--                                    @csrf--}}
{{--                                </form>--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                    @endguest--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </nav>--}}

{{--    <main class="py-4">--}}
{{--        @yield('content')--}}
{{--    </main>--}}
{{--</div>--}}

{{--<script src="https://js.pusher.com/5.0/pusher.min.js"></script>--}}
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>--}}
{{--<!--   Core JS Files   -->--}}
{{--<script src="../assets/js/core/jquery.min.js"></script>--}}
<script src="{{asset('/assets/js/core/popper.min.js')}}"></script>
<script src="{{asset('/assets/js/core/bootstrap.min.js')}}"></script>
<script src="{{asset('/assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
<script src="{{asset('/assets/js/now-ui-dashboard.min.js?v=1.5.0')}}" type="text/javascript"></script>



{{--script for members popup--}}
{{--<script>--}}
{{--    $(function () {--}}
{{--        $('.popup-modal').magnificPopup({--}}
{{--            type: 'inline',--}}
{{--            preloader: false,--}}
{{--            focus: '#username',--}}
{{--            modal: true--}}
{{--        });--}}
{{--        $(document).on('click', '.popup-modal-dismiss', function (e) {--}}
{{--            e.preventDefault();--}}
{{--            $.magnificPopup.close();--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}


{{--script for add new discussion--}}
<script>
    $(document).ready(function () {
        $('.popup-with-form').magnificPopup({
            type: 'inline',
            preloader: false,
            focus: '#name'
        });
    });
</script>


<script>
    var discussion_id = '';
    var user_id = "{{ Auth::id() }}";
    $(document).ready(function () {
        // ajax setup form csrf token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

        var pusher = new Pusher('0a02a183c7ad2a4fb8b0', {
            cluster: 'ap2',
            forceTLS: true
        });

        var channel = pusher.subscribe('my-channel');
        // console.log('fff');
        channel.bind('my-event', function (data) {
            // console.log('fff');
            alert(JSON.stringify(data));
            // $('#' + data.discussion_id).click();
            // $('#' + data.user_id).click();
            if (user_id == data.user_id) {
                console.log('tru');
                $('#' + data.discussion_id).click();
            } else if (user_id == data.discussion_id) {
                if (discussion_id == data.user_id) {
                    // if receiver is selected, reload the selected user ...
                    console.log('tru');
                    $('#' + data.user_id).click();
                } else {
                    // if receiver is not seleted, add notification for that user
                    var pending = parseInt($('#' + data.user_id).find('.pending').html());
                    console.log('tru');
                    if (pending) {
                        $('#' + data.user_id).find('.pending').html(pending + 1);
                    } else {
                        $('#' + data.user_id).append('<span class="pending">1</span>');
                    }
                }
            }
        });

        $('.discussion').click(function () {
            $('.discussion').removeClass('active');
            $(this).addClass('active');
            $(this).find('.pending').remove();

            discussion_id = $(this).attr('id');
            $.ajax({
                type: "get",
                url: "{{ROUTE('bookmessage')}}?discussion_id=" + discussion_id, // need to create this route
                data: "",
                cache: false,
                success: function (data) {
                    console.log(data);
                    $('#messages').html(data);
                    scrollToBottomFunc();
                }
            });
        });

        $(document).on('keyup', '.input-text input', function (e) {
            var message = $(this).val();

            // check if enter key is pressed and message is not null also receiver is selected
            if (e.keyCode == 13 && message != '' && discussion_id != '') {
                $(this).val(''); // while pressed enter text box will be empty

                // var datastr = "discussion_id=" + discussion_id + "&text=" + message;

                $.ajax({
                    type: "post",
                    url: "{{ url('/sendmessagefrombook') }}", // need to create this post route
                    dataType: "json",
                    data: {
                        discussion_id: discussion_id,
                        message: message
                    },
                    cache: false,


                    success: function (data) {
                        console.log('tru');
                    },
                    error: function (jqXHR, status, err) {

                    },
                    complete: function () {
                        $('#' + discussion_id).click();
                        scrollToBottomFunc();
                    }
                })
            }
        });
    });

    // make a function to scroll down auto
    function scrollToBottomFunc() {
        $('.message-wrapper').animate({
            scrollTop: $('.message-wrapper').get(0).scrollHeight
        }, 50);
    }
</script>
</body>
</html>
