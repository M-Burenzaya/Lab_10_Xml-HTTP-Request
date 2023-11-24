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
    $visit_date = $_POST["visit_date"] ?? null;
    $time_spent = $_POST["time_spent"] ?? null;
    $student_id_visit = $_POST["student_id_visit"] ?? null;

    if ($visit_date !== '' && $time_spent !== '' && $student_id_visit !== '') {
    
        $stmt = $conn->prepare("INSERT INTO Visits (VisitDate, SpentTime, StudentID) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $visit_date, $time_spent, $student_id_visit);

        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Өгөгдөл амжилттай нэмэгдлээ." . "<br>";
            echo "Суусан өдөр: " . $visit_date . "<br>";
            echo "Өнгөрүүлсэн цаг: " . $time_spent . "<br>";
            echo "Оюутны ID: " . $student_id_visit . "<br>";
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