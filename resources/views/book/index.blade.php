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

    {{--    for stars--}}
    <link rel="stylesheet" href="{{asset('css/all.css')}}">
    <link rel="stylesheet" href="{{asset('css/input_star.css')}}">

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
                    <strong>Books Statistics :&nbsp;&nbsp;</strong>
                    <i class="fas fa-book"></i>&nbsp;&nbsp;{{count($books)}} Books &nbsp;&nbsp;
                </div>


                <div class="collapse navbar-collapse justify-content-end" id="navigation">
                    {{--popup new book--}}
                    <div style="float: right; margin-right: 50px;">
                        <a class="popup-with-form "
                           href="#test-form"><button class="btn btn-primary btn-round btn-outline-primary btn-sm">Add New Book</button></a>
                    </div>

                <!-- link that opens popup -->
                    <div class="card-body mfp-hide white-popup-block" id="test-form" style="background-color: #f0f0f0; width: 50%; margin: 0 auto">
                        <label class="form-group"><strong>{{ ('ADD NEW BOOK') }}</strong></label>
                        <br>
                        <form id="test-form" method="POST" action="{{ route('book.store') }}">
                            @csrf
                            <input type="hidden" id="user_id" name="user_id" value={{Auth::user()->id}}>
                            <div class="form-group">
                                <label>{{ ('Book Title: ') }}</label>
                                <input class="form-control" id="title" type="text" name="title" value="{{ old('title') }}" style="width: 50%" autofocus>
                                @error('title')
                                <strong style="color: #FF3636; padding-left: 18px;"> *{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>&nbsp;&nbsp;&nbsp;{{ ('Author: ') }}</label><br>
                                <select name="author_id" id="author_id" class="form-control authors">
                                    @foreach($authors as $author)
                                        <option value="{{$author->id}}">{{$author->name}}</option>
                                    @endforeach
                                </select>
                                @error('author_id')
                                <strong style="color: #FF3636; padding-left: 18px;">
                                    *{{ $message }}</strong>
                                @enderror
                            </div>
                            <br>
                            <div class="form-group col-3">
                                <label>{{ ('Publish Year') }}</label>
                                <input class="form-control" id="publish_year" type="text" name="publish_year" value="{{ old('publish_year') }}">
                                @error('publish_year')
                                <strong style="color: #FF3636; padding-left: 18px;">
                                    *{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>{{ ('Categories') }}</label>
                                <select class="form-control categories" name="categories[]" multiple>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                                @error('categories')
                                <strong style="color: #FF3636; padding-left: 18px;">
                                    *{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label>{{ ('Age Range') }}</label>
                                <select class="form-control age_range" id="age_range" name="age_range">
                                    <option value="children">Children (3 ~ 12)</option>
                                    <option value="young adults">Young Adults (13 ~ 23)</option>
                                    <option value="middle-aged & old adults">Middle-aged (24 ~ 59) & Old Adults (60 ~ 99)</option>
                                </select>
                                @error('age_range')
                                <strong style="color: #FF3636; padding-left: 18px;">
                                    *{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label><strong>{{ ('Description :') }}</strong></label>
                                <textarea class="form-control" id="description" type="text" name="description" rows="3" style="width: 90%" value="{{ old('description') }}"></textarea>
                                @error('description')
                                <strong style="color: #FF3636; padding-left: 18px;"> *{{ $message }}</strong>
                                @enderror
                            </div>
                            <div>
                                <label><strong>{{ ('Cover Image :') }}</strong></label>
                                <input class="form-control" id="cover_image" type="file" accept=".jpg" name="cover_image" style="width: 35%" value="{{ old('cover_image') }}">
                                @error('cover_image')
                                <strong style="color: #FF3636; padding-left: 18px;"> *{{ $message }}</strong>
                                @enderror
                            </div>

                            <div>
                                <button type="submit" class="btn btn-primary">
                                    {{ ('ADD BOOK') }}
                                </button>
                            </div>
                        </form>
                    </div>
                    {{--end popup--}}

                    <form method="GET" action="{{ route('book.index') }}">
                        <div class="input-group no-border">
                            <input type="text" value="" class="form-control" placeholder="Books Search ..." name="book_title">
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
                {{--book info --}}

                @foreach($books as $book)
                <div class="col-md-4">
                    <div class="card card-user">
                        <br><br>
                        <div class="card-body">
                            <div class="author">
                                <a href="{{ route('book.show', $book)}}">
                                    <img class="avatar border-gray" src="{{url('/cover_image')}}/{{$book->cover_image}}" alt="...">
                                    <h5 class="title">{{$book->title}}</h5>
                                </a>
                                <p class="description">
                                    <strong>Author: &nbsp;</strong><a href="{{ route('author.show', $book->author)}}">{{$book->author->name}}</a>
                                </p>

                                <p class="description">
                                    <strong>Year of publish: </strong>{{$book->publish_year}}
                                </p>
                                <p class="description">
                                    <strong>Age range: </strong>{{$book->age_range}}
                                </p>

                                <p class="description">
                                    <strong>Category:</strong>
                                    @foreach($categories as $category)
                                        @foreach($book->book_category as $cat)
                                            @if($category->id == $cat->id)
                                                <a href="{{ route('category.show', $category)}}">#{{$category->name}}&nbsp;</a>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </p>

                                <p class="description">
                                    {{--stars output for avg rating--}}
                                    <section style="float: right" class='rating-widget'>
                                        <div class='rating-stars text-center'>
                                            <ul id='starsss'>
                                                <li class='star @if(($book->rate >= 1) or ($book->rate < 1 and $book->rate > 0)) selected @endif' title='Poor' data-value='1'>
                                                    <i class="
                        @if($book->rate == 1)
                                                        fa fa-star
@elseif($book->rate < 1 and $book->rate > 0)
                                                        fa fa-star-half-alt
@else
                                                        fa fa-star fa-fw
@endif" aria-hidden="true">
                                                    </i>
                                                </li>

                                                <li class='star @if(($book->rate >= 2) or ($book->rate < 2 and $book->rate > 1))selected @endif' title='Fair' data-value='2'>
                                                    <i class="
                        @if($book->rate >= 2)
                                                        fa fa-star
@elseif($book->rate < 2 and $book->rate > 1)
                                                        fa fa-star-half-alt
@else
                                                        fa fa-star fa-fw
@endif" aria-hidden="true">
                                                    </i>
                                                </li>

                                                <li class='star @if(($book->rate >= 3) or ($book->rate < 3 and $book->rate > 2)) selected @endif' title='Good' data-value='3'>
                                                    <i class="
                        @if($book->rate == 3)
                                                        fa fa-star
@elseif($book->rate < 3 and $book->rate > 2)
                                                        fa fa-star-half-alt
@else
                                                        fa fa-star fa-fw
@endif" aria-hidden="true">
                                                    </i>
                                                </li>

                                                <li class='star @if(($book->rate >= 4) or ($book->rate < 4 and $book->rate > 3)) selected @endif' title='Excellent' data-value='4'>
                                                    <i class="
                        @if($book->rate == 4)
                                                        fa fa-star
@elseif($book->rate < 4 and $book->rate > 3)
                                                        fa fa-star-half-alt
@else
                                                        fa fa-star fa-fw
@endif" aria-hidden="true">
                                                    </i>
                                                </li>

                                                <li class='star @if(($book->rate >= 5) or ($book->rate < 5 and $book->rate > 4)) selected @endif' title='WOW!!!' data-value='5'>
                                                    <i class="
                        @if($book->rate == 5)
                                                        fa fa-star
@elseif($book->rate < 5 and $book->rate > 4)
                                                        fa fa-star-half-alt
@else
                                                        fa fa-star fa-fw
@endif" aria-hidden="true">
                                                    </i>
                                                </li>
                                            </ul>
                                        </div>


                                    </section>
                                <p style="float: right"><strong>AVG: {{$book->rate}} </strong></p>
                                @if(!in_array($book->id, $books_idsss))
                                    <p><strong>0 &nbsp; Ratings &nbsp;|&nbsp;&nbsp;</strong></p>
                                @else
                                    @foreach($count_rates_for_books as $count_rate)
                                        @if($book->id == $count_rate->book_id)
                                            <p><strong>{{$count_rate->total_rates}}&nbsp; Ratings &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;</strong></p>
                                        @endif
                                    @endforeach
                                @endif
                                {{-- end of output for avg rating--}}
                                </p>



                                <div class="">
                                    <hr>
                                    <strong>Description:</strong> {{$book->description}}
                                </div>
                            </div>

                        </div>

                    </div>
                    <br><br>
                </div>
                @endforeach
                <div style="margin: 0 auto">
                {{ $books->links() }}
                </div>
            </div>
        </div>
    </div>


    <!--   Core JS Files   -->
    {{--<script src="../assets/js/core/jquery.min.js"></script>--}}
    <script src="{{asset('/assets/js/core/popper.min.js')}}"></script>
    <script src="{{asset('/assets/js/core/bootstrap.min.js')}}"></script>
    <script src="{{asset('/assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>







</body>

</html>

{{--script add new book--}}
<script>
    $(document).ready(function () {
        $('.popup-with-form').magnificPopup({
            type: 'inline',
            preloader: false,
            focus: '#name'
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {

        $(".authors").chosen({width: "250px"});

    });
</script>

<script type="text/javascript">
    $(document).ready(function () {

        $(".categories").chosen({width: "250px"});

    });
</script>





