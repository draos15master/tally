<?php
// 데이터베이스 연결 설정
require_once 'header.php';
require_once 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // POST 요청 처리
    $home_team_id = $_POST['home_team'];
    $s_home_odds = $_POST['s_home_odds'];
    $s_middle_odds = $_POST['s_middle_odds'];
    $away_team_id = $_POST['away_team'];
    $s_away_odds = $_POST['s_away_odds'];
    $sport_id = $_POST['sport'];
    $start_time = $_POST['start_time'];
    $h_home_odds = $_POST['h_home_odds'];
    $h_point = $_POST['h_point'];
    $h_away_odds = $_POST['h_away_odds'];
    $uo_home_odds = $_POST['uo_home_odds'];
    $uo_point = $_POST['uo_point'];
    $uo_away_odds = $_POST['uo_away_odds'];

    // SQL 쿼리를 작성
    $sql = "INSERT INTO matches (home_team_id, away_team_id, sport_id, match_start_time, s_home_odds, s_middle_odds, s_away_odds, h_home_odds, h_point, h_away_odds, uo_home_odds, uo_point, uo_away_odds) VALUES (:home_team_id, :away_team_id, :sport_id, :start_time, :s_home_odds, :s_middle_odds, :s_away_odds, :h_home_odds, :h_point, :h_away_odds, :uo_home_odds, :uo_point, :uo_away_odds)";

    // SQL 쿼리를 실행
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':home_team_id', $home_team_id);
    $stmt->bindParam(':away_team_id', $away_team_id);
    $stmt->bindParam(':sport_id', $sport_id);
    $stmt->bindParam(':start_time', $start_time);
    $stmt->bindParam(':s_home_odds', $s_home_odds);
    $stmt->bindParam(':s_middle_odds', $s_middle_odds);
    $stmt->bindParam(':s_away_odds', $s_away_odds);
    $stmt->bindParam(':h_home_odds', $h_home_odds);
    $stmt->bindParam(':h_point', $h_point);
    $stmt->bindParam(':h_away_odds', $h_away_odds);
    $stmt->bindParam(':uo_home_odds', $uo_home_odds);
    $stmt->bindParam(':uo_point', $uo_point);
    $stmt->bindParam(':uo_away_odds', $uo_away_odds);

    if ($stmt->execute()) {
        // 경기 등록이 성공한 경우, 성공 페이지로 리디렉션
        header("Location: prematch.php");
        exit;
    } else {
        // 등록 실패 시 에러 페이지로 리디렉션
        header("Location: sport_from.php");
        exit;
    }
} else {
    // 비정상적인 요청에 대한 에러 페이지로 리디렉션
    header("Location: sport_from.php");
    exit;
}
?>
