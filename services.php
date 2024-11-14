<?php include "header.php" ?>
<?php include "db.php" ?>
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col" style="padding:0; margin:9=0;">
                <img src='images/carousel/carousel5.jpg' alt="nature iamge" class="full-width-image ">
            </div>
        </div>
    </div>
    <!-- Services -->
    <div class="container">
        <div class="row mt-5 p-5 justify-content-center">
            <div class="col-md-12 text-center">
                <h3>OUR SERVICES</h3>
                <p>"From Dream Destinations to Unforgettable Journeys"</p>
            </div>
            <?php

                $sql = "SELECT name, image,icon, description FROM service"; 
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="card col-md-3 text-center my-5 ms-5" style="background-image: url(' . htmlspecialchars($row["image"]) . '); background-size: cover; background-position: center; height: 300px; color: white;">';
                        echo '<div class="card-body d-flex flex-column justify-content-center align-items-center" style="background-color: rgba(0, 0, 0, 0.5); width: 100%; height: 100%; position: absolute; top: 0; left: 0;">';
                        echo '<img src="' . htmlspecialchars($row["icon"]) . '" alt="Icon" class="img-fluid mb-2" style="width: 50px; height: auto;">';
                        echo '<h4>' . htmlspecialchars($row["name"]) . '</h4>';
                        echo '<p>' . htmlspecialchars($row["description"]) . '</p>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p class="text-center">No services available</p>';
                }
            ?>
        </div>
    </div>

</main>

<?php include "footer.php" ?>