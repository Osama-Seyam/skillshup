<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ExamController as AdminExamController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\SkillController as AdminSkillController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Web\SkillController;
use App\Http\Controllers\Web\CategoryController;
use App\Http\Controllers\Web\ContactController;
use App\Http\Controllers\Web\ExamController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LangController;

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

// Web Routes
Route::middleware('lang')->group(function (){
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/categories/show/{id}', [CategoryController::class, 'show']);
    Route::get('/skills/show/{id}', [SkillController::class, 'show']);
    Route::get('/exams/show/{id}', [ExamController::class, 'show']);
    Route::get('/exams/questions/{id}', [ExamController::class, 'questions'])->middleware(['auth','student']);
    Route::get('/contact', [ContactController::class, 'index']);
    Route::get('/profile', [ProfileController::class, 'index'])->middleware(['auth','student']);
});

Route::post('/exams/start/{id}', [ExamController::class, 'start'])->middleware(['auth','student','can-enter-exam']);
Route::post('/exams/submit/{id}', [ExamController::class, 'submit'])->middleware(['auth','student']);

Route::post('/contact/message/send', [ContactController::class, 'send']);
Route::get('/lang/set/{lang}', [LangController::class, 'set']);


// Dashboard routes
route::prefix('dashboard')->middleware('auth','can-enter-dashboard')->group(function(){
    Route::get('/', [AdminHomeController::class,'index']);

    // Categories
    Route::resource('categories' ,AdminCategoryController::class)->except(['edit' , 'show']);
    Route::get('/categories/toggle/{category}', [AdminCategoryController::class,'toggle']);

    // Skills
    Route::resource('skills' ,AdminSkillController::class)->except(['edit' , 'show']);;
    Route::get('/skills/toggle/{skill}', [AdminSkillController::class,'toggle']);

    // Exams
    Route::resource('exams' ,AdminExamController::class);
    Route::get('/exams/toggle/{exam}', [AdminExamController::class,'toggle']);

    // Questions
    Route::get('/exams/show-questions/{exam}', [AdminExamController::class,'showQuestions']);
    Route::get('/exams/create-questions/{exam}', [AdminExamController::class,'createQuestions']);
    Route::post('/exams/store-questions/{exam}', [AdminExamController::class,'storeQuestions']);
    Route::get('/exams/edit-questions/{exam}/{question}', [AdminExamController::class,'editQuestions']);
    Route::put('/exams/update-questions/{exam}/{question}', [AdminExamController::class,'updateQuestions']);

    // Students
    Route::resource('students' ,StudentController::class)->except(['edit' , 'destroy' , 'store' , 'create' , 'update']);;
    Route::get('students/open-exam/{studentId}/{examId}' ,[StudentController::class,'open']);
    Route::get('students/close-exam/{studentId}/{examId}' ,[StudentController::class,'close']);

    // Admins
    Route::middleware('superadmin')->group(function(){
        Route::resource('admins' ,AdminController::class)->except(['show', 'update' , 'destroy' , 'edit']);
        Route::get("/admins/promote/{id}" , [AdminController::class, 'promote']);
        Route::get("/admins/demote/{id}" , [AdminController::class, 'demote']);
    });

    //Messages
    Route::resource('messages' ,MessageController::class)->except(['store','create' , 'update' , 'destroy' , 'edit']);;
    Route::post('/messages/response/{message}', [MessageController::class , 'response']);
});
