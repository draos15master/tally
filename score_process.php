<?php
// 데이터베이스 연결 설정
require_once 'header.php';
require_once 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // POST 요청 처리
    $match_id = $_POST['match_id'];
    $home_team_score = $_POST['home_team_score'];
    $away_team_score = $_POST['away_team_score'];
    $status = $_POST['status'];

    // SQL 쿼리를 작성
    $sql = "UPDATE matches SET home_team_score = :home_team_score, away_team_score = :away_team_score, status = :status WHERE match_id = :match_id";

    // SQL 쿼리를 실행
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':home_team_score', $home_team_score);
    $stmt->bindParam(':away_team_score', $away_team_score);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':match_id', $match_id);

    if ($stmt->execute()) {
        // 업데이트가 성공한 경우, 성공 페이지로 리디렉션
        header("Location: sport_from.php");
        exit;
    } else {
        // 업데이트 실패 시 에러 페이지로 리디렉션
        header("Location: index.php");
        exit;
    }
} else {
    // 비정상적인 요청에 대한 에러 페이지로 리디렉션
    header("Location: index.php");
    exit;
}
?>
