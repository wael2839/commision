<!DOCTYPE html>
<html>

<head>
    <?php include_once "includes/head.php"; ?>
</head>

<body>
    <?php include_once "includes/sider.php"; ?>

    <div class="container wid">
        <?php include_once "includes/header.php"; ?>
        <div class="container1">
            
            <div class="card">
                <h1 >عدد الموردين</h1>
            
                <h2><?php include_once "includes/conn.php";
                    if($conn){
                        $sql = mysqli_query($conn, 'SELECT COUNT(*) FROM `farmer`;');
                        while($data = mysqli_fetch_assoc($sql)){
                            echo  $data['COUNT(*)'];
                        } } ?></h2>
                        <h1>عدد الزبائن</h1>
            
            <h2><?php include_once "includes/conn.php";
                if($conn){
                    $sql = mysqli_query($conn, 'SELECT COUNT(*) FROM `customer`;');
                    while($data = mysqli_fetch_assoc($sql)){
                        echo  $data['COUNT(*)'];
                    } } ?></h2>
            </div>
           
            <div class="card">
                <h1 >عدد المنتجات</h1>
            
                <h2><?php include_once "includes/conn.php";
                    if($conn){
                        $sql = mysqli_query($conn, 'SELECT COUNT(*) FROM `product`;');
                        while($data = mysqli_fetch_assoc($sql)){
                            echo  $data['COUNT(*)'];
                        } } ?></h2>
            </div>
            <div class="card">
                <h1>اجمالي الفواتير المستحقة </h1>
            
                <h2><?php include_once "includes/conn.php";
                    if($conn){
                        $sql = mysqli_query($conn, 'SELECT SUM((s_price)*(s_weight)) FROM `sale` WHERE pb_id=0;');
                        while($data = mysqli_fetch_assoc($sql)){
                            echo  number_format(round($data['SUM((s_price)*(s_weight))'],1));
                        } } ?></h2>
                        <label for="totald">ل.س</label>
            </div>
            <div class="card">
                <h1 >الدخل اليومي </h1>
                <h2 id="totald"><?php include_once "includes/conn.php";
                    if($conn){
                         $current_date = date_create();
                         $date = date_format($current_date, 'Y-m-d');
                        $sql = mysqli_query($conn, 'SELECT sum(s_price * s_weight) FROM `sale`WHERE s_date = CURDATE()' );
                        while($data = mysqli_fetch_assoc($sql)){
                            echo number_format(round($data['sum(s_price * s_weight)'],1)) ;
                        } } ?></h2>
                        <label for="totald">ل.س</label>
                <h3 >الربح اليومي </h3>
                <h2 id="profd"> <?php include_once "includes/conn.php";
                    if($conn){
                        $sql = mysqli_query($conn, 'SELECT sum(s_price * s_weight * p_comm) FROM sale,product WHERE sale.p_id=product.p_id AND s_date = CURDATE()');
                        while($data = mysqli_fetch_assoc($sql)){
                            echo number_format(round($data['sum(s_price * s_weight * p_comm)'],1) );
                        } } ?></h2>
                        <label for="profd">ل.س</label>
            </div>
            <div class="card">
                <h1>دخل آخر 7 ايام </h1>
                <h2 id="totalw"><?php include_once "includes/conn.php";
                    if($conn){
                         $current_date = date_create();
                         $date = date_format($current_date, 'Y-m-d');
                        $sql = mysqli_query($conn, 'SELECT sum(s_price * s_weight) FROM `sale`WHERE s_date >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK);' );
                        while($data = mysqli_fetch_assoc($sql)){
                            echo number_format(round($data['sum(s_price * s_weight)'],1)) ;
                        } } ?></h2>
                        <label for="totalw">ل.س</label>
                <h3 id="profw">ربح آخر 7 ايام </h3>
                <h2><?php include_once "includes/conn.php";
                    if($conn){
                        $sql = mysqli_query($conn, 'SELECT sum(s_price * s_weight * p_comm) FROM sale,product WHERE sale.p_id=product.p_id AND s_date >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK);');
                        while($data = mysqli_fetch_assoc($sql)){
                            echo number_format(round($data['sum(s_price * s_weight * p_comm)'],1)) ;
                        } } ?></h2>
                        <label for="profw">ل.س</label>
            </div>
            <div class="card">
                <h1 >الدخل السنوي</h1>
                <h2 id="totaly"><?php include_once "includes/conn.php";
                    if($conn){
                         $current_date = date_create();
                         $date = date_format($current_date, 'Y-m-d');
                        $sql = mysqli_query($conn, 'SELECT sum(s_price * s_weight) FROM `sale`WHERE s_date >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR);' );
                        while($data = mysqli_fetch_assoc($sql)){
                            echo number_format(round($data['sum(s_price * s_weight)'],1)) ;
                        } } ?></h2>
                <label for="totaly">ل.س</label>
                <h3 >الربح السنوي </h3>
                <h2 id="profy"><?php include_once "includes/conn.php";
                    if($conn){
                        $sql = mysqli_query($conn, 'SELECT sum(s_price * s_weight * p_comm) FROM sale,product WHERE sale.p_id=product.p_id AND s_date >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR);');
                        while($data = mysqli_fetch_assoc($sql)){
                            echo number_format(round($data['sum(s_price * s_weight * p_comm)'],1)) ;
                        } } ?></h2>
                <label for="profy">ل.س</label>
            </div>

        </div>

    </div>




    <?php include_once "includes/footer.php"; ?>
</body>

</html>