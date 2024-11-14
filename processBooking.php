<?php
session_start(); 
include "db.php"; 


if (!isset($_SESSION['traveller_id'])) {
    echo "<script>alert('You must be logged in to book a package.'); window.location.href='signIn.php';</script>";
    exit();
}


$traveller_id = $_POST['traveller_id'];
$package_id = $_POST['package_id'];
$service_id = $_POST['service_id'];
$number_of_persons = $_POST['number_of_persons'];
$total_price = $_POST['total'];


$sql = "INSERT INTO bookings (traveller_id, package_id, service_id, booking_date, status, number_of_persons, total_price) VALUES (?, ?, ?, NOW(), 'Confirmed', ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iiids", $traveller_id, $package_id, $service_id, $number_of_persons, $total_price);

if ($stmt->execute()) {
    echo "<script>alert('Booking confirmed successfully!'); window.location.href='index.php';</script>";
} else {
    echo "<script>alert('Error: " . $stmt->error . "'); window.location.href='bookPackage.php?id=" . $package_id . "';</script>";
}

$stmt->close();
$conn->close();
?>
