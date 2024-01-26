<aside class="show">
    <img src="images/icon2.jpg">

    <h2 style="color: var(--main);"><?php echo $_SESSION["username"]; ?></h2>
    <hr>
    <?php $page = basename($_SERVER["PHP_SELF"]); ?>
    <a id="index" href="./"><i class="fa-solid fa-home"></i>&nbsp;الصفحة الرئيسية</a>
    <a id="suppliers" href="suppliers"><i class="fa-solid fa-user"></i>&nbsp; الموردين</a>
    <a id="customers" href="customers"><i class="fa-solid fa-users"></i>&nbsp; الزبائن</a>
    <a id="products" href="products"><i class="fa-brands fa-apple"></i>&nbsp; المنتجات</a>
    <a id="resevies" href="resevies"><i class="fa-solid fa-hand"></i>&nbsp; الاستلام</a>
    <a id="sales" href="sales"><i class="fa-solid fa-money-bill"></i>&nbsp; البيع</a>
    <a id="reports" href="reports" ><i class="fa-solid fa-file"></i>&nbsp; الفواتير</a>
    <br>
    <br>
    <br>
    <br>

    <a style="align-self: auto;" id="reports" href="devoloper"><i class="fa-solid fa-file"></i>&nbsp; المطور</a>
</aside>

