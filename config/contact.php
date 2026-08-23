<?php

return [

    /*
      |--------------------------------------------------------------------------
      | Contact Information Configuration
      |--------------------------------------------------------------------------
      |
      | This file centralizes all contact information used throughout the
      | application, ensuring a single source of truth for admin contact details.
      | All WhatsApp numbers and phone numbers are managed here.
      |
      */

    /*
      |--------------------------------------------------------------------------
      | WhatsApp Configuration
      |--------------------------------------------------------------------------
      |
      | Primary WhatsApp number for admin/support contact
      | Format: International format without '+' (e.g., '6287890333000')
      |
      */

    'whatsapp' => [
        'admin' => env('ADMIN_WHATSAPP', '628111822823000'),
        'default_message' => env('ADMIN_WHATSAPP_MESSAGE', "Hi Indonesia Luxe Travel! I'm planning a trip to Indonesia and would like to ask a few questions about your services. Thank you!"),
    ],

    /*
      |--------------------------------------------------------------------------
      | Phone Configuration
      |--------------------------------------------------------------------------
      |
      | Primary phone number for admin/support contact
      | Format: International format with '+' (e.g., '+6287890333000')
      |
      */

    'phone' => [
        'admin' => env('ADMIN_PHONE', '+628111822823000'),
    ],

];
