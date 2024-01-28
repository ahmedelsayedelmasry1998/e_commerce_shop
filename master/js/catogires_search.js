let search = document.getElementById("search");
let containerDiv = document.getElementById("containerDiv");
search.onkeyup = function () {
let searchValue = search.value;
let dataRequest = new XMLHttpRequest;
dataRequest.onreadystatechange = function () {
    if(this.readyState == 4 && this.status == 200)
{
    containerDiv.innerHTML = this.responseText;
}
}
dataRequest.open("GET","catogries_search.php?q="+searchValue,true);
dataRequest.send();
}