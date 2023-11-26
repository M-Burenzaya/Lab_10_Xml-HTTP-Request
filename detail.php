<?php
$user = 'root';
$pass = '';
$dbName = 'lab_10';
$host = 'localhost';

$conn = new mysqli($host, $user, $pass, $dbName);

if ($conn->connect_error) {
    die("Холболт амжилтгүй: " . $conn->connect_error);
}

if (isset($_GET["ItemID"]) && isset($_GET["RoomID"])) {
    $itemID = $_GET["ItemID"];
    $roomID = $_GET["RoomID"];

    $stmtItem = $conn->prepare("SELECT ItemID, Detail FROM ItemUsage WHERE ItemID = ?");
    $stmtItem->bind_param("i", $itemID);
    $stmtItem->execute();
    $resultItem = $stmtItem->get_result();

    $itemData = array();
    if ($resultItem->num_rows > 0) {
        while ($row = $resultItem->fetch_assoc()) {
            $itemData[] = $row;
        }
    }

    $stmtRoom = $conn->prepare("SELECT RoomID, RoomName FROM Rooms WHERE RoomID = ?");
    $stmtRoom->bind_param("i", $roomID);
    $stmtRoom->execute();
    $resultRoom = $stmtRoom->get_result();

    $roomData = array();
    if ($resultRoom->num_rows > 0) {
        while ($row = $resultRoom->fetch_assoc()) {
            $roomData[] = $row;
        }
    }

    $combinedData = array(
        "ItemData" => $itemData,
        "RoomData" => $roomData
    );

    header('Content-Type: application/json');
    echo json_encode($combinedData);
} else {
    echo "ItemID болон RoomID байх шаардлагатай";
}
$conn->close();
?>