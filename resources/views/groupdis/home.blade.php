@extends('groupdis.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="user-wrapper">
                    <ul class="discussions" style="list-style: none; margin: 0; padding: 0;">
                        <br>
                        @foreach($discussions as $discussion)
                            <li class="discussion" id="{{ $discussion->id }}">
{{--                                will show unread count notification--}}
{{--                                @if($user->unread)--}}
{{--                                    <span class="pending">{{ $user->unread }}</span>--}}
{{--                                @endif--}}

                                <div class="media">
                                    <div class="media-left">
{{--                                        <img src="{{ $user->image }}" alt="" class="media-object">--}}
                                    </div>

                                    <div class="media-body">
                                        <p class="name">{{ $discussion->title }}</p>
{{--                                        <p class="email">{{ $user->email }}</p>--}}
                                    </div>
                                </div>
                            </li>
                            <hr>
                        @endforeach
                    </ul>
                </div>
            </div>

{{--            <div class="col-md-1">--}}
{{--                <a style="margin-left: 275px; margin-top: -90px" class="popup-with-form "--}}
{{--                   href="#members"><button class="btn btn-primary btn-round btn-outline-primary btn-sm">members</button></a>--}}
{{--            </div>--}}

            <div class="col-md-8" id="messages">



            </div>
        </div>
    </div>
@endsection
