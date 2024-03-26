<?php
// Check if form is submitted

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $name = test_input($_POST["name"]);
    $matricNo = test_input($_POST["matricNo"]);
    $currentAddress = test_input($_POST["currentAddress"]);
    $homeAddress = test_input($_POST["homeAddress"]);
    $email = test_input($_POST["email"]);
    $mobilePhone = test_input($_POST["mobilePhone"]);
    $homePhone = test_input($_POST["homePhone"]);

    // Validate inputs
    $errors = array();
    if (!preg_match("/^[A-Za-z\s]+$/", $name)) {
        $errors[] = "Invalid name format";
    }
    if (!preg_match("/^[0-9]+$/", $matricNo)) {
        $errors[] = "Invalid matric number format";
    }
    if (empty($currentAddress)) {
        $errors[] = "Current Address is required";
    }
    if (empty($homeAddress)) {
        $errors[] = "Home Address is required";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    if (!preg_match("/^[0-9]+$/", $mobilePhone)) {
        $errors[] = "Invalid mobile phone number format";
    }
    if (!preg_match("/^[0-9]+$/", $homePhone)) {
        $errors[] = "Invalid home phone number format";
    }

    // If there are validation errors, output them and exit
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
        exit;
    }

    // Connect to MySQL database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "student_info";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute query to insert data into the table
    $sql = "INSERT INTO student_data (name, matricNo, currentAddress, homeAddress, email, mobilePhone, homePhone) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisssii", $name, $matricNo, $currentAddress, $homeAddress, $email, $mobilePhone, $homePhone);
    $stmt->execute();

    // Check if data was successfully inserted
    if ($stmt->affected_rows > 0) {
        echo "Data inserted successfully";
        echo '<br><button onclick="window.location.href=\'front.html\'">Fill the form again</button>';
    } else {
        echo "Failed to insert data";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}

// Function to sanitize input
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
