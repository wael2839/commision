// for select get information after select supplier
function selectsupplier() {
  var fname1 = document.getElementById("fid").value;
  fid = document
    .querySelector('#farmerList option[value="' + fname1 + '"]')
    .getAttribute("data-value");
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      document.getElementById("faddress").value = document
        .querySelector('#farmerList option[value="' + fname1 + '"]')
        .getAttribute("data-fadd");
      document.getElementById("fphone").value = document
        .querySelector('#farmerList option[value="' + fname1 + '"]')
        .getAttribute("data-fphone");
      document.getElementById("tbody1").innerHTML = this.responseText;
    }
  };
  xhr.open("GET", "search_bill.php?t=pay_bill&v=" + fid);
  xhr.send();
}

// for add pay bill new

var btn_add = document.getElementById("btn-add");
btn_add.onclick = () => {
  var new_bill_id = btn_add.getAttribute("data-bill-id");
  var fname = document.getElementById("fid").value;
  var fid = document
    .querySelector('#farmerList1 option[value="' + fname + '"]')
    .getAttribute("data-value");

  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (this.status == 200 && this.readyState == 4) {
      btn_add.style.backgroundColor = "GreenYellow";
      btn_add.style.borderColor = "white";
      btn_add.style.color = "white";
    }
  };
  var note = document.getElementById("notes1").value;
  xhr.open(
    "GET",
    "add.php?t=pay_bill&fid=" +
      fid +
      "&new_bill_id=" +
      new_bill_id +
      "&note=" +
      note
  );
  xhr.send();
};


// for get information bill
var edits = document.querySelectorAll("td .view");
edits.forEach((edit) => {
  edit.addEventListener("click", (e) => {
    document.getElementById("dialog_view").classList.add("show");
    document.getElementById("bill_num").textContent =
      "فاتورة ( " + e.currentTarget.getAttribute("data-id") + " )";
    document.getElementById("rdate1").value =
      e.currentTarget.getAttribute("data-date")
    document.getElementById("fid1").value = fname1 =
      e.currentTarget.getAttribute("data-fname");
    document.getElementById("fphone1").value = document
      .querySelector('#farmerList1 option[value="' + fname1 + '"]')
      .getAttribute("data-fphone");
    document.getElementById("faddress1").value = document
      .querySelector('#farmerList1 option[value="' + fname1 + '"]')
      .getAttribute("data-fadd");
    document.getElementById("notes2").value =
      e.currentTarget.getAttribute("data-note");
    document
     
      var xhr = new XMLHttpRequest();
      var pb_id = e.currentTarget.getAttribute("data-id")
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      
      document.getElementById("tbody2").innerHTML = this.responseText;
    }
  };
  xhr.open("GET", "search_bill.php?t=pay_bill_view&v=" + pb_id);
  xhr.send();
  });
});



// for delete bill
var delets = document.querySelectorAll("td .delet");
delets.forEach((delet) => {
  delet.addEventListener("click", (e) => {
    document.getElementById('bill-id').innerText=e.currentTarget.getAttribute("data-id");
    document.getElementById("dialog_delet").classList.add("show");

    document
      .getElementById("btn-delet")
      .setAttribute("data-id", e.currentTarget.getAttribute("data-id"));
  });
});

var btn_delet = document.getElementById("btn-delet");
btn_delet.onclick = () => {
  var id = btn_delet.getAttribute("data-id");
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        if (this.responseText == "deleted") {
          document.getElementById("dialog_delet").classList.remove("show");
          document.getElementById("dialog_success").classList.add("show");
        } else {
          alert(this.responseText);
        }
      }
    };
    xhr.open("GET", "delet.php?t=pay_bill&id=" + id);
    xhr.send();
  }
;

function printDiv() {
  document.getElementById("lbl-fid").innerText =
    document.getElementById("fid").value;
  document.getElementById("lbl-fphone").innerText =
    document.getElementById("fphone").value;
  document.getElementById("lbl-faddress").innerText =
    document.getElementById("faddress").value;
  document.getElementById("lbl-notes1").innerText =
    document.getElementById("notes1").value;

  var printContents = document.getElementById("box2").innerHTML;
  var originalContents = document.body.innerHTML;

  document.body.innerHTML = printContents;

  window.print();

  document.body.innerHTML = originalContents;
  window.location.reload();

  document.getElementById("dialog_add").classList.remove("show");
  document.getElementById("dialog_success").classList.add("show");4
 
}

function printDiv1() {
  document.getElementById("lbl-rdate1").innerText =
    document.getElementById("rdate1").value;
  document.getElementById("lbl-fid1").innerText =
    document.getElementById("fid1").value;
  document.getElementById("lbl-fphone1").innerText =
    document.getElementById("fphone1").value;
  document.getElementById("lbl-faddress1").innerText =
    document.getElementById("faddress1").value;
  document.getElementById("lbl-notes2").innerText =
    document.getElementById("notes2").value;

  var printContents = document.getElementById("box1").innerHTML;
  var originalContents = document.body.innerHTML;

  document.body.innerHTML = printContents;

  window.print();

  document.body.innerHTML = originalContents;
  window.location.reload();
  document.getElementById("dialog_view").classList.remove("show");
  document.getElementById("dialog_success").classList.add("show");
 
  
}



var search = document.getElementById("search");
search.oninput = function () {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      document.getElementById("tbody").innerHTML = this.responseText;
    }
  };
  xhr.open("GET", "search.php?t=report&v=" + search.value);
  xhr.send();
};
