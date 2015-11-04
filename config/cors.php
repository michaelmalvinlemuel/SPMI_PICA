<?php


   

return [
    /*
     |--------------------------------------------------------------------------
     | Laravel CORS
     |--------------------------------------------------------------------------
     |

     | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*') 
     | to accept any value, the allowed methods however have to be explicitly listed.
     |
     */
     
    //header('Access-Control-Allow-Origin: *');
    //header('Access-Control-Allow-Methods: ');
    //header('Access-Control-Allow-Headers: );
    //header('Access-Control-Expose-Headers: Accept-Ranges, Content-Encoding, Content-Length, Content-Range');


    'supportsCredentials' => false,
    'allowedOrigins' => ['*'],
    'allowedHeaders' => ['Range', 'Origin', 'Content-Type', 'Accept', 'Authorization', 'X-Request-With', 'X-CSRF-Token', 'X-XSRF-Token', 'XSRF-Token'],
    'allowedMethods' => ['PATCH', 'POST', 'PUT', 'DELETE', 'GET', 'OPTIONS'],
    'exposedHeaders' => [],
    'maxAge' => 0,
    'hosts' => [],
];

