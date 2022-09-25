// let globalpath = "http://" + window.location.host + "/projekt1/";
// let inside_click = false
// let links = ["home-link", "food-link", "ordering-link", "reservation-link", "info-link", "to-ordering-btn", "nav-sign-btn", "profile-link"];
//
// let Order = {
//     order_positions:{},
//     order_total_qty:0,
//     order_total_price:0
// }
//
// function increaseCount(a, b, food_id) {
//     let input = b.previousElementSibling;
//     let value = parseInt(input.value, 10);
//     value = isNaN(value) ? 0 : value;
//     value++;
//     input.value = value;
//     increasePositionPrice(food_id,value);
//     adeptOrderSumm(food_id);
// }
//
// function decreaseCount(a, b, food_id) {
//     let input = b.nextElementSibling;
//     let value = parseInt(input.value, 10);
//     if (value > 1) {
//         value = isNaN(value) ? 0 : value;
//         value--;
//         input.value = value;
//         decreasePositionPrice(food_id,value);
//         adeptOrderSumm(food_id);
//     }
// }
//
// function increasePositionPrice(food_id,count){
//     let str = document.getElementById("list-position-" + food_id).querySelector("#price").innerHTML;
//     str = parseFloat(str.substring(0,str.length-2));
//     let price = (str/(count-1)) * count;
//     document.getElementById("list-position-" + food_id).querySelector("#price").innerHTML = price.toFixed(2) + " €";
// }
//
// function decreasePositionPrice(food_id,count){
//     let str = document.getElementById("list-position-" + food_id).querySelector("#price").innerHTML;
//     str = parseFloat(str.substring(0,str.length-2));
//     let price = (str/(count+1)) * count;
//     document.getElementById("list-position-" + food_id).querySelector("#price").innerHTML = price.toFixed(2) + " €";
// }
//
// function adeptOrderSumm(){
//     let total_price = 0;
//     let positions = document.getElementById("order-positions-list").children;
//     if (positions[0].querySelector('#price')){
//         for (const position of positions){
//             let str = position.querySelector("#price").innerHTML;
//             str = parseFloat(str.substring(0,str.length-2));
//             total_price += str;
//         }
//         document.getElementById("total-price").innerHTML = total_price.toFixed(2) + " €";
//         document.getElementById("order-access").hidden = false;
//     } else {
//         document.getElementById("total-price").innerHTML = "-,- €";
//         document.getElementById("order-access").hidden = true;
//     }
// }
//
// function adeptCount(){
//     let total_count = document.getElementById("order-nav-count");
//     let nav_order_positions_div = document.getElementById("orders-nav-dropdown");
//     let order_positions = nav_order_positions_div.getElementsByTagName("button");
//     if(order_positions.length === 0){
//         total_count.hidden = true;
//     } else {
//         total_count.hidden = false;
//         total_count.innerText = order_positions.length.toString();
//     }
// }
//
// // function load(){
// //     let order = window.localStorage.getItem("orderPositions");
// //     if(order){
// //         Order = JSON.parse(order);
// //         loadNav().then(()=>{
// //             let order_positions = Object.keys(Order.order_positions);
// //             if(order_positions.length > 0){
// //                 order_positions.forEach(loadDashOP);
// //             }
// //         });
// //     }
// // }
//
// // function loadDashOP(food_id){
// //     let position = document.getElementById("order_position_" + food_id);
// //     if(position){
// //         position.style.background = "#E26D5C";
// //         position.style.color = "gold";
// //     }
// // }
//
// function loadALL(){
//     if(document.getElementById("user-sc")){
//         loadUserALL();
//     }
//     loadNavigation().then(() => {
//         if(isDash()) {
//             loadBody().then(() => {
//                 adeptCount();
//             });
//         } else if (isOrdering()) {
//             loadOrdering().then(() => {
//                 adeptCount();
//                 adeptOrderSumm();
//             });
//         }
//     })
// }
//
// window.addEventListener('load', (e)=> {
//     // load();
//
//     links.forEach(setClickListener)
//     loadALL();
// });
//
// function setClickListener(id){
//     let link = document.getElementById(id);
//     if(link){
//         link.addEventListener("click", ()=>{inside_click = true});
//     }
// }
//
// function loadOrderPositions(){
//     let nav_order_positions_div = document.getElementById("orders-nav-dropdown");
//     let order_positions = nav_order_positions_div.getElementsByTagName("button");
//     for (let i = 0; i < order_positions.length; i++) {
//         let id = order_positions[i].value;
//         let dashboard_order_positions =  document.getElementById("order_position_"+id);
//         if(dashboard_order_positions){
//             dashboard_order_positions.style.background= "#E26D5C";
//             dashboard_order_positions.style.color = "gold";
//         }
//     }
// }
//
// function unloadOrderPositions(){
//     let nav_order_positions_div = document.getElementById("orders-nav-dropdown");
//     let order_positions = nav_order_positions_div.getElementsByTagName("button");
//     for (let i = 0; i < order_positions.length; i++) {
//         let id = order_positions[i].value;
//         let dashboard_order_positions = document.getElementById("order_position_" + id);
//         if(dashboard_order_positions){
//             dashboard_order_positions.style.background = "white";
//             dashboard_order_positions.style.color = "black";
//         }
//     }
// }
//
// async function loadBody(){
//     loadOrderPositions();
// }
//
// async function loadData(file_path,element_id,alert_text){
//     let response = await fetch(file_path);
//     if (response.ok) {
//         document.getElementById(element_id).innerHTML = await response.text();
//     } else {
//         alert(alert_text + response.status);
//     }
// }
//
// async function loadOrdering(){
//     let response = await fetch("includes/user_actions.inc.php",
//         {
//             method: "POST",
//             headers: {
//                 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
//             },
//             body: "get-ordering=true"
//         });
//     if (response.ok) {
//         if(isOrdering()){
//             document.getElementById("order-positions-list").innerHTML = await response.text();
//             await loadData("views/select_food_dropdown.view.php","food-to-position","ERROR");
//         }
//     } else {
//         alert("ERROR" + response.status);
//     }
// }
//
// // async function loadNav(){
// //     let bag = document.getElementById("orders-nav-dropdown");
// //     if (bag){
// //         if (bag.hidden === false){
// //             bag.innerHTML = await sendJSON("views/order_nav_dropdown.view.php","order_positions",Order);
// //         }
// //     }
// // }
//
// async function loadNavigation(){
//     if (navOff()){
//         document.getElementById("nav-bag").hidden = true;
//
//     } else {
//         document.getElementById("nav-bag").hidden = false;
//         await loadOrders();
//     }
//
// }
//
// async function loadOrders(){
//     await loadData("views/user_order_dropdown.view.php","orders-nav-dropdown","ERROR");
// }
//
// function submitOrder(){
//     let count = {};
//     let positions = document.getElementById("order-positions-list").children;
//     if (positions[0].querySelector('#price')){
//         for (const position of positions){
//             let qty = position.querySelector("#position_qty").value;
//             let food_id = position.querySelector(".dropdown-button").value;
//             count[food_id] = parseInt(qty);
//         }
//         sendJSON("submit-order", count).then().catch();
//
//     } else {
//
//     }
// }
//
// function addSelectToOrderPosition(){
//     let select = document.getElementById("food-to-position");
//     if(select.value){
//         addOrderPosition(select.value);
//     }
// }
//
// // function add(food_id){
// //
// //     let position = document.getElementById("order_position_" + food_id);
// //
// //     let newOb = {};
// //     newOb.id = food_id;
// //     newOb.title = document.getElementById('title-' + food_id).innerText;
// //     newOb.portion = document.getElementById('portion-' + food_id).innerText;
// //     newOb.price = document.getElementById('price-' + food_id).innerText;
// //     newOb.price = parseFloat(newOb.price.substring(0,newOb.price.length-1))
// //
// //     if(Order.order_positions[food_id]){
// //         position.style.background = "white";
// //         position.style.color = "black";
// //         Order.order_total_price -= newOb.price;
// //         Order.order_total_price.toFixed(2);
// //         Order.order_total_qty--;
// //         delete Order.order_positions[food_id];
// //     } else {
// //         position.style.background = "#E26D5C";
// //         position.style.color = "gold";
// //         Order.order_total_price += newOb.price;
// //         Order.order_total_price.toFixed(2);
// //         Order.order_total_qty++;
// //         Order.order_positions[food_id] = newOb;
// //     }
// //
// //     window.localStorage.setItem("orderPositions", JSON.stringify(Order));
// //     console.log(window.localStorage.getItem("orderPositions"));
// //     loadNav();
// //
// // }
//
// function addOrderPosition(food_id,nav){
//     if(isDash()){
//         dashAction(food_id,"order_position_","order-position-add","ERROR").then(()=>{
//             if (nav){
//                 loadUserALL();
//             }
//         }).catch();
//     } else if (isOrdering()){
//         orderAction(food_id,"order-positions-list","order-position-add", "ERROR").then(()=>{
//             loadData("views/select_food_dropdown.view.php","food-to-position","ERROR").then()
//             if (nav){
//                 loadUserALL();
//             }
//         }).catch()
//     }
//     if (nav){
//         loadUserALL();
//     }
//
// }
//
// function deleteOrder(nr){
//     let url = globalpath + "includes/delete.php?nr="+nr;
//     fetch(url).then()
// }
//
// function deleteAllOrderPositions(){
//     if(isDash()) {
//         unloadOrderPositions();
//     }
//     userAction("delete_all_order_positions").then(()=>{
//         loadALL();
//     }).catch()
// }
//
// async function dashAction(food_id, element_id, post_name, alert_text){
//     let dashboard_favorite = document.getElementById(element_id + food_id);
//     dashboard_favorite.style.background = "#E26D5C";
//     dashboard_favorite.style.color = "gold";
//
//     let response = await fetch(globalpath + "includes/user_actions.inc.php",
//         {
//             method: "POST",
//             headers: {
//                 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
//             },
//             body: post_name + "=" + food_id
//         });
//     if (response.ok) {
//
//         if(await response.text() === "delete"){
//             dashboard_favorite.style.color = "black";
//             dashboard_favorite.style.background= "white";
//         }
//
//         loadALL();
//
//     } else {
//         alert(alert_text + response.status);
//     }
// }
//
// async function userAction(post_name){
//
//     let response = await fetch(globalpath + "includes/user_actions.inc.php",
//         {
//             method: "POST",
//             headers: {
//                 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
//             },
//             body: post_name + "=true"
//         });
//     if (response.ok) {
//
//         loadALL();
//
//     } else {
//         alert("ERROR" + response.status);
//     }
// }
//
// async function orderAction(food_id, element_id, post_name, alert_text){
//
//     let response = await fetch(globalpath + "includes/user_actions.inc.php",
//         {
//             method: "POST",
//             headers: {
//                 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
//             },
//             body: post_name + "=" + food_id + "&ordering=true"
//         });
//     if (response.ok) {
//         document.getElementById(element_id).innerHTML = await response.text();
//         loadALL();
//
//     } else {
//         alert(alert_text + response.status);
//     }
// }
//
// // async function sendJSON(post_name, json){
// //
// //     let response = await fetch(globalpath + "includes/user_actions.inc.php",
// //         {
// //             method: "POST",
// //             headers: {
// //                 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
// //             },
// //             body: post_name + "=" + encodeURIComponent(JSON.stringify(json))
// //         });
// //     if (response.ok) {
// //         console.log("All right");
// //
// //     } else {
// //         alert("ERROR" + response.status);
// //     }
// //
// // }
//
// async function sendJSON(file_name,post_name, json){
//
//     let response = await fetch(globalpath + file_name,
//         {
//             method: "POST",
//             headers: {
//                 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
//             },
//             body: post_name + "=" + encodeURIComponent(JSON.stringify(json))
//         });
//     if (response.ok) {
//         return response.text();
//     } else {
//         alert("ERROR" + response.status);
//     }
//
// }
//
// // function isDash(){
// //     if(window.location.pathname === "/projekt1/index.php" || window.location.pathname === "/projekt1/food.php") {
// //         return true;
// //     } else {
// //         return false;
// //     }
// // }
// //
// // function isOrdering(){
// //     if(window.location.pathname === "/projekt1/ordering.php") {
// //         return true;
// //     } else {
// //         return false;
// //     }
// // }
// //
// // function navOff(){
// //     if(!(isDash() || isOrdering())){
// //         return true;
// //     } else {
// //         return false;
// //     }
// // }
//
// function showFoodModal(id){
//     $('#food-modal-' + id).modal('show');
// }
//
