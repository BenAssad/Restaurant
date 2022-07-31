let compteur = 0 // Compteur qui permettra de savoir sur quelle slide nous sommes
let timer, elements, slides, slideWidth

window.onload = () => {
    // On récupère le conteneur principal du diaporama
    const diapo = document.querySelector(".diaporama")

    // On récupère le conteneur de tous les éléments
    elements = document.querySelector(".elements")

    // On récupère un tableau contenant la liste des diapos
    slides = Array.from(elements.children)

    // On calcule la largeur visible du diaporama
    slideWidth = diapo.getBoundingClientRect().width

    // On récupère les deux flèches
    let next = document.querySelector("#nav-droite")
    let prev = document.querySelector("#nav-gauche")

    // On met en place les écouteurs d'évènements sur les flèches
    next.addEventListener("click", slideNext)
    prev.addEventListener("click", slidePrev)

    // Automatiser le diaporama
    timer = setInterval(slideNext, 4000)

    // Gérer le survol de la souris
    diapo.addEventListener("mouseover", stopTimer)
    diapo.addEventListener("mouseout", startTimer)

    // Mise en oeuvre du "responsive"
    window.addEventListener("resize", () => {
        slideWidth = diapo.getBoundingClientRect().width
        slideNext()
    })
}

/**
 * Cette fonction fait défiler le diaporama vers la droite
 */
function slideNext(){
    // On incrémente le compteur
    compteur++

    // Si on dépasse la fin du diaporama, on "rembobine"
    if(compteur == slides.length){
        compteur = 0
    }

    // On calcule la valeur du décalage
    let decal = -slideWidth * compteur
    elements.style.transform = `translateX(${decal}px)`
}

/**
 * Cette fonction fait défiler le diaporama vers la gauche
 */
function slidePrev(){
    // On décrémente le compteur
    compteur--

    // Si on dépasse le début du diaporama, on repart à la fin
    if(compteur < 0){
        compteur = slides.length - 1
    }

    // On calcule la valeur du décalage
    let decal = -slideWidth * compteur
    elements.style.transform = `translateX(${decal}px)`
}

/**
 * On stoppe le défilement
 */
function stopTimer(){
    clearInterval(timer)
}

/**
 * On redémarre le défilement
 */
function startTimer(){
    timer = setInterval(slideNext, 4000)
}


// Zoom images
const rec = document.getElementsByClassName("rec1");
const img = document.getElementsByClassName("recimg");

for(let i = 0; i < rec.length; i++){

    rec[i].addEventListener("mouseover", function(){
        img[i].style.height = "100%";
        img[i].style.width = "100%";
    });
}
for(let i = 0; i < rec.length; i++){

    rec[i].addEventListener("mouseout", function(){
        img[i].style.height = "95%";
        img[i].style.width = "95%";
    });
}

// grid zomm

const rec1 = document.getElementsByClassName("grid1");
const img1 = document.getElementsByClassName("itemImg");

for(let i = 0; i < rec1.length; i++){

    rec1[i].addEventListener("mouseover", function(){
        img1[i].style.height = "210px";
        img1[i].style.width = "210px";
    });
}
for(let i = 0; i < rec1.length; i++){

    rec1[i].addEventListener("mouseout", function(){
        img1[i].style.height = "195px";
        img1[i].style.width = "195px";
    });
}



// Slider

let compteurs = 0 
let timers, commentmessage, slide, slidetimes

window.onload = () => {
    
    const comment1 = document.querySelector(".comment1")

    commentmessage = document.querySelector(".commentmessage")

    slide = Array.from(commentmessage.children)

    
    slidetimes = comment1.getBoundingClientRect().width

    
    let next = document.querySelector("#btn-left")
    let prev = document.querySelector("#btn-rght")

    
    next.addEventListener("click", slideNext)
    prev.addEventListener("click", slidePrev)

    
    timer = setInterval(slideNext, 4000)

    
    comment1.addEventListener("mouseover", stopTimer)
    comment1.addEventListener("mouseout", startTimer)

    
    window.addEventListener("resize", () => {
        slidetimes = comment1.getBoundingClientRect().width
        slideNext()
    })
}


function slideNext(){
    
    compteur++

    
    if(compteur == slide.length){
        compteur = 0
    }

    
    let decal = -slidetimes * compteurs
    commentmessage.style.transform = `translateX(${decal}px)`
}

function slidePrev(){

    compteur--
    if(compteur < 0){
        compteur = slide.length - 1
    }

    let decal = -slidetimes * compteur
    commentmessage.style.transform = `translateX(${decal}px)`
}

function stopTimer(){
    clearInterval(timer)
}


function startTimer(){
    timer = setInterval(slideNext, 4000)
}
