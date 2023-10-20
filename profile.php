<!DOCTYPE html>
<?php
    require_once 'header.php';
?>
<html lang="ko">
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
        <div class="form">
            <h1>프로필</h1>
            <form method="POST" action="profile_process.php" class="form_section">
                <div class="form_top">
                    <label for="nickname">닉네임: <?php echo $_SESSION['nickname']; ?></label>
                    <label for="price">보유머니: <?php echo $_SESSION['price']; ?></label>

                    <label for="new_password">새로운 비밀번호: </label>
                    <input type="password" id="new_password" name="new_password">

                    <label for="confirm_password">비밀번호 확인: </label>
                    <input type="password" id="confirm_password" name="confirm_password">
                </div>
                <div class="form_bottom">
                    <input type="submit" value="저장" class="submit">
                </div>
            </form>
        </div>
    </div>
</body>
</html>