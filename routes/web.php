<?php

use App\Models\User;
use App\Events\NewReservationEvent;
use App\Events\RefreshDashboardEvent;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\TransactionRoomReservationController;
use App\Http\Controllers\RoomStatusController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\HotelWebsiteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OnlineReservationController;
use Illuminate\Support\Facades\Route;

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
    return view('website/home');
});


Route::get('/about' , [HotelWebsiteController::class , 'about'])->name('about');
Route::get('/blog' , [HotelWebsiteController::class , 'blog'])->name('blog');
Route::get('/contact' , [HotelWebsiteController::class , 'contact'])->name('contact');
Route::get('/gallery' , [HotelWebsiteController::class , 'gallery'])->name('gallery');
Route::get('/ourRoom' , [HotelWebsiteController::class , 'ourRoom'])->name('ourRoom');

//contact us routes
Route::post('/contact' , [ContactController::class , 'store'])->name('contact.store');




Route::name('reservationOnline.reservation.')->group(function () {
    Route::get('/createIdentityOnline', [OnlineReservationController::class, 'createIdentity'])->name('createIdentity');
    Route::get('/pickFromCustomerOnline', [OnlineReservationController::class, 'pickFromCustomer'])->name('pickFromCustomer');
    Route::post('/storeCustomerOnline', [OnlineReservationController::class, 'storeCustomer'])->name('storeCustomer');
    Route::get('/{customer}/viewCountPersonOnline', [OnlineReservationController::class, 'viewCountPerson'])->name('viewCountPerson');
    Route::get('/{customer}/chooseRoomOnline', [OnlineReservationController::class, 'chooseRoom'])->name('chooseRoom');
    Route::get('/{customer}/{room}/{from}/{to}/confirmationOnline', [OnlineReservationController::class, 'confirmation'])->name('confirmation');
    Route::post('/{customer}/{room}/payDownPaymentOnline', [OnlineReservationController::class, 'payDownPayment'])->name('payDownPayment');
});


Route::group(['middleware' => ['auth', 'checkRole:Super']], function () {
    Route::resource('user', UserController::class);
});

Route::group(['middleware' => ['auth', 'checkRole:Super,Admin']], function () {
    Route::post('/room/{room}/image/upload', [ImageController::class, 'store'])->name('image.store');
    Route::delete('/image/{image}', [ImageController::class, 'destroy'])->name('image.destroy');

    Route::name('transaction.reservation.')->group(function () {
        Route::get('/createIdentity', [TransactionRoomReservationController::class, 'createIdentity'])->name('createIdentity');
        Route::get('/pickFromCustomer', [TransactionRoomReservationController::class, 'pickFromCustomer'])->name('pickFromCustomer');
        Route::post('/storeCustomer', [TransactionRoomReservationController::class, 'storeCustomer'])->name('storeCustomer');
        Route::get('/{customer}/viewCountPerson', [TransactionRoomReservationController::class, 'viewCountPerson'])->name('viewCountPerson');
        Route::get('/{customer}/chooseRoom', [TransactionRoomReservationController::class, 'chooseRoom'])->name('chooseRoom');
        Route::get('/{customer}/{room}/{from}/{to}/confirmation', [TransactionRoomReservationController::class, 'confirmation'])->name('confirmation');
        Route::post('/{customer}/{room}/payDownPayment', [TransactionRoomReservationController::class, 'payDownPayment'])->name('payDownPayment');
    });


    //report sidebar routes
    Route::get('/reservation/report' , [ReportController::class , 'reservationReport'])->name('reservationReport');
    Route::get('/report/GuestReport' , [ReportController::class , 'guestReport'])->name('guestReport');


   

    Route::resource('customer', CustomerController::class);
    Route::resource('type', TypeController::class);
    Route::resource('room', RoomController::class);
    Route::resource('roomstatus', RoomStatusController::class);
    Route::resource('transaction', TransactionController::class);
    Route::resource('reports', ReportController::class);

    Route::resource('facility', FacilityController::class);

    Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');
    Route::get('/report/BalanceReport', [ReportController::class, 'balanceReport'])->name('report.balanceReport');
    Route::get('/payment/{payment}/E-receipt', [PaymentController::class, 'invoice'])->name('payment.invoice');

    Route::get('/transaction/{transaction}/payment/create', [PaymentController::class, 'create'])->name('transaction.payment.create');
    Route::post('/transaction/{transaction}/payment/store', [PaymentController::class, 'store'])->name('transaction.payment.store');

    Route::get('/get-dialy-guest-chart-data', [ChartController::class, 'dialyGuestPerMonth']);
    Route::get('/get-dialy-guest/{year}/{month}/{day}', [ChartController::class, 'dialyGuest'])->name('chart.dialyGuest');
});

Route::group(['middleware' => ['auth', 'checkRole:Super,Admin,Customer']], function () {
    Route::resource('user', UserController::class)->only([
        'show'
    ]);

    Route::view('/notification', 'notification.index')->name('notification.index');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/mark-all-as-read', [NotificationsController::class, 'markAllAsRead'])->name('notification.markAllAsRead');

    Route::get('/notification-to/{id}',[NotificationsController::class, 'routeTo'])->name('notification.routeTo');
});

Route::view('/login', 'auth.login')->name('login');
Route::post('/postLogin', [AuthController::class, 'postLogin'])->name('postlogin');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/sendEvent', function () {
    $superAdmins = User::where('role', 'Super')->get();
    event(new RefreshDashboardEvent("Someone reserved a room"));

    foreach ($superAdmins as $superAdmin) {
        $message = 'Reservation added by';
        // event(new NewReservationEvent($message, $superAdmin));
    }
});
