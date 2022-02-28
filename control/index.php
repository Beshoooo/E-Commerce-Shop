
<?php
    session_start();
    if(isset($_SESSION["Username"]))
    {
        header("Location:dashboard.php");
    }

    $noNav="";//for ignoring navbar.
    $page_title="Login";
    include "init.php";

    //check if the user coming from HTTP request.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["user"];
        $password = $_POST["pass"];
        $hashedpass = sha1($password); //hash the password.

        //check if the user exist in our DB.
        //and groupID = 1 that mean  it's tha admin.
        $stmt = $con->prepare(" select ID,Username,Password
                                from users 
                                where Username=? and Password=? and GroupID = 1
                                LIMIT 1");
        $stmt->execute(array($username,$hashedpass));
        $row =$stmt->fetch();
        $count = $stmt->rowCount();
        //echo $count;
        
        //check if there's account
        if($count > 0)
        {
            $_SESSION["Username"]=$username; //add username in session.
            $_SESSION["UserID"]=$row["ID"]; //add user ID in session.
            header("Location:dashboard.php"); //redirect to dashboard.
            exit();
        }
        
    }

?>
    <div class="container">
        <form class="login d-grid gap-2" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
            <h3 class="text-center">Admin Login</h3>
            
            <!--mb-2 => spaces betwwen rows by 2 -->
            <div class="form-group row mb-2 justify-content-lg-center">  
                <div class="col-sm-12 col-lg-6"> 
                    <input class="form-control" type="text" placeholder="Username" name="user" autocomplete="off">
                </div> 
            </div>

            <div class="form-group row mb-2 justify-content-lg-center">  
                <div class="col-sm-12 col-lg-6"> 
                    <input class="form-control" type="password" placeholder="password" name="pass" autocomplete="new-password">
                </div> 
            </div>
            
            <?php
                //validate username and password
                //To make var count global and can use it
                global $count;
                if($count === 0)
                {
                    echo "<h5 class='text-center'>** Wrong Username or Password plesae renter agian.</h5>";
                }
            ?>

            <div class="form-group row mb-2 justify-content-lg-center">  
                <div class="col-sm-6 col-lg-6 offset-sm-2 offset-md-3 "> 
                    <input class=" btn btn-primary" type="submit" value="Login">
                </div> 
            </div>
            

        </form>
    </div>




<?php
    include $tpl ."footer.php";
    
?>