<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <link rel="icon" type="image/jpg" href="../assets/img/app_icon.jpg">

    <title>READERS COMMUNITY</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport'/>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- CSS Files -->
    <link href="{{asset('/assets/css/bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('/assets/css/now-ui-dashboard.css?v=1.5.0')}}" rel="stylesheet"/>

    <!-- Magnific Popup core CSS file -->
    <link rel="stylesheet" href="{{asset('css/magnific-popup/magnific-popup.css')}}">
    <!-- jQuery 1.7.2+ or Zepto.js 1.0+ -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <!-- Magnific Popup core JS file -->
    <script src="{{asset('js/magnific-popup/jquery.magnific-popup.js')}}"></script>

    {{--Chosen--}}
    {{--    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>--}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.5/chosen.jquery.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.5/chosen.css" rel="stylesheet" type="text/css">

</head>

<body class="user-profile">
<div class="wrapper ">

    <div class="sidebar" data-color="orange">
        <div class="logo">
            <a href="{{ route('/')}}" class="simple-text logo-normal">
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

                <li>
                    <a href="{{ route('book.index')}}">
                        <i class="fas fa-book"></i>
                        <p>BOOKS</p>
                    </a>
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
                <li class="active">
                    <a href="{{ route('users.posts', $user)}}">
                        <i style="margin-left: 35px;" class="now-ui-icons users_single-02"></i>
                        <p>{{$user->first_name}}&nbsp;{{$user->last_name}}</p>
                    </a>
                    <br>
                    <ul style="list-style: none;">
                        <li>
                            <a href="{{ route('users.posts', $user)}}">
                                <i style="margin-left: 35px;" class="far fa-file-alt"></i>Posts</a>
                        </li>
                        <li class="active">
                            <a href="{{ route('users.lists', $user)}}">
                                <i style="margin-left: 35px;" class="now-ui-icons design_bullet-list-67"></i>lists</a>
                            <br>
                            <ul style="list-style: none;">
                                <li><a href="{{ route('users.lists', $user)}}"><center>books & authors lists</center></a></li>
                                <li class="active"><a href="{{route('users.postslists', [$user , $lista])}}"><center>#{{$lista->name}}</center></a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>


    <div class="main-panel" id="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <a class="navbar-brand" href="#pablo"></a>
                </div>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                        aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                </button>
{{--                <div class="collapse navbar-collapse justify-content-end" id="navigation">--}}
{{--                    <form>--}}
{{--                        <div class="input-group no-border">--}}
{{--                            <input type="text" value="" class="form-control" placeholder="Search...">--}}
{{--                            <div class="input-group-append">--}}
{{--                                <div class="input-group-text">--}}
{{--                                    <i class="now-ui-icons ui-1_zoom-bold"></i>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                    <ul class="navbar-nav">--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link" href="#pablo">--}}
{{--                                <i class="now-ui-icons media-2_sound-wave"></i>--}}
{{--                                <p>--}}
{{--                                    <span class="d-lg-none d-md-block">Stats</span>--}}
{{--                                </p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
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
{{--                </div>--}}
            </div>
        </nav>
        <!-- End Navbar -->

        <div class="panel-header panel-header-sm">
        </div>
        <div class="content">
            <div class="row">
                <div class="col-md-8">
                    <div style="margin-left: 200px;" class="card">
                        <div class="card-header">
                            <h5 class="title"></h5>
                        </div>
                        <div class="card-body">
                            @foreach($user_lists_for_posts as $user_list_for_post)
                                <strong><a href="{{route('users.postslists', [$user , $user_list_for_post])}}">#{{$user_list_for_post->name}}</a></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">

                    <div class="card">
                        {{--show posts--}}
                        @foreach($posts as $post )
                            {{--if to show all posts for user owner the profile OR show puplic lists for posts --}}
                            {{--                            @if(((Auth::user()->id) == ($user->id)) or (($post->post_lists['0']->privacy) == ('public')))--}}
                            <div class="card-body">
                                <div class="card card-nav-tabs">
                                    <div class="card-header card-header-warning">
                                                                                    <img class="card-img-top" src="{{url('/users_image')}}/{{$post->user->image}}" style="width: 60px;"
                                                                                         alt="Card image cap">
                                                                                    <a href="{{ route('users.posts',$post->user) }}"> {{$post->user->first_name}}&nbsp;{{$post->user->last_name}}</a>

                                        <span style="float: right">{{date('d-m-Y', strtotime($post->created_at))}}</span>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            @if($post->type)
                                                <strong>Type:</strong> #{{$post->type}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            @endif
                                            @if($post->status)
                                                <strong>Status:</strong> #{{$post->status}} &nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;
                                            @endif
                                            @if($post->post_lists)
                                                {{--                                                        <a href="{{route('user.postlists', Auth::user() , $user_list_for_posts->id)}}">{{$user_list_for_posts->name}}</a></option>--}}
                                                <strong>List:</strong> <a href="{{route('users.postslists', [$user , $post->post_lists['0']])}}">#{{$post->post_lists['0']->name}}</a>  &nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;
                                            @endif

                                            @if($post->post_related_to_book->count() > 0)
                                                <strong>About Book:</strong>
                                                @foreach($post->post_related_to_book as $prb)
                                                    <a href= {{ route('book.show',$prb)}} >{{$prb->title}}</a> &nbsp;
                                                @endforeach
                                            @endif
                                            @if($post->post_related_to_author->count() > 0)
                                                <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;About Author:</strong>
                                                @foreach($post->post_related_to_author as $pra)
                                                    <a href= {{ route('author.show',$pra)}} >{{$pra->name}}</a> &nbsp;
                                                @endforeach
                                            @endif

                                        </h5>
                                        <hr>
                                        <p class="card-text">{{$post->text}}</p>






                                    </div>
                                    <hr>

                                </div>
                            </div>
                            {{--                            @endif--}}
                        @endforeach
                    </div>
                    {{--end of contents--}}
                </div>
            </div>
        </div>
    </div>


    <!--   Core JS Files   -->
    {{--<script src="../assets/js/core/jquery.min.js"></script>--}}
    <script src="{{asset('/assets/js/core/popper.min.js')}}"></script>
    <script src="{{asset('/assets/js/core/bootstrap.min.js')}}"></script>
    <script src="{{asset('/assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="{{asset('/assets/js/now-ui-dashboard.min.js?v=1.5.0')}}" type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->




</body>

</html>


