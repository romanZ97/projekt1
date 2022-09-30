
function loadUserALL(){
    loadUserNavigation()//.then(()=>loadUserFavorites());
}

window.addEventListener('load', (e)=> {

    loadUserALL();

});

function loadUserFavorites(){
    let nav_favorite_div = document.getElementById("favorites-nav-dropdown");
    let favorites = nav_favorite_div.getElementsByTagName("button");
    for (let i = 0; i < favorites.length; i++) {
        if((i % 2) !== 0)
            continue;
        let id = favorites[i].value;
        let dashboard_favorite =  document.getElementById("favorite_"+id);
        if(dashboard_favorite){
            dashboard_favorite.style.background= "#E26D5C";
            dashboard_favorite.style.color = "gold";
        }
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


async function loadUserNavigation(){
    if (navOff()){
        document.getElementById("nav-star").hidden = true;

    } else {
        document.getElementById("nav-star").hidden = false;
        await loadFavorites();
    }

}

function loadFavorites(){
    function adeptFavoritOrders() {
        let order_positions = Object.keys(Order.order_positions);
        order_positions.forEach((id)=> {
            let favorite = document.getElementById("favorite-to-order-" + id);
            if (favorite){
                favorite.innerHTML = "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"20\" height=\"20\" fill=\"currentColor\" class=\"bi bi-bookmark-check-fill\" viewBox=\"0 0 16 16\" style=\"color: #ffdd1f\">\n" +
                    "                        <path fill-rule=\"evenodd\" d=\"M2 15.5V2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.439L8 13.069l-5.26 2.87A.5.5 0 0 1 2 15.5zm8.854-9.646a.5.5 0 0 0-.708-.708L7.5 7.793 6.354 6.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z\"/>"
            }
        })
    }

    loadData("views/user_favorites_dropdown.view.php","favorites-nav-dropdown", "ERROR").then(()=>{
        adeptFavoritOrders();
    }).then(()=>loadUserFavorites());
}

function addFavorite(food_id,nav) {

    userUserDashAction(food_id,"favorite_","favorite-add","ERROR").then().catch();

}

function favoriteToOrderPosition(food_id){
    add(food_id);
}

async function userUserDashAction(food_id, element_id, post_name, alert_text){
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

        loadUserALL();

    } else {
        alert(alert_text + response.status);
    }
}

function sendUserData(data){
    sendJSON("includes/user_actions.inc.php",'order-user-data',data).then()
}
