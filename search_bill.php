<?php
include_once './includes/conn.php';
if ($conn) {
    switch ($_GET["t"]) {
        case "pay_bill":

            //  $sql = mysqli_query($conn, 'SELECT sale.s_id,sale.s_date,product.p_name,sale.s_quantity,sale.s_weight,sale.s_price FROM farmer,sale,product WHERE p_name LIKE "%' . $_GET["v"] . '%";');

            $sql = mysqli_query($conn, "SELECT s_id,s_date,p_name,s_quantity,s_weight,s_price FROM sale,product WHERE sale.f_id='" . $_GET["v"] . "' AND sale.p_id=product.p_id AND sale.pb_id = '0' ");
            if (mysqli_num_rows($sql) > 0) {
                while ($data = mysqli_fetch_assoc($sql)) {
?>
                    <tr>
                        <td><?php echo $data["s_id"]; ?></td>
                        <td><?php echo $data["s_date"]; ?></td>
                        <td><?php echo $data["p_name"]; ?></td>
                        <td><?php echo $data["s_quantity"]; ?></td>
                        <td><?php echo $data["s_weight"]; ?></td>
                        <td><?php echo number_format($data["s_price"]); ?></td>
                        <td><?php echo number_format(round($data['s_weight'] * $data['s_price'])) ?> </td>
                    </tr>




                <?php
                } ?>

                <?php
                include_once "includes/conn.php";
                if ($conn) {
                    $sql = mysqli_query($conn, "SELECT s_weight,s_price,SUM(s_weight*s_price),SUM((s_weight*s_price)*p_comm) FROM sale,product WHERE sale.f_id='" . $_GET["v"] . "' AND sale.p_id=product.p_id AND sale.pb_id = '0' ");
                    if (mysqli_num_rows($sql) > 0) {
                        while ($data = mysqli_fetch_assoc($sql)) {
                ?><tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>الاجمالي</td>
                                <td><?php echo number_format(round($data['SUM(s_weight*s_price)'], 1)) ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>العمولة</td>
                                <td><?php echo number_format(round($data['SUM((s_weight*s_price)*p_comm)'], 1)) ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>الصافي</td>
                                <td><?php echo number_format(round($data['SUM(s_weight*s_price)'], 1) - round($data['SUM((s_weight*s_price)*p_comm)'], 1)) ?></td>
                            </tr>
                <?php }
                    }
                } ?>
<?php
            }
            break;
            case "pay_bill_view":

                //  $sql = mysqli_query($conn, 'SELECT sale.s_id,sale.s_date,product.p_name,sale.s_quantity,sale.s_weight,sale.s_price FROM farmer,sale,product WHERE p_name LIKE "%' . $_GET["v"] . '%";');
    
                $sql = mysqli_query($conn, "SELECT s_id,s_date,p_name,s_quantity,s_weight,s_price FROM sale,product WHERE sale.pb_id='" . $_GET["v"] . "' AND sale.p_id=product.p_id");
                if (mysqli_num_rows($sql) > 0) {
                    while ($data = mysqli_fetch_assoc($sql)) {
    ?>
                        <tr>
                            <td><?php echo $data["s_id"]; ?></td>
                            <td><?php echo $data["s_date"]; ?></td>
                            <td><?php echo $data["p_name"]; ?></td>
                            <td><?php echo $data["s_quantity"]; ?></td>
                            <td><?php echo $data["s_weight"]; ?></td>
                            <td><?php echo $data["s_price"]; ?></td>
                            <td><?php echo number_format(round($data['s_weight'] * $data['s_price'])) ?> </td>
                        </tr>
    
    
    
    
                    <?php
                    } ?>
    
                    <?php
                    include_once "includes/conn.php";
                    if ($conn) {
                        $sql = mysqli_query($conn, "SELECT s_weight,s_price,SUM(s_weight*s_price),SUM((s_weight*s_price)*p_comm) FROM sale,product WHERE sale.pb_id='" . $_GET["v"] . "' AND sale.p_id=product.p_id");
                        if (mysqli_num_rows($sql) > 0) {
                            while ($data = mysqli_fetch_assoc($sql)) {
                    ?><tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>الاجمالي</td>
                                    <td><?php echo number_format(round($data['SUM(s_weight*s_price)'], 1)) ?></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>العمولة</td>
                                    <td><?php echo number_format(round($data['SUM((s_weight*s_price)*p_comm)'], 1)) ?></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>الصافي</td>
                                    <td><?php echo number_format(round($data['SUM(s_weight*s_price)'], 1) - round($data['SUM((s_weight*s_price)*p_comm)'], 1)) ?></td>
                                </tr>
                    <?php }
                        }
                    } ?>
    <?php
                }
                break;
    }
}
?>