<?php
$user = 'root'; $pass = ''; $dbName = 'lab_10'; $host = 'localhost';                    //DB credentials
$conn = new mysqli($host, $user, $pass, $dbName);                                       //DB-руу холбох

if ($conn->connect_error) {                                                             
    die("Холболт амжилтгүй: " . $conn->connect_error);
}

if (isset($_GET["target"])) {                                                           //Параметр байгаа эсэхийг шалганэ
    $targetValue = $_GET["target"];                                                     //Байвал хайх утгийг авна

    $sql = "SELECT ItemID, ItemName, RoomID FROM Items WHERE ItemName = ?";             //Нэрээр сонгох SQL query
    $stmt = $conn->prepare($sql);                                                       //SQL query
    $stmt->bind_param("s", $targetValue);
    
    $stmt->execute();
    $result = $stmt->get_result();                                                      //Мөрийн мэдээллийг авна

    if ($result->num_rows > 0) {
        $items = [];                                                                    //Өгөгдөл олдвол
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;                                                            //Параметр болон харгалзах утгийг associative array-д хийнэ
        }

        $jsonData = json_encode($items);                                                //Key, value хос утгуудыг JSON хэлбэрт хөрвүүлнэ
        header('Content-Type: application/json');
        echo $jsonData;                                                                 //JSON хэлбэрийн датаг илгээнэ
    } else {                                                                            //Өгөгдөл байгоогүй тохиолдолд
        $emptyData = json_encode(["ItemID" => "", "ItemName" => "", "RoomID" => ""]);
        header('Content-Type: application/json');
        echo $emptyData;                                                                //Vlaue нв хоосон JSON хэлбэрийн датаг илгээнэ
    }
    
    $stmt->close();
} else {
    echo "Хайх утгийг Query хэсэгт илгээнэ үү.";
}
$conn->close();                                                                         //DB-тэй холболтоо салгах
?>
