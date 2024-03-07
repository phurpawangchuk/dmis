<?php
return [   
    'PERMISSIONS' => [
       
        'ADMIN_PANEL_ACCESS' => 'admin_panel_access',

        'USER_PANEL_ACCESS' => 'user_Panel_access',
        'USER_CREATE'       => 'user_create',
        'USER_EDIT'         => 'user_edit',
        'USER_DELETE'       => 'user_delete',
        
        'ROLE_PANEL_ACCESS' => 'role_panel_access',
        'ROLE_CREATE'       => 'role_create',
        'ROLE_EDIT'         => 'role_edit',
        'ROLE_DELETE'       => 'role_delete',

        'PERMISSION_PANEL_ACCESS' => 'permission_panel_access',
        'PERMISSION_CREATE' => 'permission_create',
        'PERMISSION_EDIT'   => 'permission_edit',
        'PERMISSION_DELETE' => 'permission_delete',
        
        'POST_PANEL_ACCESS' => 'posts_access',
        'POST_CREATE'       => 'post_create',
        'POST_EDIT'         => 'post_edit',
        'POST_DELETE'       => 'post_delete',
        'POST_SHOW'         => 'post_show',

        'PRODUCT_PANEL_ACCESS' => 'products_access',
        'PRODUCT_CREATE'       => 'product_create',
        'PRODUCT_EDIT'         => 'product_edit',
        'PRODUCT_DELETE'       => 'product_delete',

        'LEAVE_PANEL_ACCESS' => 'leave_panel_access',
        'LEAVE_CREATE'       => 'leave_create',
        'LEAVE_EDIT'         => 'leave_edit',
        'LEAVE_DELETE'       => 'leave_delete',
        'LEAVE_SHOW'         => 'leave_show',
        'LEAVE_VERIFY'       => 'leave_verify',
        'LEAVE_APPROVE'      => 'leave_approve',

        'ATTENDANCE_PANEL_ACCESS' => 'attendance_panel_access',
        'ATTENDANCE_CREATE'       => 'attendance_create',
        'ATTENDANCE_EDIT'         => 'attendance_edit',
        'ATTENDANCE_DELETE'       => 'lattendance_delete',
        'ATTENDANCE_SHOW'         => 'attendance_show',
        'ATTENDANCE_VERIFY'       => 'attendance_verify',
        'ATTENDANCE_APPROVE'      => 'attendance_approve',

        'DISPATCHLETTER_PANEL_ACCESS' => 'dispatchletter_panel_access',
        'DISPATCHLETTER_CREATE'       => 'dispatchletter_create',
        'DISPATCHLETTER_EDIT'         => 'dispatchletter_edit',
        'DISPATCHLETTER_DELETE'       => 'dispatchletter_delete',
        'DISPATCHLETTER_SHOW'         => 'dispatchletter_show',

        'RECEIVELETTER_PANEL_ACCESS' => 'receiveletter_panel_access',
        'RECEIVELETTER_CREATE'       => 'receiveletter_create',
        'RECEIVELETTER_EDIT'         => 'receiveletter_edit',
        'RECEIVELETTER_DELETE'       => 'receiveletter_delete',
        'RECEIVELETTER_SHOW'         => 'receiveletter_show',

        'WORKFLOW_PANEL_ACCESS' => 'workflow_panel_access',
        'WORKFLOW_CREATE'       => 'workflow_create',
        'WORKFLOW_EDIT'         => 'workflow_edit',
        'WORKFLOW_DELETE'       => 'workflow_delete',
        'WORKFLOW_SHOW'         => 'workflow_show',

        'LEAVECATEGORY_PANEL_ACCESS' => 'leavecategoty_panel_access',
        'LEAVECATEGORY_CREATE'       => 'leavecategoty_create',
        'LEAVECATEGORY_EDIT'         => 'leavecategoty_edit',
        'LEAVECATEGORY_DELETE'       => 'leavecategoty_delete',
    ],

    'FILE_UPLOAD' => [
        'FILE_SIZE'   => '|mimes:pdf,xlx,csv|max:2048',
        'FILE_PATH'   => 'uploads',
    ],
    'SSO_CONFIG' => [
        'SSO_BASE_URL'   => 'https://stg-sso.dit.gov.bt',
        'CONSUMER_KEY'   => 'qMS4BL9ZdSQa4cAMNzkUJEQ_C5Qa',
        'CONSUMER_SECRET'=> 'x5cNjWEN90QtSdE1bXOGGAAp8s0a',
        'CALL_BACK_URL'   => 'http://localhost/sso/public/dashboard',
        'logout_CALL_BACK_URL'   => 'http://localhost/sso/public/logout',
        'WWW_URL'       => 'http://localhost/sso/public/www',
        // 'WWW_URL'       => 'http://localhost:4200/',
        'SITE_URL'      => 'http://localhost/sso/public',
        'LOADER_IMG'    => 'http://localhost/sso/public/assets/img/loader.gif',
        'ALLOWED_HOST'  =>'172.20.10.3',
        'ALLOWED_HOST'  =>'::1',
        
    ],
    'LAND_CONFIG' => [
        'NLCS_CLIENT_ID'   => 'PfcAhklMiIVbUEm3XJ0mXsqSw0ca',
        'NLCS_CLIENT_SECRET'=> 'uP9fBlb4xp8ronXityND4FiXswwa',
        'TOKEN_ENDPOINT'   => 'https://datahub-apim.dit.gov.bt/token',
        'NLCS_BASE_URI'   => 'https://datahub-apim.dit.gov.bt/nlcs_landdetailapi/1.0.0/',
    ],
    'TAX_YEAR' => [
        'START_MONTH' => '01-01-2022',
    ],
    'ALLOW_CHAR' => [
        'PERMIT_CHAR' => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
    ],
];