<?php

namespace App\Http\Controllers;

use App\Author;
use App\Book;
use App\Category;
use App\Comment;
use App\Discussion;
use App\Group;
use App\Lista;
use App\Post;
use App\Reaction;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @param Request $request
     * @return void
     */
    public function show(User $user, Request $request)
    {

        if (Auth::user() == $user) {

            $user = User::find($user->id);
            $books = Book::all();
            $authors = Author::all();
            $user_lists_for_posts = Lista::where('user_id', '=', $user->id)
                ->where('type', '=', 'post')
                ->select('id', 'name')
                ->orderBy('created_at', 'asc')
                ->get();

            // posts of this user in his profile
            $search_text = $request['search_text'];
            $posts = Post::where('user_id', '=', $user->id)
                ->with('post_lists')
                ->whereHas('post_lists', function (Builder $query) {
                    $query->where('post_lists.active', '=', 1);
                })->when($search_text , function ($query,$search_text ){
                return $query->where('text' , 'like' , '%'.$search_text.'%');
            })->orderBy('created_at', 'desc')
                ->get();

            $book_title = $request['book_title'];
            $books = Book::when($book_title , function ($query,$book_title ){
                return $query->where('title' , 'like' , '%'.$book_title.'%');
            })->paginate(27);

            //get posts ids in this profile as array of ids
            $posts_ids_in_this_profile = [];
            foreach ($posts as $post) {
                $posts_ids_in_this_profile[] = $post->id;
            }

            //get the comments to the posts in this profile
            $comments = Comment::with('post_comments')
                ->whereHas('post_comments', function (Builder $query) use ($posts_ids_in_this_profile) {
                    $query->whereIn('post_id', $posts_ids_in_this_profile)
                        ->where('post_comments.active', '=', 1);
                })->orderBy('created_at', 'desc')
                ->get();

            // get the reactions name in the system
            $reactions = Reaction::all();

            // get number or each reaction type for each post in this profile
            $posts_reactions = DB::table('post_reactions')
                ->whereIn('post_id', $posts_ids_in_this_profile)
                ->select('post_id', 'reaction_id', DB::raw('COUNT(reaction_id) as total_reactions'))
                ->groupby(['post_id', 'reaction_id'])->get();

            // get user reactions on posts in this group
            $user_reactions = DB::table('post_reactions')
                ->whereIn('post_id', $posts_ids_in_this_profile)
                ->where('user_id', '=', Auth::user()->id)
                ->select('post_id', 'reaction_id')
                ->get();

            return view('profile.posts', compact('user', 'books', 'authors', 'user_lists_for_posts', 'posts', 'reactions', 'comments', 'posts_reactions', 'user_reactions'));

        } else {
            return redirect()->route('users.posts', $user);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param User $user
     * @return void
     */
    public function update(Request $request, User $user)
    {

        $request->validate([
            'email' => "required | string | unique:users,email," . $user->id,
            'gender' => "required | string",
            'date_of_birth' => "required | date",
            'nationality' => "required | string",
            'bio' => "required | string",
        ]);

        $up_user = User::find($user->id);
        $up_user->email = $request['email'];
        $up_user->date_of_birth = $request['date_of_birth'];
        $up_user->gender = $request['gender'];
        $up_user->nationality = $request['nationality'];
        $up_user->bio = $request['bio'];
        $up_user->save();

        return redirect()->route('user.show', $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function recommended_books(User $user)
    {
        $is_find = false;

        $favourite_books_list = Lista::where('name', '=', 'favourite books')
            ->where('user_id', '=', Auth::user()->id)
            ->first();

        $favourite_authors_list = Lista::where('name', '=', 'favourite authors')
            ->where('user_id', '=', Auth::user()->id)
            ->first();

        $books_i_read_list = Lista::where('name', '=', 'books i read')
            ->where('user_id', '=', Auth::user()->id)
            ->first();

        $books = null;

//        dd(count($favourite_authors_list->authors));

        if((count($favourite_books_list->books) != 0 ) OR (count($favourite_authors_list->authors) != 0 ) OR (count($books_i_read_list->books) != 0 )){

            $recommended_books_by_category = null;
            $recommended_books_by_author_from_favourite_books_list = null;
            $recommended_books_by_category_from_book_i_read = null;
            $recommended_books_by_author_from_books_i_read_list = null;
            $recommended_books_by_author_from_favourite_authors_list = null;

            if (count($favourite_books_list->books) != 0) {
                // recommended_books by categories in favourite books list
                $categories_ids_of_favorite_books = [];
                foreach ($favourite_books_list->books as $book) {
                    foreach ($book->book_category as $bc) {
                        $categories_ids_of_favorite_books[] = $bc->id;
                    }
                }
                $books_ids_in_favourite_books_list = [];
                foreach ($favourite_books_list->books as $book) {
                    $books_ids_in_favourite_books_list[] = $book->id;
                }
                $recommended_books_by_category = Book::whereNotIn('id', $books_ids_in_favourite_books_list)->get();


                // recommended_books by authors who write the books  in favourite books list
                $authors_ids_of_favorite_books = [];
                foreach ($favourite_books_list->books as $book) {
                    $authors_ids_of_favorite_books[] = $book->author_id;
                }
                $recommended_books_by_author_from_favourite_books_list = Book::whereIn('author_id', $authors_ids_of_favorite_books)
                    ->whereNotIn('id', $books_ids_in_favourite_books_list)->get();

            }

            if (count($favourite_authors_list->authors) != 0) {

                // recommended_books by books belong to authors in favourite authors list
                $authors_ids_in_favourite_authors_list = [];
                foreach ($favourite_authors_list->authors as $author) {
                    $authors_ids_in_favourite_authors_list[] = $author->id;
                }
                $recommended_books_by_author_from_favourite_authors_list = Book::whereIn('author_id', $authors_ids_in_favourite_authors_list)
                    ->whereNotIn('id', $books_ids_in_favourite_books_list)->get();

            }

            if (count($books_i_read_list->books) != 0) {

                // books_i_read
                $categories_ids_of_books_i_read = [];
                foreach ($books_i_read_list->books as $book) {
                    foreach ($book->book_category as $bc) {
                        $categories_ids_of_books_i_read[] = $bc->id;
                    }
                }
                $books_ids_in_books_i_read_list = [];
                foreach ($books_i_read_list->books as $book) {
                    $books_ids_in_books_i_read_list[] = $book->id;
                }
                $recommended_books_by_category_from_book_i_read = Book::whereNotIn('id', $books_ids_in_books_i_read_list)->get();

                // recommended_books by authors who write the books books i read list
                $authors_ids_of_books_i_read = [];
                foreach ($books_i_read_list->books as $book) {
                    $authors_ids_of_books_i_read[] = $book->author_id;
                }
                $recommended_books_by_author_from_books_i_read_list = Book::whereIn('author_id', $authors_ids_of_books_i_read)
                    ->whereNotIn('id', $books_ids_in_books_i_read_list)->get();

            }


            $books = collect([$recommended_books_by_category, $recommended_books_by_author_from_favourite_books_list,
                $recommended_books_by_category_from_book_i_read, $recommended_books_by_author_from_books_i_read_list,
                $recommended_books_by_author_from_favourite_authors_list])->collapse()->unique()->take(10);

            $is_find = true;
        }

        $authors = Author::all();
        $categories = Category::all();
        //count the number of rates for each  book
        $count_rates_for_books = DB::table('book_rate')
            ->select('book_id', DB::raw('COUNT(rate) as total_rates'))
            ->groupBy('book_id')
            ->get();
        // books ids have rate
        $books_ids = DB::table('book_rate')
            ->select('book_id')
            ->get()->toArray();
        // for true show :-P
        $books_idsss = [];
        foreach ($books_ids as $books_id) {
            $books_idsss[] = $books_id->book_id;
        }

        return view('recommended.books', compact('books', 'is_find', 'authors', 'categories','count_rates_for_books',  'books_idsss'));

    }


    // show posts for other users
    public function posts(User $user)
    {
        if (Auth::user() != $user) {

//            dd("hus");
            $user = User::find($user->id);
            $books = Book::all();
            $authors = Author::all();

            // posts of this user in his profile
            $posts = Post::where('user_id', '=', $user->id)
                ->with('post_lists')
                ->whereHas('post_lists', function (Builder $query) {
                    $query->where('post_lists.active', '=', 1);
                })->orderBy('created_at', 'desc')
                ->get();

            //get posts ids in this group as array of ids
            $posts_ids_in_this_profile = [];
            foreach ($posts as $post) {
                $posts_ids_in_this_profile[] = $post->id;
            }

            //get the comments to the events in this group
            $comments = Comment::with('post_comments')->whereHas('post_comments', function (Builder $query) use ($posts_ids_in_this_profile) {
                $query->whereIn('post_id', $posts_ids_in_this_profile)
                    ->where('post_comments.active', '=', 1);
            })->orderBy('created_at', 'desc')
                ->get();

            // get the reactions name in the system
            $reactions = Reaction::all();

            // get number or each reaction type for each post in this group
            $posts_reactions = DB::table('post_reactions')
                ->whereIn('post_id', $posts_ids_in_this_profile)
                ->select('post_id', 'reaction_id', DB::raw('COUNT(reaction_id) as total_reactions'))
                ->groupby(['post_id', 'reaction_id'])->get();

            // get user reactions on posts in this group
            $user_reactions = DB::table('post_reactions')
                ->whereIn('post_id', $posts_ids_in_this_profile)
                ->where('user_id', '=', Auth::user()->id)
                ->select('post_id', 'reaction_id')
                ->get();

            return view('users.posts', compact('user', 'books', 'authors', 'posts', 'reactions', 'comments', 'posts_reactions', 'user_reactions'));
        } else {
            return redirect()->route('user.show', $user);
        }

    }

    public function admindashbord() {


        $groups = Group::all();
        $books = Book::all();

//        dd(strtotime('2020-12-31'));

//        $int= rand(1577836800,1609372800);
//        $string = date("Y-m-d H:i:s",$int);
//
//        $groups['0']->created_at = $string;
//        $groups['0']->save();
//
//        $ss = DB::table('groups')
//            ->where('id', 1)
//            ->update(['MONTH(created_at)' => 1]);




//        foreach ($books as $book) {
//            $int= rand(1577836800,1609372800);
//            $string = date("Y-m-d H:i:s",$int);
//            $book->created_at = $string;
//            $book->save();
//        }

        $books= Book::select(DB::raw('count(id) as `ids`'), DB::raw('MONTH(created_at) month'))
            ->groupby('month')->orderby('month', 'asc')
            ->get()->toArray();

//        dd($books);


//        $res= User::select(DB::raw('count(id) as `ids`'), DB::raw('MONTH(created_at) month'))
//            ->groupby('month')
//            ->get()->toArray();


//        dd($res);

//    rand(1,12);


//        dd($groups['0']->group_discussions()->count());
        $users = User::all();

        $discussions = Discussion::all();


        return view('dashbord.admindashbord', compact('groups', 'users', 'discussions', 'books'));
    }

}
