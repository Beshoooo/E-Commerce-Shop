<?php
/**
    **this page is members page and can edit from here.
*/

    session_start();
    $page_title = "Edit Profile";
    if(isset($_SESSION["Username"]))
    {
        include "init.php";
        $do = $_GET["do"];

        //check that we are comming from edit button else go to manage page. 
        if(isset($_GET["do"]) && $_GET["do"]=="Edit") 
        {
            //check ther's ID and the ID is numeric and equal the ID in session
            if (isset($_GET["UserID"]) && is_numeric($_GET["UserID"]) && $_SESSION["UserID"]==$_GET["UserID"]) {
                
                $UserID=$_GET["UserID"];
                //get all data of the user by ID
                $stmt = $con->prepare("select * from users where ID = ? LIMIT 1");
                $stmt->execute(array($UserID));
                $row = $stmt->fetch();
                $count = $stmt->rowCount(); 
                if($count > 0)
                {

                    ?>
<!--Type here html you need-->
                    <div class="Edit-profile container">
                        <h3 class="text-center">Edit Profile</h1>
                        <form onsubmit="return EditProfile()" class="Edit-data" autocomplete="off" action="?do=update-data" method="POST">
                            <input type="hidden" name="userid" value="<?php echo $UserID;?>">
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 col-md-3 col-lg-1 col-form-label">Username</label>
                                <div class="col-sm-12 col-md-12 col-lg-5">
                                    <input id ="username" class="form-control" type="text" name="username" value="<?php echo $row["Username"];?>" required>
                                    <span id="message1"></span>
                                </div>
                            
                                <label class="col-sm-3 col-md-3 col-lg-1 col-form-label">Full Name</label>
                                <div class="col-sm-12 col-md-12 col-lg-5">
                                    <input id ="fullname" class="form-control" type="text" name="fullname" value="<?php echo $row["Fullname"];?>" required>
                                    <span id="message2"></span>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-sm-3 col-md-3 col-lg-1 col-form-label">Password</label>
                                <div class="col-sm-12 col-md-12 col-lg-5">
                                    <input id ="pass" class="form-control" type="password" name="password" required>
                                    <span id="message3"></span>
                                </div>

                                <label class="col-sm-3 col-md-3 col-lg-1 col-form-label">Email</label>
                                <div class="col-sm-12 col-md-12 col-lg-5">
                                    <input id ="email" class="form-control" type="email" name="email" value="<?php echo $row["Email"];?>" required>
                                    <span id="message4"></span>
                                </div>
                            </div>

                            <div class="form-group row mb-3 justify-content-lg-center">
                                <div class="col-sm-12">
                                    <input class="btn btn-primary col-sm-2 col-md-2 col-lg-2 offset-lg-5" type="submit" value="Save">
                                </div>
                            </div>
                        </form>

                        <hr></hr>
                        <!--"return"=>if false the form will not submit else will submit -->
                        <form onsubmit ="return verifyPassword()" class="Change-pass" autocomplete="off" action="?do=update-pass" method="POST">
                            <h3 class="text-center">Change Password</h3>
                            <input type="hidden" name="UserID" value="<?php echo $UserID; ?>">
                            <!--"justify-content-lg-center"=> make content in center-->
                            <div class="form-group row justify-content-md-center">
                                <label class="col-form-label col-lg-2">Old Password</label>
                                <div class="col-lg-5">
                                    <input id="old-pass" class="form-control" name="old" type="password" required>
                                    <span id = "message1_2"></span>
                                </div>
                            </div>

                            <div class="form-group row justify-content-md-center">
                                <label class="col-form-label col-lg-2">New Password</label>
                                <div class="col-lg-5">
                                    <input id="new-pass1" class="form-control" type="password" name="new" required>
                                    <span id = "message2_2"></span>

                                </div>
                            </div>

                            <div class="form-group row justify-content-md-center">
                                <label class="col-form-label col-lg-2">Confirm Password</label>
                                <div class="col-lg-5">
                                    <input id="new-pass2" class="form-control" type="password" required>
                                    <span id = "message3_2"></span>

                                </div>
                            </div>

                            <div class="form-group row justify-content-lg-center">
                                <div class="col-sm-12">
                                    <input class="btn btn-primary col-sm-2 col-md-2 col-lg-2 offset-lg-5" value="Save" type="submit">
                                </div>
                            </div>

                        </form>


                    </div>
                <?php
                
                }//for validate 
                else{echo "there's no data for this ID member in our database.";}
            }//for validate
            else{echo "there's no ID like this.";}
        }//for validate
        elseif($do == "update-data")
        {
            //Validate by serverSide all form "update-data"
            $Errors_arr=array();
            if ($_SERVER["REQUEST_METHOD"] == "POST") 
            {
                
                $ID =$_POST["userid"];
                $Username =$_POST["username"];
                $Fullname =$_POST["fullname"];
                $Email =$_POST["email"];
                $Password =$_POST["password"];
                
                //check Empty
                if (empty($Username) || empty($Fullname) || empty($Email) || empty($Password)) {
                    if(empty($Username))
                    {$Errors_arr[]="Username can't be Empty.";}
                    elseif(empty($Fullname))
                    {$Errors_arr[]="Fullname can't be Empty.";}
                    elseif(empty($Email))
                    {$Errors_arr[]="Email can't be Empty.";}
                    else
                    {$Errors_arr[]="Password can't be Empty.";}
                }
                
                //check length
                if (strlen($Username)<6 || strlen($Username)>15 || strlen($Fullname)<10 || strlen($Fullname)>20) {
                    if(strlen($Username)<6)
                    {$Errors_arr[]="Username can't be less than 6 letter.";}
                    elseif(strlen($Username)>20)
                    {$Errors_arr[]="Username can't be more than 15 letter.";}
                    elseif(strlen($Fullname)<10)
                    {$Errors_arr[]="Fullname can't be less than 10 letter.";}
                    else
                    {$Errors_arr[]="Fullname can't be more than 20 letter.";}
                }

                //if all is correct then update.
                if (empty($Errors_arr)) {
                    
                    $stmt1 =$con->prepare("select Password from users where ID = ? LIMIT 1");
                    $stmt1->execute(array($ID));
                    $row =$stmt1->fetch();
                    $count2 =$stmt1->rowCount();
                    
                    //DB Password.
                    $DBpassword = $row["Password"];
                    if($count2 > 0 && $DBpassword == sha1($Password))
                    {
                        $stmt2 =$con->prepare("update users set Username=? , Fullname=? , Email=? where ID = ?");
                        $stmt2->execute(array($Username,$Fullname,$Email,$ID));
                        echo "<h3 class='text-center'>Update Successfully </h3>";
                    }
                    else
                    {
                        echo "<h3 class='text-center'> Wrong password plesae renter the right password.</h3>";
                    }
                
                }
                //if ther's an error then print it.
                else
                {
                    foreach ($Errors_arr as $error) {
                        echo "<h3 class='text-center'>". $error . " </h3><br>";
                    }
                }
                
                
                
                
            }
            else{echo "sorry you can't access this page directly :D.";}
        }
        elseif($do=="update-pass")
        {
            if($_SERVER["REQUEST_METHOD"]=="POST")
            {
                $oldPass  =$_POST["old"];
                $hash_old =sha1($oldPass);
                $newPass  =$_POST["new"];
                $hash_new =sha1($newPass);
                $ID       =$_POST["UserID"];

                $stmt1=$con->prepare("select Password from users where ID = ? LIMIT 1");
                $stmt1->execute(array($ID));
                $row=$stmt1->fetch();

                if($row["Password"]== $hash_old)
                {
                    $stmt2=$con->prepare("update users set Password = ? where ID = ? ");
                    $stmt2->execute(array($hash_new,$ID));
                    echo "<h3 class='text-center'>Your Password Updated Successfully </h3>";
                    
                }
                else
                {
                    echo "<h3 class='text-center'> Wrong password plesae renter the right password.</h3>";
                }
            }
        }

        else
        {
            echo $do ."mooo";
            $do = "Manage";
            echo "welcome in Manage page";
        }

        include $tpl ."footer.php";
    }
    else
    {
        echo "you are not athorized to be here .";
        header("Location: index.php");
        exit();
    }

?>

