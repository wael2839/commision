var btn_add = document.getElementById('btn-add');
btn_add.onclick = () => {
    var pname = document.getElementById('pname').value;
    var pcomm = document.getElementById('pcomm').value;
    if (pname == "" || pcomm == ""){
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
        xhr.open('GET', 'add.php?t=product&pname=' + pname + "&pcomm=" + pcomm);
        xhr.send();
    }
}

var edits = document.querySelectorAll('td .edit');
edits.forEach((edit) => {
    edit.addEventListener('click', (e) => {
        document.getElementById('dialog_edit').classList.add('show');
        document.getElementById('pname_2').value = e.currentTarget.getAttribute('data-name');
        document.getElementById('pcomm_2').value = e.currentTarget.getAttribute('data-comm');
        document.getElementById('btn-edit').setAttribute('data-id', e.currentTarget.getAttribute('data-id'));
    });
});

var btn_edit = document.getElementById('btn-edit');
btn_edit.onclick = () => {
    var pname2 = document.getElementById('pname_2').value;
    var pcomm2 = document.getElementById('pcomm_2').value;
    var id = btn_edit.getAttribute('data-id');
    if (pname2 == "" || pcomm2 == ""){
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
        xhr.open('GET', 'edit.php?t=product&id=' + id + '&pname=' + pname2 + "&pcomm=" + pcomm2);
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
    xhr.open('GET', 'search.php?t=product&v=' + search.value);
    xhr.send();
}


