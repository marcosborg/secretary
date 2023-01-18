<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 18,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 19,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 20,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 21,
                'title' => 'task_management_access',
            ],
            [
                'id'    => 22,
                'title' => 'task_status_create',
            ],
            [
                'id'    => 23,
                'title' => 'task_status_edit',
            ],
            [
                'id'    => 24,
                'title' => 'task_status_show',
            ],
            [
                'id'    => 25,
                'title' => 'task_status_delete',
            ],
            [
                'id'    => 26,
                'title' => 'task_status_access',
            ],
            [
                'id'    => 27,
                'title' => 'task_tag_create',
            ],
            [
                'id'    => 28,
                'title' => 'task_tag_edit',
            ],
            [
                'id'    => 29,
                'title' => 'task_tag_show',
            ],
            [
                'id'    => 30,
                'title' => 'task_tag_delete',
            ],
            [
                'id'    => 31,
                'title' => 'task_tag_access',
            ],
            [
                'id'    => 32,
                'title' => 'task_create',
            ],
            [
                'id'    => 33,
                'title' => 'task_edit',
            ],
            [
                'id'    => 34,
                'title' => 'task_show',
            ],
            [
                'id'    => 35,
                'title' => 'task_delete',
            ],
            [
                'id'    => 36,
                'title' => 'task_access',
            ],
            [
                'id'    => 37,
                'title' => 'tasks_calendar_access',
            ],
            [
                'id'    => 38,
                'title' => 'publisher_create',
            ],
            [
                'id'    => 39,
                'title' => 'publisher_edit',
            ],
            [
                'id'    => 40,
                'title' => 'publisher_show',
            ],
            [
                'id'    => 41,
                'title' => 'publisher_delete',
            ],
            [
                'id'    => 42,
                'title' => 'publisher_access',
            ],
            [
                'id'    => 43,
                'title' => 'group_create',
            ],
            [
                'id'    => 44,
                'title' => 'group_edit',
            ],
            [
                'id'    => 45,
                'title' => 'group_show',
            ],
            [
                'id'    => 46,
                'title' => 'group_delete',
            ],
            [
                'id'    => 47,
                'title' => 'group_access',
            ],
            [
                'id'    => 48,
                'title' => 'responsibility_create',
            ],
            [
                'id'    => 49,
                'title' => 'responsibility_edit',
            ],
            [
                'id'    => 50,
                'title' => 'responsibility_show',
            ],
            [
                'id'    => 51,
                'title' => 'responsibility_delete',
            ],
            [
                'id'    => 52,
                'title' => 'responsibility_access',
            ],
            [
                'id'    => 53,
                'title' => 'year_create',
            ],
            [
                'id'    => 54,
                'title' => 'year_edit',
            ],
            [
                'id'    => 55,
                'title' => 'year_show',
            ],
            [
                'id'    => 56,
                'title' => 'year_delete',
            ],
            [
                'id'    => 57,
                'title' => 'year_access',
            ],
            [
                'id'    => 58,
                'title' => 'month_create',
            ],
            [
                'id'    => 59,
                'title' => 'month_edit',
            ],
            [
                'id'    => 60,
                'title' => 'month_show',
            ],
            [
                'id'    => 61,
                'title' => 'month_delete',
            ],
            [
                'id'    => 62,
                'title' => 'month_access',
            ],
            [
                'id'    => 63,
                'title' => 'report_create',
            ],
            [
                'id'    => 64,
                'title' => 'report_edit',
            ],
            [
                'id'    => 65,
                'title' => 'report_show',
            ],
            [
                'id'    => 66,
                'title' => 'report_delete',
            ],
            [
                'id'    => 67,
                'title' => 'report_access',
            ],
            [
                'id'    => 68,
                'title' => 'meeting_create',
            ],
            [
                'id'    => 69,
                'title' => 'meeting_edit',
            ],
            [
                'id'    => 70,
                'title' => 'meeting_show',
            ],
            [
                'id'    => 71,
                'title' => 'meeting_delete',
            ],
            [
                'id'    => 72,
                'title' => 'meeting_access',
            ],
            [
                'id'    => 73,
                'title' => 'organizing_access',
            ],
            [
                'id'    => 74,
                'title' => 'group_report_create',
            ],
            [
                'id'    => 75,
                'title' => 'group_report_edit',
            ],
            [
                'id'    => 76,
                'title' => 'group_report_show',
            ],
            [
                'id'    => 77,
                'title' => 'group_report_delete',
            ],
            [
                'id'    => 78,
                'title' => 'group_report_access',
            ],
            [
                'id'    => 79,
                'title' => 'assistance_to_meeting_create',
            ],
            [
                'id'    => 80,
                'title' => 'assistance_to_meeting_edit',
            ],
            [
                'id'    => 81,
                'title' => 'assistance_to_meeting_show',
            ],
            [
                'id'    => 82,
                'title' => 'assistance_to_meeting_delete',
            ],
            [
                'id'    => 83,
                'title' => 'assistance_to_meeting_access',
            ],
            [
                'id'    => 84,
                'title' => 'shepherding_access',
            ],
            [
                'id'    => 85,
                'title' => 'shepherding_reason_create',
            ],
            [
                'id'    => 86,
                'title' => 'shepherding_reason_edit',
            ],
            [
                'id'    => 87,
                'title' => 'shepherding_reason_show',
            ],
            [
                'id'    => 88,
                'title' => 'shepherding_reason_delete',
            ],
            [
                'id'    => 89,
                'title' => 'shepherding_reason_access',
            ],
            [
                'id'    => 90,
                'title' => 'shepherding_visit_create',
            ],
            [
                'id'    => 91,
                'title' => 'shepherding_visit_edit',
            ],
            [
                'id'    => 92,
                'title' => 'shepherding_visit_show',
            ],
            [
                'id'    => 93,
                'title' => 'shepherding_visit_delete',
            ],
            [
                'id'    => 94,
                'title' => 'shepherding_visit_access',
            ],
            [
                'id'    => 95,
                'title' => 'elders_meeting_create',
            ],
            [
                'id'    => 96,
                'title' => 'elders_meeting_edit',
            ],
            [
                'id'    => 97,
                'title' => 'elders_meeting_show',
            ],
            [
                'id'    => 98,
                'title' => 'elders_meeting_delete',
            ],
            [
                'id'    => 99,
                'title' => 'elders_meeting_access',
            ],
            [
                'id'    => 100,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
