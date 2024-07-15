<?php

use App\Http\Controllers\AdminControllers\AddStudent;
use App\Http\Controllers\AdminControllers\LoginController;
use App\Http\Controllers\AdminControllers\AttendanceController;
use App\Http\Controllers\AdminControllers\StanderdController;
use App\Http\Controllers\AdminControllers\StudentsController;
use App\Http\Controllers\AdminControllers\StaffController;
use App\Http\Controllers\AdminControllers\AccountController;
use App\Http\Controllers\AdminControllers\DashController;
use App\Http\Controllers\AdminControllers\TasksController;
use App\Http\Controllers\StudentControllers\StudentsController as StdController;
use App\Http\Controllers\StudentControllers\StanderdController as Std;
use App\Http\Controllers\StudentControllers\CheckoutController as Checkout;
use App\Http\Controllers\StudentControllers\PaymentDataController as Payments;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('index');
});

Route::get('/pages/login', function () {
    return view('admin.pages.auth-login-basic');
});

Route::get('/admin/account/connections', function () {
    return view('admin.pages.pages-account-settings-connections');
})->middleware('admin.logged');

Route::get('/students/add-student', function () {
    return vieW('admin.pages.add-student');
})->middleware('admin.logged');

Route::get('/standerd/add-standerd', function () {
    return view('admin.pages.add-standerd');
})->middleware('admin.logged');

Route::get('/staff/add-staff', function () {
    return view('admin.pages.add-staff');
})->middleware('admin.logged', 'isPrincipal');

Route::get('/admin/login', function () {
    return view('admin.auth.auth-login');
})->middleware('hasSession');

Route::get('/admin/password/reset', function () {
    return view('admin.auth.auth-pass-reset');
});

Route::get('/tasks/add-task', function(){
    return view('admin.pages.add-task');
});

Route::get('/admin/data/errors', function(){
    return view('student.errors.errors-empty');
})->name('admin.error');


// Route::get('admin/standerd/get-students', [StanderdController::class, 'AllStudent'])->middleware('admin.logged')->name('get.students');
Route::get('/admin/payment/invoice', [Payments::class, 'PrintInvoice'])->name('admin.print.pdf')->middleware('admin.logged');
Route::get('/find/standerd', [StanderdController::class, 'FindStd']);
Route::get('/attendance/data-table', [AttendanceController::class, 'AttendanceData'])->middleware('admin.logged');
Route::get('/update/{id}', [StudentsController::class, 'UpdateStudent'])->middleware('admin.logged');
Route::get('standerd/delete/{id}', [StanderdController::class, 'DeleteStd'])->middleware('admin.logged');
Route::get('/attendance/take-atd', [AttendanceController::class, 'getStanderds'])->middleware('admin.logged');
Route::get('/action/take-atd', [AttendanceController::class, 'TakeATD'])->middleware('admin.logged');
Route::get('/standerds/data-table', [StanderdController::class, 'Standerds'])->middleware('admin.logged');
Route::get('/students/data-table', [StudentsController::class, 'studentData'])->middleware('admin.logged');
Route::get('/action/delete/{id}', [StudentsController::class, 'deleteStudent'])->middleware('admin.logged');
Route::get('/students/data-table/search', [StudentsController::class, 'searchData'])->middleware('admin.logged');
Route::get('/staff/data-table', [StaffController::class, 'StaffDATA'])->middleware('admin.logged', 'isPrincipal');
Route::get('/password/reset/{token}', [LoginController::class, 'SearchToken']);
Route::get('/admin/students/view/{id}', [StudentsController::class, 'ViewStudent'])->name('view.student')->middleware('admin.logged');
Route::get('/staff/delete/{id}', [StaffController::class, 'deleteStaff'])->middleware('admin.logged');

// Post routes
Route::post('/task/add-task', [TasksController::class, 'AddTask']);
Route::post('/password/update', [LoginController::class, 'UpdatePassword']);
Route::post('/admin/reset-email', [LoginController::class, 'findMAil']);
Route::post('/password/reset', [LoginController::class, 'ResetPassword']);
Route::post('/action/register-student', [AddStudent::class, 'registerStudent']);
// Route::post('search', [StudentsController::class, 'searchData'])->middleware('admin.logged');
Route::post('action/update-atd', [AttendanceController::class, 'updateATD'])->middleware('admin.logged');
Route::post('standerds/delete', [StanderdController::class, 'DeleteBulk'])->middleware('admin.logged');
Route::post('/admin/login', [LoginController::class, 'validateAdmin'])->middleware('hasSession');

//Post Routes..
Route::post('/admin/account/changes', [AccountController::class, 'SaveMessageChanges']);
Route::post('/admin/account/profile', [AccountController::class, 'UpdateProfile']);

//Get Routes
Route::get('/admin/task/delete', [TasksController::class, 'DeleteTask'])->middleware('admin.logged');
Route::get('/admin/tasks/view-tasks', [TasksController::class, 'ViewTasks'])->middleware('admin.logged');
Route::get('/admin/standerd/get-students',[StanderdController::class, 'AllStudent']);
Route::get('/admin/payments/view',[StudentsController::class, 'paymentData'])->middleware('admin.logged')->name('view.payment');
Route::get('/admin/dashboard', [DashController::class, 'RedirectDash'])->middleware('admin.logged');
Route::get('/admin/account/profile', [AccountController::class, 'SettingsProfile'])->middleware('admin.logged');
Route::get('/admin/account/notifications', [AccountController::class, 'SettingNotification'])->middleware('admin.logged');
Route::get('/admin/logout', [LoginController::class, 'LogoutAdmin'])->middleware('admin.logged');

//Action Route Groups
Route::post('/action/take-atd', [AttendanceController::class, 'SubmitAtd']);
Route::post('/action/add-standerd', [StanderdController::class, 'AddStanderd']);
Route::post('/action/delete', [StudentsController::class, 'DeleteBulk']);
Route::post('/action/add-student', [AddStudent::class, 'AddStudent']);
Route::post('/action/update-student', [StudentsController::class, 'UpdateEnd']);
Route::post('/action/add-staff', [StaffController::class, 'AddStaff']);

/*
|--------------------------------------------------------------------------
| Student Routes
|--------------------------------------------------------------------------
|
| From Here All The Student Route Will Be Accessable
|
*/


Route::get('/student/register', function () {
    return view('admin.auth.auth-register');
})->middleware('student.redirect');

Route::get('/student/login', function(){
    return view('student.auth.student-auth');
})->name('student.auth')->middleware('student.redirect');

Route::get('/student/auth/verification-details', function(){
    return view('student.auth.verification-details');
});

Route::get('students/payment/pay-fee', function(){
    return view('student.payments.pay-fee');
});

Route::get('/load', function(){
    return view('student.pages.page-load');
})->name('page.load');

Route::get('/student/errors', function(){
    return view('student.errors.errors-empty');
})->name('error.data');

//Post Routes
// Route::group(function(){

// })->middleware();

Route::post('/student/login', [StdController::class, 'ValidateStudent']);
Route::post('student/find/standerd', [Std::class, 'FindStd']);
Route::post('/student/verifications/update-standerd', [Std::class, 'VerifyStd']);
Route::post('/student/verifications/update-division', [Std::class, 'VerifyDiv']);
Route::post('/student/verifications/update-details', [StdController::class, 'VerifyDetails']);
Route::post('/students/payment/processed', [Checkout::class, 'GenerateCheckout']);
Route::post('/student/account/profile', [StdController::class, 'UpdateStudent']);

// Get Routes
// Route::get('', [Std::class, 'AvailableStanderd']);
Route::get('/student/account/profile', [StdController::class, 'studentProfile'])->name('student.profile')->middleware('student.logged');
Route::get('/student/payment/invoice', [Payments::class, 'PrintInvoice'])->name('print.pdf')->middleware('student.logged');
Route::get('/student/payment/payment-history', [Checkout::class, 'MyPaymentData'])->middleware('student.logged');
Route::get('/student/payment/complete', [Checkout::class, 'CheckoutComplete'])->middleware('student.logged');
Route::get('/student/verifications/status', [Std::class, 'GetStatus'])->middleware('student.logged');
Route::get('/student/available-standerds', [Std::class, 'AvailableStanderd'])->middleware('student.logged');
Route::get('/student/logout', [StdController::class, 'StudentLogOut'])->middleware('student.logged');
Route::get('/student/dashboard', [StdController::class, 'StudentData'])->middleware('student.logged');
Route::get('/student/payments',[Payments::class, 'paymentData'])->middleware('student.logged');
