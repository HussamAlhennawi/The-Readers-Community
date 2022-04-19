<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="icon" type="image/jpg" href="../assets/img/app_icon.jpg">

    <title>READERS COMMUNITY</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- CSS Files -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../assets/demo/demo.css" rel="stylesheet" />

{{--    magnafig--}}
<!-- Magnific Popup core CSS file -->
    <link rel="stylesheet" href="{{asset('css/magnific-popup/magnific-popup.css')}}">
    <!-- jQuery 1.7.2+ or Zepto.js 1.0+ -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <!-- Magnific Popup core JS file -->
    <script src="{{asset('js/magnific-popup/jquery.magnific-popup.js')}}"></script>
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
                <li class="active">
                    <a href="{{ route('group.index')}}">
                        <i style="margin-left: 50px;" class="fas fa-users"></i>
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
                    <strong>Groups Statistics :&nbsp;&nbsp;</strong>
                    <i class="fas fa-users"></i>&nbsp;&nbsp;{{count($groups)}} Groups &nbsp;&nbsp;
                </div>

                <div class="collapse navbar-collapse justify-content-end" id="navigation">
                    <form method="GET" action="{{ route('group.index')}}">
                        <div class="input-group no-border">
                            <input type="text" value="" class="form-control" placeholder="Reading Plans Search ..." name="group_title">
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
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="title">GROUPS &nbsp;

{{--                                <a class="popup-with-form now-ui-icons ui-1_simple-add" href="#test-form"></a></h5>--}}
                                {{--add new group--}}
                                <div style="float: right; margin-right: 5px;">
                                <a class="popup-with-form "
                                   href="#test-form"><button class="btn btn-primary btn-round btn-outline-primary btn-sm">Add New Group</button></a>
                                </div>

                            <!-- link that opens popup -->
{{--                            <a class="popup-with-form" href="#test-form">Open form</a>--}}
                            <div class="card-body mfp-hide white-popup-block" id="test-form" style="background-color: #f0f0f0; width: 50%; margin: 0 auto">
                                <label class="form-group"><strong>{{ ('ADD NEW GROUP') }}</strong></label>
                                <br>
                                <form id="test-form" method="POST" action="{{ route('group.store') }}">
                                    @csrf
                                    <input type="hidden" id="user_id" name="user_id" value={{Auth::user()->id}}>

                                    <div class="form-group">
                                        <label><strong>{{ ('Group Title :') }}</strong></label>
                                        <input class="form-control" id="title" type="text" name="title" value="{{ old('title') }}" style="width: 50%" autofocus>
                                        @error('title')
                                        <strong style="color: #FF3636; padding-left: 18px;"> *{{ $message }}</strong>
                                        @enderror
                                    </div>
                                    <br>

                                    <label><strong>{{ ('Group Privacy :') }}</strong></label>
                                    <div class="form-check form-check-radio">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="privacy"  value="public" checked>
                                            Public (seen by all readers)
                                            <span class="form-check-sign"></span>
                                        </label>
                                        <br>
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="privacy" value="private">
                                            Private (only members can see group content)
                                            <span class="form-check-sign"></span>
                                        </label>
                                        @error('privacy')
                                        <strong style="color: #FF3636; padding-left: 18px;"> *{{ $message }}</strong>
                                        @enderror
                                    </div>
                                    <br>

                                    <div class="form-group">
                                        <label><strong>{{ ('Description :') }}</strong></label>
                                        <textarea class="form-control" id="description" type="text" name="description" rows="3" style="width: 90%" value="{{ old('description') }}"></textarea>
                                        @error('description')
                                        <strong style="color: #FF3636; padding-left: 18px;"> *{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <br>
                                    <div>
                                        <label><strong>{{ ('Cover Image :') }}</strong></label>
                                        <input class="form-control" id="cover_image" type="file" accept=".jpg" name="cover_image" style="width: 35%" value="{{ old('cover_image') }}">
                                        @error('cover_image')
                                        <strong style="color: #FF3636; padding-left: 18px;"> *{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <div>
                                        <button type="submit" class="btn btn-primary">
                                            {{ ('ADD GROUP') }}
                                        </button>
                                    </div>
                                </form>
                            </div>

                        </div>
                        <div class="card-body" >
{{--                            show all groups --}}
                            @foreach($groups as $group)
                                <div class="card" style="width: 17rem; margin-left: 45px;">
                                    <img class="card-img-top" src="{{asset('bug_life.jpg')}}" alt="Card image cap" style="height: 10rem">
                                    <center><h4 style="margin-top: 5px"> <a class="card-title" href= {{ route('group.show',$group)}} >{{$group->title}}</a></h4></center>
                                    <div class="card-body">
                                        <p class="card-text">{{$group->description}}</p>
                                    </div>
                                </div>
{{--                                <a href= {{ route('group.show',$group)}} >{{$group->title}}</a>--}}
                            @endforeach
                        </div>
                    </div>
                </div>
{{--                end of contents--}}
            </div>
        </div>
    </div>
</div>

{{--script for reopen add group popup if there errors--}}
@if(count($errors))
    <script>
        $(document).ready(function() {
            $('.popup-with-form').magnificPopup({
                type: 'inline',
                preloader: false,
                focus: '#name'

            }).magnificPopup('open');
        });
    </script>
@endif




{{--script for add new group--}}
<script>
    $(document).ready(function() {
        $('.popup-with-form').magnificPopup({
            type: 'inline',
            preloader: false,
            focus: '#name'
        });
    });
</script>

<!--   Core JS Files   -->
{{--<script src="../assets/js/core/jquery.min.js"></script>--}}
<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>
<script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>

</body>

</html>


