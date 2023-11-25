<?php
$user = 'root';
$pass = '';
$dbName = 'lab_10';
$host = 'localhost';

$conn = new mysqli($host, $user, $pass, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET["ItemID"]) && isset($_GET["RoomID"])) {
    $itemID = $_GET["ItemID"];
    $roomID = $_GET["RoomID"];

    // Fetch data from ItemUsage based on ItemID
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

    // Fetch data from Rooms based on RoomID
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

    // Combine the fetched data into a single array
    $combinedData = array(
        "ItemData" => $itemData,
        "RoomData" => $roomData
    );

    header('Content-Type: application/json');
    echo json_encode($combinedData);
} else {
    echo "Please provide ItemID and RoomID.";
}

$conn->close();

?>