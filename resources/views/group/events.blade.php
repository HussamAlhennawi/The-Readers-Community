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
                    <br>
                    <ul style="list-style: none;">
                        <li class="active">
                            <a href= {{ route('group.show',$group)}}>
                                <p style="text-align: center">{{$group->title}}</p>
                            </a>
                        </li>
                        <br>
                        {{--                        @if($group->privacy == 'public' or in_array(Auth::user()->id, $members_ids_in_the_group))--}}
                        <ul style="list-style: none;">
                            <li><a href= {{ route('group.show',$group)}}>
                                    <i class="far fa-file-alt"></i>Posts</a></li>
                            <li><a href= {{ route('group.dis',$group)}}>
                                    <i class="now-ui-icons ui-1_send"></i>Discussions</a></li>
                            <li class="active"><a href= {{ route('group.event.index',$group)}}>
                                    <i class="far fa-calendar-alt"></i>Events</a></li>
                            <li><a href= {{ route('group.members',$group)}}>
                                    <i class="fas fa-user-friends"></i>Members</a></li>
                        </ul>
                        {{--                        @endif--}}
                    </ul>
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
                    <form method="GET" action="{{ route('group.event.index',$group)}}">
                        <div class="input-group no-border">
                            <input type="text" value="" class="form-control" placeholder="Events Search ..." name="event_title">
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
                        {{--add new event for group members & not blocked--}}
                        @if(in_array(Auth::user()->id, $active_members_ids_in_the_group))
                            {{--add new event--}}
                            <div class="card-header">
                                <h5 class="title">ADD NEW EVENT</h5>
                            </div>
                            <div class="card-body">
                                {{--add new event for group members & not blocked--}}
                                <form method="POST" action="{{ route('group.event.store', $group) }}">
                                    @csrf
                                    <input type="hidden" id="user_id" name="user_id" value={{Auth::user()->id}}>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label><strong>{{ ('Event Title :') }}</strong></label>
                                            <input class="form-control" id="title" type="text" name="title"
                                                   value="{{ old('title') }}" autofocus>
                                            @error('title')
                                            <strong style="color: #FF3636; padding-left: 18px;">
                                                *{{ $message }}</strong>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label><strong>{{ ('Event Location :') }}</strong></label>
                                            <input class="form-control" id="location" type="text" name="location"
                                                   value="{{ old('location') }}">
                                            @error('location')
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

                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label><strong>{{ ('DETAILS :') }}</strong></label>
                                            <textarea class="form-control" id="description" type="text"
                                                      name="description" rows="3"
                                                      value="{{ old('description') }}"></textarea>
                                            @error('description')
                                            <strong style="color: #FF3636; padding-left: 18px;">
                                                *{{ $message }}</strong>
                                            @enderror
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">ADD EVENT</button>
                                </form>
                            </div>
                    </div>
                    @endif
                    {{--end of add new event--}}
                    {{--display events in the group--}}

                    @if($group->privacy == 'public' or in_array(Auth::user()->id, $active_members_ids_in_the_group))
                    @foreach($events as $event )
                        <div class="card-body" id="{{$event->id}}">
                            <div class="card card-nav-tabs">

                                <div class="card-header card-header-warning">
                                    <img class="card-img-top" src="{{url('/users_image')}}/{{$event->user->image}}" style="width: 60px;"
                                         alt="Card image cap">
                                    @if(Auth::user() == $event->user)
                                        <a href="{{ route('user.show',$event->user) }}">{{$event->user->first_name}}&nbsp;{{$event->user->last_name}}</a>
                                    @else
                                        <a href="{{ route("users.posts",$event->user)}}">{{$event->user->first_name}}&nbsp;{{$event->user->last_name}}</a>
                                    @endif

                                    {{--drop down to edit & delete event--}}
                                    {{--if to show the shm to post owner and group admin--}}
                                    @if(((Auth::user()->id) == ($event->user_id)) or ((Auth::user()->id) == ($group->user_id)))
                                        <div style="float: right;margin-top: -22px" class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink"
                                               data-toggle="dropdown"
                                               aria-haspopup="true" aria-expanded="false">
                                                <p>
                                                    <span class="d-lg-none d-md-block">Some Actions</span>
                                                </p>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right"
                                                 aria-labelledby="navbarDropdownMenuLink">
                                                @if(((Auth::user()->id) == ($event->user_id)) and ($event->end_at > now()))
                                                    <a class="popup-with-form dropdown-item"
                                                       href="#edit-form{{$event->id}}">Edit</a>
                                                @endif
                                                <a class="popup-with-form dropdown-item"
                                                   href="#delete-form{{$event->id}}">Delete</a>
                                            </div>
                                            {{--Pop up to edit event--}}
                                            <div class="card-body mfp-hide white-popup-block"
                                                 id="edit-form{{$event->id}}"
                                                 style="background-color: #f0f0f0; width: 70%; margin: 0 auto">
                                                <form method="POST"
                                                      action="{{ route('group.event.update', [$group, $event]) }}">
                                                    @method('PUT')
                                                    @csrf
                                                    <input type="hidden" id="user_id" name="user_id"
                                                           value={{Auth::user()->id}}>
                                                    <center><label><strong>{{ ('Edit Your Event :') }}</strong></label>
                                                    </center>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label><strong>{{ ('Event Title :') }}</strong></label>
                                                            <input class="form-control" id="title" type="text"
                                                                   name="title" value="{{ $event->title }}" autofocus
                                                                   disabled>
                                                            @error('title')
                                                            <strong style="color: #FF3636; padding-left: 18px;">
                                                                *{{ $message }}</strong>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label><strong>{{ ('Event Location :') }}</strong></label>
                                                            <input class="form-control" id="location" type="text"
                                                                   name="location" value="{{$event->location}}">
                                                            @error('location')
                                                            <strong style="color: #FF3636; padding-left: 18px;">
                                                                *{{ $message }}</strong>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-row">
                                                        <div class="form-group col-md-4">
                                                            <label><strong>{{ ('Start :') }}</strong></label>
                                                            <input class="form-control" id="start_at"
                                                                   type="datetime-local" name="start_at"
                                                                   value="{{ date('Y-m-d\TH:i', strtotime($event->start_at)) }}">
                                                            @error('start_at')
                                                            <strong style="color: #FF3636; padding-left: 18px;">
                                                                *{{ $message }}</strong>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label><strong>{{ ('END :') }}</strong></label>
                                                            <input class="form-control" id="end_at"
                                                                   type="datetime-local" name="end_at"
                                                                   value="{{ date('Y-m-d\TH:i', strtotime($event->end_at)) }}">
                                                            @error('end_at')
                                                            <strong style="color: #FF3636; padding-left: 18px;">
                                                                *{{ $message }}</strong>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-12">
                                                            <label><strong>{{ ('DETAILS :') }}</strong></label>
                                                            <textarea class="form-control" id="description" type="text"
                                                                      name="description" rows="3"
                                                            >{{$event->description}}</textarea>
                                                            @error('description')
                                                            <strong style="color: #FF3636; padding-left: 18px;">
                                                                *{{ $message }}</strong>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">EDIT EVENT</button>
                                                </form>

                                            </div>
                                            {{--end of edit event popup--}}

                                            {{--Pop up to delete event--}}
                                            <div class="card-body mfp-hide white-popup-block"
                                                 id="delete-form{{$event->id}}"
                                                 style="background-color: #f0f0f0; width: 50%; margin: 0 auto">
                                                <label
                                                    class="form-group"><strong>{{ ('DELETE EVENT') }}</strong></label>
                                                <br>
                                                <form method="POST"
                                                      action="{{ route('group.event.destroy', [$group, $event]) }}">
                                                    @method('DELETE')
                                                    @csrf
                                                    <div class="form-group">
                                                        <label><strong>{{ ('confirm event delete :') }}</strong></label>
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
                                    <span style="float: right">{{date('d-m-Y', strtotime($event->created_at))}}</span>

                                    <span style="float: right"><a class="popup-modal"
                                                                  href="#members-modal{{$event->id}}">&nbsp;&nbsp;&nbsp;{{$event->going_num}} Members</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    {{-- member popup--}}
                                    <div class="card-body mfp-hide white-popup-block" id="members-modal{{$event->id}}"
                                         style="background-color: #f0f0f0; width: 50%; margin: 0 auto">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>Pepole Who ARE Going To THE Event</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($event->event_members as $event_member)
                                                @if(Auth::user()->id == $event_member->id)
                                                <tr>
                                                    <td class="text-center">
                                                            <a href="{{ route('user.show',$event_member) }}">{{$event_member->first_name}}&nbsp;{{$event_member->last_name}}</a>
                                                    </td>
                                                </tr>
                                                @else
                                                    <tr>
                                                        <td class="text-center">
                                                            <a href="{{ route("users.posts",$event_member)}}">{{$event_member->first_name}}&nbsp;{{$event_member->last_name}}</a>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    {{--to dispaly going & not going --}}
                                    @if(!(Auth::user()->id == $event->user_id)) {{--if authenticated user create this event don't display going--}}
                                    @if($event->end_at > now())
                                        @if(in_array(Auth::user()->id, $active_members_ids_in_the_group)) {{--if user is member in the group and not blocked--}}
                                        @if(in_array(Auth::user()->id, $events_ids_with_members[$event->id])) {{--if user is going already to the event--}}
                                        <form style="float: right" method="POST"
                                              action="{{ route('event.going',[$group, $event]) }}">
                                            @csrf
                                            <button style="float: right;margin-top: -5px;" type="submit"
                                                    class="btn btn-primary btn-sm btn-outline-primary">
                                                {{ ('NOT GOING') }}
                                            </button>
                                        </form>
                                        @else
                                            <form style="float: right" method="POST"
                                                  action="{{ route('event.going',[$group, $event]) }}">
                                                @csrf
                                                <button style="float: right;margin-top: -5px;" type="submit"
                                                        class="btn btn-primary btn-sm">
                                                    {{ ('GOING') }}
                                                </button>
                                            </form>
                                        @endif
                                        @endif
                                    @else
                                        <strong style="float: right">This Event Has ENDED</strong>
                                    @endif
                                    @endif
                                    {{--enf of to dispaly going & not going --}}


                                </div>
                                <div class="card-body">
                                    <h5 style="float: left" class="card-title">&nbsp; {{$event->title}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>
                                    <h5 class="card-title"><i class="now-ui-icons location_pin"></i>&nbsp;
                                        Location: {{$event->location}}</h5>
                                    <h5 style="float: left" class="card-title"><i
                                            class="now-ui-icons media-1_button-play"></i>&nbsp;
                                        Start: {{date('d M y, h:i a', strtotime($event->start_at))}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>
                                    <h5 class="card-title"><i class="now-ui-icons media-1_button-pause"></i>&nbsp;
                                        End: {{date('d M y, h:i a', strtotime($event->end_at))}}</h5>
                                    <hr>

                                    <p class="card-text"><strong>EVENT DETAILS:</strong> {{$event->description}}</p>
                                </div>
                                <hr>

                                {{--comments show for each event--}}
                                <div class="comments{{$event->id}}">
                                @foreach($comments as $comment)
                                    @if($event->id == $comment->event_comments['0']->id)
                                        <div style="padding-top: 0px;" class="card-header card-header-warning">
                                            <img class="card-img-top" src="{{url('/users_image')}}/{{$comment->user->image}}"
                                                 style="width: 30px; padding-bottom: 5px;" alt="Card image cap">
                                            @if(Auth::user() == $comment->user)
                                                <a href="{{ route('user.show',$comment->user) }}">{{$comment->user->first_name}}&nbsp;{{$comment->user->last_name}}</a>
                                            @else
                                                <a href="{{ route("users.posts",$comment->user)}}">{{$comment->user->first_name}}&nbsp;{{$comment->user->last_name}}</a>
                                            @endif


                                            {{--drop down to delete comment--}}
                                            {{--if to show the shm to post owner and group admin--}}
                                            @if((((Auth::user()->id) == ($event->user_id)) OR ((Auth::user()->id) == ($group->user_id)) OR ((Auth::user()->id) == ($comment->user->id))) AND (in_array(Auth::user()->id, $active_members_ids_in_the_group)))
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

                                                    {{--Pop up to delete comment--}}
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
                                                              action="{{ route('event.comment.destroy', [$event, $comment]) }}">
                                                            @method('DELETE')
                                                            @csrf
{{--                                                            <input type="hidden" id="from_group" name="from_group" value={{true}}>--}}
                                                            <input type="hidden" id="group_id" name="group_id" value={{$group->id}}>
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

                                {{--add coment to the event--}}

                                    @if(in_array(Auth::user()->id, $active_members_ids_in_the_group))
{{--                                    <form method="POST" action="{{ route('event.comment', $event) }}">--}}
{{--                                        @csrf--}}
                                        <div class="form-row" event_id="{{$event->id}}">
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
{{--                                    </form>--}}
                                @endif
                            </div>
                        </div>
                    @endforeach
                            @endif
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

{{--script for member popup--}}
<script>
    $(document).ready(function () {
        $('.popup-modal').magnificPopup({
            type: 'inline',
            preloader: false,
            focus: '#name'
        });
    });
</script>


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


    <script>
        $(document).ready(function () {

//ajax request to add comment to post
            $('.add-comment').on('click', function () {
                var text = $(this).parent().find('.comment-text').val();
                var event_id = $(this).parent().attr('event_id');

                $.ajax({
                    method: "POST",
                    url:"{{ url('/comment/add') }}",
                    dataType: "json",
                    data: {
                        _token: "{{ csrf_token() }}",
                        event_id: event_id,
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
                            $('.comments' + event_id).append(new_comment);
                            $(this).find('.comment-text').attr('value','');

                        },

                    error: function (jqXHR, status, err) {
                        alert("COMMENT TEXT CAN'T BE EMPTY");
                    },

                });
            });
        });
    </script>

</body>

</html>


