<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];

    // Generate a random order number
    $order_number = generateOrderNumber();

    $servername = "sql101.byethost14.com";
    $username = "b14_38991357";
    $password = "sobb1243V!";
    $dbname = "b14_38991357_hideout_booking";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO bookings (name, email, checkin, checkout, order_number) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $checkin, $checkout, $order_number);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header("Location: index.php?message=Booking+successfully+recorded.&order_number=" . urlencode($order_number) . "&name=" . urlencode($name) . "&email=" . urlencode($email) . "&checkin=" . urlencode($checkin) . "&checkout=" . urlencode($checkout));
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}

function generateOrderNumber() {
    // Generate a random alphanumeric order number
    return strtoupper(substr(md5(uniqid(rand(), true)), 0, 8));
}
?>
