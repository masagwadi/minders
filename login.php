<?php
include('config/functions.php');
include('partials/header.php');
session_start();

if (isset($_SESSION['masagwadi_tmp'])) {
  redirect_to("profile");
}

if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  // processing remember me option and setting cookie with long expiry date
  if (isset($_POST['remember'])) {
      session_set_cookie_params('604800'); //one week (value in seconds)
      session_regenerate_id(true);
  }

  $sql = "SELECT * from usersmain WHERE email = '$email' AND user_password = PASSWORD('$password') AND user_status = 'active' LIMIT 1";
  $result = $dbConn->query($sql) or die("Could not execute mysqli QUERY090 - I'm at Func login 21");


  if ($result->num_rows != 1) {
      $errMSG= "<b>Error:</b> Invalid login details";

  } else {
      // Authenticated, set session variables
      $user = $result->fetch_array();
      $_SESSION['masagwadi_tmp'] = $user;
      $_SESSION['userid'] = $user['id'];
      $_SESSION['email'] = $user['email'];
      // $_SESSION['image'] = $user['image'];

      $row = dbFetchAssoc($result);
      $_SESSION['user_all_info'] = $row;
      $_SESSION['timestamp'] = time();

      redirect_to("profile");
     
  }
}




?>

<div class="login-box">
  <div class="login-logo">
    <a href="/"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

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

    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="email" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <!-- <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div> -->
    <!-- /.social-auth-links -->

    <a href="#">I forgot my password</a><br>
    <a href="register.html" class="text-center">Register a new membership</a>

  </div>
  <!-- /.login-box-body -->
</div>

<?php
include('partials/footer.php');
?>