<?php
// Mail is not available on the local XAMPP server, so log errors to a file instead.
// Prevent PHP from outputting HTML errors, which would break the JSON response.
ini_set('display_errors', 0);

ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/php-mail-error.log'); // Log errors to a file in the same directory
header('Content-Type: application/json');


// Allow requests from your domain
$allowed_origins = ['https://gematriacalculators.org', 'http://gematriacalculators.org'];
$origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '';
if (in_array($origin, $allowed_origins)) {
    header("Access-Control-Allow-Origin: " . $origin);
}

header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input = json_decode(file_get_contents('php://input'), true);

    $name = filter_var(trim($input["name"] ?? ''), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var(trim($input["email"]), FILTER_SANITIZE_EMAIL);
    $message = filter_var(trim($input["message"] ?? ''), FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (empty($name) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($message)) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Invalid input.']);
        exit;
    }

    $to = "admins@gematriacalculators.org";
    $subject = "New Contact Form Message from " . $name;
    $body = "You have received a new message from your website contact form.\n\n";
    $body .= "Name: $name\n";
    $body .= "Email: $email\n";
    $body .= "Message:\n$message\n";
    $headers = "From: noreply@gematriacalculators.org\r\n";
    $headers .= "Reply-To: $email\r\n";

    if (mail($to, $subject, $body, $headers)) {
        echo json_encode(['status' => 'success', 'message' => 'Message sent successfully!']);
    } else {
        http_response_code(500);
        error_log("Mail function failed. To: $to, Subject: $subject");
        echo json_encode(['status' => 'error', 'message' => 'Failed to send message.']);
    }
} else {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed.']);
}
?>