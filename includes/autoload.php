<?php

declare(strict_types=1);

// Autoload
require_once __DIR__ . '/../vendor/autoload.php';

// DataBase connection
require_once 'config/database.php';

// Functions
require_once 'functions.php';

// Classes
use Model\ActiveRecord;

// DB Functions
$db = connectionBD();
ActiveRecord::setDB($db);

// Query for provinces (create.php, modify.php)
$queryProvince = "SELECT * FROM province";
$answerProvince = $db->query($queryProvince);
