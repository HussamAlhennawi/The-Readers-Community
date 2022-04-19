<?php

namespace App\Http\Controllers;

use App\Author;
use App\Book;
use App\Comment;
use App\lista;
use App\Post;
use App\Reaction;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ListaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param User $user
     * @param Book $books
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
//        $user_id = Auth::user()->id;
            $books = Book::all();
            //   import all the books lists for this user
            $books_lists = Lista::with('books')
                ->where('user_id', '=', $user->id)
                ->where('type', '=', 'book')->get();

            $favourite_books_list = Lista::where('name', '=', 'favourite books')
                ->where('user_id', '=', Auth::user()->id)
                ->first();

            $books_i_read_list = Lista::where('name', '=', 'books i read')
                ->where('user_id', '=', Auth::user()->id)
                ->first();

            $favourite_authors_list = Lista::where('name', '=', 'favourite authors')
                ->where('user_id', '=', Auth::user()->id)
                ->first();
//            dd($favourite_authors_list);

            $authors = Author::all();
            //   import all the authors lists for this user
            $authors_lists = Lista::with('authors')
                ->where('user_id', '=', $user->id)
                ->where('type', '=', 'author')->get();
            return view('profile.booksauthorslists',compact('books_lists','books', 'authors', 'authors_lists', 'favourite_books_list', 'books_i_read_list', 'favourite_authors_list'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'name' => 'LIST\'S TITLE',
            'type' => 'LIST\'S TYPE',
            'privacy' => 'LIST\'S PRIVACY',
        ];

        $error_messages = [
            'name.required' => "THE :attribute IS REQUIRED",
            'name.max' => "THE :attribute MAY NOT BE GREATER THAN :max CHARACTERS",
            'type.required' => 'THE :attribute IS REQUIRED',
            'type.in' => 'THE :attribute IS INVALID',
            'privacy.required' => 'THE :attribute IS REQUIRED',
            'privacy.in' => 'THE :attribute IS INVALID',
        ];

        $request->validate([
            'name' => 'required|string|max:50',
            'type' => 'required|in:book,author,post',
            'privacy' => 'required|in:public,private,protected',
        ], $error_messages, $attributes);

        $list = Lista::create([
            'user_id' => $request['user_id'],
            'name' => $request['name'],
            'type' => $request['type'],
            'privacy' => $request['privacy'],
        ]);

        $user = User::find($request['user_id']);

        return redirect()->route('user.lists.index', $user);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\lista  $lista
     * @return \Illuminate\Http\Response
     */
    public function show(lista $lista)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\lista  $lista
     * @return \Illuminate\Http\Response
     */
    public function edit(lista $lista)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param User $user
     * @param \App\lista $lista
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, lista $lista)
    {

        $lista = Lista::find($request['listas_id']);

        $lista->name = $request['name'];
        $lista->privacy = $request['privacy'];
        $lista->save();

        if($lista->type == 'book'){
            $lista->books()->sync($request['books']);
        }

        if($lista->type == 'author'){
            $lista->authors()->sync($request['authors']);
        }

        return redirect()->route('user.lists.index', Auth::user());
    }


    public function additem(Request $request, lista $lista)
    {

        $lista = Lista::find($request['listas_id']);

        if($lista->type == 'book'){
            $lista->books()->syncWithoutDetaching($request['books']);
        }

        if($lista->type == 'author'){
            $lista->authors()->syncWithoutDetaching($request['authors']);
        }

        return redirect()->route('user.lists.index', Auth::user());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\lista  $lista
     * @return \Illuminate\Http\Response
     */
    public function destroy(lista $lista)
    {
        //
    }

//    posts lists for auth user
    public function postslist(User $user, Lista $lista)
    {
//        dd('hus');
        //        $user_id = Auth::user()->id;

        $user_lists_for_posts = Lista::where('user_id', '=', $user->id)
            ->where('type', '=', 'post')
            ->select('id', 'name')
            ->orderBy('created_at', 'asc')
            ->get();
        $books = Book::all();
//        //   import all the books lists for this user
//        $posts_lists = Lista::with('books')
//            ->where('user_id', '=', $user->id)
//            ->where('type', '=', 'book')->get();
        // posts of this user in his profile
        $posts = Post::where('user_id', '=', $user->id)
            ->with('post_lists')
            ->whereHas('post_lists', function (Builder $query) use ($lista) {
                $query->where('post_lists.active', '=', 1)
                      ->where('listas_id', '=', $lista->id);
            })->get();
//        dd($posts);
        //get posts ids in this group as array of ids
        $posts_ids_in_this_profile = [];
        foreach($posts as $post)
        {
            $posts_ids_in_this_profile[] = $post->id;
        }

        //get the comments to the events in this group
        $comments = Comment::with('post_comments')->whereHas('post_comments', function (Builder $query) use($posts_ids_in_this_profile){
            $query->whereIn('post_id', $posts_ids_in_this_profile);
        })->get();

        // get the reactions name in the system
        $reactions = Reaction::all();

        // get number or each reaction type for each post in this group
        $posts_reactions = DB::table('post_reactions')
            ->whereIn('post_id', $posts_ids_in_this_profile)
            ->select('post_id', 'reaction_id',  DB::raw('COUNT(reaction_id) as total_reactions'))
            ->groupby(['post_id', 'reaction_id'])->get();
        $authors = Author::all();
//        //   import all the authors lists for this user
//        $authors_lists = Lista::with('authors')
//            ->where('user_id', '=', $user->id)
//            ->where('type', '=', 'author')->get();
        return view('profile.postslists',compact('lista', 'user_lists_for_posts','user', 'posts', 'comments', 'reactions', 'posts_reactions', 'books', 'authors'));

    }


    //    posts list for other users
    public function postslists(User $user, Lista $lista)
    {
//        dd($lista);
        //        $user_id = Auth::user()->id;

        $user_lists_for_posts = Lista::where('user_id', '=', $user->id)
            ->where('type', '=', 'post')
            ->where('privacy', '=', 'public')
            ->select('id', 'name')
            ->orderBy('created_at', 'asc')
            ->get();
//        dd($user_lists_for_posts);
//        dd($user_lists_for_posts);
        $books = Book::all();
//        //   import all the books lists for this user
//        $posts_lists = Lista::with('books')
//            ->where('user_id', '=', $user->id)
//            ->where('type', '=', 'book')->get();
        // posts of this user in his profile
        $posts = Post::where('user_id', '=', $user->id)
            ->with('post_lists')
            ->whereHas('post_lists', function (Builder $query) use ($lista) {
                $query->where('post_lists.active', '=', 1)
                      ->where('listas_id', '=', $lista->id);
            })->get();

//        dd($posts);
        //get posts ids in this group as array of ids
        $posts_ids_in_this_profile = [];
        foreach($posts as $post)
        {
            $posts_ids_in_this_profile[] = $post->id;
        }

        //get the comments to the events in this group
        $comments = Comment::with('post_comments')->whereHas('post_comments', function (Builder $query) use($posts_ids_in_this_profile){
            $query->whereIn('post_id', $posts_ids_in_this_profile);
        })->get();

        // get the reactions name in the system
        $reactions = Reaction::all();

        // get number or each reaction type for each post in this group
        $posts_reactions = DB::table('post_reactions')
            ->whereIn('post_id', $posts_ids_in_this_profile)
            ->select('post_id', 'reaction_id',  DB::raw('COUNT(reaction_id) as total_reactions'))
            ->groupby(['post_id', 'reaction_id'])->get();
        $authors = Author::all();
//        //   import all the authors lists for this user
//        $authors_lists = Lista::with('authors')
//            ->where('user_id', '=', $user->id)
//            ->where('type', '=', 'author')->get();
        return view('users.postslists',compact('lista', 'user_lists_for_posts','user', 'posts', 'comments', 'reactions', 'posts_reactions', 'books', 'authors'));

    }

    public function lists(User $user)
    {
        //   import all the public books lists for this user
        $books_lists = Lista::with('books')
            ->where('user_id', '=', $user->id)
            ->where('type', '=', 'book')
            ->where('privacy', '=', 'public')
            ->get();

        //   import all the public authors lists for this user
        $authors_lists = Lista::with('authors')
            ->where('user_id', '=', $user->id)
            ->where('type', '=', 'author')
            ->where('privacy', '=', 'public')
            ->get();
        return view('users.booksauthorslists', compact('user', 'books_lists', 'authors_lists'));
    }
}
