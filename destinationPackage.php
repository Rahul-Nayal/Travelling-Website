<?php include "db.php"; ?>
<?php include "header.php"; ?>

<main>
    <div class="container-fluid">
        <div class="row justify-content-center my-5">
            
                <?php
                $destination_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
                $sql_destination = "SELECT name FROM destination WHERE id = ?";
                $stmt_destination = $conn->prepare($sql_destination);
                $stmt_destination->bind_param("i", $destination_id);
                $stmt_destination->execute();
                $result_destination = $stmt_destination->get_result();

                if ($result_destination->num_rows > 0) {
                    $destination = $result_destination->fetch_assoc();
                    echo'<div class="col-md-12 mt-5 text-center" >';
                    echo '<h3>Packages for ' . htmlspecialchars($destination["name"]) . '</h3>'; 
                } else {
                    echo '<h3>Packages for Destination</h3>';
                }

                echo '<p>Explore our travel packages available for your chosen destination.</p>';
                echo'</div>';
                ?>

            

            <?php
            $sql = "SELECT id,title, description, image, price FROM package WHERE destination_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $destination_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-3 mt-4 ms-3">';
                    echo'<div class="card">';
                    echo '<img src="' . htmlspecialchars($row["image"]) . '" alt="' . htmlspecialchars($row["title"]) . '" class="img-fluid" style="width: 100%; height: 250px;">';
                    echo '<a href="aboutPackage.php?id=' . htmlspecialchars($row["id"]) . '"style="text-decoration:none;">';
                        echo '<div class="card-body text-center" style="background:black; color:white;">';
                            echo '<h4 class="card-title">' . htmlspecialchars($row["title"]) . '</h4>';
                        echo '</div>';
                    echo'</a>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p class="text-center">No packages available for this destination.</p>';
            }
            ?>
        </div>
    </div>
</main>

<?php include "footer.php"; ?>
