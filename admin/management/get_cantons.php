<?php

// Database connection
require_once '../../includes/config/database.php';
$db = connectionBD();

// Get the selected province id from the URL
$selectedProvinceId = $_GET['province_id'];

// Query for cantons
$queryCanton = "SELECT * FROM canton WHERE province_id = $selectedProvinceId";
$answerCanton = mysqli_query($db, $queryCanton);

// Generate array of cantons
$cantons = [];
while ($rowCanton = mysqli_fetch_assoc($answerCanton)) {
  $cantons[] = [
    'id' => $rowCanton['id'],
    'canton' => $rowCanton['canton']
  ];
}

// Return the cantons data in JSON format
header('Content-Type: application/json');
echo json_encode($cantons);
