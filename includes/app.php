<?php

declare(strict_types=1);

// Autoload
require_once __DIR__ . '/../vendor/autoload.php';

// DataBase connection
require_once 'config/database.php';

// Functions
require_once 'functions.php';

// Classes
use App\Property;

// DB Functions
$db = connectionBD();
Property::setDB($db);

//* Queries */
// Query for vendors (create.php, modify.php)
$queryVendors = "SELECT * FROM vendors";
$answerVendors = $db->query($queryVendors);

// Query for provinces (create.php, modify.php)
$queryProvince = "SELECT * FROM province";
$answerProvince = $db->query($queryProvince);
