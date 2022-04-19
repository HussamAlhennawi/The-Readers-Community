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
            <a href="{{Route('/')}}" class="simple-text logo-normal">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-book-reader fa-2x"></i> &nbsp;&nbsp;&nbsp;READERS
                COMMUNITY
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
                        <li class="active">
                            <a href="{{ route('user.show', Auth::user())}}">
                                <i style="margin-left: 35px;" class="far fa-file-alt"></i>Posts</a>
                        </li>
                        <li>
                            <a href="{{ route('user.lists.index', Auth::user())}}">
                                <i style="margin-left: 35px;" class="now-ui-icons design_bullet-list-67"></i>lists</a>
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

                </div>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                        aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navigation">
                    <form method="GET" action="{{ route('user.show', Auth::user())}}">
                        <div class="input-group no-border">
                            <input type="text" value="" class="form-control" placeholder="Posts Search ..." name="search_text">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <i class="now-ui-icons ui-1_zoom-bold"></i>
                                </div>
                            </div>
                        </div>
                    </form>
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown" onclick="markread()">
                            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                <span class="badge badge-light">@if((Auth::user()->unreadNotifications->count()) > 0){{Auth::user()->unreadNotifications->count()}}@endif</span>
                                <i class="now-ui-icons location_world"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                @foreach(Auth::user()->unreadNotifications as $notification)
                                    @if($notification->data['in'] == 'profile')
                                        <a style="background-color: lightgray" class="dropdown-item" href="{{ route('user.show', Auth::user())}}#{{$notification->data['post_id']}}">{{$notification->data['msg']}}</a>
                                    @elseif($notification->data['in'] == 'book')
                                        <a style="background-color: lightgray" class="dropdown-item" href="{{ route('book.show', $notification->data['in_id'])}}#{{$notification->data['post_id']}}">{{$notification->data['msg']}}</a>
                                    @elseif($notification->data['in'] == 'group')
                                        <a style="background-color: lightgray" class="dropdown-item" href="{{ route('group.show', $notification->data['in_id'])}}#{{$notification->data['post_id']}}">{{$notification->data['msg']}}</a>
                                    @elseif($notification->data['in'] == 'join')
                                        <a style="background-color: lightgray" class="dropdown-item" href="{{ route('group.members', $notification->data['in_id'])}}">{{$notification->data['msg']}}</a>
                                    @elseif($notification->data['in'] == 'accept')
                                        <a style="background-color: lightgray" class="dropdown-item" href="{{ route('group.show', $notification->data['in_id'])}}">{{$notification->data['msg']}}</a>
                                    @endif
                                @endforeach

                                    @foreach(Auth::user()->readNotifications as $notification)
                                        @if($notification->data['in'] == 'profile')
                                            <a class="dropdown-item" href="{{ route('user.show', Auth::user())}}#{{$notification->data['post_id']}}">{{$notification->data['msg']}}</a>
                                        @elseif($notification->data['in'] == 'book')
                                            <a class="dropdown-item" href="{{ route('book.show', $notification->data['in_id'])}}#{{$notification->data['post_id']}}">{{$notification->data['msg']}}</a>
                                        @elseif($notification->data['in'] == 'group')
                                            <a class="dropdown-item" href="{{ route('group.show', $notification->data['in_id'])}}#{{$notification->data['post_id']}}">{{$notification->data['msg']}}</a>
                                        @elseif($notification->data['in'] == 'join')
                                            <a class="dropdown-item" href="{{ route('group.members', $notification->data['in_id'])}}">{{$notification->data['msg']}}</a>
                                        @elseif($notification->data['in'] == 'accept')
                                            <a class="dropdown-item" href="{{ route('group.show', $notification->data['in_id'])}}">{{$notification->data['msg']}}</a>
                                        @endif
                                    @endforeach
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="now-ui-icons users_single-02"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->

        <div class="panel-header panel-header-sm">
        </div>
        <div class="content">
            {{--new post + info--}}
            <div class="row">
                @if(((Auth::user()->id) == ($user->id)))
                    <div class="col-md-8">
                        <div class="card">
                            {{--add new post--}}
                            <div class="card-header">

                            </div>
                            <div class="card-body">
                                {{--add new post for user--}}
                                <form method="POST" action="{{ route('user.post.store', Auth::user()) }}">
                                    @csrf
                                    <input type="hidden" id="user_id" name="user_id" value={{Auth::user()->id}}>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                        <textarea class="form-control" id="text" type="text" name="text" rows="3"
                                                  value="{{ old('text') }}" placeholder="ADD NEW POST"></textarea>
                                            @error('text')
                                            <strong style="color: #FF3636; padding-left: 18px;">
                                                *{{ $message }}</strong>
                                            @enderror
                                        </div>
                                    </div>

                                    <label style="margin-top: 7px; margin-bottom: 10px;">note: Here down you can add
                                        some
                                        info about your post and store the post in specific list and you can add a book
                                        or author as a reference in your post</label>
                                    <div class="form-row">
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

                                        <div class="form-group col-md-1">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label>&nbsp;&nbsp;&nbsp;{{ ('LIST ') }}(select list or add one)</label>
                                            <select class="form-control post_list" name="post_list[]">
                                                @foreach($user_lists_for_posts as $user_list_for_posts)
                                                    {{--<option disabled selected hidden value="other"> select a list </option>--}}
                                                    <option
                                                        value="{{$user_list_for_posts->id}}">{{$user_list_for_posts->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('post_list')
                                            <strong style="color: #FF3636; padding-left: 18px;">
                                                *{{ $message }}</strong>
                                            @enderror
                                        </div>

                                        <div class="new-list" style="margin-top: 35px; margin-left: 20px;">
                                            <a class="popup-with-form now-ui-icons ui-1_simple-add"
                                               href="#add-list-form">{{ ('  List') }}</a>
                                        </div>
                                    </div>

                                    <div class="form-row">

                                        <div class="form-group col-md-1">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>&nbsp;&nbsp;&nbsp;{{ ('About (Book)') }}</label>
                                            <select name="books[]" class="form-control books" multiple>
                                                @foreach($books as $book)
                                                    <option value="{{$book->id}}"> {{$book->title}}</option>
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
                                            <select name="authors[]" class="form-control authors" multiple>
                                                @foreach($authors as $author)
                                                    <option value="{{$author->id}}">{{$author->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('authors')
                                            <strong style="color: #FF3636; padding-left: 18px;">
                                                *{{ $message }}</strong>
                                            @enderror
                                        </div>
                                    </div>


                                    <div>
                                        <button type="submit" class="btn btn-primary">{{ ('POST') }}</button>
                                    </div>

                                </form>
                                <!-- link that opens popup -->
                                <div class="card-body mfp-hide white-popup-block" id="add-list-form"
                                     style="background-color: #f0f0f0; width: 50%; margin: 0 auto">
                                    <label style="margin-left: 37%"
                                           class="form-group"><strong>{{ ('ADD NEW LIST FOR YOUR POSTS') }}</strong></label>
                                    <br>
                                    <form id="add-list-form" method="POST"
                                          action="{{ route('user.lists.store', Auth::user()) }}">
                                        @csrf
                                        <input type="hidden" id="user_id" name="user_id" value={{Auth::user()->id}}>
                                        <input type="hidden" id="type" name="type" value="post">
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
                                                Private (only you)
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
                            </div>
                        </div>
                        {{--end of add new post--}}
                    </div>
                @endif

                {{--user info --}}
                <div style="margin: 0 auto" class="col-md-4">
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

                        @if(Auth::user()->id == $user->id)
                            {{--popup edit info--}}
                            <div class="edit-info" style="margin-left: 39%;">
                                <a class="popup-with-form"
                                   href="#edit-info-form">
                                    <button class="btn btn-primary btn-round btn-outline-primary btn-sm">Edit Info
                                    </button>
                                </a>
                            </div>
                        @endif
                    <!-- link that opens popup -->
                        <div class="card-body mfp-hide white-popup-block" id="edit-info-form"
                             style="background-color: #f0f0f0; width: 50%; margin: 0 auto">
                            <center><label class="form-group"><strong>{{ ('EDIT PERSONAL INFO') }}</strong></label>
                            </center>
                            <br>
                            <form id="edit-info-form" method="POST" action="{{ route('user.update', Auth::user()) }}">
                                @csrf
                                @method('PUT')
                                <input type="hidden" id="user_id" name="user_id" value={{Auth::user()->id}}>
                                <div class="form-group">
                                    <label>{{ ('Email: ') }}</label>
                                    <input class="form-control" id="email" type="email" name="email"
                                           value="{{ Auth::user()->email }}">
                                    @error('email')
                                    <strong style="color: #FF3636; padding-left: 18px;"> *{{ $message }}</strong>
                                    @enderror
                                </div>

                                <div class="form-group col-5">
                                    <label>{{ ('BIRTHDAY') }}</label>
                                    <input id="date_of_birth" type="date" class="form-control" type="datetime-local"
                                           name="date_of_birth" value="{{Auth::user()->date_of_birth}}">
                                    @error('date_of_birth')
                                    <strong style="color: #FF3636; padding-left: 18px;">
                                        *{{ $message }}</strong>
                                    @enderror
                                </div>

                                <div class="form-group col-3">
                                    <label>&nbsp;&nbsp;&nbsp;{{ ('Gender: ') }}</label><br>
                                    <select id="gender" name="gender" class="form-control">
                                        <option
                                            value="male" {{ Auth::user()->gender == 'male' ? 'selected' : '' }}>
                                            Male
                                        </option>
                                        <option
                                            value="female" {{ Auth::user()->gender == 'female' ? 'selected' : '' }}>
                                            Female
                                        </option>
                                    </select>
                                    @error('gender')
                                    <strong style="color: #FF3636; padding-left: 18px;"> *{{ $message }}</strong>
                                    @enderror
                                </div>

                                <br>


                                <div class="form-group col-6">
                                    <label>{{ ('Nationality') }}</label>
                                    <select id="nationality" name="nationality" class="form-control">
                                        <option selected hidden
                                                value="{{Auth::user()->nationality}}">{{Auth::user()->nationality}}</option>
                                        <option value="syrian">Syrian</option>
                                        <option value="afghan">Afghan</option>
                                        <option value="albanian">Albanian</option>
                                        <option value="algerian">Algerian</option>
                                        <option value="american">American</option>
                                        <option value="andorran">Andorran</option>
                                        <option value="angolan">Angolan</option>
                                        <option value="antiguans">Antiguans</option>
                                        <option value="argentinean">Argentinean</option>
                                        <option value="armenian">Armenian</option>
                                        <option value="australian">Australian</option>
                                        <option value="austrian">Austrian</option>
                                        <option value="azerbaijani">Azerbaijani</option>
                                        <option value="bahamian">Bahamian</option>
                                        <option value="bahraini">Bahraini</option>
                                        <option value="bangladeshi">Bangladeshi</option>
                                        <option value="barbadian">Barbadian</option>
                                        <option value="barbudans">Barbudans</option>
                                        <option value="batswana">Batswana</option>
                                        <option value="belarusian">Belarusian</option>
                                        <option value="belgian">Belgian</option>
                                        <option value="belizean">Belizean</option>
                                        <option value="beninese">Beninese</option>
                                        <option value="bhutanese">Bhutanese</option>
                                        <option value="bolivian">Bolivian</option>
                                        <option value="bosnian">Bosnian</option>
                                        <option value="brazilian">Brazilian</option>
                                        <option value="british">British</option>
                                        <option value="bruneian">Bruneian</option>
                                        <option value="bulgarian">Bulgarian</option>
                                        <option value="burkinabe">Burkinabe</option>
                                        <option value="burmese">Burmese</option>
                                        <option value="burundian">Burundian</option>
                                        <option value="cambodian">Cambodian</option>
                                        <option value="cameroonian">Cameroonian</option>
                                        <option value="canadian">Canadian</option>
                                        <option value="cape verdean">Cape Verdean</option>
                                        <option value="central african">Central African</option>
                                        <option value="chadian">Chadian</option>
                                        <option value="chilean">Chilean</option>
                                        <option value="chinese">Chinese</option>
                                        <option value="colombian">Colombian</option>
                                        <option value="comoran">Comoran</option>
                                        <option value="congolese">Congolese</option>
                                        <option value="costa rican">Costa Rican</option>
                                        <option value="croatian">Croatian</option>
                                        <option value="cuban">Cuban</option>
                                        <option value="cypriot">Cypriot</option>
                                        <option value="czech">Czech</option>
                                        <option value="danish">Danish</option>
                                        <option value="djibouti">Djibouti</option>
                                        <option value="dominican">Dominican</option>
                                        <option value="dutch">Dutch</option>
                                        <option value="east timorese">East Timorese</option>
                                        <option value="ecuadorean">Ecuadorean</option>
                                        <option value="egyptian">Egyptian</option>
                                        <option value="emirian">Emirian</option>
                                        <option value="equatorial guinean">Equatorial Guinean</option>
                                        <option value="eritrean">Eritrean</option>
                                        <option value="estonian">Estonian</option>
                                        <option value="ethiopian">Ethiopian</option>
                                        <option value="fijian">Fijian</option>
                                        <option value="filipino">Filipino</option>
                                        <option value="finnish">Finnish</option>
                                        <option value="french">French</option>
                                        <option value="gabonese">Gabonese</option>
                                        <option value="gambian">Gambian</option>
                                        <option value="georgian">Georgian</option>
                                        <option value="german">German</option>
                                        <option value="ghanaian">Ghanaian</option>
                                        <option value="greek">Greek</option>
                                        <option value="grenadian">Grenadian</option>
                                        <option value="guatemalan">Guatemalan</option>
                                        <option value="guinea-bissauan">Guinea-Bissauan</option>
                                        <option value="guinean">Guinean</option>
                                        <option value="guyanese">Guyanese</option>
                                        <option value="haitian">Haitian</option>
                                        <option value="herzegovinian">Herzegovinian</option>
                                        <option value="honduran">Honduran</option>
                                        <option value="hungarian">Hungarian</option>
                                        <option value="icelander">Icelander</option>
                                        <option value="indian">Indian</option>
                                        <option value="indonesian">Indonesian</option>
                                        <option value="iranian">Iranian</option>
                                        <option value="iraqi">Iraqi</option>
                                        <option value="irish">Irish</option>
                                        <option value="israeli">Israeli</option>
                                        <option value="italian">Italian</option>
                                        <option value="ivorian">Ivorian</option>
                                        <option value="jamaican">Jamaican</option>
                                        <option value="japanese">Japanese</option>
                                        <option value="jordanian">Jordanian</option>
                                        <option value="kazakhstani">Kazakhstani</option>
                                        <option value="kenyan">Kenyan</option>
                                        <option value="kittian and nevisian">Kittian and Nevisian</option>
                                        <option value="kuwaiti">Kuwaiti</option>
                                        <option value="kyrgyz">Kyrgyz</option>
                                        <option value="laotian">Laotian</option>
                                        <option value="latvian">Latvian</option>
                                        <option value="lebanese">Lebanese</option>
                                        <option value="liberian">Liberian</option>
                                        <option value="libyan">Libyan</option>
                                        <option value="liechtensteiner">Liechtensteiner</option>
                                        <option value="lithuanian">Lithuanian</option>
                                        <option value="luxembourger">Luxembourger</option>
                                        <option value="macedonian">Macedonian</option>
                                        <option value="malagasy">Malagasy</option>
                                        <option value="malawian">Malawian</option>
                                        <option value="malaysian">Malaysian</option>
                                        <option value="maldivan">Maldivan</option>
                                        <option value="malian">Malian</option>
                                        <option value="maltese">Maltese</option>
                                        <option value="marshallese">Marshallese</option>
                                        <option value="mauritanian">Mauritanian</option>
                                        <option value="mauritian">Mauritian</option>
                                        <option value="mexican">Mexican</option>
                                        <option value="micronesian">Micronesian</option>
                                        <option value="moldovan">Moldovan</option>
                                        <option value="monacan">Monacan</option>
                                        <option value="mongolian">Mongolian</option>
                                        <option value="moroccan">Moroccan</option>
                                        <option value="mosotho">Mosotho</option>
                                        <option value="motswana">Motswana</option>
                                        <option value="mozambican">Mozambican</option>
                                        <option value="namibian">Namibian</option>
                                        <option value="nauruan">Nauruan</option>
                                        <option value="nepalese">Nepalese</option>
                                        <option value="new zealander">New Zealander</option>
                                        <option value="ni-vanuatu">Ni-Vanuatu</option>
                                        <option value="nicaraguan">Nicaraguan</option>
                                        <option value="nigerien">Nigerien</option>
                                        <option value="north korean">North Korean</option>
                                        <option value="northern irish">Northern Irish</option>
                                        <option value="norwegian">Norwegian</option>
                                        <option value="omani">Omani</option>
                                        <option value="pakistani">Pakistani</option>
                                        <option value="palauan">Palauan</option>
                                        <option value="panamanian">Panamanian</option>
                                        <option value="papua new guinean">Papua New Guinean</option>
                                        <option value="paraguayan">Paraguayan</option>
                                        <option value="peruvian">Peruvian</option>
                                        <option value="polish">Polish</option>
                                        <option value="portuguese">Portuguese</option>
                                        <option value="qatari">Qatari</option>
                                        <option value="romanian">Romanian</option>
                                        <option value="russian">Russian</option>
                                        <option value="rwandan">Rwandan</option>
                                        <option value="saint lucian">Saint Lucian</option>
                                        <option value="salvadoran">Salvadoran</option>
                                        <option value="samoan">Samoan</option>
                                        <option value="san marinese">San Marinese</option>
                                        <option value="sao tomean">Sao Tomean</option>
                                        <option value="saudi">Saudi</option>
                                        <option value="scottish">Scottish</option>
                                        <option value="senegalese">Senegalese</option>
                                        <option value="serbian">Serbian</option>
                                        <option value="seychellois">Seychellois</option>
                                        <option value="sierra leonean">Sierra Leonean</option>
                                        <option value="singaporean">Singaporean</option>
                                        <option value="slovakian">Slovakian</option>
                                        <option value="slovenian">Slovenian</option>
                                        <option value="solomon islander">Solomon Islander</option>
                                        <option value="somali">Somali</option>
                                        <option value="south african">South African</option>
                                        <option value="south korean">South Korean</option>
                                        <option value="spanish">Spanish</option>
                                        <option value="sri lankan">Sri Lankan</option>
                                        <option value="sudanese">Sudanese</option>
                                        <option value="surinamer">Surinamer</option>
                                        <option value="swazi">Swazi</option>
                                        <option value="swedish">Swedish</option>
                                        <option value="swiss">Swiss</option>
                                        <option value="taiwanese">Taiwanese</option>
                                        <option value="tajik">Tajik</option>
                                        <option value="tanzanian">Tanzanian</option>
                                        <option value="thai">Thai</option>
                                        <option value="togolese">Togolese</option>
                                        <option value="tongan">Tongan</option>
                                        <option value="trinidadian or tobagonian">Trinidadian or Tobagonian</option>
                                        <option value="tunisian">Tunisian</option>
                                        <option value="turkish">Turkish</option>
                                        <option value="tuvaluan">Tuvaluan</option>
                                        <option value="ugandan">Ugandan</option>
                                        <option value="ukrainian">Ukrainian</option>
                                        <option value="uruguayan">Uruguayan</option>
                                        <option value="uzbekistani">Uzbekistani</option>
                                        <option value="venezuelan">Venezuelan</option>
                                        <option value="vietnamese">Vietnamese</option>
                                        <option value="welsh">Welsh</option>
                                        <option value="yemenite">Yemenite</option>
                                        <option value="zambian">Zambian</option>
                                        <option value="zimbabwean">Zimbabwean</option>
                                    </select>

                                    @error('nationality')
                                    <strong style="color: #FF3636; padding-left: 18px;">
                                        *{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label><strong>{{ ('BIO :') }}</strong></label>
                                    <textarea class="form-control" id="bio" type="text" name="bio" rows="3"
                                              style="width: 90%">{{ $user->bio}}</textarea>
                                    @error('bio')
                                    <strong style="color: #FF3636; padding-left: 18px;"> *{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div>
                                    <label><strong>{{ ('Profile Image :') }}</strong></label>
                                    <input class="form-control" id="image" type="file" accept=".jpg" name="image"
                                           style="width: 35%" value="{{ old('image') }}">
                                    @error('image')
                                    <strong style="color: #FF3636; padding-left: 18px;"> *{{ $message }}</strong>
                                    @enderror
                                </div>

                                <div>
                                    <button type="submit" class="btn btn-primary">
                                        {{ ('EDIT INFO') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                        {{--end popup--}}
                    </div>
                </div>
            </div>
            {{--end of new post + info--}}

            <div class="row">
                <div class="col-md-12">

                    <div class="card">
                        {{--show posts--}}
                        @foreach($posts as $post )
                            {{--if to show all posts for user owner the profile OR show puplic lists for posts --}}
                            @if(((Auth::user()->id) == ($user->id)))
                                <div class="card-body" id="{{$post->id}}">
                                    <div class="card card-nav-tabs">
                                        <div class="card-header card-header-warning">
                                            <img class="card-img-top" src="{{url('/users_image')}}/{{$user->image}}"
                                                 style="width: 60px;"
                                                 alt="Card image cap">
                                            <a href="{{ route('user.show',$post->user) }}"> {{$post->user->first_name}}
                                                &nbsp;{{$post->user->last_name}}</a>
                                            {{--drop down to edit & delete--}}
                                            {{--if to show the shm to post owner--}}
                                            @if(((Auth::user()->id) == ($post->user_id)))
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
                                                        <form method="POST"
                                                              action="{{ route('user.post.update', [$user, $post]) }}">
                                                            @method('PUT')
                                                            @csrf
                                                            <input type="hidden" id="user_id" name="user_id"
                                                                   value={{Auth::user()->id}}>

                                                            <center>
                                                                <label><strong>{{ ('Edit Your Post :') }}</strong></label>
                                                            </center>

                                                            <div class="form-row">

                                                                <div class="form-group col-md-12">
                                                                    <textarea class="form-control" id="text" type="text"
                                                                              name="text"
                                                                              rows="3">{{$post->text}}</textarea>
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
                                                                        <option disabled selected hidden value="">
                                                                            select a
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
                                                                        <option disabled selected hidden value="">
                                                                            select a
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
                                                                    <select class="form-control post_list"
                                                                            name="post_list[]">
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
                                                                    <select name="books[]" class="form-control books"
                                                                            multiple>
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
                                                                    <select name="authors[]"
                                                                            class="form-control authors"
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
                                                                <button type="submit"
                                                                        class="btn btn-primary">{{ ('EDIT POST') }}</button>
                                                            </div>

                                                        </form>
                                                    </div>
                                                    {{--end of edit popup--}}

                                                    {{--Pop up to delete post--}}
                                                    <div class="card-body mfp-hide white-popup-block"
                                                         id="delete-form{{$post->id}}"
                                                         style="background-color: #f0f0f0; width: 50%; margin: 0 auto">
                                                        <center>
                                                            <label
                                                                class="form-group"><strong>{{ ('DELETE POST') }}</strong>
                                                            </label>
                                                        </center>
                                                        <br>
                                                        <form method="POST"
                                                              action="{{ route('user.post.destroy', [$user, $post]) }}">
                                                            @method('DELETE')
                                                            @csrf
                                                            <div style="margin-left: 40%" class="form-group">
                                                                <br>
                                                                <label><strong>{{ ('confirm post delete :') }}</strong></label>
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
                                                {{--end of drop down edit & delete       --}}
                                            @endif
                                            <span
                                                style="float: right">{{date('d-m-Y', strtotime($post->created_at))}}</span>

                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                @if($post->type)
                                                    <strong>Type:</strong> {{$post->type}} &nbsp;&nbsp;&nbsp;&nbsp;
                                                    &nbsp;
                                                @endif
                                                @if($post->status)
                                                    <strong>Status:</strong> {{$post->status}} &nbsp;&nbsp;&nbsp;&nbsp;
                                                    &nbsp;
                                                @endif
                                                @if($post->post_lists)
                                                    <strong>List:</strong> <a
                                                        href="{{route('user.postslist', [Auth::user() , $post->post_lists['0']])}}">#{{$post->post_lists['0']->name}}</a>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    &nbsp;
                                                @endif

                                                @if($post->post_related_to_book->count() > 0)
                                                    <strong>About Book:</strong>
                                                    @foreach($post->post_related_to_book as $prb)
                                                        <a href= {{ route('book.show',$prb)}} >{{$prb->title}}</a>
                                                        &nbsp;
                                                    @endforeach
                                                @endif
                                                @if($post->post_related_to_author->count() > 0)
                                                    <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;About Author:</strong>
                                                    @foreach($post->post_related_to_author as $pra)
                                                        <a href= {{ route('author.show',$pra)}} >{{$pra->name}}</a>
                                                        &nbsp;
                                                    @endforeach
                                                @endif

                                            </h5>
                                            <hr>
                                            <p class="card-text">{{$post->text}}</p>


                                            {{--add reaction to the post--}}
                                            <div class="reactions{{$post->id}}">
{{--                                            <form method="POST" action="{{ route('post.reaction.store', $post) }}">--}}
{{--                                                @csrf--}}
                                                <div class="new-reac" style="margin-left: 35%">
                                                    {{--get the reactions type and display them--}}
                                                    @foreach($reactions as $reaction)
                                                        {{--<button class="btn btn-primary btn-sm" name="reaction_id" value="{{$reaction->id}}" type="submit"> {{$reaction->name}} </button>--}}
                                                        {{--get number or each reaction type for each post in this profile --}}
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
                                                    <img class="card-img-top" src="{{url('/users_image')}}/{{$user->image}}"
                                                         style="width: 30px;" alt="Card image cap">
                                                    @if(Auth::user() == $comment->user)
                                                        <a href="{{ route('user.show',$comment->user) }}">{{$comment->user->first_name}}
                                                            &nbsp;{{$comment->user->last_name}}</a>
                                                    @else
                                                        <a href="{{ route("users.posts",$comment->user)}}">{{$comment->user->first_name}}
                                                            &nbsp;{{$comment->user->last_name}}</a>
                                                    @endif

                                                    {{--drop down to delete comment--}}
                                                    {{--if to show the shm to post owner--}}
                                                    @if(((Auth::user()->id) == ($post->user_id)))
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
                                                                @if(((Auth::user()->id) == ($post->user_id)))
                                                                    <a class="popup-with-form dropdown-item"
                                                                       href="#delete-comment-form{{$comment->id}}">Delete</a>
                                                                @endif
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
                                                                    <input type="hidden" id="from_user_profile" name="from_user_profile" value={{true}}>
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
                                                        {{--end of drop down delete       --}}
                                                    @endif

                                                    <span
                                                        style="float: right">{{date('d-m-Y', strtotime($comment->created_at))}}</span>

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
{{--                                                    <input type="hidden" id="from_user" name="from_user" value={{true}}>--}}
                                                    <input placeholder="Comment" class="form-control comment-text" id="text"
                                                           type="text"
                                                           name="text"
                                                           style="width: 100%" value="{{ old('text') }}">
{{--                                                    @error('text')--}}
{{--                                                    <strong style="color: #FF3636; padding-left: 18px;">--}}
{{--                                                        *{{ $message }}</strong>--}}
{{--                                                    @enderror--}}
                                                </div>
                                                <div class="form-group col-md-1 add-comment">
                                                    <button style="margin-top: 1px;" type="submit"
                                                            class="btn btn-primary btn-fab btn-icon btn-round">
                                                        <i class="now-ui-icons ui-2_chat-round"></i>
                                                    </button>
                                                </div>
                                            </div>
{{--                                        </form>--}}
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


    {{--<!--   Core JS Files   -->--}}
    {{--<script src="../assets/js/core/jquery.min.js"></script>--}}
    <script src="{{asset('/assets/js/core/popper.min.js')}}"></script>
    <script src="{{asset('/assets/js/core/bootstrap.min.js')}}"></script>
    <script src="{{asset('/assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="{{asset('/assets/js/now-ui-dashboard.min.js?v=1.5.0')}}" type="text/javascript"></script>


    <script>
        function markread(){
            $.get('/markasread');
        }

    </script>

{{--    add comment--}}
    <script>
        $(document).ready(function () {

//ajax request for star input rating
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
                            $('.comments' + post_id).append(new_comment);
                            $(this).parent().find('.comment-text').attr('value', '');


                        //     if($(this).parent().find('.comment-text').value==text){
                        //         $(this).parent().find('.comment-text').value="";}
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

{{--    @if ($errors->any())--}}
{{--        <div class="alert alert-danger">--}}
{{--            <ul>--}}
{{--                @foreach ($errors->all() as $error)--}}
{{--                    <li> @if(@error('text'))--}}
{{--                        @dd('hus')--}}
{{--                        @endif</li>--}}
{{--                @endforeach--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    @endif--}}

    {{--script for reopen edit user info popup if there errors--}}
    @if(count($errors))
        <script>
            $(document).ready(function () {
                $('.edit-info .popup-with-form').magnificPopup({
                    type: 'inline',
                    preloader: false,
                    focus: '#name'
                }).magnificPopup('open');
            });
        </script>
    @endif

{{--    --}}{{--script for reopen create new list popup if there errors--}}
{{--    @if(count($errors))--}}
{{--        <script>--}}
{{--            $(document).ready(function () {--}}
{{--                $('.new-list .popup-with-form').magnificPopup({--}}
{{--                    type: 'inline',--}}
{{--                    preloader: false,--}}
{{--                    focus: '#name'--}}

{{--                }).magnificPopup('open');--}}
{{--            });--}}
{{--        </script>--}}
{{--    @endif--}}

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

</div>
</body>

</html>


