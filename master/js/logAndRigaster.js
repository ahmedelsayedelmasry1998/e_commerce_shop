let log = document.getElementById("log");
let reg = document.getElementById("reg");
let loginDiv = document.querySelectorAll(".login")[0];
let registarDiv = document.querySelectorAll(".registar")[0];

log.onclick = function (){
    registarDiv.style.display = "none";
    loginDiv.classList.remove("h-s");
    registarDiv.classList.add("h-s");
    this.classList.toggle("act");
    reg.classList.toggle("act");
}

reg.onclick = function (){
    registarDiv.style.display = "block";
    loginDiv.classList.add("h-s");
    registarDiv.classList.remove("h-s");
    this.classList.toggle("act");
    log.classList.toggle("act");
}