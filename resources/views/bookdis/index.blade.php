<div class="message-wrapper">
    <ul class="messages" style="list-style: none; margin: 0; padding: 0;">
        @foreach($messages as $message)
            <li class="message clearfix">
                {{--if message from id is equal to auth id then it is sent by logged in user --}}
                <div class="{{ ($message->user_id == Auth::id()) ? 'sent' : 'received' }}">
                    @if(Auth::user()->id == $message->user_id)
                        <center><a style="font-weight: bold; color: #3a3e42" href="{{ route('user.show',$message->user) }}">{{$message->user->full_name()}}</a></center>
                    @else
                        <center><a style="font-weight: bold;" href="{{ route("users.posts",$message->user)}}">{{$message->user->full_name()}}</a></center>
                            @endif
                    <p>{{ $message->text }}</p>
                    <p class="date">{{ date('d M y, h:i a', strtotime($message->created_at)) }}</p>
                </div>
            </li>
        @endforeach
    </ul>
</div>

@if($discussion->end_at > now() AND $discussion->start_at < now())
<div class="input-text">
    <input type="text" name="message" class="submit">
</div>
@elseif($discussion->start_at > now())
    <div class="input-text" style="font-size: large; margin-top: 25px; font-weight: bold;">
        <center><label>THIS DISCUSSION HAS STARTED YET, UNTIL {{date('d M y, h:i a', strtotime($discussion->start_at))}}</label></center>
    </div>
@else
    <div class="input-text" style="font-size: large; margin-top: 25px; font-weight: bold;">
    <center><label>THIS DISCUSSION HAS ENDED</label></center>
    </div>
@endif
