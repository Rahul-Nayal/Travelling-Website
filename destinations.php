<?php include "header.php"; ?>
<?php include "db.php"; ?>

<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col" style="padding:0; margin:0;">
                <img src='images/carousel/carousel4.jpg' alt="nature image" class="full-width-image ">
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center my-5">
            <div class="col-md-12 mt-5 text-center">
                <h3>DESTINATION</h3>
                <p>All our awesome destination places of the world you can travel with us</p>
            </div>

            <?php
                $sql = "SELECT id, name, image FROM destination"; 
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="col-md-3 mt-4 ms-3">'; 
                        echo'<div class="card">';
                        echo '<img src="' . htmlspecialchars($row["image"]) . '" alt="' . htmlspecialchars($row["name"]) . '" class="img-fluid" style="width: 100%; height: 250px;">';
                        echo '<a href="destinationPackage.php?id=' . htmlspecialchars($row["id"]) . '"style="text-decoration:none;">';
                            echo '<div class="card-body text-center" style="background:black; color:white;">';
                                echo '<h4 class="card-title">' . htmlspecialchars($row["name"]) . '</h4>';
                            echo '</div>';
                        echo '</a>'; 
                        echo'</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p class="text-center">No destinations available</p>';
                }
            ?>
        </div>
    </div>
</main>

<?php include "footer.php"; ?>
