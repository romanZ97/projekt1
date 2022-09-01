let userOrders = [];

$(document).ready(function() {
    $("#buttonA").click(function(e) {
        e.preventDefault();
        userSearch = document.getElementById("userSearch").value;
        console.log(userSearch);

    });
    console.log(userSearch);
});