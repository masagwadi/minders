<?php
include('config/functions.php');
include('partials/header.php');


if (isset($_POST['submit'])) {

  $password    = $_POST['password'];
  $passwordconf    = $_POST['passwordconf'];
  $first_name    = $_POST['name'];
  $last_name    = $_POST['surname'];
  $email        = $_POST['email'];
  $cell        = $_POST['cell'];
  $gender        = $_POST['gender'];
  $errMSG = "";

 if(empty($passwordconf)){
      $errMSG .="<li>Passwords dont match.</li>";
  }
  
  $exists = "";
  
  $result = "SELECT email from usersmain WHERE email = '{$email}' LIMIT 1";
  global $dbConn;
  $sql = db_Query($result);
  if (dbNumRows($sql)  >= 1) {
      $exists .= "e";
      $errMSG .="<li>An account with this email exist.</li>";
  }
  
  if ($exists == "u") {
      echo "<p><b>Error:</b> Username already exists!</p>";
  }elseif ($exists == "e"){
       $errMSG .="<li>Email already exists!</li>";
   }elseif ($exists == "ue"){ echo "<p><b>Error:</b> Username and Email already exists!</p>";
   }else {
  
    $code=rand(1000000,9999999);
      # insert data into mysql database
      $sql = "INSERT  INTO `usersmain` ( `name`, `user_password`, `lastname`, `gender`, `email`, `refference`, `cell`, `activation_code`)
          VALUES ( '$first_name ', PASSWORD('$password'), '$last_name', '$gender', '$email', 'none', '$cell', '$code')";
          global $dbConn;
          $test = $dbConn->query($sql) or die("Could not execute mysqli QUERY090 - Insert 248");
  
  
      if ($test === TRUE){
          redirect_to("login");
      } else {
          echo "<p>MySQL error no {$mysqli->errno} : {$mysqli->error}</p>";
  
          exit();
      }
  }
  
  
  }


?>

<div class="register-box">
  <div class="register-logo">
    <a href="/"><b>Admin</b>LTE</a>
  </div>

  <div class="register-box-body">
    <?php
      if(isset($errMSG) && $errMSG != ""){
    ?>

<div class="callout callout-danger">
        <h4>Warning!</h4>

        <ul>
      
    <?php
      echo $errMSG;
    ?>
     </ul>
</div>
    <?php
      }
    ?>
    <p class="login-box-msg">Register a new membership</p>

    <form action="" method="post">
      <div class="form-group has-feedback">
        <input required type="text" class="form-control" name="name" placeholder="First name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input required type="text" class="form-control" name="surname" placeholder="Last name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input required type="email" class="form-control" name="email" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input required type="tel" class="form-control" name="cell" placeholder="Cell Number">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group">
                  <label>Gender</label>
                  <select name="gender" class="form-control">
                    <option value="female">Female</option>
                    <option value="male">Male</option>
                  </select>
                </div>
      <div class="form-group has-feedback">
        <input required type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input required type="password" name="passwordconf" class="form-control" placeholder="Confirm password">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> I agree to the <a href="#">terms</a>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <!-- <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using
        Google+</a>
    </div> -->
    <br>

    <a href="login.html" class="text-center">I already have a membership</a>
  </div>
  <!-- /.form-box -->
</div>


<?php
include('partials/footer.php');
?>