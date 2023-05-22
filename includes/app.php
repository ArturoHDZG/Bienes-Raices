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

//* Queries */
// Query for vendors (create.php, modify.php)
$query = "SELECT * FROM vendors";
$answerVendors = $db->query($query);

// Query for provinces (create.php, modify.php)
$queryProvince = "SELECT * FROM province";
$answerProvince = $db->query($queryProvince);

// Query for cantons (get_cantons)
$queryCanton = "SELECT * FROM canton";
$answerCanton = $db->query($queryCanton);
