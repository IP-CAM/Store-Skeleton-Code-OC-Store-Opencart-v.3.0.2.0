<?php
// HTTP
define('HTTP_SERVER', env('PROTOCOL', 'http') . '://' . env('DOMAIN', 'localhost') . '/');

// HTTPS
define('HTTPS_SERVER', env('PROTOCOL', 'https') . '://' . env('DOMAIN', 'localhost') . '/');

// DIR
define('DIR_APPLICATION', env('DIR_APPLICATION', '/app/opencart/catalog/'));
define('DIR_SYSTEM', env('DIR_SYSTEM', '/app/opencart/system/'));
define('DIR_IMAGE', env('DIR_IMAGE', '/app/opencart/image/'));
define('DIR_STORAGE', '/app/storage/');
define('DIR_LANGUAGE', env('DIR_LANGUAGE', DIR_APPLICATION . 'language/'));
define('DIR_TEMPLATE', env('DIR_TEMPLATE', DIR_APPLICATION . 'view/theme/'));
define('DIR_CONFIG', env('DIR_CONFIG', DIR_SYSTEM . 'config/'));
define('DIR_CACHE', env('DIR_CACHE', DIR_STORAGE . 'cache/'));
define('DIR_DOWNLOAD', env('DIR_DOWNLOAD', DIR_STORAGE . 'download/'));
define('DIR_LOGS', env('DIR_LOGS', DIR_STORAGE . 'logs/'));
define('DIR_MODIFICATION', env('DIR_MODIFICATION', DIR_STORAGE . 'modification/'));
define('DIR_SESSION', env('DIR_SESSION', DIR_STORAGE . 'session/'));
define('DIR_UPLOAD', env('DIR_UPLOAD', DIR_STORAGE . 'upload/'));

// DB
define('DB_DRIVER', env('DB_DRIVER', 'mpdo'));
define('DB_HOSTNAME', env('DB_HOSTNAME', 'app-mysql'));
define('DB_USERNAME', env('DB_USERNAME', 'app'));
define('DB_PASSWORD', env('DB_PASSWORD', 'secret'));
define('DB_DATABASE', env('DB_DATABASE', 'app'));
define('DB_PORT', env('DB_PORT', '3306'));
define('DB_PREFIX', env('DB_PREFIX', 'oc_'));