<?php

namespace App\Http\Controllers;

use App\Book;
use App\discussion;
use App\Discussion_message;
use App\Group;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;

class DiscussionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Group $group
     * @param Book $book
     * @return \Illuminate\Http\Response
     */
    public function index(Group $group, Book $book)
    {
        // if discussions from group
        if ($group->id) {
            // discussions in this group
            $discussions = Discussion::whereHas('group_discussions', function (Builder $query) use ($group) {
                $query->where('group_id', '=', $group->id);
            })->get();

            //get discussions ids in this group as array of ids
            $discussions_ids_in_this_group = [];
            foreach ($discussions as $discussion) {
                $discussions_ids_in_this_group[] = $discussion->id;
            }



            $discussions_messages = Discussion::with('discussion_messages')
                ->whereIn('id', $discussions_ids_in_this_group)
                ->get();


            //            to display join & unjoin
            $discussions_ids_with_members = [];
            foreach ($discussions as $discussion)
                foreach ($discussion->discussion_members as $discussion_member) {
                    $discussions_ids_with_members[$discussion->id][] = $discussion_member->id;
            }


            return view('group.discussions', compact('group', 'discussions', 'discussions_messages', 'discussions_ids_with_members'));
        }

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
     * @param Book $book
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Group $group, Book $book)
    {
        $attributes = [
            'title' => 'EVENT\'S TITLE',
            'start_at' => 'START DATE',
            'end_at' => 'END DATE',
        ];

        $error_messages = [
            'title.required' => "THE :attribute IS REQUIRED",
            'title.max' => "THE :attribute MAY NOT BE GREATER THAN :max CHARACTERS",
            'start_at.required' => "THE :attribute IS REQUIRED",
            'end_at.required' => "THE :attribute IS REQUIRED",
            'end_at.after' => "THE :attribute MUST BE A DATE AFTER START DATE",
            'description.required' => 'THE :attribute ABOUT THIS GROUP IS REQUIRED',
        ];

        $request->validate([
            'title' => 'required|string|max:50',
            'start_at' => 'required|date|after_or_equal:now',
            'end_at' => 'required|date|after_or_equal:start_at',
        ], $error_messages, $attributes);

        if ($group->id) {
            $discussion = Discussion::create([
                'user_id' => $request['user_id'],
                'title' => $request['title'],
                'start_at' => $request['start_at'],
                'end_at' => $request['end_at'],
            ]);
            $discussion->group_discussions()->sync($group->id);

            $this->join($group, $book, $discussion);

            return redirect()->route('group.dis', $group);
        }
        if ($book->id) {
            $discussion = Discussion::create([
                'user_id' => $request['user_id'],
                'title' => $request['title'],
                'start_at' => $request['start_at'],
                'end_at' => $request['end_at'],
            ]);
            $discussion->book_discussions()->sync($book->id);

            $this->join($group, $book, $discussion);

            return redirect()->route('book.dis', $book);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param \App\discussion $discussion
     * @return \Illuminate\Http\Response
     */
    public function show(discussion $discussion)
    {
//        $my_id = Auth::id();
//
//        // Make read all unread message
////        Discussion_message::where(['user_id' => $user_id, 'to' => $discussion->id])->update(['is_read' => 1]);
//
//        // Get all message from selected user
//        $messages = Discussion_message::where('to', '=', $discussion->id)->get();
//
//        return view('messages.index', ['messages' => $messages]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\discussion $discussion
     * @return \Illuminate\Http\Response
     */
    public function edit(discussion $discussion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\discussion $discussion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, discussion $discussion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\discussion $discussion
     * @return \Illuminate\Http\Response
     */
    public function destroy(discussion $discussion)
    {
        //
    }

    public function join(Group $group, Book $book, Discussion $discussion)
    {

        $user_id = Auth::user()->id;
        $discussion = Discussion::find($discussion->id);
        $discussion->discussion_members()->toggle([$user_id]);

        $discussion_members = DB::table('discussion_members')
            ->where('discussion_id', '=', $discussion->id)
            ->count('user_id');

        Discussion::where('id', $discussion->id)
            ->update(['join_num' => $discussion_members]);

        if ($group->id) {
            return redirect()->route('group.discussion.index', $group);
        }

    }

    public function message(Request $request, Group $group, Book $book, Discussion $discussion)
    {

        $attributes = [
            'text' => 'DISCUSSION\'S MESSAGE',
        ];

        $error_messages = [
            'text.required' => "THE :attribute IS REQUIRED",
        ];

        $request->validate([
            'text' => 'required|string',
        ], $error_messages, $attributes);


        $user_id = Auth::user()->id;
        $discussion = Discussion::find($discussion->id);
//            $discussion->discussion_messages()->toggle([$user_id]);
        $discussion->discussion_messages()->attach ([$user_id => ['text' => $request['text']]]);

        if ($group->id) {
            return redirect()->route('group.discussion.index', $group);
        }

    }



    //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function group(Request $request, Group $group, Book $book)
    {
        $discussion_title = $request['discussion_title'];


        //discussions in this group
        $discussions = Discussion::whereHas('group_discussions', function (Builder $query) use ($group) {
            $query->where('group_id', '=', $group->id);
        })->when($discussion_title , function ($query,$discussion_title ){
            return $query->where('title' , 'like' , '%'.$discussion_title.'%');
        })->get();

        $active_members = DB::table('group_members')
            ->where('group_id', '=', $group->id)
            ->where('active', '=', 1)
            ->where('pending', '=', 0)
            ->select('user_id')->get();
        //blocked members ids in the group
        $active_members_ids_in_the_group = [];
        foreach ($active_members as $group_member) {
            $active_members_ids_in_the_group[] = $group_member->user_id;
        }

        return view('groupdis.home', ['discussions' => $discussions, 'group' => $group, 'active_members_ids_in_the_group'=> $active_members_ids_in_the_group]);
    }



    /**
     * Display the specified resource.
     *
//     * @param \App\discussion $discussion
     * @return \Illuminate\Http\Response
     */
    public function getMessage(Request $request)
    {
        $discussion_id = $request->discussion_id;
        $my_id = Auth::id();

        // Get all message from selected user
        $messages = Discussion_message::where('discussion_id', '=', $discussion_id)->get();
        $discussion = Discussion::find($discussion_id);
//dd($discussion->group_discussions['0']->id);
        $active_members = DB::table('group_members')
            ->where('group_id', '=', $discussion->group_discussions['0']->id)
            ->where('active', '=', 1)
            ->where('pending', '=', 0)
            ->select('user_id')->get();
        //blocked members ids in the group
        $active_members_ids_in_the_group = [];
        foreach ($active_members as $group_member) {
            $active_members_ids_in_the_group[] = $group_member->user_id;
        }

        return view('groupdis.index', ['messages' => $messages, 'discussion' => $discussion, 'active_members_ids_in_the_group' => $active_members_ids_in_the_group]);
    }


    public function sendMessage(Request $request)
    {

        $user_id = Auth::user()->id;
        $discussion_id = $request['discussion_id'];
        $text = $request->message;

        $data = Discussion_message::create([
            'user_id' => $user_id,
            'discussion_id' => $request['discussion_id'],
            'text' => $request['message'],
        ]);

        // to add user to discussion members
        $discussion = Discussion::find($discussion_id);
        $discussion->discussion_members()->sync([$user_id]);


        // pusher
        $options = array(
            'cluster' => 'ap2',
            'useTLS' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $data = ['user_id' => $user_id, 'discussion_id' => $discussion_id]; // sending from and to user id when pressed enter

        $pusher->trigger('my-channel', 'my-event', $data);
    }


    //++++++++++++++++++++++++++++++booooooooooook+++++++++++++++++++++++++++++++++++++++++
    public function book(Request $request, Group $group, Book $book)
    {
        $discussion_title = $request['discussion_title'];

        //discussions in this book
        $discussions = Discussion::whereHas('book_discussions', function (Builder $query) use ($book) {
            $query->where('book_id', '=', $book->id);
        })->when($discussion_title , function ($query,$discussion_title ){
            return $query->where('title' , 'like' , '%'.$discussion_title.'%');
        })->get();

        return view('bookdis.home', ['discussions' => $discussions, 'book' => $book]);
    }



    /**
     * Display the specified resource.
     *
    //     * @param \App\discussion $discussion
     * @return \Illuminate\Http\Response
     */
    public function getbookMessage(Request $request)
    {
        $discussion_id = $request->discussion_id;
        $my_id = Auth::id();

//        dd('hus');
        // Get all message from selected user
        $messages = Discussion_message::where('discussion_id', '=', $discussion_id)->get();
        $discussion = Discussion::find($discussion_id);

        return view('bookdis.index', ['messages' => $messages, 'discussion' => $discussion]);
    }


    public function sendbookMessage(Request $request)
    {

        $user_id = Auth::user()->id;
        $discussion_id = $request['discussion_id'];
        $text = $request->message;

        $data = Discussion_message::create([
            'user_id' => $user_id,
            'discussion_id' => $request['discussion_id'],
            'text' => $request['message'],
        ]);

        // to add user to discussion members
        $discussion = Discussion::find($discussion_id);
        $discussion->discussion_members()->sync([$user_id]);


        // pusher
        $options = array(
            'cluster' => 'ap2',
            'useTLS' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $data = ['user_id' => $user_id, 'discussion_id' => $discussion_id]; // sending from and to user id when pressed enter

        $pusher->trigger('my-channel', 'my-event', $data);
    }

}
