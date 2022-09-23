let change = false;
let oln;
let ofn;
let oe;
let oa;
let oc;
window.onload = () =>{
    oln = document.getElementById("order-c-ln");
    ofn = document.getElementById("order-c-fn");
    oe = document.getElementById("order-c-e");
    oa = document.getElementById("order-c-a");
    oc = document.getElementById("order-c-c");
    oc.setCustomValidity("geben Sie eine gültige, deutsche Nummer ein!")
    oln.onchange = (()=>{
        change =true;
    });
    ofn.onchange = (()=>{
        change =true;
    });
    oe.onchange = (()=>{
        change =true;
    });
    oa.onchange = (()=>{
        change =true;
    });
    oc.onchange = (()=>{
        change =true;
    });
}
function checkUserData(){
    if (change){
        $("#saveUserData").modal("show");
    } else {
        $('#order-customer-form').submit();
    }
}

function setUserData(){
    let data = {
        user_surname: oln.value,
        user_forename: ofn.value,
        email: oe.value,
        address: oa.value,
        contact: oc.value
    }
    sendUserData(data);
    $('#order-customer-form').submit();
}

function updateOrder(){
    userAction("cancel-calculate").then()
}