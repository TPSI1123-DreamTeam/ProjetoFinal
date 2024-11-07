<?php
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\SupplierController;
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
// Route::get('/contact', function () {
//     return view('contact');
//  })->name('contact');
 // Route::post('/contact', [ContactFormController::class, 'submit'])->name('contact.submit');

Route::post('/contact', 'App\Http\Controllers\ContactFormController@submit');
Route::get('/event',         [EventController::class, 'public'])->name('events.public');
Route::get('/event/{event}', [EventController::class, 'publicDetail'])->name('events.publicDetail');

///// ::::: PUBLIC VIEWS :::::: ///////

///// ::::: LOGIN :::::: ///////
Route::get('/login', function () {
    return view('login.login');
});

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


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

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

    // Rota para o método checkout do PaymentController
    Route::get('/checkout/{event}', [PaymentController::class, 'checkout']);

    Route::get('/checkout/success', [PaymentController::class, 'checkout'],
    function () {
        return 'Pagamento efetuado com sucesso!';
    })->name('checkout.success');

    Route::get('/checkout/cancel', [PaymentController::class, 'checkout'],
     function () {
        return 'Pagamento cancelado!';
    })->name('checkout.cancel');

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

    ///// ::::: SUPPLIERS :::::: ///////
    Route::get('/suppliers', [SupplierController::class,'index']);
    Route::get('/suppliers/create', [SupplierController::class, 'create']);
    Route::post('/suppliers', [SupplierController::class,'store']);
    Route::get('/suppliers/{supplier}', [SupplierController::class,'show']);
    Route::get('/suppliers/{supplier}/edit',[SupplierController::class,'edit']);
    Route::put('/suppliers/{supplier}', [SupplierController::class,'update']);
    Route::delete('/suppliers/{supplier}',[SupplierController::class,'destroy']);
    Route::delete('/suppliers', [SupplierController::class,'eliminate']);
    
    ///// ::::: END OF AUTH ROUTES :::::: ///////
});

require __DIR__.'/auth.php';