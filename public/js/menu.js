
// Zoom images
const rec = document.getElementsByClassName("grid1");
const img = document.getElementsByClassName("itemImg");

for(let i = 0; i < rec.length; i++){

    rec[i].addEventListener("mouseover", function(){
        img[i].style.height = "200px";
        img[i].style.width = "200px";
    });
}
for(let i = 0; i < rec.length; i++){

    rec[i].addEventListener("mouseout", function(){
        img[i].style.height = "195px";
        img[i].style.width = "195px";
    });
}


