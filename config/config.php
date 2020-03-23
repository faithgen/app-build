<?php
return [
    /**
     * The Prefix to the gallery routes
     */
    'prefix' => 'api',


    /**
     * add more middlewares here if any
     */
    'middlewares' => [
        'auth:api', // this filters for authenticated requests from the ministry
        'ministry.activated', // this filters only activated ministries to use
        'bindings', //used for route model binding
    ],

    //The parent server to fetch templates from.
    'parent_server' => 'http://localhost:8002'
];
