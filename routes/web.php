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
use Illuminate\Support\Facades\Route;

///// ::::: PUBLIC VIEWS :::::: ///////
Route::get('/', function () {
       return view('welcome');
});

///// ::::: ABOUT :::::: ///////
Route::get('/about', function () {
    return view('pages.about.about');
});

///// ::::: CONTACT :::::: ///////
Route::get('/contact', function () {
    return view('pages.contact.contact');
});

//  DESENVOLVIMENTO DO VASCO - GIL IMPLEMENTAR CSS NA ROTA ABAIXO
 Route::get('/contact', function () {
     return view('pages.contact.contact');
    })->name('contact');
 Route::post('/contact', [ContactFormController::class, 'submit'])->name('contact');

Route::get('/event',         [EventController::class, 'public'])->name('events.public');
Route::get('/event/{event}', [EventController::class, 'publicDetail'])->name('events.publicDetail');

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
    
    ///// ::::: EVENTS :::::: ///////
    Route::get('/events',        [EventController::class, 'index'])->name('events.index');
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    
    ///// ::::: PARTICIPANTS :::::: ///////
    Route::get('/participants', [ParticipantController::class, 'index']);
    Route::get('/participants/create',[ParticipantController::class, 'create']);
    Route::post('/participants', [ParticipantController::class, 'store']);
    Route::get('participants/export', [ParticipantController::class, 'export']);
    //Route::get('participants', [ParticipantController::class, 'index'])->name('participants.index');
    Route::post('participants/import',[ParticipantController::class, 'import'])->name('participants.import');
    Route::get('/participants/{participant}', [ParticipantController::class, 'show']);
    Route::get('/participants/{participant}/edit',[ParticipantController::class, 'edit']);
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
    Route::post('/invitations', [InvitationController::class,'submit']);
    
    ///// ::::: SUPPLIERS :::::: ///////
    Route::get('/suppliers', [SupplierController::class,'index']);
    Route::get('/suppliers/create', [SupplierController::class, 'create']);
    Route::post('/suppliers', [SupplierController::class,'store']);
    Route::get('/suppliers/{supplier}', [SupplierController::class,'show']);
    Route::get('/suppliers/{supplier}/edit',[SupplierController::class,'edit']);
    Route::put('/suppliers/{supplier}', [SupplierController::class,'update']);
    Route::delete('/suppliers/{supplier}',[SupplierController::class,'destroy']);
    Route::delete('/suppliers', [SupplierController::class,'eliminate']);
    
    ///// ::::: DASHBOARD :::::: ///////
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('index');
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard-index');
    Route::get('/dashboard', [DashboardController::class, 'UserDashboard'])->name('dashboard-user');
    Route::get('/dashboard', [DashboardController::class, 'AdminDashboard'])->name('dashboard-admin');
    Route::get('/dashboard', [DashboardController::class, 'ManagerDashboard'])->name('dashboard-manager');
    Route::get('/dashboard', [DashboardController::class, 'OwnerDashboard'])->name('dashboard-owner');
    ///// ::::: SUPPLIERS :::::: ///////
    Route::get('/users', [UserController::class,'index']);
    Route::get('/users/create', [UserController::class, 'create']);
    Route::post('/users', [UserController::class,'store']);
    Route::get('/users/{user}', [UserController::class,'show']);
    Route::get('/users/{user}/edit',[UserController::class,'edit']);
    Route::put('/users/{user}', [UserController::class,'update']);
    Route::delete('/users/{user}',[UserController::class,'destroy']);
    Route::delete('/users', [UserController::class,'eliminate']);

    ///// ::::: CATEGORIES :::::: ///////
    Route::get('/categories', [CategoryController::class,'index']);
    Route::get('/categories/create', [CategoryController::class, 'create']);
    Route::post('/categories', [CategoryController::class,'store']);
    Route::get('/categories/{category}', [CategoryController::class,'show']);
    Route::get('/categories/{category}/edit',[CategoryController::class,'edit']);
    Route::put('/categories/{category}', [CategoryController::class,'update']);
    Route::delete('/categories/{category}',[CategoryController::class,'destroy']);
    Route::delete('/categories', [CategoryController::class,'eliminate']);

    ///// ::::: END OF AUTH ROUTES :::::: ///////
});

require __DIR__.'/auth.php';
