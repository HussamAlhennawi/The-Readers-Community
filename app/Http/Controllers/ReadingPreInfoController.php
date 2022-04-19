<?php

namespace App\Http\Controllers;

use App\Book;
use App\Info_rate;
use App\Reading_pre_info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReadingPreInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Book $book
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(book $book, Request $request)
    {
        $user = Auth::user();
        // get active reading plan for this book
        $search_text = $request['search_text'];
        $reading_pre_infos = Reading_pre_info::where('book_id', '=', $book->id)
            ->where('active', '=', 1)
            ->when($search_text , function ($query,$search_text ){
                return $query->where('text' , 'like' , '%'.$search_text.'%');
            })->orderBy('rate', 'desc')
            ->get();

        //user rate for each reading pre info belong to this book
        $user_rates = DB::table('reading_pre_infos')
            ->join('info_rate', 'reading_pre_infos.id', '=', 'info_rate.reading_pre_info_id')
            ->where('reading_pre_infos.book_id', '=', $book->id)
            ->where('info_rate.user_id', '=', $user->id)
            ->select('info_rate.reading_pre_info_id', 'info_rate.rate')
            ->get();

        //count the number of rates for each reading pre info belong to this book
        $count_rates_for_reading_pre_infos_of_this_book = DB::table('reading_pre_infos')
            ->join('info_rate', 'reading_pre_infos.id', '=', 'info_rate.reading_pre_info_id')
            ->where('reading_pre_infos.book_id', '=', $book->id)
            ->select('info_rate.reading_pre_info_id', DB::raw('COUNT(info_rate.rate) as total_rates'))
            ->groupBy('info_rate.reading_pre_info_id')
            ->get();

        return view('readingpreinfo.index', compact('book', 'reading_pre_infos', 'user_rates', 'count_rates_for_reading_pre_infos_of_this_book'));
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
     * @param \Illuminate\Http\Request $request
     * @param Book $book
     * @return void
     */
    public function store(Request $request, book $book)
    {
        $attributes = [
            'text' => 'CONTENT OF READING PRE-INFO',
        ];
        $error_messages = [
            'text.required' => "THE :attribute IS REQUIRED",
        ];

        $request->validate([
            'text' => 'required|string',
        ], $error_messages, $attributes);

        Reading_pre_info::create([
            'user_id' => $request['user_id'],
            'book_id' => $book->id,
            'text' => $request['text'],
            'rate' => 0.0,
        ]);

        return redirect()->route('book.reading_pre_info.index', $book);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reading_pre_info  $reading_pre_info
     * @return \Illuminate\Http\Response
     */
    public function show(Reading_pre_info $reading_pre_info)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reading_pre_info  $reading_pre_info
     * @return \Illuminate\Http\Response
     */
    public function edit(Reading_pre_info $reading_pre_info)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Book $book
     * @param \App\Reading_pre_info $reading_pre_info
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book, Reading_pre_info $reading_pre_info)
    {
        $attributes = [
            'text' => 'CONTENT OF READING PRE-INFO',
        ];
        $error_messages = [
            'text.required' => "THE :attribute IS REQUIRED",
        ];

        $request->validate([
            'text' => 'required|string',
        ], $error_messages, $attributes);

        $reading_pre_info->text = $request['text'];
        $reading_pre_info->save();

        return redirect()->route('book.reading_pre_info.index', $book);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Book $book
     * @param \App\Reading_pre_info $reading_pre_info
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book, Reading_pre_info $reading_pre_info)
    {
        $delete_reading_pre_info = DB::table('reading_pre_infos')
            ->where('id', '=', $reading_pre_info->id)
            ->update(['active' => 0]);

        return redirect()->route('book.reading_pre_info.index', $book);
    }

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

        Info_rate::updateOrCreate(
            ['reading_pre_info_id' => $request['reading_pre_info_id'], 'user_id' => $user->id],
            ['rate' => $request['rate']]
        );

        $total_rate = Info_rate::where('reading_pre_info_id', '=', $request['reading_pre_info_id'])
            ->avg('rate');


        $preinfo = Reading_pre_info::find($request['reading_pre_info_id']);
        $preinfo->rate = $total_rate;
        $preinfo->save();

    }
}
