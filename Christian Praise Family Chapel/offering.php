<?php
header('Content-Type: application/json');

// Allow requests from any origin
header("Access-Control-Allow-Origin: *");

// Allow specific methods
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");

// Allow specific headers
header("Access-Control-Allow-Headers: Content-Type");
error_reporting(0);  // Suppress warnings and errors

$response = ["success" => false, "error" => "An unknown error occurred"];

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $day = isset($_POST['Offering_day']) ? $_POST['Offering_day'] : null;
        $amount = isset($_POST['Offering_amount']) ? $_POST['Offering_amount'] : null;

        if ($day && $amount) {
            $mysqli = new mysqli("localhost", "root", "", "church");

            if ($mysqli->connect_error) {
                $response["error"] = "Connection failed: " . $mysqli->connect_error;
            } else {
                $stmt = $mysqli->prepare("INSERT INTO add_offering (day, amount) VALUES (?, ?)");
                $stmt->bind_param("ss", $day, $amount);

                if ($stmt->execute()) {
                    $response["success"] = true;
                    $response["error"] = null;
                } else {
                    $response["error"] = $stmt->error;
                }

                $stmt->close();
                $mysqli->close();
            }
        } else {
            $response["error"] = "Day and Amount are required.";
        }
    } else {
        $response["error"] = "Invalid request method.";
    }
} catch (Exception $e) {
    $response["error"] = "Exception: " . $e->getMessage();
}

echo json_encode($response);
?>
