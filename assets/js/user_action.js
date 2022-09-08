function increaseCount(a, b, food_id) {
    let input = b.previousElementSibling;
    let value = parseInt(input.value, 10);
    value = isNaN(value) ? 0 : value;
    value++;
    input.value = value;
    increasePositionPrice(food_id,value);
    adeptOrderSumm(food_id);
}

function decreaseCount(a, b, food_id) {
    let input = b.nextElementSibling;
    let value = parseInt(input.value, 10);
    if (value > 1) {
        value = isNaN(value) ? 0 : value;
        value--;
        input.value = value;
        decreasePositionPrice(food_id,value);
        adeptOrderSumm(food_id);
    }
}

function increasePositionPrice(food_id,count){
    let str = document.getElementById("list-position-" + food_id).querySelector("#price").innerHTML;
    str = parseFloat(str.substring(0,str.length-2));
    let price = (str/(count-1)) * count;
    document.getElementById("list-position-" + food_id).querySelector("#price").innerHTML = price.toFixed(2) + " €";
}

function decreasePositionPrice(food_id,count){
    let str = document.getElementById("list-position-" + food_id).querySelector("#price").innerHTML;
    str = parseFloat(str.substring(0,str.length-2));
    let price = (str/(count+1)) * count;
    document.getElementById("list-position-" + food_id).querySelector("#price").innerHTML = price.toFixed(2) + " €";
}

function adeptOrderSumm(){
    let total_price = 0;
    let positions = document.getElementById("order-positions-list").children;
    if (positions[0].querySelector('#price')){
        for (const position of positions){
            let str = position.querySelector("#price").innerHTML;
            str = parseFloat(str.substring(0,str.length-2));
            total_price += str;
        }
        document.getElementById("total-price").innerHTML = total_price.toFixed(2) + " €";
    } else {
        document.getElementById("total-price").innerHTML = "-,- €";
    }


}

function adeptCount(){
    let total_count = document.getElementById("order-nav-count");
    let nav_order_positions_div = document.getElementById("orders-nav-dropdown");
    let order_positions = nav_order_positions_div.getElementsByTagName("button");
    if(order_positions.length === 0){
        total_count.hidden = true;
    } else {
        total_count.hidden = false;
        total_count.innerText = order_positions.length.toString();
    }
}

function loadALL(){
    loadNavigation().then(() => {
        if(isDash()) {
            loadBody().then(() => {
                adeptCount();
            });
        } else if (isOrdering()) {
            loadOrdering().then(() => {
                adeptCount();
                adeptOrderSumm();
            });
        }
    })
}

window.addEventListener('load', (e)=> {
        loadALL();
});

// document.addEventListener("click", (evt) => {
//     const favorites_nav_dropdown = document.getElementById("favorites-nav-dropdown");
//     let targetEl = evt.target; // clicked element
//     do {
//         if(targetEl === favorites_nav_dropdown) {
//             // This is a click inside, does nothing, just return.
//             favorites_nav_dropdown.className = "dropdown-menu dropdown-menu-right dropdown-text-right show";
//             return;
//         }
//         // Go up the DOM
//         targetEl = targetEl.parentNode;
//     } while (targetEl);
//     // This is a click outside.
//     favorites_nav_dropdown.className = "dropdown-menu dropdown-menu-right dropdown-text-right";
// });

function loadUserFavorites(){
    let nav_favorite_div = document.getElementById("favorites-nav-dropdown");
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

function unloadOrderPositions(){
    let nav_order_positions_div = document.getElementById("orders-nav-dropdown");
    let order_positions = nav_order_positions_div.getElementsByTagName("button");
    for (let i = 0; i < order_positions.length; i++) {
        let id = order_positions[i].value;
        let dashboard_order_positions =  document.getElementById("order_position_"+id);
        dashboard_order_positions.style.background= "white";
        dashboard_order_positions.style.color = "black";
    }
}

async function loadData(file_path,element_id,alert_text){
    let response = await fetch(file_path);
    if (response.ok) {
        document.getElementById(element_id).innerHTML = await response.text();
    } else {
        alert(alert_text + response.status);
    }
}

async function loadBody(){
    if(document.getElementById("favorites-nav-dropdown")){
        loadUserFavorites();
    }
    loadOrderPositions();
}

async function loadOrdering(){
    let response = await fetch("includes/user_actions.inc.php",
        {
            method: "POST",
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
            },
            body: "get-ordering=true"
        });
    if (response.ok) {
        if(isOrdering()){
            document.getElementById("order-positions-list").innerHTML = await response.text();
        }
    } else {
        alert("ERROR" + response.status);
    }
}

async function loadNavigation(){
    await loadFavorites();
    await loadOrders();
}

async function loadFavorites(){
    await loadData("views/user_favorites_dropdown.view.php","favorites-nav-dropdown", "ERROR");
}

async function loadOrders(){
    await loadData("views/user_order_dropdown.view.php","orders-nav-dropdown","ERROR");
}

function submitOrder(){
    let count = {};
    let positions = document.getElementById("order-positions-list").children;
    if (positions[0].querySelector('#price')){
        for (const position of positions){
            let qty = position.querySelector("#position_qty").value;
            let food_id = position.querySelector(".dropdown-button").value;
            count[food_id] = parseInt(qty);
        }
        sendJSON("submit-order", JSON.stringify(count)).then().catch();

    } else {

    }
}

function addFavorite(food_id,nav) {

    userDashAction(food_id,"favorite_","favorite-add","ERROR").then(()=>{
        if(nav){
            document.getElementById("favorites-nav-dropdown").className = document.getElementById("favorites-nav-dropdown").className + " show";
        }
    }).catch();

}

function addOrderPosition(food_id){
    if(isDash()){
        userDashAction(food_id,"order_position_","order-position-add","ERROR").then().catch();
    } else if (isOrdering()){
        userOrderAction(food_id,"order-positions-list","order-position-add", "ERROR").then().catch()
    }

}

function favoriteToOrderPosition(food_id){
    addOrderPosition(food_id);
}

function deleteAllOrderPositions(){
    if(isDash()) {
        unloadOrderPositions();
    }
    userActionA("delete_all_order_positions").then(()=>{
        loadALL();
    }).catch()
}

async function userDashAction(food_id, element_id, post_name, alert_text){
    let dashboard_favorite = document.getElementById(element_id + food_id);
    dashboard_favorite.style.background = "#E26D5C";
    dashboard_favorite.style.color = "gold";

    let response = await fetch("includes/user_actions.inc.php",
        {
            method: "POST",
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
            },
            body: post_name + "=" + food_id
        });
    if (response.ok) {

        if(await response.text() === "delete"){
            dashboard_favorite.style.color = "black";
            dashboard_favorite.style.background= "white";

        }

        loadALL();

    } else {
        alert(alert_text + response.status);
    }
}

async function userActionA(post_name){

    let response = await fetch("includes/user_actions.inc.php",
        {
            method: "POST",
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
            },
            body: post_name + "=true"
        });
    if (response.ok) {

        loadALL();

    } else {
        alert("ERROR" + response.status);
    }

}

async function userOrderAction(food_id, element_id, post_name, alert_text){

    let response = await fetch("includes/user_actions.inc.php",
        {
            method: "POST",
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
            },
            body: post_name + "=" + food_id + "&ordering=true"
        });
    if (response.ok) {
        document.getElementById(element_id).innerHTML = await response.text();
        loadALL();

    } else {
        alert(alert_text + response.status);
    }
}

async function sendJSON(post_name, json){

    let response = await fetch("includes/user_actions.inc.php",
        {
            method: "POST",
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
            },
            body: post_name + "=" + json
        });
    if (response.ok) {
        console.log("All right");

    } else {
        alert("ERROR" + response.status);
    }

}

function isDash(){
    if(window.location.pathname === "/projekt1/index.php" || window.location.pathname === "/projekt1/food.php") {
        return true;
    } else {
        return false;
    }
}

function isOrdering(){
    if(window.location.pathname === "/projekt1/ordering.php") {
        return true;
    } else {
        return false;
    }
}