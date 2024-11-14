<?php 
session_start(); 
include "db.php"; 
include "header.php"; 


if (isset($_SESSION['traveller_id'])) {
    $traveller_id = $_SESSION['traveller_id'];
} else {
    echo "<script>alert('You must be logged in to book a package.'); window.location.href='signIn.php';</script>";
    exit();
}
?>
<main>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <?php

            $package_id = isset($_GET['id']) ? intval($_GET['id']) : 0;


            $sql = "SELECT id, title, description, image, price, itinerary, start_date, end_date, last_booking_date, service_id 
                    FROM package WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $package_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $package = $result->fetch_assoc();
                echo '<div class="col-md-12 text-center" style="background-image: url(\'' . htmlspecialchars($package['image']) . '\'); height: 300px; background-size: cover; color:white;">';
                echo '<h3 class="my-5 p-5">' . htmlspecialchars($package["title"]) . '</h3>';
                echo '</div>';

   
                echo '<div class="col-md-8 p-5">';
                echo '<h4> Tour Dates </h4>';
                echo '<hr>';
                echo '<table class="table table-bordered">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Tour Start Date</th>';
                echo '<th>Tour End Date</th>';
                echo '<th>Last Booking Date</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                echo '<tr>';
                echo '<td>' . htmlspecialchars($package["start_date"]) . '</td>';
                echo '<td>' . htmlspecialchars($package["end_date"]) . '</td>';
                echo '<td>' . htmlspecialchars($package["last_booking_date"]) . '</td>';
                echo '</tr>';
                echo '</tbody>';
                echo '</table>';
                echo '<h4>Tour Description</h4>';
                echo '<hr>';
                echo '<p>' . htmlspecialchars($package["description"]) . '</p>';
                echo '<h4>Itinerary</h4>';
                echo '<hr>';
                echo '<p>' . htmlspecialchars($package["itinerary"]) . '</p>';
                echo '</div>';

                echo '<div class="col-md-4 p-5">';
                echo '<h3>Book Now</h3>';
                echo '<hr>';
                echo '<h4>Total Price (per person)</h4>';
                echo '<h5 id="pricePerPerson">₹ ' . htmlspecialchars($package["price"]) . '</h5>';
                echo '<hr>';
                echo '<h3>Number Of Persons</h3>';
                echo '<div class="input-group mb-3" style="width: 200px;">';
                echo '<button class="btn btn-outline-secondary" type="button" id="decrease-btn">-</button>';
                echo '<input type="number" id="number-of-persons" class="form-control text-center" value="1" min="1" readonly>';
                echo '<button class="btn btn-outline-secondary" type="button" id="increase-btn">+</button>';
                echo '</div>';
                echo '<hr>';
                echo '<h4>Total Price</h4>';
                echo '<h5 id="totalPrice">₹ ' . htmlspecialchars($package["price"]) . '</h5>'; 
                echo '<a href="#" id="bookNowBtn" class="btn btn-primary mt-3">Book This Package</a>';
                echo '</div>';
            } else {
                echo '<p class="text-center">Package details not available.</p>';
            }
            ?>
        </div>
    </div>
</main>

<script>
    const numberOfPersonsInput = document.getElementById('number-of-persons');
    const decreaseBtn = document.getElementById('decrease-btn');
    const increaseBtn = document.getElementById('increase-btn');
    const pricePerPerson = parseFloat(document.getElementById('pricePerPerson').innerText.replace('₹ ', '').replace(',', ''));
    const totalPriceDisplay = document.getElementById('totalPrice');

    document.getElementById('bookNowBtn').addEventListener('click', function() {
        const numberOfPersons = numberOfPersonsInput.value;
        const packageId = <?php echo json_encode($package["id"]); ?>; 
        const packagePrice = <?php echo json_encode($package["price"]); ?>; 
        const travellerId = <?php echo json_encode($traveller_id); ?>; 
        const serviceId = <?php echo json_encode($package["service_id"]); ?>; 


        window.location.href = "bookPackage.php?id=" + packageId + "&price=" + packagePrice + "&persons=" + numberOfPersons + "&travellerId=" + travellerId + "&serviceId=" + serviceId;
    });

    function updateTotalPrice() {
        const currentValue = parseInt(numberOfPersonsInput.value);
        const totalPrice = pricePerPerson * currentValue;
        totalPriceDisplay.innerText = '₹ ' + totalPrice.toFixed(2); 
    }

    decreaseBtn.addEventListener('click', () => {
        let currentValue = parseInt(numberOfPersonsInput.value);
        if (currentValue > 1) {
            numberOfPersonsInput.value = currentValue - 1;
            updateTotalPrice(); 
        }
    });

    increaseBtn.addEventListener('click', () => {
        let currentValue = parseInt(numberOfPersonsInput.value);
        numberOfPersonsInput.value = currentValue + 1;
        updateTotalPrice(); 
    });

    updateTotalPrice();
</script>

<?php include "footer.php"; ?>
