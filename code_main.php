<?php
// Database connection
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'parking_system';

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vehicle_number = $_POST['vehicle_number'];
    $vehicle_type = $_POST['vehicle_type'];

    $sql = "INSERT INTO parking (vehicle_number, vehicle_type) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $vehicle_number, $vehicle_type);
    $stmt->execute();
    $stmt->close();
}

// Fetch parked vehicles
$result = $conn->query("SELECT * FROM parking ORDER BY entry_time DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Vehicle Parking System</title>
</head>
<body>
    <h2>Enter Vehicle Details</h2>
    <form method="POST" action="">
        Vehicle Number: <input type="text" name="vehicle_number" required><br>
        Vehicle Type:
        <select name="vehicle_type">
            <option value="Car">Car</option>
            <option value="Bike">Bike</option>
            <option value="Truck">Truck</option>
        </select><br><br>
        <input type="submit" value="Park Vehicle">
    </form>

    <h2>Parked Vehicles</h2>
    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th>
            <th>Vehicle Number</th>
            <th>Type</th>
            <th>Entry Time</th>
        </tr>
        <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['vehicle_number'] ?></td>
            <td><?= $row['vehicle_type'] ?></td>
            <td><?= $row['entry_time'] ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
