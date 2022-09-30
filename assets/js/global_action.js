let globalpath = "http://" + window.location.host + "/projekt1/";
// let inside_click = false
// let links = ["home-link", "food-link", "ordering-link", "reservation-link", "info-link", "to-ordering-btn", "nav-sign-btn", "profile-link"];
let Order = {
    order_positions:{},
    order_total_qty:0,
    order_total_price:0
}

function load(){
    let order = window.localStorage.getItem("orderPositions");
    if(!order){
        Order = {
            order_positions:{},
            order_total_qty:0,
            order_total_price:0
        }
        window.localStorage.setItem("orderPositions", JSON.stringify(Order));
        load();
    }
    Order = JSON.parse(order);
    if(document.getElementById("user-sc")){
        loadUserALL();
    }
    loadNav();
    let order_positions = Object.keys(Order.order_positions);
    if(order_positions){
        if(isDash()){
            order_positions.forEach(loadDashOP);

        } else if (isOrdering()){
            loadOrdering();
            loadSelect();
        }

    } else if (isOrdering()){
        loadOrdering();
        loadSelect();
    }
}

function loadDashOP(food_id){
    let position = document.getElementById("order_position_" + food_id);
    if(position){
        position.style.background = "#E26D5C";
        position.style.color = "gold";
    }
}

function unloadDashOP(food_id){
    let position = document.getElementById("order_position_" + food_id);
    if(position){
        position.style.background = "white";
        position.style.color = "black";
    }
}


window.addEventListener('load', (e)=> {
    load();
});

function loadNav(){
    let bag = document.getElementById("orders-nav-dropdown");
    if (navOff()){
        document.getElementById("nav-bag").hidden = true;

    } else {
        document.getElementById("nav-bag").hidden = false;
        sendJSON("views/order_nav_dropdown.view.php","order_positions",Order).then((value) =>{
            bag.innerHTML = value;
        }).then(() => {
            adeptCount(Object.keys(Order.order_positions).length);
        });
    }
}

function loadOrdering(){
    let element = document.getElementById("order-positions-list");
    if (element){
        if (element.hidden === false){
            sendJSON("views/order_positions_dropdown.view.php","order_positions",Order).then((value) =>{
                element.innerHTML = value;
            }).then(()=>{
                adeptOrderSumm();
            });
        }
    }
}

function loadSelect(){
    let element = document.getElementById("food-to-position");
    if (element){
        if (element.hidden === false){
            sendJSON("views/select_food_dropdown.view.php","order_positions",Order).then((value) =>{
                element.innerHTML = value;
            });
        }
    }
}

function add(food_id){

    let position = document.getElementById("order_position_" + food_id);

    let newOb = {};
    newOb.id = food_id;

    if(Order.order_positions[food_id]){
        if(position){
            position.style.background = "white";
            position.style.color = "black";
        }
        deleteOrderPosition(food_id);

    } else {
        if(position) {
            position.style.background = "#E26D5C";
            position.style.color = "gold";
        }

        if(isDash()){
            newOb.title = document.getElementById('title-' + food_id).innerText;
            newOb.qty = 1;
            newOb.portion = document.getElementById('portion-' + food_id).innerText;
            newOb.price = document.getElementById('price-' + food_id).innerText;
            newOb.price = parseFloat(newOb.price.substring(0,newOb.price.length-1));
            Order.order_total_price += newOb.price;
            Order.order_total_price.toFixed(2);
            Order.order_total_qty++;
            Order.order_positions[food_id] = newOb;
            window.localStorage.setItem("orderPositions", JSON.stringify(Order));
            load();

        } else if (isOrdering()) {

            incActionFood(food_id,"user_actions","order-select-add","ERROR").then((data)=>{
                let Ob = JSON.parse(data);
                newOb.title = Ob.title;
                newOb.qty = 1;
                newOb.portion = Ob.food_portion + " " + Ob.food_portion_unit;
                newOb.price = parseFloat(Ob.price);
                Order.order_total_price += newOb.price;
                Order.order_total_price.toFixed(2);
                Order.order_total_qty++;
                Order.order_positions[food_id] = newOb;
                window.localStorage.setItem("orderPositions", JSON.stringify(Order));
                load();
            })
        }
    }
}

function addSelectToOrderPosition(){
    let select = document.getElementById("food-to-position");
    if(select.value){
        add(select.value);
    }
}

function deleteAllOrderPositions(){
    if(isDash())
    Object.keys(Order.order_positions).forEach(unloadDashOP)
    Order = {
        order_positions:{},
        order_total_qty:0,
        order_total_price:0
    }
    window.localStorage.setItem("orderPositions", JSON.stringify(Order));
    load();
}

function increaseCount(a, b, food_id) {
    let input = b.previousElementSibling;
    let value = parseInt(input.value, 10);
    value = isNaN(value) ? 0 : value;
    value++;
    input.value = value;
    adeptOrderByPositionCount(food_id,value);
}

function decreaseCount(a, b, food_id) {
    let input = b.nextElementSibling;
    let value = parseInt(input.value, 10);
    if (value > 1) {
        value = isNaN(value) ? 0 : value;
        value--;
        input.value = value;
        adeptOrderByPositionCount(food_id,value);
    }
}

function adeptOrderByPositionCount(food_id, count){
    Order.order_total_price -= Order.order_positions[food_id].price * Order.order_positions[food_id].qty;
    Order.order_total_qty -= Order.order_positions[food_id].qty;
    Order.order_positions[food_id].qty = count;
    Order.order_total_price += Order.order_positions[food_id].price * Order.order_positions[food_id].qty;
    Order.order_total_qty += Order.order_positions[food_id].qty;
    Order.order_total_price.toFixed(2);
    window.localStorage.setItem("orderPositions", JSON.stringify(Order));
    load();
}

function deleteOrderPosition(food_id){
    Order.order_total_price -= Order.order_positions[food_id].price * Order.order_positions[food_id].qty;
    Order.order_total_qty -= Order.order_positions[food_id].qty;
    Order.order_total_price.toFixed(2);
    delete Order.order_positions[food_id];
    window.localStorage.setItem("orderPositions", JSON.stringify(Order));
    load();
}

function adeptOrderSumm(){
    let total_price = Order.order_total_price;
    if (total_price > 0){
        document.getElementById("order-access").hidden = false;
        setTimeout(document.getElementById("total-price").innerHTML = total_price.toFixed(2) + " €", 500);

    } else {
        document.getElementById("total-price").innerHTML = "-,- €";
        document.getElementById("order-access").hidden = true;
    }
}

function adeptCount(count){
    let total_count = document.getElementById("order-nav-count");
    if(count === 0){
        total_count.hidden = true;
    } else {
        total_count.hidden = false;
        total_count.innerText = count;
    }
}

function submitOrder(){
    sendJSON("includes/user_actions.inc.php","submit-order",Order).then(deleteAllOrderPositions);
}

async function incActionFood(food_id, file_name, post_name, alert_text){

    let response = await fetch(globalpath + "includes/" + file_name + ".inc.php",
        {
            method: "POST",
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
            },
            body: post_name + "=" + food_id
        });

    if (response.ok) {
        return response.text();

    } else {
        alert(alert_text + response.status);
    }
}

async function sendJSON(file_name,post_name, json){

    let response = await fetch(globalpath + file_name,
        {
            method: "POST",
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
            },
            body: post_name + "=" + encodeURIComponent(JSON.stringify(json))
        });
    if (response.ok) {
        return response.text();
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

function navOff(){
    if(!(isDash() || isOrdering())){
        return true;
    } else {
        return false;
    }
}

function showFoodModal(id){
    $('#food-modal-' + id).modal('show');
}
