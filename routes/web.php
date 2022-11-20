<?php

use Illuminate\Support\Facades\Route;

define('controller_root',"App\Http\Controllers\\");
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
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){
        Route::get('/', function () {
        return view('dashboard');
    });Route::get('/rep', function () {
        return view('form-repeater');
    });
    Route::group(['namespace' => controller_root.'Grades'], function () {
        Route::resource('Grades', 'GradeController');
    });
    Route::group(['namespace' => controller_root.'classrooms'], function () {
        Route::resource('classrooms', 'ClassroomController');
        Route::post('delete_all', 'ClassroomController@delete_all')->name('delete_all');
        Route::post('Filter_Classes', 'ClassroomController@Filter_Classes')->name('Filter_Classes');
    });
    Route::group(['namespace' => controller_root.'Sections'], function () {

        Route::resource('Sections', 'SectionController');

        Route::get('/classes/{id}', 'SectionController@getclasses');

    });
    Route::view('Add_parent', 'livewire.show_Form');
    Route::group(['namespace' => controller_root.'Teachers'], function () {

        Route::resource('Teachers', 'TeacherController');
    });
    Route::group(['namespace' => controller_root.'Students'], function () {


        Route::resource('Students', 'StudentController');
        Route::get('/Get_classrooms/{id}', 'StudentController@Get_classrooms');
        Route::get('/Get_Sections/{id}', 'StudentController@Get_Sections');
        Route::post('Upload_attachment', 'StudentController@Upload_attachment')->name('Upload_attachment');
        Route::get('Download_attachment/{studentsname}/{filename}', 'StudentController@Download_attachment')->name('Download_attachment');
        Route::post('Delete_attachment', 'StudentController@Delete_attachment')->name('Delete_attachment');
        Route::resource('Graduated', 'GraduatedController');
        Route::resource('Promotion', 'PromotionController');
        Route::resource('Fees', 'FeesController');
        Route::resource('Fees_Invoices', 'FeeInvoicesController');



        Route::resource('receipt_students', 'ReceiptStudentsController');
        Route::resource('ProcessingFee', 'ProcessingFeeController');
        Route::resource('Payment_students', 'PaymentController');
        Route::resource('Attendance', 'AttendanceController');
        Route::get('download_file/{filename}', 'LibraryController@downloadAttachment')->name('downloadAttachment');
        Route::resource('library', 'LibraryController');
    });
    });
