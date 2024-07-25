<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

$response = ['status' => 'success', 'message' => 'CORS headers are set'];
echo json_encode($response);
?>
