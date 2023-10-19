<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <link rel="stylesheet" type="text/css" href="/css/styles.css">
</head>
<body>
<div id="logo">
    <div class="logo_img">
        <img src="https://shop-phinf.pstatic.net/20230329_245/1680077568628LMcpa_PNG/%C0%D5%C3%F7%C5%C5%B8%AE_%B7%CE%B0%ED_%C4%B5%B9%F6%BD%BA_%C5%A9%B1%E23.png?type=w640" alt="">
    </div>
</div>
<div id="body">
    <div class="form">
        <form method="POST" action="register_process.php" class="form_section">
            <div class="form_top">
                <label for="userid" class="label">userid : </label>
                <input type="text" id="userid" name="userid" required>

                <label for="password" class="label">Password : </label>
                <input type="password" id="password" name="password" required>

                <label for="confirm_password" class="label">Confirm_password : </label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <div class="form_bottom">
                <input type="submit" value="완료" class="submit">
            </div>
        </form>
    </div>
</div>

</body>
</html>