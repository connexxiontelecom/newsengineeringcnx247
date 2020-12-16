<?php

use Illuminate\Support\Facades\Route;
use App\Notification;
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

/* Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home'); */

/* Route::livewire('/', 'home')->layout('layouts.frontend-layout'); */

/* Route::layout('layouts.frontend-layout')->section('main-content')->group(function(){
    Route::livewire('/', 'home')->name('home');
});


Route::layout('layouts.auth-layout')->section('main-content')->group(function(){
    Route::livewire('/login', 'login')->name('login');
});

Route::livewire('/activity-stream', 'activity-stream')->name('activity-stream');
Route::livewire('/workflows', 'workflows')->name('workflows'); */
#Base [Frontend routes]
Route::get('/test', function(){
    $unread = Auth::user()->unReadNotifications;
    return dd($unread);
});
Route::get('/', 'CNX247\Frontend\BaseController@homepage')->name('home');

#Administrator routes
Route::get('/dashboard', 'CNX247\Backend\DashboardController@index')->name('dashboard');
Route::get('/roles', 'CNX247\Backend\AdminController@roles')->name('roles');
Route::post('/role/new', 'CNX247\Backend\AdminController@newRole')->name('new-role');
Route::get('/role/edit/{id}', 'CNX247\Backend\AdminController@editRole')->name('edit-role');
Route::post('/role/save', 'CNX247\Backend\AdminController@saveRoleChanges')->name('save-role-changes');
Route::get('/permissions', 'CNX247\Backend\AdminController@permissions')->name('permissions');
Route::get('/permission/edit/{id}', 'CNX247\Backend\AdminController@editPermission')->name('edit-permission');
Route::post('/permission/edit', 'CNX247\Backend\AdminController@savePermissionChanges')->name('save-permission-changes');
Route::post('/permission/new', 'CNX247\Backend\AdminController@newPermission')->name('new-permission');
Route::get('/assign/role-to-permission/{id}', 'CNX247\Backend\AdminController@assignRoleToPermission')
    ->name('assign-role-to-permission');
Route::post('/store/permission', 'CNX247\Backend\AdminController@storeRolePermission')->name('store-permission');

Route::get('/module-manager', 'CNX247\Backend\AdminController@moduleManager')->name('module-manager');
Route::post('/module/new', 'CNX247\Backend\AdminController@newModule')->name('new-module');
#Plans & Features
Route::get('/plans-n-features', 'CNX247\Backend\PlansnFeaturesController@index')->name('plans-n-features');
Route::get('/plans-n-features/new', 'CNX247\Backend\PlansnFeaturesController@create')->name('new-plans-n-features');
Route::post('/plans-n-features/new', 'CNX247\Backend\PlansnFeaturesController@store');
Route::get('/plans-n-features/edit/{id}', 'CNX247\Backend\PlansnFeaturesController@edit')->name('edit-plans-n-features');
Route::post('/plans-n-features/update', 'CNX247\Backend\PlansnFeaturesController@update')->name('update-plans-n-features');
Route::get('/plans-n-features/view/{url}', 'CNX247\Backend\PlansnFeaturesController@view')->name('view-plans-n-features');
#Constants
Route::get('/admin/constants', 'CNX247\Backend\ConstantController@index')->name('constants');
#Tenants
Route::get('/tenants', 'CNX247\Backend\TenantController@index')->name('tenants');
Route::get('/tenant/{slug}', 'CNX247\Backend\TenantController@view')->name('view-tenant');
Route::get('/tenant/analytics/financials', 'CNX247\Backend\TenantController@financials')->name('tenant-financials');
Route::get('/tenants/memberships', 'CNX247\Backend\TenantController@memberships')->name('tenant-memberships');
Route::post('/tenant/send-reminder', 'CNX247\Backend\TenantController@sendReminder');
Route::post('/tenant/email/send', 'CNX247\Backend\TenantController@sendMessage');
Route::get('/tenant/landlord/conversation/{slug}', 'CNX247\Backend\TenantController@viewConversation')->name('tenant-landlord-conversation');
#General settings
Route::get('/general-settings', 'CNX247\Backend\GeneralSettingsController@index')->name('general-settings');
Route::post('/change/company-assets', 'CNX247\Backend\GeneralSettingsController@changeCompanyAssets');

#Workflow Routes
Route::get('/workflow-tasks', 'CNX247\Backend\WorkflowController@index')->name('workflow-tasks');
//Route::get('/workflow-statistics', 'CNX247\Backend\WorkflowController@statistics')->name('workflow-statistics');
Route::get('/workflow-task/view/{url}', 'CNX247\Backend\WorkflowController@viewWorkflowTask')->name('view-workflow-task');
Route::get('/workflow-business-process', 'CNX247\Backend\WorkflowController@businessProcess')->name('workflow-business-process');
Route::post('/workflow/business-process', 'CNX247\Backend\WorkflowController@setBusinessProcess');
Route::post('/workflow/approve-or-decline-request', 'CNX247\Backend\WorkflowController@approveOrDeclineRequest');
#Expense report route
Route::get('/expense-report', 'CNX247\Backend\ExpenseController@index')->name('expense-report');
Route::post('/expense-report', 'CNX247\Backend\ExpenseController@store');

#Purchase request route
Route::get('/purchase-request', 'CNX247\Backend\PurchaseRequestController@index')->name('purchase-request');
Route::post('/purchase-request', 'CNX247\Backend\PurchaseRequestController@store');

#General request route
Route::get('/general-request', 'CNX247\Backend\GeneralRequestController@index')->name('general-request');
Route::post('/general-request', 'CNX247\Backend\GeneralRequestController@store');

#Business trip route
Route::get('/business-trip', 'CNX247\Backend\BusinessTripController@index')->name('business-trip');
Route::post('/business-trip', 'CNX247\Backend\BusinessTripController@store');

#Leave request route
Route::get('/leave-request', 'CNX247\Backend\LeaveRequestController@index')->name('leave-request');
Route::post('/leave-request', 'CNX247\Backend\LeaveRequestController@store');

#Internal memo routes
Route::get('/internal-memo', 'CNX247\Backend\InternalMemoController@index')->name('internal-memo');
Route::post('/internal-memo', 'CNX247\Backend\InternalMemoController@store');
Route::get('/internal-memo/{url}', 'CNX247\Backend\InternalMemoController@view')->name('view-internal-memo');

#Announcement routes
Route::get('/announcement', 'CNX247\Backend\AnnouncementController@index')->name('announcement');

#Chat n Calls routes
Route::get('/conversation/{id}', 'CNX247\Backend\ChatnCallsController@getConversation')->name('conversation');
Route::post('/conversation/send', 'CNX247\Backend\ChatnCallsController@sendChat');
Route::post('/conversation/attachment', 'CNX247\Backend\ChatnCallsController@sendAttachment');
Route::get('/chat-n-calls', 'CNX247\Backend\ChatnCallsController@showChatnCallsView')->name('chat-n-calls');
Route::post('/conversation/compatibility-token', 'CNX247\Backend\TokenController@newToken');
Route::post('/conversation/call', 'CNX247\Backend\TokenController@newCall');
Route::get('/chat', 'CNX247\Backend\ChatnCallsController@chat')->name('chat');
Route::get('/initialize-chat', 'CNX247\Backend\ChatnCallsController@initializeChat');
Route::get('/chat-with/{id}', 'CNX247\Backend\ChatnCallsController@chatWith');
Route::get('/clear-messages/{id}', 'CNX247\Backend\ChatnCallsController@clearMessages');
Route::get('/filter-contact/{search}', 'CNX247\Backend\ChatnCallsController@filterContact');
#Route::post('/cnx247/calls', 'CNX247\Backend\ChatnCallsController@newCall');
#CNXStream
Route::get('/cnx247-stream', 'CNX247\Backend\CNX247Stream@index')->name('cnx247-stream');
Route::get('/livestreaming/{room_name}', 'CNX247\Backend\CNX247Stream@joinRoom')->name('join-room');
Route::post('/livestreaming/security-check', 'CNX247\Backend\CNX247Stream@securityCheck')->name('security-check');
Route::post('/cnx247-stream/create', 'CNX247\Backend\CNX247Stream@createRoom')->name('create-new-room');
Route::get('/delete/room/{room_name}', 'CNX247\Backend\CNX247Stream@deleteRoom')->name('delete-room');

#Auth routes
Route::get('/signup', 'Auth\RegisterController@signup')->name('signup');
Route::get('/email-verification', 'Auth\RegisterController@emailVerification')->name('email-verification');
Route::get('/verify/{link}', 'Auth\RegisterController@verifyEmail')->name('verify-email');
Route::get('/signin', 'Auth\LoginController@signin')->name('signin');
Route::get('/reset-password', 'Auth\LoginController@showResetPasswordForm')->name('reset-password');
Route::get('/reset-password/{token}', 'Auth\LoginController@setPassword')->name('set-password');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::post('/login', 'Auth\LoginController@login')->name('login');

#Payment Gateway
Route::get('/create-site/{timestamp}/{plan}', 'CNX247\Frontend\PaymentGatewayController@createSite')->name('create-site');
Route::post('/register-site', 'CNX247\Frontend\PaymentGatewayController@proceedToPay')->name('register-site');
Route::get('/payment/gateway', 'CNX247\Frontend\PaymentGatewayController@handleGatewayCallback')->name('payment-callback');
#Start trial
Route::get('/start-trial', 'CNX247\Frontend\PaymentGatewayController@startTrial')->name('start-trial');
Route::post('/start-trial', 'CNX247\Frontend\PaymentGatewayController@registerTrial');

#Frontend routes
Route::get('/pricing', 'CNX247\Frontend\BaseController@pricing')->name('pricing');
Route::get('/support', 'CNX247\Frontend\BaseController@support')->name('support');
Route::get('/contact_us', 'CNX247\Frontend\BaseController@contact_us')->name('contact_us');
Route::get('/faqs', 'CNX247\Frontend\BaseController@faqs')->name('faqs');
Route::get('/product', 'CNX247\Frontend\BaseController@product')->name('product');
Route::get('/human_resource', 'CNX247\Frontend\BaseController@human_resource')->name('human_resource');
Route::get('/accounting', 'CNX247\Frontend\BaseController@accounting')->name('accounting');
Route::get('/crm', 'CNX247\Frontend\BaseController@crm')->name('crm');


#User routes
Route::get('/my-profile', 'CNX247\Backend\UserController@myProfile')->name('my-profile');
Route::get('/notifications', 'CNX247\Backend\UserController@notifications')->name('notifications');
Route::post('/upload/avatar', 'CNX247\Backend\UserController@uploadAvatar');
Route::post('/upload/cover', 'CNX247\Backend\UserController@uploadCoverPhoto');
Route::get('/user/administration', 'CNX247\Backend\UserController@administration')->name('user-administration');
Route::get('/user/settings', 'CNX247\Backend\UserController@settings')->name('user-settings');
Route::get('/settings/education', 'CNX247\Backend\UserController@education')->name('education');
Route::post('/settings/education', 'CNX247\Backend\UserController@storeEducation');
Route::get('/settings/work-experience', 'CNX247\Backend\UserController@workExperience')->name('work-experience');
Route::get('/p/our-pricing', 'CNX247\Backend\UserController@ourPricing')->name('our-pricing');
Route::get('/my-ideas', 'CNX247\Backend\UserController@myIdeas')->name('my-ideas');
Route::post('/submit-idea', 'CNX247\Backend\UserController@submitIdea');
Route::get('/renew-membership/{timestamp}/{plan}', 'CNX247\Backend\UserController@renewMembership')->name('renew-membership');
Route::post('/renew-membership/pay', 'CNX247\Backend\UserController@proceedToPay')->name('pay-membership');
Route::get('/my-feedback', 'CNX247\Backend\UserController@myFeedback')->name('my-feedback');
Route::post('/my-feedback', 'CNX247\Backend\UserController@submitFeedback');
Route::get('/preference/themes', 'CNX247\Backend\UserController@themes')->name('cnx247-themes');
Route::post('/switch-theme', 'CNX247\Backend\UserController@switchTheme');

#HR routes
Route::get('/hr-dashboard', 'CNX247\Backend\HRController@hrDashboard')->name('hr-dashboard');
Route::get('/employees', 'CNX247\Backend\HRController@index')->name('employees');
Route::get('/appreciation', 'CNX247\Backend\HRController@appreciation')->name('appreciation');
Route::get('/on-boarding', 'CNX247\Backend\HRController@onBoarding')->name('on-boarding');
#Resignation
Route::get('/resignation', 'CNX247\Backend\HRController@resignation')->name('resignation');
Route::post('/resignation', 'CNX247\Backend\HRController@submitResignation');
Route::get('/view-resignation/{url}', 'CNX247\Backend\HRController@viewResignation')->name('view-resignation');
#Complaint
Route::get('/complaints', 'CNX247\Backend\HRController@complaints')->name('complaints');
#Timesheet
Route::get('/attendance', 'CNX247\Backend\HRController@attendance')->name('attendance');
Route::get('/leave-management', 'CNX247\Backend\HRController@leaveManagement')->name('leave-management');
Route::get('/leave-wallet', 'CNX247\Backend\HRController@leaveWallet')->name('leave-wallet');
Route::get('/leave-type', 'CNX247\Backend\HRController@leaveType')->name('leave-type');
Route::get('/timesheet', 'CNX247\Backend\HRController@timesheet')->name('timesheet');
#Performance
Route::get('/performance-indicator', 'CNX247\Backend\HRController@performanceIndicator')->name('performance-indicator');
Route::get('/job-role/{id}/questions', 'CNX247\Backend\HRController@jobRoleQuestions')->name('job-role-questions');
Route::post('/performance-indicator/self', 'CNX247\Backend\HRController@selfAssessmentQuestion');
Route::post('/performance-indicator/self/edit', 'CNX247\Backend\HRController@editSelfAssessmentQuestion');
Route::post('/performance-indicator/quantitative', 'CNX247\Backend\HRController@quantitativeAssessmentQuestion');
Route::post('/performance-indicator/quantitative/edit', 'CNX247\Backend\HRController@editQuantitativeAssessmentQuestion');
Route::post('/performance-indicator/qualitative', 'CNX247\Backend\HRController@qualitativeAssessmentQuestion');
Route::post('/performance-indicator/qualitative/edit', 'CNX247\Backend\HRController@editQualitativeAssessmentQuestion');
Route::get('/employees-appraisal', 'CNX247\Backend\HRController@employeePerformance')->name('employees-appraisal');
Route::post('/employee-appraisal', 'CNX247\Backend\HRController@storeAppraisal');
Route::post('/bulk/employee-appraisal', 'CNX247\Backend\HRController@storeBulkAppraisal');
Route::get('/employee-self-appraisal/{appraisal_id}', 'CNX247\Backend\HRController@selfAppraisal')->name('employee-self-appraisal');
Route::post('/employee-self-appraisal', 'CNX247\Backend\HRController@storeSelfAppraisal')->name('store-self-appraisal');
Route::get('/employee-supervisor-appraisal/{appraisal_id}', 'CNX247\Backend\HRController@supervisorAppraisal')->name('employee-supervisor-appraisal');
Route::post('/employee-supervisor-appraisal', 'CNX247\Backend\HRController@storeSupervisorAppraisal')->name('store-supervisor-appraisal');
Route::get('/appraisal-result/{appraisal_id}', 'CNX247\Backend\HRController@appraisalResult')->name('appraisal-result');
Route::post('/terminate/employment', 'CNX247\Backend\HRController@terminateEmployment');
Route::get('/terminated-employment', 'CNX247\Backend\HRController@terminatedEmployment')->name('terminated-employment');
#HR Constants
Route::get('/hr/configurations', 'CNX247\Backend\HRController@hrConfigurations')->name('hr-configurations');
#Assign permission(s) to employee
Route::get('/assign/permission-to-employee/{url}', 'CNX247\Backend\HRController@assignPermissionToEmployee')
    ->name('assign-permission-to-employee');
Route::post('/store/user/permission', 'CNX247\Backend\HRController@storeUserPermission')
    ->name('store-user-permission');
#Query employee
Route::get('/employee/queries', 'CNX247\Backend\HRController@queries')->name('queries');
Route::get('/query/employee/{url}', 'CNX247\Backend\HRController@queryEmployee')->name('query-employee');
Route::post('/store/query/employee', 'CNX247\Backend\HRController@storeQueryEmployee')->name('store-query-employee');
Route::get('/employee/query/view/{slug}', 'CNX247\Backend\HRController@viewQuery')->name('view-query');
#IdeaBox
Route::get('/hr/idea-box', 'CNX247\Backend\HRController@ideaBox')->name('hr-ideabox');
#Customer Relationship Management (CRM)
Route::get('/crm-dashboard', 'CNX247\Backend\CRMController@crmDashboard')->name('crm-dashboard');
Route::post('/crm/client/client-account', 'CNX247\Backend\CRMController@getClientGlcode');
#Leads
Route::get('/crm/leads', 'CNX247\Backend\CRMController@leads')->name('leads');
Route::get('/crm/lead/view/{slug}', 'CNX247\Backend\CRMController@viewLead')->name('view-lead');
Route::get('/crm/lead/convert-to-deal/{slug}', 'CNX247\Backend\CRMController@convertLeadToDeal')->name('convert-to-deal');
Route::post('/crm/lead/raise-receipt', 'CNX247\Backend\CRMController@raiseReceipt')->name('raise-receipt');
#Deal
Route::get('/crm/deals', 'CNX247\Backend\CRMController@deals')->name('deals');
Route::get('/crm/deal/view/{slug}', 'CNX247\Backend\CRMController@viewDeal')->name('view-deal');
#Invoice list
Route::get('/invoice-list', 'CNX247\Backend\CRMController@invoiceList')->name('invoice-list');
Route::get('/print/invoice/{slug}', 'CNX247\Backend\CRMController@printInvoice')->name('print-invoice');
Route::post('/send/invoice/email', 'CNX247\Backend\CRMController@sendInvoiceViaEmail');
Route::get('/invoice/decline-invoice/{slug}', 'CNX247\Backend\CRMController@declineInvoice')->name('decline-invoice');
#Receipt list
Route::get('/receipt-list', 'CNX247\Backend\CRMController@receiptList')->name('receipt-list');
Route::get('/print/receipt/{slug}', 'CNX247\Backend\CRMController@printReceipt')->name('print-receipt');
Route::post('/send/receipt/email', 'CNX247\Backend\CRMController@sendReceiptViaEmail');
#Contacts/clients
Route::get('/crm/clients', 'CNX247\Backend\CRMController@clients')->name('clients');
Route::get('/crm/client/new', 'CNX247\Backend\CRMController@createClient')->name('new-client');
Route::get('/crm/client/view/{slug}', 'CNX247\Backend\CRMController@viewClient')->name('view-client');
Route::get('/crm/client/edit/{slug}', 'CNX247\Backend\CRMController@editClient')->name('edit-client');
Route::post('/upload/client/avatar', 'CNX247\Backend\CRMController@uploadClientAvatar');
Route::post('/messaging/client/email', 'CNX247\Backend\CRMController@sendEmailToClient');
Route::post('/messaging/client/sms', 'CNX247\Backend\CRMController@sendSmsToClient');
#Products
Route::get('/crm/products', 'CNX247\Backend\CRMController@products')->name('products');
Route::get('/crm/product/new', 'CNX247\Backend\CRMController@addNewProduct')->name('add-new-product');
Route::post('/crm/product/new', 'CNX247\Backend\CRMController@saveProduct');
Route::get('/crm/product/{slug}', 'CNX247\Backend\CRMController@viewProduct')->name('product-details');
Route::get('/crm/product/edit/{slug}', 'CNX247\Backend\CRMController@editProduct')->name('edit-product');
Route::post('/crm/product/edit', 'CNX247\Backend\CRMController@saveProductChanges');
Route::get('/crm/product/delete/{slug}', 'CNX247\Backend\CRMController@deleteProduct')->name('delete-product');
#Bulk SMS
Route::get('/crm/bulk-sms', 'CNX247\Backend\BulkSmsController@index')->name('bulk-sms');
Route::get('/crm/bulk-sms/compose', 'CNX247\Backend\BulkSmsController@create')->name('compose-sms');
Route::post('/crm/bulk-sms/send', 'CNX247\Backend\BulkSmsController@sendBulkSms')->name('send-bulk-sms');
Route::get('/crm/bulk-sms/phone-groups', 'CNX247\Backend\BulkSmsController@phoneGroups')->name('phone-groups');
Route::get('/crm/bulk-sms/phone-group/{slug}', 'CNX247\Backend\BulkSmsController@showPhoneGroup')->name('show-phone-group');
Route::get('/crm/bulk-sms/delete/phone-group/{slug}', 'CNX247\Backend\BulkSmsController@deletePhoneGroup')->name('delete-phone-group');
Route::post('/crm/bulk-sms/phone-groups', 'CNX247\Backend\BulkSmsController@storePhoneGroup');
Route::post('/crm/bulk-sms/update-phone-group', 'CNX247\Backend\BulkSmsController@updatePhoneGroup')->name('update-phone-group');
Route::get('/crm/bulk-sms/new-phone-group', 'CNX247\Backend\BulkSmsController@newPhoneGroup')->name('new-phone-group');
#Email Campaign
Route::get('/crm/email-campaigns', 'CNX247\Backend\EmailCampaignController@index')->name('email-campaigns');
Route::get('/crm/email-campaig/new', 'CNX247\Backend\EmailCampaignController@create')->name('new-email-campaign');
Route::post('/crm/email-campaig/new', 'CNX247\Backend\EmailCampaignController@store');
Route::get('/crm/email-campaig/view/{id}', 'CNX247\Backend\EmailCampaignController@show')->name('email-campaign-view');
#Convert client to lead
Route::get('/crm/client/convert-to-lead/{slug}', 'CNX247\Backend\CRMController@convertClientToLead')->name('convert-to-lead');
Route::post('/crm/client/raise-an-invoice', 'CNX247\Backend\CRMController@raiseAnInvoice')->name('raise-an-invoice');
Route::get('/crm/invoice/receive-payment/{slug}', 'CNX247\Backend\CRMController@receivePayment')->name('receive-payment');
Route::post('/crm/invoice/receive-payment', 'CNX247\Backend\CRMController@receiveInvoicePayment')->name('receive-invoice-payment');
#Social media
Route::get('/facebook/connect-to-facebook', 'CNX247\Backend\FacebookController@connect')->name('connect-to-facebook');
Route::get('/facebook/facebook-timeline', 'CNX247\Backend\FacebookController@facebookTimeline')->name('facebook-timeline');
#Support
Route::get('/support/ticket', 'CNX247\Backend\SupportController@ticket')->name('ticket');
Route::get('/support/ticket-history', 'CNX247\Backend\SupportController@ticketHistory')->name('ticket-history');
Route::get('/support/view-ticket/{slug}', 'CNX247\Backend\SupportController@viewTicket')->name('view-ticket');
#Admin area support
Route::get('/crm/support/tickets', 'CNX247\Backend\SupportController@adminTicketIndex')->name('admin-support');
Route::post('/crm/support/ticket/category/new', 'CNX247\Backend\SupportController@newTicketCategory')->name('new-ticket-category');
Route::get('/feedbacks', 'CNX247\Backend\CRMController@feedbacks')->name('feedbacks');
Route::post('/feedback-status', 'CNX247\Backend\CRMController@feedbackStatus');
#Activity stream routes
Route::get('/activity-stream', 'CNX247\Backend\ActivityStreamController@index')->name('activity-stream');
Route::post('/activity-stream/message', 'CNX247\Backend\ActivityStreamController@sendMessage');

Route::post('/activity-stream/new/task', 'CNX247\Backend\ActivityStreamController@storeTask');

Route::post('/activity-stream/live-update', 'CNX247\Backend\ActivityStreamController@postView');
Route::get('/activity-stream/post/{slug}', 'CNX247\Backend\ActivityStreamController@viewPost')->name('view-post-activity-stream');
Route::post('/event/new', 'CNX247\Backend\ActivityStreamController@createEvent');
Route::post('/announcement/new', 'CNX247\Backend\ActivityStreamController@createAnnouncement');
Route::post('/activity-stream/upload/attachment', 'CNX247\Backend\ActivityStreamController@shareFile');
Route::post('/appreciation/new', 'CNX247\Backend\ActivityStreamController@createAppreciation');
Route::post('/send/invitation/by-email', 'CNX247\Backend\ActivityStreamController@inviteUser');
Route::post('/activity-stream/clockin', 'CNX247\Backend\ActivityStreamController@clockin');
Route::post('/activity-stream/clockout', 'CNX247\Backend\ActivityStreamController@clockout');

#View an employee's profile
Route::get('/activity-stream/profile/{url}', 'CNX247\Backend\ActivityStreamController@viewProfile')
    ->name('view-profile');

#Task routes
Route::get('/task/task-board', 'CNX247\Backend\TaskController@taskBoard')->name('task-board');
Route::get('/task/new', 'CNX247\Backend\TaskController@newTask')->name('new-task');
Route::post('/task/new', 'CNX247\Backend\TaskController@storeTask')->name('new-task');
Route::get('/task/view/{url}', 'CNX247\Backend\TaskController@viewTask')->name('view-task');
Route::get('/task/calendar', 'CNX247\Backend\TaskController@taskCalendar')->name('task-calendar'); //[view]
Route::get('/task-calendar', 'CNX247\Backend\TaskController@getTaskCalendarData'); //[Data source]
Route::get('/task/gantt-chart', 'CNX247\Backend\TaskController@taskGanttChart')->name('task-gantt-chart');
Route::get('/task-gantt-chart', 'CNX247\Backend\TaskController@getTaskGanttChartData');
Route::get('/task/task-analytics', 'CNX247\Backend\TaskController@taskAnalytics')->name('task-analytics');
Route::post('/delete/task', 'CNX247\Backend\TaskController@deleteTask');
Route::get('/task/edit/{url}', 'CNX247\Backend\TaskController@editTask')->name('edit-task');
Route::post('/task/update', 'CNX247\Backend\TaskController@updateTask')->name('update-task');
Route::post('/upload/post/attachment', 'CNX247\Backend\TaskController@uploadPostAttachment');
Route::get('/task/submit-task/{url}', 'CNX247\Backend\TaskController@submitTask')->name('submit-task');
Route::post('/submit-assigned-task', 'CNX247\Backend\TaskController@storeAssignedTask')->name('submit-assigned-task');
Route::get('/assignment/view-submissions', 'CNX247\Backend\TaskController@viewAssignmentSubmissions')->name('view-assigment-submissions');

Route::post('/add-responsible-person', 'CNX247\Backend\TaskController@addResponsiblePerson')->name('add-responsible-person');
Route::post('/add-observers', 'CNX247\Backend\TaskController@addObserver')->name('add-observers');
Route::post('/add-participants', 'CNX247\Backend\TaskController@addParticipant')->name('add-participants');

Route::post('/rate/task/submitted', 'CNX247\Backend\TaskController@rateTaskSubmitted');

#Project routes
Route::get('/project/project-board', 'CNX247\Backend\ProjectController@projectBoard')->name('project-board');
Route::get('/project/new', 'CNX247\Backend\ProjectController@newProject')->name('new-project');
Route::post('/project/new', 'CNX247\Backend\ProjectController@storeProject');
Route::get('/project/view/{url}', 'CNX247\Backend\ProjectController@viewProject')->name('view-project');
Route::get('/project/budget/{url}', 'CNX247\Backend\ProjectController@projectBudget')->name('project-budget');
Route::post('/project/budget', 'CNX247\Backend\ProjectController@storeProjectBudget')->name('store-project-budget');
Route::get('/project/calendar', 'CNX247\Backend\ProjectController@projectCalendar')->name('project-calendar'); //[view]
Route::get('/project-calendar', 'CNX247\Backend\ProjectController@getProjectCalendarData'); //[Data source]
Route::get('/project/gantt-chart', 'CNX247\Backend\ProjectController@projectGanttChart')->name('project-gantt-chart');
Route::get('/project-gantt-chart', 'CNX247\Backend\ProjectController@getProjectGanttChartData');
#Individual project gantt chart
Route::get('/load-project/gantt-chart/{slug}', 'CNX247\Backend\ProjectController@loadprojectGanttChart')->name('load-project-gantt-chart');
Route::get('/project-gantt-chart/{slug}', 'CNX247\Backend\ProjectController@viewProjectGanttChartData');

Route::get('/project/project-analytics', 'CNX247\Backend\ProjectController@projectAnalytics')->name('project-analytics');
Route::post('/delete/project', 'CNX247\Backend\ProjectController@deleteProject');
Route::get('/project/edit/{url}', 'CNX247\Backend\ProjectController@editProject')->name('edit-project');
Route::post('/project/update', 'CNX247\Backend\ProjectController@updateProject')->name('update-project');
Route::post('/project/milestone', 'CNX247\Backend\ProjectController@createProjectMilestone');
#Invoice
Route::get('/project/invoice/{slug}', 'CNX247\Backend\ProjectController@projectInvoice')->name('project-invoice');
Route::post('/project/invoice', 'CNX247\Backend\ProjectController@storeProjectInvoice')->name('store-project-invoice');
Route::post('/project/get-budget', 'CNX247\Backend\ProjectController@getProjectBudget');
#Receipt
Route::get('/project/receipt/{slug}', 'CNX247\Backend\ProjectController@projectReceipt')->name('project-receipt');
Route::post('/project/receipt', 'CNX247\Backend\ProjectController@storeProjectReceipt')->name('store-project-receipt');
#Bill
Route::get('/project/bill/{slug}', 'CNX247\Backend\ProjectController@projectBill')->name('project-bill');
Route::post('/project/bill', 'CNX247\Backend\ProjectController@storeProjectBill')->name('store-project-bill');

Route::get('/bill/decline-bill/{slug}', 'CNX247\Backend\Accounting\PostingController@declineBill')->name('decline-bill');

Route::get('/project/project-financials/{slug}', 'CNX247\Backend\ProjectController@projectFinancials')->name('project-financials');
Route::post('/add-project-responsible', 'CNX247\Backend\ProjectController@addResponsiblePerson')->name('add-project-responsible');
Route::post('/add-project-observers', 'CNX247\Backend\ProjectController@addObserver')->name('add-project-observers');
Route::post('/add-project-participants', 'CNX247\Backend\ProjectController@addParticipant')->name('add-project-participants');


#Workgroup routes
Route::get('/workgroups', 'CNX247\Backend\WorkgroupController@index')->name('workgroups');
Route::get('/workgroup/new', 'CNX247\Backend\WorkgroupController@showNewWorkgroupForm')->name('new-workgroup');
Route::post('/workgroup/new', 'CNX247\Backend\WorkgroupController@storeWorkgroup');
Route::get('/workgroup/view/{url}', 'CNX247\Backend\WorkgroupController@viewWorkgroup')->name('view-workgroup');
Route::post('/workgroup/message', 'CNX247\Backend\WorkgroupController@sendMessage');
Route::post('/workgroup/task/new', 'CNX247\Backend\WorkgroupController@createTask')->name('workgroup-task');
Route::post('/workgroup/event/new', 'CNX247\Backend\WorkgroupController@createEvent');
Route::post('/workgroup/announcement/new', 'CNX247\Backend\WorkgroupController@createAnnouncement')->name('workgroup-announcement');
Route::post('/workgroup/file/new', 'CNX247\Backend\WorkgroupController@shareFile')->name('share-file');
Route::post('/workgroup/appreciation/new', 'CNX247\Backend\WorkgroupController@createAppreciation');
Route::post('/workgroup/remove-member', 'CNX247\Backend\WorkgroupController@removeMember');
Route::post('/workgroup/remove-moderator', 'CNX247\Backend\WorkgroupController@removeModerator');
Route::post('/workgroup/send-invitation', 'CNX247\Backend\WorkgroupController@sendWorkgroupInvitation');
Route::get('/workgroup/invitation/{slug}', 'CNX247\Backend\WorkgroupController@viewWorkgroupInvite')->name('view-workgroup-invitation');
Route::post('/workgroup/invitation/action', 'CNX247\Backend\WorkgroupController@workgroupAction')->name('workgroup-action');
Route::post('/invitation/email', 'CNX247\Backend\ActivityStreamController@sendInvitationByEmail');


#CNX247.Drive routes
Route::get('/cnx247-drive', 'CNX247\Backend\CNX247DriveController@index')->name('cnx247-drive');
Route::get('/cnx247-drive/show', 'CNX247\Backend\CNX247DriveController@show')->name('show-files');
Route::post('/drive/make-directory', 'CNX247\Backend\CNX247DriveController@createDirectory');
Route::post('/cnx247-drive/upload', 'CNX247\Backend\CNX247DriveController@uploadFile')->name('upload-file');
Route::post('/upload-attachment', 'CNX247\Backend\CNX247DriveController@uploadAttachment');
Route::post('/cnx247-drive/download', 'CNX247\Backend\CNX247DriveController@downloadAttachment');
Route::post('/cnx247-drive/share', 'CNX247\Backend\CNX247DriveController@shareAttachment');
Route::post('/cnx247-drive/delete', 'CNX247\Backend\CNX247DriveController@deleteAttachment');
Route::post('/cnx247-drive/delete-folder', 'CNX247\Backend\CNX247DriveController@deleteFolder');
Route::post('/cnx247-drive/new_folder', 'CNX247\Backend\CNX247DriveController@newFolder');
Route::get('/folder/{slug}', 'CNX247\Backend\CNX247DriveController@folder')->name('folder');
Route::get('/shared-folder/{slug}', 'CNX247\Backend\CNX247DriveController@sharedFolder')->name('shared-folder');
Route::post('/cnx247-drive/share-folder', 'CNX247\Backend\CNX247DriveController@shareFolder');
Route::post('/cnx247-drive/search', 'CNX247\Backend\CNX247DriveController@search')->name('search');



#Event routes
Route::get('/my-events', 'CNX247\Backend\EventController@myEvents')->name('my-events');
Route::get('/my-new-event', 'CNX247\Backend\EventController@addNewEvent')->name('my-new-event');
Route::post('/my-new-event', 'CNX247\Backend\EventController@storeEvent');
Route::get('/my-event/list', 'CNX247\Backend\EventController@myEventList')->name('my-event-list');
Route::get('/my-event/calendar', 'CNX247\Backend\EventController@eventCalendar')->name('my-event-calendar');
Route::get('/my-event-calendar', 'CNX247\Backend\EventController@getEventCalendarData');
Route::get('/company-calendar', 'CNX247\Backend\EventController@companyCalendar')->name('company-calendar');
Route::get('/company-event-calendar', 'CNX247\Backend\EventController@getCompanyEventData');
Route::get('/all-events', 'CNX247\Backend\EventController@viewAllEvents')->name('view-all-events');

#Procurement routes
#Supplier routes
Route::get('/suppliers', 'CNX247\Backend\SupplierController@index')->name('suppliers');
Route::get('/supplier/new', 'CNX247\Backend\SupplierController@create')->name('new-supplier');
Route::post('/supplier/new', 'CNX247\Backend\SupplierController@store');
Route::get('/supplier/view/{slug}', 'CNX247\Backend\SupplierController@view')->name('view-supplier');
Route::get('/purchase-order/new/{slug}', 'CNX247\Backend\SupplierController@purchaseOrder')->name('new-purchase-order');
Route::get('/purchase-order/create', 'CNX247\Backend\SupplierController@createPurchaseOrder')->name('create-purchase-order');
Route::post('/purchase-order/new', 'CNX247\Backend\SupplierController@storePurchaseOrder')->name('store-purchase-order');
Route::get('/purchase-order/view/{slug}', 'CNX247\Backend\SupplierController@viewPurchaseOrder')->name('view-purchase-order');
Route::get('/procurement/purchase-orders', 'CNX247\Backend\SupplierController@purchaseOrders')->name('purchase-orders');
Route::post('/procurement/review/purchase-order', 'CNX247\Backend\SupplierController@reviewPurchaseOrder');
#Vendor bill
Route::get('/vendor-bills', 'CNX247\Backend\SupplierController@vendorBills')->name('vendor-bills');
Route::get('/new-vendor-bill', 'CNX247\Backend\SupplierController@newVendorBill')->name('new-vendor-bill');
Route::post('/new-vendor-bill', 'CNX247\Backend\SupplierController@storeVendorBill');
Route::get('/vendor-services', 'CNX247\Backend\SupplierController@vendorServices')->name('vendor-services');
Route::get('/vendor-services', 'CNX247\Backend\SupplierController@vendorServices')->name('vendor-services');
Route::post('/store-vendor-service', 'CNX247\Backend\SupplierController@storeVendorService')->name('store-vendor-service');
Route::post('/vendor-bill/details', 'CNX247\Backend\SupplierController@vendorDetails');
Route::get('/vendor-bill/view/{id}', 'CNX247\Backend\SupplierController@viewBill')->name('view-bill');
Route::get('/vendor/payment', 'CNX247\Backend\SupplierController@vendorPayment')->name('vendor-payment');
Route::post('/get/this/vendor', 'CNX247\Backend\SupplierController@getVendorPendingBills');
#Payment
Route::get('/vendor/payments', 'CNX247\Backend\SupplierController@payments')->name('payments');
Route::get('/vendor/payment/new', 'CNX247\Backend\SupplierController@newPayment')->name('new-payment');
Route::post('/vendor/payment/new', 'CNX247\Backend\SupplierController@storePayment');
Route::get('/vendor/payment/detail/{slug}', 'CNX247\Backend\SupplierController@paymentDetail')->name('payment-detail');
Route::get('/vendor/payment/decline/{slug}', 'CNX247\Backend\SupplierController@declinePayment')->name('decline-payment');
Route::get('/vendor/payment/post/{slug}', 'CNX247\Backend\SupplierController@postPayment')->name('post-payment');
#Procurement supplier account
Route::get('/supplier/login', 'CNX247\Frontend\ProcurementAuthController@login')->name('supplier.login');
Route::post('/supplier/login', 'CNX247\Frontend\ProcurementAuthController@loginNow');
Route::get('/procurement/supplier-account', 'CNX247\Frontend\ProcurementController@myAccount')->name('supplier-account');
Route::get('/procurement/supplier/my-purchase-orders', 'CNX247\Frontend\ProcurementController@myPurchaseOrders')->name('supplier-purchase-orders');
Route::get('/procurement/supplier/my-purchase-orders/learn/{slug}', 'CNX247\Frontend\ProcurementController@viewMyPurchaseOrders')->name('my-purchase-orders');
Route::post('/procurement/supplier/take-action', 'CNX247\Frontend\ProcurementController@takeAction');
Route::get('/procurement/supplier/settings', 'CNX247\Frontend\ProcurementController@settings')->name('supplier-settings');
Route::post('/procurement/supplier/settings', 'CNX247\Frontend\ProcurementController@storeChanges');
Route::post('/procurement/supplier/contact-person', 'CNX247\Frontend\ProcurementController@updateContactPerson')->name('supplier-update-contact-person');
Route::post('/procurement/supplier/change-password', 'CNX247\Frontend\ProcurementController@changePassword')->name('supplier-change-password');
#Logistics routes
Route::get('/logistics/login', 'CNX247\Frontend\LogisticsAuthController@login')->name('logistics.login');
Route::post('/logistics/login', 'CNX247\Frontend\LogisticsAuthController@loginNow');
Route::get('/logistics/logistics-account', 'CNX247\Frontend\LogisticsController@myAccount')->name('logistics-account');
Route::get('/logistics/log', 'CNX247\Frontend\LogisticsController@log')->name('logistics-log');
Route::get('/logistics/check-in', 'CNX247\Frontend\LogisticsController@checkIn')->name('logistics-check-in');
Route::get('/logistics/check-out/{id}', 'CNX247\Frontend\LogisticsController@checkOut')->name('logistics-check-out');
Route::post('/logistics/check-in', 'CNX247\Frontend\LogisticsController@storeCheckIn');
Route::get('/logistics/drivers', 'CNX247\Backend\LogisticsController@drivers')->name('logistics-drivers');
Route::get('/logistics/new-driver', 'CNX247\Backend\LogisticsController@addNewDriver')->name('new-driver');
Route::get('/logistics/all-logs', 'CNX247\Backend\LogisticsController@allLogs')->name('all-logs');
Route::post('/logistics/new-driver', 'CNX247\Backend\LogisticsController@storeDriver');
Route::get('/logistics/driver-profile/{url}', 'CNX247\Backend\LogisticsController@driverProfile')->name('driver-profile');
Route::get('/logistics/pick-up-points', 'CNX247\Backend\LogisticsController@pickupPoints')->name('logistics-pick-up-points');
Route::post('/logistics/pick-up-point/store', 'CNX247\Backend\LogisticsController@storePickupPoint');
Route::post('/logistics/pick-up-point/edit', 'CNX247\Backend\LogisticsController@editPickupPoint');
#Driver emergency contact routes
Route::post('/logistics/driver/emergency-contact', 'CNX247\Backend\LogisticsController@driverEmergencyContact');
Route::post('/logistics/driver/kin-contact', 'CNX247\Backend\LogisticsController@driverKinContact');
Route::post('/logistics/driver/guarantor', 'CNX247\Backend\LogisticsController@driverGuarantorContact');
Route::post('/logistics/user/avatar', 'CNX247\Backend\LogisticsController@changeUserAvatar');
#Shipping routes
Route::get('/logistics/shipping', 'CNX247\Backend\LogisticsController@shipping')->name('logistics-shipping');
Route::get('/logistics/new-shipping', 'CNX247\Backend\LogisticsController@newShipping')->name('new-shipping');
#Customer routes
Route::get('/logistics/customers', 'CNX247\Backend\LogisticsController@customers')->name('logistics-customers');
Route::get('/logistics/new-customer', 'CNX247\Backend\LogisticsController@newCustomer')->name('logistics-new-customer');
Route::post('/store-logistic-customer', 'CNX247\Backend\LogisticsController@storeCustomer')->name('store-logistic-customer');
#Vehicle routes
Route::get('/logistics/vehicles', 'CNX247\Backend\LogisticsController@vehicles')->name('logistics-vehicles');
Route::get('/logistics/new-vehicle', 'CNX247\Backend\LogisticsController@newVehicle')->name('logistics-new-vehicle');
Route::post('/logistics/new-vehicle', 'CNX247\Backend\LogisticsController@storeVehicle');
Route::get('/logistics/view-vehicle/{slug}', 'CNX247\Backend\LogisticsController@viewVehicle')->name('logistics-view-vehicle');
Route::post('/logistics/vehicle/assign', 'CNX247\Backend\LogisticsController@assignVehicleToDriver');
#Accounting routes
    Route::get('/chart-of-accounts', 'CNX247\Backend\Accounting\ChartOfAccountController@index')->name('chart-of-accounts');
    Route::post('/new/chart-of-account', 'CNX247\Backend\Accounting\ChartOfAccountController@createCOA')->name('create-new-coa');
    Route::post('/get-parent-account', 'CNX247\Backend\Accounting\ChartOfAccountController@getParentAccount');
    Route::post('/save-account', 'CNX247\Backend\Accounting\ChartOfAccountController@saveAccount');
    Route::get('/accounting/vat', 'CNX247\Backend\Accounting\ChartOfAccountController@vat')->name('accounting-vat');
    Route::post('/accounting/vat', 'CNX247\Backend\Accounting\ChartOfAccountController@postVat');
    Route::get('/accounting/opening-balance', 'CNX247\Backend\Accounting\ChartOfAccountController@openingBalance')->name('opening-balance');
    Route::post('/accounting/opening-balance', 'CNX247\Backend\Accounting\ChartOfAccountController@postOpeningBalance');
    Route::get('/accounting/setup/ledger-default-variables', 'CNX247\Backend\Accounting\ChartOfAccountController@ledgerDefaultsVariables')->name('ledger-default-variables');
    Route::post('/accounting/setup/ledger-default-variables', 'CNX247\Backend\Accounting\ChartOfAccountController@updateDefaultsVariables');
    #Report
    Route::get('/accounting/report/trial-balance', 'CNX247\Backend\Accounting\ReportController@trialBalanceView')->name('trial-balance');
    Route::post('/accounting/report/trial-balance', 'CNX247\Backend\Accounting\ReportController@trialBalance');
    Route::get('/balance-sheet', 'CNX247\Backend\Accounting\ReportController@balanceSheetView')->name('balance-sheet');
    Route::post('/balance-sheet', 'CNX247\Backend\Accounting\ReportController@balanceSheet');
    Route::get('/profit-o-loss', 'CNX247\Backend\Accounting\ReportController@profitOrLossView')->name('profit-o-loss');
    Route::post('/profit-o-loss', 'CNX247\Backend\Accounting\ReportController@profitOrLoss');
    #Posting
    Route::get('/accounting/posting/receipt', 'CNX247\Backend\Accounting\PostingController@receipt')->name('receipt-posting');
    Route::get('/accounting/posting/detail/{slug}', 'CNX247\Backend\Accounting\PostingController@receiptDetail')->name('receipt-posting-detail');
    Route::get('/accounting/posting/receipt/{slug}/post', 'CNX247\Backend\Accounting\PostingController@postReceipt')->name('receipt-posting-post');
    Route::get('/accounting/posting/decline-receipt/{slug}', 'CNX247\Backend\Accounting\PostingController@declineReceipt')->name('decline-receipt-posting');
    #Journal Entry
    Route::get('/journal-entries', 'CNX247\Backend\Accounting\JournalEntryController@journalEntries')->name('journal-entries');
    Route::get('/new-journal-entry', 'CNX247\Backend\Accounting\JournalEntryController@create')->name('new-journal-entry');
    Route::post('/new-journal-entry', 'CNX247\Backend\Accounting\JournalEntryController@store');
    Route::get('/view-journal-entry/{slug}', 'CNX247\Backend\Accounting\JournalEntryController@view')->name('view-journal-entry');
    Route::get('/journal-entry/decline/{slug}', 'CNX247\Backend\Accounting\JournalEntryController@declineJV')->name('decline-jv');
    Route::get('/journal-entry/post/{slug}', 'CNX247\Backend\Accounting\JournalEntryController@postJV')->name('post-jv');
    #Budget route
    Route::get('/budget-profile', 'CNX247\Backend\Accounting\BudgetController@index')->name('budget-profile');
    Route::post('/budget-profile', 'CNX247\Backend\Accounting\BudgetController@budgetProfile');
    Route::get('/budget-setup', 'CNX247\Backend\Accounting\BudgetController@budgetSetup')->name('budget-setup');
    Route::post('/budget-setup', 'CNX247\Backend\Accounting\BudgetController@storeBudgetSetup');
    #Bank setup
    #Bank routes
    Route::get('/account/banks', 'CNX247\Backend\Accounting\ChartOfAccountController@bank')->name('bank-accounts');

#QuickBooks routes
//Route::get('/connect-to-quickbooks', 'CNX247\Backend\QuickBooksController@analyzeBusiness');
Route::get('/connect-to-quickbooks', 'CNX247\Backend\QuickBooksController@connectToQuickBooks')->name('connect-to-quickbooks');
Route::get('/call-quickbooks', 'CNX247\Backend\QuickBooksController@makeAPICall');

#Tenant terms -n privacy routes
Route::get('/cnx247/terms-n-conditions', 'CNX247\Backend\TenantController@termsAndConditions')->name('cnx247-terms-n-conditions');
Route::get('/cnx247/privacy-policy', 'CNX247\Backend\TenantController@privacyPolicy')->name('cnx247-privacy-policy');

#Administration routes
Route::get('/terms-n-conditions', 'CNX247\Backend\AdminController@termsAndConditions')->name('terms-n-conditions');
Route::get('/edit/terms-n-conditions/{id}', 'CNX247\Backend\AdminController@showEditTermsForm')->name('edit-terms-n-conditions');
Route::post('/update-terms-n-conditions', 'CNX247\Backend\AdminController@editTermsAndConditions')->name('update-terms-n-conditions');
Route::get('/privacy-policy', 'CNX247\Backend\AdminController@privacyPolicy')->name('privacy-policy');
Route::get('/edit/privacy-policy/{id}', 'CNX247\Backend\AdminController@showEditPrivacyPolicyForm')->name('edit-privacy-policy');
Route::post('/update-privacy-policy', 'CNX247\Backend\AdminController@editPrivacyPolicy')->name('update-privacy-policy');
Route::get('/theme-gallery', 'CNX247\Backend\AdminController@themeGallery')->name('admin-theme-gallery');
Route::post('/theme/gallery/upload', 'CNX247\Backend\AdminController@themeGalleryUpload');
Route::get('/admin/access-faqs', 'CNX247\Backend\AdminController@accessFaqs')->name('access-faqs');
Route::post('/faq/new', 'CNX247\Backend\AdminController@storeFaq');
#Error routes
Route::get('/404', 'CNX247\Backend\ErrorController@error404')->name('404');
