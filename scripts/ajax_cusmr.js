var btn_add = document.getElementById('btn-add');
btn_add.onclick = () => {
    var cname = document.getElementById('cname').value;
    var cphone = document.getElementById('cphone').value;
    var cdate = document.getElementById('cdate').value;
    var cnote = document.getElementById('cnote').value;
    if (cname == "" || cphone == ""|| cdate == ""){
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
        xhr.open('GET', 'add.php?t=customer&cname=' + cname + "&cphone=" + cphone  + "&cdate=" + cdate + "&cnote=" + cnote);
        xhr.send();
    }
}

var edits = document.querySelectorAll('td .edit');
edits.forEach((edit) => {
    edit.addEventListener('click', (e) => {
        document.getElementById('dialog_edit').classList.add('show');
        document.getElementById('cname_2').value = e.currentTarget.getAttribute('data-name');
        document.getElementById('cphone_2').value = e.currentTarget.getAttribute('data-phone');
        document.getElementById('cdate_2').value = e.currentTarget.getAttribute('data-date');
        document.getElementById('cnote_2').value = e.currentTarget.getAttribute('data-note');
        document.getElementById('btn-edit').setAttribute('data-id', e.currentTarget.getAttribute('data-id'));
    });
});

var btn_edit = document.getElementById('btn-edit');
btn_edit.onclick = () => {
    var cname2 = document.getElementById('cname_2').value ;
    var cphone2 = document.getElementById('cphone_2').value;
    var cdate2 = document.getElementById('cdate_2').value;
    var cnote2 = document.getElementById('cnote_2').value;
    var id = btn_edit.getAttribute('data-id');
    if (cname2 == "" || cphone2 == ""|| cdate2 == ""){
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
        xhr.open('GET', 'edit.php?t=customer&id='+id+"&cname=" + cname2 + "&cphone=" + cphone2  + "&cdate=" + cdate2 + "&cnote=" + cnote2);
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
    xhr.open('GET', 'search.php?t=customer&v=' + search.value);
    xhr.send();
}