 
<?php
include('partials/header.php');


if(isset($_POST['contact'])){
    
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $messege = $_POST['message'];


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
$mail->Subject = 'Thanks For contacting Minderz';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
// $mail->msgHTML(file_get_contents('partials/contactemail.php'), dirname(__FILE__));
$mail->msgHTML($message2sendto);
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
$mail->addAttachment('PHPMailer/examples/images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    $errr = "Mailer Error: ".$mail->ErrorInfo;
} else {
    $errr =  "Message sent!";
}




}

?>


<div class="wrapper">
<section class="content-wrapper">

<section class="content">


<div class="col-md-6">
       
         
          <!-- general form elements disabled -->
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">General Elements</h3>
              <br>
              <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsa labore enim cumque sequi qui officiis?</p>
              <br>
              <h3><?php if(isset($errr)){echo $errr;}  ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" method="post" action="">
                <!-- text input -->
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" name="name" class="form-control" placeholder="Name ...">
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" name="email" class="form-control" placeholder="email ..." >
                </div>

                <!-- textarea -->
                <div class="form-group">
                  <label>Message</label>
                  <textarea class="form-control" name="message" rows="3" placeholder="Enter ..."></textarea>
                </div>
                <div>
                    <button type="submit" name="contact" class="btn btn-primary">Submit</button>
                </div>

              </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
</div>

</section>

</section>

  <?php
include('partials/footer.php');
?>