<?php
include "db.php"; 
error_reporting(E_ALL);
ini_set('display_errors', 1);

if(isset($_POST["submit"])){
    $name = $_POST["name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];
    $phone = $_POST["phone"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $country = $_POST["country"];
    
    $duplicate = mysqli_query($conn, "SELECT * FROM traveller WHERE username = '$username' OR email ='$email'");
    if(mysqli_num_rows($duplicate) > 0){
        echo "<script>alert('Username or Email Has Already Taken');</script>";
    } else {
        if($password == $confirmpassword){
           $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO traveller (name, phone, email, city, state, country, password, username) VALUES ('$name', '$phone', '$email', '$city', '$state', '$country', '$hashedPassword', '$username')";

            if (mysqli_query($conn, $query)) {
                echo "<script>alert('Registration Successful');</script>";
            } else {
                echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
            }
        } else {
            echo "<script>alert('Debug: Password = $password, Confirm Password = $confirmpassword');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include "links.php" ?>
</head>
<body>
    <?php include "header.php" ?>
    <main>
        <div class="container-fluid main-container" style="background-image: url('images/registrationImg.jpg');">
            <div class="outerCard">
                <div class="text-center">
                    <h3 class="mt-3">Time To Travel</h3><br>
                    <h5>Travel Registration Form</h5>
                    <p>Please fill out the form below to register for the upcoming travel event.</p>
                </div>
                <form action="" method="POST" autocomplete="off">
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name*</label>
                        <input type="text" id="name" class="form-control" name="name" placeholder="Enter Your Name" required>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username*</label>
                        <input type="text" id="username" class="form-control" name="username" placeholder="Enter Your Username" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email*</label>
                        <input type="text" id="email" class="form-control" name="email" placeholder="Enter Your Email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password*</label>
                        <input type="password" id="password" class="form-control" name="password" placeholder="Enter Your Password" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirmpassword" class="form-label">Confirm Password*</label>
                        <input type="password" id="confirmpassword" class="form-control" name="confirmpassword" placeholder="Confirm Your Password" required>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Contact No.*</label>
                        <input type="text" id="phone" class="form-control" name="phone" placeholder="Enter Your Contact Number" required>
                    </div>
                    <div class="mb-3">
                        <label for="city" class="form-label">City*</label>
                        <input type="text" id="city" class="form-control" name="city" placeholder="Enter Your City" required>
                    </div>
                    <div class="mb-3">
                        <label for="state" class="form-label">State*</label>
                        <input type="text" id="state" class="form-control" name="state" placeholder="Enter Your State" required>
                    </div>
                    <div class="mb-3">
                        <label for="country" class="form-label">Country*</label>
                        <input type="text" id="country" class="form-control" name="country" placeholder="Enter Your Country" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-success">Register</button>
                </form>
            </div>
        </div>
    </main>
    <?php include "footer.php" ?>
</body>
</html>
