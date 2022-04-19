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
                        <li class="active">
                            <a href="{{ route('users.posts', $user)}}">
                                <i style="margin-left: 35px;" class="far fa-file-alt"></i>Posts</a>
                        </li>
                        <li>
                            <a href="{{ route('users.lists', $user)}}">
                                <i style="margin-left: 35px;" class="now-ui-icons design_bullet-list-67"></i>lists</a>
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
                {{--user info --}}
                <div  style="margin: 0 auto" class="col-md-4">
                    <div class="card card-user">
                        <br><br>
                        <div class="card-body">
                            <div class="author">
                                <a href="">
                                    <img class="avatar border-gray" src="{{url('/users_image')}}/{{$user->image}}" alt="...">
                                    <h5 class="title">{{$user->first_name}}&nbsp;{{$user->last_name}}</h5>
                                </a>
                                <p class="description">
                                    <strong>email: &nbsp;</strong><a
                                        href="">{{$user->email}}</a>
                                </p>
                                <p class="description">
                                    BIRTHDAY: {{$user->date_of_birth}}
                                </p>
                                <p class="description">
                                    GENDER: {{$user->gender}}
                                </p>
                                <p class="description">
                                    nationality: {{$user->nationality}}
                                </p>
                            </div>

                        </div>

                        <hr>
                        <div class="button-container">

                            BIO: {{$user->bio}}

                        </div>
                    </div>
                </div>
            </div>
            {{--end of user info--}}

            <div class="row">
                <div class="col-md-12">

                    <div class="card">
                        {{--show posts--}}
                        @foreach($posts as $post )
                            {{--if to show all posts for user owner the profile OR show puplic lists for posts --}}
                            @if((($post->post_lists['0']->privacy) == ('public')))
                                <div class="card-body">
                                    <div class="card card-nav-tabs">
                                        <div class="card-header card-header-warning">
                                            <img class="card-img-top" src="{{url('/users_image')}}/{{$post->user->image}}" style="width: 60px;"
                                                 alt="Card image cap">
                                            @if(Auth::user() == $post->user)
                                                <a href="{{ route('user.show',$post->user) }}">{{$post->user->first_name}}&nbsp;{{$post->user->last_name}}</a>
                                            @else
                                                <a href="{{ route("users.posts",$post->user)}}">{{$post->user->first_name}}&nbsp;{{$post->user->last_name}}</a>
                                            @endif

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

                                            <div class="reactions{{$post->id}}">
                                            {{--add reaction to the post--}}
{{--                                            <form method="POST" action="{{ route('post.reaction.store', $post) }}">--}}
{{--                                                @csrf--}}
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
{{--                                            </form>--}}
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
                                                    {{--                                                <a href="{{ route('user.show',$comment->user) }}"> {{$comment->user->first_name}}</a>--}}

                                                    {{--drop down to delete comment--}}
                                                    {{--if to show the shm to comment owner--}}
                                                    @if(((Auth::user()->id) == ($comment->user->id)))
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
                                                                    <input type="hidden" id="from_users" name="from_users" value={{true}}>
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
{{--                                        <form method="POST" action="{{ route('post.comment.store', $post) }}">--}}
{{--                                            @csrf--}}
                                            <div class="form-row" post_id="{{$post->id}}">
                                                <div style="padding-left: 30px;" class="form-group col-md-11">
                                                    <input placeholder="Comment" class="form-control comment-text" id="text" type="text"
                                                           name="text"
                                                           style="width: 100%" value="{{ old('text') }}">
                                                    @error('text')
                                                    <strong style="color: #FF3636; padding-left: 18px;">
                                                        *{{ $message }}</strong>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-1 add-comment">
                                                    <button style="margin-top: 1px;" type="submit"
                                                            class="btn btn-primary btn-fab btn-icon btn-round">
                                                        <i class="now-ui-icons ui-2_chat-round"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endif
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
                                '                                                <img class="card-img-top" src="{{url('/users_image')}}/{{$comment->user->image}}"\n' +
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

    {{--script for delete comment--}}
    <script>
        $(document).ready(function () {
            $('.popup-with-form').magnificPopup({
                type: 'inline',
                preloader: false,
                focus: '#name'
            });
        });
    </script>

</body>

</html>


