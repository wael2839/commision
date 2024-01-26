var btnSider = document.querySelector('.btn-sider');
btnSider.onclick = () => {
    btnSider.classList.toggle('click');
    document.querySelector('aside').classList.toggle('show');
    document.querySelector('.container').classList.toggle('wid');
}

document.getElementById('btn-dialog-add').onclick = () => {
    document.getElementById('dialog_add').classList.add('show');
}

document.getElementById('btn-close-add').onclick = () => {
    document.getElementById('dialog_add').classList.remove('show');
    window.location.reload();
}

document.getElementById('btn-close-sec').onclick = () => {
    document.getElementById('dialog_success').classList.remove('show');
    window.location.reload();
   
}

document.addEventListener('keydown', (e) => {
    if(e.key == "Escape"){
        document.getElementById('dialog_success').classList.remove('show');
        document.getElementById('dialog_add').classList.remove('show');
    }
});


document.getElementById('btn-close-edit').onclick = () => {
    document.getElementById('dialog_edit').classList.remove('show');
}


document.getElementById('btn-close-delet').onclick = () => {
    document.getElementById('dialog_delet').classList.remove('show');
}

document.getElementById('btn-close-view').onclick = () => {
    document.getElementById('dialog_view').classList.remove('show');
}






