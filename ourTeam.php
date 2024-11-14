<?php include "header.php" ?>
<?php include "db.php" ?>

<main>
    <div class="container-fluid" style="background-color:rgb(246, 246, 246);">
        <div class="row justify-content-center  ">
            <div class="col-md-12 mt-5 text-center">
                <h3>OUR TEAM</h3>
                <p>Meet with all our qualified team members</p>
            </div>

            <?php
                $sql = "SELECT name,photo,designation FROM team_members";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo'<div class="card col-md-2 my-5">';
                            echo'<img src="' . htmlspecialchars($row["photo"]) . '" alt="' . htmlspecialchars($row["title"]) . '" class="img-fluid card-image"  style="width: 100%;height:250px;">';
                            echo'<div class="card-body text-center" style="background:grey;">';
                                echo'<h4 class="card-title"> ' . htmlspecialchars($row["name"]) . '</h4>';
                                echo'<p class="card-text">' . htmlspecialchars($row["designation"]) . '</p>';
                                
                            echo'</div>';
                        echo'</div>';
                    }
                } else {
                    echo '<p class="text-center">No packages available</p>';
                }
            ?>
        </div>
    </div>

</main>

<?php include "footer.php" ?>