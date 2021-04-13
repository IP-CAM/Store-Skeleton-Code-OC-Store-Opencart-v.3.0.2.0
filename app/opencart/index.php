<?php
// Version
define('VERSION', '3.0.2.0');

include  __DIR__ . '/../vendor/autoload.php';
include __DIR__ . '/../helpers.php';

Dotenv::load(__DIR__ . '/../');

// Configuration
require_once('config.php');

// Startup
require_once(DIR_SYSTEM . 'startup.php');

start('catalog');