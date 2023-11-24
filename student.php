<?php

$user = 'root';
$pass = '';
$dbName = 'lab_9';
$host = 'localhost';

$conn = new mysqli($host, $user, $pass, $dbName);

if ($conn->connect_error) {
    die("Холболт амжилтгүй: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $stud_id = $_POST["stud_id"] ?? null;
    $lname = $_POST["lname"] ?? null;
    $fname = $_POST["fname"] ?? null;

    if ($stud_id !== '' && $lname !== '' && $fname !== '') {
    
        $stmt = $conn->prepare("INSERT INTO Students (StudentID, lname, fname) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $stud_id, $lname, $fname);

        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Өгөгдөл амжилттай нэмэгдлээ." . "<br>";
            echo "Оюутны ID: " . $stud_id . "<br>";
            echo "Оюутны овог: " . $lname . "<br>";
            echo "Оюутны нэр: " . $fname . "<br>";
        } else {
            echo "Нэмэх үйлдэл амжилтгүй: " . $conn->error;
        }

        $stmt->close();
    } else {
        echo "Бүх талбарыг бөглөнө үү.";
    }
} else {
    echo "Зөвхөн POST хүсэлт ашиглана уу.";
}

$conn->close();
?>
