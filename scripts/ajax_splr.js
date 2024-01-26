var btn_add = document.getElementById('btn-add');
btn_add.onclick = () => {
    var fname = document.getElementById('fname').value;
    var fphone = document.getElementById('fphone').value;
    var faddress = document.getElementById('faddress').value;
    var fdate = document.getElementById('fdate').value;
    var fnote = document.getElementById('fnote').value;
    if (fname == "" || fphone == ""|| faddress == ""|| fdate == ""){
        alert("رجاءً إملأ الحقول الفارغة");
    } else {
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
        xhr.open('GET', 'add.php?t=suppliers&fname=' + fname + "&fphone=" + fphone + "&faddress=" + faddress + "&fdate=" + fdate + "&fnote=" + fnote);
        xhr.send();
    }
}

var edits = document.querySelectorAll('td .edit');
edits.forEach((edit) => {
    edit.addEventListener('click', (e) => {
        document.getElementById('dialog_edit').classList.add('show');
        document.getElementById('fname_2').value = e.currentTarget.getAttribute('data-name');
        document.getElementById('fphone_2').value = e.currentTarget.getAttribute('data-phone');
        document.getElementById('faddress_2').value = e.currentTarget.getAttribute('data-address');
        document.getElementById('fdate_2').value = e.currentTarget.getAttribute('data-date');
        document.getElementById('fnote_2').value = e.currentTarget.getAttribute('data-note');
        document.getElementById('btn-edit').setAttribute('data-id', e.currentTarget.getAttribute('data-id'));
    });
});

var btn_edit = document.getElementById('btn-edit');
btn_edit.onclick = () => {
    var fname2 = document.getElementById('fname_2').value ;
    var fphone2 = document.getElementById('fphone_2').value ;
    var faddress2 = document.getElementById('faddress_2').value ;
    var fdate2 = document.getElementById('fdate_2').value ;
    var fnote2 = document.getElementById('fnote_2').value;
    var id = btn_edit.getAttribute('data-id');
    if (fname2 == "" || fphone2 == ""|| faddress2 == ""|| fdate2 == ""){
        alert("Please fill out all fields");
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
        xhr.open('GET', 'edit.php?t=suppliers&id='+id+"&fname=" + fname2 + "&fphone=" + fphone2 + "&faddress=" + faddress2 + "&fdate=" + fdate2 + "&fnote=" + fnote2);
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
    xhr.open('GET', 'search.php?t=supplier&v=' + search.value);
    xhr.send();
}