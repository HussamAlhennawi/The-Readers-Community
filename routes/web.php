<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('/');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

//ROUTS

// +++++++++++++++++++++++++++++++++++++++++++++++++ USER ++++++++++++++++++++++++++++++++++++++++++++++++++ //
    //AUTHENTICATED user profile info & posts
Route::resource('/user', 'UserController')->middleware('auth');

                // +++++++++++++++++++++++++++++++++ LIST +++++++++++++++++++++++++++++++++ //
                //lists (books & authors) index & create & store for AUTHENTICATED user
                Route::resource('/user.lists', 'ListaController')
                    ->middleware('auth');

                // add item to books and authors lists
                Route::put('/user/{user}/list/{list}', 'ListaController@additem')
                    ->name('user.lists.additem')
                    ->middleware('auth');

                //posts lists show AUTHENTICATED user
                Route::get('/user/{user}/postslist/{lista}', 'ListaController@postslist')
                    ->name('user.postslist')
                    ->middleware('auth');
                // +++++++++++++++++++++++++++++++++++++END LIST+++++++++++++++++++++++++++ //

                // +++++++++++++++++++++++++++++++++ other USERS +++++++++++++++++++++++++++++++++ //
                //profile for other users
                Route::get('/users/{user}', 'UserController@posts')
                    ->name('users.posts')
                    ->middleware('auth');
                // for book $ authors
                Route::get('/users/{user}/lists', 'ListaController@lists')
                    ->name('users.lists')
                    ->middleware('auth');

                Route::get('/users/{user}/postslists/{lista}', 'ListaController@postslists')
                    ->name('users.postslists')
                    ->middleware('auth');
                // +++++++++++++++++++++++++++++++++++++END other USERS+++++++++++++++++++++++++++ //

// +++++++++++++++++++++++++++++++++++++++++++++++++ END USER ++++++++++++++++++++++++++++++++++++++++++++++++++ //



// +++++++++++++++++++++++++++++++++ POST +++++++++++++++++++++++++++++++++ //
    //store post from user profile
Route::resource('/user.post', 'PostController')->middleware('auth');
    // add reaction to post
//Route::resource('post.reaction', 'ReactionController')->middleware('auth');
Route::post('/reaction/add', 'ReactionController@store')->middleware('auth');
    // add comment to post
//Route::post('/post/{post}/comment', 'CommentController@post')->name('post.comment');
Route::resource('/post.comment', 'CommentController')->middleware('auth');
// for add coment to post & event
Route::post('/comment/add', 'CommentController@add')->middleware('auth');
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //






// +++++++++++++++++++++++++++++++++ GROUP +++++++++++++++++++++++++++++++++ //
    // groups index & store new group
Route::resource('/group', 'GroupController')->middleware('auth');
    // join group
Route::post('/group/{group}/join', 'GroupController@join')->name('group.join')->middleware('auth');
    // store & edit & delete the post from group
Route::resource('/group.post', 'PostController')->middleware('auth');
    // show active members & blocked members (for group admin)
Route::get('/group/{group}/members', 'GroupController@members')->name('group.members')->middleware('auth');
    // accept & block & unblock member from group
Route::post('/group/{group}/member/{group_member}/accept', 'GroupController@accept')->name('group.accept')->middleware('auth');
Route::post('/group/{group}/member/{group_member}/block', 'GroupController@block')->name('group.block')->middleware('auth');
Route::post('/group/{group}/member/{group_member}/unblock', 'GroupController@unblock')->name('group.unblock')->middleware('auth');
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //


// +++++++++++++++++++++++++++++++++ EVENT +++++++++++++++++++++++++++++++++ //
    //store & edit & delete the event from group
Route::resource('group.event', 'EventController')->middleware('auth');
    // event going
Route::post('/group/{group}/event/{event}/going', 'EventController@going')->name('event.going')->middleware('auth');
    // add comment to event
//Route::post('/event/{event}/comment', 'CommentController@event')->name('event.comment');
Route::resource('/event.comment', 'CommentController')->middleware('auth');
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //


// +++++++++++++++++++++++++++++++++ BOOK +++++++++++++++++++++++++++++++++ //
    // books index & store new book
Route::resource('/book', 'BookController')->middleware('auth');
    // store & edit & delete the post from book page
Route::resource('/book.post', 'PostController')->middleware('auth');
    // rate the book by user
Route::post('/book/rate', 'BookController@rate')->middleware('auth');

// +++++++ book's reading plan +++++++
    //reading plan index & store $ update $ delete
Route::resource('book.reading_plan', 'ReadingPlanController')->middleware('auth');
    // rate the reading plan by user
Route::post('/readingplan/rate', 'ReadingPlanController@rate')->middleware('auth');

// +++++++ book's reading pre info +++++++
    //reading pre_info index & store $ update $ delete
Route::resource('book.reading_pre_info', 'ReadingPreInfoController')->middleware('auth');
    // rate the reading pre info by user
Route::post('/readingpreinfo/rate', 'ReadingPreInfoController@rate')->middleware('auth');

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //



// +++++++++++++++++++++++++++++++++ Categories +++++++++++++++++++++++++++++++++ //
    // categories index & show books in a category
Route::resource('category', 'CategoryController')->middleware('auth');
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //

// +++++++++++++++++++++++++++++++++ Recommended Books +++++++++++++++++++++++++++++++++ //
Route::get('/recommendedbooks', 'UserController@recommended_books')->name('recommended.books');
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //

Route::get('/admindashbord', 'UserController@admindashbord')->name('admindashbord');





Route::resource('/author', 'AuthorController')->middleware('auth');



//Route::resource('/book/{id}/readingplan', 'ReadingPlanController')->middleware('auth');
//Route::resource('book.readingplan', 'ReadingPlanController');
//test
//Route::resource('group.post', 'PostController');


//Route::post('/readingplann/rate', function () {
//     dd('hu');
//
//});
//Route::resource('book.readingpreinfo', 'ReadingPreInfoController');
//Route::get('/book/{id}/readingplan', 'ReadingPlanController@index')->middleware('auth');



////    get the group posts
//Route::get('/group/{group}/posts', 'PostController@index_of_group_posts')->name('group.posts');
//    get the group events
//Route::get('/group/{group}/events', 'EventController@index_of_group_eventss')->name('group.events');
////  store the group post
//Route::post('/group/{group}/post', 'PostController@group_post_store')->name('group.post');










// discussion
Route::resource('/group.discussion', 'DiscussionController')->middleware('auth');
Route::get('/group/{group}/dis', 'DiscussionController@group')->name('group.dis')->middleware('auth');
Route::resource('/book.discussion', 'DiscussionController')->middleware('auth');
Route::get('/book/{book}/dis', 'DiscussionController@book')->name('book.dis')->middleware('auth');

// discussion join from group
Route::post('/group/{group}/discussion/{discussion}/join', 'DiscussionController@join')->name('group.discussion.join');
// discussion message from group
//Route::post('/group/{group}/discussion/{discussion}/message', 'DiscussionController@message')->name('group.discussion.message');

// discussion join from book
Route::post('/book/{book}/discussion/{discussion}/join', 'DiscussionController@join')->name('discussion.join');
// delete member from group
Route::post('/group/{group}/member/{group_member}/delete', 'GroupController@deletemember')->name('group.deletemember');


Route::get('markasread', function () {
    Auth::user()->unreadNotifications->markAsRead();
    return redirect()->back();
})->name('markasread');

//Route::get('markasread', 'GroupController@deletemember')->name('group.deletemember');
//Route::get('/ho', 'DiscussionController@group')->name('ho');
Route::get('/message', 'DiscussionController@getMessage')->name('message');
Route::post('/sendmessage', 'DiscussionController@sendMessage');

// bokk dis
Route::get('/bookmessage', 'DiscussionController@getbookMessage')->name('bookmessage');
Route::post('/sendmessagefrombook', 'DiscussionController@sendbookMessage');




