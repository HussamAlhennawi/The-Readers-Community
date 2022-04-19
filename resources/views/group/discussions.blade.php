<head>
    <!-- Magnific Popup core CSS file -->
    <link rel="stylesheet" href="{{asset('css/magnific-popup/magnific-popup.css')}}">
    <!-- jQuery 1.7.2+ or Zepto.js 1.0+ -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <!-- Magnific Popup core JS file -->
    <script src="{{asset('js/magnific-popup/jquery.magnific-popup.js')}}"></script>
</head>

{{$group->title}}
<hr>

{{--create new discussion--}}
<form method="POST" action="{{ route('group.discussion.store', $group) }}">
    @csrf
    <input type="hidden" id="user_id" name="user_id" value={{Auth::user()->id}}>
    <div>
        <label>{{ ('Discussion Title') }}</label>
        <input id="title" type="text" name="title" value="{{ old('title') }}" autofocus>
        @error('title')
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
        <button type="submit">
            {{ ('ADD') }}
        </button>
    </div>
</form>
<hr>
{{--show the group discussions--}}
@foreach($discussions as $discussion)
    <div style="border:1px solid black">
        <label style="border:1px solid black"> discussion title: {{$discussion->title}} </label>

        <a class="popup-modal" href="#members-modal{{$discussion->id}}">{{$discussion->join_num}} Members</a>
        <div id="members-modal{{$discussion->id}}" class="mfp-hide white-popup-block"
             style="border: #0b0b0b solid;width: 30%; margin: 0 auto;background-color: #c3c3c3">
            <h2>MEMBERS</h2>
            <p><a class="popup-modal-dismiss" href="#">Dismiss</a></p>
            @foreach($discussion->discussion_members as $discussion_member)
                <a href="{{ route('user.show',$discussion_member) }}"> {{$discussion_member->first_name}}</a>
            @endforeach
        </div>

        {{--check the array contains items for error--}}
        {{--to dispay join & unjoin button--}}
        @if($discussion->end_at > now())
            @if(@isset($discussions_ids_with_members[$discussion->id]))
                @if(in_array(Auth::user()->id, $discussions_ids_with_members[$discussion->id]))
                    <form method="POST" action="{{ route('group.discussion.join',[$group, $discussion]) }}">
                        @csrf
                        <div>
                            <button type="submit"> {{ ('UNJOIN') }} </button>
                        </div>
                    </form>
                @else
                    <form method="POST" action="{{ route('group.discussion.join',[$group, $discussion]) }}">
                        @csrf
                        <div>
                            <button type="submit"> {{ ('JOIN') }} </button>
                        </div>
                    </form>
                @endif
            @else
                <form method="POST" action="{{ route('group.discussion.join',[$group, $discussion]) }}">
                    @csrf
                    <div>
                        <button type="submit"> {{ ('JOIN') }} </button>
                    </div>
                </form>
            @endif
        @else
            <label>THIS discussion has ended</label>
        @endif




        {{--messages show for each discussion--}}
        @foreach($discussions_messages as $discussion_messages)
            @if($discussion->id == $discussion_messages->id)
                @foreach($discussion_messages->discussion_messages as $discussion_message)
                    <span> user : {{$discussion_message->first_name}} </span>
                    <label style="border:1px solid black"> comment text: {{$discussion_message->pivot->text}} </label>
                @endforeach
            @endif
        @endforeach

        {{--check if discussion is out of date--}}
        @if($discussion->end_at > now())
            {{--add message to the discussion--}}
            <form method="POST" action="{{ route('group.discussion.message', [$group, $discussion]) }}">
                @csrf
                <div>
                    <label>{{ ('Message') }}</label>
                    <input id="text" type="text" name="text" value="{{ old('text') }}">
                    @error('text')
                    <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                    @enderror
                </div>
                <div>
                    <button type="submit"> {{ ('SEND') }} </button>
                </div>
            </form>
        @endif

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
