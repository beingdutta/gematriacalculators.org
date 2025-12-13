<?php
// save.php
// Enable error logging for debugging
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/php-error.log');
error_reporting(E_ALL);

header('Content-Type: application/json');

// Determine which DB config to use based on the environment
$host = $_SERVER['HTTP_HOST'] ?? '';
if (strpos($host, 'localhost') !== false || $host === '127.0.0.1') {
    require_once __DIR__ . '/DB/DB_config_localhost_to_server_db.php';
} else {
    require_once __DIR__ . '/DB/DB_config_server_only.php';
}

// Create connection
$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

// Check connection
if ($conn->connect_error) {
    $errorMsg = 'Database connection failed: ' . $conn->connect_error;
    error_log($errorMsg);
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => $errorMsg]);
    exit;
}

// Get Input (Support both JSON and Form Data)
$response = '';
$jsonData = file_get_contents('php://input');
$input = json_decode($jsonData, true);

if (is_array($input) && isset($input['response'])) {
    $response = $input['response'];
} elseif (isset($_POST['response'])) {
    $response = $_POST['response'];
}

error_log("Request Method: " . $_SERVER['REQUEST_METHOD'] . " | Received response value: " . $response);

// Validate input
if (!in_array($response, ['Yes', 'No'])) {
    $errorMsg = 'Invalid response value: ' . $response;
    error_log($errorMsg);
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => $errorMsg]);
    exit;
}

$ip_address = $_SERVER['REMOTE_ADDR'];

// Prepare and execute statement
$stmt = $conn->prepare("INSERT INTO user_support_responses (user_response, ip_address, created_at) VALUES (?, ?, NOW())");
if (!$stmt) {
    $errorMsg = 'Prepare failed: ' . $conn->error;
    error_log($errorMsg);
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => $errorMsg]);
    exit;
}

$stmt->bind_param("ss", $response, $ip_address);

if ($stmt->execute()) {
    error_log("Successfully inserted response ID: " . $stmt->insert_id);
    echo json_encode(['status' => 'success', 'id' => $stmt->insert_id]);
} else {
    $errorMsg = 'Execute failed: ' . $stmt->error;
    error_log($errorMsg);
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => $errorMsg]);
}

$stmt->close();
$conn->close();
?>