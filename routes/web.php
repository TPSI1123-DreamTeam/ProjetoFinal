<?php
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

///// ::::: PUBLIC VIEWS :::::: ///////
Route::get('/', function () {
    return view('welcome');
});

// Rota para a página de contacto

Route::get('/contact', function () {
   return view('contact');
})->name('contact');
// Route::post('/contact', [ContactFormController::class, 'submit'])->name('contact.submit');

Route::post('/contact', 'App\Http\Controllers\ContactFormController@submit');

// Rota para o método checkout do PaymentController
Route::get('/checkout', [PaymentController::class, 'checkout']);

Route::get('/checkout/success', function () {
    return 'Pagamento efetuado com sucesso!';
})->name('checkout.success');

Route::get('/event', [EventController::class, 'public'])->name('events.public');
Route::get('/event/{event}', [EventController::class, 'publicDetail'])->name('events.publicDetail');
// Route::get('/event', function () {
//     return view('events');
// });

///// ::::: PUBLIC VIEWS :::::: ///////



// Rota para o método checkout do PaymentController


///// ::::: LOGIN :::::: ///////
Route::get('/login', function () {
    return view('login.login');
});

Route::get('/register', function (Request $request) {
    return view('register.register');
});

///// ::::: CONTACT :::::: ///////
Route::get('/contact', function () {
    return view('pages.contact.contact');
});

///// ::::: ABOUT :::::: ///////
Route::get('/about', function () {
    return view('pages.about.about');
});

///// ::::: LOGIN :::::: ///////

Route::get('/admin', function () {
    return view('admin');
})->middleware(['auth', 'verified'])->name('admin');

Route::get('/users', function () {
    return view('users');
})->middleware(['auth', 'verified'])->name('users');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    ///// ::::: LOGIN :::::: ///////
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
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

});

require __DIR__.'/auth.php';


///// ::::: PARTICIPANTS :::::: ///////

Route::get('/participants', 'App\Http\Controllers\ParticipantController@index');
Route::get('/participants/create', 'App\Http\Controllers\ParticipantController@create');
Route::post('/participants', 'App\Http\Controllers\ParticipantController@store');

Route::get('participants/export', 'App\Http\Controllers\ParticipantController@export');

Route::get('participants', 'App\Http\Controllers\ParticipantController@index')->name('participants.index');
Route::post('participants/import', 'App\Http\Controllers\ParticipantController@import')->name('participants.import');


Route::get('/participants/{participant}', 'App\Http\Controllers\ParticipantController@show');
Route::get('/participants/{participant}/edit', 'App\Http\Controllers\ParticipantController@edit');
Route::put('/participants/{participant}', 'App\Http\Controllers\ParticipantController@update');
Route::delete('/participants/{participant}', 'App\Http\Controllers\ParticipantController@destroy');
Route::delete('/participants', 'App\Http\Controllers\ParticipantController@eliminate');


///// ::::: INVITATIONS :::::: ///////

Route::get('/invitations', 'App\Http\Controllers\InvitationController@index');
Route::get('/invitations/create', 'App\Http\Controllers\InvitationController@create');
Route::post('/invitations', 'App\Http\Controllers\InvitationController@store');
Route::get('/invitations/{invitation}', 'App\Http\Controllers\InvitationController@show');
Route::get('/invitations/{invitation}/edit', 'App\Http\Controllers\InvitationController@edit');
Route::put('/invitations/{invitation}', 'App\Http\Controllers\InvitationController@update');
Route::delete('/invitations/{invitation}', 'App\Http\Controllers\InvitationController@destroy');
Route::delete('/invitations', 'App\Http\Controllers\InvitationController@eliminate');
///// ::::: EVENTS :::::: ///////

// Route::middleware('auth')->group(function () {

// });

// Route::get('/events', function () {
//     // ...
// })->middleware('auth:api');
