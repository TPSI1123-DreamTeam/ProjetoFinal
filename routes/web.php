<?php
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\GoogleController;
use Illuminate\Support\Facades\Route;

///// ::::: PUBLIC VIEWS :::::: ///////
Route::get('/', function () {
       return view('welcome');
});

///// ::::: ABOUT :::::: ///////
Route::get('/about', function () {
    return view('pages.about.about');
});

//  DESENVOLVIMENTO DO VASCO - GIL IMPLEMENTAR CSS NA ROTA ABAIXO
 Route::get('/contact', function () {
     return view('pages.contact.contact');
    })->name('contact');

Route::post('/contact', [ContactFormController::class, 'submit']);
Route::get('/event/public', [EventController::class, 'public'])->name('events.public');
Route::get('/event/private',[EventController::class, 'private'])->name('events.private');
//Route::get('/event/{event}', [EventController::class, 'publicDetail'])->name('events.publicDetail');

///// ::::: PUBLIC VIEWS :::::: ///////

///// ::::: LOGIN :::::: ///////
// Route::get('/login', function () {
//     return view('login.login');
// });

Route::get('/register', function (Request $request) {
    return view('register.register');
});

///// ::::: LOGIN :::::: ///////

///// ::::: ROUTES WITH AUTH  :::::: ///////
Route::get('/admin', function () {
    return view('admin');
})->middleware(['auth', 'verified'])->name('admin');

Route::get('/users', function () {
    return view('users');
})->middleware(['auth', 'verified'])->name('users');


///// ::::: ROUTES WITH AUTH - BELLOW :::::: ///////
Route::middleware('auth')->group(function () {

    ///// ::::: USER PROFILE :::::: ///////
    Route::get('/profile',    [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',  [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    ///// ::::: PAYMENTS :::::: ///////
    Route::get('/checkout/{event}', [PaymentController::class, 'checkout'])->name('checkout');
    Route::get('success', [PaymentController::class, 'success'])->name('success');
    Route::get('/checkout/cancel', function () {return 'Pagamento cancelado!';})->name('checkout.cancel');
    Route::get('/payment-list', [PaymentController::class, 'list']);
   
    ///// ::::: EVENTS :::::: ///////  
    Route::get('/events',[EventController::class,'index'])->name('events.index');
    Route::get('/events/create/{id}',[EventController::class,'create'])->name('events.create');

    Route::post('/events',[EventController::class,'store']);
    Route::get('/events/owner',[EventController::class,'eventsbyowner'])->name('events.eventsbyowner');     // LIST EVENTS
    Route::get('/events/manager',[EventController::class,'eventsbymanager'])->name('events.eventsbymanager'); // LIST EVENTS
    Route::get('/events/admin',[EventController::class,'eventsbyadmin'])->name('events.eventsbyadmin');     // LIST EVENTS
    Route::get('/events/owner/{event}',[EventController::class,'showbyowner'])->name('events.showbyowner');
    Route::get('/events/manager/{event}',[EventController::class,'showbymanager'])->name('events.showbymanager');
    Route::get('/events/admin/{event}',[EventController::class,'showbyadmin'])->name('events.showbyadmin');
    Route::get('/events/owner/{event}/edit',[EventController::class,'editbyowner'])->name('events.editbyowner');
    Route::get('/events/manager/{event}/edit',[EventController::class,'editbymanager'])->name('events.editbymanager');
    Route::get('/participants/participant-event-list',[EventController::class,'eventsbyparticipant']);
    
    ///// ::::: PARTICIPANTS :::::: ///////
    Route::get('/participants',[ParticipantController::class, 'index'])->name('participants.index');;
    Route::get('/participants/create',[ParticipantController::class, 'create']);
    Route::post('/participants', [ParticipantController::class, 'store']);
   // Route::get('participants/export', [ParticipantController::class, 'export']);
    Route::get('participants/export/{event}', [ParticipantController::class, 'export']);
    //Route::get('participants', [ParticipantController::class, 'index'])->name('participants.index');
  //  Route::post('participants/import',[ParticipantController::class, 'import'])->name('participants.import');
    Route::post('participants/import/{id}',[ParticipantController::class, 'import'])->name('participants.import');
    Route::get('/participants/{participant}', [ParticipantController::class, 'show']);
    Route::get('/participants/{participant}/edit',[ParticipantController::class, 'edit']);
    Route::get('/participants/{participant}/editState', [ParticipantController::class, 'editState']);
    Route::get('/participants/{participant}/detachParticipant', [ParticipantController::class, 'detachParticipant']);
    Route::put('/participants/{participant}',[ParticipantController::class, 'update']);
    Route::delete('/participants/{participant}',[ParticipantController::class, 'destroy']);
    Route::delete('/participants', [ParticipantController::class, 'eliminate']);


    ///// ::::: INVITATIONS :::::: ///////
    Route::get('/invitations', [InvitationController::class,'index']);
    Route::get('/invitations/create', [InvitationController::class, 'create']);
    Route::post('/invitations', [InvitationController::class,'store']);
    Route::get('/invitations/{invitation}', [InvitationController::class,'show']);
    Route::get('/invitations/{invitation}/edit',[InvitationController::class,'edit']);
    Route::put('/invitations/{invitation}', [InvitationController::class,'update']);
    Route::delete('/invitations/{invitation}',[InvitationController::class,'destroy']);
    Route::delete('/invitations', [InvitationController::class,'eliminate']);
    Route::get('/invitations/{invitation}/pageSendEmail', [InvitationController::class,'pageSendEmail']);
    Route::post('/invitations/submit', [InvitationController::class,'submit']);

    ///// ::::: SUPPLIERS :::::: ///////
    Route::get('/suppliers', [SupplierController::class, 'index'])->name('suppliers.index');
    Route::get('/suppliers/create', [SupplierController::class, 'create']);
    Route::post('/suppliers', [SupplierController::class, 'store'])->name('suppliers.store');
    Route::get('/suppliers/{supplier}', [SupplierController::class,'show']);
    Route::get('/suppliers/{supplier}/edit',[SupplierController::class,'edit']);
    Route::put('/suppliers/{supplier}', [SupplierController::class,'update']);
    Route::delete('/suppliers/{supplier}',[SupplierController::class,'destroy']);
    Route::patch('/suppliers/{supplier}/toggle-status', [SupplierController::class, 'toggleStatus'])->name('suppliers.toggle-status');

    ///// ::::: DASHBOARD :::::: ///////
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('index');

    ///// ::::: USERS :::::: ///////
    Route::get('/users', [UserController::class,'index'])->name('users');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class,'store'])->name('users.store');
    Route::get('/users/{user}', [UserController::class,'show'])->name('users.show');
    Route::get('/users/{user}/edit',[UserController::class,'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class,'update'])->name('users.update');
    Route::delete('/users/{user}',[UserController::class,'destroy'])->name('users.destroy');
    Route::delete('/users', [UserController::class,'eliminate']);
    Route::put('/users/{id}/update-role', [UserController::class, 'updateRole'])->name('users.update-role');
    Route::post('/users/{id}/reset-password', [UserController::class, 'resetPassword'])->name('users.reset-password');

    ///// ::::: CATEGORIES :::::: ///////
    Route::get('/categories', [CategoryController::class,'index']);
    Route::get('/categories/create', [CategoryController::class, 'create']);
    Route::post('/categories', [CategoryController::class,'store']);
    Route::get('/categories/{category}', [CategoryController::class,'show']);
    Route::get('/categories/{category}/edit',[CategoryController::class,'edit']);
    Route::put('/categories/{category}', [CategoryController::class,'update']);
    Route::delete('/categories/{category}',[CategoryController::class,'destroy']);
    Route::delete('/categories', [CategoryController::class,'eliminate']);

    Route::post('/searchEvents', [ParticipantController::class,'searchEvents']);
    Route::get('/searchEventsByOwner', [EventController::class,'searchEventsByOwner']);
    Route::get('/searchEventsByManager', [EventController::class,'searchEventsByManager']);
    ///// ::::: END OF AUTH ROUTES :::::: ///////
});

require __DIR__.'/auth.php';
///// ::::: Google Auth :::::: ///////
Route::get('/login/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('login/google/callback', [GoogleController::class, 'handleGoogleCallback']);
Route::get('/login/google/dob', [GoogleController::class, 'showDobForm'])->name('user.dob');
Route::post('/login/google/dob', [GoogleController::class, 'storeDob']);