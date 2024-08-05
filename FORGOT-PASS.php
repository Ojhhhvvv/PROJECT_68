<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database configuration
    $server = "localhost";
    $username = "root";
    $password = "";
    $dbname = "gp";

    // Create a connection
    $con = mysqli_connect($server, $username, $password, $dbname);

    // Check connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Retrieve and sanitize form data
    $emailOrUsername = mysqli_real_escape_string($con, $_POST['email_or_username']);

    // Check if the username/email exists
    $sql = "SELECT * FROM `login` WHERE `username` = '$emailOrUsername' OR `email` = '$emailOrUsername'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Normally, you would send an email with a password reset link here
        echo "<script>alert('If this username/email exists, a password reset link will be sent.');</script>";
    } else {
        echo "<script>alert('No account found with that username/email.');</script>";
    }

    // Close the connection
    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: #f9f9f9; /* Light background for contrast */
        }

        .container {
            max-width: 400px;
            width: 100%;
            background: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            text-align: center; /* Center text in the container */
        }

        .container header {
            font-size: 1.5rem;
            color: #333;
            font-weight: 500;
            margin-bottom: 20px; /* Space below header */
        }

        .input-box {
            width: 100%;
            margin-top: 20px;
        }

        .input-box label {
            color: #333;
            display: block; /* Block for full width */
            margin-bottom: 8px; /* Space below label */
        }

        .input-box input {
            height: 40px;
            width: 100%;
            outline: none;
            font-size: 1rem;
            color: #707070;
            margin-top: 8px;
            border: 1px solid #ccc;
            border-radius: 6px;
            padding: 0 15px;
            transition: border-color 0.2s ease;
        }

        .input-box input:focus {
            border-color: #00b7ff; /* Change border color on focus */
        }

        .btn {
            height: 50px;
            width: 100%;
            color: #fff;
            font-size: 1rem;
            font-weight: 500;
            margin-top: 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.2s ease;
            background: #00b7ff; /* Button color */
        }

        .btn:hover {
            background: #0099cc; /* Darken button on hover */
        }

        .redirect {
            margin-top: 15px;
            font-size: 0.9rem;
            color: #555;
        }

        .redirect a {
            color: #00b7ff;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .redirect a:hover {
            color: #0099cc; /* Darken link on hover */
        }
    </style>
</head>

<body>
    <div class="container">
        <header>Forgot Password?</header>
        <form action="" method="post">
            <div class="input-box">
                <label for="email_or_username">Username/Email Address</label>
                <input id="email_or_username" type="text" name="email_or_username" placeholder="Enter your username/email" required>
            </div>
            <button type="submit" class="btn">Reset Password</button>
        </form>
        <p class="redirect">Remember your password? <a href="#">Login here</a></p>
    </div>
</body>

</html>

