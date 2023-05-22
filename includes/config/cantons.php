<?php
// Imports
require_once '/../app.php';

// Database connection
$db = connectionBD();


// Get the selected province id from the URL
$selectedProvinceId = $_GET['province_id'];

// Query for cantons
$queryCanton = "SELECT * FROM canton WHERE province_id = $selectedProvinceId";
$statement = $db->prepare($queryCanton);
$statement->execute();
$answerCanton = $statement->fetchAll(PDO::FETCH_ASSOC);

// Generate array of cantons
$cantons = [];
foreach ($answerCanton as $rowCanton) {
  $cantons[] = [
    'id' => $rowCanton['id'],
    'canton' => $rowCanton['canton']
  ];
}

// Return the cantons data in JSON format
header('Content-Type: application/json');
echo json_encode($cantons);
