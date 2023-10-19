<?php
$servername = "localhost";
$username = "root";
$password = "qwer1234";
$dbname = "tally";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "데이터베이스 연결 오류: " . $e->getMessage();
}
?>