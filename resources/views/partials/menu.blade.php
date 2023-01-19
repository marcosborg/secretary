<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a> 
        </li>
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('audit_log_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.audit-logs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.auditLog.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('user_alert_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.user-alerts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/user-alerts") || request()->is("admin/user-alerts/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-bell c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userAlert.title') }}
                </a>
            </li>
        @endcan
        @can('task_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/task-statuses*") ? "c-show" : "" }} {{ request()->is("admin/task-tags*") ? "c-show" : "" }} {{ request()->is("admin/tasks*") ? "c-show" : "" }} {{ request()->is("admin/tasks-calendars*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-list c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.taskManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('task_status_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.task-statuses.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/task-statuses") || request()->is("admin/task-statuses/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-server c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.taskStatus.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('task_tag_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.task-tags.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/task-tags") || request()->is("admin/task-tags/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-server c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.taskTag.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('task_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.tasks.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/tasks") || request()->is("admin/tasks/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.task.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('tasks_calendar_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.tasks-calendars.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/tasks-calendars") || request()->is("admin/tasks-calendars/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-calendar c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.tasksCalendar.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('organizing_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/years*") ? "c-show" : "" }} {{ request()->is("admin/months*") ? "c-show" : "" }} {{ request()->is("admin/responsibilities*") ? "c-show" : "" }} {{ request()->is("admin/groups*") ? "c-show" : "" }} {{ request()->is("admin/publishers*") ? "c-show" : "" }} {{ request()->is("admin/meetings*") ? "c-show" : "" }} {{ request()->is("admin/reports*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.organizing.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('year_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.years.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/years") || request()->is("admin/years/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-calendar c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.year.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('month_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.months.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/months") || request()->is("admin/months/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-calendar-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.month.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('responsibility_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.responsibilities.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/responsibilities") || request()->is("admin/responsibilities/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-tasks c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.responsibility.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('group_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.groups.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/groups") || request()->is("admin/groups/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-building c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.group.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('publisher_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.publishers.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/publishers") || request()->is("admin/publishers/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.publisher.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('meeting_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.meetings.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/meetings") || request()->is("admin/meetings/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-building c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.meeting.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('report_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.reports.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/reports") || request()->is("admin/reports/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-flag c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.report.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('group_report_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.group-reports.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/group-reports") || request()->is("admin/group-reports/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-chart-bar c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.groupReport.title') }}
                </a>
            </li>
        @endcan
        @can('assistance_to_meeting_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.assistance-to-meetings.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/assistance-to-meetings") || request()->is("admin/assistance-to-meetings/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-list-ol c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.assistanceToMeeting.title') }}
                </a>
            </li>
        @endcan
        @can('shepherding_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/shepherding-reasons*") ? "c-show" : "" }} {{ request()->is("admin/shepherding-visits*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-hand-holding-heart c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.shepherding.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('shepherding_reason_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.shepherding-reasons.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/shepherding-reasons") || request()->is("admin/shepherding-reasons/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-list c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.shepherdingReason.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('shepherding_visit_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.shepherding-visits.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/shepherding-visits") || request()->is("admin/shepherding-visits/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-hand-holding-heart c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.shepherdingVisit.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('elders_meeting_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.elders-meetings.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/elders-meetings") || request()->is("admin/elders-meetings/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.eldersMeeting.title') }}
                </a>
            </li>
        @endcan
        @can('important_date_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.important-dates.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/important-dates") || request()->is("admin/important-dates/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-calendar c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.importantDate.title') }}
                </a>
            </li>
        @endcan
        @can('receipt_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.receipts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/receipts") || request()->is("admin/receipts/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-file-invoice-dollar c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.receipt.title') }}
                </a>
            </li>
        @endcan
        @can('group_publisher_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.group-publishers.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/group-publishers") || request()->is("admin/group-publishers/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-user-friends c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.groupPublisher.title') }}
                </a>
            </li>
        @endcan
        @can('report_by_group_access')
            <li class="c-sidebar-nav-item">
                <a href="/admin/report-by-groups/1" class="c-sidebar-nav-link {{ request()->is("admin/report-by-groups") || request()->is("admin/report-by-groups/*") ? "c-active" : "" }}">
                    <i class="fa-fw far fa-object-group c-sidebar-nav-icon"></i>
                    {{ trans('cruds.reportByGroup.title') }}
                </a>
            </li>
        @endcan
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.systemCalendar") }}" class="c-sidebar-nav-link {{ request()->is("admin/system-calendar") || request()->is("admin/system-calendar/*") ? "c-active" : "" }}">
                <i class="c-sidebar-nav-icon fa-fw fas fa-calendar">

                </i>
                {{ trans('global.systemCalendar') }}
            </a>
        </li>
        @can('christian_life_and_ministry_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/*") ? "c-show" : "" }} {{ request()->is("admin/monthly-schedules*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-graduation-cap c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.christianLifeAndMinistry.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('lm_setting_access')
                        <li class="c-sidebar-nav-dropdown {{ request()->is("admin/clm-meetings*") ? "c-show" : "" }} {{ request()->is("admin/students*") ? "c-show" : "" }} {{ request()->is("admin/assignments*") ? "c-show" : "" }} {{ request()->is("admin/life-ministries*") ? "c-show" : "" }} {{ request()->is("admin/life-ministry-events*") ? "c-show" : "" }}">
                            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.lmSetting.title') }}
                            </a>
                            <ul class="c-sidebar-nav-dropdown-items">
                                @can('clm_meeting_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.clm-meetings.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/clm-meetings") || request()->is("admin/clm-meetings/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-user-tie c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.clmMeeting.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('student_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.students.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/students") || request()->is("admin/students/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-graduation-cap c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.student.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('assignment_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.assignments.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/assignments") || request()->is("admin/assignments/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-ticket-alt c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.assignment.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('life_ministry_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.life-ministries.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/life-ministries") || request()->is("admin/life-ministries/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-calendar-alt c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.lifeMinistry.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('life_ministry_event_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.life-ministry-events.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/life-ministry-events") || request()->is("admin/life-ministry-events/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.lifeMinistryEvent.title') }}
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                    @can('monthly_schedule_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.monthly-schedules.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/monthly-schedules") || request()->is("admin/monthly-schedules/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-calendar-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.monthlySchedule.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @php($unread = \App\Models\QaTopic::unreadCount())
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.messenger.index") }}" class="{{ request()->is("admin/messenger") || request()->is("admin/messenger/*") ? "c-active" : "" }} c-sidebar-nav-link">
                    <i class="c-sidebar-nav-icon fa-fw fa fa-envelope">

                    </i>
                    <span>{{ trans('global.messages') }}</span>
                    @if($unread > 0)
                        <strong>( {{ $unread }} )</strong>
                    @endif

                </a>
            </li>
            @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                @can('profile_password_edit')
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                            <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                            </i>
                            {{ trans('global.change_password') }}
                        </a>
                    </li>
                @endcan
            @endif
            <li class="c-sidebar-nav-item">
                <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
    </ul>

</div>