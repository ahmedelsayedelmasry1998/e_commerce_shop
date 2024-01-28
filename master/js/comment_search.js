let search = document.getElementById("search");
let containerDiv = document.getElementById("containerDiv");
search.onkeyup = function () {
    search_value = search.value;
    let dataRequest = new XMLHttpRequest;
    dataRequest.onreadystatechange = function () {
        if(this.status == 200 && this.readyState == 4)
        {
            containerDiv.innerHTML = this.responseText;
        }
    }
    dataRequest.open("GET","comment_search.php?q="+search_value,true);
    dataRequest.send();
}