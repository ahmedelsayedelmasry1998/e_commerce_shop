let searchInput = document.getElementById("search");
let containerDiv = document.getElementById("containerDiv");
searchInput.onkeyup = function () {
    let searchValue = searchInput.value;
    let dataRequest = new XMLHttpRequest;
    dataRequest.onreadystatechange = function () {
        if(this.status == 200 && this.readyState == 4)
        {
            containerDiv.innerHTML = this.responseText; 
        }
    }
    dataRequest.open("GET","member_search.php?q="+searchValue,true);
    dataRequest.send();
}