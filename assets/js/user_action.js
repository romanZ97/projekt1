
function loadUserALL(){
    loadUserNavigation().then(()=>loadUserFavorites());
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
        dashboard_favorite.style.background= "#E26D5C";
        dashboard_favorite.style.color = "gold";
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

async function loadFavorites(){
    await loadData("views/user_favorites_dropdown.view.php","favorites-nav-dropdown", "ERROR");
}

function addFavorite(food_id,nav) {

    userUserDashAction(food_id,"favorite_","favorite-add","ERROR").then(()=>{
        if(nav){
            document.getElementById("favorites-nav-dropdown").className = document.getElementById("favorites-nav-dropdown").className + " show";
        }
    }).catch();

}

function favoriteToOrderPosition(food_id){
    addOrderPosition(food_id);
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
    sendJSON('order-user-data',data).then()
}
