let userOrders = [];
let userFavorites = [];

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