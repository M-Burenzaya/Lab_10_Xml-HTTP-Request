<?php

$user = 'root';
$pass = '';
$dbName = 'lab_10';
$host = 'localhost';

$conn = new mysqli($host, $user, $pass, $dbName);

if ($conn->connect_error) {
    die("Холболт амжилтгүй: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $enteredValue = $_POST["target"] ?? null;

    if ($stud_id !== '' && $lname !== '' && $fname !== '') {
    
        if ($enteredValue !== '') {
            echo "You entered: " . $enteredValue; // Return the entered value
        } else {
            echo "Please enter a value."; // Error message if no value is entered
        }
    } else {
        echo "Бүх талбарыг бөглөнө үү.";
    }
} else {
    echo "Зөвхөн POST хүсэлт ашиглана уу.";
}

$conn->close();
?>
