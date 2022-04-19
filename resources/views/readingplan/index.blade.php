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
                            <li><a href={{ route('book.dis',$book)}}>
                                    <i class="now-ui-icons ui-1_send"></i>Discussions</a></li>
                            <li class="active"><a href= {{ route('book.reading_plan.index',$book)}}>
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

                <div class="collapse navbar-collapse justify-content-end" id="navigation">
                    <form method="GET" action="{{ route('book.reading_plan.index',$book)}}">
                        <div class="input-group no-border">
                            <input type="text" value="" class="form-control" placeholder="Reading Plans Search ..." name="search_text">
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

                        {{--add new reading plan--}}
                        <div class="card-header">
                            <h5 class="title">ADD NEW READING PLAN</h5>
                        </div>
                        <div class="card-body">
                            {{--add new reading plan for the book--}}
                            <form method="POST" action="{{ route('book.reading_plan.store', $book) }}">
                                @csrf
                                <input type="hidden" id="user_id" name="user_id" value={{Auth::user()->id}}>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label><strong>{{ ('READING PLAN DETAILS :') }}</strong></label>
                                        <br>
                                        <textarea class="form-control" id="text" type="text"
                                                  name="text" rows="3" autofocus>{{ old('text') }}</textarea>
                                        @error('text')
                                        <strong style="color: #FF3636; padding-left: 18px;">
                                            *{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">ADD READING PLAN</button>
                            </form>
                        </div>
                    </div>
                    {{--end of add new reading plan--}}


                    {{--display reading plans of the book--}}
                    @foreach($reading_plans as $reading_plan)
                        <div class="card-body">
                            <div class="card card-nav-tabs">
                                <div class="card-header card-header-info">
                                    <img class="card-img-top" src="{{url('/users_image')}}/{{$reading_plan->user->image}}" style="width: 60px;"
                                         alt="Card image cap">
                                    @if(Auth::user() == $reading_plan->user)
                                        <a href="{{ route('user.show',$reading_plan->user) }}">{{$reading_plan->user->first_name}}&nbsp;{{$reading_plan->user->last_name}}</a>
                                    @else
                                        <a href="{{ route("users.posts",$reading_plan->user)}}">{{$reading_plan->user->first_name}}&nbsp;{{$reading_plan->user->last_name}}</a>
                                    @endif

{{--                                    <a href="{{ route('user.show',$reading_plan->user) }}">--}}
{{--                                        &nbsp;&nbsp;&nbsp;{{$reading_plan->user->first_name}}</a>--}}

                                    {{--drop down to edit & delete event--}}
                                    {{--                                        if to show the shm to post owner and group admin--}}
                                    @if((Auth::user()->id) == ($reading_plan->user_id))
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
                                                <a class="popup-with-form dropdown-item"
                                                   href="#edit-form{{$reading_plan->id}}">Edit</a>
                                                <a class="popup-with-form dropdown-item"
                                                   href="#delete-form{{$reading_plan->id}}">Delete</a>
                                            </div>
                                            {{--Pop up to edit event--}}
                                            <div class="card-body mfp-hide white-popup-block"
                                                 id="edit-form{{$reading_plan->id}}"
                                                 style="background-color: #f0f0f0; width: 70%; margin: 0 auto">
                                                <form method="POST"
                                                      action="{{ route('book.reading_plan.update', [$book, $reading_plan]) }}">
                                                    @method('PUT')
                                                    @csrf
                                                    <input type="hidden" id="user_id" name="user_id"
                                                           value={{Auth::user()->id}}>
                                                    <center>
                                                        <label><strong>{{ ('Edit Your Reading plan :') }}</strong></label>
                                                    </center>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-12">
                                                            <label><strong>{{ ('READING PLAN DETAILS :') }}</strong></label>
                                                            <br>
                                                            <textarea class="form-control" id="text" type="text"
                                                                      name="text" rows="3"
                                                                      autofocus>{{ $reading_plan->text }}</textarea>
                                                            @error('text')
                                                            <strong style="color: #FF3636; padding-left: 18px;">
                                                                *{{ $message }}</strong>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">EDIT READING PLAN
                                                    </button>
                                                </form>

                                            </div>
                                            {{--end of edit reading plan popup--}}

                                            {{--Pop up to delete reading plan--}}
                                            <div class="card-body mfp-hide white-popup-block"
                                                 id="delete-form{{$reading_plan->id}}"
                                                 style="background-color: #f0f0f0; width: 50%; margin: 0 auto">
                                                <label
                                                    class="form-group"><strong>{{ ('DELETE READING PLAN') }}</strong></label>
                                                <br>
                                                <form method="POST"
                                                      action="{{ route('book.reading_plan.destroy', [$book, $reading_plan]) }}">
                                                    @method('DELETE')
                                                    @csrf
                                                    <div class="form-group">
                                                        {{$reading_plan->id}}
                                                        <label><strong>{{ ('confirm reading plan delete :') }}</strong></label>
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
                                    @endif
                                    {{--end of drop down edit & delete--}}
                                    <span style="float: right">{{date('d-m-Y', strtotime($reading_plan->created_at))}}</span>

{{--                                    stars output for avg rating--}}

                                    <section style="float: right" class='rating-widget'>
                                            <div class='rating-stars text-center'>
                                                <ul id='starsss'>
                                                    <input type="hidden" class="reading_plan_id" plan_id="{{$reading_plan->id}}">
                                                    <li class='star @if(($reading_plan->rate >= 1) or ($reading_plan->rate < 1 and $reading_plan->rate > 0)) selected @endif' title='Poor' data-value='1'>
                                                        <i class="
                        @if($reading_plan->rate == 1)
                                                            fa fa-star
@elseif($reading_plan->rate < 1 and $reading_plan->rate > 0)
                                                            fa fa-star-half-alt
@else
                                                            fa fa-star fa-fw
@endif" aria-hidden="true">
                                                        </i>
                                                    </li>

                                                    <li class='star @if(($reading_plan->rate >= 2) or ($reading_plan->rate < 2 and $reading_plan->rate > 1))selected @endif' title='Fair' data-value='2'>
                                                        <i class="
                        @if($reading_plan->rate >= 2)
                                                            fa fa-star
@elseif($reading_plan->rate < 2 and $reading_plan->rate > 1)
                                                            fa fa-star-half-alt
@else
                                                            fa fa-star fa-fw
@endif" aria-hidden="true">
                                                        </i>
                                                    </li>

                                                    <li class='star @if(($reading_plan->rate >= 3) or ($reading_plan->rate < 3 and $reading_plan->rate > 2)) selected @endif' title='Good' data-value='3'>
                                                        <i class="
                        @if($reading_plan->rate == 3)
                                                            fa fa-star
@elseif($reading_plan->rate < 3 and $reading_plan->rate > 2)
                                                            fa fa-star-half-alt
@else
                                                            fa fa-star fa-fw
@endif" aria-hidden="true">
                                                        </i>
                                                    </li>

                                                    <li class='star @if(($reading_plan->rate >= 4) or ($reading_plan->rate < 4 and $reading_plan->rate > 3)) selected @endif' title='Excellent' data-value='4'>
                                                        <i class="
                        @if($reading_plan->rate == 4)
                                                            fa fa-star
@elseif($reading_plan->rate < 4 and $reading_plan->rate > 3)
                                                            fa fa-star-half-alt
@else
                                                            fa fa-star fa-fw
@endif" aria-hidden="true">
                                                        </i>
                                                    </li>

                                                    <li class='star @if(($reading_plan->rate >= 5) or ($reading_plan->rate < 5 and $reading_plan->rate > 4)) selected @endif' title='WOW!!!' data-value='5'>
                                                        <i class="
                        @if($reading_plan->rate == 5)
                                                            fa fa-star
@elseif($reading_plan->rate < 5 and $reading_plan->rate > 4)
                                                            fa fa-star-half-alt
@else
                                                            fa fa-star fa-fw
@endif" aria-hidden="true">
                                                        </i>
                                                    </li>
                                                </ul>
                                            </div>


                                    </section>
                                    <p style="float: right"><strong>AVG: {{$reading_plan->rate}} </strong></p>
                                    @foreach($count_rates_for_reading_plans_of_this_book as $count_rate)
                                                    @if($reading_plan->id == $count_rate->reading_plan_id)
                                            <p style="float: right"><strong>{{$count_rate->total_rates}}&nbsp; Ratings &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;</strong></p>
                                                                                @endif
                                                @endforeach

                                    {{--                                    end of output for avg rating--}}
                                    <hr>
                                    {{--input user rating in stars (input & output if exit)--}}
                                    <div style="float: left"><strong>Rate this reading plan &nbsp;&nbsp;&nbsp;</strong></div>
                                    <section style="float: left" class='rating-widget'>

                                        {{--show user rate in the stars for each reading plan--}}

                                        @if(!empty($user_rates))
                                            <?php
                                            $user_rate = 0;
                                            $user_rate_for_this_reading_plan = 0;
                                            ?>
                                            @foreach($user_rates as $user_rate)
                                                @if($reading_plan->id == $user_rate->reading_plan_id)
                                                    <?php $user_rate_for_this_reading_plan = $user_rate->rate; ?>
                                                @endif
                                            @endforeach
                                        @else
                                            <?php $user_rate_for_this_reading_plan = 0; ?>
                                        @endif

                                        <div class='rating-stars text-center'>
                                            {{--                                                <p>avg rate {{($reading_plan->rate)}}</p>--}}
                                            {{--                                                <p>user rate {{($user_rate_for_this_reading_plan)}}</p>--}}
                                            {{--            <p>num of rates {{($count_rates_for_this_reading_plan)}}</p>--}}

                                            <ul id='stars'>
                                                <input type="hidden" class="reading_plan_id"
                                                       plan_id="{{$reading_plan->id}}">
                                                <li class='star @if($user_rate_for_this_reading_plan >= 1) selected @endif'
                                                    title='Poor' data-value='1'>
                                                    <i class="
                        @if($user_rate_for_this_reading_plan >= 1)
                                                        fa fa-star
@else
                                                        fa fa-star fa-fw
@endif" aria-hidden="true">
                                                    </i>
                                                </li>

                                                <li class='star @if($user_rate_for_this_reading_plan >= 2) selected @endif'
                                                    title='Fair' data-value='2'>
                                                    <i class="
                        @if($user_rate_for_this_reading_plan >= 2)
                                                        fa fa-star
@else
                                                        fa fa-star fa-fw
@endif" aria-hidden="true">
                                                    </i>
                                                </li>

                                                <li class='star @if($user_rate_for_this_reading_plan >= 3) selected @endif'
                                                    title='Good' data-value='3'>
                                                    <i class="
                        @if($user_rate_for_this_reading_plan >= 3)
                                                        fa fa-star
@else
                                                        fa fa-star fa-fw
@endif" aria-hidden="true">
                                                    </i>
                                                </li>

                                                <li class='star @if($user_rate_for_this_reading_plan >= 4) selected @endif'
                                                    title='Excellent' data-value='4'>
                                                    <i class="
                        @if($user_rate_for_this_reading_plan >= 4)
                                                        fa fa-star
@else
                                                        fa fa-star fa-fw
@endif" aria-hidden="true">
                                                    </i>
                                                </li>

                                                <li class='star @if($user_rate_for_this_reading_plan >= 5) selected @endif'
                                                    title='WOW!!!' data-value='5'>
                                                    <i class="
                        @if($user_rate_for_this_reading_plan >= 5)
                                                        fa fa-star
@else
                                                        fa fa-star fa-fw
@endif" aria-hidden="true">
                                                    </i>
                                                </li>
                                            </ul>
                                        </div>
                                    </section>
{{--                                    end of user stars rating--}}



                                </div>
                                <div class="card-body">

                                    <hr>

                                    <p class="card-text"><strong>READING PLAN DETAILS:</strong> {{$reading_plan->text}}</p>
                                </div>


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


{{--script for delete & edit event--}}
<script>
    $(document).ready(function () {
        $('.popup-with-form').magnificPopup({
            type: 'inline',
            preloader: false,
            focus: '#name'
        });
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
            var reading_plan_id = $(this).parent().find('input').attr('plan_id');
            $.ajax({
                method: "POST",
                url: "{{url('readingplan/rate')}}",
                dataType: "json",
                data: {
                    _token: "{{ csrf_token() }}",
                    reading_plan_id: reading_plan_id,
                    rate: rate
                },
            });
        });


    });

</script>

</body>

</html>


