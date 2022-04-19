<head>

    <!-- Magnific Popup core CSS file -->
    <link rel="stylesheet" href="{{asset('css/magnific-popup/magnific-popup.css')}}">
    <!-- jQuery 1.7.2+ or Zepto.js 1.0+ -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <!-- Magnific Popup core JS file -->
    <script src="{{asset('js/magnific-popup/jquery.magnific-popup.js')}}"></script>
</head>

{{--check if user is blocked from this group --}}
<?php
$is_blocked = DB::table('group_members')
    ->where('group_id', '=', $group->id)
    ->where('user_id', '=', Auth::user()->id)
    ->where('active', '=', 0)
    ->first();
?>

{{--create new event--}}
@if(in_array(Auth::user()->id, $members_ids_in_the_group) and !$is_blocked)
    <form method="POST" action="{{ route('group.event.store', $group) }}">
        @csrf
        <input type="hidden" id="user_id" name="user_id" value={{Auth::user()->id}}>
        <div>
            <label>{{ ('Event Title') }}</label>
            <input id="title" type="text" name="title" value="{{ old('title') }}" autofocus>
            @error('title')
            <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
            @enderror
        </div>

        <div>
            <label>{{ ('Event Location') }}</label>
            <input id="location" type="text" name="location" value="{{ old('location') }}" autofocus>
            @error('location')
            <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
            @enderror
        </div>

        <div>
            <label>{{ ('Start') }}</label>
            <input id="start_at" type="datetime-local" name="start_at" value="{{ old('start_at') }}" autofocus>
            @error('start_at')
            <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
            @enderror
        </div>

        <div>
            <label>{{ ('End') }}</label>
            <input id="end_at" type="datetime-local" name="end_at" value="{{ old('end_at') }}" autofocus>
            @error('end_at')
            <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
            @enderror
        </div>

        <div>
            <label>{{ ('Details') }}</label>
            <input id="description" type="text" name="description" value="{{ old('description') }}">
            @error('description')
            <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
            @enderror
        </div>

        <div>
            <label>{{ ('Image') }}</label>
            <input id="image" type="file" accept=".jpg" name="image" value="{{ old('image') }}">
            @error('image')
            <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
            @enderror
        </div>

        <div>
            <button type="submit">
                {{ ('ADD') }}
            </button>
        </div>
    </form>
    <hr>
@endif

{{--display events in the group--}}
@foreach($events as $event )
    <div style="border:1px solid black">
        <label style="border:1px solid black"> EVENT TITLE: {{$event->title}} </label><br>

        {{--event members--}}
        <a class="popup-modal" href="#members-modal{{$event->id}}">{{$event->going_num}} Members</a> <br>
        <div id="members-modal{{$event->id}}" class="mfp-hide white-popup-block"
             style="border: #0b0b0b solid;width: 30%; margin: 0 auto;background-color: #c3c3c3">
            <h2>MEMBERS</h2>
            <p><a class="popup-modal-dismiss" href="#">Dismiss</a></p>
            @foreach($event->event_members as $event_member)
                <a href="{{ route('user.show',$event_member) }}"> {{$event_member->first_name}}</a>
            @endforeach
        </div>




        {{--to dispaly going & not going --}}
        @if(!(Auth::user()->id == $event->user_id)) {{--if authenticated user create this event don't display going--}}
            @if($event->end_at > now())
                @if(in_array(Auth::user()->id, $members_ids_in_the_group) and !$is_blocked) {{--if user is member in the group and not blocked--}}
                    @if(in_array(Auth::user()->id, $events_ids_with_members[$event->id])) {{--if user is going already to the event--}}
                        <form method="POST" action="{{ route('event.going',[$group, $event]) }}">
                            @csrf
                            <div>
                                <button type="submit"> {{ ('NOT GOING') }} </button>
                            </div>
                        </form>
                    @else
                        <form method="POST" action="{{ route('event.going',[$group, $event]) }}">
                            @csrf
                            <div>
                                <button type="submit"> {{ ('GOING') }} </button>
                            </div>
                        </form>
                    @endif
                @endif
            @else
                <label>THIS event has ended</label>
            @endif
        @endif



        {{--comments show for each event--}}
        @foreach($comments as $comment)
            @if($event->id == $comment->event_comments['0']->id)
                <label style="border:1px solid black"> comment text: {{$comment->text}} </label>
            @endif
        @endforeach

        {{--add coment to the event--}}
        @if(in_array(Auth::user()->id, $members_ids_in_the_group) and !$is_blocked)
        <form method="POST" action="{{ route('event.comment', $event) }}">
            @csrf
            <div>
                <label>{{ ('text') }}</label>
                <input id="text" type="text" name="text" value="{{ old('text') }}">
                @error('text')
                <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                @enderror
            </div>
            <div>
                <button type="submit"> {{ ('COMMENT') }} </button>
            </div>
        </form>
        @endif
    </div>
@endforeach


{{--script for members popup--}}
<script>
    $(function () {
        $('.popup-modal').magnificPopup({
            type: 'inline',
            preloader: false,
            focus: '#username',
            modal: true
        });
        $(document).on('click', '.popup-modal-dismiss', function (e) {
            e.preventDefault();
            $.magnificPopup.close();
        });
    });
</script>
