
var btn_add = document.getElementById('btn-add');
btn_add.onclick = () => {
    var rdate = document.getElementById('rdate').value;
    var farmername = document.getElementById('fid').value;
    
    var productName = document.getElementById("pid").value;

    var quantity = document.getElementById('quantity').value;
    var notes = document.getElementById('notes').value;
    if (rdate == "" || fid == ""|| pid == ""|| quantity == ""){
        alert("رجاءً إملأ الحقول الفارغة");
    } else {
        var pid = document.querySelector('#productList option[value="' + productName + '"]').getAttribute('data-value');
        var fid = document.querySelector('#farmerList option[value="' + farmername + '"]').getAttribute('data-value');
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
        xhr.open('GET', 'add.php?t=receive&rdate=' + rdate + "&fid=" + fid + "&pid=" + pid + "&quantity=" + quantity + "&notes=" + notes);
        xhr.send();
    }
}

var edits = document.querySelectorAll('td .edit');
edits.forEach((edit) => {
    edit.addEventListener('click', (e) => {
        document.getElementById('dialog_edit').classList.add('show');
        document.getElementById('rdate_2').value = e.currentTarget.getAttribute('data-date');
        document.getElementById('fname_2').value = e.currentTarget.getAttribute('data-fname');
        document.getElementById('pname_2').value = e.currentTarget.getAttribute('data-pname');
        document.getElementById('quantity_2').value = e.currentTarget.getAttribute('data-quantity');
        document.getElementById('notes_2').value = e.currentTarget.getAttribute('data-notes');
        document.getElementById('btn-edit').setAttribute('data-id', e.currentTarget.getAttribute('data-id'));
    });
});

var btn_edit = document.getElementById('btn-edit');
btn_edit.onclick = () => {
    var rdate2 = document.getElementById('rdate_2').value ;
    var fname2 = document.getElementById('fname_2').value ;
    var fid2 = document.querySelector('#farmerList2 option[value="' + fname2 + '"]').getAttribute('data-value');
    var pname2 = document.getElementById('pname_2').value ;
    var pid2 = document.querySelector('#productList2 option[value="' + pname2 + '"]').getAttribute('data-value');
    var quantity2 = document.getElementById('quantity_2').value ;
    var notes2 = document.getElementById('notes_2').value;
    var id = btn_edit.getAttribute('data-id');
    if (rdate2 == "" || fid2 == ""|| pid2 == ""|| quantity2 == ""){
        alert("رجاءً إملأ الحقول الفارغة");
    } else {
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
        xhr.open('GET', 'edit.php?t=receive&id=' + id + "&rdate=" + rdate2 + "&fid=" + fid2 + "&pid=" + pid2 + "&quantity=" + quantity2 + "&notes=" + notes2);
        xhr.send();
    }
}

var delets = document.querySelectorAll('td .delet');
delets.forEach((delet) => {
    delet.addEventListener('click', (e) => {
        document.getElementById('dialog_delet').classList.add('show');
        document.getElementById('rid').value = e.currentTarget.getAttribute('data-id');
        document.getElementById('rdate_3').value = e.currentTarget.getAttribute('data-date');
        document.getElementById('fname_3').value = e.currentTarget.getAttribute('data-fname');
        document.getElementById('pname_3').value = e.currentTarget.getAttribute('data-pname');
        document.getElementById('quantity_3').value = e.currentTarget.getAttribute('data-quantity');
        document.getElementById('notes_3').value = e.currentTarget.getAttribute('data-notes');
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
        xhr.open('GET','delet.php?t=receive&id='+id);
        xhr.send();
    }
}

var search = document.getElementById('search');
search.oninput = function (){
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if(xhr.readyState==4 && xhr.status==200){
            document.getElementById('tbody').innerHTML = this.responseText;
        }
    }
    xhr.open('GET', 'search.php?t=receive&v=' + search.value);
    xhr.send();
}