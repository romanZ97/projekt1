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
function loadUserFavorites(){
    let nav_favorite_div = document.getElementById("user-favorites-div");
    let favorites = nav_favorite_div.getElementsByTagName("button");
    for (let i = 0; i < favorites.length; i++) {
        if((i % 2) !== 0)
            continue;
        let id = favorites[i].value;
        let dashboard_favorite =  document.getElementById("favorite_"+id);
        dashboard_favorite.style.background= "#E26D5C";
        dashboard_favorite.style.color = "gold";
    }
}

function deleteFavorite(favorite){
    let dashboard_favorite =  document.getElementById("favorite_"+favorite);
    dashboard_favorite.style.background = "white";
    dashboard_favorite.style.color = "black";
}

function loadOrderPositions(){
    let nav_order_positions_div = document.getElementById("orders-nav-dropdown");
    let order_positions = nav_order_positions_div.getElementsByTagName("button");
    for (let i = 0; i < order_positions.length; i++) {
        let id = order_positions[i].value;
        let dashboard_order_positions =  document.getElementById("order_position_"+id);
        dashboard_order_positions.style.background= "#E26D5C";
        dashboard_order_positions.style.color = "gold";
    }
}

function deleteOrderPosition(position){
    let dashboard_order_positions =  document.getElementById("order_position_"+position);
    dashboard_order_positions.style.background = "white";
    dashboard_order_positions.style.color = "black";
}

window.addEventListener('load', (e)=> {
    userOrders = [];
    userFavorites = []
    let fileName = location.href.split("/").slice(-1);

    if(fileName[0] === "index.php" || fileName[0].split("?")[0] === "food.php"){
        if(document.getElementById("user-favorites-div")){
            loadUserFavorites();
        }
        loadOrderPositions();
    }

});


// window.addEventListener('load', (e)=>{
//     let db_body = document.getElementById("dashboard-body");
//     let o_positions_body = document.getElementById("order-positions-body");
//     let h_link = document.getElementById("home-link");
//     let f_link = document.getElementById("food-link");
//     let d_link = document.getElementById("ordering-link");
//     let r_link = document.getElementById("reservation-link");
//     let i_link = document.getElementById("info-link");
//     let s_link = document.getElementById("nav-sign-btn");
//     d_link.addEventListener('click',(e)=>{
//         const xmlhttp = new XMLHttpRequest();
//         xmlhttp.open("POST", "index.php");
//         xmlhttp.onreadystatechange = function () {
//             if (this.readyState == 4 && this.status == 200) {
//                 document.getElementById("add-modal-body").innerHTML = this.responseText;
//             }
//         };
//         const data = new FormData();
//         data.append("link-name", str);
//         data.append("user-id", <?php echo $UserService->getUserId()?>)
//         xmlhttp.send(data);
//     })
    // _link.oncklick(()=>{
    //     db_body.innerHTML = o;
    // })
// })

// window.addEventListener('unload', function (e) {
//    if(!window._link_clicked_o || !window._link_clicked_r || !window._link_clicked_h || !window._link_clicked_f){
//        const xmlhttp = new XMLHttpRequest();
//        xmlhttp.open("POST", "http://localhost:63342/Projekt1/includes/delete.php");
//        const data = new FormData();
//        data.append("order_nr", @Session["order_nr"] );
//        data.append("order_status",  @SESSION["order_nr"]);
//        xmlhttp.send(data);
//    }
// });


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