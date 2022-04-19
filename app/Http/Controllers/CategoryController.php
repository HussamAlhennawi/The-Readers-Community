<?php

namespace App\Http\Controllers;

use App\Book;
use App\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        $categories_num = DB::table('category')
            ->select(DB::raw('COUNT(id) as total_num'))
            ->first();
//        dd($categories_num->total_num);

        return view('category.index', compact('categories', 'categories_num'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return void
     */
    public function show(Category $category)
    {
//        $books = Book::all();

        $books = Book::whereHas('book_category', function (Builder $query) use($category){
            $query->where('category_id', '=', $category->id);
        })->get();

//        dd($books);

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
        return view('category.show', compact('category', 'books', 'categories', 'count_rates_for_books', 'books_idsss'));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
