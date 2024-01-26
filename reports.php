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
                        <th>رقم الفاتورة</th>
                        <th>تاريخ الفاتورة</th>
                        <th>اسم المورد</th>
                        <th> اجمالي الفاتورة</th>
                        <th>ملاحظة</th>
                        <th>معاينة</th>
                        <th>حذف</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    <?php
                    include_once "includes/conn.php";
                    if ($conn) {
                        $sql = mysqli_query($conn, 'SELECT DISTINCT pay_bill.pb_id,pb_date,f_name,pb_note FROM pay_bill,farmer,sale WHERE pay_bill.pb_id=sale.pb_id AND sale.f_id=farmer.f_id AND pay_bill.pb_id >=1 ORDER BY pb_id;');
                        if (mysqli_num_rows($sql) > 0) {
                            while ($data = mysqli_fetch_assoc($sql)) {
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
                    }
                    ?>
                </tbody>

            </table>
        </div>
        <div class="settings flex-b p10">
            <div id="btn-dialog-add" class="btn">فاتورة جديدة <i class="fa-solid fa-plus"></i></div>
            <div class="input-box">
                <input type="text" id="search" name="search" autofocus placeholder="بحث...">
            </div>
            <a href="reports.php" class="btn btn-square">
                <i class="fa-solid fa-refresh"></i>
            </a>
        </div>
    </div>

    <div class="dialog flex-c p25" id="dialog_view">
    <div class="box1 flex-b g15 r15 p20" id="box1">
                <h2 id="bill_num"  style="text-align: center; width:100%;font-size: larger; color:var(--main); margin-bottom: 10px;">
                
                </h2>
                <div class="input-box">
                    <input type="text"  name="rdate1" id="rdate1" required tabindex="1" autofocus>
                    <label for="rdate1" id="lbl-rdate1">التاريخ:</label>
                </div>
                <div class="input-box">
                    <input list="farmerList1" type="text" name="fid1" id="fid1" required tabindex="2" autofocus oninput="selectsupplier()">
                    <datalist name="farmerList1" id="farmerList1">

                        <?php
                        include_once "includes/conn.php";
                        if ($conn) {
                            $sql = mysqli_query($conn, 'SELECT f_id, f_name, f_phone, f_address FROM farmer');
                            if (mysqli_num_rows($sql) > 0) {
                                while ($data = mysqli_fetch_assoc($sql)) {
                        ?>
                            <option data-value="<?php echo $data["f_id"]; ?>" data-fadd="<?php echo $data['f_address'] ?>" data-fphone="<?php echo $data['f_phone'] ?>" value="<?php echo $data["f_name"]; ?>">
                            </option>
                        <?php
                                }
                            }
                        }
                        ?></option>

                    </datalist>
                    <label for="fid1" id="lbl-fid1">اسم المورد :</label>
                </div>
                <div class="input-box">
                    <input type="text" name="fphone1" id="fphone1" value="" required tabindex="3" autofocus>
                    <label for="fphone1" id="lbl-fphone1">رقم الجوال:</label>
                </div>
                <div class="input-box">
                    <input type="text" name="faddress1" id="faddress1" required tabindex="4" autofocus>
                    <label for="faddress1" id="lbl-faddress1"> العنوان :</label>
                </div>

                <div class="input-box" style="width: 600px;">
                    <input style="width: 600px;" step="1" type="text" name="notes2" id="notes2" required tabindex="5" autofocus>
                    <label for="notes2" id="lbl-notes2">ملاحظة:</label>

                </div>
                <hr>
                <!-- bill information -->
                <div class="table1 table">
                    <table>
                        <thead>
                            <tr>
                                <th>رقم البيع</th>
                                <th>تاريخ البيع</th>
                                <th>المنتج </th>
                                <th> الكمية </th>
                                <th>الوزن</th>
                                <th>السعر</th>
                                <th>الاجمالي</th>

                            </tr>
                        </thead>
                        <tbody id="tbody2">
                            
                        </tbody>
                        
                        <tfoot>
                        
                        </tfoot>
                        
                    </table>
                </div>
                <!-- end information -->
                <hr>
                <div class="settings flex-b p10">
                    <div id="btn-dialog-view" class="btn" onclick="printDiv1('box1');">طباعة <i class="fa-solid fa-plus"></i></div>
                    <div id="btn-close-view" class="btn btn-red">إغلاق <i class="fa-solid fa-close"></i></div>
                </div>
            </div>
        
    </div>
    <div id="print">
        <div class="dialog flex-c p25" id="dialog_add">
            <div class="box1 flex-b g15 r15 p20" id="box2">
                <h2 style="text-align: center; width:100%; color:var(--main); margin-bottom: 10px;">
                <?php
                        include_once "includes/conn.php";
                        $new_bill_id = 0;
                        if ($conn) {
                            $sql = mysqli_query($conn, 'SELECT pb_id FROM pay_bill order by pb_id desc limit 1');
                            if (mysqli_num_rows($sql) > 0) {
                                $data = mysqli_fetch_assoc($sql);
                                echo 'فاتورة ( ' . ($data["pb_id"] + 1) . ' )';
                                $new_bill_id = $data["pb_id"] + 1;
                            }
                        }
                        ?>
                </h2>
                <div class="input-box">
                    <input type="date" value="<?php $current_date = date_create();
                                                echo date_format($current_date, 'Y-m-d'); ?>" name="rdate" id="rdate" required tabindex="1" autofocus>
                    <label for="rdate">التاريخ:</label>
                </div>
                <div class="input-box">
                    <input list="farmerList" type="text" name="fid" id="fid" required tabindex="2" autofocus oninput="selectsupplier()">
                    <datalist name="farmerList" id="farmerList">

                        <?php
                        include_once "includes/conn.php";
                        if ($conn) {
                            $sql = mysqli_query($conn, 'SELECT f_id, f_name, f_phone, f_address FROM farmer');
                            if (mysqli_num_rows($sql) > 0) {
                                while ($data = mysqli_fetch_assoc($sql)) {
                        ?>
                            <option data-value="<?php echo $data["f_id"]; ?>" data-fadd="<?php echo $data['f_address'] ?>" data-fphone="<?php echo $data['f_phone'] ?>" value="<?php echo $data["f_name"]; ?>">
                            </option>
                        <?php
                                }
                            }
                        }
                        ?></option>

                    </datalist>
                    <label for="fid" id="lbl-fid">اسم المورد :</label>
                </div>
                <div class="input-box">
                    <input type="text" name="fphone" id="fphone" value="" required tabindex="3" autofocus>
                    <label for="fphone" id="lbl-fphone">رقم الجوال:</label>
                </div>
                <div class="input-box">
                    <input type="text" name="faddress" id="faddress" required tabindex="4" autofocus>
                    <label for="faddress" id="lbl-faddress"> العنوان :</label>
                </div>

                <div class="input-box" style="width: 600px;">
                    <input style="width: 600px;" step="1" type="text" name="notes1" id="notes1" required tabindex="5" autofocus>
                    <label for="notes1" id="lbl-notes1">ملاحظة:</label>

                </div>
                <hr>
                <!-- bill information -->
                <div class="table1 table">
                    <table>
                        <thead>
                            <tr>
                                <th>رقم البيع</th>
                                <th>تاريخ البيع</th>
                                <th>المنتج </th>
                                <th> الكمية </th>
                                <th>الوزن</th>
                                <th>السعر</th>
                                <th>الاجمالي</th>

                            </tr>
                        </thead>
                        <tbody id="tbody1">
                            <?php
                            include_once "includes/conn.php";
                            if ($conn) {
                                $sql = mysqli_query($conn, 'SELECT s_id,s_date,p_comm,p_name,s_quantity,s_weight,s_price FROM farmer,sale,product WHERE sale.f_id=farmer.f_id AND sale.p_id=product.p_id AND sale.pb_id="0"');
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
                                            <td> <?php echo number_format(round($data["s_weight"] * $data["s_price"],1)) ?></td>
                                        </tr>
                            <?php
                                    }}}
                            ?>
                        </tbody >
                       
                    </table>
                </div>
                <!-- end information -->
                <hr>
                <div class="settings flex-b p10">
                    <div id="btn-dialog-add" class="btn" onclick="printDiv();">طباعة <i class="fa-solid fa-plus"></i></div>
                    <div id="btn-add" class="btn" tabindex="6" data-bill-id="<?php echo $new_bill_id; ?>">حفظ الفاتورة  <i class="fa-solid fa-check"></i></div>
                    <div id="btn-close-add" class="btn btn-red">إغلاق  <i class="fa-solid fa-close"></i></div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="dialog flex-c p25" id="dialog_delet">
        <div class="box flex-b p20 r15 g20">
            <h2> تأكيد حذف الفاتورة رقم </h2>
            
                <h3 id="bill-id" style="width: 100%; font-size:44px; color: var(--wrong); text-align: center;"></h3>
            
            
            <div id="btn-delet" class="btn" tabindex="19">تاكيد الحذف <i class="fa-solid fa-plus"></i></div>
            <div id="btn-close-delet" class="btn btn-red">إلغاء العملية <i class="fa-solid fa-close"></i></div>
        </div>
    </div>
      <div class="dialog flex-c p25" id="dialog_edit"><div id="btn-close-edit" class="btn btn-red">إلغاء العملية <i class="fa-solid fa-close"></i></div></div>
      
    <div class="dialog flex-c p25" id="dialog_success">
        <div class="box p25 r15 flex-v">
            <h2>تم تنفيذ العملية بنجاح</h2>
            <div id="btn-close-sec" class="btn">إغلاق <i class="fa-solid fa-close"></i></div>
        </div>
    </div>


    <?php include_once "includes/footer.php"; ?>
    <script src="scripts/ajax_rprt.js"></script>
</body>

</html>