<?php

return [
    'token' => env('ACCESS_TOKEN'),
    'expiration' => (int) env('ACCESS_EXPIRATION') ?: 1440,
];
