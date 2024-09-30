<?php

return [

    'connections' => [
  'mongodb' => [
    'driver' => 'mongodb',
    'dsn' => env('DB_URI'),
    'database' => 'texaswfc',
  ],
],

// ...

    'migrations' => [
        'table' => 'migrations',
        'update_date_on_publish' => false, // disable to preserve original behavior for existing applications
    ],

];
