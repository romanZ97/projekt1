let change = false;
window.onload = () => {
    let oln = document.getElementById("order-c-ln");
    let ofn = document.getElementById("order-c-fn");
    let oe = document.getElementById("order-c-e");
    let oa = document.getElementById("order-c-a");
    let oc = document.getElementById("order-c-c");
    oln.onchange = ()=>{change =true};
    ofn.onchange = ()=>{change =true};
    oe.onchange = ()=>{change =true};
    oa.onchange = ()=>{change =true};
    oc.onchange = ()=>{change =true};
}
