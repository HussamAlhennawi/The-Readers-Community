<?php

namespace App\Http\Controllers;

use App\Comment;
use App\event;
use App\Group;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Group $group
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Group $group , Request $request)
    {
        //number of posts in this group
        $posts_num = DB::table('group_posts')
            ->where('group_id', '=', $group->id)
            ->count('post_id');
        //number of events in this group
        $events_num = DB::table('group_events')
            ->where('group_id', '=', $group->id)
            ->count('event_id');
        //number of discussions in this group
        $discussions_num = DB::table('group_discussions')
            ->where('group_id', '=', $group->id)
            ->count('discussion_id');

        // events in this group
        $event_title = $request['event_title'];
        $events = Event::whereHas('group_events', function (Builder $query) use($group){
            $query->where('group_id', '=', $group->id)
                  ->where('group_events.active', '=', 1);
        })->when($event_title , function ($query,$event_title ){
        return $query->where('title' , 'like' , '%'.$event_title.'%');
    })->orderBy('created_at', 'desc')
            ->get();

        //get events ids in this group as array of ids
        $events_ids_in_this_group = [];
        foreach($events as $event)
        {
            $events_ids_in_this_group[] = $event->id;
        }

        // get the total number of members going to each event
        $events_members = Event::whereIn('id', $events_ids_in_this_group)
            ->where('going_num', '>', 0)
            ->select('id', 'going_num')
            ->get()->toArray();

        //get the comments to the events in this group
        $comments = Comment::with('event_comments')->whereHas('event_comments', function (Builder $query) use($events_ids_in_this_group){
            $query->whereIn('event_id', $events_ids_in_this_group)
                ->where('event_comments.active', '=', 1);
        })->orderBy('created_at', 'desc')
            ->get();

        $members_ids_in_the_group = [];
        foreach ($group->group_members as $group_member) {
            $members_ids_in_the_group[] = $group_member->id;
        }

        //active members in the group
        $active_members = DB::table('group_members')
            ->where('group_id', '=', $group->id)
            ->where('active', '=', 1)
            ->where('pending', '=', 0)
            ->select('user_id')->get();
        //active members ids in the group
        $active_members_ids_in_the_group = [];
        foreach ($active_members as $group_member) {
            $active_members_ids_in_the_group[] = $group_member->user_id;
        }

//        dd($members_ids_in_the_group);

        $events_ids_with_members = [];
        foreach ($events as $event)
            foreach ($event->event_members as $event_member) {
                $events_ids_with_members[$event->id][] = $event_member->id;
            }

//        dd($events_ids_with_members);

        return view('group.events', compact('posts_num', 'events_num', 'discussions_num', 'events', 'group', 'events_members', 'comments', 'members_ids_in_the_group', 'active_members_ids_in_the_group', 'events_ids_with_members'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Group $group
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Group $group)
    {
        $attributes = [
            'title' => 'EVENT\'S TITLE',
            'location' => 'LOCATION',
            'start_at' => 'START DATE',
            'end_at' => 'END DATE',
            'description' => 'DESCRIPTION',
            'image' => 'EVENT\'S IMAGE',
        ];

        $error_messages = [
            'title.required' => "THE :attribute IS REQUIRED",
            'title.max' => "THE :attribute MAY NOT BE GREATER THAN :max CHARACTERS",
            'location.required' => "THE :attribute IS REQUIRED",
            'start_at.required' => "THE :attribute IS REQUIRED",
            'end_at.required' => "THE :attribute IS REQUIRED",
            'end_at.after' => "THE :attribute MUST BE A DATE AFTER START DATE",
            'description.required' => 'THE :attribute ABOUT THIS GROUP IS REQUIRED',
            'privacy.required' => 'THE :attribute IS REQUIRED',
            'privacy.in' => 'THE :attribute IS INVALID',
        ];

        $request->validate([
            'title' => 'required|string|max:50',
            'location' => 'required|string|max:200',
            'start_at' => 'required|date',
            'end_at' => 'required|date|after:start_at',
            'description' => 'required|string',
        ], $error_messages, $attributes);

        $event = Event::create([
            'user_id' => $request['user_id'],
            'title' => $request['title'],
            'location' => $request['location'],
            'start_at' => $request['start_at'],
            'end_at' => $request['end_at'],
            'description' => $request['description'],
        ]);
        $event->group_events()->sync($group->id);

        $this->going($group, $event);

        return redirect()->route('group.event.index',$group);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Group $group
     * @param \App\event $event
     * @return void
     */
    public function update(Request $request, Group $group, event $event)
    {

        $attributes = [
            'location' => 'LOCATION',
            'start_at' => 'START DATE',
            'end_at' => 'END DATE',
            'description' => 'DESCRIPTION',
            'image' => 'EVENT\'S IMAGE',
        ];

        $error_messages = [
            'location.required' => "THE :attribute IS REQUIRED",
            'start_at.required' => "THE :attribute IS REQUIRED",
            'end_at.required' => "THE :attribute IS REQUIRED",
            'end_at.after' => "THE :attribute MUST BE A DATE AFTER START DATE",
            'description.required' => 'THE :attribute ABOUT THIS GROUP IS REQUIRED',
            'privacy.required' => 'THE :attribute IS REQUIRED',
            'privacy.in' => 'THE :attribute IS INVALID',
        ];

        $request->validate([
            'location' => 'required|string|max:200',
            'start_at' => 'required|date',
            'end_at' => 'required|date|after:start_at',
            'description' => 'required|string',
        ], $error_messages, $attributes);

//        $up_event = Event::find($event->id);
        $event->location = $request['location'];
        $event->start_at = $request['start_at'];
        $event->end_at = $request['end_at'];
        $event->description = $request['description'];
        $event->save();


        return redirect()->route('group.event.index', $group);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Group $group
     * @param event $event
     * @return void
     */
    public function destroy(Group $group, event $event)
    {
        $delete_event = DB::table('group_events')
            ->where('event_id', '=', $event->id)
            ->update(['active' => 0]);

        return redirect()->route('group.event.index', $group);
    }

    public function going(Group $group, Event $event)
    {
        $user_id = Auth::user()->id;
        $event = Event::find($event->id);
        $event->event_members()->toggle([$user_id]);

        $events_members = DB::table('event_members')
            ->where('event_id', '=', $event->id)
            ->count('user_id');

        Event::where('id', $event->id)
            ->update(['going_num' => $events_members]);

        return redirect()->route('group.event.index',$group);
    }
}
