<?php
include "db.php"; 
include "header.php"; 

$package_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$price_per_person = isset($_GET['price']) ? floatval($_GET['price']) : 0;
$number_of_persons = isset($_GET['persons']) ? intval($_GET['persons']) : 1;
$traveller_id = isset($_GET['travellerId']) ? intval($_GET['travellerId']) : 0;
$service_id = isset($_GET['serviceId']) ? intval($_GET['serviceId']) : 0; 

$subtotal = $price_per_person * $number_of_persons;
$total = $subtotal; 

echo '<div class="container">';
echo '<h3>Booking Summary</h3>';
echo '<table class="table table-bordered">';
echo '<tr><th>Traveller ID</th><td>' . $traveller_id . '</td></tr>'; 
echo '<tr><th>Service ID</th><td>' . $service_id . '</td></tr>'; 
echo '<tr><th>Number of Persons</th><td>' . $number_of_persons . '</td></tr>';
echo '<tr><th>Price per Person</th><td>₹ ' . number_format($price_per_person, 2) . '</td></tr>';
echo '<tr><th>Subtotal</th><td>₹ ' . number_format($subtotal, 2) . '</td></tr>';
echo '<tr><th>Total</th><td>₹ ' . number_format($total, 2) . '</td></tr>';
echo '</table>';

echo '<form action="processBooking.php" method="POST">';
echo '<input type="hidden" name="package_id" value="' . $package_id . '">';
echo '<input type="hidden" name="traveller_id" value="' . $traveller_id . '">';
echo '<input type="hidden" name="number_of_persons" value="' . $number_of_persons . '">';
echo '<input type="hidden" name="subtotal" value="' . $subtotal . '">';
echo '<input type="hidden" name="total" value="' . $total . '">';
echo '<input type="hidden" name="service_id" value="' . $service_id . '">'; 
echo '<button type="submit" class="btn btn-primary">Confirm Booking</button>';
echo '</form>';
echo '</div>';

include "footer.php";
?>
