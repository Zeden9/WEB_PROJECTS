function check(id){ 
    var odpowiedzi = document.querySelectorAll(".answer");
        for(var i = 0; i<4; i++){
            odpowiedzi[i].style.backgroundColor = "gray";
        }  
    var correct = document.getElementsByName("correct");
    correct[0].style.backgroundColor = "green";
    if(document.getElementById(id).name == "wrong") document.getElementById(id).style.backgroundColor = "red";
    
}    
 