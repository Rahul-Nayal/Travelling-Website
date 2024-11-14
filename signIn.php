<?php 
include "db.php"; 

if (isset($_POST["submit"])) {

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST["password"]; 


    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format');</script>";
        exit();
    }


    $stmt = $conn->prepare("SELECT * FROM traveller WHERE email = ?");
    $stmt->bind_param("s", $email); 
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            session_start(); 

     
            $_SESSION['traveller_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            header("Location: index.php");
            exit();
        } else {
            echo "<script>alert('Invalid password');</script>";
        }
    } else {
        echo "<script>alert('Email not found');</script>";
    }


    $stmt->close();
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include "links.php"; ?>
</head>
<body>
    <?php include "header.php"; ?>
    <main>
        <div class="container-fluid main-container" style="background-image: url('images/loginImage.jpg');">
            <div class="outerCard">
                <div class="text-center">
                    <h3 class="mt-3">LOGIN</h3><br>
                </div>
                <form action="" method="POST" autocomplete="off">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email*</label>
                        <input type="email" id="email" class="form-control" name="email" placeholder="Enter Your Email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password*</label>
                        <input type="password" id="password" class="form-control" name="password" placeholder="Enter Your Password" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-success loginBtn">Login</button>
                    <div class="text-center" style="text-decoration:none;">
                        <p><span>Don't have an account?</span></p><a href="signUp.php">Register</a>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <?php include "footer.php"; ?>
</body>
</html>
