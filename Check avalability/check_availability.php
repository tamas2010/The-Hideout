<?php
header('Content-Type: application/json');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];

    if (empty($checkin) || empty($checkout)) {
        echo json_encode(['available' => false, 'message' => 'Please provide both check-in and check-out dates.']);
        exit;
    }
    
    $servername = "sql101.byethost14.com";
    $username = "b14_38991357";
    $password = "sobb1243V!";
    $dbname = "b14_38991357_hideout_booking";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        echo json_encode(['available' => false, 'message' => 'Database connection failed: ' . $conn->connect_error]);
        exit;
    }

    $sql = "SELECT * FROM bookings WHERE (checkin <= ? AND checkout >= ?) OR (checkin < ? AND checkout >= ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        echo json_encode(['available' => false, 'message' => 'Preparation failed: ' . $conn->error]);
        exit;
    }

    if (!$stmt->bind_param("ssss", $checkout, $checkin, $checkin, $checkout)) {
        echo json_encode(['available' => false, 'message' => 'Binding parameters failed: ' . $stmt->error]);
        exit;
    }

    if (!$stmt->execute()) {
        echo json_encode(['available' => false, 'message' => 'Execute failed: ' . $stmt->error]);
        exit;
    }

    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo json_encode(['available' => false, 'message' => 'Sorry, the selected dates are not available.']);
    } else {
        echo json_encode(['available' => true, 'message' => 'The selected dates are available.']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['available' => false, 'message' => 'Invalid request method.']);
}
?>
