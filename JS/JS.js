// Menu Button
function openNav() {
    if (document.body.clientWidth >= 800) {
        document.getElementById("mySidenav").style.width = "50%";
    } else {
        document.getElementById("mySidenav").style.width = "100%";
    }
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}