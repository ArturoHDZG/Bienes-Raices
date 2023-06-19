<?php

// Composer Autoload
require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/config');
$dotenv->safeLoad();

// DataBase Connection
require_once 'config/database.php';

// Functions
require_once 'functions.php';
require_once 'functionsUpdate.php';

// Imports
use Model\ActiveRecord;

// DB Functions
$db = connectionBD();
ActiveRecord::setDB($db);
