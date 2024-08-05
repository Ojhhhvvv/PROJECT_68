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
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    
    // Hash the password before saving
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL query to insert data into the login table
    $sql = "INSERT INTO `login`(`username`, `password`) VALUES ('$username','$hashed_password')";
    
    // Execute query and check for success
    if (mysqli_query($con, $sql)) {
        echo "<script>alert('Data submitted successfully');</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($con) . "');</script>";
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
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
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
            background: #f7f7f7;
        }

        .wrapper {
            position: relative;
            max-width: 700px;
            width: 100%;
            padding: 25px;
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .wrapper h1 {
            font-size: 1.5rem;
            color: #333;
            font-weight: 500;
            text-align: center;
        }

        .input-box {
            width: 100%;
            margin-top: 20px;
        }

        .input-box input {
            position: relative;
            height: 50px;
            width: 100%;
            outline: none;
            font-size: 1rem;
            color: #707070;
            margin-top: 8px;
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 0 15px;
        }

        .input-box input:focus {
            box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1);
        }

        .lgl {
            display: flex;
            height: 77px;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .btn {
            height: 49px;
            width: 26%;
            color: #fff;
            font-size: 1.5rem;
            font-weight: 400;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            background: #333;
            border-radius: 9px;
        }

        .btn:hover {
            background: #444;
        }

        .f-pass {
            color: #707070;
            font-size: 1rem;
            font-weight: 400;
            text-align: center;
            display: block;
            margin-top: 15px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <h1>Login</h1>
        <form action="" method="post">
            <div class="input-box">
                <input type="text" placeholder="Username" name="username" required>
            </div>

            <div class="input-box">
                <input type="password" placeholder="Password" name="password" required>
            </div>

            <div class="lgl">
                <button type="submit" class="btn btn-info">Login</button>
            </div>
            <a href="#" class="f-pass">Forgot password?</a>
        </form>
    </div>
</body>

</html>
