<?php
include_once "includes/conn.php";
if ($conp) {
    switch ($_GET["t"]) {
        case "product":
            $sql = $conp->prepare('UPDATE `product` SET p_name = :name, p_comm = :comm WHERE p_id = :id');
            $sql->bindParam('name', $_GET["pname"]);
            $sql->bindParam('comm', $_GET["pcomm"]);
            $sql->bindParam('id', $_GET["id"]);
            $sql->execute();
            echo "edited";
            break;
        case "suppliers":
            $sql = $conp->prepare('UPDATE `farmer` SET f_name = :name, f_phone = :phone, f_address = :address , f_date = :date , f_note = :note WHERE f_id = :id');
            $sql->bindParam('id', $_GET["id"]);
            $sql->bindParam('name', $_GET["fname"]);
            $sql->bindParam('phone', $_GET["fphone"]);
            $sql->bindParam('address', $_GET["faddress"]);
            $sql->bindParam('date', ($_GET["fdate"]));
            $sql->bindParam('note', $_GET["fnote"]);
            $sql->execute();
            echo "edited";
            break;
        case "customer":
            $sql = $conp->prepare('UPDATE `customer` SET c_name = :name, c_phone = :phone, c_date = :date , c_note = :note WHERE c_id = :id');
            $sql->bindParam('id', $_GET["id"]);
            $sql->bindParam('name', $_GET["cname"]);
            $sql->bindParam('phone', $_GET["cphone"]);
            $sql->bindParam('date', ($_GET["cdate"]));
            $sql->bindParam('note', $_GET["cnote"]);
            $sql->execute();
            echo "edited";
            break;
        case "receive":
            $sql = $conp->prepare('UPDATE `receive` SET r_date = :date , f_id = :fid, p_id = :pid , quantity = :quantity , notes = :notes WHERE r_id = :id');
            $sql->bindParam('id', $_GET["id"]);
            $sql->bindParam('date', $_GET["rdate"]);
            $sql->bindParam('fid', $_GET["fid"]);
            $sql->bindParam('pid', $_GET["pid"]);
            $sql->bindParam('quantity', $_GET["quantity"]);
            $sql->bindParam('notes', $_GET["notes"]);
            $sql->execute();
            echo "edited";
            break;
        case "sale":
            $sql = $conp->prepare('UPDATE `sale` SET s_date = :date , f_id = :fid, p_id = :pid , s_quantity = :quantity , s_weight = :weight 
                    , s_price = :price , c_id = :cid , pb_id = :pbid , s_notes = :notes WHERE s_id = :id');
            $sql->bindParam('id', $_GET["id"]);
            $sql->bindParam('date', $_GET["sdate"]);
            $sql->bindParam('fid', $_GET["fid"]);
            $sql->bindParam('pid', $_GET["pid"]);
            $sql->bindParam('quantity', $_GET["quantity"]);
            $sql->bindParam('weight', $_GET["weight"]);
            $sql->bindParam('price', $_GET["price"]);
            $sql->bindParam('cid', $_GET["cid"]);
            $sql->bindParam('pbid', $_GET["bid"]);
            $sql->bindParam('notes', $_GET["notes"]);
            $sql->execute();
            echo "edited";
            break;
    }
}
