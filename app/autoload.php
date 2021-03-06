<?php

declare(strict_types=1);

// Start the session
session_start();

// Set the default timezone to coordinated universal time.
date_default_timezone_set('UTC');

// Set the default character encoding to UTF-8.
mb_internal_encoding('UTF-8');

// functions
require __DIR__ . '/functions.php';

$config = require __DIR__ . '/config.php';

// connect database
$pdo = new PDO($config['database_path']);
