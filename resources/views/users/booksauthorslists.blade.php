<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <link rel="icon" type="image/jpg" href="../assets/img/app_icon.jpg">

    <title>READERS COMMUNITY</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
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
                                <li class="active"><a href="{{ route('users.lists', $user)}}"><center>books & authors lists</center></a></li>
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
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
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
{{--                            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
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

        {{--books lists--}}
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div style="margin-left: 450px;" class="card-header">
                            <h5 class="title">BOOKS LISTS</h5>
                            <br><br>
                          </div>
                        @foreach($books_lists as $books_list)
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="title">{{$books_list->name}}</h6>
                                    <div class="card-body" >
                                        {{--show all book lists index --}}
                                        @foreach($books_list->books as $book)
                                            <div class="card" style="width: 12rem;">
                                                <img class="card-img-top" src="{{asset('bug_life.jpg')}}" alt="Card image cap" style="height: 9rem">
                                                <div class="card-body">
                                                    <center><h6> <a class="card-title" href="{{route('book.show', $book->id)}}">{{$book->title}}</a></h6></center>
                                                    <p class="card-text">by: {{$book->author->name}}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                {{--                end of contents--}}
            </div>
        </div>

        {{--authors lists--}}
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div style="margin-left: 450px;" class="card-header">
                            <h5 class="title">AUTHORS LISTS</h5>
                            <br><br>
                        </div>
                        @foreach($authors_lists as $authors_list)
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="title">{{$authors_list->name}}</h6>
                                    <div class="card-body" >
                                        {{--show all book lists index --}}
                                        @foreach($authors_list->authors as $author)
                                            <div class="card" style="width: 12rem;">
                                                <img class="card-img-top" src="{{asset('bug_life.jpg')}}" alt="Card image cap" style="height: 9rem">
                                                <div class="card-body">
                                                    <center><h6> <a class="card-title" href="{{route('author.show', $author->id)}}">{{$author->name}}</a></h6></center>
                                                    {{--                                                    <p class="card-text">by: {{$book->author->name}}</p>--}}
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                {{--                end of contents--}}
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


