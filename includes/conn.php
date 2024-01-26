<?php
    $servername = "localhost";
    $username = "wael";
    $password = "WWeal#123";
    $dbname = "commission";
    // إنشاء اتصال مع قاعدة البيانات
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $conn->set_charset("utf8mb4");
    $conp = new PDO("mysql:host=" . $servername . ";dbname=" . $dbname . ";charset=utf8", $username, $password);
?>