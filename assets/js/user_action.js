let userOrders = [];
let userFavorites = [];
let html = "";
let dashboardDishes = [];
window.addEventListener('load',()=>{
    let metas = document.getElementsByTagName("meta");
    for (let meta in metas){
        if(meta.name === "dishdata_1"){
            dashboardDishes.push(meta.content);
        }
    }
    console.log(dashboardDishes);
})
function addFavorite(favorite){

    if(favorite.substring(0,1)==="f")
        favorite = favorite.substring(9);

    let dashboard_favorite = document.getElementById("favorite_"+favorite);
    let nav_dropdown_favorites = document.getElementById("favorites-nav-dropdown");

    if(userFavorites.includes(favorite)){
        userFavorites = userFavorites.filter(function (item){
            return item !== favorite;
        })
        dashboard_favorite.style.background = "white";
        dashboard_favorite.style.color = "black";

    }else {
        userOrders.push(favorite);
        dashboard_favorite.style.background= "#E26D5C";
        dashboard_favorite.style.color = "gold";
    }
}

function addOrderPosition(position){

    if(position.substring(0,1)==="o")
        position = position.substring(6);

    let dashboard_order = document.getElementById("order_"+position);
    let nav_dropdown_orders = document.getElementById("orders-nav-dropdown");

    if(userOrders.includes(position)){
        userOrders = userOrders.filter(function (item){
            return item !== position;
        })
        dashboard_order.style.background = "white";
        dashboard_order.style.color = "black";

    }else {
        userOrders.push(position);
        dashboard_order.style.background= "#E26D5C";
        dashboard_order.style.color = "gold";
    }

}



//window.addEventListener('unload', function (e) {
//    // if(!window._link_clicked_o || !window._link_clicked_r || !window._link_clicked_h || !window._link_clicked_f){
//        const xmlhttp = new XMLHttpRequest();
//        xmlhttp.open("POST", "http://localhost:63342/Projekt1/includes/delete.php");
//        const data = new FormData();
//        data.append("order_nr", <?php //echo $_SESSION["order_nr"] ?>//);
//        data.append("order_status",  "<?php //echo $dS->getStatusByNumber($_SESSION["order_nr"]) ?>//");
//        xmlhttp.send(data);
//    // }
//});


function increaseCount(a, b) {
    let input = b.previousElementSibling;
    let value = parseInt(input.value, 10);
    value = isNaN(value) ? 0 : value;
    value++;
    input.value = value;
}

function decreaseCount(a, b) {
    let input = b.nextElementSibling;
    let value = parseInt(input.value, 10);
    if (value > 1) {
        value = isNaN(value) ? 0 : value;
        value--;
        input.value = value;
    }
}