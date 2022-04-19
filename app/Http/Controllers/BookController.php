<?php

namespace App\Http\Controllers;

use App\Author;
use App\Book;
use App\Book_rate;
use App\Category;
use App\Comment;
use App\Post;
use App\Reaction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $book_title = $request['book_title'];
        $books = Book::when($book_title , function ($query,$book_title ){
            return $query->where('title' , 'like' , '%'.$book_title.'%');
        })->paginate(27);

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

        return view('book.index', compact('books', 'authors', 'categories', 'count_rates_for_books', 'books_idsss'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $authors = Author::all();
        $categories = Category::all();
        return view('book.create', compact('authors','categories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = [
            'title' => 'BOOK\'S TITLE',
            'author_id' => 'AUTHOR NAME',
            'publish_year' => 'PUBLISH YEAR',
            'age_range' => 'AGE RANGE',
            'categories' => 'CATEGORIES',
            'description' => 'DESCRIPTION',
        ];

        $error_messages = [
            'title.required' => "THE :attribute IS REQUIRED",
            'title.max' => "THE :attribute MAY NOT BE GREATER THAN :max CHARACTERS",
            'author_id.required' => 'THE :attribute OF THIS BOOK IS REQUIRED',
            'author_id.exists' => 'THE :attribute OF THIS BOOK IS INVALID',
            'publish_year.required' => 'THE :attribute YEAR OF THIS BOOK IS REQUIRED',
            'publish_year.between' => 'THE :attribute OF THIS BOOK MUST BE BETWEEN :min - :max',
            'age_range.in' => 'THE :attribute OF THIS BOOK IS INVALID',
            'categories.required' => 'THE :attribute OF THIS BOOK IS REQUIRED',
            'categories.exists' => 'THE :attribute ARE INVALID',
            'description.required' => 'THE :attribute ABOUT THIS BOOK IS REQUIRED',
        ];

        $request->validate([
            'title' => 'required|string|max:50',
            'publish_year' => 'required|digits:4|integer|between:1900,' . date('Y'),
            'age_range' => 'in:children,young adults,middle-aged & old adults',
            'description' => 'required|string',
            'author_id' => 'required|exists:authors,id',
            'categories' => 'required|exists:category,id',
            //            'cover_image' => 'mimes:jpeg,jpg,png',
        ], $error_messages, $attributes);

        $book = Book::create([
            'user_id' => $request['user_id'],
            'author_id' => $request['author_id'],
            'title' => $request['title'],
            'publish_year' => $request['publish_year'],
            'age_range' => $request['age_range'],
            'description' => $request['description'],
            'cover_image' => $request['cover_image'],
            'rate' => 0.0,
        ]);

        $book->book_category()->sync($request['categories']);


        return redirect()->route('book.show', $book);

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Book $book
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(book $book , Request $request)
    {
        $user = Auth::user();

        //number of posts in this book
        $posts_num = DB::table('book_posts')
            ->where('book_id', '=', $book->id)
            ->where('active', '=', 1)
            ->count('post_id');
        //number of reading plans in this book
        $reading_plans_num = DB::table('reading_plans')
            ->where('book_id', '=', $book->id)
            ->where('active', '=', 1)
            ->count('book_id');
        //number of reading pre info in this book
        $reading_pre_infos_num = DB::table('reading_pre_infos')
            ->where('book_id', '=', $book->id)
            ->where('active', '=', 1)
            ->count('book_id');
        //number of discussions in this book
        $discussions_num = DB::table('book_discussions')
            ->where('book_id', '=', $book->id)
            ->count('discussion_id');

        //posts in the book
        $search_text = $request['search_text'];
        $posts = Post::whereHas('book_posts', function (Builder $query) use($book){
            $query->where('book_id', '=', $book->id)
                  ->where('book_posts.active', '=', 1);
        })->when($search_text , function ($query,$search_text ){
        return $query->where('text' , 'like' , '%'.$search_text.'%');
    })->orderBy('created_at', 'desc')
            ->get();


        //get posts ids in this book as array of ids
        $posts_ids_in_this_book = [];
        foreach($posts as $post)
        {
            $posts_ids_in_this_book[] = $post->id;
        }

        // get the reactions name in the system
        $reactions = Reaction::all();
        // get number or each reaction type for each post in this group
        $posts_reactions = DB::table('post_reactions')
            ->whereIn('post_id', $posts_ids_in_this_book)
            ->select('post_id', 'reaction_id',  DB::raw('COUNT(reaction_id) as total_reactions'))
            ->groupby(['post_id', 'reaction_id'])->get();

        // get user reactions on posts in this group
        $user_reactions = DB::table('post_reactions')
            ->whereIn('post_id', $posts_ids_in_this_book)
            ->where('user_id', '=', Auth::user()->id)
            ->select('post_id', 'reaction_id')
            ->get();

        //get the comments to the posts in this group
        $comments = Comment::with('post_comments')->whereHas('post_comments', function (Builder $query) use($posts_ids_in_this_book){
            $query->whereIn('post_id', $posts_ids_in_this_book)->where('post_comments.active', '=', 1);
        })->orderBy('created_at', 'desc')
            ->get();

        //user rate for this book
        $user_rate = DB::table('book_rate')
            ->where('book_id', '=', $book->id)
            ->where('user_id', '=', $user->id)
            ->select('rate')
            ->first();

        //count the number of rates for this book
        $count_rates_of_this_book = DB::table('book_rate')
            ->where('book_id', '=', $book->id)
            ->select(DB::raw('COUNT(rate) as total_rates'))
            ->groupBy('book_id')
            ->first();

        $categories = Category::all();

        return view('book.posts',compact('book', 'categories', 'count_rates_of_this_book', 'user_rate', 'posts_num', 'reading_plans_num', 'reading_pre_infos_num', 'discussions_num', 'posts', 'posts_ids_in_this_book', 'reactions', 'posts_reactions', 'user_reactions', 'comments'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Book $book
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(book $book)
    {
//        dd($book);
//        $cat=Book::with('book_category')
//                 ->where('id', '=', $book->id)
//                 ->first();
//        $cat=Book::find($book->id);
//
//
//        dd($cat->book_category);
        $categories = Category::all();
        $author = Book::with('author')
            ->where('id', '=', $book->id)
            ->first();
        $author_name = $author->author->name;
        return view('book.edit', compact('book', 'author_name', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Book $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, book $book)
    {
        $attributes = [
            'age_range' => 'AGE RANGE',
            'categories' => 'CATEGORIES',
            'description' => 'DESCRIPTION',
        ];

        $error_messages = [
            'age_range.in' => 'THE :attribute OF THIS BOOK IS INVALID',
            'categories.required' => 'THE :attribute OF THIS BOOK IS REQUIRED',
            'categories.exists' => 'THE :attribute ARE INVALID',
            'description.required' => 'THE :attribute ABOUT THIS BOOK IS REQUIRED',
        ];

        $request->validate([
            'age_range' => 'in:children,young adults,middle-aged & old adults',
            'description' => 'required|string',
            'categories' => 'required|exists:category,id',
            //            'cover_image' => 'mimes:jpeg,jpg,png',
        ], $error_messages, $attributes);

        $up_book = Book::find($book->id);
        $up_book->age_range = $request['age_range'];
        $up_book->description = $request['description'];
        $up_book->save();

        $book->book_category()->sync($request['categories']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\book $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(book $book)
    {
        //
    }

//    public function rate(Request $request)
//    {
//        $user = Auth::user();
//
//        $attributes = [
//            'rate' => 'RATING',
//        ];
//        $error_messages = [
//            'rate.between' => "THE :attribute VALUE SHOULD BE BETWEEN ONE STAR AND FIVE STARS",
//        ];
//
//        $request->validate([
//            'rate' => 'digits:1|integer|between:1,5',
//        ], $error_messages, $attributes);
//
//        Book_rate::updateOrCreate(
//            ['user_id' => $user->id, 'book_id' => $request['book_id']],
//            ['rate' => $request['rate']]
//        );
//
//        $avg_rate = Book_rate::where('book_id', '=', $request['book_id'])
//                               ->avg('rate');
//
//        $book = Book::find($request['book_id']);
//        $book->rate = $avg_rate;
//        $book->save();
//
//
//        return  response()->json([
//            'success'=>'Rate Done Successfully',
//            'errors' => $error_messages,
//            'data'=>$book
//        ]);
//
//        $response = "will done";
//        return $response;
//    }

    public function rate(Request $request)
    {
        $user = Auth::user();
        $attributes = [
            'rate' => 'RATING',
        ];
        $error_messages = [
            'rate.between' => "THE :attribute VALUE SHOULD BE BETWEEN ONE STAR AND FIVE STARS",
        ];

        $request->validate([
            'rate' => 'digits:1|integer|between:1,5',
        ], $error_messages, $attributes);

        Book_rate::updateOrCreate(
            ['book_id' => $request['book_id'], 'user_id' => $user->id],
            ['rate' => $request['rate']]
        );

        $total_rate = Book_rate::where('book_id', '=', $request['book_id'])
            ->avg('rate');


        $book = Book::find($request['book_id']);
        $book->rate = $total_rate;
        $book->save();

    }

//    public function rate(Request $request)
//    {
//        $user = Auth::user();
//        if($user->hasRole(['Internal_student','External_student']))
//        {
//            $student_id = $user->id;
//            $course_id = $request->course_id;
//            $rate = $request->rate;
//            if($rate>=1 || $rate<=5)
//            {
//                $reg = Course_Student::where('course_id',$course_id)->where('student_id',$student_id)->first();
//                if($reg)
//                {
//                    $reg->rate = $request->rate;
//                    $reg->save();
//                    $course = Course::findOrFail($course_id);
//                    $StudentRates = $course->AcceptedStudents;
//                    $rates = [
//                        0=>0,
//                        1=>0,
//                        2=>0,
//                        3=>0,
//                        4=>0,
//                        5=>0,
//                    ];
//                    $total_rate = 0;
//                    $n = 0;
//                    foreach ($StudentRates as $student) {
//                        if($student->rate > 0)
//                        {
//                            $total_rate += $student->rate;
//                            $n++;
//                            $rates[0] += 1;
//                            $rates[$student->rate] += 1;
//                        }
//                    }
//                    $course_rate = $total_rate/$n;
//                    $course->rate = $course_rate;
//                    $course->save();
//                    $course->rates = $rates;
//// $response = "{message:\"Rate Done Successfully\",code:1,data:{course_rate:".$course_rate."}}";
//                    return  response()->json([
//                        'success'=>'Rate Done Successfully',
//                        'data'=>$course
//                    ]);
//// return $response;
//                }
//                $response = "You're not registered in this course";
//                return $response;
//            }
//            $response = "Rate should be between 1 and 5";
//            return $response;
//        }
//        $response = "You're not allowed to rate courses";
//        return $response;
//    }
}
