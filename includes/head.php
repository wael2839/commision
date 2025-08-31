<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="styles/main.css">
<link rel="stylesheet" href="styles/navs.css">
<link rel="stylesheet" href="styles/table.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/alexandria/css/variable.css">


<link rel="icon" href="images/icon2.jpg">
<title>
<?php 
        $page = basename($_SERVER["PHP_SELF"]);
        switch($page){
            case "login.php": echo "تسجيل الدخول"; break;
            case "index.php": echo "الصفحة الرئيسية";break;
            case "products.php": echo " المنتجات"; break;  
            case "suppliers.php": echo "الموردون"; break;
            case "customers.php": echo "الزبائن"; break;
            case "resevies.php": echo "الاستلام "; break;
            case "sales.php": echo " البيع"; break;
            case "reports.php": echo "الفواتير "; break;
        }
    ?>
</title>

<?php
    session_start();
    if(!isset($_SESSION["username"])){
        header('location:login');
    } else {
        // echo '<script>alert("' . $_SESSION["username"] . '");</script>';
    }
?>