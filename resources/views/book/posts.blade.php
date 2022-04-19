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
    {{--Chosen--}}
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.5/chosen.jquery.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.5/chosen.css" rel="stylesheet" type="text/css">

    <!-- Magnific Popup core CSS file -->
    <link rel="stylesheet" href="{{asset('css/magnific-popup/magnific-popup.css')}}">
    <!-- jQuery 1.7.2+ or Zepto.js 1.0+ -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <!-- Magnific Popup core JS file -->
    <script src="{{asset('js/magnific-popup/jquery.magnific-popup.js')}}"></script>

    {{--for stars--}}
    <link rel="stylesheet" href="{{asset('css/all.css')}}">
    <link rel="stylesheet" href="{{asset('css/input_star.css')}}">
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
                    <br>
                    <ul style="list-style: none;">
                        <li class="active">
                            <a href= {{ route('book.show',$book)}}>
                                <p style="text-align: center">{{$book->title}}</p>
                            </a>
                        </li>
                        <br>
                        <ul style="list-style: none;">
                            <li class="active"><a href= {{ route('book.show',$book)}}>
                                    <i class="far fa-file-alt"></i>Posts</a></li>
                            <li><a href={{ route('book.dis',$book)}}>
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
                    <strong>Book Statistics :&nbsp;&nbsp;</strong>
                    <i class="far fa-file-alt"></i>&nbsp;&nbsp;{{$posts_num}} Posts &nbsp;&nbsp;
                    <i class="now-ui-icons ui-1_send"></i>&nbsp;{{$discussions_num}} Discussions &nbsp;&nbsp;
                    <i class="fas fa-swatchbook"></i>&nbsp;{{$reading_plans_num}} Reading Plans &nbsp;&nbsp;
                    <i class="fas fa-info"></i>&nbsp;&nbsp;{{$reading_pre_infos_num}} Pre-Infos &nbsp;&nbsp;

                    {{--edit book info--}}
                    @if(Auth::user()->id == $book->user_id)
                        {{--popup edit info--}}
                        <div class="edit-info">
                            <a class="popup-with-form"
                               href="#edit-info-form">
                                <button class="btn btn-primary btn-round btn-outline-primary btn-sm">Edit Book Info
                                </button>
                            </a>
                        </div>
                @endif
                <!-- link that opens popup -->
                    <div class="card-body mfp-hide white-popup-block" id="edit-info-form"
                         style="background-color: #f0f0f0; width: 50%; margin: 0 auto">
                        <center><label class="form-group"><strong>{{ ('EDIT BOOK INFO') }}</strong></label>
                        </center>
                        <br>
                        <form id="edit-info-form" method="POST" action="{{ route('book.update', $book) }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="user_id" name="user_id" value={{Auth::user()->id}}>

                            <div class="form-group">
                                <label>{{ ('Book Title: ') }}</label>
                                <input class="form-control" id="title" type="text" name="title" value="{{ $book->title }}" style="width: 50%" disabled>
                                @error('title')
                                <strong style="color: #FF3636; padding-left: 18px;"> *{{ $message }}</strong>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>&nbsp;&nbsp;&nbsp;{{ ('Author: ') }}</label><br>
                                <input class="form-control" id="author_id" type="text" name="author_id" value="{{ $book->author->name }}" style="width: 50%" disabled>
                                @error('title')
                                <strong style="color: #FF3636; padding-left: 18px;"> *{{ $message }}</strong>
                                @enderror
                            </div>
                            <br>
                            <div class="form-group col-3">
                                <label>{{ ('Publish Year') }}</label>
                                <input class="form-control" id="publish_year" type="text" name="publish_year" value="{{ $book->publish_year }}" disabled>
                                @error('publish_year')
                                <strong style="color: #FF3636; padding-left: 18px;">
                                    *{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>{{ ('Categories') }}</label>
                                <select class="form-control categories" name="categories[]" multiple>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}"
                                                    @foreach($book->book_category as $cat)
                                                    @if($category->id == $cat->id)
                                                    selected
                                                @endif
                                                @endforeach
                                            >{{$category->name}}</option>
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
                                    <option
                                        value="children" {{ $book->age_range == 'children' ? 'selected' : '' }}>
                                        Children
                                    </option>
                                    <option
                                        value="young adults" {{ $book->age_range == 'young adults' ? 'selected' : '' }}>
                                        Young adults
                                    </option>
                                    <option
                                        value="middle-aged & old adults" {{ $book->age_range == 'middle-aged & old adults' ? 'selected' : '' }}>
                                        Middle-aged & old adults
                                    </option>
                                </select>
                                @error('age_range')
                                <strong style="color: #FF3636; padding-left: 18px;">
                                    *{{ $message }}</strong>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label><strong>{{ ('Description :') }}</strong></label>
                                <textarea class="form-control" id="description" type="text" name="description" rows="3" style="width: 90%">{{$book->description}}</textarea>
                                @error('description')
                                <strong style="color: #FF3636; padding-left: 18px;"> *{{ $message }}</strong>
                                @enderror
                            </div>
                            <div>
                                <label><strong>{{ ('Cover Image :') }}</strong></label>
                                <input class="form-control" id="cover_image" type="file" accept=".jpg" name="cover_image" style="width: 35%" value="{{ $book->cover_image }}">
                                @error('cover_image')
                                <strong style="color: #FF3636; padding-left: 18px;"> *{{ $message }}</strong>
                                @enderror
                            </div>
                            <br>

                            <div>
                                <button type="submit" class="btn btn-primary">
                                    {{ ('EDIT INFO') }}
                                </button>
                            </div>
                        </form>
                    </div>
                    {{--end popup--}}
                    {{--end of edit--}}

                </div>

                <div class="collapse navbar-collapse justify-content-end" id="navigation">
                    <form method="GET" action="{{ route('book.show', $book)}}">
                        <div class="input-group no-border">
                            <input type="text" value="" class="form-control" placeholder="Posts Search ..." name="search_text">
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
{{--new post + info--}}
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        {{--add new post for book--}}
                        <div class="card-header">
                                <h5 class="title">ADD NEW POST</h5>
                            </div>
                            <div class="card-body">
                                {{--add new post for group members & not blocked--}}
                                <form method="POST" action="{{ route('book.post.store', $book) }}">
                                    @csrf
                                    <input type="hidden" id="user_id" name="user_id" value={{Auth::user()->id}}>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label><strong>{{ ('TEXT :') }}</strong></label>
                                            <textarea class="form-control" id="text" type="text" name="text" rows="3"
                                                      value="{{ old('text') }}"></textarea>
                                            @error('text')
                                            <strong style="color: #FF3636; padding-left: 18px;">
                                                *{{ $message }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                    <label>note: Here down you can add some info about your post</label>

                                    <div class="form-row">
                                        <div class="form-group col-md-1">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>&nbsp;&nbsp;&nbsp;{{ ('POST TYPE') }}</label>
                                            <select name="type" class="form-control type">
                                                <option disabled selected hidden value=""> select a type</option>
                                                <option value="review">Review</option>
                                                <option value="summary">Summary</option>
                                                <option value="quotation">Quotation</option>
                                                <option value="other">Other</option>
                                            </select>
                                            @error('type')
                                            <strong style="color: #FF3636; padding-left: 18px;">
                                                *{{ $message }}</strong>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-3">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>&nbsp;&nbsp;&nbsp;{{ ('STATUS') }}</label>
                                            <select name="status" class="form-control status">
                                                <option disabled selected hidden value=""> select a status</option>
                                                <option value="read">Read</option>
                                                <option value="want to read">Want To Read</option>
                                                <option value="reading">Reading</option>
                                            </select>
                                            @error('status')
                                            <strong style="color: #FF3636; padding-left: 18px;">
                                                *{{ $message }}</strong>
                                            @enderror
                                        </div>
                                    </div>


                                    <div>
                                        <button type="submit" class="btn btn-primary">{{ ('POST') }}</button>
                                    </div>

                                </form>
                            </div>
                    </div>
                    {{--end of add new post--}}
                    </div>

{{--            book info --}}
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
                                @if(!empty($count_rates_of_this_book))
                                    <?php
                                    $rates_count = 0;
                                    $rates_count = $count_rates_of_this_book->total_rates;
                                    ?>
                                @else
                                    <?php $rates_count = 0; ?>
                                @endif
                                <p><strong>{{$rates_count}}&nbsp; Ratings &nbsp;&nbsp;|</strong></p>
                                {{-- end of output for avg rating--}}
                                </p>

                                <p class="description">
                                    <strong>Description: {{$book->description}}</strong>
                                </p>
                            </div>
                            <br>

                        </div>

                        <hr>
                        <div class="button-container">
                            <br>
                            {{--input user rating in stars (input & output if exit)--}}
                            <div><strong>Add your rate for this book</strong></div>
                            <section class='rating-widget'>
                                @if(!empty($user_rate))
                                <?php
                                $rate_for_this_user = 0;
                                $rate_for_this_user = $user_rate->rate;
                                ?>
                                @else
                                        <?php $rate_for_this_user = 0; ?>
                                @endif
                                {{--show user rate in the stars for each reading plan--}}


                                <div class='rating-stars text-center'>
                                    <ul id='stars'>
                                        <input type="hidden" class="book_id" book_id="{{$book->id}}">
                                        <li class='star @if($rate_for_this_user >= 1) selected @endif'
                                            title='Poor' data-value='1'>
                                            <i class="
                        @if($rate_for_this_user >= 1)
                                                fa fa-star
@else
                                                fa fa-star fa-fw
@endif" aria-hidden="true">
                                            </i>
                                        </li>

                                        <li class='star @if($rate_for_this_user >= 2) selected @endif'
                                            title='Fair' data-value='2'>
                                            <i class="
                        @if($rate_for_this_user >= 2)
                                                fa fa-star
@else
                                                fa fa-star fa-fw
@endif" aria-hidden="true">
                                            </i>
                                        </li>

                                        <li class='star @if($rate_for_this_user >= 3) selected @endif'
                                            title='Good' data-value='3'>
                                            <i class="
                        @if($rate_for_this_user >= 3)
                                                fa fa-star
@else
                                                fa fa-star fa-fw
@endif" aria-hidden="true">
                                            </i>
                                        </li>

                                        <li class='star @if($rate_for_this_user >= 4) selected @endif'
                                            title='Excellent' data-value='4'>
                                            <i class="
                        @if($rate_for_this_user >= 4)
                                                fa fa-star
@else
                                                fa fa-star fa-fw
@endif" aria-hidden="true">
                                            </i>
                                        </li>

                                        <li class='star @if($rate_for_this_user >= 5) selected @endif'
                                            title='WOW!!!' data-value='5'>
                                            <i class="
                        @if($rate_for_this_user >= 5)
                                                fa fa-star
@else
                                                fa fa-star fa-fw
@endif" aria-hidden="true">
                                            </i>
                                        </li>
                                    </ul>
                                </div>
                            </section>
                            {{--end of user stars rating--}}

                        </div>
                    </div>
                </div>
            </div>
            {{--end of new post + info--}}

            <div class="row">
                <div class="col-md-12">

                    <div class="card">
                        {{--show posts--}}
                        @foreach($posts as $post )
                            <div id="{{$post->id}}" class="card-body">
                                <div class="card card-nav-tabs">
                                    <div class="card-header card-header-warning">
                                        <img class="card-img-top" src="{{url('/users_image')}}/{{$post->user->image}}" style="width: 60px;"
                                             alt="Card image cap">
                                        @if(Auth::user() == $post->user)
                                            <a href="{{ route('user.show',$post->user) }}">{{$post->user->first_name}}&nbsp;{{$post->user->last_name}}</a>
                                        @else
                                            <a href="{{ route("users.posts",$post->user)}}">{{$post->user->first_name}}&nbsp;{{$post->user->last_name}}</a>
                                        @endif

                                        {{--drop down to edit & delete--}}
                                        {{--if to show the shm to post owner--}}
                                        @if(((Auth::user()->id) == ($post->user_id)))
                                            <div style="float: right; margin-top: -22px" class="nav-item dropdown">
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
                                                        <a class="popup-with-form dropdown-item" href="#edit-form{{$post->id}}">Edit</a>
                                                    @endif
                                                    <a class="popup-with-form dropdown-item" href="#delete-form{{$post->id}}">Delete</a>
                                                </div>
                                                {{--Pop up to edit post--}}

                                                <div class="card-body mfp-hide white-popup-block"
                                                     id="edit-form{{$post->id}}"
                                                     style="background-color: #f0f0f0; width: 50%; margin: 0 auto">
                                                    <form method="POST"
                                                          action="{{ route('book.post.update', [$book, $post]) }}">
                                                        @method('PUT')
                                                        @csrf
                                                        <input type="hidden" id="user_id" name="user_id"
                                                               value={{Auth::user()->id}}>
                                                        <center><label><strong>{{ ('Edit Your Post :') }}</strong></label>
                                                        </center>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-12">
                                                                <label>{{ ('TEXT :') }}</label>
                                                                <textarea class="form-control" id="text" type="text"
                                                                          name="text" rows="3">{{$post->text}}</textarea>
                                                                @error('text')
                                                                <strong style="color: #FF3636; padding-left: 18px;">
                                                                    *{{ $message }}</strong>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <br>
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
                                                                @error('type')
                                                                <strong style="color: #FF3636; padding-left: 18px;">
                                                                    *{{ $message }}</strong>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-md-2">
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
                                                                        value="want to read" {{ $post->status == 'want to read' ? 'selected' : '' }}>
                                                                        Want To Read
                                                                    </option>
                                                                    <option
                                                                        value="reading" {{ $post->status == 'reading' ? 'selected' : '' }}>
                                                                        Reading
                                                                    </option>
                                                                </select>
                                                                @error('status')
                                                                <strong style="color: #FF3636; padding-left: 18px;">
                                                                    *{{ $message }}</strong>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <button type="submit"
                                                                    class="btn btn-primary">{{ ('EDIT POST') }}</button>
                                                        </div>

                                                    </form>
                                                </div>
                                                {{--end of edit popup--}}


                                            <!-- link that opens delete popup -->
                                                <div class="card-body mfp-hide white-popup-block"
                                                     id="delete-form{{$post->id}}"
                                                     style="background-color: #f0f0f0; width: 50%; margin: 0 auto">
                                                    <label class="form-group"><strong>{{ ('DELETE POST') }}</strong></label>
                                                    <br>
                                                    <form method="POST"
                                                          action="{{ route('book.post.destroy', [$book, $post]) }}">
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
                                        <span style="float: right">{{date('d-m-Y', strtotime($post->created_at))}}</span>

                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            @if($post->type)
                                                <strong>Type:</strong> {{$post->type}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            @endif
                                            @if($post->status)
                                                <strong>Status:</strong> {{$post->status}} &nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;
                                            @endif

                                        </h5>
                                        <hr>
                                        <strong><p class="card-text">{{$post->text}}</p></strong>


                                        {{--add reaction to the post--}}
                                        <div class="reactions{{$post->id}}">
{{--                                        <form method="POST" action="{{ route('post.reaction.store', $post) }}">--}}
{{--                                            @csrf--}}
                                            <div class="new-reac" style="margin-left: 35%">
                                                {{--get the reactions type and display them--}}
                                                @foreach($reactions as $reaction)
                                                    {{--                                                    <button class="btn btn-primary btn-sm" name="reaction_id" value="{{$reaction->id}}" type="submit"> {{$reaction->name}} </button>--}}
                                                    {{--get number or each reaction type for each post in this group --}}
                                                    @php
                                                        $rr = []
                                                    @endphp
                                                    @php
                                                        $r = false
                                                    @endphp

                                                    @foreach($posts_reactions as $post_reactions)
                                                        @if($post->id == $post_reactions->post_id)
                                                            @if($reaction->id == $post_reactions->reaction_id)
                                                                @php
                                                                    $rr[$reaction->id] = $post_reactions->total_reactions
                                                                @endphp
                                                                {{--                                                                @dd($post_reactions->total_reactions)--}}
                                                            @endif
                                                        @endif
                                                    @endforeach

                                                    @foreach($user_reactions as $user_reaction)
                                                        @if($post->id == $user_reaction->post_id)
                                                            @if($reaction->id == $user_reaction->reaction_id)
                                                                @php
                                                                    $r = true;
                                                                @endphp
                                                            @endif
                                                        @endif
                                                    @endforeach

                                                    <button @if($r) style="background-color: #0f3967"
                                                            @endif class="btn btn-default btn-sm add-reaction" name="reaction_id"
                                                            value="{{$reaction->id}}" post_id="{{$post->id}}"
                                                            type="submit">@if(!empty($rr)){{$rr[$reaction->id]}}@endif {{$reaction->name}} </button>

                                                @endforeach
                                            </div>
{{--                                        </form>--}}
                                        </div>

                                    </div>
                                    <hr>

                                    {{--show comments--}}
                                    <div class="comments{{$post->id}}">
                                    @foreach($comments as $comment)
                                        @if($post->id == $comment->post_comments['0']->id)
                                            <div style="padding-top: 0px;" class="card-header card-header-warning">
                                                <img class="card-img-top" src="{{url('/users_image')}}/{{$comment->user->image}}"
                                                     style="width: 30px;" alt="Card image cap">
                                                @if(Auth::user() == $comment->user)
                                                    <a href="{{ route('user.show',$comment->user) }}">{{$comment->user->first_name}}&nbsp;{{$comment->user->last_name}}</a>
                                                @else
                                                    <a href="{{ route("users.posts",$comment->user)}}">{{$comment->user->first_name}}&nbsp;{{$comment->user->last_name}}</a>
                                                @endif

                                                {{--drop down to delete comment--}}
                                                {{--if to show the shm to post owner and group admin--}}
                                                @if((((Auth::user()->id) == ($post->user_id)) OR ((Auth::user()->id) == ($comment->user->id))))
                                                    <div style="float: right; margin-top: -22px" class="nav-item dropdown">
                                                        <a class="nav-link dropdown-toggle"
                                                           id="navbarDropdownMenuLink"
                                                           data-toggle="dropdown"
                                                           aria-haspopup="true" aria-expanded="false">
                                                            <p>
                                                                    <span
                                                                        class="d-lg-none d-md-block">Some Actions</span>
                                                            </p>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right"
                                                             aria-labelledby="navbarDropdownMenuLink">

                                                            <a class="popup-with-form dropdown-item"
                                                               href="#delete-comment-form{{$comment->id}}">Delete</a>
                                                        </div>

                                                        {{--Pop up to delete post--}}
                                                        <div class="card-body mfp-hide white-popup-block"
                                                             id="delete-comment-form{{$comment->id}}"
                                                             style="background-color: #f0f0f0; width: 50%; margin: 0 auto">
                                                            <center>
                                                                <label
                                                                    class="form-group"><strong>{{ ('DELETE COMMENT') }}</strong>
                                                                </label>
                                                            </center>
                                                            <br>
                                                            <form method="POST"
                                                                  action="{{ route('post.comment.destroy', [$post, $comment]) }}">
                                                                @method('DELETE')
                                                                @csrf
                                                                <input type="hidden" id="from_group" name="from_book" value={{true}}>
                                                                <input type="hidden" id="book_id" name="book_id" value={{$book->id}}>
                                                                <div style="margin-left: 40%" class="form-group">
                                                                    <br>
                                                                    <label><strong>{{ ('confirm comment delete :') }}</strong></label>
                                                                </div>
                                                                <br>

                                                                <div style="margin-left: 40%">
                                                                    <button type="submit" class="btn btn-primary">
                                                                        {{ ('Confirm delete') }}
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        {{--end of delete pop up--}}
                                                    </div>
                                                    {{--end of drop down delete--}}
                                                @endif


                                                <span style="float: right">{{date('d-m-Y', strtotime($comment->created_at))}}</span>

                                                <p>{{$comment->text}}</p>
                                            </div>
                                            <hr>
                                        @endif
                                    @endforeach
                                    </div>
                                    {{--add comment to the post--}}
{{--                                    <form method="POST" action="{{ route('post.comment.store', $post) }}">--}}
{{--                                        @csrf--}}
                                        <div class="form-row" post_id="{{$post->id}}">
                                            <div style="padding-left: 30px;" class="form-group col-md-11">
                                                <input placeholder="Comment" class="form-control comment-text" id="text" type="text"
                                                       name="text"
                                                       style="width: 100%" value="{{ old('text') }}">

{{--                                                @error('text')--}}
{{--                                                <strong style="color: #FF3636; padding-left: 18px;">--}}
{{--                                                    *{{ $message }}</strong>--}}
{{--                                                @enderror--}}
                                            </div>
                                            <div class="form-group col-md-1 add-comment">
                                                <button style="margin-top: 1px;" type="submit"
                                                        class="btn btn-primary btn-fab btn-icon btn-round">
                                                    <i class="now-ui-icons ui-2_chat-round"></i>
                                                </button>
                                            </div>
                                        </div>
{{--                                    </form>--}}
                                </div>
                            </div>
                        @endforeach

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





{{--script for delete & edit post--}}
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

            $(".categories").chosen({width: "250px"});

        });
    </script>

    {{--srats--}}
    <script>
        $(document).ready(function () {

            /* 1. Visualizing things on Hover - See next part for action on click */
            $('#stars li').on('mouseover', function () {
                var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on

// Now highlight all the stars that's not after the current hovered star
                $(this).parent().children('li.star').each(function (e) {
                    if (e < onStar) {
                        $(this).addClass('hover');
                    } else {
                        $(this).removeClass('hover');
                    }
                });

            }).on('mouseout', function () {
                $(this).parent().children('li.star').each(function (e) {
                    $(this).removeClass('hover');
                });
            });


            /* 2. Action to perform on click */
            $('#stars li').on('click', function () {
                var onStar = parseInt($(this).data('value'), 10); // The star currently selected
                var stars = $(this).parent().children('li.star');

                for (i = 0; i < stars.length; i++) {
                    $(stars[i]).removeClass('selected');
                }
                for (i = 0; i < onStar; i++) {
                    $(stars[i]).addClass('selected');
                }


            });
//ajax request for star input rating
            $('#stars li').on('click', function () {
                var rate = $(this).attr('data-value');
                var book_id = $(this).parent().find('input').attr('book_id');
                $.ajax({
                    method: "POST",
                    url: "{{url('book/rate')}}",
                    dataType: "json",
                    data: {
                        _token: "{{ csrf_token() }}",
                        book_id: book_id,
                        rate: rate
                    },
                });
            });


        });

    </script>


{{--add comment--}}
    <script>
        $(document).ready(function () {

//ajax request to add comment to post
            $('.add-comment').on('click', function () {
                var text = $(this).parent().find('.comment-text').val();
                var post_id = $(this).parent().attr('post_id');
                // var book_id = $(this).parent().find('input').attr('book_id');
                $.ajax({
                    method: "POST",
                    url:"{{ url('/comment/add') }}",
                    // url: 'post/{post}/comment/store',
                    dataType: "json",
                    data: {
                        _token: "{{ csrf_token() }}",
                        // book_id: book_id,
                        post_id: post_id,
                        text: text
                    },
                    success:
                        function(response)
                        {
                            console.log(response);
                            var new_comment = '';
                            new_comment += '<div style="padding-top: 0px;" class="card-header card-header-warning">\n' +
                                '                                                <img class="card-img-top" src="{{url('/users_image')}}/{{Auth::user()->image}}"\n' +
                                '                                                     style="width: 30px;" alt="Card image cap">\n' +
                                '                                                    <a href="{{ route('user.show',Auth::user()) }}">' + response.user_name + '</a>\n' +
                                '                                                    <div style="float: right; margin-top: -22px" class="nav-item dropdown">\n' +
                                '                                                        <a class="nav-link dropdown-toggle"\n' +
                                '                                                           id="navbarDropdownMenuLink"\n' +
                                '                                                           data-toggle="dropdown"\n' +
                                '                                                           aria-haspopup="true" aria-expanded="false">\n' +
                                '                                                            <p>\n' +
                                '                                                                    <span\n' +
                                '                                                                        class="d-lg-none d-md-block">Some Actions</span>\n' +
                                '                                                            </p>\n' +
                                '                                                        </a>\n' +
                                '                                                        <div class="dropdown-menu dropdown-menu-right"\n' +
                                '                                                             aria-labelledby="navbarDropdownMenuLink">\n' +
                                '\n' +
                                '                                                            <a class="popup-with-form dropdown-item"\n' +
                                '                                                               href="#delete-comment-form'+response.id+'">Delete</a>\n' +
                                '                                                        </div>\n' +
                                '\n' +
                                '                                                        {{--Pop up to delete post--}}\n' +
                                '                                                        <div class="card-body mfp-hide white-popup-block"\n' +
                                '                                                             id="delete-comment-form'+response.id+'"\n' +
                                '                                                             style="background-color: #f0f0f0; width: 50%; margin: 0 auto">\n' +
                                '                                                            <center>\n' +
                                '                                                                <label\n' +
                                '                                                                    class="form-group"><strong>{{ ('DELETE COMMENT') }}</strong>\n' +
                                '                                                                </label>\n' +
                                '                                                            </center>\n' +
                                '                                                            <br>\n' +
                                '                                                            <form method="POST"\n' +
                                {{--'                                                                  action="{{ route('post.comment.destroy', [$post, $comment]) }}">\n' +--}}
                                    '                                                                @method('DELETE')\n' +
                                '                                                                @csrf\n' +
                                '                                                                <div style="margin-left: 40%" class="form-group">\n' +
                                '                                                                    <br>\n' +
                                '                                                                    <label><strong>{{ ('confirm comment delete :') }}</strong></label>\n' +
                                '                                                                </div>\n' +
                                '                                                                <br>\n' +
                                '\n' +
                                '                                                                <div style="margin-left: 40%">\n' +
                                '                                                                    <button type="submit" class="btn btn-primary">\n' +
                                '                                                                        {{ ('Confirm delete') }}\n' +
                                '                                                                    </button>\n' +
                                '                                                                </div>\n' +
                                '                                                            </form>\n' +
                                '                                                        </div>\n' +
                                '                                                        {{--end of delete pop up--}}\n' +
                                '                                                    </div>\n' +
                                '                                                    {{--end of drop down delete--}}\n' +
                                '\n' +
                                '\n' +
                                '                                                <span\n' +
                                '                                                    style="float: right">'+new Date().toLocaleString().replace('/', '-').split(',')[0].replace('/', '-')+'</span>\n' +
                                '\n' +
                                '\n' +
                                '                                                <p>' + response.text + '</p>\n' +
                                '                                            </div>\n' +
                                '                                            <hr>';
                            // $(this).find('.add-comment').children('.comment-text').attr('value', '');
                                $('.comments' + post_id).append(new_comment);
                            // $(this).find('.comment-text').attr('value', '');

                        },

                    error: function (jqXHR, status, err) {
                        alert("COMMENT TEXT CAN'T BE EMPTY");
                    },

                });
            });
        });
    </script>

    {{--add reaction to post--}}
    <script>
        $(document).ready(function () {

//ajax request to add comment to post
            $('.add-reaction').on('click', function () {
                // var text = $(this).parent().find('.comment-text').val();
                var reaction_id = $(this).val();
                var post_id = $(this).attr('post_id');
                // var book_id = $(this).parent().find('input').attr('book_id');
                $.ajax({
                    method: "POST",
                    url:"{{ url('/reaction/add') }}",
                    // url: 'post/{post}/comment/store',
                    dataType: "json",
                    data: {
                        _token: "{{ csrf_token() }}",
                        post_id: post_id,
                        reaction_id: reaction_id
                    },
                    success:
                        function(response)
                        {
                            $('.reactions' + post_id).find('.new-reac').remove();
                            $('.reactions' + post_id).append(response.msg);
                        },

                    error: function (jqXHR, status, err) {
                        console.log(err);
                        // alert("COMMENT TEXT CAN'T BE EMPTY");
                    },

                });
            });
        });
    </script>

</body>

</html>


