/**navbarre responsive */
let menu = document.getElementById('imenu');
let nav = document.getElementById('menu');
let menuri = document.getElementById('menuri');
let pro = document.querySelector('.pro');
let bar3 = document.getElementById('bar3');
let x = document.getElementById('x');

menu.addEventListener("click" , function(){

    if(menu.getAttribute("aria-expanded") == "false" )
    {
        menuri.style.display = "block";
        pro.style.display = "block";
        nav.style.height = "400px";
        menu.setAttribute("aria-expanded", "true");
        x.style.display = "block";
        bar3.style.display = "none";
    }else{
        menuri.style.display = "none";
        pro.style.display = "none";
        nav.style.height = "70px";
        menu.setAttribute("aria-expanded", "false");
        x.style.display = "none";
        bar3.style.display = "block";
    }

    // console.log("Hello");
})