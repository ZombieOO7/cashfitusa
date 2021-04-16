<?php

return [
    'websetting' => [
        'logo_extension' => 'jpg,jpeg,png',
        'logo_size' => '2',
        'favicon_extension' => 'svg,png,ico',
        'favicon_size' => '2',
        'url' => true,
        'logo_height' => '100px',
        'logo_width' => '100px',
        'favicon_width' => '100px',
        'favicon_height' => '100px',
        'active_tab' => [
            1 => 'general_tab',
            2 => 'social_media_tab',
            3 => 'meta_tab',
            4 => 'push_notification_tab',
        ],
    ],

    // set oAuthAccessTokens name
    'oAuthAccessTokensName' => 'Ipps',
    'text_length' => 100,
    'content_length' => 500,
    'name_length' => 50,
    'text_length' => 100,
    'email_length' => 50,
    'content_length' => 500,
    'password_max_length' => 16,
    'password_min_length' => 6,
    'email_length' => 50,
    'max_phone_length' => 10,
    'min_phone_length' => 10,
    'amount_length' => 8,
    'default_pr' => 8,
    'currency_symbol' => '$',
    'pr_symbol' => '%',
    'zip_code_length' => 5,
    'year_length'=>3,
    'account_max_length' =>14,
    'account_min_length' =>6,
    'routing_max_length' =>9,
    'ssn_length' => 11,


    // User Type
    'manager' => 1,
    'engineer' => 2,
    'operator' => 3,

    'user' => [
        'folder_name' => 'users',
    ],

    'faqCategory' => [
        'folder_name' => 'faqs',
    ],
    'app' => [
        'folder_name' => 'apps',
    ],
    'earning' => [
        'folder_name' => 'earning',
    ],
    'review' => [
        'folder_name' => 'review',
    ],
    'web_folder' => 'websetting',
    'view_web_folder_resize' => 'websetting/thumb/',
    'app_path' => 'storage/app/',

    'thumb_image_width' => 211,
    'thumb_image_height' => 186,
    'storage_path' => 'public/uploads/',

    // User Type Text
    'user_types' => [
        1 => 'Manager',
        2 => 'Engineer',
        3 => 'Operator',
    ],

    //Priority Text
    'priorites' => [
        1 => 'ALL',
        2 => 'LOW',
        3 => 'MEDIUM',
        4 => 'HIGH',
    ],

    // Job Status
    'job_status_text' => [
        1 => 'JOB REQUEST',
        2 => 'ASSIGNED',
        3 => 'ONGOING',
        4 => 'COMPLETED',
        5 => 'DECLINED',
        6 => 'KIV',
    ],

    // Job listing pagination
    'job_page_limit' => 20,

    // FAQ Listing Pagination
    'faq_page_limit' => 20,

    // Email Template Slugs
    'verify_email' => 'verify-your-email',
    'under_review' => 'profile-under-review',
    // status
    'active' => 'Active',
    'inactive' => 'Inactive',
    // Action
    'delete' => 'Delete',
    'status_inactive_value' => '0',
    'status_active_value' => '1',

    // Account verfied/declined
    'profile_review' => [
        'under_review' => 0,
        'verified' => 1,
        'declined' => 2,
    ],

    // Job image dir
    'job' => [
        'folder_name' => 'jobs',
        'directory_path' => 'public/uploads/jobs',
    ],

    // Job Status list
    'job_status_list' => [
        'job_request' => 1,
        'assigned' => 2,
        'ongoing' => 3,
        'completed' => 4,
        'declined' => 5,
        'kiv' => 6,
    ],

    // Priority Status
    'priorites_text' => [
        2 => 'LOW',
        3 => 'MEDIUM',
        4 => 'HIGH',
    ],
    'priorites_colors' => [
        2 => 'success',
        3 => 'warning',
        4 => 'danger',
    ],

    'job_status_color' => [
        1 => '#ff7474',
        2 => '#1c216a',
        3 => '#f00',
        4 => '#2c8213',
        5 => '#5a00ff',
        6 => '#065932',
    ],

    'permission_status' => [
        1 => 'On',
        0 => 'Off',
    ],
    'loan_status' =>[
        0 => 'Pending',
        1 => 'Approve',
        2 => 'Reject',
    ],
    'approve' => 1,
    'reject' => 2,
    'account_type' =>[
        1 => 'Saving Account',
        2 => 'Checking Account',
        3 => 'Virtual Account',
    ],
    'residency_year' => [
        1 => 'Less Than 1 Year',
        2 => '2 Year',
        3 => '3 Year',
        4 => '4 Year',
        5 => '5 Year',
        6 => '6 Year',
        7 => '7 Year',
        8 => 'More than 7 Year'
    ],
    'docType' => [
        1 => 'fron licence',
        2 => 'back licence',
        3 => 'address proof',
        4 => 'selfie',
    ],
    'loan_type' =>[
        1 => 'Personal Loan',
        2 => 'Payday Loan',
        3 => 'Medical Loan',
        4 => 'Business Loan',
    ],
    'mail_template' =>[
        1 =>'login',
        2 =>'reset-password',
        3 =>'loan-application',
        4 =>'identity-verification',
        5 =>'identity-verification-under-process',
    ],

    'proceed_status' => [
        1 => 'Boost Up Your Credit Score Upto 750 Points.',
        2 => 'Insured Your Loan Amt Through Insurance.',
        3 => 'Get Your Loan Amount Credited To Rapid Cash America Wallet.',
    ],

    'proper_status' => [
        0 => 'Pending',
        1 => 'Approve',
        2 => 'Reject',
    ]

];
