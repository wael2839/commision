
var btn_add = document.getElementById('btn-add');
btn_add.onclick = () => {
    var sdate = document.getElementById('sdate').value;
    var farmername = document.getElementById('fid').value;
    var productName = document.getElementById("pid").value;
    var quantity = document.getElementById('quantity').value;
    var weight = document.getElementById('weight').value;
    var price = document.getElementById('price').value;
    var customername = document.getElementById('cid').value;
    var notes = document.getElementById('notes').value;
    if (sdate == "" || farmername == ""|| productName == "" || customername == ""|| quantity == "" || weight == ""|| price == ""){
        alert("رجاءً إملأ الحقول الفارغة");
    } else {
        var fid = document.querySelector('#farmerList option[value="' + farmername + '"]').getAttribute('data-value');
        var pid = document.querySelector('#productList option[value="' + productName + '"]').getAttribute('data-value');
        var cid = document.querySelector('#customertList option[value="' + customername + '"]').getAttribute('data-value');
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function(){
            if(xhr.readyState==4 && xhr.status==200){
                if(this.responseText == "added"){
                    document.getElementById('dialog_add').classList.remove('show');
                    document.getElementById('dialog_success').classList.add('show');
                } else {
                    alert(this.responseText);
                }
            }
        }
        xhr.open('GET', 'add.php?t=sale&sdate=' + sdate + "&fid=" + fid + "&pid=" + pid  + "&quantity="
         + quantity + "&weight=" + weight + "&price=" + price+ "&cid=" + cid +"&pbid="+ 0 + "&notes=" + notes);
        xhr.send();
    }
}

var edits = document.querySelectorAll('td .edit');
edits.forEach((edit) => {
    edit.addEventListener('click', (e) => {
        document.getElementById('dialog_edit').classList.add('show');
        document.getElementById('sdate_2').value = e.currentTarget.getAttribute('data-date');
        document.getElementById('fid_2').value = e.currentTarget.getAttribute('data-fname');
        document.getElementById('pid_2').value = e.currentTarget.getAttribute('data-pname');
        document.getElementById('quantity_2').value = e.currentTarget.getAttribute('data-quantity');
        document.getElementById('weight_2').value = e.currentTarget.getAttribute('data-weight');
        document.getElementById('price_2').value = e.currentTarget.getAttribute('data-price');
        var total1 = (e.currentTarget.getAttribute('data-weight'))*(e.currentTarget.getAttribute('data-price'));
        var comm1 = e.currentTarget.getAttribute('data-comm');
        document.getElementById('total_2').value = total1;
        var comm = (comm1 * total1).toFixed(2);
         var commf = parseFloat(comm);
        document.getElementById('comm_2').value = commf;
        document.getElementById('cid_2').value = e.currentTarget.getAttribute('data-cname');
        document.getElementById('pbid').value = e.currentTarget.getAttribute('data-pbid');
        document.getElementById('notes_2').value = e.currentTarget.getAttribute('data-notes');
        document.getElementById('btn-edit').setAttribute('data-id', e.currentTarget.getAttribute('data-id'));
    });
});

var btn_edit = document.getElementById('btn-edit');
btn_edit.onclick = () => {
    var sdate2 = document.getElementById('sdate_2').value ;
    var fname2 = document.getElementById('fid_2').value ;
    var pname2 = document.getElementById('pid_2').value ;
    var quantity2 = document.getElementById('quantity_2').value ;
    var weight2 = document.getElementById('weight_2').value ;
    var price2 = document.getElementById('price_2').value ;
    var cname2 = document.getElementById('cid_2').value ;
    var pbid2 = document.getElementById('pbid').value ;
    var notes2 = document.getElementById('notes_2').value;
    var id = btn_edit.getAttribute('data-id');
    if (sdate2 == "" || fname2 == ""|| pname2 == ""|| quantity2 == ""|| weight2 == ""|| price2 == ""|| cname2 == ""){
        alert("رجاءً إملأ الحقول الفارغة");
    } else {
        if(pbid2 == ""){
            pbid2 = null;
        }
        var cid2 = document.querySelector('#customertList2 option[value="' + cname2 + '"]').getAttribute('data-value');
        var pid2 = document.querySelector('#productList2 option[value="' + pname2 + '"]').getAttribute('data-value');
        var fid2 = document.querySelector('#farmerList2 option[value="' + fname2 + '"]').getAttribute('data-value');
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function(){
            if(xhr.readyState==4 && xhr.status==200){
                if(this.responseText == "edited"){
                    document.getElementById('dialog_edit').classList.remove('show');
                    document.getElementById('dialog_success').classList.add('show');
                } else {
                    alert(this.responseText);
                }
            }
        }
        xhr.open('GET', 'edit.php?t=sale&id=' + id + "&sdate=" + sdate2 + "&fid=" + fid2 + "&pid=" + pid2
         + "&quantity=" + quantity2 + "&notes=" + notes2 + "&weight="+ weight2 + "&price=" + price2 + "&cid=" + cid2 + "&bid=" + pbid2);
        xhr.send();
        
    }
}

var delets = document.querySelectorAll('td .delet');
delets.forEach((delet) => {
    delet.addEventListener('click', (e) => {
        document.getElementById('dialog_delet').classList.add('show');
        document.getElementById('sid').value = e.currentTarget.getAttribute('data-id');
        document.getElementById('sdate_3').value = e.currentTarget.getAttribute('data-date');
        document.getElementById('fid_3').value = e.currentTarget.getAttribute('data-fname');
        document.getElementById('pid_3').value = e.currentTarget.getAttribute('data-pname');
        document.getElementById('quantity_3').value = e.currentTarget.getAttribute('data-quantity');
        document.getElementById('weight_3').value = e.currentTarget.getAttribute('data-weight');
        document.getElementById('price_3').value = e.currentTarget.getAttribute('data-price');
        document.getElementById('cid_3').value = e.currentTarget.getAttribute('data-cname');
        document.getElementById('notes_3').value = e.currentTarget.getAttribute('data-notes');
        document.getElementById('pbid_3').value = e.currentTarget.getAttribute('data-pbid');
        document.getElementById('total_3').value = e.currentTarget.getAttribute('data-total');
        document.getElementById('comm_3').value = ((e.currentTarget.getAttribute('data-total'))*(e.currentTarget.getAttribute('data-comm')));
        document.getElementById('btn-delet').setAttribute('data-id', e.currentTarget.getAttribute('data-id'));
    });
});

var btn_delet = document.getElementById('btn-delet');
btn_delet.onclick = () => {
    var id = btn_delet.getAttribute('data-id');
    if (id ==""){
        alert("Please fill out all fields");
    } else {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function(){
            if(xhr.readyState==4 && xhr.status==200){
                if(this.responseText == "deleted"){
                    document.getElementById('dialog_delet').classList.remove('show');
                    document.getElementById('dialog_success').classList.add('show');
                } else {
                    alert(this.responseText);
                }
            }
        }
        xhr.open('GET','delet.php?t=sale&id='+id);
        xhr.send();
    }
}


// for clculate total = weight * price
function calculateTotal() {
    var weight = document.getElementById('weight').value;
    var price = document.getElementById('price').value;
    var pname = document.getElementById('pid').value ;
    var pcomm = document.querySelector('#productList option[value="' + pname + '"]').getAttribute('data-comm');
    var total = weight * price;
    var comm = (pcomm * total).toFixed(2);
    var commf = parseFloat(comm);
    document.getElementById('total').value = total;
    document.getElementById('comm').value = commf;
}
function calculateprice() {
    var weight = document.getElementById('weight').value;
    var total = document.getElementById('total').value;
    var pname = document.getElementById('pid').value ;
    var pcomm = document.querySelector('#productList option[value="' + pname + '"]').getAttribute('data-comm');
    var price = (total / weight).toFixed(2);
    var pricef = parseFloat(price);
    var comm = (pcomm * total).toFixed(2);
    var commf = parseFloat(comm);
    document.getElementById('price').value = pricef;
    document.getElementById('comm').value = commf;
}



function calculateTotalEdit() {
    var weight = document.getElementById('weight_2').value;
    var price = document.getElementById('price_2').value;
    var pname = document.getElementById('pid_2').value ;
    var pcomm = document.querySelector('#productList2 option[value="' + pname + '"]').getAttribute('data-comm');
    var total = weight * price;
    var comm = (pcomm * total).toFixed(2);
    var commf = parseFloat(comm);
    document.getElementById('total_2').value = total;
    document.getElementById('comm_2').value = commf;
}

function calculatepriceforedit() {
    var weight = document.getElementById('weight_2').value;
    var total = document.getElementById('total_2').value;
    var pname = document.getElementById('pid_2').value ;
    var pcomm = document.querySelector('#productList2 option[value="' + pname + '"]').getAttribute('data-comm');
    var price = (total / weight).toFixed(2);
    var pricef = parseFloat(price);
    var comm = (pcomm * total).toFixed(2);
    var commf = parseFloat(comm);
    document.getElementById('price_2').value = pricef;
    document.getElementById('comm_2').value = commf;
}


// function printDiv() {
//     // احصل على مرجع للعنصر الذي تريد طباعته
//     var printContents = document.getElementById('table').innerHTML;
//     var originalContents = document.body.innerHTML;
   
//     // استبدل محتوى الصفحة بالمحتوى الذي تريد طباعته
//     document.body.innerHTML = printContents;
   
//     // اطبع الصفحة
//     window.print();
   
//     // استعيد محتوى الصفحة إلى الحالة الأصلية
//     document.body.innerHTML = originalContents;
//    }

// for search in sale page
var search = document.getElementById('search');
search.oninput = function (){
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if(xhr.readyState==4 && xhr.status==200){
            document.getElementById('tbody').innerHTML = this.responseText;
        }
    }
    xhr.open('GET', 'search.php?t=sale&v=' + search.value);
    xhr.send();
}

