<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\AvailabilityController;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Mail;
use App\Mail\InviteEmail;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// home/dashboard
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// friend routes
Route::get('/friends', [App\Http\Controllers\FriendController::class, 'friends'])->name('friends');

// add friend routes
Route::get('/searchFriends', [App\Http\Controllers\FriendController::class, 'searchFriends'])->name('searchFriends');
Route::post('/searchFriends', [App\Http\Controllers\FriendController::class, 'searchFriends'])->name('searchFriends');
Route::post('/showAdd', [App\Http\Controllers\FriendController::class, 'AddFriends'])->name('AddFriends');

// delete friend routes
Route::get('/findFriends', [App\Http\Controllers\FriendController::class, 'findFriends'])->name('findFriends');
Route::post('/showDelete', [App\Http\Controllers\FriendController::class, 'DeleteFriends'])->name('DeleteFriends');

// map
Route::get('/map', [MapController::class, 'index'])->name('map_events');

// calendar
Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');
Route::post('/calendar-event', [CalendarController::class, 'calendarEvents'])->name('calendar.events');

// profile page
Route::get('/profile', 'App\Http\Controllers\ProfileController@show')->name('profile.show');
Route::put('/profile/update-username', 'App\Http\Controllers\ProfileController@updateUsername')->name('profile.update.username');
Route::put('/profile/update-password', 'App\Http\Controllers\ProfileController@updatePassword')->name('profile.update.password');
Route::delete('/profile/delete-account', 'App\Http\Controllers\ProfileController@deleteAccount')->name('profile.delete');

Route::put('/profile/update/picture', 'App\Http\Controllers\ProfileController@updatePicture')->name('profile.update.picture');

//events display page
Route::get('/currentEvents', [App\Http\Controllers\EventController::class, 'index'])->name('eventsPage');
Route::get('/events/{id}', [App\Http\Controllers\EventController::class, 'show'] )->name('Event');
Route::get('/event', [App\Http\Controllers\EventController::class, 'createEvent'])->name('event.create');
Route::post('/event/updatePivot', [App\Http\Controllers\EventController::class, 'updatePivot'])->name('event.updatePivot');

//event interactions
Route::delete('/deleteEvent/{id}', [App\Http\Controllers\EventController::class, 'deleteEvent'])->name('event.delete');
Route::delete('/deleteEventPivot/{id}', [App\Http\Controllers\EventController::class, 'deletePivot'])->name('event.pivot.delete');

//availabilities
Route::resource('availabilities', AvailabilityController::class);
Route::post('availabilities/store', [AvailabilityController::class, 'store'])->name('store');

// MAIL
Route::match(['get', 'post'], '/send-invitations', [MailController::class, 'sendInvitations'])->name('invitations');
Route::match(['get', 'post', 'delete'], '/send-cancellations/{id}', [MailController::class, 'sendCancelations'])->name('send-cancellations');

Route::get('/recommended/{id}', [AvailabilityController::class, 'calculateOverlappingDates'])->name('Recommended');
Route::get('/selectRecommended/{id}', [AvailabilityController::class, 'SelectRecommendedDate'])->name('SelectRecommended');