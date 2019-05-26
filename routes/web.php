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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\ThreadResource;
use App\Models\Thread;

Route::get('/','ThreadsController@homepage');

Route::get('/index', 'PostController@index');
Route::post('/posts', 'PostController@store');

Route::get('/chart', function() {
    return view('test');
    //ok return "hello world";
})->name('chart');;



Auth::routes();
Route::resources([
    'posts' => 'PostController'
]);


Route::get('/test1', 'TestArrayController@test1'); //序列化模型 & 集合
Route::get('/theadResrouce', function () {
    return new ThreadResource(Thread::find(4));
});
Route::get('/monthoutput/{year}', 'MonthlyOutputController@index'); //chart for month output


Route::post('/redis/{funcname}','RedisUserController@getfunc');
Route::post('/redisCookie/{myname}','RedisUserController@getHelloCookie');



Route::get('/home', 'HomeController@index')->name('home');

//发起投票, 参与投票 投票记录
Route::get('/polls','PolljController@index')->name('polls.index');
Route::get('/polls/create','PolljController@create')->name('polls.create');
Route::post('/polls','PolljController@store')->name('polls.store');
Route::get('/polls/{pollj}','PolljController@show')->name('polls.show');  //show poll results
Route::get('/polls/{pollj}/edit','PolljController@edit')->name('polls.edit'); //vote
Route::patch('/polls/{pollj}','PolljController@update')->name('polls.update'); //update poll
Route::get('/posts/tagjs/{tagj}','TagjsController@index');
Route::get('/home','HomeController@index')->name('home');
//用户创建和登陆，确认信
Route::get('/register','RegistrationController@create')->name('register');
Route::post('/register','RegistrationController@store');
Route::get('/register/confirm', 'RegistrationController@confirm');
Route::get('/subscriptions/threads/{user}','ThreadSubscriptionsController@index')->name('profile.mysubscrips');
Route::get('/profiles/userstat/{user}','ProfilesController@userstatmain')->name('profiles.userstat');
Route::get('/profiles/userstat/{user}/{channel}/{year}/{month}','ProfilesController@getbyuserdate');
Route::get('/profiles/userstat/{user}/{channel}/{year}/{month}/financing','ProfilesController@getbyuserfinance');
Route::get('/profiles/{user}','ProfilesController@show')->name('profile');
//一个用户按照标签写的文章
Route::get('/threads/tags/{user}/{tag}','TagsController@index');
Route::patch('/profiles/{user}','ProfilesController@update')->name('profiles.update');
Route::get('/profiles/{user}/notifications','UserNotificationsController@index');
Route::delete('/profiles/{user}/notifications/{notification}','UserNotificationsController@destroy');
Route::post('/profiles/{user}/notifications/{notification}','UserNotificationsController@store');
Route::get('/profiles/{user}/notifications/notifyAllTypes','UserNotificationsController@notifyAllTypes')->name('profiles.notifyAllTypes'); //显示所有消息
Route::get('/profiles/{user}/notifications/notifyType/{notifyType}','UserNotificationsController@notifyType')->name('profiles.notifyType'); //显示所有消息
//处理关注或者取消关注好友
Route::post('/follows/{follow}','FollowsController@store')->name('follows.store');
Route::delete('/follows/{follow}','FollowsController@destroy')->name('follows.destroy');
//站内私信
Route::post('/profiles/textMessage','ProfilesController@textMessage')->name('users.textMessage');
Route::post('api/users/{user}/avatar','Api\UserAvatarController@store')->name('avatar');
Route::post('/profiles/{user}/download','ProfilesController@download')->name('profiles.download');
//论坛主要内容
Route::get('/threads','ThreadsController@index');
Route::get('/threads/search','ThreadsController@search')->name('threads.search')->middleware('throttle:2');
Route::get('/threads/create','ThreadsController@create')->name('threads.create')->middleware('must-be-confirmed');;
Route::get('/threads/createplus','ThreadsController@createplus')->name('threads.createplus');
Route::get('/threads/createAccounting','ThreadsController@createAccounting')->name('threads.createAccounting');
Route::get('/threads/{channel}','ThreadsController@index')->name('threads.index');
Route::post('/threads','ThreadsController@store')->name('threads.store');
Route::post('/threads/createFinance','ThreadsController@storeFinance')->name('threads.storeFinance');
Route::delete('/threads/{channel}/{thread}','ThreadsController@destroy')->name('threads.destroy');
Route::get('/threads/{thread}/edit','ThreadsController@edit')->name('threads.edit');
Route::patch('/threads/{channel}/{thread}','ThreadsController@update')->name('threads.update');
Route::get('/threads/tags/{tag}','TagsController@index');
Route::get('/threads/{channel}/{thread}','ThreadsController@show')->name('threads.show');
Route::get('/threads/{channel}/{thread}/replies','RepliesController@index')->name('replies.index');
Route::post('/threads/{channel}/{thread}/replies','RepliesController@store')->name('replies.store');
Route::post('/comments','CommentsController@store')->name('comments.store');
//回复,订阅,点赞
Route::delete('/replies/{reply}','RepliesController@destroy')->name('replies.destroy');
Route::post('/threads/{channel}/{thread}/subscriptions','ThreadSubscriptionsController@store');
Route::delete('/threads/{channel}/{thread}/subscriptions','ThreadSubscriptionsController@destroy');
Route::patch('/replies/{reply}','RepliesController@update');
Route::post('/replies/{reply}/favorites','FavoritesController@store')->name('favorites.store');
Route::delete('/replies/{reply}/favorites','FavoritesController@destroy');
//administrator
Route::get('/admin','AdminController@index')->name('admin.mainform');
Route::delete('/admin/users/{id}','AdminController@deleteUser')->name('admin.deleteUser');
Route::put('/admin/users/{id}','AdminController@updateUser')->name('admin.updateUser');
Route::post('/admin/users/usersearch/{id}','AdminController@usersearch');
Route::put('/admin/threads/{id}','AdminController@updateThread')->name('admin.updateThread');
Route::delete('/admin/threads/{id}','AdminController@deleteThread')->name('admin.deleteThread');
Route::post('/admin/threads/threadsearch/{id}','AdminController@threadsearch');
//同时在线的注册用户和游客数
Route::get('/admin/users/onlinelist','AdminController@onlinelist')->name('admin.onlinelist');
Route::get('/aboutus', function () {
    return view('aboutus');
});
