<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
{{--    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">--}}
{{--    <link rel="icon" type="image/png" href="../assets/img/favicon.png">--}}
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
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
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{asset('/assets/demo/demo.css')}}" rel="stylesheet"/>
</head>

<body class="">
<div class="wrapper ">
    <div class="sidebar" data-color="orange">
        <div class="logo">
            <a href="{{ route('/')}}" class="simple-text logo-normal">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-book-reader fa-2x"></i> &nbsp;&nbsp;&nbsp;READERS
                COMMUNITY
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
                            <li><a href= {{ route('group.discussion.index',$group)}}>
                                    <i class="now-ui-icons ui-1_send"></i>Discussions</a></li>
                            <li><a href= {{ route('group.event.index',$group)}}>
                                    <i class="far fa-calendar-alt"></i>Events</a></li>
                            <li class="active"><a href= {{ route('group.members',$group)}}>
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

{{--                <div class="collapse navbar-collapse justify-content-end" id="navigation">--}}
{{--                    <form>--}}
{{--                        <div class="input-group no-border">--}}
{{--                            <input type="text" value="" class="form-control" placeholder="Search...">--}}
{{--                            <div class="input-group-append">--}}
{{--                                <div class="input-group-text">--}}
{{--                                    --}}{{--                                    <button type="submit" class="tip-bottom" title="Search"><i class="icon-search icon-white"></i></button>--}}
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">ACTIVE MEMBERS</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                    <th>
                                        Member
                                    </th>
                                    <th>
                                        Date of join
                                    </th>
                                    @if((Auth::user()->id == $group->user_id))
                                        <th class="text-right">
                                            Block
                                        </th>
                                    @endif
                                    </thead>
                                    <tbody>
                                    @foreach($group->group_members as $group_member)
                                        {{--@continue(($group_member->user_id) == (Auth::user()->id))--}}
                                        @if(($group_member->pivot->active == 1) AND ($group_member->pivot->pending == 0))
                                            <tr>
                                                <td>
                                                    <a href="{{ route('user.show',$group_member) }}"> {{$group_member->full_name()}}</a>
                                                @if(($group_member->pivot->user_id == $group->user_id))
                                                        (Group Admin)
                                                 @endif
                                                </td>
                                                <td>
                                                    {{date('d-m-Y', strtotime($group_member->pivot->updated_at))}}
                                                </td>
                                                @if((Auth::user()->id == $group->user_id))
                                                    @if(($group_member->pivot->user_id == $group->user_id))
                                                        <td class="text-right"><div>&nbsp;</div></td>
                                                    @else
                                                    <td class="text-right">
                                                        <form method="POST"
                                                              action="{{ route('group.block', [$group, $group_member]) }}">
                                                            @csrf
                                                            <input type="hidden" name="action" value="block">
                                                            <div>
                                                                <button type="submit" class="btn btn-primary"><i
                                                                        class="now-ui-icons ui-1_simple-remove"></i>
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </td>
                                                @endif
                                                @endif

                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @if((Auth::user()->id == $group->user_id))
                    <div class="col-md-12">
                        <div class="card card-plain">
                            <div class="card-header">
                                <h4 class="card-title"> Blocked Members</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class=" text-primary">
                                        <th>
                                            member
                                        </th>
                                        <th>
                                            Date of Join
                                        </th>
                                        <th>
                                            Date of Block
                                        </th>
                                        <th class="text-right">
                                            UnBlock
                                        </th>
                                        </thead>
                                        <tbody>
                                        @foreach($group->group_members as $group_member)
                                            @if(($group_member->pivot->active == 0) AND ($group_member->pivot->pending == 0))
                                                <tr>
                                                    <td>
                                                        <a href="{{ route('user.show',$group_member) }}"> {{$group_member->full_name()}}</a>
                                                    </td>
                                                    <td>
                                                        {{date('d-m-Y', strtotime($group_member->pivot->created_at))}}
                                                    </td>
                                                    <td>
                                                        {{date('d-m-Y', strtotime($group_member->pivot->updated_at))}}
                                                    </td>
                                                    <td class="text-right">
                                                        <form method="POST"
                                                              action="{{ route('group.unblock', [$group, $group_member]) }}">
                                                            @csrf
                                                            <input type="hidden" name="action" value="unblock">
                                                            <div>
                                                                <button type="submit" class="btn btn-primary"><i
                                                                        class="now-ui-icons ui-1_lock-circle-open"></i>
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                {{--request--}}
                @if((Auth::user()->id == $group->user_id))
                    <div style="margin-left: 25%" class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"> PENDING REQUEST</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="text-primary">
                                        <th>
                                            user
                                        </th>
                                        <th class="text-right">
                                            Accept
                                        </th>
                                        </thead>
                                        <tbody>
                                        @foreach($group->group_members as $group_member)
                                            @if(($group_member->pivot->active == 0) AND ($group_member->pivot->pending == 1))
                                                <tr>
                                                    <td>
                                                        <a href="{{ route('user.show',$group_member) }}"> {{$group_member->full_name()}}</a>
                                                    </td>
                                                    <td class="text-right">
                                                        <form method="POST"
                                                              action="{{ route('group.accept', [$group, $group_member]) }}">
                                                            @csrf
                                                            <input type="hidden" name="action" value="unblock">
                                                            <div>
                                                                <button type="submit" class="btn btn-primary"><i
                                                                        class="now-ui-icons ui-1_check"></i>
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<!--   Core JS Files   -->
{{--<script src="../assets/js/core/jquery.min.js"></script>--}}
<script src="{{asset('/assets/js/core/popper.min.js')}}"></script>
<script src="{{asset('/assets/js/core/bootstrap.min.js')}}"></script>
<script src="{{asset('/assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
<script src="{{asset('/assets/js/now-ui-dashboard.min.js?v=1.5.0')}}" type="text/javascript"></script>
<!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->

</body>

</html>
