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
            <a href="sport_from.php" calss="header_nav_sport">설정</a>
        </nav>
    </div>
    <div id="body">
<!--        <h2>경기 목록</h2>-->
        <table class="match-table">
            <tr>
                <th>경기 ID</th>
                <th>시작 시간</th>
                <th>종목</th>
                <th>홈 팀명</th>
                <th>승</th>
                <th>무</th>
                <th>패</th>
                <th>원정 팀명</th>
<!--                <th>종목</th>-->
<!--                <th>홈팀 핸디캡</th>-->
<!--                <th>원정팀 핸디캡</th>-->
<!--                <th>핸디캡 기준</th>-->
<!--                <th>홈팀 언더오버 배당</th>-->
<!--                <th>원정팀 언더오버 배당</th>-->
<!--                <th>언더오버 기준</th>-->
            </tr>
            <?php
            foreach ($matches as $match) {
                echo "<tr>";
                    echo "<td>" . $match['match_id'] . "</td>";
                    echo "<td>" . $match['match_start_time'] . "</td>";
                    echo "<td>승무패</td>";
//                    echo "<td>" . $match['sport_name'] . "</td>";
                    echo "<td>" . $match['home_team_name'] . "</td>";
                    echo "<td><button class='add-to-cart' data-match-id='" . $match['match_id'] . "' data-odds-type='s_home_odds'>승(" . $match['s_home_odds'] . ")</button></td>";
                    echo "<td><button class='add-to-cart' data-match-id='" . $match['match_id'] . "' data-odds-type='s_middle_odds'>무(" . $match['s_middle_odds'] . ")</button></td>";
                    echo "<td><button class='add-to-cart' data-match-id='" . $match['match_id'] . "' data-odds-type='s_away_odds'>패(" . $match['s_away_odds'] . ")</button></td>";
                    echo "<td>" . $match['away_team_name'] . "</td>";
//                    echo "<td>" . $match['s_home_odds'] . "</td>";
//                    echo "<td>" . $match['s_middle_odds'] . "</td>";
//                    echo "<td>" . $match['s_away_odds'] . "</td>";
                echo "</tr>";
                echo "<tr>";
                    echo "<td>" . $match['match_id'] . "</td>";
                    echo "<td>" . $match['match_start_time'] . "</td>";
                    echo "<td>핸디캡</td>";
                    echo "<td>" . $match['home_team_name'] . "</td>";
                    echo "<td><button class='add-to-cart' data-match-id='" . $match['match_id'] . "' data-odds-type='h_home_odds'>핸디승(" . $match['h_home_odds'] . ")</button></td>";
                    echo "<td>" . $match['h_point'] . "</td>";
                    echo "<td><button class='add-to-cart' data-match-id='" . $match['match_id'] . "' data-odds-type='h_away_odds'>핸디패(" . $match['h_away_odds'] . ")</button></td>";
//                    echo "<td>" . $match['h_home_odds'] . "</td>";
//                    echo "<td>" . $match['h_away_odds'] . "</td>";
                    echo "<td>" . $match['away_team_name'] . "</td>";
                echo "</tr>";
                echo "<tr>";
                    echo "<td>" . $match['match_id'] . "</td>";
                    echo "<td>" . $match['match_start_time'] . "</td>";
                    echo "<td>언더오버</td>";
                    echo "<td>" . $match['home_team_name'] . "</td>";
//                    echo "<td>" . $match['uo_home_odds'] . "</td>";
                    echo "<td><button class='add-to-cart' data-match-id='" . $match['match_id'] . "' data-odds-type='uo_home_odds'>언더(" . $match['uo_home_odds'] . ")</button></td>";
                    echo "<td>" . $match['uo_point'] . "</td>";
                    echo "<td><button class='add-to-cart' data-match-id='" . $match['match_id'] . "' data-odds-type='uo_away_odds'>오버(" . $match['uo_away_odds'] . ")</button></td>";
//                    echo "<td>" . $match['uo_away_odds'] . "</td>";
                    echo "<td>" . $match['away_team_name'] . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
    <!-- 모달 폼 -->
    <div id="cartModal">
        <h2>베팅 카트</h2>
        <div id="cartData"></div>
        <p>배당 합계: <span id="totalOdds">0.00</span></p>
        <label for="betAmount">베팅 금액: </label>
        <input type="text" id="betAmount">
        <button id="sendToServerButton">배팅 전송</button>
    </div>
</body>
<script>
    const userId = <?php echo json_encode($_SESSION['user_id']); ?>;
    const buttons = document.querySelectorAll('.add-to-cart');
    const cartData = document.getElementById('cartData');
    let totalOdds = 0;
    let betAmount = 0;
    const totalOddsElement = document.getElementById('totalOdds');
    const betAmountElement = document.getElementById('betAmount');
    // 배열로 선택한 배당 정보를 저장
    const cartItems = [];
    const sendToServerButton = document.getElementById('sendToServerButton');
    sendToServerButton.addEventListener('click', sendCartDataToServer);

    buttons.forEach(button => {
        button.addEventListener('click', () => {
            const matchId = button.getAttribute('data-match-id');
            const oddsType = button.getAttribute('data-odds-type');
            const oddsValueMatch = button.textContent.match(/\d+\.\d+/);
            const oddsValue = oddsValueMatch ? parseFloat(oddsValueMatch[0]) : NaN;
            cartItems.push({ matchId, oddsType, oddsValue });

            // 배당 합계 및 화면 업데이트
            updateTotalOddsAndBetAmount();
            // 모달에 데이터 추가
            updateCartModal();
        });
    });

    // 모달에 데이터 업데이트
    function updateCartModal() {
        cartData.innerHTML = '';
        cartItems.forEach(item => {
            const cartItem = document.createElement('p');
            cartItem.innerHTML = `
                경기 ID: ${item.matchId}<br>
                배당 종류: ${item.oddsType}<br>
                배당 값: ${item.oddsValue.toFixed(2)}<br>
            `;
            cartData.appendChild(cartItem);
        });
    }

    // 배당 합계와 배팅 금액 업데이트
    function updateTotalOddsAndBetAmount() {
        totalOdds = cartItems.reduce((sum, item) => sum + item.oddsValue, 0);
        totalOddsElement.textContent = totalOdds.toFixed(2);
    }

    // 모달 데이터를 서버로 전송하는 함수 (PHP 프로세스로)
    function sendCartDataToServer() {
        // 배열 데이터를 JSON 문자열로 변환
        const dataToSend = {
            userId: userId,
            totalOdds: totalOdds,
            betAmount: betAmount,
            cartItems: cartItems // cartItems에 있는 배열 데이터
        };
        const cartDataJSON = JSON.stringify(dataToSend);
        // console.log("cartDataJSON", cartDataJSON);

        // AJAX 요청을 생성
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'bet_process.php', true); // 여기서 open 메서드로 XMLHttpRequest를 엽니다.
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        // xhr.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
        // xhr.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
        // xhr.setRequestHeader('Content-Type', 'application/json');

        // 요청이 완료되었을 때 실행되는 콜백
        xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 300) {
                // 서버 응답 확인
                console.log('서버 응답:', xhr.responseText);

                // 배당 합계와 배팅 금액 초기화
                totalOdds = 0;
                betAmount = 0;
                totalOddsElement.textContent = totalOdds.toFixed(2);
                betAmountElement.value = '';

                // 모달 데이터 초기화
                cartData.innerHTML = '';
                cartItems.length = 0;

                // 성공적인 처리 후, 화면 이동 //
                // window.location.href = 'bet_process.php';
            } else {
                // 오류 처리
                console.error('서버 오류:', xhr.status, xhr.statusText);
            }
        };
        // 데이터를 서버로 보냄
        // const formData = new FormData();
        // formData.append('data', cartDataJSON);
        // xhr.send(formData); // ** FormData를 전송합니다 **

        // 데이터를 서버로 보냄
        xhr.send('data=' + encodeURIComponent(cartDataJSON)); // POST 요청으로 데이터 보냄
        // const formData = new FormData();
        // formData.append('data', cartDataJSON);
        // xhr.send(formData);
        // xhr.send(cartDataJSON); // 여기서 send 메서드로 데이터를 보냅니다.
        // xhr.send('data=' + cartDataJSON);
        // window.location.href = 'bet_process.php';
    }
</script>

</html>