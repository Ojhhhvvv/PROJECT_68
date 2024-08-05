<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database configuration
    $server = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ramesh";

    // Create a connection
    $con = mysqli_connect($server, $username, $password, $dbname);

    // Check connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Retrieve and sanitize form data
    $fullname = mysqli_real_escape_string($con, $_POST['fullname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $number = mysqli_real_escape_string($con, $_POST['number']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL query to insert data into the gagan table
    $sql = "INSERT INTO `gagan` (`name`, `email`, `number`, `password`) 
            VALUES ('$fullname', '$email', '$number', '$hashed_password')";

    // Execute query and check for success
    if (mysqli_query($con, $sql)) {
        // Success: Output a JavaScript alert
        echo "<script>alert('Data submitted successfully');</script>";
    } else {
        // Error: Show an error message
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
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration Form</title>

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
            background: #fff;
        }

        .container {
            position: relative;
            max-width: 700px;
            width: 100%;
            background: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .container header {
            font-size: 1.5rem;
            color: #333;
            font-weight: 500;
            text-align: center;
        }

        .container .form {
            margin-top: 30px;
        }

        .form .input-box {
            width: 100%;
            margin-top: 20px;
        }

        .input-box label {
            color: #333;
        }

        .form :where(.input-box input, .select-box) {
            position: relative;
            height: 50px;
            width: 100%;
            outline: none;
            font-size: 1rem;
            color: #707070;
            margin-top: 8px;
            border: 1px solid #ccc;
            border-radius: 6px;
            padding: 0 15px;
        }

        .input-box input:focus {
            box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1);
        }

        .form .column {
            display: flex;
            column-gap: 15px;
        }

        .form button {
            height: 55px;
            width: 100%;
            color: #fff;
            font-size: 1rem;
            font-weight: 400;
            margin-top: 30px;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            background: #333;
        }

        .form button:hover {
            background: #444;
        }

        @media screen and (max-width: 500px) {
            .form .column {
                flex-wrap: wrap;
            }
        }
    </style>
</head>

<body>
    <section class="container">
        <header>Registration Form</header>
        <form action="" method="post" class="form">
            <div class="input-box">
                <label>Full Name</label>
                <input type="text" placeholder="Enter full name" name="fullname" required>
            </div>

            <div class="input-box">
                <label>Email Address</label>
                <input type="email" placeholder="Enter email address" name="email" required>
            </div>

            <div class="column">
                <div class="input-box">
                    <label>Phone Number</label>
                    <input type="tel" placeholder="Enter phone number" name="number" required>
                </div>
                <div class="input-box">
                    <label>Password</label>
                    <input type="password" placeholder="Enter password" name="password" required>
                </div>
            </div>

            <button type="submit">Submit</button>
        </form>
    </section>
</body>

</html>
