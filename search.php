<?php 
include_once './includes/conn.php';
if($conn){
    switch($_GET["t"]){
        case "product":
            $sql = mysqli_query($conn, 'SELECT * FROM product WHERE p_name LIKE "%' . $_GET["v"] . '%";');
        if(mysqli_num_rows($sql) > 0){
            while($data = mysqli_fetch_assoc($sql)){
                ?>
                    <tr>
                        <td><?php echo $data["p_id"]; ?></td>
                        <td><?php echo $data["p_name"]; ?></td>
                        <td><?php echo $data["p_comm"]; ?></td>
                        <td class="flex-c">
                            <div class="edit" data-id="<?php echo $data["p_id"]; ?>"
                                data-name="<?php echo $data["p_name"]; ?>" data-comm="<?php echo $data["p_comm"]; ?>">
                                <i class="fa-solid fa-edit"></i>
                            </div>
                        </td>
                    </tr>
                <?php
            }
        }
        break;
        case "supplier":
            $sql = mysqli_query($conn, 'SELECT * FROM farmer WHERE f_name LIKE "%' . $_GET["v"] . '%";');
            if(mysqli_num_rows($sql) > 0){
                while($data = mysqli_fetch_assoc($sql)){
                    ?>
                        <tr>
                            <td><?php echo $data["f_id"]; ?></td>
                            <td><?php echo $data["f_name"]; ?></td>
                            <td><?php echo $data["f_phone"]; ?></td>
                            <td><?php echo $data["f_address"]; ?></td>
                            <td><?php echo $data["f_date"]; ?></td>
                            <td><?php echo $data["f_note"]; ?></td>
                            
                            <td class="flex-c">
                                <div class="edit" data-id="<?php echo $data["f_id"]; ?>" data-name="<?php echo $data["f_name"]; ?>" 
                                data-phone="<?php echo $data["f_phone"]; ?>" data-address="<?php echo $data["f_address"]; ?>" 
                                data-date="<?php echo $data["f_date"]; ?>" data-note="<?php echo $data["f_note"]; ?>">
                                    <i class="fa-solid fa-edit"></i>
                                </div>
                            </td>
                        </tr>
                    <?php
                }
            }
            break;
            case "customer":
                $sql = mysqli_query($conn, 'SELECT * FROM customer WHERE c_name LIKE "%' . $_GET["v"] . '%";');
                if(mysqli_num_rows($sql) > 0){
                    while($data = mysqli_fetch_assoc($sql)){
                        ?>
                            <tr>
                                <td><?php echo $data["c_id"]; ?></td>
                                <td><?php echo $data["c_name"]; ?></td>
                                <td><?php echo $data["c_phone"]; ?></td>
                                <td><?php echo $data["c_date"]; ?></td>
                                <td><?php echo $data["c_note"]; ?></td>
                                
                                <td class="flex-c">
                                    <div class="edit" data-id="<?php echo $data["p_id"]; ?>"
                                        data-name="<?php echo $data["p_name"]; ?>" data-comm="<?php echo $data["p_comm"]; ?>">
                                        <i class="fa-solid fa-edit"></i>
                                    </div>
                                </td>
                            </tr>
                        <?php
                    }
                }
                break;

                case "receive":
                   $sql = mysqli_query($conn, 'SELECT r_id,r_date,f_name,p_name,quantity,notes FROM receive,farmer,product WHERE r_id =r_id AND receive.f_id =farmer.f_id AND receive.p_id=product.p_id AND f_name LIKE "%'.$_GET["v"].'%" ORDER BY r_id');
                    if(mysqli_num_rows($sql) > 0){
                        while($data = mysqli_fetch_assoc($sql)){
                            ?>
                                <tr>
                                    <td><?php echo $data["r_id"]; ?></td>
                                    <td><?php echo $data["r_date"]; ?></td>
                                    <td><?php echo $data["f_name"]; ?></td>
                                    <td><?php echo $data["p_name"]; ?></td>
                                    <td><?php echo $data["quantity"]; ?></td>
                                    <td><?php echo $data["notes"]; ?></td>
                                    
                                    <td class="flex-c">
                                        <div class="edit" data-id="<?php echo $data["p_id"]; ?>"
                                            data-name="<?php echo $data["p_name"]; ?>" data-comm="<?php echo $data["p_comm"]; ?>">
                                            <i class="fa-solid fa-edit"></i>
                                        </div>
                                    </td>
                                    <td class="">
                                        <div class="delet" data-id="<?php echo $data["r_id"]; ?>"data-date="<?php echo $data["r_date"]; ?>" 
                                        data-fname="<?php echo $data["f_name"]; ?>" data-pname="<?php echo $data["p_name"]; ?>" 
                                        data-quantity="<?php echo $data["quantity"];?>" data-notes="<?php echo $data["notes"]; ?>"
                                        data-fid="<?php echo $data["f_id"];?>"data-pid="<?php echo $data["p_id"];?>">
                                            <i class="fa-solid fa-close"></i>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                        }
                    }
                    break;
                    case "sale":
                        $sql = mysqli_query($conn, 'SELECT s_id,s_date,f_name,p_name,p_comm,s_quantity,s_weight,s_price,c_name,pb_id,s_notes FROM sale,farmer,product,customer WHERE s_id =s_id AND sale.f_id=farmer.f_id AND sale.p_id=product.p_id AND sale.c_id=customer.c_id AND f_name LIKE "%'.$_GET["v"].'%" ORDER BY s_id');
                        if(mysqli_num_rows($sql) > 0){
                            while($data = mysqli_fetch_assoc($sql)){
                                ?>
                                    <tr>
                                    <td><?php echo $data["s_id"]; ?></td>
                                        <td><?php echo $data["s_date"]; ?></td>
                                        <td><?php echo $data["f_name"]; ?></td>
                                        <td><?php echo $data["p_name"]; ?></td>
                                        <td><?php echo $data["s_quantity"]; ?></td>
                                        <td><?php echo $data["s_weight"]; ?></td>
                                        <td><?php echo number_format(round(($data["s_price"]),2)); ?></td>
                                        <td><?php echo number_format(round((($data["s_weight"])*$data["s_price"]),2)); ?></td>
                                        <td><?php echo number_format(round(((($data["s_weight"])*$data["s_price"])*$data["p_comm"]),2)); ?></td>
                                        <td><?php echo $data["c_name"]; ?></td>
                                        <td><?php echo $data["s_notes"]; ?></td>
                                        <td><?php echo $data["pb_id"]; ?></td>
                                        <td class="flex-c">
                                            <div class="edit" data-id="<?php echo $data["s_id"]; ?>" data-date="<?php echo $data["s_date"]; ?>" 
                                            data-fname="<?php echo $data["f_name"]; ?>" data-pname="<?php echo $data["p_name"]; ?>" 
                                            data-quantity="<?php echo $data["s_quantity"];?>" data-weight="<?php echo $data["s_weight"];?>"
                                            data-price="<?php echo $data["s_price"];?>" data-cname="<?php echo $data["c_name"]; ?>"
                                            data-notes="<?php echo $data["s_notes"];?>"data-pbid="<?php echo $data["pb_id"];?>"
                                            data-comm="<?php echo $data["p_comm"];?>">
                                                <i class="fa-solid fa-edit"></i>
                                            </div>
                                        </td>
                                        <td class="">
                                            <div class="delet" data-id="<?php echo $data["s_id"]; ?>" data-date="<?php echo $data["s_date"]; ?>" 
                                            data-fname="<?php echo $data["f_name"]; ?>" data-pname="<?php echo $data["p_name"]; ?>" 
                                            data-quantity="<?php echo $data["s_quantity"];?>" data-weight="<?php echo $data["s_weight"];?>"
                                            data-price="<?php echo $data["s_price"];?>" data-cname="<?php echo $data["c_name"]; ?>"
                                            data-notes="<?php echo $data["s_notes"];?>"data-pbid="<?php echo $data["pb_id"];?>"
                                            data-total="<?php echo ($data["s_weight"])*$data["s_price"];?>"data-comm="<?php echo $data["p_comm"];?>">
                                                <i class="fa-solid fa-close"></i>
                                            </div>
                                        </td>
    
                                     </tr>
                                 <?php
                             }
                         }
                         break;
                         case "report":
                            $sql = mysqli_query($conn, 'SELECT DISTINCT pay_bill.pb_id,pb_date,f_name,pb_note FROM pay_bill,farmer,sale WHERE pay_bill.pb_id=sale.pb_id AND sale.f_id=farmer.f_id AND pay_bill.pb_id >=1 AND f_name LIKE "%'.$_GET["v"].'%" ORDER BY pb_id;');
                            if(mysqli_num_rows($sql) > 0){
                                while($data = mysqli_fetch_assoc($sql)){
                                    ?>
                                        <tr>
                                        <td><?php echo $data["pb_id"]; ?></td>
                                    <td><?php echo $data["pb_date"]; ?></td>
                                    <td><?php echo $data["f_name"]; ?></td>
                                    <td>
                                        <?php include_once "includes/conn.php";
                                        if ($conn) {
                                            $pb_id = $data['pb_id'];
                                            $sql1 = mysqli_query($conn, "SELECT sum((s_price * s_weight )-(s_price * s_weight * p_comm)) FROM sale,product WHERE sale.p_id=product.p_id AND sale.pb_id = '$pb_id'");
                                            while ($data1 = mysqli_fetch_assoc($sql1)) {
                                                echo number_format(round($data1['sum((s_price * s_weight )-(s_price * s_weight * p_comm))'], 1));
                                            }
                                        } ?></td>
                                    <td><?php echo $data["pb_note"]; ?></td>

                                    <td class="">
                                        <div class="view" data-id="<?php echo $data["pb_id"]; ?>" data-note="<?php echo $data["pb_note"]; ?>"  data-date="<?php echo $data["pb_date"]; ?>" data-fname="<?php echo $data["f_name"]; ?>">
                                            <i class="fa-sharp fa-solid fa-eye"></i>
                                        </div>
                                    </td>
                                    
                                    <td class="">
                                        <div class="delet" data-id="<?php echo $data["pb_id"]; ?>">
                                            <i class="fa-solid fa-close"></i>
                                        </div>
                                    </td>
        
                                         </tr>
                                     <?php
                                 }
                             }
                             break;

        
    }
    
}
?>