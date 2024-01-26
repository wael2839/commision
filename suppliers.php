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
                        <th>رقم المورد</th>
                        <th>اسم المورد</th>
                        <th>رقم الجوال</th>
                        <th>العنوان</th>
                        <th>تاريخ الانضمام</th>
                        <th>ملاحظة</th>
                        <th>تعديل</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    <?php
                    include_once "includes/conn.php";
                    if ($conn) {
                        $sql = mysqli_query($conn, 'SELECT * FROM `farmer`;');
                        if (mysqli_num_rows($sql) > 0) {
                            while ($data = mysqli_fetch_assoc($sql)) {
                    ?>
                                <tr>
                                    <td><?php echo $data["f_id"]; ?></td>
                                    <td><?php echo $data["f_name"]; ?></td>
                                    <td><?php echo $data["f_phone"]; ?></td>
                                    <td><?php echo $data["f_address"]; ?></td>
                                    <td><?php echo $data["f_date"]; ?></td>
                                    <td><?php echo $data["f_note"]; ?></td>
                                    <td class="flex-c">
                                        <div class="edit" data-id="<?php echo $data["f_id"]; ?>" data-name="<?php echo $data["f_name"]; ?>" data-phone="<?php echo $data["f_phone"]; ?>" data-address="<?php echo $data["f_address"]; ?>" data-date="<?php echo $data["f_date"]; ?>" data-note="<?php echo $data["f_note"]; ?>">
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
            <div id="btn-dialog-add" class="btn">إضافة مورد <i class="fa-solid fa-plus"></i></div>
            <div class="input-box">
                <input type="text" id="search" name="search" autofocus placeholder="بحث...">
            </div>
            <a href="suppliers.php" class="btn btn-square">
                <i class="fa-solid fa-refresh"></i>
            </a>

        </div>
    </div>

    <div class="dialog flex-c p25" id="dialog_add">
        <div class="box flex-b g15 r15 p20">
            <h2>إضافة مورد جديد</h2>
            <div class="input-box">
                <input type="text" name="fname" id="fname" required tabindex="1" autofocus>
                <label for="fname">اسم المورد:</label>
            </div>
            <div class="input-box">
                <input type="number" name="fphone" id="fphone" required tabindex="2" autofocus>
                <label for="fphone">رقم الجوال :</label>
            </div>
            <div class="input-box">
                <input type="text" name="faddress" id="faddress" required tabindex="3" autofocus>
                <label for="faddress">العنوان :</label>
            </div>
            <div class="input-box" >
                <input type="date" value="<?php $current_date = date_create();echo date_format($current_date, 'Y-m-d');?>" name="fdate" id="fdate"  required tabindex="4" autofocus>
                <label id="date" for="fdate">تاريخ الانضمام :</label>
            </div>
            <div class="input-box" style="width: 580px;">
                <input style="width: 580px;" type="text" name="fnote" id="fnote" required tabindex="5" autofocus>
                <label  for="fnote">ملاحظة:</label>
                
            </div>
            <div id="btn-add" class="btn" tabindex="6">إضافة المورد <i class="fa-solid fa-plus"></i></div>
            <div id="btn-close-add" class="btn btn-red">إلغاء العملية <i class="fa-solid fa-close"></i></div>
        </div>
    </div>

    <div class="dialog flex-c p25" id="dialog_edit">
        <div class="box flex-b p20 r15 g20">
            <h2>تعديل بيانات مورد</h2>
            <div class="input-box">
                <input type="text" name="fname_2" id="fname_2" required tabindex="7" autofocus>
                <label for="fname_2">اسم المورد:</label>
            </div>
            <div class="input-box">
                <input type="number" name="fphone_2" id="fphone_2" required tabindex="8" autofocus>
                <label for="fphone_2">رقم الجوال :</label>
            </div>
            <div class="input-box">
                <input type="text" name="faddress_2" id="faddress_2" required tabindex="9" autofocus>
                <label for="faddress_2">العنوان :</label>
            </div>
            <div class="input-box" >
                <input type="date" value="2024-01-01" name="fdate_2" id="fdate_2"  required tabindex="10" autofocus>
                <label id="date" for="fdate_2">تاريخ الانضمام :</label>
            </div>
            <div class="input-box" style="width: 580px;">
                <input style="width: 580px;" type="text" name="fnote_2" id="fnote_2" required tabindex="11" autofocus>
                <label  for="fnote_2">ملاحظة:</label>
                
            </div>
            <div id="btn-edit" class="btn" tabindex="12">حفظ بيانات المورد  <i class="fa-solid fa-plus"></i></div>
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
    <script src="scripts/ajax_splr.js"></script>
</body>

</html>