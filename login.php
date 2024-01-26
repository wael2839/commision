<!DOCTYPE html>
<html lang="ar">

<head>
    <link rel="icon" href="images/business.png">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/navs.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <title>تسجيل الدخول - كمسيون</title>
    <style>
        .box img {
            width: 120px;
            margin: 0 auto;
            border: 0px solid var(--main);
        }

        .box h1 {
            text-align: center;
            margin: 20px 0;
            color: var(--main);
        }
    </style>
</head>

<body>
    <form method="post" autocomplete="off">
        <div class="container flex-c">
            <div class="box p25 r15 grid-1-col g20">
                <img src="images/icon2.jpg" alt="" class="r50">
                <h1>كمسيون</h1>
                <div class="input-box">
                    <input type="text" name="username1" id="username1" autofocus required tabindex="1" autocomplete="off">
                    <label for="username1">اسم الأدمن: </label>
                </div>
                <div class="input-box">
                    <input type="password" name="pass1" id="pass1" autofocus required tabindex="1" autocomplete="off">
                    <label for="pass1">كلمة المرور: </label>
                </div>
                <button class="btn" name="submit" type="submit">دخول <i class="fa-solid fa-sign-in"></i></button>
                <?php
                include_once "includes/conn.php";
                if($conn){
                    if(isset($_POST["submit"])){
                        $sql = mysqli_query($conn, "SELECT a_username, a_password from `users` where `a_username` = '" . $_POST["username1"] . "' AND `a_password` = '" . $_POST["pass1"] . "';");
                        if(mysqli_num_rows($sql) > 0){
                            $data = mysqli_fetch_assoc($sql);
                            session_start();
                            $_SESSION["username"] = $data["a_username"];
                            header('location:./');
                        } else {
                            echo '<div class="error">المستخدم غير موجود</div>';
                        }
                    }
                }
                ?>
            </div>
        </div>
    </form>
</body>

</html>