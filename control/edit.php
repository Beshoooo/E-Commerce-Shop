<?php
/**
    **this page is members page and can edit from here.
*/

    session_start();
    $page_title = "Edit Profile";
    if(isset($_SESSION["Username"]))
    {
        include "init.php";

        //if there is do ok get it else put it manage
        $do = isset($_GET["do"]) ? $_GET["do"] : "manage";        

///////////////////////////////////////////////////////////////////////////////////////
        //check that we are comming from edit button else go to manage page.
        if($do == "manage")
        {
        //Here i'm in manage page and have more than option. 
            //now i will get all users data from database except admins.
            $stmt =$con->prepare("select * from users where GroupID != 1");
            $stmt->execute();
            $rows =$stmt->fetchAll();

            ?>

            <h3 class="text-center">Manage Members</h3>
            <div class="container">
                <div class="table-responsive">
                    <table class="main-table text-center table table-bordered">
                        <thead>
                            <td>#ID</td>
                            <td>Username</td>
                            <td>Fullname</td>
                            <td>Email</td>
                            <td>Registerd Date</td>
                            <td>Control</td>
                        </thead>
                        
                        <?php
                            //catch user by user and put it in table
                            foreach ($rows as $row)
                            {
                                echo "<tr>";
                                    echo"<td>".$row["ID"]."</td>";
                                    echo"<td>".$row["Username"]."</td>";
                                    echo"<td>".$row["Fullname"]."</td>";
                                    echo"<td>".$row["Email"]."</td>";
                                    echo"<td>".$row["ID"]."</td>";
                                    echo"<td>";
                                        echo"<a class='btn btn-success' href='edit.php?do=EditUserData&UserID=".$row["ID"]."'>Edit</a>";
                                        echo"<a class='btn btn-danger confirmation' href='edit.php?do=deleteUser&UserID=".$row["ID"]."'>Delete</a>";
                                    echo"</td>";
                                echo "</tr>";
                            }
                        ?>
                        
                        
                        
                    </table>

                    <a class="btn btn-primary" href='edit.php?do=Add'><i class="fa fa-plus"></i> add new member</a>
                </div>
            </div>
            
            <?php
        }

        //Edit data for any member
        elseif($do=="EditUsersdata")
        {
            //check ther's ID and the ID is numeric and equal the ID in session
            if (isset($_GET["UserID"]) && is_numeric($_GET["UserID"])) 
            {
                
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
                        <h3 class="text-center">Edit Profile</h3>
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
                                    <input id ="fullname" class="form-control" type="text" name="fullname" value="<?php echo $row["Fullname"];?>"required> 
                                    <span id="message2"></span>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-sm-3 col-md-3 col-lg-1 col-form-label">Password</label>
                                <div class="col-sm-12 col-md-12 col-lg-5">
                                    <input id ="pass" class="form-control" type="password" name="password" placeholder="Leave Blank If You Didn't Want To Change">
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

                        
                    </div>
                <?php
                
                }//for validate 
                else{echo "there's no data for this ID member in our database.";}
            }//for validate
            else{echo "there's no ID like this.";}
        }

        //Delete User Data
        elseif($do=="deleteUser")
        {
            echo "<h3 class='text-center'>Delete Member</h3>";
            echo "<div class='container'>";
            $ID=isset($_GET["UserID"]) && is_numeric($_GET["UserID"]) ? intval($_GET["UserID"]) : 0;

            $stmt =$con->prepare("select * from users where ID =? LIMIT 1");
            $stmt->execute(array($ID));
            $count = $stmt->rowCount();

            if($count>0)
            {
                $stmt =$con->prepare("delete from users where ID = :id");
                //bindParam just another way like array(":id"=>$ID)
                $stmt->bindParam(":id",$ID);
                $stmt->execute();

                echo "<div class='alert alert-success'>".$stmt->rowCount()." Record Deleted .</div>";
            }
            else
            {echo "<div class='alert alert-danger'> This ID is not Exist.</div>";}
            

        }
///////////////////////////////////////////////////////////////////////////////////////
        //Add member page
        elseif($do=="Add")
        {
        ?>
        <div class="Edit-profile container">
            <h3 class="text-center">Add New Member</h3>
            <form onsubmit="return AddNewMember()" class="Edit-data" autocomplete="off" action="?do=Insert" method="POST">
                <div class="form-group row mb-3 justify-content-lg-center">
                    <label class="control-label addAstrisk col-sm-4 col-md-3 col-lg-2 col-form-label">Username</label>
                    <div class="col-sm-7 col-md-8 col-lg-6 ">
                        <input id ="username" class="form-control" type="text" name="username" placeholder="Type your Username" required>
                        <span id="message1_3"></span>
                    </div>
                </div>

                <div class="form-group row mb-3 justify-content-lg-center">
                    <label class="control-label addAstrisk col-sm-4 col-md-3 col-lg-2 col-form-label">Full Name</label>
                    <div class="col-sm-7 col-md-8 col-lg-6">
                        <input id ="fullname" class="form-control" type="text" name="fullname" placeholder="Type your Full name" required> 
                        <span id="message2_3"></span>
                    </div>
                </div>

                <div class="form-group row mb-3 justify-content-lg-center">
                    <label class="control-label addAstrisk col-sm-4 col-md-3 col-lg-2 col-form-label">Email</label>
                    <div class="col-sm-7 col-md-8 col-lg-6">
                        <input id ="email" class="form-control" type="email" name="email" placeholder="Type your Email" required>
                        <span id="message3_3"></span>
                    </div>
                </div>

                <div class="form-group row mb-3 justify-content-lg-center">
                    <label class="control-label addAstrisk col-sm-4 col-md-3 col-lg-2 col-form-label">Password</label>
                    <div class="col-sm-7 col-md-8 col-lg-6">
                        <input id ="pass" class="form-control" type="password" name="password" placeholder="Password must be complex " required>
                        <span id="message4_3"></span>
                    </div>
                </div>

                <div class="form-group row mb-3 justify-content-lg-center">
                    <label class="control-label addAstrisk col-sm-4 col-md-3 col-lg-2 col-form-label">Confirm Password</label>
                    <div class="col-sm-7 col-md-8 col-lg-6">
                        <input id ="confirmPass" class="form-control" type="password" placeholder="Confirm your password" required>
                        <span id="message5_3"></span>
                    </div>
                </div>

                <div class="form-group row mb-3 justify-content-lg-center">
                    <div class="col-sm-12">
                        <input class="btn btn-primary col-sm-2 col-md-2 col-lg-2 offset-sm-4 offset-md-3 offset-lg-4" type="submit" value="Add Member">
                    </div>
                </div>
            </form>
        </div>

            
        <?php
        }
        //comming from Add form
        elseif ($do=="Insert") 
        {
            echo "<h3 class='text-center'>Update Data</h3>";
            echo "<div class='container'>";
            
            $Errors_arr=array();
            if($_SERVER["REQUEST_METHOD"]=="POST")
            {
                $Username= $_POST["username"];
                $Fullname= $_POST["fullname"];
                $Email= $_POST["email"];
                $Password= $_POST["password"];
                $hashed_pass=sha1($Password);

                //check Empty
                if (empty($Username) || empty($Fullname) || empty($Email) || empty($Password)) 
                {$Errors_arr[]="<div class='alert alert-danger'>Please fill in all fields</div>";}
                
                //check length
                if (strlen($Username)<5 || strlen($Username)>15 || strlen($Fullname)<10 || strlen($Fullname)>20
                    || strlen($Password)<8) {
                    
                    if(strlen($Username)<6)
                    {$Errors_arr[]="<div class='alert alert-danger'>Username can't be less than 5 letter</div>.";}
                    elseif(strlen($Username)>20)
                    {$Errors_arr[]="<div class='alert alert-danger'>Username can't be more than 15 letter</div>.";}
                    elseif(strlen($Fullname)<10)
                    {$Errors_arr[]="<div class='alert alert-danger'>Fullname can't be less than 10 letter</div>.";}
                    elseif(strlen($Password)<8)
                    {$Errors_arr[]="<div class='alert alert-danger'>Password can't be less than 8 letter and character</div>.";}
                    else
                    {$Errors_arr[]="<div class='alert alert-danger'>Fullname can't be more than 20 letter</div>.";}
                }
                
                //ther's no errors
                if(empty($Errors_arr))
                {  
                    $stmtget=$con->prepare("select * from users where Username= ? limit 1");
                    $stmtget->execute(array($Username));
                    $row=$stmtget->fetch();
                    $count=$stmtget->rowCount();
                    
                    //Avoid repeating Usernames 
                    if($count>0)
                    {echo "<div class='alert alert-danger'>Ther's another Username like this please Type anothe one. </div>";}
                    else
                    {
                        $stmt=$con->prepare("insert into users(Username ,Password ,Email ,Fullname)
                                                values(:zuser ,:zpass ,:zemail ,:zfullname) ");
                                                //can also use question mark like "values(?,?,?,?)"
                        
                        $stmt->execute(array(   'zuser'=>$Username,
                                                'zpass'=>$hashed_pass,
                                                'zemail'=>$Email,
                                                'zfullname'=>$Fullname));

                        echo "<div class='alert alert-success'>".$stmt->rowCount()." Record Inserted .</div>";
                    }
                }
                //if ther's an error then print it.
                else
                {
                    foreach ($Errors_arr as $error) {
                        echo $error;
                    }
                }
                
                
            }
            else{echo "sorry you can't access this page directly :D.";}
            
            echo "</div>";

        }
///////////////////////////////////////////////////////////////////////////////////////
        //Edit User profile
        elseif($do=="Edit")
        {
                //check there's ID and the ID is numeric then get integer value of it 
                $UserID=isset($_GET["UserID"])&& is_numeric($_GET["UserID"]) ?intval($_GET["UserID"]) : 0 ;
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
                        <h3 class="text-center">Edit Profile</h3>
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
                                    <input id ="fullname" class="form-control" type="text" name="fullname" value="<?php echo $row["Fullname"];?>"required> 
                                    <span id="message2"></span>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-sm-3 col-md-3 col-lg-1 col-form-label">Password</label>
                                <div class="col-sm-12 col-md-12 col-lg-5">
                                    <input id ="pass" class="form-control" type="password" name="password" placeholder="Leave Blank If You Didn't Want To Change">
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
            if($UserID == 0){echo "there's no ID like this.";}
        }

        //comming from Edit form
        elseif($do=="update-data")
        {
            echo "<div class='container'>";

            //validation(Client side) all form "update-data"
            $Errors_arr=array();
            if ($_SERVER["REQUEST_METHOD"] == "POST") 
            {
                
                $ID =$_POST["userid"];
                $Username =$_POST["username"];
                $Fullname =$_POST["fullname"];
                $Email =$_POST["email"];
                if(!empty($_POST["password"]))
                {
                    $Password =$_POST["password"];
                    $hashPass=sha1($Password);
                }
                
                //check Empty
                if (empty($Username) || empty($Fullname) || empty($Email)) 
                {$Errors_arr[]="<div class='alert alert-danger'>Please fill in all fields</div>";}
                
                //check length
                if (strlen($Username)<5 || strlen($Username)>15 || strlen($Fullname)<10 || strlen($Fullname)>20) {
                    if(strlen($Username)<5)
                    {$Errors_arr[]="<div class='alert alert-danger'>Username can't be less than 5 letter</div>.";}
                    elseif(strlen($Username)>20)
                    {$Errors_arr[]="<div class='alert alert-danger'>Username can't be more than 15 letter</div>.";}
                    elseif(strlen($Fullname)<10)
                    {$Errors_arr[]="<div class='alert alert-danger'>Fullname can't be less than 10 letter</div>.";}
                    else
                    {$Errors_arr[]="<div class='alert alert-danger'>Fullname can't be more than 20 letter</div>.";}
                }

                //if all is correct then update.
                if (empty($Errors_arr)) {
                    
                    $stmt1 =$con->prepare("select Password from users where ID = ? LIMIT 1");
                    $stmt1->execute(array($ID));
                    $row =$stmt1->fetch();
                    $count2 =$stmt1->rowCount();
                    
                    if($count2 > 0 && isset($Password))
                    {
                            $stmt2 =$con->prepare("update users set Username=? , Fullname=? , Email=? , Password=? where ID = ?");
                            $stmt2->execute(array($Username,$Fullname,$Email,$hashPass,$ID));
                            echo "<h3 class='text-center'>Update Successfully </h3>";
                    }
                    elseif($count2 > 0 && !isset($Password))
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
                        echo $error;
                    }
                }
                
                
            }
            else{echo "sorry you can't access this page directly :D.";}
            
            echo "</div>";
        }

        //comming from Edit Password form
        elseif($do=="update-pass")
        {
            echo "<h3 class='text-center'>Update Password</h3>";
            echo "<div class='container'>";

            if($_SERVER["REQUEST_METHOD"]=="POST")
            {
                
                $oldPass  =$_POST["old"];
                $hash_old =sha1($oldPass);
                $newPass  =$_POST["new"];
                $hash_new =sha1($newPass);
                $ID       =$_POST["UserID"];

                //validation(Client side) all form "update-pass"
                $Errors_arr=array();
                
                //check Empty
                if(empty($oldPass) || empty($newPass))
                {$Errors_arr[]="<div class='alert alert-danger'>Please fill in all fields</div>";}

                //check length
                if(strlen($oldPass) < 8  || strlen($newPass) < 8 )
                {
                    {$Errors_arr[]="<div class='alert alert-danger'>Password can't be less than <strong>8 character or digits</strong>.</div>";}
                }
                
                //if all is correct then update.
                if (empty($Errors_arr))
                {
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
                
                //if ther's an error then print it.
                else{
                    foreach ($Errors_arr as $error) {
                        echo $error ;
                    }
                }
            }
            echo "</div>";
        }

///////////////////////////////////////////////////////////////////////////////////////

        else
        {
            echo "There is no page here.";
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

