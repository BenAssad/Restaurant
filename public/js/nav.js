/**navbarre responsive */
let menu = document.getElementById('imenu');
let nav = document.getElementById('menu');

menu.addEventListener("click" , function(){

    if(menu.getAttribute("aria-expanded") == "false" )
    {
        
        nav.style.height = "400px";
        menu.innerHTML = "<p>X</p>";
        menu.setAttribute("aria-expanded", "true");
    }else{
        nav.style.height = "100px";
        //menu.innerHTML = "<i data-feather="menu"></i>"
        menu.setAttribute("aria-expanded", "false");
    }

    // console.log("Hello");
})