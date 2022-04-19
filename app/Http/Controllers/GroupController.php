<?php

namespace App\Http\Controllers;

use App\Author;
use App\Book;
use App\Comment;
use App\group;
use App\Post;
use App\Reaction;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $group_title = $request['group_title'];
        $groups = Group::when($group_title , function ($query,$group_title ){
            return $query->where('title' , 'like' , '%'.$group_title.'%');
        })->paginate(27);

//        group_title

        return view('group.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('group.cr');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = [
            'title' => 'GROUP\'S TITLE',
            'description' => 'DESCRIPTION',
            'privacy' => 'GROUP\'S PRIVACY',
            'image' => 'GROUP\'S COVER IMAGE',
        ];

        $error_messages = [
            'title.required' => "THE :attribute IS REQUIRED",
            'title.max' => "THE :attribute MAY NOT BE GREATER THAN :max CHARACTERS",
            'description.required' => 'THE :attribute ABOUT THIS GROUP IS REQUIRED',
            'privacy.required' => 'THE :attribute IS REQUIRED',
            'privacy.in' => 'THE :attribute IS INVALID',
        ];

        $request->validate([
            'title' => 'required|string|max:50',
            'description' => 'required|string',
            'privacy' => 'in:public,private',
            //            'cover_image' => 'mimes:jpeg,jpg,png',
        ], $error_messages, $attributes);

        $group = Group::create([
            'user_id' => $request['user_id'],
            'title' => $request['title'],
            'description' => $request['description'],
            'privacy' => $request['privacy'],
        ]);
//        to add user how create the group to the group_members table
        $this->join($group);
        $this->accept($request, $group, Auth::user());

        return redirect()->route('group.show', $group);

    }

    /**
     * Display the specified resource.
     *
     * @param \App\group $group
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(group $group, Request $request)
    {

        //number of events in this group
        $events_num = DB::table('group_events')
            ->where('group_id', '=', $group->id)
            ->count('event_id');

        //number of discussions in this group
        $discussions_num = DB::table('group_discussions')
            ->where('group_id', '=', $group->id)
            ->count('discussion_id');

        $blocked_members = DB::table('group_members')
            ->where('group_id', '=', $group->id)
            ->where('active', '=', 0)
            ->where('pending', '=', 0)
            ->select('user_id')->get();
        //blocked members ids in the group
        $blocked_members_ids_in_the_group = [];
        foreach ($blocked_members as $group_member) {
            $blocked_members_ids_in_the_group[] = $group_member->user_id;
        }

        $pending_members = DB::table('group_members')
            ->where('group_id', '=', $group->id)
            ->where('active', '=', 0)
            ->where('pending', '=', 1)
            ->select('user_id')->get();
        //blocked members ids in the group
        $pending_members_ids_in_the_group = [];
        foreach ($pending_members as $group_member) {
            $pending_members_ids_in_the_group[] = $group_member->user_id;
        }

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


        //members ids in the group
        $members_ids_in_the_group = [];
        foreach ($group->group_members as $group_member) {
            $members_ids_in_the_group[] = $group_member->id;
        }

//        dd($members_ids_in_the_group);

        //posts in the group
        $search_text = $request['search_text'];
        $posts = Post::whereHas('group_posts', function (Builder $query) use($group){
            $query->where('group_id', '=', $group->id)
                  ->where('group_posts.active', '=', 1);
        })->when($search_text , function ($query,$search_text ){
            return $query->where('text' , 'like' , '%'.$search_text.'%');
        })->orderBy('created_at', 'desc')
          ->get();





//        dd($posts['0']->group_posts);

        //get posts ids in this group as array of ids
        $posts_ids_in_this_group = [];
        foreach($posts as $post)
        {
            $posts_ids_in_this_group[] = $post->id;
        }

        // get the reactions name in the system
        $reactions = Reaction::all();

        // get number or each reaction type for each post in this group
        $posts_reactions = DB::table('post_reactions')
            ->whereIn('post_id', $posts_ids_in_this_group)
            ->select('post_id', 'reaction_id', DB::raw('COUNT(reaction_id) as total_reactions'))
            ->groupby(['post_id', 'reaction_id'])->get();

        // get user reactions on posts in this group
        $user_reactions = DB::table('post_reactions')
            ->whereIn('post_id', $posts_ids_in_this_group)
            ->where('user_id', '=', Auth::user()->id)
            ->select('post_id', 'reaction_id')
            ->get();

        //get the comments to the posts in this group
        $comments = Comment::with('post_comments')
            ->whereHas('post_comments', function (Builder $query) use($posts_ids_in_this_group){
            $query->whereIn('post_id', $posts_ids_in_this_group)
                  ->where('post_comments.active', '=', 1);
        })->orderBy('created_at', 'desc')
          ->get();

        $books = Book::all();
        $authors = Author::all();

        return view('group.posts',compact('group', 'events_num', 'discussions_num', 'blocked_members_ids_in_the_group', 'pending_members_ids_in_the_group', 'active_members_ids_in_the_group', 'members_ids_in_the_group', 'posts', 'posts_ids_in_this_group', 'reactions', 'posts_reactions', 'user_reactions', 'comments', 'books', 'authors'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(group $group)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, group $group)
    {
        $attributes = [
            'title' => 'GROUP\'S TITLE',
            'description' => 'DESCRIPTION',
            'privacy' => 'GROUP\'S PRIVACY',
            'image' => 'GROUP\'S COVER IMAGE',
        ];

        $error_messages = [
            'title.required' => "THE :attribute IS REQUIRED",
            'title.max' => "THE :attribute MAY NOT BE GREATER THAN :max CHARACTERS",
            'description.required' => 'THE :attribute ABOUT THIS GROUP IS REQUIRED',
            'privacy.required' => 'THE :attribute IS REQUIRED',
            'privacy.in' => 'THE :attribute IS INVALID',
        ];

        $request->validate([
            'title' => 'required|string|max:50',
            'description' => 'required|string',
            'privacy' => 'in:public,private',
            //            'cover_image' => 'mimes:jpeg,jpg,png',
        ], $error_messages, $attributes);

        $group->title = $request['title'];
        $group->description = $request['description'];
        $group->privacy = $request['privacy'];
//        $group->cover_image = $request['cover_image'];
        $group->save();

        return redirect()->route('group.show', $group);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(group $group)
    {
        //
    }

    public function join(Request $request, group $group)
    {
        if ($group->privacy == 'public'){
            $user_id = Auth::user()->id;
            $group->group_members()->toggle([$user_id]);
            $this->accept($request, $group, Auth::user());
        }

        else {
            $user_id = Auth::user()->id;
            $group->group_members()->toggle([$user_id]);

            // for notification
            $group->group_name = $group->title;
            $group->user_name = Auth::user()->full_name();
            $group->in = 'join';
            $group->in_id = $group->id;
//            $group->post_id = $post->id;

            $user = User::find($group->user_id);
            $user->notify(new \App\Notifications\NewJoin($group));
        }

        return redirect()->route('group.show', $group);
    }

    public function members(group $group)
    {
//        dd($group->group_members['1']->pivot);

        return view('group.members', compact('group'));

    }

    public function accept(Request $request, group $group, User $group_member)
    {
        $group->group_members()->updateExistingPivot($group_member, ['pending' => 0, 'active'=> 1]);

        // for notification
        $group->group_name = $group->title;
//        $group->user_name = Auth::user()->full_name();
        $group->in = 'accept';
        $group->in_id = $group->id;
//            $group->post_id = $post->id;

        $user = User::find($group_member->id);
        $user->notify(new \App\Notifications\NewAccept($group));

        $group_members = DB::table('group_members')
            ->where('group_id', '=', $group->id)
            ->where('active',  '=', 1)
            ->where('pending',  '=', 0)
            ->count('user_id');


        Group::where('id', $group->id)
            ->update(['members_num' => $group_members]);

        return redirect()->route('group.members', $group);
    }

    public function block(Request $request, group $group, User $group_member)
    {

        $group->group_members()->updateExistingPivot($group_member, ['active' => 0, 'pending' => 0]);

        return redirect()->route('group.members', $group);
    }

    public function unblock(Request $request, group $group, User $group_member)
    {

        $group->group_members()->updateExistingPivot($group_member, ['active' => 1, 'pending' => 0]);

        return redirect()->route('group.members', $group);
    }

}
