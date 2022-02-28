$(function(){

//Hide and Show place holder 
    $("input").on('focus',function () {
        $place = $(this).attr("placeholder");
        $(this).attr("placeholder","");
        $(this).attr("data-text",$place);

        }).on("blur",function () {
        $(this).attr("placeholder",$(this).attr("data-text"));
    });


});






//validation for not submit till all is ok.
//validate the form of update password 
function verifyPassword() 
{    
    var oldVal = document.getElementById("old-pass").value,
        oldVar = document.getElementById("old-pass"),
        inVar1 = document.getElementById("new-pass1"),  
        inVar2 = document.getElementById("new-pass2"), 
        pwVal1 = document.getElementById("new-pass1").value,  
        pwVal2 = document.getElementById("new-pass2").value; 

    //check empty password field  
    if(pwVal1 == "") 
    {  
        document.getElementById("message2").innerHTML = "**Fill the password please!";  
        return false;  
    }else{        
        document.getElementById("message2").innerHTML = "";  
    }   

    
    //password length validation  
    if(oldVal.length < 8 || oldVal.length > 15 || pwVal1.length < 8 || pwVal1.length > 15) 
    {  
        if(oldVal.length < 8)
        {  
            oldVar.style.border="2px solid #f00";
            document.getElementById("message1").innerHTML = "**Password length must be atleast 8 characters";  
            return false;
        }
        else if(oldVal.length > 15)
        {  
            oldVar.style.border="2px solid #f00";
            document.getElementById("message1").innerHTML = "****Password length must not exceed 15 characters";  
            return false;
        }
        else if(pwVal1.length < 8)
        {  
            inVar1.style.border="2px solid #f00";
            document.getElementById("message2").innerHTML = "****Password length must be atleast 8 characters";  
            return false;
        }
        else
        {
            inVar1.style.border="2px solid #f00";
            document.getElementById("message2").innerHTML = "**Password length must not exceed 15 characters"; 
            return false;
        }

    }else{
        oldVar.style.border="2px solid #080";
        inVar1.style.border="2px solid #080";
        document.getElementById("message1").innerHTML = ""; 
        document.getElementById("message2").innerHTML = "";   
    }  
    
    
    if(pwVal1 != pwVal2)
    {  
        inVar2.style.border="2px solid #f00";
        document.getElementById("message3").innerHTML = "**Password didn't match";  
        return false; 
    }else{        
        inVar2.style.border="2px solid #080";
        document.getElementById("message3").innerHTML = "";
        return true;  
    } 
}  
