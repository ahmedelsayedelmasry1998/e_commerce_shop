let old_password_input = document.getElementById("old-pass");
let all_div_row = document.querySelectorAll(".a");
old_password_input.onkeyup = function (){
    let currentPass = old_password_input.value;
    let dataRequest = new XMLHttpRequest;
    dataRequest.onreadystatechange = function () {
        if(this.status == 200 && this.readyState == 4)
        {
            let json_data = this.responseText;
            let js_obj = JSON.parse(json_data);
            let u_pass = js_obj[0];
            if(u_pass == currentPass)
            {
                for(let x = 0 ; x < all_div_row.length;x++)
                {
                    all_div_row[x].classList.remove("h-s");
                }
            }else{
                for(let x = 0 ; x < all_div_row.length;x++)
                {
                    all_div_row[x].classList.add("h-s");
                }
            }
        }
    }
    dataRequest.open("GET","user_pass.json",true);
    dataRequest.send();
}
let inp1 = document.getElementById("inp-pass1");
let inp2 = document.getElementById("inp-pass2");
let btn = document.getElementById("btn-run");
let resualt = document.getElementById("resault");
inp2.onkeyup = function (){
    let val1 = inp1.value;
    let val2 = inp2.value;
    if(val1 == val2)
    {
        btn.classList.remove("h-s");
        resualt.innerHTML = "Matched";
        resualt.style.color = "green";
    }else{
        btn.classList.add("h-s");
        resualt.innerHTML = "Not Matched";
        resualt.style.color = "red";
    }
}