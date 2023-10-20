<?php
require_once 'db_config.php';

try {
    if (isset($_POST['team_name']) && isset($_POST['league_name'])) {
        // 팀 정보 추가
        $team_name = $_POST['team_name'];
        $league_name = $_POST['league_name'];

        $sql = "INSERT INTO teams (team_name, league_name) VALUES (:team_name, :league_name)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':team_name', $team_name);
        $stmt->bindParam(':league_name', $league_name);
        $stmt->execute();

        echo "팀 데이터가 성공적으로 추가되었습니다.";
    } elseif (isset($_POST['sport_name'])) {
        // 스포츠 정보 추가
        $sport_name = $_POST['sport_name'];

        $sql = "INSERT INTO sports (sport_name) VALUES (:sport_name)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':sport_name', $sport_name);
        $stmt->execute();

        echo "스포츠 데이터가 성공적으로 추가되었습니다.";
    } else {
        echo "데이터가 POST 데이터에 없습니다.";
    }
    header("Location: sport_from.php");

    $conn = null;
} catch (PDOException $e) {
    echo "오류: " . $e->getMessage();
}
?>
