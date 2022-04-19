<?php

namespace App\Http\Controllers;

use App\Book;
use App\Info_rate;
use App\Plan_rate;
use App\reading_plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReadingPlanController extends Controller
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
        $reading_plans = Reading_plan::where('book_id', '=', $book->id)
            ->where('active', '=', 1)
            ->when($search_text , function ($query,$search_text ){
                return $query->where('text' , 'like' , '%'.$search_text.'%');
            })->orderBy('rate', 'desc')
            ->get();

        //user rate for each reading plane belong to this book
        $user_rates = DB::table('reading_plans')
            ->join('plan_rate', 'reading_plans.id', '=', 'plan_rate.reading_plan_id')
            ->where('reading_plans.book_id', '=', $book->id)
            ->where('plan_rate.user_id', '=', $user->id)
            ->select('plan_rate.reading_plan_id', 'plan_rate.rate')
            ->get();

        //count the number of rates for each reading plan belong to this book
        $count_rates_for_reading_plans_of_this_book = DB::table('reading_plans')
                ->join('plan_rate', 'reading_plans.id', '=', 'plan_rate.reading_plan_id')
                ->where('reading_plans.book_id', '=', $book->id)
                ->select('plan_rate.reading_plan_id', DB::raw('COUNT(plan_rate.rate) as total_rates'))
                ->groupBy('plan_rate.reading_plan_id')
                ->get();

        return view('readingplan.index', compact('book', 'reading_plans', 'user_rates', 'count_rates_for_reading_plans_of_this_book'));
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
            'text' => 'CONTENT OF READING PLAN',
        ];
        $error_messages = [
            'text.required' => "THE :attribute IS REQUIRED",
        ];

        $request->validate([
            'text' => 'required|string',
        ], $error_messages, $attributes);

        Reading_plan::create([
            'user_id' => $request['user_id'],
            'book_id' => $book->id,
            'text' => $request['text'],
            'rate' => 0.0,
        ]);

        return redirect()->route('book.reading_plan.index', $book);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\reading_plan  $reading_plan
     * @return \Illuminate\Http\Response
     */
    public function show(reading_plan $reading_plan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\reading_plan  $reading_plan
     * @return \Illuminate\Http\Response
     */
    public function edit(reading_plan $reading_plan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Book $book
     * @param Reading_plan $reading_plan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book, Reading_plan $reading_plan)
    {

        $attributes = [
            'text' => 'CONTENT OF READING PLAN',
        ];
        $error_messages = [
            'text.required' => "THE :attribute IS REQUIRED",
        ];
        $request->validate([
            'text' => 'required|string',
        ], $error_messages, $attributes);


        $reading_plan->text = $request['text'];
        $reading_plan->save();

        return redirect()->route('book.reading_plan.index', $book);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Book $book
     * @param reading_plan $reading_plan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book, reading_plan $reading_plan)
    {

        $delete_reading_plan = DB::table('reading_plans')
            ->where('id', '=', $reading_plan->id)
            ->update(['active' => 0]);

        return redirect()->route('book.reading_plan.index', $book);
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

        Plan_rate::updateOrCreate(
            ['reading_plan_id' => $request['reading_plan_id'], 'user_id' => $user->id],
            ['rate' => $request['rate']]
        );

        $total_rate = Plan_rate::where('reading_plan_id', '=', $request['reading_plan_id'])
            ->avg('rate');


        $plan = Reading_plan::find($request['reading_plan_id']);
        $plan->rate = $total_rate;
        $plan->save();

    }
}
