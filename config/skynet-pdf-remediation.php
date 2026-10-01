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
    | Provision API Key
    |--------------------------------------------------------------------------
    |
    | Sent as the X-Api-Key header on the provisioning call
    | (POST /api/billing/provision-account). This is a browser-side value, which
    | is acceptable behind the authenticated Control Panel. To keep it entirely
    | off the page, front the provisioning call with your own server endpoint
    | and set a session URL instead (see the addon README).
    |
    */
    'provision_api_key' => env('SKYNET_PDF_PROVISION_KEY', 'PDF-REMEDATION-PLAN-CHECK'),

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
