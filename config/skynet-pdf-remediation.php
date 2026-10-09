<?php

return [

    /*
    |--------------------------------------------------------------------------
    | API Base URL
    |--------------------------------------------------------------------------
    |
    | Origin of the AI PDF Remediation backend. Injected into the dashboard as
    | AIOPDF_CONFIG.apiBaseUrl.
    |
    */
    'api_base' => env('SKYNET_PDF_API_BASE', 'https://livepdfapi.skynettechnologies.us'),

    /*
    |--------------------------------------------------------------------------
    | Session URL (optional, advanced)
    |--------------------------------------------------------------------------
    |
    | When set, the dashboard calls THIS endpoint on your own server for a
    | session token instead of calling provision-account directly with the API
    | key, so the key never reaches the browser. Leave empty for the default
    | browser-side flow. Injected as AIOPDF_CONFIG.sessionUrl only when non-empty.
    |
    */
    'session_url' => env('SKYNET_PDF_SESSION_URL', ''),

    /*
    |--------------------------------------------------------------------------
    | Dashboard URL
    |--------------------------------------------------------------------------
    |
    | The dashboard the coverage modal's upgrade button links to. Injected as
    | AIOPDF_CONFIG.dashboardUrl.
    |
    */
    'dashboard_url' => env('SKYNET_PDF_DASHBOARD_URL', 'https://ada.skynettechnologies.us'),

    /*
    |--------------------------------------------------------------------------
    | Plan / Country
    |--------------------------------------------------------------------------
    |
    | Plan new accounts are provisioned on, and the two-letter country code
    | recorded on the account.
    |
    */
    'plan_id' => env('SKYNET_PDF_PLAN_ID', 'free'),
    'country' => env('SKYNET_PDF_COUNTRY', 'US'),
];
