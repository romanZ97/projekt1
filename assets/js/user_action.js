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

// function deleteNAOrder(str){
//     const xmlhttp = new XMLHttpRequest();
//     xmlhttp.open("POST", "http://localhost:63342/Projekt1/includes/delete.php");
//     const data = new FormData();
//     data.append("order_nr", str);
//     xmlhttp.send(data);
// }
