<?php

use Illuminate\Support\Facades\Hash;

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('dashboard/{month_id}', 'HomeController@dashboard');
    Route::post('dashboard/change_month', 'HomeController@changeMonth');

    Route::prefix('maintenance')->group(
        function () {
            Route::get(
                '/',
                function () {
                        return [];
                    }
            );
            Route::get(
                'up',
                function () {
                        Artisan::call('up');
                        return redirect('/');
                    }
            );
            Route::get(
                'down',
                function () {
                        $hash = Hash::make(rand());
                        Artisan::call('down --secret="' . $hash . '"');
                        return redirect('/' . $hash);
                    }
            );
        }
    );

    // Forms
    Route::prefix('forms')->group(
        function () {
            Route::post('addMeeting', 'MonthlyScheduleController@addMeeting');
        }
    );

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Task Status
    Route::delete('task-statuses/destroy', 'TaskStatusController@massDestroy')->name('task-statuses.massDestroy');
    Route::resource('task-statuses', 'TaskStatusController');

    // Task Tag
    Route::delete('task-tags/destroy', 'TaskTagController@massDestroy')->name('task-tags.massDestroy');
    Route::resource('task-tags', 'TaskTagController');

    // Task
    Route::delete('tasks/destroy', 'TaskController@massDestroy')->name('tasks.massDestroy');
    Route::post('tasks/media', 'TaskController@storeMedia')->name('tasks.storeMedia');
    Route::post('tasks/ckmedia', 'TaskController@storeCKEditorImages')->name('tasks.storeCKEditorImages');
    Route::resource('tasks', 'TaskController');

    // Tasks Calendar
    Route::resource('tasks-calendars', 'TasksCalendarController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Publisher
    Route::delete('publishers/destroy', 'PublisherController@massDestroy')->name('publishers.massDestroy');
    Route::resource('publishers', 'PublisherController');

    // Group
    Route::delete('groups/destroy', 'GroupController@massDestroy')->name('groups.massDestroy');
    Route::resource('groups', 'GroupController');

    // Responsibility
    Route::delete('responsibilities/destroy', 'ResponsibilityController@massDestroy')->name('responsibilities.massDestroy');
    Route::resource('responsibilities', 'ResponsibilityController');

    // Years
    Route::delete('years/destroy', 'YearsController@massDestroy')->name('years.massDestroy');
    Route::resource('years', 'YearsController');

    // Month
    Route::delete('months/destroy', 'MonthController@massDestroy')->name('months.massDestroy');
    Route::resource('months', 'MonthController');

    // Report
    Route::delete('reports/destroy', 'ReportController@massDestroy')->name('reports.massDestroy');
    Route::resource('reports', 'ReportController');

    // Meeting
    Route::delete('meetings/destroy', 'MeetingController@massDestroy')->name('meetings.massDestroy');
    Route::resource('meetings', 'MeetingController');

    // Group Report
    Route::resource('group-reports', 'GroupReportController');
    Route::post('updateReport', 'GroupReportController@updateReport');

    // Assistance To Meeting
    Route::resource('assistance-to-meetings', 'AssistanceToMeetingController');
    Route::post('save-assistance', 'AssistanceToMeetingController@saveAssistance');

    // Shepherding Reasons
    Route::delete('shepherding-reasons/destroy', 'ShepherdingReasonsController@massDestroy')->name('shepherding-reasons.massDestroy');
    Route::resource('shepherding-reasons', 'ShepherdingReasonsController');

    // Shepherding Visits
    Route::delete('shepherding-visits/destroy', 'ShepherdingVisitsController@massDestroy')->name('shepherding-visits.massDestroy');
    Route::post('shepherding-visits/media', 'ShepherdingVisitsController@storeMedia')->name('shepherding-visits.storeMedia');
    Route::post('shepherding-visits/ckmedia', 'ShepherdingVisitsController@storeCKEditorImages')->name('shepherding-visits.storeCKEditorImages');
    Route::resource('shepherding-visits', 'ShepherdingVisitsController');

    // Elders Meeting
    Route::delete('elders-meetings/destroy', 'EldersMeetingController@massDestroy')->name('elders-meetings.massDestroy');
    Route::post('elders-meetings/media', 'EldersMeetingController@storeMedia')->name('elders-meetings.storeMedia');
    Route::post('elders-meetings/ckmedia', 'EldersMeetingController@storeCKEditorImages')->name('elders-meetings.storeCKEditorImages');
    Route::resource('elders-meetings', 'EldersMeetingController');
    Route::post('elders-meetings/sendByEmail', 'EldersMeetingController@sendByEmail');

    // Important Date
    Route::delete('important-dates/destroy', 'ImportantDateController@massDestroy')->name('important-dates.massDestroy');
    Route::resource('important-dates', 'ImportantDateController');

    // Receipt
    Route::delete('receipts/destroy', 'ReceiptController@massDestroy')->name('receipts.massDestroy');
    Route::post('receipts/media', 'ReceiptController@storeMedia')->name('receipts.storeMedia');
    Route::post('receipts/ckmedia', 'ReceiptController@storeCKEditorImages')->name('receipts.storeCKEditorImages');
    Route::resource('receipts', 'ReceiptController');

    // Group Publisher
    Route::resource('group-publishers', 'GroupPublisherController');

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
    Route::get('messenger', 'MessengerController@index')->name('messenger.index');
    Route::get('messenger/create', 'MessengerController@createTopic')->name('messenger.createTopic');
    Route::post('messenger', 'MessengerController@storeTopic')->name('messenger.storeTopic');
    Route::get('messenger/inbox', 'MessengerController@showInbox')->name('messenger.showInbox');
    Route::get('messenger/outbox', 'MessengerController@showOutbox')->name('messenger.showOutbox');
    Route::get('messenger/{topic}', 'MessengerController@showMessages')->name('messenger.showMessages');
    Route::delete('messenger/{topic}', 'MessengerController@destroyTopic')->name('messenger.destroyTopic');
    Route::post('messenger/{topic}/reply', 'MessengerController@replyToTopic')->name('messenger.reply');
    Route::get('messenger/{topic}/reply', 'MessengerController@showReply')->name('messenger.showReply');

    // Report By Group
    Route::get('report-by-groups/{group_id}', 'ReportByGroupController@index');
    Route::get('report-by-group/{group_id}', 'ReportByGroupController@reportByGroup');
    Route::get('report-by-publisher/{publisher_id}', 'ReportByGroupController@reportByPublisher');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Student
    Route::delete('students/destroy', 'StudentController@massDestroy')->name('students.massDestroy');
    Route::resource('students', 'StudentController');

    // Assignment
    Route::delete('assignments/destroy', 'AssignmentController@massDestroy')->name('assignments.massDestroy');
    Route::resource('assignments', 'AssignmentController');

    // Life Ministry
    Route::delete('life-ministries/destroy', 'LifeMinistryController@massDestroy')->name('life-ministries.massDestroy');
    Route::resource('life-ministries', 'LifeMinistryController');

    // Life Ministry Event
    Route::delete('life-ministry-events/destroy', 'LifeMinistryEventController@massDestroy')->name('life-ministry-events.massDestroy');
    Route::resource('life-ministry-events', 'LifeMinistryEventController');

    // Monthly Schedule
    Route::resource('monthly-schedules', 'MonthlyScheduleController');
    Route::get('ajax', 'MonthlyScheduleController@ajax');
    Route::get('deleteMeeting/{meeting_id}', 'MonthlyScheduleController@deleteMeeting');
    Route::get('getMeeting/{meeting_id}', 'MonthlyScheduleController@getMeeting');
    Route::post('updateMeeting', 'MonthlyScheduleController@updateMeeting');
    Route::get('getAssignments', 'MonthlyScheduleController@getAssignments');
    Route::get('getPublishers/{meeting_id}/{assignment}', 'MonthlyScheduleController@getPublishers');
});