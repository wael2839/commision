<?php
include_once "includes/conn.php";
if ($conp) {
    switch ($_GET["t"]) {
        case "product":
            $sql = $conp->prepare('INSERT INTO `product` (`p_name`, `p_comm`)
                VALUES (:name, :comm)');
            $sql->bindParam('name', $_GET["pname"]);
            $sql->bindParam('comm', $_GET["pcomm"]);
            $sql->execute();
            echo "added";
            break;
        case "suppliers":
            $sql = $conp->prepare('INSERT INTO `farmer` (`f_name`, `f_phone`, `f_address`, `f_date`, `f_note`)
                VALUES (:name, :phone , :address , :date , :note)');
            $sql->bindParam('name', $_GET["fname"]);
            $sql->bindParam('phone', $_GET["fphone"]);
            $sql->bindParam('address', $_GET["faddress"]);
            $sql->bindParam('date', $_GET["fdate"]);
            $sql->bindParam('note', $_GET["fnote"]);
            $sql->execute();
            echo "added";
            break;
        case "customer":
            $sql = $conp->prepare('INSERT INTO `customer` (`c_name`, `c_phone`, `c_date`, `c_note`)
                    VALUES (:name, :phone , :date , :note)');
            $sql->bindParam('name', $_GET["cname"]);
            $sql->bindParam('phone', $_GET["cphone"]);
            $sql->bindParam('date', $_GET["cdate"]);
            $sql->bindParam('note', $_GET["cnote"]);
            $sql->execute();
            echo "added";
            break;
        case "customer":
            $sql = $conp->prepare('INSERT INTO `customer` (`c_name`, `c_phone`, `c_date`, `c_note`)
                    VALUES (:name, :phone , :date , :note)');
            $sql->bindParam('name', $_GET["cname"]);
            $sql->bindParam('phone', $_GET["cphone"]);
            $sql->bindParam('date', $_GET["cdate"]);
            $sql->bindParam('note', $_GET["cnote"]);
            $sql->execute();
            echo "added";
            break;
        case "receive":
            $sql = $conp->prepare('INSERT INTO `receive` (`r_date`, `f_id`, `p_id`, `quantity`, `notes`)
                    VALUES (:rdate, :fid , :pid , :quantity, :notes)');
            $sql->bindParam('rdate', $_GET["rdate"]);
            $sql->bindParam('fid', $_GET["fid"]);
            $sql->bindParam('pid', $_GET["pid"]);
            $sql->bindParam('quantity', $_GET["quantity"]);
            $sql->bindParam('notes', $_GET["notes"]);
            $sql->execute();
            echo "added";
            break;
        case "sale":
            $sql = $conp->prepare('INSERT INTO sale (`s_date`, `f_id`, `p_id`, `s_quantity`,`s_weight`,`s_price` ,`c_id`, `pb_id`, `s_notes`)
                    VALUES (:sdate, :fid , :pid , :quantity,:weight,:price,:cid,:pbid, :notes)');
            $sql->bindParam('sdate', $_GET["sdate"]);
            $sql->bindParam('fid', $_GET["fid"]);
            $sql->bindParam('pid', $_GET["pid"]);
            $sql->bindParam('quantity', $_GET["quantity"]);
            $sql->bindParam('weight', $_GET["weight"]);
            $sql->bindParam('price', $_GET["price"]);
            $sql->bindParam('cid', $_GET["cid"]);
            $sql->bindParam('pbid', $_GET["pbid"]);
            $sql->bindParam('notes', $_GET["notes"]);
            $sql->execute();
            echo "added";
            break;
        case "pay_bill":
            $sql = $conp->prepare('INSERT INTO `pay_bill` (`pb_id`, `pb_date`, `pb_note`)
                VALUES (:id, now() , :note );');
            $sql->bindParam('id', $_GET["new_bill_id"]);
            $sql->bindParam('note', $_GET["note"]);
            $sql->execute();
            $sql1 = $conp->prepare('UPDATE `sale` SET pb_id = :new_bill_id  WHERE pb_id = 0 AND f_id = :fid');
            $sql1->bindParam('fid', $_GET["fid"]);
            $sql1->bindParam('new_bill_id', $_GET["new_bill_id"]);
            $sql1->execute();
            break;
    }
}
