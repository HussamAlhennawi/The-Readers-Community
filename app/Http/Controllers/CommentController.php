<?php

namespace App\Http\Controllers;

use App\Book;
use App\comment;
use App\Event;
use App\Group;
use App\Post;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param Post $post
     * @return void
     */
    public function store(Request $request, Post $post)
    {

//        if ($request['from_user'] == 1) {
//        dd($request);
            $user_id = Auth::user()->id;

            $attributes = [
                'text' => 'COMMENT',
            ];

            $error_messages = [
                'text.required' => "THE :attribute IS REQUIRED",
            ];

            $request->validate([
                'text' => 'required|string',
            ], $error_messages, $attributes);


            $comment = Comment::create([
                'user_id' => $user_id,
                'text' => $request['text'],
            ]);

            $comment->post_comments()->sync($post->id);


        //posts in the group
        $postt = Post::find($post->id);
//        dd($postt);
        if ($postt->post_lists()->exists()) {
            $comment->in = 'profile';
            $comment->post_id = $postt->id;
//            $comment->in_id = $postt->user_id;
        }
//        dd($postt->post_lists['0']->pivot->listas_id);


        if ($postt->book_posts()->exists()) {
            $comment->in = 'book';
            $comment->in_id = $postt->book_posts['0']->pivot->book_id;
            $comment->post_id = $postt->id;
        }
        if ($postt->group_posts()->exists()) {
//            dd($postt);
            $comment->in = 'group';
            $comment->in_id = $postt->group_posts['0']->pivot->group_id;
            $comment->post_id = $postt->id;
        }



//        dd($postt);


        $comment->user_name = User::findOrFail($user_id)->full_name();
        // for notification
        $user = User::find($user_id);
        $user->notify(new \App\Notifications\NewComment($comment));

//        //to pass group parameters for redirect
//        $post_id = $post->id;
//        $post = Post::whereHas('group_events', function (Builder $query) use($event_id){
//            $query->where('event_id', '=', $event_id);
//        })->first();

//        return redirect()->route('group.event.index',$group);
//        }
    }

    public function add(Request $request)
    {

        $user_id = Auth::user()->id;

        $attributes = [
            'text' => 'COMMENT',
        ];

        $error_messages = [
            'text.required' => "THE :attribute IS REQUIRED",
        ];

        $request->validate([
            'text' => 'required|string',
        ], $error_messages, $attributes);


        $comment = Comment::create([
            'user_id' => $user_id,
            'text' => $request['text'],
        ]);

        if ($request['post_id']) {
            $comment->post_comments()->sync($request['post_id']);

            // for notification and ajax
            $comment->user_name = User::find($user_id)->full_name();

            //for notification
            $post = Post::find($request['post_id']);

            // for no notification if the post owner comment on his post
            if($post->user_id != $user_id){

                if ($post->post_lists()->exists()) {
                    $comment->in = 'profile';
                    $comment->post_id = $post->id;
                }

                if ($post->book_posts()->exists()) {
                    $comment->in = 'book';
                    $comment->in_id = $post->book_posts['0']->pivot->book_id;
                    $comment->post_id = $post->id;
                }
                if ($post->group_posts()->exists()) {
                    $comment->in = 'group';
                    $comment->in_id = $post->group_posts['0']->pivot->group_id;
                    $comment->post_id = $post->id;
                }
                // notify
                $user = User::find($user_id);
                $user->notify(new \App\Notifications\NewComment($comment));
            }

            // for ajax
            return $comment;
        }

        if ($request['event_id']) {
            $comment->event_comments()->sync($request['event_id']);

            // for ajax
            $comment->user_name = User::find($user_id)->full_name();

            // for ajax
            return $comment;
        }




    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Post $post
     * @param Event $event
     * @param \App\comment $comment
     * @return void
     */
    public function destroy(Request $request, Post $post, Event $event, comment $comment)
    {

        if ($post->id) {
            $delete_comment = DB::table('post_comments')
                ->where('comment_id', '=', $comment->id)
                ->update(['active' => 0]);
            if ($request['from_user_profile']) {
                return redirect()->route('user.show', Auth::user());
            }
            if ($request['from_group']) {
                $group = Group::find($request['group_id']);
                return redirect()->route('group.show', $group);
            }
            if ($request['from_book']) {
                $book = Book::find($request['book_id']);
                return redirect()->route('book.show', $book);
            }
            if ($request['from_users']) {
                $user = User::find($post->user_id);
                return redirect()->route('users.posts', $user);
            }
        }

        if ($event->id) {
            $delete_comment = DB::table('event_comments')
                ->where('comment_id', '=', $comment->id)
                ->update(['active' => 0]);

            $group = Group::find($request['group_id']);
            return redirect()->route('group.event.index', $group);

        }

    }

//    public function post(Request $request, Post $post)
//    {
////        echo $request;
////        dd($request);
//        $user_id = Auth::user()->id;
//
//        $attributes = [
//            'text'.$post->id => 'COMMENT',
//        ];
//
//        $error_messages = [
//            'text'.$post->id.'.required' => "THE :attribute IS REQUIRED",
//        ];
////        dd($error_messages);
//
//        $request->validate([
//            'text'.$post->id => 'required|string',
//        ], $error_messages, $attributes);
//
//
//        $comment = Comment::create([
//            'user_id' => $user_id,
//            'text' => $request['text'.$post->id],
//        ]);
//
//        $comment->post_comments()->sync($post->id);
//
////        //to pass group parameters for redirect
////        $post_id = $post->id;
////        $post = Post::whereHas('group_events', function (Builder $query) use($event_id){
////            $query->where('event_id', '=', $event_id);
////        })->first();
//
////        return redirect()->route('group.event.index',$group);
//    }

    public function event(Request $request, Event $event)
    {


        $user_id = Auth::user()->id;
        $attributes = [
            'text' => 'COMMENT',
        ];

        $error_messages = [
            'text.required' => "THE :attribute IS REQUIRED",
        ];

        $request->validate([
            'text' => 'required|string',
        ], $error_messages, $attributes);

        $comment = Comment::create([
            'user_id' => $user_id,
            'text' => $request['text'],
        ]);
        $comment->event_comments()->sync($event->id);

        //to pass group parameters for redirect
        $event_id = $event->id;
        $group = Group::whereHas('group_events', function (Builder $query) use ($event_id) {
            $query->where('event_id', '=', $event_id);
        })->first();

        return redirect()->route('group.event.index', $group);
    }


}
