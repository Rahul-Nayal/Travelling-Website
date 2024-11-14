<?php
session_start(); 


error_reporting(E_ALL);
ini_set('display_errors', 1);

include "db.php"; 

if (!isset($_SESSION['traveller_id'])) {
    echo "<script>alert('You must be logged in to access the dashboard.'); window.location.href='login.php';</script>";
    exit();
}


$traveller_id = $_SESSION['traveller_id'];


$sql = "SELECT name, email, phone FROM traveller WHERE id = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("i", $traveller_id);
    $stmt->execute();
    $user_result = $stmt->get_result();
    $user_data = $user_result->fetch_assoc();
} else {
    die("Error preparing statement: " . $conn->error);
}

$history_sql = "SELECT b.id, p.title, b.booking_date, b.status, b.number_of_persons, b.total_price 
                FROM bookings b 
                JOIN package p ON b.package_id = p.id 
                WHERE b.traveller_id = ?";
$history_stmt = $conn->prepare($history_sql);

if ($history_stmt) {
    $history_stmt->bind_param("i", $traveller_id);
    $history_stmt->execute();
    $history_result = $history_stmt->get_result();
} else {
    die("Error preparing history statement: " . $conn->error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
    $update_sql = "UPDATE travellers SET password = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_sql);
    
    if ($update_stmt) {
        $update_stmt->bind_param("si", $new_password, $traveller_id);
        if ($update_stmt->execute()) {
            echo "<script>alert('Password changed successfully!');</script>";
        } else {
            echo "<script>alert('Error changing password: " . $update_stmt->error . "');</script>";
        }
        $update_stmt->close();
    } else {
        die("Error preparing update statement: " . $conn->error);
    }
}

$stmt->close();
$history_stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="path/to/bootstrap.min.css">
</head>
<body>
    <?php include "header.php"?>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 text-center mt-2 p-5">
                <h1>User Dashboard</h1>
            </div>
            <div class= "card col-md-5 mx-2 my-3 p-5">
                <h2 class="text-center p-2">User Information</h2>
                <table class="table">
                    <tr>
                        <th>Name</th>
                        <td><?php echo htmlspecialchars($user_data['name']); ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?php echo htmlspecialchars($user_data['email']); ?></td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td><?php echo htmlspecialchars($user_data['phone']); ?></td>
                    </tr>
                </table>
            </div>
            <div class="card col-md-5 my-3 mx-2 p-5">
                <h2 class="text-center p-2">Change Password</h2>
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="new_password">New Password</label>
                        <input type="password" name="new_password" id="new_password" class="form-control" required>
                    </div>
                    <button type="submit" name="change_password" class="btn btn-primary mt-3">Change Password</button>
                </form>
            </div>
            <div class="col-md-12">
            <h2>Booking History</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Package Title</th>
                            <th>Booking Date</th>
                            <th>Status</th>
                            <th>Number of Persons</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($booking = $history_result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($booking['id']); ?></td>
                            <td><?php echo htmlspecialchars($booking['title']); ?></td>
                            <td><?php echo htmlspecialchars($booking['booking_date']); ?></td>
                            <td><?php echo htmlspecialchars($booking['status']); ?></td>
                            <td><?php echo htmlspecialchars($booking['number_of_persons']); ?></td>
                            <td>₹ <?php echo number_format($booking['total_price'], 2); ?></td>
                        </tr>
                        <?php endwhile; ?>
                        <?php if ($history_result->num_rows == 0): ?>
                        <tr>
                            <td colspan="6" class="text-center">No booking history available.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
    <?php include "footer.php" ?>
</body>
</html>
