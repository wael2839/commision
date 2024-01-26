<!DOCTYPE html>
<html>

<head>
    <?php include_once "includes/head.php"; ?>
</head>

<body>
    <?php include_once "includes/sider.php"; ?>
<!-- for import data  -->
    <div class="container wid">
        <?php include_once "includes/header.php"; ?>
        <div id="table" class="table">
            <table >
                <thead>
                    <tr>
                        <th>رقم البيع</th>
                        <th>تاريخ البيع</th>
                        <th> المورد</th>
                        <th> المنتج</th>
                        <th>الكمية</th>
                        <th> الوزن بالكيلو</th>
                        <th>السعر</th>
                        <th> الاجمالي</th>
                        <th> العمولة</th>
                        <th> الزبون</th>
                        <th>ملاحظة</th>
                        <th>فاتورة الدفع</th>
                        <th>تعديل</th>
                        <th>حذف</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    <?php
                    include_once "includes/conn.php";
                    if ($conn) {
                        $sql = mysqli_query($conn, 'SELECT s_id,s_date,f_name,p_name,p_comm,s_quantity,s_weight,s_price,c_name,pb_id,s_notes FROM sale,farmer,product,customer WHERE s_id =s_id AND sale.f_id=farmer.f_id AND sale.p_id=product.p_id AND sale.c_id=customer.c_id ORDER BY s_id');
                        
                        if (mysqli_num_rows($sql) > 0) {
                            while ($data = mysqli_fetch_assoc($sql)) {
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
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="settings flex-b p10">
            <div id="btn-dialog-add" class="btn">بيع جديد <i class="fa-solid fa-plus"></i></div>
            <div class="input-box">
                <input type="text" id="search" name="search" autofocus placeholder="بحث...">
         
            </div>
            <a href="sales.php" class="btn btn-square">
                <i class="fa-solid fa-refresh"></i>
            </a>

        </div>
    </div>

    <!-- for add sale -->
    <div class="dialog flex-c p25" id="dialog_add">
        <div class="box flex-b g15 r15 p20">
            <h2>إضافة بيع جديد</h2>

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
                <input type="date"  value="<?php $current_date = date_create();echo date_format($current_date, 'Y-m-d');?>" name="sdate" id="sdate" required tabindex="1" autofocus>
                <label for="sdate">التاريخ:</label>
            </div>
            
            <div class="input-box">
                <input list="productList" type="text" name="pid" id="pid" required tabindex="3" autofocus oninput="calculateTotal()" >
                <datalist name="productsList" id="productList">
                    <?php
                    include_once "includes/conn.php";
                    if ($conn) {
                        $sql = mysqli_query($conn, 'SELECT p_id ,p_name,p_comm FROM product');
                        if (mysqli_num_rows($sql) > 0) {
                            while ($data = mysqli_fetch_assoc($sql)) {
                    ?>

                                <option data-comm="<?php echo $data["p_comm"]; ?>" data-value="<?php echo $data["p_id"]; ?>" value="<?php echo $data["p_name"]; ?>"></option>
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
            <div class="input-box">
                <input type="number"  name="weight" id="weight" required tabindex="4" autofocus oninput="calculateTotal()">
                <label for="weight">  الوزن بالكيلو :</label>
            </div>
            <div class="input-box1">
                <input step="0.001" type="number" name="price" id="price" required tabindex="4" autofocus oninput="calculateTotal()">
                <label for="price">  سعر الكيلو :</label>
            </div>
            <div class="input-box1">
                <input type="number" step="0.01" round  value="" name="total" id="total" required tabindex="4" autofocus oninput="calculateprice()">
                <label for="total"> الاجمالي :</label>
            </div>
            <div class="input-box1">
                <input type="number" step="0.01" round name="comm" id="comm" required tabindex="4" autofocus readonly>
                <label for="comm"> العمولة :</label>
            </div>
            <div class="input-box">
                <input list="customertList" value="زبون عام" type="text" name="cid" id="cid" required tabindex="3" autofocus>
                <datalist name="customertList" id="customertList">
                    <?php
                    include_once "includes/conn.php";
                    if ($conn) {
                        $sql = mysqli_query($conn, 'SELECT c_id ,c_name FROM customer');
                        if (mysqli_num_rows($sql) > 0) {
                            while ($data = mysqli_fetch_assoc($sql)) {
                    ?>

                                <option data-value="<?php echo $data["c_id"]; ?>" value="<?php echo $data["c_name"]; ?>"></option>
                    <?php
                            }
                        }
                    }
                    ?></option>

                </datalist>
                <label for="cid">اسم الزبون:</label>
            </div>
            <div class="input-box">
                <input  type="text" name="notes" id="notes" required tabindex="5" autofocus>
                <label for="notes">ملاحظة:</label>

            </div>
           <?php  ?>
           

            <div id="btn-add" class="btn" tabindex="6">تاكيد البيع <i class="fa-solid fa-plus"></i></div>
            <div id="btn-close-add" class="btn btn-red">إلغاء العملية <i class="fa-solid fa-close"></i></div>
        </div>
    </div>

    <!-- for edit sale -->
    <div class="dialog flex-c p25" id="dialog_edit">
        <div class="box flex-b p20 r15 g20">
            <h2>تعديل بيانات بيع</h2>
            <div class="input-box">
                <input type="date"  name="sdate_2" id="sdate_2" required tabindex="1" autofocus>
                <label for="sdate_2">التاريخ:</label>
            </div>
            <div class="input-box">

                <input list="farmerList2" type="text" name="fid_2" id="fid_2" required tabindex="2" autofocus>
                <datalist name="farmerList2" id="farmerList2">

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
                <label for="fid_2">اسم المورد :</label>
            </div>
            <div class="input-box">
                <input list="productList2" type="text" name="pid_2" id="pid_2" required tabindex="3" autofocus   oninput="calculateTotalEdit() ">
                <datalist name="productList2" id="productList2">
                    <?php
                    include_once "includes/conn.php";
                    if ($conn) {
                        $sql = mysqli_query($conn, 'SELECT p_id ,p_name,p_comm FROM product');
                        if (mysqli_num_rows($sql) > 0) {
                            while ($data = mysqli_fetch_assoc($sql)) {
                    ?>

                                <option data-comm="<?php echo $data["p_comm"]; ?>" data-value="<?php echo $data["p_id"]; ?>" value="<?php echo $data["p_name"]; ?>"></option>
                    <?php
                            }
                        }
                    }
                    ?></option>

                </datalist>
                <label for="pid_2">اسم المنتج:</label>
            </div>
            <div class="input-box">
                <input type="number" name="quantity_2" id="quantity_2" required tabindex="4" autofocus>
                <label for="quantity_2"> الكمية :</label>
            </div>
            <div class="input-box">
                <input type="number"  name="weight_2" id="weight_2" step="0.001" required tabindex="4" autofocus   oninput="calculateTotalEdit() ">
                <label for="weight_2">  الوزن بالكيلو :</label>
            </div>
            <div class="input-box">
                <input type="number" name="price_2" id="price_2" step="0.001" required tabindex="4" autofocus  oninput="calculateTotalEdit() ">
                <label for="price_2">  سعر الكيلو :</label>
            </div>
            <div class="input-box1">
                <input type="number"  value="" name="total_2" id="total_2" required tabindex="4" step="0.001" autofocus oninput="calculatepriceforedit()">
                <label for="total_2"> الاجمالي :</label>
            </div>
            <div class="input-box1">
                <input type="number" name="comm_2" id="comm_2"  required tabindex="4" autofocus readonly>
                <label for="comm_2"> العمولة :</label>
            </div>
            <div class="input-box">
                <input list="customertList2" value="" type="text" name="cid_2" id="cid_2" required tabindex="3" autofocus>
                <datalist name="customertList2" id="customertList2">
                    <?php
                    include_once "includes/conn.php";
                    if ($conn) {
                        $sql = mysqli_query($conn, 'SELECT c_id ,c_name FROM customer');
                        if (mysqli_num_rows($sql) > 0) {
                            while ($data = mysqli_fetch_assoc($sql)) {
                    ?>

                                <option data-value="<?php echo $data["c_id"]; ?>" value="<?php echo $data["c_name"]; ?>"></option>
                    <?php
                            }
                        }
                    }
                    ?></option>

                </datalist>
                <label for="cid_2">اسم الزبون:</label>
            </div>
            <div class="input-box">
                <input list="payBillList" type="number"  value="" name="pbid" id="pbid" required tabindex="4"  autofocus >
                <datalist name="payBillList" id="payBillList">
                    <?php
                    include_once "includes/conn.php";
                    if ($conn) {
                        $sql = mysqli_query($conn, 'SELECT pb_id ,pb_date FROM pay_bill');
                        if (mysqli_num_rows($sql) > 0) {
                            while ($data = mysqli_fetch_assoc($sql)) {
                    ?>

                                <option  value="<?php echo $data["pb_id"]; ?>"><?php echo $data["pb_date"]; ?>"</option>
                    <?php
                            }
                        }
                    }
                    ?></option>

                </datalist>
                <label for="pbid"> رقم فاتورة الدفع :</label>
            </div>
            
            <div class="input-box " style="width: 580px;">
                <input style="width: 580px;" type="text" name="notes_2" id="notes_2" required tabindex="5" autofocus>
                <label  for="notes_2">ملاحظة:</label>

            </div>
            <div id="btn-edit" class="btn" tabindex="6">حفظ <i class="fa-solid fa-plus"></i></div>
            <div id="btn-close-edit" class="btn btn-red">إلغاء العملية <i class="fa-solid fa-close"></i></div>
        </div>
    </div>

    </div>
<!-- for delete sale -->
    <div class="dialog flex-c p25" id="dialog_delet">
        <div class="box flex-b p20 r15 g20">
            <h2>حذف  عملية بيع</h2>
            <div class="input-box1">
                <input type="number"  name="sid" id="sid" required tabindex="1" autofocus disabled>
                <label for="sid">الرقم:</label>
            </div>
            <div class="input-box1">
                <input type="date"  name="sdate_3" id="sdate_3" required tabindex="1" autofocus disabled>
                <label for="sdate_3">التاريخ:</label>
            </div>
            <div class="input-box1">

                <input list="farmerList3" type="text" name="fid_3" id="fid_3" required tabindex="2" autofocus disabled>
                <datalist name="farmerList3" id="farmerList3">

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
                <label for="fid_3">اسم المورد :</label>
            </div>
            <div class="input-box1">
                <input list="productList3" type="text" name="pid_3" id="pid_3" required tabindex="3" autofocus disabled  oninput="calculateTotalEdit() ">
                <datalist name="productList3" id="productList3">
                    <?php
                    include_once "includes/conn.php";
                    if ($conn) {
                        $sql = mysqli_query($conn, 'SELECT p_id ,p_name,p_comm FROM product');
                        if (mysqli_num_rows($sql) > 0) {
                            while ($data = mysqli_fetch_assoc($sql)) {
                    ?>

                                <option data-comm="<?php echo $data["p_comm"]; ?>" data-value="<?php echo $data["p_id"]; ?>" value="<?php echo $data["p_name"]; ?>"></option>
                    <?php
                            }
                        }
                    }
                    ?></option>

                </datalist>
                <label for="pid_3">اسم المنتج:</label>
            </div>
            <div class="input-box1">
                <input type="number" name="quantity_3" id="quantity_3" required tabindex="4" autofocus disabled>
                <label for="quantity_3"> الكمية :</label>
            </div>
            <div class="input-box1">
                <input type="number"  name="weight_3" id="weight_3" step="0.001" required tabindex="4" autofocus  disabled oninput="calculateTotalEdit() ">
                <label for="weight_3">  الوزن بالكيلو :</label>
            </div>
            <div class="input-box1">
                <input type="number" name="price_3" id="price_3" step="0.001" required tabindex="4" autofocus disabled oninput="calculateTotalEdit() ">
                <label for="price_3">  سعر الكيلو :</label>
            </div>
            <div class="input-box1">
                <input type="number"  value="" name="total_3" id="total_3" required tabindex="4" disabled autofocus oninput="calculatepriceforedit()">
                <label for="total_3"> الاجمالي :</label>
            </div>
            <div class="input-box1">
                <input type="number" name="comm_3" id="comm_3" required tabindex="4" autofocus disabled readonly>
                <label for="comm_3"> العمولة :</label>
            </div>
            <div class="input-box1">
                <input list="customertList3" value="" type="text" name="cid_3" id="cid_3" required tabindex="3"disabled autofocus>
                <datalist name="customertList3" id="customertList3">
                    <?php
                    include_once "includes/conn.php";
                    if ($conn) {
                        $sql = mysqli_query($conn, 'SELECT c_id ,c_name FROM customer');
                        if (mysqli_num_rows($sql) > 0) {
                            while ($data = mysqli_fetch_assoc($sql)) {
                    ?>

                                <option data-value="<?php echo $data["c_id"]; ?>" value="<?php echo $data["c_name"]; ?>"></option>
                    <?php
                            }
                        }
                    }
                    ?></option>

                </datalist>
                <label for="cid_3">اسم الزبون:</label>
            </div>
            <div class="input-box1">
                <input list="payBillList1" type="number"  value="" name="pbid_3" id="pbid_3" required tabindex="4" disabled autofocus >
                <datalist name="payBillList1" id="payBillList1">
                    <?php
                    include_once "includes/conn.php";
                    if ($conn) {
                        $sql = mysqli_query($conn, 'SELECT pb_id ,pb_date FROM pay_bill');
                        if (mysqli_num_rows($sql) > 0) {
                            while ($data = mysqli_fetch_assoc($sql)) {
                    ?>

                                <option  value="<?php echo $data["pb_id"]; ?>"><?php echo $data["pb_date"]; ?>"</option>
                    <?php
                            }
                        }
                    }
                    ?></option>

                </datalist>
                <label for="pbid_3"> رقم فاتورة الدفع :</label>
            </div>
            
            <div class="input-box1" >
                <input  type="text" name="notes_3" id="notes_3" required tabindex="5" disabled autofocus>
                <label  for="notes_3">ملاحظة:</label>

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
    <script src="scripts/ajax_sels.js"></script>
</body>

</html>