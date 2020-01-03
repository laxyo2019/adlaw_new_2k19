<?php

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

// Route::get('/', function(){
// 	abort(404);
// })->name('/');


Route::get('/','HomeController@index')->name('/');
Auth::routes();

Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');
Route::get('/state','HomeController@getStateList')->name('state');
Route::get('/city_fetch', 'HomeController@getCityList')->name('city');
Route::get('/cityDropDown', 'HomeController@getCityListDropDown')->name('cityDropDown');
Route::get('/cityDropDownClient', 'HomeController@getCityListClientDropDown')->name('cityDropDownClient');
Route::post('/courtTypeFilter','HomeController@courtTypeFilter')->name('courtTypeFilter');
Route::get('/court_category/{id}','HomeController@court_category');

Route::get('/case_subcategory', 'HomeController@case_subcategory');
Route::get('/get_all_users', 'HomeController@get_all_users')->name('get_all_users');

Route::post('/book_an_appointment','BookingController@book_an_appointment')->name('book_an_appointment');

Route::resource('/contact','ContactController');
Route::get('/refreshCaptcha','ContactController@refreshCaptcha')->name('contact.refreshCaptcha');
Route::get('/display_blogs/{id}', 'BlogController@show_blogs')->name('display_blogs');
Route::get('/more_articles','BlogController@more_articles')->name('more_articles');
Route::get('/notifications','HomeController@all_notifications')->name('all_notifications');
Route::get('/notification_read/{id}','HomeController@notification_read')->name('notification_read');


/*Start Pages View */

// Route::view('/law_data_mining','pages.law_data_mining');
// Route::view('/law_data_warehousing','pages.law_data_warehousing');
// Route::view('/law_data_analytics','pages.law_data_analytics');
// Route::view('/online_appointment','pages.online_appointment');
// Route::view('/advance_dms','pages.advance_dms');
// Route::view('/law_crm','pages.law_crm');
// Route::view('/case_law_analysis','pages.case_law_analysis');
// Route::view('/integrated_law_research','pages.integrated_law_research');
// Route::view('/legal_article_written','pages.legal_article_written');\
// Route::view('/court','pages.court');
// Route::view('/faq','pages.faq');

Route::view('/tos','pages.subpages.tos');
Route::view('/about_us','pages.subpages.about_us');
Route::view('/disclaimer','pages.subpages.disclaimer');
Route::view('/privacy_policy','pages.subpages.privacy_policy');
Route::view('/why_adlaw','pages.subpages.why_adlaw');


Route::group(['prefix' => 'features/lawfirms'] ,function(){
	Route::view('/','pages.subpages.lawfirms_features')->name('lawfirms');

	Route::view('/case_management','pages.features.subpages.lawfirms.case_management')->name('features.case_management');
	Route::view('/client_management','pages.features.subpages.lawfirms.client_management')->name('features.client_management');
	Route::view('/calendar_management','pages.features.subpages.lawfirms.calendar_management')->name('features.calendar_management');
	Route::view('/document_management','pages.features.subpages.lawfirms.document_management')->name('features.document_management');
	Route::view('/appointment_schedule','pages.features.subpages.lawfirms.appointment_schedule')->name('features.appointment_schedule');
	Route::view('/schedule_management','pages.features.subpages.lawfirms.schedule_management')->name('features.schedule_management');
	Route::view('/agenda_management','pages.features.subpages.lawfirms.agenda_management')->name('features.agenda_management');
	Route::view('/chat_or_messanger','pages.features.subpages.lawfirms.chat_or_messanger')->name('features.chat_or_messanger');
	Route::view('/team_management','pages.features.subpages.lawfirms.team_management')->name('features.team_management');
	Route::view('/profile_management','pages.features.subpages.lawfirms.profile_management')->name('features.profile_management');
	Route::view('/todo_management','pages.features.subpages.lawfirms.todo_management')->name('features.todo_management');
	Route::view('/hearing_management','pages.features.subpages.lawfirms.hearing_management')->name('features.hearing_management');

});	


Route::group(['prefix' => 'features/lawschools'] ,function(){	

	Route::get('/','Search\SearchController@lawSchools')->name('lawschools');
	Route::get('/search','Search\SearchController@lawschoolsSearch')->name('lawschools.search');
	Route::get('/profile/{id}', 'Search\SearchController@lawschoolsprofileShow')->name('lawschoolsprofile.show');

	Route::view('/course_management','pages.features.subpages.lawschools.course_management')->name('lawschools.course_management');
	Route::view('/profile_management','pages.features.subpages.lawschools.profile_management')->name('lawschools.profile_management');
	Route::view('/student_management','pages.features.subpages.lawschools.student_management')->name('lawschools.student_management');
	Route::view('/document_management','pages.features.subpages.lawschools.document_management')->name('lawschools.document_management');
	Route::view('/team_management','pages.features.subpages.lawschools.team_management')->name('lawschools.team_management');
	Route::view('/agenda_management','pages.features.subpages.lawschools.agenda_management')->name('lawschools.agenda_management');

});


Route::group(['prefix' => 'features/guest'] ,function(){	
	Route::get('/','Search\SearchController@lawfirms')->name('guest');
	Route::get('/search','Search\SearchController@lawfirmsSearch')->name('lawfirms.search');
	Route::post('/review','Search\SearchController@writeReview')->name('lawfirms.writeReview');
	Route::get('/profile/{id}', 'Search\SearchController@lawfirmsprofileShow')->name('lawfirmsprofile.show');	
	Route::view('/profile_management','pages.features.subpages.guest.profile_management')->name('guest.profile_management');
	Route::view('/search_lawyer','pages.features.subpages.guest.search_lawyer')->name('guest.search_lawyer');
});


// Route::resource('/admin/users', 'Admin\UsersController');
// Route::get('/admin/send-credentials/{id}','UsersController@sendCredentials');


/*End Pages View */

/* ---------------------Admin--------------------------------- */
Route::group(['middleware' => ['role:admin']], function() {

	Route::get('/admin','Admin\AdminController@index')->name('admin.index');
	Route::get('/reviews','Admin\AdminController@pending_reviews')->name('admin.pending_reviews');
	Route::get('/admin/{review_id}/active_pending_reviews','Admin\AdminController@active_pending_reviews')->name('admin.active_pending_reviews');
	Route::get('/admin/decline_pending_reviews/{review_id}','Admin\AdminController@decline_pending_reviews')->name('admin.decline_pending_reviews');
	Route::post('/admin/active_all_reviews','Admin\AdminController@active_all_reviews')->name('admin.active_all_reviews');
	Route::post('/admin/decline_all_reviews','Admin\AdminController@decline_all_reviews')->name('admin.decline_all_reviews');
	Route::resource('/blog','BlogController');
	Route::get('/blogger','Admin\AdminController@bloguser')->name('admin.bloguser');
	Route::post('/blogpremission','Admin\AdminController@blogpremission')->name('admin.blogpremission');

	Route::get('/contact_details','Admin\AdminController@contact_details')->name('admin.contact_details');

// Start Master module

Route::group(['prefix' => 'master', 'namespace' => 'Admin\Master'], function ()  {

	Route::group(['prefix' => 'location'], function ()  {
		Route::resource('/country','CountryController');
		Route::resource('/city','CityController');
		Route::resource('/state','StateController');
		Route::post('/state/countryFilter','StateController@countryFilter')->name('master.countryFilter');
		Route::post('/city/cityfilter','CityController@cityfilter')->name('master.cityfilter');
	});

	Route::resource('/slots','SlotsController');	
	Route::resource('/payment_mode','PaymentModeController');	
	Route::resource('/religion','ReligionController');	
	Route::resource('/relation','RelationController');	
	Route::resource('/profession','ProfessionMastController');	
	Route::resource('/reservation','ReservationClassController');	
	Route::resource('/designation','DesignationMastController');	

	Route::group(['prefix' => 'specialization'], function ()  {
		Route::resource('/spec_category','SpecCategoryController');
		Route::resource('/spec_subcategory','SpecSubCategoryController');
		Route::post('/subCategoryFilter','SpecSubCategoryController@subCategoryFilter')->name('spec_subCategoryFilter');
	});

	Route::group(['prefix' => 'qualification'], function ()  {
		Route::resource('/qual_category','QualCategoryController');
		Route::resource('/qual_subcategory','QualSubCategoryController');
		Route::resource('/qual_doc_type','QualDocTypeController');
		Route::resource('/qual_doc_mast','QualDocMastController');
		Route::post('/qual_subCategoryFilter','QualSubCategoryController@subCategoryFilter')->name('qual_subCategoryFilter');	
	});

	Route::resource('/court/court_category','CourtCategoryController');
	Route::resource('/court/court_subcategory','CourtSubCategoryController');	
	Route::resource('/case_type','CaseTypeController');
	Route::post('/case_type/courtFilter','CaseTypeController@courtFilter')->name('courtFilter');
	// Route::resource('/master/user','Admin\Master\UserController');
// End Master

	});
});
/* --------------------Admin---------------------------------- */

/* ------------------Lawyer-------------------Lawcompany------------- */
Route::group(['middleware' => ['role:lawyer|lawcompany']], function() {
	Route::resource('/lawfirm', 'LawFirm\LawFirmController');
	Route::get('/upcoming_hearings','LawFirm\LawFirmController@upcoming_hearings')->name('upcomingHearings');

	Route::get('/practicing_court', 'LawFirm\LawFirmController@practicing_court')->name('practicing_court.index');
	Route::post('/practicing_court/store', 'LawFirm\LawFirmController@store_practicing_court')->name('practicing_court.store');

	Route::get('/landmarkcase', 'LawFirm\LawFirmController@landmarkcase')->name('landmarkcase.index');
	Route::post('/landmarkcase/store', 'LawFirm\LawFirmController@landmarkcase_store')->name('landmarkcase.store');

	Route::resource('/clients', 'ClientsController');
	Route::resource('/appointment', 'AppointmentController');	
	Route::resource('/case_mast', 'CaseManagement\CaseMastController');
	Route::get('case_details/{id}','CaseManagement\CaseMastController@case_details')->name('case_details');
	Route::get('/cases_table','CaseManagement\CaseMastController@cases_table');
	
	Route::resource('/case_hearing', 'CaseManagement\CaseHearingController');
	Route::resource('/case_doc', 'CaseManagement\CaseDocController');
	Route::resource('/case_notes', 'CaseManagement\CaseNotesController');
	Route::resource('/case_diary', 'CaseManagement\CaseDiaryController');
	Route::post('/case_diary/filter','CaseManagement\CaseDiaryController@filter')->name('case_diary.filter');


	Route::get('/fileDownload', 'CaseManagement\CaseDocController@fileDownload')->name('fileDownload');



	Route::resource('/booking','BookingController');
	Route::get('/bookingUpdate/{id}','BookingController@bookingUpdate')->name('bookingUpdate');
	Route::get('/bookingCancelled/{id}','BookingController@bookingCancelled')->name('bookingCancelled');

	Route::resource('/calendar', 'CalendarController');
	Route::get('/case_member', 'CalendarController@case_member')->name('case_member');


	Route::resource('/todos', 'TodosController');
	Route::post('/todos/category_table_change', 'TodosController@category_table_change')->name('todo.category_table_change');
	Route::post('/status_table_change', 'TodosController@status_table_change')->name('todo.status_table_change');
	Route::post('/todo_status_update', 'TodosController@todo_status_update')->name('todos.todoUpdate');
	Route::get('/todos/form/create', 'TodosController@create_form')->name('todos.create_form');
	Route::get('/update_todo_missed', 'TodosController@update_todo_missed')->name('todos.update_todo_missed');
	Route::get('/todo_closed_reason', 'TodosController@todo_closed_reason')->name('todos.todo_closed_reason');
	Route::get('/awaiting_todo_update', 'TodosController@awaiting_todo_update')->name('todos.awaiting_todo_update');

	Route::get('/mark_as_read', 'TodosController@mark_as_read')->name('mark_as_read');


});
/* ------------------Lawyer-------------------Lawcompany------------- */

/* ------------------------Lawyer------------------------------ */
Route::group(['middleware' => ['role:lawyer']],function(){
	Route::get('/specialization','LawFirm\LawFirmController@specialization')->name('specialization.index');
	Route::post('/specialization/store','LawFirm\LawFirmController@storeSpecialization')->name('specialization.store');
	Route::get('/company_profile','LawFirm\LawFirmController@company_profile')->name('lawfirm.company_profile');
});
/* ----------------------Lawyer-------------------------------- */


/* --------------Lawyer--------Lawcompany-----------Guest---------- */
Route::group(['middleware' => ['role:lawyer|lawcompany|guest']], function(){
	Route::resource('/message', 'MessageController');
	Route::post('/message/reply', 'MessageController@reply')->name('message.reply');
	Route::get('/sent_messages', 'MessageController@show_send')->name('message.sent');
	Route::get('/delete/mess','MessageController@delete')->name('message.delete');
	// Route::get('/trash_message','MessageController@trash')->name('message.trash');
});
/* --------------Lawyer--------Lawcompany-----------Guest---------- */

/* --------------Lawcollege--------Teacher-----------Student---------- */
Route::group(['middleware' => ['role:lawcollege|teacher|student']], function() {

	Route::resource('/lawschools', 'LawSchools\LawSchoolsController');

// Route::group(['prefix' => 'features'] ,function(){	});
	Route::resource('/student', 'Student\StudentDashboardController');
	Route::resource('/student_detail', 'Student\StudentDetailController');
	Route::resource('/student_manage', 'Student\StudentManageController');
	Route::post('/forward_student', 'Student\StudentManageController@forward_tranfer_student')->name('forward_student');

	Route::post('/passout_student', 'Student\StudentManageController@passout_student')->name('passout_student');
	Route::post('/dropout_student', 'Student\StudentManageController@dropout_student')->name('dropout_student');

	Route::get('/student_record', 'Student\StudentManageController@student_record')->name('student_record');
	
	// Route::post('/temporary_save', 'Student\StudentDetailController@temp_data');

	Route::post('/student_filter', 'Student\StudentDetailController@student_filter')->name('student_filter');
	Route::get('/upload_student', 'Student\StudentDashboardController@upload_student')->name('upload_student');
	Route::post('/import_student', 'Student\StudentDashboardController@importStudent')->name('import_student');
	Route::get('/student_sample', 'Student\StudentDashboardController@student_sample')->name('student_sample');
	Route::get('/all_students_export', 'Student\StudentDashboardController@all_students_export')->name('all_students_export');

	Route::get('/s_batch_wise', 'Student\StudentDashboardController@export_batch_wise')->name('s_batch_wise');
	Route::post('/batch_wise_export', 'Student\StudentDashboardController@batch_wise_export')->name('batch_wise_export');

	
	Route::resource('manage/batches', 'LawSchools\BatchMastController');

});
/* --------------Lawcollege--------Teacher-----------Student---------- */

/* -----------------------Lawcollege------------------------------- */
Route::group(['middleware' => ['role:lawcollege']], function() {
	Route::resource('/course',"LawSchools\CourseController");
});
/* -----------------------Lawcollege------------------------------- */


/* -----------------------Teacher------------------------------- */
Route::group(['middleware' => ['role:teacher']], function() {
	
	Route::get('college/profile','LawSchools\LawSchoolsController@college_profile')->name('lawschools.college_profile');
	Route::get('/college/courses','LawSchools\LawSchoolsController@college_courses')->name('lawschools.college_courses');

	Route::get('/college/courses/{id}','LawSchools\LawSchoolsController@show_course_details')->name('lawschools.show_course_details');
	
});
/* -------------------------Teacher----------------------------- */

/* ----------------Lawyer---------------Teacher--------------- */
Route::group(['middleware' => ['role:lawyer|teacher|lawcollege']], function() {   
	Route::resource('/qualification','QualificationController');
	Route::get('/qual_category','QualificationController@qualCategory')->name('qual.category');
	Route::get('/qual_docs','QualificationController@qual_docs');

});
/* ----------------Lawyer---------------Teacher--------------- */

Route::group(['middleware' => ['role:guest']], function() {

	Route::get('/customer', 'CustomerController@index')->name('customer');
	Route::patch('/updateProfile/{id}', 'CustomerController@updateProfile')->name('customer.update');
	Route::get('/appointmentShow', 'BookingController@appointment_show')->name('customer.appointment');
});

Route::group(['middleware' => ['role:lawyer|lawcompany|lawcollege|admin']], function() {
	Route::resource('/teams','Teams\TeamController');

	Route::get('/team_users','Teams\TeamController@team_users');

	Route::resource('/users','Teams\UsersController');
	Route::post('/login_history', 'Teams\UsersController@login_history')->name('login_history');
	Route::post('/member_cases', 'Teams\UsersController@member_cases')->name('member_cases');

});

Route::get('/filestack-mgmt', 'Admin\FilestackMgmtController@index')->name('admin.filestack-mgmt');
Route::resource('/filestacks', 'Admin\FilestackMgmtController');
Route::post('/filestacks/get_users', 'Admin\FilestackMgmtController@get_users');
Route::post('/filestacks/paginate', 'Admin\FilestackMgmtController@search');
Route::post('/filestacks/updateIndex', 'Admin\FilestackMgmtController@updateIndex');
Route::post('/filestack-mgmt/update_permissions', 'Admin\FilestackMgmtController@update_permissions');
Route::post('/filestack-mgmt/users', 'Admin\FilestackMgmtController@get_all_users');
Route::post('/filestack-mgmt/tags', 'Admin\FilestackMgmtController@get_filestack_type');



Route::group(['prefix' => 'docs', 'namespace' => 'Docs'], function ()  {
	// resources
	Route::resource('/stacks', 'FilestacksController');
	Route::resource('/documents', 'DocsController');
	Route::resource('/folders', 'FoldersController');
	Route::resource('/media', 'MediaController');

	// gets
	Route::get('/', 'MainController@index')->name('docs.home');
	Route::get('/files/download/{ids}', 'DocsController@download');
	Route::get('/stacks/search/{keyword}', 'FilestacksController@search');
	Route::get('/back_to_home/{stack_id}', 'FilestacksController@backToHome');
	
	// posts
	Route::post('/move_folder', 'FoldersController@move_folder');
	Route::post('/stacks/get_count', 'FilestacksController@get_count');
	Route::post('/documents/multi_delete', 'DocsController@multi_delete');
	Route::post('/files/download', 'DocsController@download');
	Route::post('/documents/move_file', 'DocsController@move_file');
	Route::post('/documents/multi_cut_paste', 'DocsController@multi_cut_paste');
	Route::post('/documents/upload_folder', 'DocsController@uploadFolder');
});
// Route::get('notifyAgendaAdded/{id}/{team_id?}','PMS\Agenda\AgendaMastController@active_agenda');

// Route::get('agendaAddReminder/{id}/{team_id?}','PMS\Agenda\AgendaMastController@active_add_response');


Route::group(['prefix' => 'pms', 'namespace' => 'PMS'], function ()  {
	Route::resource('agenda', 'Agenda\AgendaMastController');
	Route::resource('agenda/response', 'Agenda\AgendaResponseController');
	Route::post('agenda/checks/is_strict', 'Agenda\AgendaMastController@check_is_strict');
	Route::post('/get_users','Agenda\AgendaMastController@get_users');
	// Schedule Routes
	Route::resource('/schedule', 'Schedule\ScheduleController');
	Route::patch('/schedule/{display_id}/take_action', 'Schedule\ScheduleController@takeAction');
});




//new route for agenda

	// Route::resource('agenda', 'Agenda\AgendaMastController');
	// Route::resource('agenda/response', 'Agenda\AgendaResponseController');
	// Route::post('agenda/checks/is_strict', 'Agenda\AgendaMastController@check_is_strict');

	// Route::get('/', 'MainController@pmsIndex')->name('pms');
	// Route::get('/team/{id}', 'MainController@teamIndex')->name('team.index'); //shows list of tools
	// Route::get('/get-media-url/{post}', 'MediaController@getMediaUrl');
	// Route::post('/fetch-comments', 'CommentsController@getComments');

	// Route::resource('/topics', 'TopicsController');
	// Route::resource('/documents', 'DocumentsController');
	// Route::resource('/media', 'MediaController');
	// Route::resource('/comments', 'CommentsController');
	// Route::resource('/posts', 'PostsController');
	
	// Route::get('/agenda_pass','Agenda\AgendaResponseController@agendaPass')->name('agenda_pass');
	// ROute::post('/agenda_submit','Agenda\AgendaResponseController@submitAgenda')->name('submit_agneda');
	
	// Route::post('/documents/search', 'DocumentsController@paginatedDocs');

	// Route::resource('/media', 'MediaController');
	// Route::get('/get-media-url/{post}', 'MediaController@getMediaUrl');






