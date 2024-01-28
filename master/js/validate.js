let all_inputs = document.querySelectorAll(".itemVal");
let all_resEmpty = document.querySelectorAll(".resEmpty");
let all_resChar = document.querySelectorAll(".resChar");
document.forms[0].onsubmit = function (event){
    let upload_value = document.forms[0].upload_file.value;
    let dot = upload_value.lastIndexOf(".");
    let image_extension = upload_value.slice(dot+1,upload_value.length);
    let extensions  = ['jpg','png','jpeg','gif','jfif'];
    if(!extensions.includes(image_extension))
    {
        event.preventDefault();
        document.getElementById("resImage").classList.remove("h-s");
        document.getElementById("resImage").style.color = "red";
        document.getElementById("resImage").style.fontFamily = "Arial";
    }
    else{
        document.getElementById("resImage").classList.add("h-s");
    }
    for(let x = 0 ; x < all_inputs.length ; x++ )
    {
        if(all_inputs[x].value == "" || all_inputs[x].value == 'start')
        {
            event.preventDefault();
            all_resEmpty[x].classList.remove("h-s");
            all_resEmpty[x].style.color = "red";
            all_resEmpty[x].style.fontFamily = "Arial";
            all_inputs[x].style.border = "2px solid red";
        }else if(all_inputs[x].value.length < 4 || all_inputs[x].value.length > 20){
          if(x == 0 || x == 3)
          {
            event.preventDefault();
            all_resChar[x].classList.remove("h-s");
            all_resChar[x].style.color = "red";
            all_resChar[x].style.fontFamily= "Arial";
            all_inputs[x].style.border = "2px solid red";
          }
        }
        else{
            all_resEmpty[x].classList.add("h-s");
            all_resChar[x].classList.add("h-s");
            all_inputs[x].style.border = "1px solid #ccc";
        }
    }
    
}