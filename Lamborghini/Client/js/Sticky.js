var navbar = document.getElementById('GroupNavigator');

var sticky = navbar.offsetTop;

function myFunction(){
    if (window.pageYOffset > sticky){
        navbar.classList.add("Sticky");
    }else{
        navbar.classList.remove("Sticky");
    }
}