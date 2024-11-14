<?php include "header.php" ?>
<?php include "db.php" ?>

<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col" style="padding:0; margin:=0;">
                <img src='images/carousel/carousel6.jpg' alt="nature iamge" class="full-width-image ">
            </div>
        </div>
    </div>

    <div class="container-fluid" style="background-color:rgb(246, 246, 246);">
        <div class="row  justify-content-center">
            <div class="col-md-12 mt-5 p-5 text-center">
                <h3>FEATURED PACKAGES</h3>
                <p>All our featured tour packages are given below</p>
            </div>

            <?php
                $sql = "SELECT id,image, title, price, description FROM package";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="card col-md-3 text-center my-5 ms-5">';
                        echo ' <img src="' . htmlspecialchars($row["image"]) . '" alt="' . htmlspecialchars($row["title"]) . '" class="img-fluid"  style="width: 100%; height: 250px;">';
                        echo '<h4 style="background:black; color:white;" class="p-2"> Rs :' . intval($row["price"]) . '/Person </h4>';
                        echo '<a href="aboutPackage.php?id=' . htmlspecialchars($row["id"]) . '"style="text-decoration:none;">';
                        echo '<h4>'.'<strong>' . htmlspecialchars($row["title"]) .'</strong>'.'</h4>';
                        echo'</a>';
                        echo '<p>' . htmlspecialchars($row["description"]) . '</p>';
                        echo '</div>';
                    }
                } else {
                    echo '<p class="text-center">No packages available</p>';
                }
            ?>
        </div>
    </div>
</main>

<?php include "footer.php" ?>