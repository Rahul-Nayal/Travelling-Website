<?php include "db.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.csss">
    <title>Document</title>
    <?php include "links.php" ?>
</head>
<body>
    <?php include "header.php" ?>
    <main>
        <!-- carousel -->
        <div class="carouselExampleAutoplaying" class="carousel-slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="images/carousel/carousel1.jpg" alt="carousel1 image" class="d-block w-100">
                </div>
                <div class="carousel-item">
                    <img src="images/carousel/carousel2.jpg" alt="carousel2 image" class="d-block w-100">
                </div>
                <div class="carousel-item">
                    <img src="images/carousel/carousel3.jpg" alt="carousel3 image" class="d-block w-100">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>


        <!-- Services -->
        <div class="container">
            <div class="row mt-5 p-5 justify-content-center">
                <div class="col-md-12 text-center  ">
                    <h3>OUR SERVICES</h3>
                    <p>"From Dream Destinations to Unforgettable Journeys"</p>
                </div>

                <?php
                    $sql = "SELECT name, image,icon, description FROM service"; 
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo '<div class="card service_card col-md-3 text-center mt-4 ms-5" style="background-image: url(' . htmlspecialchars($row["image"]) . '); background-size: cover; background-position: center; height: 300px; color: white;">';
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
        

        <div class="container-fluid" style="background-color:rgb(246, 246, 246);">
            <div class="row mt-5  justify-content-center">
                <div class="col-md-12 mt-5 text-center">
                    <h3>FEATURED PACKAGES</h3>
                    <p>All our featured tour packages are given below</p>
                </div>
                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                <div class="carousel-inner"data-bs-interval="200">
                    <?php
                    
                    $sql = "SELECT id, image, title, price, description FROM package";
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                        $itemCount = 0;
                        $activeClass = 'active';

                        while ($row = $result->fetch_assoc()) {
                            if ($itemCount % 3 == 0) {
                                echo '<div class="carousel-item ' . $activeClass . '">';
                                echo '<div class="row">';
                            }
                            echo '<div class="col-md-4 p-4">';
                            echo '<div class="card my-5">';
                            echo '<a href="aboutPackage.php?id=' . htmlspecialchars($row["id"]) . '"style="text-decoration:none;">';
                            echo '<img src="' . htmlspecialchars($row["image"]) . '" alt="' . htmlspecialchars($row["title"]) . '" class="card-img-top" style="width: 100%; height: 250px;">';
                            echo '</a>';
                            echo '<div class="card-body text-center text-white">';
                            echo '<p class="card-text " >Rs: ' . intval($row["price"]) . '/Person</p>';
                            echo '<h5 class="card-title">' . htmlspecialchars($row["title"]) . '</h5>';
                            echo '<p class="card-text">' . htmlspecialchars($row["description"]) . '</p>';
                            echo '</div>'; 
                            echo '</div>';
                            echo '</div>'; 

                    
                            if ($itemCount % 3 == 2 || $itemCount == $result->num_rows - 1) {
                                echo '</div>';
                                echo '</div>'; 
                                $activeClass = ''; 
                            }

                            $itemCount++;
                        }
                    } else {
                        echo '<p class="text-center">No packages available</p>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>            


        <!-- destination -->
        <div class="container-fluid">
            <div class="row justify-content-center my-5">
                <div class="col-md-12 mt-5 text-center">
                    <h3>DESTINATION</h3>
                    <p>All our awesome destination places of the world you can travel with us</p>
                </div>

                <?php
                    $sql = "SELECT id,name, image FROM destination";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo '<div class="col-md-3 mt-4 ms-3 ">';
                            echo'<div class="card image-container">';
                            echo '<img src="' . htmlspecialchars($row["image"]) . '" alt="' . htmlspecialchars($row["name"]) . '" class="img-fluid " style="width: 100%; height: 250px;">';
                            echo '<a href="destinationPackage.php?id=' . htmlspecialchars($row["id"]) . '"style="text-decoration:none;">';
                            echo'<div class="card-body text-center" style="background:black; color:white;">';
                                echo '<h3  class="card-title p-2">' . htmlspecialchars($row["name"]) . '</h3>';
                            echo'</div>';
                            echo'</a>';
                            echo'</div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p class="text-center">No destinations available</p>';
                    }
                ?>
            </div>
        </div>
        
        <!-- our team -->
        <div class="container-fluid" style="background-color:rgb(246, 246, 246);">
            <div class="row mt-5  justify-content-center  ">
                <div class="col-md-12 mt-5 text-center">
                    <h3>OUR TEAM</h3>
                    <p>Meet with all our qualified team members</p>
                </div>

                <?php
                    $sql = "SELECT name,photo,designation FROM team_members";
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo'<div class="col-md-2 my-5">';
                            echo'<div class="card">';
                                echo'<img src="' . htmlspecialchars($row["photo"]) . '" alt="' . htmlspecialchars($row["title"]) . '" class="img-fluid card-image"  style="width: 100%;height:250px;">';
                                echo'<div class="card-body text-center" style="background:grey;">';
                                    echo'<h4 class="card-title"> ' . htmlspecialchars($row["name"]) . '</h4>';
                                    echo'<p class="card-text">' . htmlspecialchars($row["designation"]) . '</p>';
                                    
                                echo'</div>';
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
    <?php include 'footer.php'?>
</body>
</html>

