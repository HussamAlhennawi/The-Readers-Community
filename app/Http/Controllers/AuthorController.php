<?php

namespace App\Http\Controllers;

use App\author;
use App\Book;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $author_name = $request['author_name'];
        $authors = Author::when($author_name , function ($query,$author_name ){
            return $query->where('name' , 'like' , '%'.$author_name.'%');
        })->paginate(27);

        return view('author.index' , compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('author.create');
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
            'name' => 'AUTHOR NAME',
            'nationality' => 'NATIONALITY',
            'description' => 'DESCRIPTION',
        ];
        $error_messages = [
            'name.required' => "THE :attribute IS REQUIRED",
            'name.max' => "THE :attribute MAY NOT BE GREATER THAN :max CHARACTERS",
            'nationality.required' => 'THE :attribute OF THIS AUTHOR IS REQUIRED',
            'description.required' => 'THE :attribute ABOUT THIS AUTHOR IS REQUIRED',
        ];

        $request->validate([
            'name' => 'required|string|max:50',
            'nationality' => 'required|string',
            'description' => 'required|string',
        ], $error_messages, $attributes);

        Author::create([
            'user_id' => $request['user_id'],
            'name' => $request['name'],
            'nationality' => $request['nationality'],
            'description' => $request['description'],
        ]);

        return redirect()->route('author.create')->with('message','OKKK');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(author $author)
    {
        $books = Book::where('author_id', '=', $author->id)
                     ->orderBy('rate', 'desc')
                     ->get();
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

        return view('author.show',compact('books', 'author', 'categories', 'count_rates_for_books', 'books_idsss'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(author $author)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, author $author)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(author $author)
    {
        //
    }
}
