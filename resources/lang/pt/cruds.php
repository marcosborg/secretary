<?php

return [
    'userManagement' => [
        'title'          => 'Gestão de usuários',
        'title_singular' => 'Gestão de usuários',
    ],
    'permission' => [
        'title'          => 'Permissões',
        'title_singular' => 'Permissão',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Título',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'Grupos',
        'title_singular' => 'Função',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Título',
            'title_helper'       => ' ',
            'permissions'        => 'Permissões',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title'          => 'Usuários',
        'title_singular' => 'Usuário',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Nome',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Password',
            'password_helper'          => ' ',
            'roles'                    => 'Regras',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
        ],
    ],
    'userAlert' => [
        'title'          => 'Alertas',
        'title_singular' => 'Alerta',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'alert_text'        => 'Texto de alerta',
            'alert_text_helper' => ' ',
            'alert_link'        => 'Link de alerta',
            'alert_link_helper' => ' ',
            'user'              => 'Utilizadores',
            'user_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
        ],
    ],
    'taskManagement' => [
        'title'          => 'Gestor de tarefas',
        'title_singular' => 'Gestor de tarefa',
    ],
    'taskStatus' => [
        'title'          => 'Estados',
        'title_singular' => 'Estado',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Nome',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'taskTag' => [
        'title'          => 'Etiquetas',
        'title_singular' => 'Etiqueta',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Nome',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'task' => [
        'title'          => 'Tarefas',
        'title_singular' => 'Tarefa',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'name'               => 'Nome',
            'name_helper'        => ' ',
            'description'        => 'Descrição',
            'description_helper' => ' ',
            'status'             => 'Estado',
            'status_helper'      => ' ',
            'tag'                => 'Etiquetas',
            'tag_helper'         => ' ',
            'attachment'         => 'Anexo',
            'attachment_helper'  => ' ',
            'due_date'           => 'Até a data',
            'due_date_helper'    => ' ',
            'assigned_to'        => 'Atribuido a',
            'assigned_to_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated At',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted At',
            'deleted_at_helper'  => ' ',
            'created_by'         => 'Created By',
            'created_by_helper'  => ' ',
        ],
    ],
    'tasksCalendar' => [
        'title'          => 'Calendário',
        'title_singular' => 'Calendário',
    ],
    'publisher' => [
        'title'          => 'Publicadores',
        'title_singular' => 'Publicadore',
        'fields'         => [
            'id'                      => 'ID',
            'id_helper'               => ' ',
            'name'                    => 'Nome',
            'name_helper'             => ' ',
            'full_name'               => 'Nome completo',
            'full_name_helper'        => ' ',
            'address'                 => 'Endereço',
            'address_helper'          => ' ',
            'phone'                   => 'Telefone',
            'phone_helper'            => ' ',
            'emergency'               => 'Contacto de emergência',
            'emergency_helper'        => ' ',
            'celphone'                => 'Telemóvel',
            'celphone_helper'         => ' ',
            'baptism'                 => 'Data de batismo',
            'baptism_helper'          => ' ',
            'birth'                   => 'Data de nascimento',
            'birth_helper'            => ' ',
            'email'                   => 'Email',
            'email_helper'            => ' ',
            'created_at'              => 'Created at',
            'created_at_helper'       => ' ',
            'updated_at'              => 'Updated at',
            'updated_at_helper'       => ' ',
            'deleted_at'              => 'Deleted at',
            'deleted_at_helper'       => ' ',
            'responsibilities'        => 'Responsabilidades',
            'responsibilities_helper' => ' ',
            'rgpd'                    => 'RGPD',
            'rgpd_helper'             => ' ',
            'dav'                     => 'DAV',
            'dav_helper'              => ' ',
            'dav_expiration'          => 'Expiração da DAV',
            'dav_expiration_helper'   => ' ',
            'group'                   => 'Grupo de serviço',
            'group_helper'            => ' ',
        ],
    ],
    'group' => [
        'title'          => 'Grupos de serviço',
        'title_singular' => 'Grupos de serviço',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'number'            => 'Número',
            'number_helper'     => ' ',
            'overseer'          => 'Superintendente',
            'overseer_helper'   => ' ',
            'helper'            => 'Ajudante',
            'helper_helper'     => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'responsibility' => [
        'title'          => 'Responsabilidades',
        'title_singular' => 'Responsabilidade',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Nome',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'pioneer'           => 'Pioneiro',
            'pioneer_helper'    => ' ',
        ],
    ],
    'year' => [
        'title'          => 'Anos',
        'title_singular' => 'Ano',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Nome',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'month' => [
        'title'          => 'Meses',
        'title_singular' => 'Mese',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'year'              => 'Ano',
            'year_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'name'              => 'Nome',
            'name_helper'       => ' ',
            'number'            => 'Número',
            'number_helper'     => ' ',
        ],
    ],
    'report' => [
        'title'          => 'Relatórios',
        'title_singular' => 'Relatório',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
            'month'               => 'Mês',
            'month_helper'        => ' ',
            'publisher'           => 'Publicador',
            'publisher_helper'    => ' ',
            'publications'        => 'Publicações',
            'publications_helper' => ' ',
            'videos'              => 'Videos',
            'videos_helper'       => ' ',
            'hours'               => 'Horas',
            'hours_helper'        => ' ',
            'revisits'            => 'Revisitas',
            'revisits_helper'     => ' ',
            'studies'             => 'Estudos',
            'studies_helper'      => ' ',
            'observations'        => 'Observações',
            'observations_helper' => ' ',
            'pioneer'             => 'Pioneiro',
            'pioneer_helper'      => ' ',
        ],
    ],
    'meeting' => [
        'title'          => 'Reuniões',
        'title_singular' => 'Reuniõe',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'month'             => 'Mês',
            'month_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'week'              => 'Semana',
            'week_helper'       => ' ',
            'meeting'           => 'Reunião',
            'meeting_helper'    => ' ',
            'presences'         => 'Assistência',
            'presences_helper'  => ' ',
            'receipt'           => 'Recibo',
            'receipt_helper'    => ' ',
        ],
    ],
    'organizing' => [
        'title'          => 'Organizar',
        'title_singular' => 'Organizar',
    ],
    'groupReport' => [
        'title'          => 'Relatório do grupo',
        'title_singular' => 'Relatório do grupo',
    ],
    'assistanceToMeeting' => [
        'title'          => 'Assistência às reuniões',
        'title_singular' => 'Assistência às reuniõe',
    ],
    'shepherdingReason' => [
        'title'          => 'Motivos',
        'title_singular' => 'Motivo',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Nome',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'shepherdingVisit' => [
        'title'          => 'Visitas',
        'title_singular' => 'Visita',
        'fields'         => [
            'id'                        => 'ID',
            'id_helper'                 => ' ',
            'group'                     => 'Grupo de serviço',
            'group_helper'              => ' ',
            'publisher'                 => 'Publicador',
            'publisher_helper'          => ' ',
            'datetime'                  => 'Dia e hora da visita',
            'datetime_helper'           => ' ',
            'shepherding_reason'        => 'Motivo da visita',
            'shepherding_reason_helper' => ' ',
            'accomplished'              => 'Realizada',
            'accomplished_helper'       => ' ',
            'next_visit'                => 'Próxima visita',
            'next_visit_helper'         => ' ',
            'created_at'                => 'Created at',
            'created_at_helper'         => ' ',
            'updated_at'                => 'Updated at',
            'updated_at_helper'         => ' ',
            'deleted_at'                => 'Deleted at',
            'deleted_at_helper'         => ' ',
            'observations'              => 'Observações',
            'observations_helper'       => ' ',
            'created_by'                => 'Created By',
            'created_by_helper'         => ' ',
        ],
    ],
    'eldersMeeting' => [
        'title'          => 'Reuniões de anciãos',
        'title_singular' => 'Reuniões de ancião',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'datetime'          => 'Dia e hora',
            'datetime_helper'   => ' ',
            'subject'           => 'Assunto',
            'subject_helper'    => ' ',
            'report'            => 'Relatório',
            'report_helper'     => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'reportByGroup' => [
        'title'          => 'Relatórios por grupo',
        'title_singular' => 'Relatórios por grupo',
    ],
    'shepherding' => [
        'title'          => 'Pastoreio',
        'title_singular' => 'Pastoreio',
    ],
    'importantDate' => [
        'title'          => 'Datas importantes',
        'title_singular' => 'Datas importante',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'name'               => 'Nome',
            'name_helper'        => ' ',
            'date'               => 'Data',
            'date_helper'        => ' ',
            'description'        => 'Descrição',
            'description_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
            'created_by'         => 'Created By',
            'created_by_helper'  => ' ',
        ],
    ],
    'groupPublisher' => [
        'title'          => 'Publicadores do grupo',
        'title_singular' => 'Publicadores do grupo',
    ],
    'receipt' => [
        'title'          => 'Recibos',
        'title_singular' => 'Recibo',
        'fields'         => [
            'id'                                 => 'ID',
            'id_helper'                          => ' ',
            'date'                               => 'Data',
            'date_helper'                        => ' ',
            'photo'                              => 'Fotografia do recibo original',
            'photo_helper'                       => ' ',
            'worldwide_work'                     => 'Obra mundial',
            'worldwide_work_helper'              => ' ',
            'local_congregation_expenses'        => 'Despesas da congregação local',
            'local_congregation_expenses_helper' => ' ',
            'other'                              => 'Outros recebimentos',
            'other_helper'                       => ' ',
            'completed_by'                       => 'Servo de contas',
            'completed_by_helper'                => ' ',
            'verified_by'                        => 'Conferido por',
            'verified_by_helper'                 => ' ',
            'created_at'                         => 'Created at',
            'created_at_helper'                  => ' ',
            'updated_at'                         => 'Updated at',
            'updated_at_helper'                  => ' ',
            'deleted_at'                         => 'Deleted at',
            'deleted_at_helper'                  => ' ',
        ],
    ],
    'auditLog' => [
        'title'          => 'Audit Logs',
        'title_singular' => 'Audit Log',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'description'         => 'Description',
            'description_helper'  => ' ',
            'subject_id'          => 'Subject ID',
            'subject_id_helper'   => ' ',
            'subject_type'        => 'Subject Type',
            'subject_type_helper' => ' ',
            'user_id'             => 'User ID',
            'user_id_helper'      => ' ',
            'properties'          => 'Properties',
            'properties_helper'   => ' ',
            'host'                => 'Host',
            'host_helper'         => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
        ],
    ],
    'christianLifeAndMinistry' => [
        'title'          => 'Vida e Ministério Cristãos',
        'title_singular' => 'Vida e Ministério Cristão',
    ],
    'student' => [
        'title'          => 'Estudante',
        'title_singular' => 'Estudante',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'name'               => 'Nome',
            'name_helper'        => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
            'assignments'        => 'Designações',
            'assignments_helper' => ' ',
        ],
    ],
    'assignment' => [
        'title'          => 'Designações',
        'title_singular' => 'Designaçõe',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Nome',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'color'             => 'Cor',
            'color_helper'      => ' ',
        ],
    ],
    'lifeMinistry' => [
        'title'          => 'Reuniões',
        'title_singular' => 'Reuniõe',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'date'              => 'Data',
            'date_helper'       => ' ',
            'disabled'          => 'Não se vai realizar',
            'disabled_helper'   => ' ',
            'reason'            => 'Razão para não se realizar',
            'reason_helper'     => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'lifeMinistryEvent' => [
        'title'          => 'Designações por reunião',
        'title_singular' => 'Designações por reunião',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'life_ministry'        => 'Reunião',
            'life_ministry_helper' => ' ',
            'assignment'           => 'Designação',
            'assignment_helper'    => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
            'student'              => 'Estudante',
            'student_helper'       => ' ',
        ],
    ],
    'lmSetting' => [
        'title'          => 'Configurações',
        'title_singular' => 'Configuraçõe',
    ],
    'monthlySchedule' => [
        'title'          => 'Programação Mensal',
        'title_singular' => 'Programação Mensal',
    ],
];
