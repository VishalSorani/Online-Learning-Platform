<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\DashboardController;
use App\Models\Playlist;
use Illuminate\Support\Facades\Session;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Auth::routes();

Route::get('/', [App\Http\Controllers\User\UserDashboardController::class, 'index'])->name('user-home');


//Admin DashBoard Routes
Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);
    Route::get('/view-profile/{id}', [App\Http\Controllers\Admin\DashboardController::class, 'view_profile']);
    Route::get('/update-profile/{id}', [App\Http\Controllers\Admin\DashboardController::class, 'update_profile'])->name('update-profile');
    Route::post('/update-profile/{id}', [App\Http\Controllers\Admin\DashboardController::class, 'store_updated_profile']);
    Route::get('/about', [App\Http\Controllers\Admin\DashboardController::class, 'about']);
    Route::get('/request/tutors/', [App\Http\Controllers\Admin\DashboardController::class, 'tutor_request'])->name('requests');
    Route::get('/request/tutors/{id}', [App\Http\Controllers\Admin\DashboardController::class, 'tutor_request_update']);
    Route::get('/request/tutors/reject/{id}', [App\Http\Controllers\Admin\DashboardController::class, 'tutor_request_reject']);
    

    //Playlist
    Route::get('/playlist', [\App\Http\Controllers\Admin\PlaylistController::class, 'view_playlist']);

    //Add New PlayLists
    Route::get('/playlist/add-playlist', [\App\Http\Controllers\Admin\PlaylistController::class, 'add_playlist'])->name('add_post');
    Route::post('/playlist/add-playlist', [\App\Http\Controllers\Admin\PlaylistController::class, 'store_playlist']);

    //Update The Playlists
    Route::get('/playlist/update-playlist/{id}', [App\Http\Controllers\Admin\PlaylistController::class, 'update_playlist'])->name('update_playlist');
    Route::post('/playlist/update-playlist/{id}', [App\Http\Controllers\Admin\PlaylistController::class, 'store_update_playlist']);

    //Delete The PlayLists
    Route::post('/playlist/delete-playlist/{id}', [App\Http\Controllers\Admin\PlaylistController::class, 'delete_playlist'])->name('delete-playlist');

    //All Contents Content
    Route::get('/playlist/content', [\App\Http\Controllers\Admin\ContentController::class, 'content']);
    Route::post('/playlist/delete-playlist/{id}', [App\Http\Controllers\Admin\PlaylistController::class, 'delete_playlist'])->name('delete-playlist');

    //View PLayList Content
    Route::get('/view-playlist/{id}', [\App\Http\Controllers\Admin\ContentController::class, 'view_playlist']);
    Route::get('/playlist/add-content/{id?}', [App\Http\Controllers\Admin\ContentController::class, 'add_content'])->name('add-content');
    Route::post('/playlist/add-content/{id?}', [App\Http\Controllers\Admin\ContentController::class, 'store_content']);

    //Update Playlist Content
    Route::get('/view-playlist/update/{id}', [\App\Http\Controllers\Admin\ContentController::class, 'update_content'])->name('update-content');
    Route::post('/view-playlist/update/{id}', [\App\Http\Controllers\Admin\ContentController::class, 'store_update_content']);

    //Delete The Video Content
    Route::post('/view-playlist/delete-content/{id}', [App\Http\Controllers\Admin\ContentController::class, 'delete_content'])->name('delete-content');

    //View Particular Video
    Route::get('/view-playlist/{playlist}/{video}', [App\Http\Controllers\Admin\ContentController::class, 'view_video_content'])->name('view-video-admin');

    //comment
    Route::get('/comments', [App\Http\Controllers\Admin\DashboardController::class, 'comment'])->name('comment-admin');

    //like
    Route::get('/likes', [App\Http\Controllers\Admin\DashboardController::class, 'likes'])->name('likes-admin');

    //search
    Route::post('/search/{name?}', [App\Http\Controllers\Admin\DashboardController::class, 'search']);

});

Route::get('logout', function () {
    Session::flush();
    Auth::logout();
    return redirect('login');
});




//Users Routes
Route::get('/home', [App\Http\Controllers\User\UserDashboardController::class, 'index'])->name('user-home');
Route::get('/view-profile/{id}', [App\Http\Controllers\User\UserDashboardController::class, 'view_profile'])->name('profile');
Route::get('/update-profile/{id}', [App\Http\Controllers\User\UserDashboardController::class, 'update_profile'])->name('update-user-profile');
Route::post('/update-profile/{id}', [App\Http\Controllers\User\UserDashboardController::class, 'store_updated_profile']);
Route::get('/comments', [App\Http\Controllers\User\UserDashboardController::class, 'comment']);
Route::get('/courses/bookmarks', [App\Http\Controllers\User\UserDashboardController::class, 'courses'])->name('bookmark');
Route::get('/likes', [App\Http\Controllers\User\UserDashboardController::class, 'likes'])->name('likes');
Route::post('/likes', [App\Http\Controllers\User\UserDashboardController::class, 'unlikes']);
Route::get('/about-us', [App\Http\Controllers\User\UserDashboardController::class, 'about'])->name('about');
Route::get('/contact-us', [App\Http\Controllers\User\UserDashboardController::class, 'contact'])->name('contact');
Route::post('/contact-us', [App\Http\Controllers\User\UserDashboardController::class, 'store_query']);


Route::get('/view-playlist/{id}', [\App\Http\Controllers\User\PlaylistController::class, 'view_playlist']);
Route::get('/view-playlist/{playlist}/{video}', [App\Http\Controllers\User\PlaylistController::class, 'view_video_content'])->name('view-video');
Route::get('/courses/', [\App\Http\Controllers\User\UserDashboardController::class, 'view_courses'])->name('course');


Route::post('/like-content/{playlist}/{video}', [App\Http\Controllers\User\PlaylistController::class, 'like']);
Route::post('/comment-content/{playlist}/{video}', [App\Http\Controllers\User\PlaylistController::class, 'comment']);
Route::post('/delete-comment/{playlist}/{video}', [App\Http\Controllers\User\PlaylistController::class, 'delete_comment']);

//request for tutors
Route::get('/tutors', [App\Http\Controllers\User\TeacherController::class, 'index'])->name('tutors');
Route::post('/tutors/search', [App\Http\Controllers\User\TeacherController::class, 'search_tutor']);
Route::get('/tutors-name/{slug}', [App\Http\Controllers\User\TeacherController::class, 'view_profile'])->name('tutors-profile');
Route::get('/tutors/register', [App\Http\Controllers\User\TeacherController::class, 'tutor_request'])->name('tutor-register');
Route::post('/tutors/register', [App\Http\Controllers\User\TeacherController::class, 'tutor_request_validate']);
Route::get('/course/search/{category}', [App\Http\Controllers\User\UserDashboardController::class, 'search_course_category']);
Route::post('/course/search/{name?}', [App\Http\Controllers\User\UserDashboardController::class, 'search_course_name']);


Route::get('/enroll/{id}', [App\Http\Controllers\User\EnrollController::class, 'enroll'])->name('enroll');
