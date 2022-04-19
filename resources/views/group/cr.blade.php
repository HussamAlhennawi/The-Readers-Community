<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Now UI Dashboard by Creative Tim
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- CSS Files -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../assets/demo/demo.css" rel="stylesheet" />
    {{--Chosen--}}
{{--    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>--}}
{{--    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.5/chosen.jquery.js"></script>--}}
{{--    <link href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.5/chosen.css" rel="stylesheet" type="text/css">--}}

    {{--    image-select--}}
    <link href="{{asset('Image-Select-master/src/ImageSelect.css')}}" rel="stylesheet"/>
    <link href="{{asset('Image-Select-master/src/ImageSelect.jquery.js')}}" rel="stylesheet"/>
    <link href="{{asset('Image-Select-master/src/Flat.css')}}" rel="stylesheet"/>

    <!-- Magnific Popup core CSS file -->
    <link rel="stylesheet" href="{{asset('css/magnific-popup/magnific-popup.css')}}">
    <!-- jQuery 1.7.2+ or Zepto.js 1.0+ -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<!-- Magnific Popup core JS file -->
    <script src="{{asset('js/magnific-popup/jquery.magnific-popup.js')}}"></script>
</head>


<hr>
{{--<div class="card-body">--}}
{{--        <form method="POST" action="">--}}
{{--            @csrf--}}
{{--            <input type="hidden" id="user_id" name="user_id" value={{Auth::user()->id}}>--}}

{{--        <div class="form-row">--}}
{{--            <div class="form-group col-md-6">--}}
{{--                <label><strong>{{ ('Event Title :') }}</strong></label>--}}
{{--                <input class="form-control" id="title" type="text" name="title" value="{{ old('title') }}" autofocus>--}}
{{--                @error('title')--}}
{{--                <strong style="color: #FF3636; padding-left: 18px;"> *{{ $message }}</strong>--}}
{{--                @enderror--}}
{{--            </div>--}}
{{--            <div class="form-group col-md-6">--}}
{{--                <label><strong>{{ ('Event Location :') }}</strong></label>--}}
{{--                <input class="form-control" id="location" type="text" name="location" value="{{ old('location') }}">--}}
{{--                @error('location')--}}
{{--                <strong style="color: #FF3636; padding-left: 18px;"> *{{ $message }}</strong>--}}
{{--                @enderror--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="form-row">--}}
{{--            <div class="form-group col-md-4">--}}
{{--                <label><strong>{{ ('Start :') }}</strong></label>--}}
{{--                <input class="form-control" id="start_at" type="datetime-local" name="start_at" value="{{ old('start_at') }}">--}}
{{--                @error('start_at')--}}
{{--                <strong style="color: #FF3636; padding-left: 18px;"> *{{ $message }}</strong>--}}
{{--                @enderror--}}
{{--            </div>--}}
{{--            <div class="form-group col-md-4">--}}
{{--                <label><strong>{{ ('END :') }}</strong></label>--}}
{{--                <input class="form-control" id="end_at" type="datetime-local" name="end_at" value="{{ old('start_at') }}">--}}
{{--                @error('end_at')--}}
{{--                <strong style="color: #FF3636; padding-left: 18px;"> *{{ $message }}</strong>--}}
{{--                @enderror--}}
{{--            </div>--}}
{{--            <div class="col-md-4">--}}
{{--                <label><strong>{{ ('Image :') }}</strong></label>--}}
{{--                <input class="form-control" id="image" type="file" accept=".jpg" name="image"  value="{{ old('cover_image') }}">--}}
{{--                @error('image')--}}
{{--                <strong style="color: #FF3636; padding-left: 18px;"> *{{ $message }}</strong>--}}
{{--                @enderror--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <button type="submit" class="btn btn-primary">ADD EVENT</button>--}}
{{--    </form>--}}
{{--</div>--}}




{{--add new post for group members & not blocked--}}
{{--@if(in_array(Auth::user()->id, $members_ids_in_the_group) and !$is_blocked)--}}
    {{--add new post--}}
<a class="popup-with-form dropdown-item" href="#edit-form">Edit</a>

<div class="card-body mfp-hide white-popup-block"
     id="edit-form"
     style="background-color: #f0f0f0; width: 40%; float: right; bottom:0;">
    <div class="card-header">
        <strong class="title">dis title</strong>
    </div>
    <div class="card-body">
        {{--add new post for group members & not blocked--}}
        <div class="form-row">

            <div class="form-group col-md-12">
                <label><strong>{{ ('Message :') }}</strong></label>
                @foreach($discussions_messages as $discussion_messages)
                    @if($discussion->id == $discussion_messages->id)
                        @foreach($discussion_messages->discussion_messages as $discussion_message)
                            <div style="padding-top: 0px;" class="card-header card-header-warning">
                                <img class="card-img-top" src="{{asset('bug_life.jpg')}}"
                                     style="width: 30px;" alt="Card image cap">
                                <a href="{{ route('user.show',$discussion_message->user) }}"> {{$discussion_message->first_name}}</a>
                                <label style="border:1px solid black"> comment text: {{$discussion_message->pivot->text}} </label>
                                @endforeach
                    @endif
                @endforeach
{{--        @foreach($comments as $comment)--}}
{{--            @if($post->id == $comment->post_comments['0']->id)--}}
{{--                <div style="padding-top: 0px;" class="card-header card-header-warning">--}}
{{--                    <img class="card-img-top" src="{{asset('bug_life.jpg')}}"--}}
{{--                         style="width: 30px;" alt="Card image cap">--}}
{{--                    <a href="{{ route('user.show',$comment->user) }}"> {{$comment->user->first_name}}</a>--}}
{{--                    @endif--}}
{{--                    @endforeach--}}
                </div>
            </div>

        <form method="POST" action="">
            @csrf
            <input type="hidden" id="user_id" name="user_id" value={{Auth::user()->id}}>

               <div class="form-row">
                <div class="form-group col-md-12">
                    <label><strong>{{ ('Message :') }}</strong></label>
                    <textarea class="form-control" id="text" type="text" name="text" rows="2"
                              value="{{ old('text') }}"></textarea>
                    @error('text')
                    <strong style="color: #FF3636; padding-left: 18px;">
                        *{{ $message }}</strong>
                    @enderror
                </div>

            </div>

            <div>
                <button type="submit" class="btn btn-primary">{{ ('SEND') }}</button>
            </div>

        </form>
    </div>
    </div>
{{--@endif--}}
{{--end of add new post--}}





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

{{--<script src="{{asset('/assets/js/core/jquery.min.js')}}"></script>--}}
<script src="{{asset('/assets/js/core/popper.min.js')}}"></script>
<script src="{{asset('/assets/js/core/bootstrap.min.js')}}"></script>
{{--<script src="{{asset('/assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>--}}
<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!-- Chart JS -->
<script src="{{asset('/assets/js/plugins/chartjs.min.js')}}"></script>
<!--  Notifications Plugin    -->
<script src="{{asset('/assets/js/plugins/bootstrap-notify.js')}}"></script>
<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
{{--<script src="{{asset('/assets/js/now-ui-dashboard.min.js?v=1.5.0')}}" type="text/javascript"></script>--}}
<!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
<script src="{{asset('/assets/demo/demo.js')}}"></script>


















{{--<form>--}}
{{--    <div class="form-row">--}}
{{--        <div class="col">--}}
{{--            <input type="text" class="form-control" placeholder="First name">--}}
{{--        </div>--}}
{{--        <div class="col col-md-2">--}}
{{--            <div>--}}
{{--            <label>{{ ('POST TYPE') }}</label>--}}
{{--            <select name="type" class="form-control type">--}}
{{--                <option disabled selected hidden value=""> select a type</option>--}}
{{--                <option value="review">Review</option>--}}
{{--                <option value="summary">Summary</option>--}}
{{--                <option value="quotation">Quotation</option>--}}
{{--                <option value="other">Other</option>--}}
{{--            </select>--}}
{{--            @error('type') <span class="invalid-feedback"--}}
{{--                                 role="alert"> <strong>{{ $message }}</strong> </span>--}}
{{--            @enderror--}}
{{--            </div>--}}

{{--            <br>--}}
{{--            <input type="text" class="form-control" placeholder="book">--}}

{{--        </div>--}}
{{--        <div class="col col-md-2">--}}
{{--            <input type="text" class="form-control" placeholder="status">--}}
{{--            <br>--}}
{{--            <input type="text" class="form-control" placeholder="author">--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</form>--}}
{{--<script type="text/javascript">--}}
{{--    $(document).ready(function () {--}}

{{--        $(".books").chosen({width: "250px",--}}
{{--            html_template: '{text} <img style="border:3px solid #ff703d;padding:0px;margin-right:4px"  class="{books}" src="asset(\'Image-Select-master/img/adnan.png\')" />'});--}}

{{--    });--}}
{{--</script>--}}


