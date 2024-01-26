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
                        <th>رقم الاستلام</th>
                        <th>تاريخ الاستلام</th>
                        <th>اسم المورد</th>
                        <th>اسم المنتج</th>
                        <th>الكمية</th>
                        <th>ملاحظة</th>
                        <th>تعديل</th>
                        <th>حذف</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    <?php
                    include_once "includes/conn.php";
                    if ($conn) {
                        $sql = mysqli_query($conn, 'SELECT r_id,r_date,f_name,p_name,quantity,notes FROM receive,farmer,product WHERE r_id =r_id AND receive.f_id =farmer.f_id AND receive.p_id=product.p_id ORDER BY r_id');
                        if (mysqli_num_rows($sql) > 0) {
                            while ($data = mysqli_fetch_assoc($sql)) {
                    ?>
                                <tr>
                                    <td><?php echo $data["r_id"]; ?></td>
                                    <td><?php echo $data["r_date"]; ?></td>
                                    <td><?php echo $data["f_name"]; ?></td>
                                    <td><?php echo $data["p_name"]; ?></td>
                                    <td><?php echo $data["quantity"]; ?></td>
                                    <td><?php echo $data["notes"]; ?></td>
                                    <td class="flex-c">
                                        <div class="edit" data-id="<?php echo $data["r_id"]; ?>" data-date="<?php echo $data["r_date"]; ?>" 
                                        data-fname="<?php echo $data["f_name"]; ?>" data-pname="<?php echo $data["p_name"]; ?>" 
                                        data-quantity="<?php echo $data["quantity"];?>" data-notes="<?php echo $data["notes"]; ?>"
                                        data-fid="<?php echo $data["f_id"];?>"data-pid="<?php echo $data["p_id"];?>">
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
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="settings flex-b p10">
            <div id="btn-dialog-add" class="btn">إستلام جديد <i class="fa-solid fa-plus"></i></div>
            <div class="input-box">
                <input type="text" id="search" name="search" autofocus placeholder="بحث...">
         
            </div>
            <a href="resevies.php" class="btn btn-square">
                <i class="fa-solid fa-refresh"></i>
            </a>

        </div>
    </div>

    <div class="dialog flex-c p25" id="dialog_add">
        <div class="box flex-b g15 r15 p20">
            <h2>إضافة إستلام جديد</h2>
            <div class="input-box">
                <input type="date"  value="<?php $current_date = date_create();echo date_format($current_date, 'Y-m-d');?>" name="rdate" id="rdate" required tabindex="1" autofocus>
                <label for="rdate">التاريخ:</label>
            </div>
            <div class="input-box">

                <input list="farmerList" type="text" name="fid" id="fid" required tabindex="2" autofocus>
                <datalist name="farmerList" id="farmerList">

                    <?php
                    include_once "includes/conn.php";
                    if ($conn) {
                        $sql = mysqli_query($conn, 'SELECT f_id, f_name FROM farmer');
                        if (mysqli_num_rows($sql) > 0) {
                            while ($data = mysqli_fetch_assoc($sql)) {
                    ?>

                                <option data-value="<?php echo $data["f_id"]; ?>" value="<?php echo $data["f_name"]; ?>"></option>
                    <?php
                            }
                        }
                    }
                    ?></option>

                </datalist>
                <label for="fid">اسم المورد :</label>
            </div>
            <div class="input-box">
                <input list="productList" type="text" name="pid" id="pid" required tabindex="3" autofocus>
                <datalist name="productsList" id="productList">
                    <?php
                    include_once "includes/conn.php";
                    if ($conn) {
                        $sql = mysqli_query($conn, 'SELECT p_id ,p_name FROM product');
                        if (mysqli_num_rows($sql) > 0) {
                            while ($data = mysqli_fetch_assoc($sql)) {
                    ?>

                                <option data-value="<?php echo $data["p_id"]; ?>" value="<?php echo $data["p_name"]; ?>"></option>
                    <?php
                            }
                        }
                    }
                    ?></option>

                </datalist>
                <label for="pid">اسم المنتج:</label>
            </div>
            <div class="input-box">
                <input type="number" name="quantity" id="quantity" required tabindex="4" autofocus>
                <label for="quantity"> الكمية :</label>
            </div>

            <div class="input-box" style="width: 580px;">
                <input style="width: 580px;" step="1" type="text" name="notes" id="notes" required tabindex="5" autofocus>
                <label for="notes">ملاحظة:</label>

            </div>
            <div id="btn-add" class="btn" tabindex="6">إضافة الاستلام <i class="fa-solid fa-plus"></i></div>
            <div id="btn-close-add" class="btn btn-red">إلغاء العملية <i class="fa-solid fa-close"></i></div>
        </div>
    </div>

    <div class="dialog flex-c p25" id="dialog_edit">
        <div class="box flex-b p20 r15 g20">
            <h2>تعديل بيانات استلام</h2>
            <div class="input-box">
                <input type="date"  name="rdate_2" id="rdate_2" required tabindex="7" autofocus>
                <label for="rdate_2">التاريخ:</label>
            </div>
            <div class="input-box">

                <input list="farmerList2" type="text" name="fname_2" id="fname_2" required tabindex="8" autofocus>
                <datalist name="farmerList2" id="farmerList2" oninput="searchProducts()">

                    <?php
                    include_once "includes/conn.php";
                    if ($conn) {
                        $sql = mysqli_query($conn, 'SELECT f_id, f_name FROM farmer');
                        if (mysqli_num_rows($sql) > 0) {
                            while ($data = mysqli_fetch_assoc($sql)) {
                    ?>

                                <option data-value="<?php echo $data["f_id"]; ?>" value="<?php echo $data["f_name"]; ?>"></option>
                    <?php
                            }
                        }
                    }
                    ?></option>

                </datalist>
                <label for="fname_2">اسم المورد :</label>
            </div>
            <div class="input-box">
                <input list="productList2" type="text" name="pname_2" id="pname_2" required tabindex="9" autofocus>
                <datalist name="productsList2" id="productList2">
                    <?php
                    include_once "includes/conn.php";
                    if ($conn) {
                        $sql = mysqli_query($conn, 'SELECT p_id ,p_name FROM product');
                        if (mysqli_num_rows($sql) > 0) {
                            while ($data = mysqli_fetch_assoc($sql)) {
                    ?>

                                <option data-value="<?php echo $data["p_id"]; ?>" value="<?php echo $data["p_name"]; ?>"></option>
                    <?php
                            }
                        }
                    }
                    ?></option>

                </datalist>
                <label for="pname_2">اسم المنتج:</label>
            </div>
            <div class="input-box">
                <input type="number" name="quantity_2" id="quantity_2" required tabindex="10" autofocus>
                <label for="quantity_2"> الكمية :</label>
            </div>
            
            <div class="input-box" style="width: 580px;">
                <input style="width: 580px;" step="1" type="text" name="notes_2" id="notes_2" required tabindex="11" autofocus>
                <label for="notes_2">ملاحظة:</label>

            </div>
            <div id="btn-edit" class="btn" tabindex="12">حفظ بيانات الاستلام <i class="fa-solid fa-plus"></i></div>
            <div id="btn-close-edit" class="btn btn-red">إلغاء العملية <i class="fa-solid fa-close"></i></div>
        </div>
    </div>

    <div class="dialog flex-c p25" id="dialog_delet">
        <div class="box flex-b p20 r15 g20">
            <h2>حذف  استلام</h2>
            <div class="input-box1">
                <input  type="number"  name="rid" id="rid" required tabindex="13" autofocus disabled>
                <label for="rdate_3">الرقم:</label>
            </div>
            <div class="input-box1">
                <input  type="date" value="2024-01-01" name="rdate_3" id="rdate_3" required tabindex="14" autofocus disabled>
                <label for="rdate_3">التاريخ:</label>
            </div>
            <div class="input-box1">

                <input   type="text" name="fname_3" id="fname_3" required tabindex="15" autofocus disabled>
                
                <label for="fname_3">اسم المورد :</label>
            </div>
            <div class="input-box1">
                <input   type="text" name="pname_3" id="pname_3" required tabindex="16" autofocus disabled>
                <label for="pname_3">اسم المنتج:</label>
            </div>
            <div class="input-box1">
                <input  type="text" name="quantity_3" id="quantity_3" required tabindex="17" autofocus disabled>
                <label for="quantity_3"> الكمية :</label>
            </div>
            
            <div class="input-box1" >
                <input   step="1" type="text" name="notes_3" id="notes_3" required tabindex="18" autofocus disabled>
                <label for="notes_3">ملاحظة:</label>

            </div>
            <div id="btn-delet" class="btn" tabindex="19">تاكيد الحذف <i class="fa-solid fa-plus"></i></div>
            <div id="btn-close-delet" class="btn btn-red">إلغاء العملية <i class="fa-solid fa-close"></i></div>
        </div>
    </div>

    <div class="dialog flex-c p25" id="dialog_success">
        <div class="box p25 r15 flex-v">
            <h2>تم تنفيذ العملية بنجاح</h2>
            <div id="btn-close-sec" class="btn">إغلاق <i class="fa-solid fa-close"></i></div>
        </div>
    </div>


    <?php include_once "includes/footer.php"; ?>
    <script src="scripts/ajax_resv.js"></script>
</body>

</html>