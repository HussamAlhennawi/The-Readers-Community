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
            <a href="{{route('/')}}" class="simple-text logo-normal">
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
                                <li class="active"><a href="{{ route('user.lists.index', Auth::user(), $books )}}"><center>books & authors lists</center></a></li>
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
{{--                    <a class="navbar-brand" href="#pablo">GROUPS</a>--}}
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navigation">
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
                </div>
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
                        <div style="margin-left: 40%;" class="card-header">
                            <h5 class="title">BOOKS LISTS &nbsp;<a style="padding-left: 50%" class="popup-with-form "
                                                                   href="#add-book-list-form"><button class="btn btn-primary btn-round btn-outline-primary btn-sm">Add new book list</button></a>
                            </h5>
                            <br>
                            <!-- link that opens popup -->
                            <div class="card-body mfp-hide white-popup-block" id="add-book-list-form"
                                 style="background-color: #f0f0f0; width: 50%; margin: 0 auto">
                                <label class="form-group"><strong>{{ ('ADD NEW BOOK LIST') }}</strong></label>
                                <br>
                                <form id="add-book-list-form" method="POST" action="{{ route('user.lists.store', Auth::user()) }}">
                                    @csrf
                                    <input type="hidden" id="user_id" name="user_id" value={{Auth::user()->id}}>
                                    <input type="hidden" id="type" name="type" value="book">
                                    <div class="form-group">
                                        <label>{{ ('List Title') }}</label>
                                        <input class="form-control" id="name" type="text" name="name"
                                               value="{{ old('name') }}" autofocus>
                                        @error('name')
                                        <strong style="color: #FF3636; padding-left: 18px;">
                                            *{{ $message }}</strong>
                                        @enderror
                                    </div>
                                    <br>
                                    <label><strong>{{ ('List Privacy :') }}</strong></label>
                                    <div class="form-check form-check-radio">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="privacy"
                                                   value="public" checked>
                                            Public (seen by all readers)
                                            <span class="form-check-sign"></span>
                                        </label>
                                        <br>
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="privacy"
                                                   value="private">
                                            Private (only me)
                                            <span class="form-check-sign"></span>
                                        </label>
                                        @error('privacy')
                                        <strong style="color: #FF3636; padding-left: 18px;">
                                            *{{ $message }}</strong>
                                        @enderror
                                    </div>
                                    <br>
                                    <div>
                                        <button type="submit" class="btn btn-primary">
                                            {{ ('ADD LIST') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                            {{--end of add list popup--}}
                        </div>
                        @foreach($books_lists as $books_list)
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="title">{{$books_list->name}}
                                        <a style="padding-left: 2%" class="popup-with-form"
                                           href="#add-item-form{{$books_list->id}}">
                                            <button class="btn btn-primary btn-round btn-outline-primary btn-sm">
                                                Add new item</button>
                                        </a>

                                        {{--pop up to add new item (book) to the list--}}
                                    <div class="card-body mfp-hide white-popup-block" id="add-item-form{{$books_list->id}}"
                                         style="background-color: #f0f0f0; width: 50%; margin: 0 auto">
                                        <label class="form-group"><strong>{{ ('ADD NEW ITEM') }}</strong></label>
                                        <br>
                                        <form id="add-item-form{{$books_list->id}}" method="POST" action="{{ route('user.lists.additem', [Auth::user(), $books_list]) }}">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" id="user_id" name="user_id" value={{Auth::user()->id}}>
                                            <input type="hidden" id="listas_id" name="listas_id" value={{$books_list->id}}>
                                            <div class="form-group">
                                                <label>{{ ('ADD BOOK TO THIS LIST') }}</label>
                                                <select class="form-control books" name="books[]" multiple>
                                                    @foreach($books as $book)
                                                        <option value="{{$book->id}}">{{$book->title}}</option>
                                                    @endforeach
                                                </select>
                                                @error('books')
                                                <strong style="color: #FF3636; padding-left: 18px;">
                                                    *{{ $message }}</strong>
                                                @enderror

                                            </div>
                                            <br>
                                            <div>
                                                <button type="submit" class="btn btn-primary">
                                                    {{ ('ADD') }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    {{--end of popup new item--}}

                                    <a style="float: right" class="popup-with-form"
                                       href="#edit-book-list-form{{$books_list->id}}">Edit</a>
                                {{--Pop up to edit list--}}
                                <div class="card-body mfp-hide white-popup-block"
                                     id="edit-book-list-form{{$books_list->id}}"
                                     style="background-color: #f0f0f0; width: 50%; margin: 0 auto">
                                    <form method="POST"
                                          action="{{ route('user.lists.update', [Auth::user(), $books_list]) }}">
                                        @method('PUT')
                                        @csrf
                                        <input type="hidden" id="listas_id" name="listas_id" value={{$books_list->id}}>
                                        <center>
                                            <label><strong>{{ ('Edit Your List :') }}</strong></label>
                                        </center>

                                        <div class="form-row col-md-7">
                                            <label>{{ ('List Title') }}</label>
                                            <input class="form-control" id="name" type="text" name="name"
                                                   value="{{$books_list->name}}" @if(($books_list->id == $favourite_books_list->id) OR ($books_list->id == $books_i_read_list->id)) disabled @endif>
                                        </div>
                                        <br>

                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label>&nbsp;&nbsp;&nbsp;{{ ('List Privacy') }}</label>
                                                <select name="privacy" class="form-control type">
                                                    <option
                                                        value="public" {{ $books_list->privacy == 'public' ? 'selected' : '' }}>
                                                        Public
                                                    </option>
                                                    <option
                                                        value="private" {{ $books_list->privacy == 'private' ? 'selected' : '' }}>
                                                        Private
                                                    </option>
                                                </select>
                                                @error('privacy') <span class="invalid-feedback"
                                                                     role="alert"> <strong>{{ $message }}</strong> </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-row">

                                            <div class="form-group col-md-3">
                                                <label>&nbsp;&nbsp;&nbsp;{{ ('Books') }}</label>
                                                <select name="books[]" class="form-control books"
                                                        multiple>
                                                    @foreach($books as $book)
                                                        <option value="{{$book->id}}"
                                                                @foreach($books_list->books as $bo)
                                                                @if($book->id == $bo->id)
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
                                        </div>


                                        <div>
                                            <button type="submit"
                                                    class="btn btn-primary">{{ ('EDIT LIST') }}</button>
                                        </div>

                                    </form>
                                </div>
                                {{--end of edit popup--}}

                                    <div class="card-body" >
                                        {{--show all book lists index --}}
                                        @foreach($books_list->books as $book)
                                            <div class="card" style="width: 12rem;">
                                                <img class="card-img-top" src="{{url('/cover_image')}}/{{$book->cover_image}}" alt="Card image cap" style="height: 9rem">
                                                <div class="card-body">
                                                    <center><h6> <a class="card-title" href="{{route('book.show', $book->id)}}">{{$book->title}}</a></h6></center>
                                                    <p class="card-text">by: {{$book->author->name}}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
{{--                                    </h6>--}}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                {{--end of contents--}}
            </div>
        </div>

        {{--authors lists--}}
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div style="margin-left: 40%;" class="card-header">
                            <h5 class="title">AUTHORS LISTS &nbsp;<a style="padding-left: 50%" class="popup-with-form "
                                   href="#add-author-list-form"><button class="btn btn-primary btn-round btn-outline-primary btn-sm">Add new author list</button></a>
                            </h5>
                            <br>
                            <!-- link that opens popup -->
                            {{--<a class="popup-with-form" href="#test-form">Open form</a>--}}
                            <div class="card-body mfp-hide white-popup-block" id="add-author-list-form"
                                 style="background-color: #f0f0f0; width: 50%; margin: 0 auto">
                                <label class="form-group"><strong>{{ ('ADD NEW AUTHOR LIST') }}</strong></label>
                                <br>
                                <form id="add-list-form" method="POST" action="{{ route('user.lists.store', Auth::user()) }}">
                                    @csrf
                                    <input type="hidden" id="user_id" name="user_id" value={{Auth::user()->id}}>
                                    <input type="hidden" id="type" name="type" value="author">
                                    <div class="form-group">
                                        <label>{{ ('List Title') }}</label>
                                        <input class="form-control" id="name" type="text" name="name"
                                               value="{{ old('name') }}" autofocus>
                                        @error('name')
                                        <strong style="color: #FF3636; padding-left: 18px;">
                                            *{{ $message }}</strong>
                                        @enderror
                                    </div>
                                    <br>
                                    <label><strong>{{ ('List Privacy :') }}</strong></label>
                                    <div class="form-check form-check-radio">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="privacy"
                                                   value="public" checked>
                                            Public (seen by all readers)
                                            <span class="form-check-sign"></span>
                                        </label>
                                        <br>
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="privacy"
                                                   value="private">
                                            Private (only me)
                                            <span class="form-check-sign"></span>
                                        </label>
                                        @error('privacy')
                                        <strong style="color: #FF3636; padding-left: 18px;">
                                            *{{ $message }}</strong>
                                        @enderror
                                    </div>
                                    <br>
                                    <div>
                                        <button type="submit" class="btn btn-primary">
                                            {{ ('ADD LIST') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                            {{--end of add lidt popup--}}
                        </div>
                        @foreach($authors_lists as $authors_list)
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="title">{{$authors_list->name}}
                                    <a style="padding-left: 2%" class="popup-with-form"
                                       href="#add-author-item-form{{$authors_list->id}}">
                                        <button class="btn btn-primary btn-round btn-outline-primary btn-sm">
                                            Add new item</button>
                                    </a>
                                    {{--pop up to add new item (author) to the list--}}
                                    <div class="card-body mfp-hide white-popup-block" id="add-author-item-form{{$authors_list->id}}"
                                         style="background-color: #f0f0f0; width: 50%; margin: 0 auto">
                                        <label class="form-group"><strong>{{ ('ADD NEW ITEM') }}</strong></label>
                                        <br>
                                        <form id="add-author-item-form{{$authors_list->id}}" method="POST" action="{{ route('user.lists.additem', [Auth::user(), $authors_list]) }}">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" id="user_id" name="user_id" value={{Auth::user()->id}}>
                                            <input type="hidden" id="listas_id" name="listas_id" value={{$authors_list->id}}>
                                            <div class="form-group">
                                                <label>{{ ('ADD AUTHOR TO THIS LIST') }}</label>
                                                <select class="form-control books" name="authors[]" multiple>
                                                    @foreach($authors as $author)
                                                        <option value="{{$author->id}}">{{$author->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('authors')
                                                <strong style="color: #FF3636; padding-left: 18px;">
                                                    *{{ $message }}</strong>
                                                @enderror

                                            </div>
                                            <br>
                                            <div>
                                                <button type="submit" class="btn btn-primary">
                                                    {{ ('ADD') }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    {{--end of popup new ithe--}}

                                    <a style="float: right" class="popup-with-form"
                                       href="#edit-author-list-form{{$authors_list->id}}">Edit</a>
                                    {{--Pop up to edit list--}}
                                    <div class="card-body mfp-hide white-popup-block"
                                         id="edit-author-list-form{{$authors_list->id}}"
                                         style="background-color: #f0f0f0; width: 50%; margin: 0 auto">
                                        <form method="POST"
                                              action="{{ route('user.lists.update', [Auth::user(), $authors_list]) }}">
                                            @method('PUT')
                                            @csrf
                                            <input type="hidden" id="listas_id" name="listas_id" value={{$authors_list->id}}>
                                            <center>
                                                <label><strong>{{ ('Edit Your List :') }}</strong></label>
                                            </center>

                                            <div class="form-row col-md-7">
                                                <label>{{ ('List Title') }}</label>
                                                <input class="form-control" id="name" type="text" name="name"
                                                       value="{{$authors_list->name}}"  @if($authors_list->id == $favourite_authors_list->id) disabled @endif>
                                            </div>
                                            <br>

                                            <div class="form-row">
                                                <div class="form-group col-md-3">
                                                    <label>&nbsp;&nbsp;&nbsp;{{ ('List Privacy') }}</label>
                                                    <select name="privacy" class="form-control type">
                                                        <option
                                                            value="public" {{ $authors_list->privacy == 'public' ? 'selected' : '' }}>
                                                            Public
                                                        </option>
                                                        <option
                                                            value="private" {{ $authors_list->privacy == 'private' ? 'selected' : '' }}>
                                                            Private
                                                        </option>
                                                    </select>
                                                    @error('privacy') <span class="invalid-feedback"
                                                                            role="alert"> <strong>{{ $message }}</strong> </span>
                                                    @enderror
                                                </div>


                                            </div>

                                            <div class="form-row">

                                                <div class="form-group col-md-3">
                                                    <label>&nbsp;&nbsp;&nbsp;{{ ('Authors') }}</label>
                                                    <select name="authors[]" class="form-control books"
                                                            multiple>
                                                        @foreach($authors as $author)
                                                            <option value="{{$author->id}}"
                                                                    @foreach($authors_list->authors as $au)
                                                                    @if($author->id == $au->id)
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
                                                <button type="submit"
                                                        class="btn btn-primary">{{ ('EDIT LIST') }}</button>
                                            </div>

                                        </form>
                                    </div>
                                    {{--end of edit popup--}}


                                    <div class="card-body" >
                                        {{--show all author lists index --}}
                                        @foreach($authors_list->authors as $author)
                                            <div class="card" style="width: 12rem;">
{{--                                                <img class="card-img-top" src="{{asset('bug_life.jpg')}}" alt="Card image cap" style="height: 9rem">--}}
                                                <div class="card-body">
                                                    <center><h6> <a class="card-title" href="{{route('author.show', $author->id)}}">{{$author->name}}</a></h6></center>
                                                    {{--<p class="card-text">by: {{$book->author->name}}</p>--}}
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

{{--chosen--}}
<script type="text/javascript">
    $(document).ready(function () {

        $(".books").chosen({width: "300px"});

    });
</script>
<script type="text/javascript">
    $(document).ready(function () {

        $(".authors").chosen({width: "300px"});

    });
</script>

{{--<!--   Core JS Files   -->--}}
{{--<script src="../assets/js/core/jquery.min.js"></script>--}}
<script src="{{asset('/assets/js/core/popper.min.js')}}"></script>
<script src="{{asset('/assets/js/core/bootstrap.min.js')}}"></script>
<script src="{{asset('/assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
<script src="{{asset('/assets/js/now-ui-dashboard.min.js?v=1.5.0')}}" type="text/javascript"></script>

</body>

</html>


