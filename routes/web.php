<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AFOController;
use App\Http\Controllers\SROController;
use App\Http\Controllers\AAROController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DraftController;
use App\Http\Controllers\RejectController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApprovedController;
use App\Http\Controllers\DataFlowController;
use App\Http\Controllers\AgreementController;
use App\Http\Controllers\OfferLetterController;
use App\Http\Controllers\RejectReasonController;
use App\Http\Controllers\ParentProfileController;
use App\Http\Controllers\AcademicDetailController;
use App\Http\Controllers\ApplyProgrammeController;
use App\Http\Controllers\ProfilePictureController;
use App\Http\Controllers\ProgrammeOfferController;
use App\Http\Controllers\StatusOfHealthController;
use App\Http\Controllers\PersonalProfileController;
use App\Http\Controllers\EmergencyContactController;
use App\Http\Controllers\ApplicationRemarkController;
use App\Http\Controllers\DeleteApplicationController;
use App\Http\Controllers\SupportingDocumentController;
use App\Http\Controllers\ApplicationProgressController;
use App\Http\Controllers\ResubmitPaymentSlipController;
use App\Http\Controllers\SupportingDocumentCrudController;

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
    return view('welcome');
});

Route::get('/help', function () {
    return view('oas.student.faq');
});

Route::get('/offer_letter', function () {
    return view('oas.admin.offer_letter.home');
});

Route::controller(HomeController::class)->middleware(['auth', 'verified', 'role:LOCAL_STUDENT'])->prefix('/dashboard')->group(function (){
    Route::get('/', 'stuDashboard')->name('stu.dashboard');
});

Route::controller(HomeController::class)->middleware(['auth', 'verified', 'role:AFO|AARO|SRO|ISO|SUPER_ADMIN|ADMIN'])->prefix('/admin-dashboard')->group(function (){
    Route::get('/', 'adminDashboard')->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(PersonalProfileController::class)->middleware('auth')->prefix('/applicant-profile/personal-profile')->name('personalProfile.')->group(function() {
    Route::get('/', 'index')->name('home');
    Route::post('/create', 'create')->name('create');
    Route::get('/edit', 'edit')->name('edit');
    Route::post('/update', 'update')->name('update');
});

Route::controller(ParentProfileController::class)->middleware('auth')->prefix('/applicant-profile/parent-profile')->name('parentProfile.')->group(function() {
    Route::get('/', 'index')->name('home');
    Route::post('/create', 'create')->name('create');
    Route::get('/edit', 'edit')->name('edit');
    Route::post('/update', 'update')->name('update');
});

Route::controller(EmergencyContactController::class)->middleware('auth')->prefix('/applicant-profile/emergency-contact')->name('emergencyContact.')->group(function() {
    Route::get('/', 'index')->name('home');
    Route::post('/create', 'create')->name('create');
    Route::get('/edit', 'edit')->name('edit');
    Route::post('/update', 'update')->name('update');
});

Route::controller(ProfilePictureController::class)->middleware('auth')->prefix('/applicant-profile/profile-picture')->name('profilePicture.')->group(function() {
    Route::get('/', 'index')->name('home');
    Route::post('/create', 'create')->name('create');
    Route::get('/edit', 'edit')->name('edit');
    Route::post('/update', 'update')->name('update');
    Route::post('/TmpUpload','TmpUpload')->name('TmpUpload');
    Route::delete('/TmpDelete','TmpDelete')->name('TmpDelete');
});

Route::controller(ApplyProgrammeController::class)->middleware('auth')->prefix('/programme-select')->name('programmeSelect.')->group(function(){
    Route::get('/newapplication', 'newApplication')->name('newApplication');
    Route::post('/create','create')->name('create');
    Route::get('/{id}', 'index')->name('home');
    Route::post('/update/{id}', 'update')->name('update');
    Route::post('/quickUpdate/{id}','quickUpdate')->name('quickUpdate');
});

Route::controller(AcademicDetailController::class)->middleware('auth')->prefix('/academic-detail')->name('academicDetail.')->group(function () {
    Route::get('/{id}', 'index')->name('home');
    Route::post('/create/{id}', 'create')->name('create');
    Route::post('/update/{id}', 'update')->name('update');
});

Route::controller(StatusOfHealthController::class)->middleware('auth')->prefix('/status-of-health')->name('statusOfHealth.')->group(function () {
    Route::get('/{id}', 'index')->name('home');
    Route::post('/create/{id}', 'create')->name('create');
    Route::post('/update/{id}', 'update')->name('update');
});

Route::controller(AgreementController::class)->middleware('auth')->prefix('/agreements')->name('agreements.')->group(function () {
    Route::get('/{id}', 'index')->name('home');
    Route::post('/submit/{id}', 'submit')->name('submit');
});

Route::controller(DraftController::class)->prefix('/draft')->name('draft.')->group(function () {
    Route::get('/{id}', 'index')->name('home');
    Route::post('/create/{id}', 'create')->name('create');
});

Route::controller(SupportingDocumentController::class)->prefix('/supporting-document')->name('supportingDocument.')->group(function () {
    Route::get('/{id}', 'index')->name('home');
    Route::post('/create/{id}', 'create')->name('create');
    Route::post('/tmp-upload','tmpUpload')->name('tmpUpload');
    Route::delete('/tmp-delete','tmpDelete')->name('tmpDelete');
});

Route::controller(PaymentController::class)->prefix('/payment')->name('payment.')->group(function () {
    Route::get('/{id}', 'index')->name('home');
    Route::post('/create/{id}', 'create')->name('create');
    Route::post('/tmp-upload','tmpUpload')->name('tmpUpload');
    Route::delete('/tmp-delete','tmpDelete')->name('tmpDelete');
});

Route::controller(FormController::class)->prefix('/application-form')->name('applicationForm.')->group(function () {
    Route::get('/{id}', 'index')->name('home');
    Route::get('/payment/{id}','getPayment')->name('getPayment');
});

// admin 
Route::controller(AFOController::class)->prefix('/afo/dashboard')->middleware(['role:AFO|SUPER_ADMIN'])->name('afo.')->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/pending-verify-payment-slip', 'viewPendingVerifyPaymentList')->name('pendingVerifyPaymentList');
});

Route::controller(SROController::class)->prefix('/sro/dashboard')->middleware(['role:SRO|ISO|SUPER_ADMIN'])->name('sro.')->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/list', 'viewList')->name('list');
});


Route::controller(AAROController::class)->name('aaro.')->middleware(['role:AARO|SUPER_ADMIN'])->prefix('/aaro/dashboard')->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/list', 'viewList')->name('list');
    Route::get('/upload_offer_letter', 'viewOfferLetter')->name('upload');
});

Route::controller(ProgrammeOfferController::class)->middleware(['auth', 'role:AARO|SUPER_ADMIN', 'permission:create offeredProgramme'])->prefix('/aaro/dashboard/offered-programme')->name('programmeOffered.')->group(function() {
    Route::get('/add', 'index')->name('home');
    Route::get('/list', 'showList')->name('showList');
    Route::post('/add', 'create')->name('add');
});

Route::controller(SupportingDocumentCrudController::class)->prefix('displaydocument/')->name('displaydocument.')->group(function(){
    Route::get('/displaySingleApplicationSupportingDocumentForAARO/{id}', 'displaySingleApplicationSupportingDocumentForAARO')->name('displaySingleApplicationSupportingDocumentForAARO');
    Route::get('/displaySingleDocument/{id}/{maindirectory}', 'displaySingleDocument')->name('displaySingleDocument');
    Route::get('/displaySingleIdentityDocument/{id}/{maindirectory}', 'displaySingleIdentityDocument')->name('displaySingleIdentityDocument');
});

Route::controller(DeleteApplicationController::class)->prefix('delete/')->name('delete.')->group(function () {
    Route::get('/{id}', 'DeleteApplication')->name('DeleteApplication');
});

Route::controller(ApplicationProgressController::class)->prefix('/application-progress')->name('applicationProgress.')->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/offer_letter/{id}','getOfferLetter')->name('getOfferLetter');
});

Route::controller(ApplicationRemarkController::class)->prefix('/add-remark')->name('remark.')->group(function (){
    Route::get('/{id}', 'index')->name('home');
    Route::post('/create', 'create')->name('create');
});

Route::controller(RejectReasonController::class)->prefix('/add-reject-reason')->name('reject.')->group(function (){
    Route::get('/{id}', 'index')->name('home');
    Route::post('/create', 'create')->name('create');
});

Route::controller(ApprovedController::class)->prefix('/approve')->name('approve.')->group(function(){
    Route::get('/afo/{id}','AFO')->name('AFO');
    Route::get('/aaro/{id}','AARO')->name('AARO');
    Route::get('/sro/{id}','SRO')->name('SRO');
    Route::get('/successBecomeStudent/{id}','SuccessBecomeStudent')->name('stu');
});

Route::controller(RejectController::class)->prefix('/reject')->name('reject.')->group(function(){
    Route::post('/afo','AFO')->name('AFO');
    Route::post('/aaro','AARO')->name('AARO');
    Route::post('/sro','SRO')->name('SRO');
});

Route::controller(ResubmitPaymentSlipController::class)->prefix('/application-progress/resubmit-payment-slip')->name('resubmitPayment.')->middleware('auth')->group(function (){
    Route::get('/{id}', 'home')->name('home');
    Route::post('/submit/{id}', 'resubmit')->name('resubmit');
    Route::post('/tmp-upload','tmpUpload')->name('tmpUpload');
    Route::delete('/tmp-delete','tmpDelete')->name('tmpDelete');
});

Route::controller(OfferLetterController::class)->prefix('/letter')->name('offer_letter.')->group(function () {
    Route::get('/{id}', 'index')->name('home');
    Route::post('/create/{id}', 'create')->name('create');
    Route::post('/tmp-upload','tmpUpload')->name('tmpUpload');
    Route::delete('/tmp-delete','tmpDelete')->name('tmpDelete');
});

Route::get('getConversationMessage', [ApplicationRemarkController::class,'getConversationMessage']);

require __DIR__.'/auth.php';
