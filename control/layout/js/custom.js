//jquary function to hide and show placeholder
$(function(){

//Hide and Show placeholder 
    $("input").on('focus',function () {
        $place = $(this).attr("placeholder");
        $(this).attr("placeholder","");
        $(this).attr("data-text",$place);

        }).on("blur",function () {
        $(this).attr("placeholder",$(this).attr("data-text"));
    });


});


//Confirmation message on delete button
$(".confirmation").click(function(){
    return confirm("Are you sure ?");
});

//validation(Client side) for not submit till all is ok.
//Validate  Edit_Profile Form
function EditProfile()
{
    var email = document.getElementById("email");
    
    var username = document.getElementById("username"),
        fullname = document.getElementById("fullname"),
        pass = document.getElementById("pass"),
        email = document.getElementById("email"),
        usernameVal = document.getElementById("username").value,
        fullnameVal = document.getElementById("fullname").value,
        passVal = document.getElementById("pass").value,
        emailVal = document.getElementById("email").value;

    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/,
        usernameformat = /^(?=[a-zA-Z0-9._]{5,20}$)(?!.*[_.]{2})[^_.].*[^_.]$/;

    //validate Email by regex "Regular expression"
    if(email.value.match(mailformat))
    {
        email.style.border="2px solid #080";
        document.getElementById("message4").innerHTML = ""; 
    }else{
        email.style.border="2px solid #f00";
        document.getElementById("message4").innerHTML = "**Invalid Email";  
        return false;
    }

    //validate Username by regex "Regular expression"
    if(usernameVal.match(usernameformat))
    {
        username.style.border="2px solid #080";
        document.getElementById("message1").innerHTML = ""; 
    }else{
        username.style.border="2px solid #f00";
        document.getElementById("message1").innerHTML = "**Invalid Username";  
        return false;
    }


    //validate fullname and password
    if (fullnameVal.length < 10 || fullnameVal.length > 20 || passVal.length < 8) {
        if(fullnameVal.length < 10 || fullnameVal.length > 20)
        {
            fullname.style.border="2px solid #f00";
            document.getElementById("message2").innerHTML = "**Please type your full name.";  
            return false;
        }else{
            fullname.style.border="2px solid #080";
            document.getElementById("message2").innerHTML = ""; 
        }

        if(passVal.length > 0 && passVal.length < 8 )
        {
            pass.style.border="2px solid #f00";
            document.getElementById("message3").innerHTML = "**Password must be atleast 8 Character.";  
            return false;
        }else{
            pass.style.border="2px solid #080";
            document.getElementById("message3").innerHTML = ""; 
            return true;
        }

    }



}


//validation(Client side) for not submit till all is ok.
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
        document.getElementById("message2_2").innerHTML = "**Fill the password please!";  
        return false;  
    }else{        
        document.getElementById("message2_2").innerHTML = "";  
    }   

    //password length validation  
    if(oldVal.length < 8 || pwVal1.length < 8 ) 
    {  
        if(oldVal.length < 8)
        {  
            oldVar.style.border="2px solid #f00";
            document.getElementById("message1_2").innerHTML = "**Password length must be atleast 8 characters";  
            return false;
        }
        
        else
        {  
            inVar1.style.border="2px solid #f00";
            document.getElementById("message2_2").innerHTML = "**Password length must be atleast 8 characters";  
            return false;
        }
    }else{
        oldVar.style.border="2px solid #080";
        inVar1.style.border="2px solid #080";
        document.getElementById("message1_2").innerHTML = ""; 
        document.getElementById("message2_2").innerHTML = "";   
    }  

    //check matching of new passwords
    if(pwVal1 != pwVal2)
    {  
        inVar2.style.border="2px solid #f00";
        document.getElementById("message3_2").innerHTML = "**Password didn't match";  
        return false; 
    }else{        
        inVar2.style.border="2px solid #080";
        document.getElementById("message3_2").innerHTML = "";
    } 

    //check entring a new password and it's a last check
    if(oldVal == pwVal1 && oldVal == pwVal2)
    {  
        inVar2.style.border="2px solid #f00";
        inVar1.style.border="2px solid #f00";
        document.getElementById("message3_2").innerHTML = "**This password is rejected please type a new one";  
        return false; 
    }else{        
        inVar2.style.border="2px solid #080";
        inVar1.style.border="2px solid #080";
        document.getElementById("message3_2").innerHTML = "";
        return true;  
    }
}  


function AddNewMember()
{    
    var username = document.getElementById("username"),
        fullname = document.getElementById("fullname"),
        pass = document.getElementById("pass"),
        confirmPass = document.getElementById("confirmPass"),
        email = document.getElementById("email"),
        usernameVal = document.getElementById("username").value,
        fullnameVal = document.getElementById("fullname").value,
        passVal = document.getElementById("pass").value,
        confirmPassVal = document.getElementById("confirmPass").value,
        emailVal = document.getElementById("email").value;

    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/,
        usernameformat = /^(?=[a-zA-Z0-9._]{5,20}$)(?!.*[_.]{2})[^_.].*[^_.]$/;

    //validate Email by regex "Regular expression"
    if(email.value.match(mailformat))
    {
        email.style.border="2px solid #080";
        document.getElementById("message3_3").innerHTML = ""; 
    }else{
        email.style.border="2px solid #f00";
        document.getElementById("message3_3").innerHTML = "**Invalid Email";  
        return false;
    }

    //validate Username by regex "Regular expression"
    if(usernameVal.match(usernameformat))
    {
        username.style.border="2px solid #080";
        document.getElementById("message1_3").innerHTML = ""; 
    }else{
        username.style.border="2px solid #f00";
        document.getElementById("message1_3").innerHTML = "**Invalid Username";  
        return false;
    }
    
    //check matching Passwords.
    if (passVal != confirmPassVal) 
    {
        confirmPass.style.border="2px solid #f00";
        document.getElementById("message5_3").innerHTML = "**Password didn't match.";  
        return false;
        
    }else{
        confirmPass.style.border="2px solid #080";
        document.getElementById("message5_3").innerHTML = ""; 
    }

    //validate fullname and password
    if (fullnameVal.length < 10 || fullnameVal.length > 20 || passVal.length < 8) 
    {
        if(fullnameVal.length < 10 || fullnameVal.length > 20)
        {
            fullname.style.border="2px solid #f00";
            document.getElementById("message2_3").innerHTML = "**Please type your full name.";  
            return false;
        }else{
            fullname.style.border="2px solid #080";
            document.getElementById("message2_3").innerHTML = ""; 
        }

        if(passVal.length < 8)
        {
            pass.style.border="2px solid #f00";
            document.getElementById("message4_3").innerHTML = "**Password must be more than 8 Character.";  
            return false;
        }else{
            pass.style.border="2px solid #080";
            document.getElementById("message4_3").innerHTML = ""; 
            return true;
        }

    }



}
