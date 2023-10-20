<?php
    require_once 'header.php';

    // 데이터베이스 연결 설정
    require_once 'db_config.php';

    // 팀 목록을 불러옵니다.
    $sql = "SELECT team_id, team_name FROM teams";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $teams = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 종목 불러오기
    $sql = "SELECT sport_id, sport_name FROM sports";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $sports = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 데이터베이스 연결 닫기
    $conn = null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>main</title>
    <link rel="stylesheet" type="text/css" href="/css/styles.css">
</head>
<body>
<div id="logo">
    <div class="logo_img">
        <a href="main.php">
            <img src="https://shop-phinf.pstatic.net/20230329_245/1680077568628LMcpa_PNG/%C0%D5%C3%F7%C5%C5%B8%AE_%B7%CE%B0%ED_%C4%B5%B9%F6%BD%BA_%C5%A9%B1%E23.png?type=w640" alt="">
        </a>
    </div>
</div>
<div id="header">
    <nav class="header_nav">
        <a href="prematch.php" class="header_nav_pre">스포츠</a>
        <a href="betslip.php" class="header_nav_betslip">배팅내역</a>
        <a href="profile.php" class="header_nav_profile">프로필</a>
        <a href="sport_from.php" calss="header_nav_sport">설정</a>
    </nav>
</div>
    <form method="POST" action="sport_process.php">
        <input type="text" id="team_name" name="team_name" placeholder="팀명">
        <input type="text" id="league_name" name="league_name" placeholder="리그명">
        <input type="submit" value="추가">
    </form>
    <form method="POST" action="sport_process.php">
        <input type="text" id="sport_name" name="sport_name" placeholder="종목">
        <input type="submit" value="추가">
    </form>
<h2>경기 등록</h2>
<form method="post" action="match_registration_process.php">
    <!-- 승무패 -->
    <label for="home_team">홈팀: </label>
    <select name="home_team" id="home_team">
        <?php
        foreach ($teams as $team) {
            echo '<option value="' . $team['team_id'] . '">' . $team['team_name'] . '</option>';
        }
        ?>
    </select>
    <label for="s_home_odds">홈팀 배당: </label>
    <input type="text" name="s_home_odds" id="s_home_odds">
    <label for="s_middle_odds">무승부 배당: </label>
    <input type="text" name="s_middle_odds" id="s_middle_odds">
    <label for="away_team">원정팀: </label>
    <select name="away_team" id="away_team">
        <?php
        foreach ($teams as $team) {
            echo '<option value="' . $team['team_id'] . '">' . $team['team_name'] . '</option>';
        }
        ?>
    </select>
    <label for="s_away_odds">원정팀 배당: </label>
    <input type="text" name="s_away_odds" id="s_away_odds">
    <label for="sport">경기 종목: </label>
    <select name="sport" id="sport">
        <?php
        foreach ($sports as $sport) {
            echo '<option value="' . $sport['sport_id'] . '">' . $sport['sport_name'] . '</option>';
        }
        ?>
    </select>
    <label for="start_time">경기 시작 시간: </label>
    <input type="datetime-local" name="start_time" id="start_time">
    <hr> <!-- 각 섹션 구분을 위한 가로선 추가 -->
    <!-- 핸디캡 -->
    <label for="h_home_odds">홈팀 배당: </label>
    <input type="text" name="h_home_odds" id="h_home_odds">
    <label for="h_point">핸디캡 기준: </label>
    <input type="text" name="h_point" id="h_point">
    <label for="h_away_odds">원정팀 배당: </label>
    <input type="text" name="h_away_odds" id="h_away_odds">
    <hr> <!-- 각 섹션 구분을 위한 가로선 추가 -->
    <!-- 언더오버 -->
    <label for="uo_home_odds">언더 배당: </label>
    <input type="text" name="uo_home_odds" id="uo_home_odds">
    <label for="uo_point">언더오버 기준: </label>
    <input type="text" name="uo_point" id="uo_point">
    <label for="uo_away_odds">오버 배당: </label>
    <input type="text" name="uo_away_odds" id="uo_away_odds">
    <input type="submit" value="등록">
</form>
    <h2>결과처리</h2>
    <form method="POST" action="score_process.php">
        <label for="match_id">경기 ID: </label>
        <input type="text" id="match_id" name="match_id" placeholder="경기 ID">
        <label for="home_team_score">홈 스코어: </label>
        <input type="text" id="home_team_score" name="home_team_score" placeholder="홈">
        <label for="away_team_score">원정 스코어: </label>
        <input type="text" id="away_team_score" name="away_team_score" placeholder="원정">
        <label for="status">경기 상태: </label>
        <select name="status" id="status">
            <option value="경기전">경기전</option>
            <option value="경기중">경기중</option>
            <option value="경기종료">경기종료</option>
            <option value="적중특례">적중특례</option>
        </select>
        <input type="submit" value="확인">
    </form>
</body>
</html>