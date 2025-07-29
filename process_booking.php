<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];

    if (empty($name) || empty($email) || empty($checkin) || empty($checkout)) {
        $message = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email format.";
    } elseif ($checkin >= $checkout) {
        $message = "Check-out date must be after check-in date.";
    } else {
        $servername = "XXXX";
        $username = "XXXX";
        $password = "XXXX";
        $dbname = "b18_33198858_hideout_booking";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO bookings (name, email, checkin, checkout) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Preparation failed: " . $conn->error);
        }

        if (!$stmt->bind_param("ssss", $name, $email, $checkin, $checkout)) {
            die("Binding parameters failed: " . $stmt->error);
        }

        if ($stmt->execute()) {
            $message = "Booking successfully recorded.";
        } else {
            $message = "Execute failed: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }

    header("Location: index.php?message=" . urlencode($message));
    exit;
}
?>
