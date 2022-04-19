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
            <a href="http://www.creative-tim.com" class="simple-text logo-normal">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-book-reader fa-2x"></i> &nbsp;&nbsp;&nbsp;READERS COMMUNITY
            </a>
        </div>
        <div class="sidebar-wrapper" id="sidebar-wrapper">
            <ul class="nav">
                <li class="active">
                    <a href="{{ route('user.show', Auth::user())}}">
                        <i style="margin-left: 35px;" class="now-ui-icons users_single-02"></i>
                        <p>MY PROFILE</p>
                    </a>
                    <br>
                    <ul style="list-style: none;">
                        <li>
                            <a href="{{ route('user.show', Auth::user())}}">
                                <i style="margin-left: 35px;" class="far fa-file-alt"></i>Posts</a>
                        </li>
                        <li class="active">
                            <a href="{{ route('user.lists.index', Auth::user())}}">
                                <i style="margin-left: 35px;" class="now-ui-icons design_bullet-list-67"></i>lists</a>
                            <br>
                            <ul style="list-style: none;">
                                <li><a href="{{ route('user.lists.index', Auth::user(), $books )}}"><center>books & authors lists</center></a></li>
                                {{--                                <li><a href=""><center>books & authors list</center></a></li>--}}
                                <li class="active"><a href="{{route('user.postslist', [Auth::user() , $lista])}}"><center>#{{$lista->name}}</center></a></li>
                            </ul>
                        </li>
                    </ul>
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
                                <strong><a href="{{route('user.postslist', [Auth::user() , $user_list_for_post])}}">#{{$user_list_for_post->name}}</a></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
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
                                        {{--                                            <img class="card-img-top" src="{{asset('bug_life.jpg')}}" style="width: 60px;"--}}
                                        {{--                                                 alt="Card image cap">--}}
                                        {{--                                            <a href="{{ route('user.show',$post->user) }}"> {{$post->user->first_name}}</a>--}}
                                        {{--drop down to edit & delete--}}
                                        {{--if to show the shm to post owner--}}
                                        @if(((Auth::user()->id) == ($post->user_id)))
                                            <div style="float: right" class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink"
                                                   data-toggle="dropdown"
                                                   aria-haspopup="true" aria-expanded="false">
                                                    <p>
                                                        <span class="d-lg-none d-md-block">Some Actions</span>
                                                    </p>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right"
                                                     aria-labelledby="navbarDropdownMenuLink">
                                                    @if(((Auth::user()->id) == ($post->user_id)))
                                                        <a class="popup-with-form dropdown-item"
                                                           href="#edit-form{{$post->id}}">Edit</a>
                                                    @endif
                                                    <a class="popup-with-form dropdown-item"
                                                       href="#delete-form{{$post->id}}">Delete</a>
                                                </div>
                                                {{--Pop up to edit post--}}
                                                <div class="card-body mfp-hide white-popup-block"
                                                     id="edit-form{{$post->id}}"
                                                     style="background-color: #f0f0f0; width: 50%; margin: 0 auto">
                                                    <form method="POST" action="{{ route('user.post.update', [$user, $post]) }}">
                                                        @method('PUT')
                                                        @csrf
                                                        <input type="hidden" id="user_id" name="user_id" value={{Auth::user()->id}}>

                                                        <center><label><strong>{{ ('Edit Your Post :') }}</strong></label></center>

                                                        <div class="form-row">

                                                            <div class="form-group col-md-12">
                                                                <textarea class="form-control" id="text" type="text" name="text" rows="3">{{$post->text}}</textarea>
                                                                @error('text')
                                                                <strong style="color: #FF3636; padding-left: 18px;">
                                                                    *{{ $message }}</strong>
                                                                @enderror
                                                            </div>
                                                        </div>


                                                        <div class="form-row">
                                                            <div class="form-group col-md-3">
                                                                <label>&nbsp;&nbsp;&nbsp;{{ ('POST TYPE') }}</label>
                                                                <select name="type" class="form-control type">
                                                                    <option disabled selected hidden value=""> select a
                                                                        type
                                                                    </option>
                                                                    <option
                                                                        value="review" {{ $post->type == 'review' ? 'selected' : '' }}>
                                                                        Review
                                                                    </option>
                                                                    <option
                                                                        value="summary" {{ $post->type == 'summary' ? 'selected' : '' }}>
                                                                        Summary
                                                                    </option>
                                                                    <option
                                                                        value="quotation" {{ $post->type == 'quotation' ? 'selected' : '' }}>
                                                                        Quotation
                                                                    </option>
                                                                    <option
                                                                        value="other" {{ $post->type == 'other' ? 'selected' : '' }}>
                                                                        Other
                                                                    </option>
                                                                </select>
                                                                @error('type') <span class="invalid-feedback"
                                                                                     role="alert"> <strong>{{ $message }}</strong> </span>
                                                                @enderror
                                                            </div>


                                                            <div class="form-group col-md-3">
                                                                <label>&nbsp;&nbsp;&nbsp;{{ ('STATUS') }}</label>
                                                                <select name="status" class="form-control status">
                                                                    <option disabled selected hidden value=""> select a
                                                                        status
                                                                    </option>
                                                                    <option
                                                                        value="read" {{ $post->status == 'read' ? 'selected' : '' }}>
                                                                        Read
                                                                    </option>
                                                                    <option
                                                                        value="to_read" {{ $post->status == 'to_read' ? 'selected' : '' }}>
                                                                        Want To Read
                                                                    </option>
                                                                    <option
                                                                        value="reading" {{ $post->status == 'reading' ? 'selected' : '' }}>
                                                                        Reading
                                                                    </option>
                                                                </select>
                                                                @error('status') <span class="invalid-feedback"
                                                                                       role="alert"> <strong>{{ $message }}</strong> </span>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group col-md-1">
                                                            </div>

                                                            <div class="form-group col-md-3">
                                                                <label>&nbsp;&nbsp;&nbsp;{{ ('LIST') }}</label>
                                                                <select class="form-control post_list" name="post_list[]">
                                                                    @foreach($user_lists_for_posts as $user_list_for_posts)
                                                                        <option value="{{$user_list_for_posts->id}}"
                                                                                @foreach($post->post_lists as $post_list)
                                                                                @if($user_list_for_posts->id == $post_list->pivot->listas_id)
                                                                                selected
                                                                            @endif
                                                                            @endforeach
                                                                        >{{$user_list_for_posts->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('post_list') <span class="invalid-feedback"
                                                                                          role="alert"> <strong>{{ $message }}</strong> </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="form-row">

                                                            <div class="form-group col-md-1">
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label>&nbsp;&nbsp;&nbsp;{{ ('About (Book)') }}</label>
                                                                <select name="books[]" class="form-control books" multiple>
                                                                    @foreach($books as $book)
                                                                        <option value="{{$book->id}}"
                                                                                @foreach($post->post_related_to_book as $prb)
                                                                                @if($book->id == $prb->id)
                                                                                selected
                                                                            @endif
                                                                            @endforeach
                                                                        >{{$book->title}}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('books')
                                                                <strong style="color: #FF3636; padding-left: 18px;">
                                                                    *{{ $message }}</strong>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-md-2">
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label>&nbsp;&nbsp;&nbsp;{{ ('About (Author)') }}</label>
                                                                <select name="authors[]" class="form-control authors"
                                                                        multiple>
                                                                    @foreach($authors as $author)
                                                                        <option value="{{$author->id}}"
                                                                                @foreach($post->post_related_to_author as $pra)
                                                                                @if($author->id == $pra->id)
                                                                                selected
                                                                            @endif
                                                                            @endforeach
                                                                        >{{$author->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('authors')
                                                                <strong style="color: #FF3636; padding-left: 18px;">
                                                                    *{{ $message }}</strong>
                                                                @enderror
                                                            </div>
                                                        </div>


                                                        <div>
                                                            <button type="submit" class="btn btn-primary">{{ ('EDIT POST') }}</button>
                                                        </div>

                                                    </form>
                                                </div>
                                                {{--end of edit popup--}}


                                                {{--                                             Pop up to delete post--}}
                                                <div class="card-body mfp-hide white-popup-block"
                                                     id="delete-form{{$post->id}}"
                                                     style="background-color: #f0f0f0; width: 50%; margin: 0 auto">
                                                    <label
                                                        class="form-group"><strong>{{ ('DELETE POST') }}</strong></label>
                                                    <br>
                                                    <form method="POST"
                                                          action="{{ route('user.post.destroy', [$user, $post]) }}">
                                                        @method('DELETE')
                                                        @csrf
                                                        <div class="form-group">
                                                            <label><strong>{{ ('confirm post delete :') }}</strong></label>
                                                        </div>
                                                        <br>

                                                        <div>
                                                            <button type="submit" class="btn btn-primary">
                                                                {{ ('Confirm delete') }}
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                                {{--end of delete pop up--}}
                                            </div>
                                            {{--end of drop down edit & delete       --}}
                                        @endif
                                        <span style="float: right">{{$post->created_at}}</span>

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
                                                <strong>List:</strong> <a href="{{route('user.postslist', [Auth::user() , $post->post_lists['0']])}}">#{{$post->post_lists['0']->name}}</a>  &nbsp;&nbsp;&nbsp;&nbsp;
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
                                        <p class="card-text">{{$post->text}} his was the beginning of my addiction to
                                            POTter. d wonderful and a pleasure to
                                            experience. It deserves to be recogniz</p>






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

    {{--script for delete & edit post $ add new list for posts--}}
    <script>
        $(document).ready(function () {
            $('.popup-with-form').magnificPopup({
                type: 'inline',
                preloader: false,
                focus: '#name'
            });
        });
    </script>

    {{--for chosen--}}
    <script type="text/javascript">
        $(document).ready(function () {

            $(".books").chosen({width: "250px"});

        });
    </script>


    <script type="text/javascript">
        $(document).ready(function () {

            $(".authors").chosen({width: "260px"});

        });
    </script>



</body>

</html>


