<!DOCTYPE html>
<?php
    require_once 'header.php';
    require_once 'db_config.php';

    // 경기 정보를 가져올 SQL 쿼리 작성
    $sql = "SELECT m.match_id, m.match_start_time, 
                   t1.team_name AS home_team_name, t2.team_name AS away_team_name, 
                   s.sport_name AS sport_name, 
                   m.s_home_odds, m.s_away_odds, m.s_middle_odds, 
                   m.h_home_odds, m.h_away_odds, m.h_point, 
                   m.uo_home_odds, m.uo_away_odds, m.uo_point
            FROM matches AS m
            INNER JOIN teams AS t1 ON m.home_team_id = t1.team_id
            INNER JOIN teams AS t2 ON m.away_team_id = t2.team_id
            INNER JOIN sports AS s ON m.sport_id = s.sport_id";

    // SQL 쿼리 실행
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $matches = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 데이터베이스 연결 닫기
    $conn = null;
    // $matches 배열에 경기 정보가 저장됨
?>
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
            <a href="profile.php"class="header_nav_profile">프로필</a>
            <a href="sport_from.php" calss="header_nav_sport">경기등록</a>
        </nav>
    </div>
    <div id="body">
        <h2>경기 목록</h2>
        <table>
            <tr>
                <th>경기 ID</th>
                <th>시작 시간</th>
                <th>홈 팀</th>
                <th>원정 팀</th>
                <th>종목</th>
                <th>홈팀 배당</th>
                <th>원정팀 배당</th>
                <th>무승부 배당</th>
                <th>홈팀 핸디캡</th>
                <th>원정팀 핸디캡</th>
                <th>핸디캡 기준</th>
                <th>홈팀 언더오버 배당</th>
                <th>원정팀 언더오버 배당</th>
                <th>언더오버 기준</th>
            </tr>
            <?php
            foreach ($matches as $match) {
                echo "<tr>";
                echo "<td>" . $match['match_id'] . "</td>";
                echo "<td>" . $match['match_start_time'] . "</td>";
                echo "<td>" . $match['home_team_name'] . "</td>";
                echo "<td>" . $match['away_team_name'] . "</td>";
                echo "<td>" . $match['sport_name'] . "</td>";
                echo "<td>" . $match['s_home_odds'] . "</td>";
                echo "<td>" . $match['s_away_odds'] . "</td>";
                echo "<td>" . $match['s_middle_odds'] . "</td>";
                echo "<td>" . $match['h_home_odds'] . "</td>";
                echo "<td>" . $match['h_away_odds'] . "</td>";
                echo "<td>" . $match['h_point'] . "</td>";
                echo "<td>" . $match['uo_home_odds'] . "</td>";
                echo "<td>" . $match['uo_away_odds'] . "</td>";
                echo "<td>" . $match['uo_point'] . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>