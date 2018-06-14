<?php
include('config/functions.php');
include('partials/header.php');
session_start();

// If the link dont have the code 
if(!isset($_GET['code']) || !isset($_GET['email'])) {
    redirect_to("forgot");
  }


//   BAse variables
$classzo = $hid = $emailErr = $firstnameErr = $lastnameErr = $usernameErr = $mobileErr = $passwordErr = $cpasswordErr = $genderErr = '';
$email = $firstname = $lastname = $username = $mobile = $password = $cpassword = '';
$class = 'none';


//   If the code and email are set
if(isset($_GET['code']) && isset($_GET['email'])) {
    $acode = $_GET['code'];
    $email = $_GET['email'];

    $query = "SELECT * FROM `usersmain` WHERE `activation_code`='$acode' AND `email`='$email' ";
    $resultcode=db_Query($query);
    if (dbNumRows($resultcode) < 1 ){

      $nah=0;
      $msg = "<div class='alert alert-danger'>
                          <button class='close' data-dismiss='alert'>&times;</button>
                          <strong>Sorry!</strong> Missing or expired CODE, try reseting your password again
                          </br>
                          </br>
                          </br>
                          <a href='forgot'><p class='btn btn-sml btn-success'>Reset Password</p></a>
                      </div>";

    $classzo = 'hide';

    }

  }else{
    $nah=0;
    $msg = "<div class='alert alert-danger'>
                        <button class='close' data-dismiss='alert'>&times;</button>
                        <strong>Sorry!</strong> Missing or expired CODE, try reseting your password again
                        </br>
                        </br>
                        </br>
                        <a href='forgot'><p class='btn btn-sml btn-success'>Reset Password</p></a>
                    </div>";
    $classzo = 'hide';

  }



//   Reseting password

if (empty($_POST["pass"])) {
    $nah=0;
}
elseif( $_POST["pass"] != $_POST["pass02"]){
    $cpasswordErr = "<span class='alert alert-danger'>Passwords Dont Match </span>";
    $nah=0;
}else {
    $nah=1;
}

if(isset($_POST['pass']) && $nah==1 ){
  $pass = $_POST['pass'];


$query = "SELECT * FROM usersmain WHERE activation_code='$acode' AND `email`='$email' ";
$resultcode=db_Query($query);

if (dbNumRows($resultcode) == 1 & isset($_POST['pass']))
{



$query3 = "UPDATE `usersmain` SET `usersmain`.`user_password` = PASSWORD('$pass') WHERE `usersmain`.`activation_code` = '$acode' AND `email`='$email'";

$resultcode2=db_Query($query3);

$newcode=rand(1000000,9999999);

$query4 = "UPDATE `usersmain` SET `usersmain`.`activation_code` = '$newcode' WHERE `usersmain`.`activation_code` = '$acode' AND `email`='$email'";

$resultcode3=db_Query($query4);

$msg = "<h4 class='alert alert-info'>
<button class='close' data-dismiss='alert'>&times;</button>
Password Changed
<br>
You can go and login
</br>
</br>
</br>
<a href='login'><p class='btn btn-sml btn-success'>Login</p></a>
</h4>";
}
else
{
$msg = "<div class='alert alert-danger'>
                  <button class='close' data-dismiss='alert'>&times;</button>
                  <strong>Sorry!</strong> Wrong CODE or expired, try reseting your password again
                  </br>
                  </br>
                  </br>
                  <a href='forgot'><p class='btn btn-sml btn-success'>Reset Password</p></a>
              </div>";

}
$classzo = 'hide';
}






?>

<div class="content_wrapper">
<div class="login-box">
    <div class="content">
    <form action="" method="POST" >
                <h1 class="form-signin-heading">Password Reset.</h1>
                <br />

                <?php
    if(isset($msg))
    {
        echo $msg;
    }
                ?>
                <div class="<?php echo $classzo;?>">
                <p>Please reset your password, enter you new password.</p>


                    <h4><span class="tred"><?php echo $cpasswordErr;?></span></h4>
                    <p>Enter New Password:</p>
                    
                    <input type="password" name="pass" class="form-control" placeholder="Password"  required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    <br /><br />
                    <p>Confirm New Password:</p>    
                    <input type="password" name="pass02" class="form-control" placeholder="Confirm Password"  required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    <br /><br />

                    <input class="btn btn-sml btn-success" type="submit" name="submit" value="Change Password"  />
                  </div>
            </form>
    </div>
</div>
</div>