<?php

namespace App\Http\Controllers;

use App\Author;
use App\Book;
use App\Comment;
use App\Group;
use App\post;
use App\Reaction;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Boolean;
use PhpParser\Node\Scalar\String_;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Group $group
     * @return void
     */
    public function index(Group $group)
    {


    }

    /**
     * Display a listing of the resource.
     *
     * @param Group $group
     * @return void
     */

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
     * @param User $user
     * @param Group $group
     * @param Book $book
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user, Group $group, Book $book)
    {

        if($user->id){
            $user = Auth::user();

            $attributes = [
                'type' => 'POST\'S TYPE',
                'status' => 'STATUES',
                'books' => 'BOOK TITLE',
                'authors' => 'AUTHOR NAME',
                'post_list' => 'LIST NAME',
                'text' => 'TEXT',
            ];

            $error_messages = [
                'type.in' => 'THE :attribute IS INVALID',
                'status.in' => 'THE :attribute IS INVALID',
                'books.exists' => 'THE :attribute IS INVALID',
                'authors.exists' => 'THE :attribute IS INVALID',
                'post_list.exists' => 'THE :attribute IS INVALID',
                'text.required' => 'THE :attribute OF THIS POST IS REQUIRED',
            ];

            $request->validate([
                'type' => 'in:review,summary,quotation,other',
                'status' => 'in:read,want to read,reading',
                'books' => 'exists:books,id',
                'authors' => 'exists:authors,id',
                'post_list' => 'exists:listas,id',
                'text' => 'required|string',
            ], $error_messages, $attributes);

            $post = Post::create([
                'user_id' => $request['user_id'],
                'type' => $request['type'],
                'status' => $request['status'],
                'text' => $request['text'],
            ]);
            $post->post_related_to_book()->sync($request['books']);
            $post->post_related_to_author()->sync($request['authors']);
            $post->post_lists()->sync($request['post_list']);

            return redirect()->route('user.show', $user);
        }

        if($group->id){

            $attributes = [
                'type' => 'POST\'S TYPE',
                'status' => 'STATUES',
                'books' => 'BOOK TITLE',
                'authors' => 'AUTHOR NAME',
                'text' => 'TEXT',
            ];

            $error_messages = [
                'type.in' => 'THE :attribute IS INVALID',
                'status.in' => 'THE :attribute IS INVALID',
                'books.exists' => 'THE :attribute IS INVALID',
                'authors.exists' => 'THE :attribute IS INVALID',
                'text.required' => 'THE :attribute OF THIS POST IS REQUIRED',
            ];

            $request->validate([
                'type' => 'in:review,summary,quotation,other',
                'status' => 'in:read,want to read,reading',
                'books' => 'exists:books,id',
                'authors' => 'exists:authors,id',
                'text' => 'required|string',
            ], $error_messages, $attributes);

            $post = Post::create([
                'user_id' => $request['user_id'],
                'type' => $request['type'],
                'status' => $request['status'],
                'text' => $request['text'],
            ]);
            $post->post_related_to_book()->sync($request['books']);
            $post->post_related_to_author()->sync($request['authors']);
            $post->group_posts()->sync($group->id);

//            dd($post->user->full_name());
            // for notification
            $post->group_name = $group->title;
            $post->user_name = $post->user->full_name();
            $post->in = 'group';
            $post->in_id = $group->id;
            $post->post_id = $post->id;

            $user = User::find($group->user_id);
            $user->notify(new \App\Notifications\NewPost($post));


            return redirect()->route('group.show', $group);

        }

        if($book->id){

            $attributes = [
                'type' => 'POST\'S TYPE',
                'status' => 'STATUES',
                'text' => 'TEXT',
            ];

            $error_messages = [
                'type.in' => 'THE :attribute IS INVALID',
                'status.in' => 'THE :attribute IS INVALID',
                'text.required' => 'THE :attribute OF THIS POST IS REQUIRED',
            ];

            $request->validate([
                'type' => 'in:review,summary,quotation,other',
                'status' => 'in:read,want to read,reading',
                'text' => 'required|string',
            ], $error_messages, $attributes);

//            dd(validate().$error);

            $post = Post::create([
                'user_id' => $request['user_id'],
                'type' => $request['type'],
                'status' => $request['status'],
                'text' => $request['text'],
            ]);

            $post->book_posts()->sync($book->id);
//            dd($post);
            return redirect()->route('book.show', $book);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(post $post)
    {
        dd("hussam");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Group $group
     * @param User $user
     * @param Book $book
     * @param post $post
     * @return void
     */
    public function update(Request $request, User $user, Group $group, Book $book, Post $post)
    {
        if ($user->id){
            $attributes = [
                'type' => 'POST\'S TYPE',
                'status' => 'STATUES',
                'books' => 'BOOK TITLE',
                'authors' => 'AUTHOR NAME',
                'post_list' => 'LIST NAME',
                'text' => 'TEXT',
            ];

            $error_messages = [
                'type.in' => 'THE :attribute IS INVALID',
                'status.in' => 'THE :attribute IS INVALID',
                'books.exists' => 'THE :attribute IS INVALID',
                'authors.exists' => 'THE :attribute IS INVALID',
                'post_list.exists' => 'THE :attribute IS INVALID',
                'text.required' => 'THE :attribute OF THIS POST IS REQUIRED',
            ];

            $request->validate([
                'type' => 'in:review,summary,quotation,other',
                'status' => 'in:read,want to read,reading',
                'books' => 'exists:books,id',
                'authors' => 'exists:authors,id',
                'post_list' => 'exists:listas,id',
                'text' => 'required|string',
            ], $error_messages, $attributes);

            $up_post = Post::find($post->id);
            $up_post->type = $request['type'];
            $up_post->status = $request['status'];
            $up_post->text = $request['text'];
            $up_post->save();

            $post->post_related_to_book()->sync($request['books']);
            $post->post_related_to_author()->sync($request['authors']);
            $post->post_lists()->sync($request['post_list']);

            return redirect()->route('user.show', $user);
        }

        if ($group->id){
            $attributes = [
                'type' => 'POST\'S TYPE',
                'status' => 'STATUES',
                'books' => 'BOOK TITLE',
                'authors' => 'AUTHOR NAME',
                'text' => 'TEXT',
            ];

            $error_messages = [
                'type.in' => 'THE :attribute IS INVALID',
                'status.in' => 'THE :attribute IS INVALID',
                'books.exists' => 'THE :attribute IS INVALID',
                'authors.exists' => 'THE :attribute IS INVALID',
                'text.required' => 'THE :attribute OF THIS POST IS REQUIRED',
            ];

            $request->validate([
                'type' => 'in:review,summary,quotation,other',
                'status' => 'in:read,want to read,reading',
                'books' => 'exists:books,id',
                'authors' => 'exists:authors,id',
                'text' => 'required|string',
            ], $error_messages, $attributes);

            $up_post = Post::find($post->id);
            $up_post->type = $request['type'];
            $up_post->status = $request['status'];
            $up_post->text = $request['text'];
            $up_post->save();

            $post->post_related_to_book()->sync($request['books']);
            $post->post_related_to_author()->sync($request['authors']);

            return redirect()->route('group.show', $group);
        }

        if ($book->id){
            $attributes = [
                'type' => 'POST\'S TYPE',
                'status' => 'STATUES',
                'text' => 'TEXT',
            ];

            $error_messages = [
                'type.in' => 'THE :attribute IS INVALID',
                'status.in' => 'THE :attribute IS INVALID',
                'text.required' => 'THE :attribute OF THIS POST IS REQUIRED',
            ];

            $request->validate([
                'type' => 'in:review,summary,quotation,other',
                'status' => 'in:read,want to read,reading',
                'text' => 'required|string',
            ], $error_messages, $attributes);

            $up_post = Post::find($post->id);
            $up_post->type = $request['type'];
            $up_post->status = $request['status'];
            $up_post->text = $request['text'];
            $up_post->save();

            return redirect()->route('book.show', $book);

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Group $group
     * @param User $user
     * @param Book $book
     * @param post $post
     * @return void
     */
    public function destroy(Group $group, User $user, Book $book, Post $post)
    {

        if($group->id){
            $delete_post = DB::table('group_posts')
                ->where('post_id', '=', $post->id)
                ->update(['active' => 0]);

            return redirect()->route('group.show', $group);
        }

        if($user->id){
            $delete_post = DB::table('post_lists')
                ->where('post_id', '=', $post->id)
                ->update(['active' => 0]);

            return redirect()->route('user.show', $user);
        }

        if($book->id){
            $delete_post = DB::table('book_posts')
                ->where('post_id', '=', $post->id)
                ->update(['active' => 0]);

            return redirect()->route('book.show', $book);
        }

    }
}
