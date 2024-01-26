<header class="flex-b">
    <div class="btn-sider click"></div>
    <h2>
        <!-- for name page-->
        <?php 
        $page = basename($_SERVER["PHP_SELF"]);
        switch($page){
            case "login.php": echo "تسجيل الدخول"; break;
            case "index.php": echo "الصفحة الرئيسية"; break;
            case "products.php": echo " المنتجات"; break;  
            case "suppliers.php": echo "الموردون"; break;
            case "customers.php": echo "الزبائن"; break;
            case "resevies.php": echo "الاستلام "; break;
            case "sales.php": echo " البيع"; break;
            case "reports.php": echo "الفواتير "; break;
        }
    ?>
    </h2>
    <img src="images/icon2.jpg">
</header>