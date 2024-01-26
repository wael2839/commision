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
                        <th>رقم الزبون</th>
                        <th>اسم الزبون</th>
                        <th>رقم الجوال</th>
                        <th>تاريخ الانضمام</th>
                        <th>ملاحظة</th>
                        <th>تعديل</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    <?php
                    include_once "includes/conn.php";
                    if ($conn) {
                        $sql = mysqli_query($conn, 'SELECT * FROM `customer`;');
                        if (mysqli_num_rows($sql) > 0) {
                            while ($data = mysqli_fetch_assoc($sql)) {
                    ?>
                                <tr>
                                    <td><?php echo $data["c_id"]; ?></td>
                                    <td><?php echo $data["c_name"]; ?></td>
                                    <td><?php echo $data["c_phone"]; ?></td>
                                    <td><?php echo $data["c_date"]; ?></td>
                                    <td><?php echo $data["c_note"]; ?></td>
                                    <td class="flex-c">
                                        <div class="edit" data-id="<?php echo $data["c_id"]; ?>" data-name="<?php echo $data["c_name"]; ?>" data-phone="<?php echo $data["c_phone"]; ?>" data-date="<?php echo $data["c_date"]; ?>" data-note="<?php echo $data["c_note"]; ?>">
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
            <div id="btn-dialog-add" class="btn">إضافة الزبون <i class="fa-solid fa-plus"></i></div>
            <div class="input-box">
                <input type="text" id="search" name="search" autofocus placeholder="بحث...">
            </div>
            <a href="customers.php" class="btn btn-square">
                <i class="fa-solid fa-refresh"></i>
            </a>

        </div>
    </div>

    <div class="dialog flex-c p25" id="dialog_add">
        <div class="box flex-b g15 r15 p20">
            <h2>إضافة زبون جديد</h2>
            <div class="input-box">
                <input type="text" name="cname" id="cname" required tabindex="1" autofocus>
                <label for="cname">اسم الزبون:</label>
            </div>
            <div class="input-box">
                <input type="number" name="cphone" id="cphone" required tabindex="2" autofocus>
                <label for="cphone">رقم الجوال :</label>
            </div>
            <div class="input-box" >
                <input type="date" value="<?php $current_date = date_create();echo date_format($current_date, 'Y-m-d');?>" name="cdate" id="cdate"  required tabindex="3
                " autofocus>
                <label id="date" for="cdate">تاريخ الانضمام :</label>
            </div>
            <div class="input-box">
                <input  type="text" name="cnote" id="cnote" required tabindex="4" autofocus>
                <label  for="cnote">ملاحظة:</label>
                
            </div>
            <div id="btn-add" class="btn" tabindex="5">إضافة زبون <i class="fa-solid fa-plus"></i></div>
            <div id="btn-close-add" class="btn btn-red">إلغاء العملية <i class="fa-solid fa-close"></i></div>
        </div>
    </div>

    <div class="dialog flex-c p25" id="dialog_edit">
        <div class="box flex-b p20 r15 g20">
            <h2>تعديل بيانات زبون</h2>
            <div class="input-box">
                <input type="text" name="cname_2" id="cname_2" required tabindex="6" autofocus>
                <label for="cname_2">اسم الزبون:</label>
            </div>
            <div class="input-box">
                <input type="number" name="cphone_2" id="cphone_2" required tabindex="7" autofocus>
                <label for="cphone_2">رقم الجوال :</label>
            </div>
            <div class="input-box" >
                <input type="date" value="2024-01-01" name="cdate_2" id="cdate_2"  required tabindex="8" autofocus>
                <label id="date" for="cdate_2">تاريخ الانضمام :</label>
            </div>
            <div class="input-box" >
                <input  type="text" name="cnote_2" id="cnote_2" required tabindex="9" autofocus>
                <label  for="cnote_2">ملاحظة:</label>
                
            </div>
            <div id="btn-edit" class="btn" tabindex="10">حفظ بيانات الزبون  <i class="fa-solid fa-plus"></i></div>
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
    <script src="scripts/ajax_cusmr.js"></script>
</body>

</html>