<!DOCTYPE html>
<html>

<head>
    <?php include_once "includes/head.php"; ?>
</head>

<body>
    <?php include_once "includes/sider.php"; ?>

    <div class="container wid">
        <?php include_once "includes/header.php"; ?>
        <div class="table">
            <table>
                <thead>
                    <tr>
                        <th>رقم المنتج</th>
                        <th>اسم المنتج</th>
                        <th>قيمة العمولة</th>
                        <th>تعديل</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    <?php
                    include_once "includes/conn.php";
                    if($conn){
                        $sql = mysqli_query($conn, 'SELECT * FROM `product`;');
                        if(mysqli_num_rows($sql) > 0){
                            while($data = mysqli_fetch_assoc($sql)){
                                ?>
                    <tr>
                        <td><?php echo $data["p_id"]; ?></td>
                        <td><?php echo $data["p_name"]; ?></td>
                        <td><?php echo (($data["p_comm"])*100);echo "% " ?></td>
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
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="settings flex-b p10">
            <div id="btn-dialog-add" class="btn">إضافة منتج <i class="fa-solid fa-plus"></i></div>
            <div class="input-box">
            <input type="text" id="search" name="search" autofocus placeholder="بحث...">
            </div>
            <a href="products.php" class="btn btn-square">
                <i class="fa-solid fa-refresh"></i>
            </a>
           
        </div>
    </div>

    <div class="dialog flex-c p25" id="dialog_add">
        <div class="box flex-b g15 r20 p20">
            <h2>إضافة منتج جديد</h2>
            <div class="input-box">
                <input type="text" name="pname" id="pname" required tabindex="1" autofocus>
                <label for="pname">اسم المنتج:</label>
            </div>
            <div class="input-box">
                <input type="number" min="0" max="1" step="0.05" name="pcomm" id="pcomm" required tabindex="2">
                <label for="pcomm">عمولة البيع:</label>
            </div>
            <div id="btn-add" class="btn" tabindex="3">إضافة المنتج <i class="fa-solid fa-plus"></i></div>
            <div id="btn-close-add" class="btn btn-red">إلغاء العملية <i class="fa-solid fa-close"></i></div>
        </div>
    </div>

    <div class="dialog flex-c p25" id="dialog_edit">
        <div class="box flex-b p20 r15 g20">
            <h2>تعديل منتج</h2>
            <div class="input-box">
                <input type="text" name="pname_2" id="pname_2" required tabindex="4" autofocus>
                <label for="pname_2">اسم المنتج:</label>
            </div>
            <div class="input-box">
                <input type="number" min="0" max="1" step="0.05" name="pcomm_2" id="pcomm_2" required tabindex="5">
                <label for="pcomm_2">عمولة البيع:</label>
            </div>
            <div id="btn-edit" class="btn" tabindex="6">حفظ المنتج <i class="fa-solid fa-edit"></i></div>
            <div id="btn-close-edit" class="btn btn-red">إلغاء العملية <i class="fa-solid fa-close"></i></div>
        </div>
    </div>

    <div class="dialog flex-c p25" id="dialog_success">
        <div class="box p25 r15 flex-v">
            <h2>تم تنفيذ العملية بنجاح</h2>
            <div id="btn-close-sec" class="btn">إغلاق <i class="fa-solid fa-close"></i></div>
        </div>
    </div>


    <?php include_once "includes/footer.php"; ?>
    <script src="scripts/ajax_prod.js"></script>
</body>

</html>