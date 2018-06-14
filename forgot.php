<?php
session_start();

include('config/functions.php');
include('partials/header.php');


if (logged_in() == true) {
  redirect_to("profile");
}


// Reset PHP startes here
if(isset($_POST['btn-reset']))
{
    $email = $_POST['email'];

    $sql = "SELECT * FROM `usersmain` WHERE 	`email`='$email' LIMIT 1";
    $result = db_Query($sql);
    $row = dbFetchAssoc($result);

    if (dbNumRows($result) == 1)
    {
        //Generate a random code
        $code=rand(1000000,9999999);

        $query2 ="UPDATE `usersmain` SET `activation_code`='$code' WHERE `email`='$email' ";
        $result2 = db_Query($query2);
        $name = $row['name'];
        $uri = $_SERVER['SERVER_NAME'];

        $message= "
        Hello ,
        <br /><br />
        We got requested to reset your password, if you did this then just click the following link to reset your password, if not just ignore this email,
        <br /><br />
        Click Following Link To Reset Your Password
        <br /><br />
        <a href='http://$uri/reset?email=$email&code=$code' class='but'>click here to reset your password</a>
        <br /><br />
        thank you :)
        ";

        require 'PHPMailer/PHPMailerAutoload.php';
        require 'partials/contactemail.php';
        //Create a new PHPMailer instance
          $mail = new PHPMailer;
          //Set who the message is to be sent from
          $mail->setFrom('from@minderz.com', 'Minderz');
          //Set an alternative reply-to address
          $mail->addReplyTo('replyto@minderz.com', 'First Last');
          //Set who the message is to be sent to
          $mail->addAddress($email, $name);
          //Set the subject line
          $mail->Subject = 'Password Reset';
          //Read an HTML message body from an external file, convert referenced images to embedded,
          //convert HTML into a basic plain-text alternative body
          // $mail->msgHTML(file_get_contents('partials/contactemail.php'), dirname(__FILE__));
          $mail->msgHTML($message);
          //Replace the plain text body with one created manually
          // $mail->AltBody = 'This is a plain-text message body';
          //Attach an image file
          // $mail->addAttachment('PHPMailer/examples/images/phpmailer_mini.png');

          //send the message, check for errors
          if (!$mail->send()) {
            $Errmsgf = "<div class='alert alert-danger'>

            We've NOT sent an email to $email.
            Error in sending the mail.
          
            </div>";
          } else {
            
            $Errmsgf = "<div class='alert alert-success'>

            We've sent an email to $email.
            Please click on the password reset link in the email to generate new password.
            <br>
            Make sure you also check your SPAM folder if the mail is not in your inbox.
            </div>";
          }

     

        


    }
    else
    {
        $Errmsgf = "<div class='alert alert-danger'>

        <strong>Sorry!</strong>  $email not found.
        </div>";

    }
}
?>

<div class="login-box">
  <div class="login-logo">
    <a href="/"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Reset Your Password</p>
    <div>
      <?php
        if(isset($Errmsgf)){
          echo $Errmsgf;
        }
      ?>
    </div>

    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="email" name="email" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="row">
        
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" name="btn-reset" class="btn btn-primary btn-block btn-flat">Rest Password</button>
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

    <br>

    <a href="login">Login</a><br><p>
    <a href="register" class="text-center">Register a new membership</a>
    </p>

  </div>
  <!-- /.login-box-body -->
</div>

<?php
include('partials/footer.php');
?>