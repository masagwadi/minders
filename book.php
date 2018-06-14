<?php
session_start();
include('config/functions.php');
include('partials/formpageheader.php');


if (isset($_POST['submit'])) {

  // Service info
  $service    = $_POST['service'];
  $nopets     = $_POST['nopets'];
  $startdate  = $_POST['startdate'];
  $enddate    = $_POST['enddate'];
  $starttime  = $_POST['starttime'];


  // Pet Details
  $petname    = $_POST['petname'];
  $pettype    = $_POST['pettype'];
  $petbreed   = $_POST['petbreed'];
  $petage     = $_POST['petage'];
  $petsize    = $_POST['petsize'];
  $petchild   = $_POST['petchild'];
  $petfleas   = $_POST['petfleas'];
 

  // Owner info
  $name       = $_POST['name'];
  $surname    = $_POST['surname'];
  $email      = $_POST['email'];
  $cell       = $_POST['cell'];
  $city       = $_POST['city'];
  $surburb    = $_POST['surburb'];
  $street     = $_POST['street'];
  $property   = $_POST['property'];
  $emergency  = $_POST['emergency'];
  $vet        = $_POST['vet'];



  $userid = $_SESSION['masagwadi_tmp']['userid'];

  $errMSG = "";


  $ref = generateRandomString();
  $ref = checkref($ref);

  if($ref == "already there"){
    while($ref == "already there"){
      $ref = generateRandomString();
      $ref = checkref($ref);
    }
  }


  // get the different in days 

$now =  strtotime($startdate); // or your date as well
$your_date = strtotime($enddate);
$datediff = $your_date - $now;

$diffinal = round($datediff / (60 * 60 * 24))+1;

echo $diffinal."days, from: ".$startdate."to ".$enddate ;

// Calculate the amount due
//  ;

if($service == "petsitting" || $service == "petboarding"){
  $servicerate = 189;
}else if($service == "dogwalking"){
  $servicerate = 89;
}else if($service == "dropinvisits"){
  $servicerate = 99;
}

$totcash = $nopets * $servicerate * $diffinal;

echo $diffinal."days, from: ".$startdate."to ".$enddate."   R".$totcash ;

  
    //  insert data into mysql database
      $sql = "INSERT  INTO `bookings` (`service`, `nopets`, `startdate`, `enddate`, `starttime`, `petname`, `pettype`, `petbreed`, `petage`, `petsize`, `petchild`, `petfleas`, `ownername`, `ownersurname`, `owneremail`, `ownercell`, `ownercity`, `ownersurburb`, `ownerstreet`, `ownerproperty`, `owneremergency`, `ownervet`, `reference`, `bookerid`,`amount`)
          VALUES ( '$service', '$nopets', '$startdate', '$enddate', '$starttime', '$petname', '$pettype', '$petbreed', '$petage', '$petsize', '$petchild', '$petfleas', '$name', '$surname', '$email', '$cell', '$city', '$surburb', '$street', '$property', '$emergency', '$vet', '$ref', '$userid', '$totcash')";
          global $dbConn;
          $test = $dbConn->query($sql) or die("Could not execute mysqli QUERY090 - Insert 248");
  
    


    // Defining service discription

    if($service == "petsitting"){
      $serviceDSC = "Pet Sitting";
    }else if($service == "dogwalking"){
      $serviceDSC  = "Dog Walking";
    }else if($service == "dropinvisits"){
      $serviceDSC  = "Drop In visits";
    }else if($service == "petboarding"){
      $serviceDSC  = "Pet Boarding";
    }


    // PAYMENT GATE WAY

    $cartTotal = $totcash;

// Construct variables 
$data = array(
    // Merchant details
    'merchant_id' => '10000100',
    'merchant_key' => '46f0cd694581a',
    'return_url' => 'http://minderz.proempire.co.za/thanks',
    'cancel_url' => 'http://minderz.proempire.co.za/cancelled?ref='.$ref.'&email='.$email.'&sdate='.$startdate.'',
    'notify_url' => 'http://minderz.proempire.co.za/itn.php?ref='.$ref.'&email='.$email.'&sdate='.$startdate.'',
    // Buyer details
    'name_first' => $name,
    'name_last'  => $surname,
    'email_address'=> $email,
    // Transaction details
    'm_payment_id' => '8542', //Unique payment ID to pass through to notify_url
    // Amount needs to be in ZAR
    // If multicurrency system its conversion has to be done before building this array
    'amount' => number_format( sprintf( "%.2f", $cartTotal ), 2, '.', '' ),
    'item_name' => $serviceDSC,
    'item_description' => $serviceDSC,
    'custom_int1' => '9586', //custom integer to be passed through           
    'custom_str1' => 'id=111111&tt=95550'
);        


$pfOutput = '';
// Create GET string
foreach( $data as $key => $val )
{
    if(!empty($val))
     {
        $pfOutput .= $key .'='. urlencode( trim( $val ) ) .'&';
     }
}
// Remove last ampersand
$getString = substr( $pfOutput, 0, -1 );
if( isset( $passPhrase ) )
{
    $getString .= '&passphrase='. urlencode( trim( $passPhrase ) );
}   
$data['signature'] = md5( $getString );





// If in testing mode make use of either sandbox.payfast.co.za or www.payfast.co.za
$testingMode = true;
$pfHost = $testingMode ? 'sandbox.payfast.co.za' : 'www.payfast.co.za';

$htmlForm = '<form id="payfastmalu" action="https://'.$pfHost.'/eng/process" method="post">'; 
foreach($data as $name=> $value)
{ 
    $htmlForm .= '<input name="'.$name.'" type="hidden" value="'.$value.'" />'; 
} 
$htmlForm .= '<input type="submit" value="Pay Now now" hidden/></form>'; 
echo $htmlForm;



// echo mysqli_error($dbConn);
    if($test){
      // redirect_to("thanks");
   

?>

<script type="text/javascript">

setTimeout(function() {
  document.getElementById('payfastmalu').submit(); // SUBMIT FORM
}, 250);



</script>


  
<?php

}else{
  redirect_to("error");
}

$theloader="loader";


  }


?>

<div class="register-box register-box-mindrz">
  

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

    <small id="totalblock" class="label label-success">Total: R 189</small>

    <form action="" method="post">

      <h3>Service Info</h3>

      <div class="form-group">
                  <label>Pick A Service</label><br>
                  <!-- <i class="login-box-msg small">1 Pet Sitting (Overnight) - R189</i><br>
                  <i class="login-box-msg small">1 Pet Boarding (Overnight) - R189</i><br>
                  <i class="login-box-msg small">1 Drop-in Visit (35Minutes) - R89</i><br>
                  <i class="login-box-msg small">1 Dog Walk (30-40 Minutes) - R99</i> -->
                  <i id="servicedescr" class="small callout callout-success" style="margin-bottom:5px;display:block;">Pet Sitting: The minder comes over your house and take care of the pet</i>
                  <select name="service" id="services" class="form-control" onchange="calcTotal()" >
                    <option value="petsitting">Pet Sitting(in your home) | R189 per night</option>
                    <option value="petboarding">Pet Boarding(at the sitter's home) | R189 per night</option>
                    <option value="dogwalking">Dog Walking(From your Home) | R89 per 35 Minutes</option>
                    <option value="dropinvisits">Drop-in Visits(at your home) | R99 per 40 minutes</option>
                  </select>
        </div>

        <div class="form-group">
                  <label>Number of Pets</label>
                  <select id="nopets" name="nopets" class="form-control" onchange="calcTotal()">
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                    <option value="4">Four</option>
                  </select>
        </div>


        <div class="form-group">
        
                <label>Start Date:</label>
                <br><i id="startdatewar"></i>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input onchange="calcTotal()" name="startdate" type="text" class="form-control pull-right" id="datepicker">
                </div>
                <!-- /.input group -->
        </div>

        <div class="form-group">
                <label>End Date:</label>
                <br><i id="enddatewar"></i>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input onchange="calcTotal()" name="enddate" type="text" class="form-control pull-right" id="datepicker2">
                </div>
                <!-- /.input group -->
        </div>

         <div class="form-group">
                  <label>Preferred Time for 1st Service</label>
                  <select id="starttime" name="starttime" class="form-control" onchange="calcTotal()">
                    <option value="1">7:00</option>
                    <option value="2">8:00</option>
                    <option value="3">10:00</option>
                    <option value="4">12:00</option>
                  </select>
        </div>

<br>
<hr>

<br>
<h3>Pet Info</h3>

<div class="form-group has-feedback">
        <input required type="text" class="form-control" name="petname" placeholder="Pet name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
</div>

<div class="form-group">
    <label>Pet Type</label>
    <select id="pettype" name="pettype" class="form-control" onchange="calcTotal()">
      <option value="1">Cat</option>
      <option value="2">Dog</option>
      <option value="3">Rabit</option>
      
    </select>
</div>

<div class="form-group has-feedback">
        <input required type="text" class="form-control" name="petbreed" placeholder="Pet Breed">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
</div>

<!-- <div class="form-group">
      <label for="exampleInputFile">File input</label>
      <input type="file" id="exampleInputFile">

      <p class="help-block">Example block-level help text here.</p>
</div> -->

<div class="form-group has-feedback">
        <input required type="text" class="form-control" name="petage" placeholder="Pet Age">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
</div>

<div class="form-group">
    <label>Pet Size</label>
    <select id="petsize" name="petsize" class="form-control" onchange="calcTotal()">
      <option value="1">Small</option>
      <option value="2">medium</option>
      <option value="3">Large</option>
      
    </select>
</div>

<div class="form-group">
    <label>Fine to be around children</label>
    <select id="petchild" name="petchild" class="form-control" onchange="calcTotal()">
      <option value="1">Yes</option>
      <option value="2">No</option>     
    </select>
</div>

<div class="form-group has-feedback">
        <label for="">How often do you treat your pet for fleas?</label>
        <input required type="text" class="form-control" name="petfleas" placeholder="Pet Age">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
</div>
<br>
<hr>

<br>
<h3>Personal Info</h3>

      <div class="form-group has-feedback">
        <input required type="text" class="form-control" name="name" placeholder="First name"
        <?php if(isset($_SESSION['masagwadi_tmp'])){
                                    ?>
                                    value="<?php echo $_SESSION['masagwadi_tmp']['name'] ?>"
                                <?php    
                                }
                                ?>
        >
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input required type="text" class="form-control" name="surname" placeholder="Last name"
        <?php if(isset($_SESSION['masagwadi_tmp'])){
                                    ?>
                                    value="<?php echo $_SESSION['masagwadi_tmp']['lastname'] ?>"
                                <?php    
                                }
                                ?>
        >
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input required type="email" class="form-control" name="email" placeholder="Email"
        <?php if(isset($_SESSION['masagwadi_tmp'])){
                                    ?>
                                    value="<?php echo $_SESSION['masagwadi_tmp']['email'] ?>"
                                <?php    
                                }
                                ?>>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input required type="tel" class="form-control" name="cell" placeholder="Cell Number"
        <?php if(isset($_SESSION['masagwadi_tmp'])){
                                    ?>
                                    value="<?php echo $_SESSION['masagwadi_tmp']['cell'] ?>"
                                <?php    
                                }
                                ?>
        >
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input required type="tel" class="form-control" name="city" placeholder="City">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input required type="tel" class="form-control" name="surburb" placeholder="Surburb">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
  
      <div class="form-group has-feedback">
        <input required type="tel" class="form-control" name="street" placeholder="Street Address">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input required type="tel" class="form-control" name="property" placeholder="Property Type">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input required type="tel" class="form-control" name="emergency" placeholder="Emergency Contact">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input required type="tel" class="form-control" name="vet" placeholder="Emergency Vet Spend">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      
    
        <!-- /.col -->
        <div class="">
          <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Request A Minder</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

 
    <br>

  </div>
  <!-- /.form-box -->
</div>


<!-- loader -->
<div class="loader" id="<?php if(isset($theloader)){echo $theloader;}  ?>">

<img src="dist/img/loader-masa.gif" alt="">

</div>


<?php
include('partials/formpagefooter.php');
?>

