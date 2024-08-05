<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "feedbackDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("INSERT INTO feedback (usage_frequency, motivation, most_used_feature, improvement_suggestion) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $usage_frequency, $motivation, $most_used_feature, $improvement_suggestion);

    // Set parameters and execute
    $usage_frequency = $_POST['usage_frequency'];
    $motivation = $_POST['motivation'];
    $most_used_feature = $_POST['most_used_feature'];
    $improvement_suggestion = $_POST['improvement_suggestion'];
    $stmt->execute();

    echo "New records created successfully";

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FEEDBACK</title>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
    }
    .container {
        margin-left: 550px;
        margin-top: 60px;
        justify-content: center;
        background-color: white;
        height: 550px;
        width: 400px;
        box-shadow: 1px 2px 4px;
    }
    .PARAGRAPH {
        padding-top: 40px;
        margin-left: 14px;
        color: black;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 20px;
    }
    .WEEK, .PRO, .FEA, .IMP {
        margin-left: 10px;
        margin-top: 10px;
        width: 380px;
        height: 35px;
        border-radius: 4px;
        border: 1px solid black;
    }
    .BTN {
        margin-left: 50px;
        margin-top: 20px;
        width: 300px;
        height: 35px;
        border-radius: 4px;
        border: 1px solid black;
        background-color: rgb(0, 166, 232);
        font-family: Arial, Helvetica, sans-serif;
        font-size: 20px;
        cursor: pointer;
    }
</style>
<body>

    <div class="container">
        <form method="post" action="">
            <p class="PARAGRAPH">How often do you use our app?</p>
            <input class="WEEK" type="text" name="usage_frequency" placeholder="Everyday/once a week/bi-weekly" required>

            <p class="PARAGRAPH">What is the motivation to use our app?</p>
            <input class="PRO" type="text" name="motivation" placeholder="What problem does it solve for you?" required>
           
            <p class="PARAGRAPH">What is the most used feature?</p>
            <input class="FEA" type="text" name="most_used_feature" placeholder="" required>
          
            <p class="PARAGRAPH">What would you like to see improved the most?</p>
            <input class="IMP" type="text" name="improvement_suggestion" placeholder="" required>
            
            <button class="BTN" type="submit">Submit Feedback</button>
        </form>
    </div>

</body>
</html>
