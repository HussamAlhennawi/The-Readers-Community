<head>
    <!-- Magnific Popup core CSS file -->
    <link rel="stylesheet" href="{{asset('css/magnific-popup/magnific-popup.css')}}">
    <!-- jQuery 1.7.2+ or Zepto.js 1.0+ -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <!-- Magnific Popup core JS file -->
    <script src="{{asset('js/magnific-popup/jquery.magnific-popup.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/all.css')}}">
</head>

<label>{{ $group->title }}</label>
{{--check if user is blocked from this group dont dispaly join--}}
<?php
$is_blocked = DB::table('group_members')
    ->where('group_id', '=', $group->id)
    ->where('user_id', '=', Auth::user()->id)
    ->where('active', '=', 0)
    ->first();
?>

{{--join the group--}}
@if(!(Auth::user()->id == $group->user_id)) {{--to hide jion & unjoin from admin of group--}}
    @if($is_blocked) {{--to check if user blocked from group don't display join & unjoin--}}
        <div></div>
    @else
        @if(in_array(Auth::user()->id, $members_ids_in_the_group))
            <form method="POST" action="{{ route('group.join',$group) }}">
                @csrf
                <div>
                    <button type="submit"> {{ ('UNJOIN') }} </button>
                </div>
            </form>
        @else
            <form method="POST" action="{{ route('group.join',$group) }}">
                @csrf
                <div>
                    <button type="submit"> {{ ('JOIN') }} </button>
                </div>
            </form>
        @endif
    @endif
@endif
<div></div>

{{--num of members & posts & events & discussions--}}
<span class="fa fa-user-circle fa-2x"> {{$group->members_num}} members in this group</span><br>
<span class="fa fa-clipboard fa-2x"> {{$posts_num}} posts in this group</span><br>
<span class="fa fa-calendar fa-2x"> {{$events_num}} events in this group</span><br>
<span class="fa fa-bullhorn fa-2x"> {{$discussions_num}} discussions in this group</span><br>


{{--popup members shown for members only--}}
@if(in_array(Auth::user()->id, $members_ids_in_the_group))
    <a class="popup-modal" href="#members-modal">Members</a>
        <div id="members-modal" class="mfp-hide white-popup-block"
             style="border: #0b0b0b solid;width: 30%; margin: 0 auto;background-color: #FFFFFF">
            <h2 style="text-align:center">GROUP MEMBERS</h2>
            <i style="float: right" class="popup-modal-dismiss fa fa-times-circle fa-2x" aria-hidden="true"></i>
            <div>
                @foreach($group->group_members as $group_member)
                    <div><a href="{{ route('user.show',$group_member) }}"> {{$group_member->first_name}}</a>
                        {{--delete member--}}
                        <form method="POST" action="{{ route('group.deletemember', [$group, $group_member]) }}">
                            @csrf
                            <div>
                                <button class="fa fa-trash fa-lg" type="submit"></button>
                            </div>
                        </form>
                    </div>
                    {{--                <a href="#" class="fa fa-trash fa-lg" aria-hidden="true"></a>--}}
                @endforeach
            </div>
        </div>
        @endif


        <hr>


        <a href= {{ route('group.posts',$group)}} >POSTS FOR GROUP {{$group->title}}</a>
        <hr>
        {{--    display for public group or user jond the group--}}
        @if($group->privacy == 'public' or in_array(Auth::user()->id, $members_ids_in_the_group))
            <a href= {{ route('group.event.index',$group)}} >EVENTS FOR GROUP {{$group->title}}</a>
            <hr>
            <a href= {{ route('group.discussion.index',$group)}} >DISCUSSION FOR GROUP {{$group->title}}</a>
        @endif




        {{--script for group members popup--}}
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


