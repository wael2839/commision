<?php 
    include_once "includes/conn.php";
    if($conp){
        switch ($_GET["t"]){
            case "receive": 
            $sql = $conp->prepare('DELETE FROM `receive` WHERE r_id = :id');
            $sql->bindParam('id', $_GET["id"]);
            $sql->execute();
            echo "deleted";
            break;
        case "sale": 
            $sql = $conp->prepare('DELETE FROM `sale` WHERE s_id = :id');
            $sql->bindParam('id', $_GET["id"]);
            $sql->execute();
            echo "deleted";
            break;
        case "pay_bill": 
            $sql1 = $conp->prepare('UPDATE `sale` SET pb_id = 0  WHERE pb_id = :old_bill_id');
            $sql1->bindParam('old_bill_id', $_GET["id"]);
            $sql1->execute();
            $sql = $conp->prepare('DELETE FROM `pay_bill` WHERE pb_id = :id');
            $sql->bindParam('id', $_GET["id"]);
            $sql->execute();
            echo "deleted";
            break;
        }
    }
?>