/**navbarre responsive */
let menu = document.getElementById('imenu');
let nav = document.getElementById('menu');
let menuri = document.getElementById('menuri');
let pro = document.querySelector('.pro');

menu.addEventListener("click" , function(){

    if(menu.getAttribute("aria-expanded") == "false" )
    {
        menuri.style.display = "block";
        pro.style.display = "block";
        nav.style.height = "400px";
        menu.setAttribute("aria-expanded", "true");
        // menu.innerHTML = "<p>X</p>";
    }else{
        menuri.style.display = "none";
        pro.style.display = "none";
        nav.style.height = "100px";
        // menu.innerHTML = <i data-feather="menu"></i>;
        menu.setAttribute("aria-expanded", "false");

    }

    // console.log("Hello");
})