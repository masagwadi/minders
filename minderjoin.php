<?php
include('config/functions.php');
include('partials/header.php');

?>


  <script type='text/javascript'>
    function preview_image(event) {
      var reader = new FileReader();
      reader.onload = function () {
        var output = document.getElementById('output_image');
        output.src = reader.result;
      }
      reader.readAsDataURL(event.target.files[0]);
    }

    // for the file 


    function preview_name(event) {
      var reader = new FileReader();
      var outputname = document.getElementById('filename');
      outputname.innerHTML = event.target.files[0].name;
    }

  </script>

  <style>
    #output_image {
      max-width: 150px;
    }

    label {
      font-weight: 400;

      display: inline-block;
    }

    input[type="file"] {
      display: none;
    }

    .f-white {
      color: white !important;
    }

    .upload {
      border: 1px solid #ccc;
      display: inline-block;
      padding: 6px 12px;
      cursor: pointer;
    }

    #wrapper .upload::before {}

    .title {
      text-align: center;
    }

    input[type="file"] {
      display: none;
    }

    .custom-file-upload {
      border: 1px solid #ccc;
      display: inline-block;
      padding: 6px 12px;
      cursor: pointer;
      background-color: #00a65a;

    }


    .blockcheck {
      display: inline-block;
      margin: 2px;
      border: 1px solid black;
      border-radius: 5px;
      padding: 10px;
      cursor: pointer;
    }

    input:checked+.blockcheck {
      background-color: green;
      color: #ffffff;
      font-weight: bold;
    }

    .blockcheckin {
      display: none;

    }
  </style>

  <div class="register-box">
    <div class="register-logo">
      <a>
        <b>Become A </b>Minder</a>
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
          <p class="login-box-msg"></p>

        

            <!-- Top content -->
            <div class="top-content">

              <div class="inner-bg">
                <div class="">
                  <div class="">
                    <div>

                      <?php

                        if(isset($_POST['applynow'])){


                            // $closeform = 'hide';


                            $fname = $_POST['form-fname'];
                            // $lname = $_POST['form-lname'];
                            // $cell = $_POST['form-cell'];
                            // $email = $_POST['form-email'];
                            // $gender = $_POST['form-gender'];

                            // $ownedapet = $_POST['ownedapet'];
                            // $currentlypet = $_POST['currentlypet'];
                            // $animalrescue = $_POST['animalrescue'];
                            // $experience = $_POST['experience'];


                            // $reference1name = $_POST['reference0name'];
                            // $reference1pos = $_POST['reference0pos'];
                            // $reference1cell = $_POST['reference0num'];

                            // $reference2name = $_POST['reference02name'];
                            // $reference2pos = $_POST['reference02pos'];
                            // $reference2cell = $_POST['reference02num'];


                            // $city = $_POST['city'];
                            // $surburb = $_POST['surburb'];
                            // $street = $_POST['street'];
                            // $code = $_POST['code'];

                            // $animalprefer = $_POST['animalprefer'];
                            $servicepref = $_POST['servicepref'];
                            // $avialability = $_POST['avialability'];

                            $idup = "yes";
                            $proup = "yes";
                            $serviceprefull = "";
                            $w = 1;

                            foreach ($servicepref as $value) {

                              if($w<=1){
                                $serviceprefull .= $value;
                              }else{
                                $serviceprefull .= "&".$value;
                              }

                              $w++;
                              
                              // echo $value."</br>";
                          }

                          echo $serviceprefull."</br>";

                            // echo $servicepref;


                            // ID UPLOAD
                            if(isset($_FILES['idfile'])){
                              $idFile = $_FILES['idfile']['name'];
                              $idFile = rand(10,1000000)."-".$_FILES['idfile']['name'];
                              $idfolder = "files/ids/";
                              $id_loc = $_FILES['idfile']['tmp_name'];
                              move_uploaded_file($id_loc,$idfolder.$idFile);

                            }else{
                              $idup = "no";
                            }
                             


                            if(isset($_FILES['propicfile'])){

                                $imgFile = $_FILES['propicfile']['name'];
                                $imgFile = rand(10,1000000)."-".$_FILES['propicfile']['name'];
                                $file_loc = $_FILES['propicfile']['tmp_name'];
                                $file_size = $_FILES['propicfile']['size'];
                                $file_type = $_FILES['propicfile']['type'];
                                $tmp_dir = $_FILES['propicfile']['tmp_name'];
                                $imgSize = $_FILES['propicfile']['size'];
                                $profolder="files/profiles/";
                            
                                
                            
                                $profolder = 'files/profiles/'; // upload directory
                            
                                $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
                            
                                // valid image extensions
                                $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'pdf'); // valid extensions
                            
                                // rename uploading image
                                // $userpic = $imgFile;
                                $userpic = $imgFile;
                            
                                // allow valid image file formats
                                if(in_array($imgExt, $valid_extensions)){
                                    // Check file size '5MB'
                                    if($imgSize < 5000000)    {
                                      move_uploaded_file($file_loc,$profolder.$imgFile);
                                    }
                                    else{
                                        $errMSG = "Sorry, your file is too large.";
                                    }
                                }
                                else{
                                    $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                                }

                          }

                          // ############# File stuff here ############


                          // $errMSG = "";

                          // if(empty($passwordconf)){
                          //      $errMSG .="<li>Passwords dont match.</li>";
                          //  }
                           
                          //  $exists = "";
                           
                          //  $result = "SELECT email from minder WHERE email = '{$email}' LIMIT 1";
                          //  global $dbConn;
                          //  $sql = db_Query($result);
                          //  if (dbNumRows($sql)  >= 1) {
                          //      $exists .= "e";
                          //      $errMSG .="<li>An account with this email exist.</li>";
                          //  }
                           
                          //  if ($exists == "u") {
                          //      echo "<p><b>Error:</b> Username already exists!</p>";
                          //  }elseif ($exists == "e"){
                          //       $errMSG .="<li>Email already exists!</li>";
                          //   }elseif ($exists == "ue"){ echo "<p><b>Error:</b> Username and Email already exists!</p>";
                          //   }else {
                           
                          //    $code=rand(1000000,9999999);
                          //      # insert data into mysql database
                          //      $sql = "INSERT  INTO `minders` ( `name`, `user_password`, `lastname`, `gender`, `email`, `refference`, `cell`, `activation_code`)
                          //          VALUES ( '$first_name ', PASSWORD('$password'), '$last_name', '$gender', '$email', 'none', '$cell', '$code')";
                          //          global $dbConn;
                          //          $test = $dbConn->query($sql) or die("Could not execute mysqli QUERY090 - Insert 248");
                           
                           
                          //      if ($test === TRUE){
                          //          redirect_to("login");
                          //      } else {
                          //          echo "<p>MySQL error no {$mysqli->errno} : {$mysqli->error}</p>";
                           
                          //          exit();
                          //      }
                          //  }




                          // #### End file stuff #####  
                            
                            
                            // $reff = randomString(8);

                            // $message = "";
                            // // $message .= "<html><body>";
                            // $message .= "

                            //     Reference: $reff <br>

                            //     Name: $fname <br>
                            //     Lastname: $lname <br>
                            //     Email: $email <br>
                            //     Cell: $cell <br>
                            //     About: $about <br>
                            //     Address: $address <br>
                            //     Highest Qualification: $quali <br>
                            //     Gender: $gender <br> <br>

                            //     ";
                            // // $message .= '</body></html>';


                            // include('applyemail.php');


                        }


                     ?>




                    </div>
                  </div>
                  <div class="row <?php if(isset($closeform)){echo $closeform;} ?>">
                    <div class="">

                      <form  enctype="multipart/form-data" action="" method="post" class="registration-form">

                        <fieldset>
                          <div class="form-top">
                            <div class="form-top-left">
                              <h3>Personal</h3>
                              <!-- <p>Tell us who you are:</p> -->
                            </div>

                          </div>
                          <div class="form-bottom">

                            <div class="form-group">
                              <!-- <label class="sr-only" for="form-facebook">Facebook</label> -->
                              <input type="text" name="form-fname" placeholder="First Name." class="form-facebook form-control" id="form-facebook" value"masamasa">
                            </div>

                            <div class="form-group">
                              <!-- <label class="sr-only" for="form-facebook">Facebook</label> -->
                              <input type="text" name="form-lname" placeholder="Last Name." class="form-facebook form-control" id="form-facebook">
                            </div>

                            <div class="form-group">
                              <!-- <label class="sr-only" for="form-twitter">Twitter</label> -->
                              <input type="text" name="form-cell" placeholder="Cell Number" class="form-twitter form-control" id="form-twitter">
                            </div>

                            <div class="form-group">
                              <!-- <label class="sr-only" for="form-twitter">Twitter</label> -->
                              <input type="text" name="form-email" placeholder="Email" class="form-twitter form-control" id="form-twitter">
                            </div>
                            <div class="form-group">
                              <label class="" for="form-twitter">Gender</label>
                              <br>
                              <select name="form-gender" id="" class="form-control">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                              </select>
                            </div>

                            <div class="form-group">
                              <span class="cverr"></span>

                              <label>Attach ID Copy : </label>
                              <br>
                              <label class="custom-file-upload f-white" for="uploadfile">
                                <input type="file" id="uploadfile" name="idfile"  onchange="preview_name(event)" />
                                <i class="fa fa-cloud-upload"></i> Upload ID Copy
                              </label>
                              <br>
                              <label id="filename"></label>
                            </div>

                            <div class="form-group has-feedback">

                              <label> Profile Pic: </label>
                              <br>
                              <label class="custom-file-upload f-white" for="upload_file">
                                <input type="file" id="upload_file" name="propicfile" accept="image/*" onchange="preview_image(event)" />
                                <i class="fa fa-cloud-upload"></i> Image Upload
                              </label>
                              <br />

                              <img id="output_image" />
                              <div id="output_image20"></div>
                              <br />


                            </div>



                            <!-- <div class="form-group">
                      <label class="sr-only" for="form-about-yourself">Address</label>
                      <textarea name="form-address" placeholder="Address"
                            class="form-about-yourself form-control" id="form-about-yourself"></textarea>
                    </div> -->

                          </div>
                        </fieldset>

                        <fieldset>
                          <div class="form-top">
                            <div class="form-top-left">
                              <h3>Experience</h3>
                              <!-- <p>Set up your account:</p> -->
                            </div>

                          </div>
                          <div class="form-bottom">

                            <div class="form-group">
                              <label class="" for="form-twitter">Have you owned a pet before?</label>
                              <br>
                              <select name="ownedapet" id="ownedapet" class="form-control">
                                <option value="no">NO</option>
                                <option value="yes">YES</option>
                              </select>
                            </div>

                            <div class="form-group">
                              <label class="" for="form-twitter">Do you currently own a pet?</label>
                              <br>
                              <select name="currentlypet" id="currentlypet" class="form-control">
                                <option value="no">NO</option>
                                <option value="yes">YES</option>
                              </select>
                            </div>

                            <div class="form-group">
                              <label class="" for="form-twitter">Have you ever volunteered at an animal rescue organization?</label>
                              <br>
                              <select name="animalrescue" id="animalrescue" class="form-control">
                                <option value="no">NO</option>
                                <option value="yes">YES</option>
                              </select>
                            </div>

                            <div class="form-group">
                              <label class="" for="form-twitter">Years of experience dealing with pets?</label>
                              <br>
                              <input type="text" name="experience" placeholder="Years of experience" class="form-twitter form-control">
                            </div>

                            <div class="form-group">
                              <label class="" for="form-twitter">Reference 01</label>
                              <br>
                              <input type="text" name="reference0name" placeholder="Name" class="form-twitter form-control">
                              <input type="text" name="reference0pos" placeholder="Position" class="form-twitter form-control">
                              <input type="text" name="reference0num" placeholder="Number" class="form-twitter form-control">
                            </div>

                            <div class="form-group">
                              <label class="" for="form-twitter">Reference 02</label>
                              <br>
                              <input type="text" name="reference02name" placeholder="Name" class="form-twitter form-control">
                              <input type="text" name="reference02pos" placeholder="Position" class="form-twitter form-control">
                              <input type="text" name="reference02num" placeholder="Number" class="form-twitter form-control">
                            </div>

                          </div>
                        </fieldset>

                        <fieldset>
                          <div class="form-top">
                            <div class="form-top-left">
                              <h3>Address and Preference</h3>
                              <!-- <p>Contact Info:</p> -->
                              <div class="form-bottom">

                                <div class="form-group">
                                  <label class="" for="form-twitter">City</label>
                                  <br>
                                  <input type="text" name="city" placeholder="City" class="form-twitter form-control">
                                </div>
                                <div class="form-group">
                                  <label class="" for="form-twitter">Surburb</label>
                                  <br>
                                  <input type="text" name="surburb" placeholder="Surburb" class="form-twitter form-control">
                                </div>
                                <div class="form-group">
                                  <label class="" for="form-twitter">Street Address</label>
                                  <br>
                                  <input type="text" name="street" placeholder="Street Address" class="form-twitter form-control">
                                </div>
                                <div class="form-group">
                                  <label class="" for="form-twitter">Code</label>
                                  <br>
                                  <input type="text" name="code" placeholder="Code" class="form-twitter form-control">
                                </div>

                                <div class="form-group">
                                  <label>Which pet do you prefer?</label>
                                  <br>
                                  <input type="radio" name="animalprefer"  class="blockcheckin" id="chozdog" value="Dogs">
                                  <label class="blockcheck" for="chozdog">Dogs</label>

                                  <input type="radio" name="animalprefer"  class="blockcheckin" id="chozdog2" value="Cats">
                                  <label class="blockcheck" for="chozdog2">Cats</label>

                                  <input type="radio" name="animalprefer"  class="blockcheckin" id="chozdog3" value="Both Cats and Dogs">
                                  <label class="blockcheck" for="chozdog3">Both Dogs & Cats</label>

                                  <input type="radio" name="animalprefer"  class="blockcheckin" id="chozdog4" value="All Pets">
                                  <label class="blockcheck" for="chozdog4">All Pets</label>
                                </div>

                                <div class="form-group">
                                  <label>Pick a service/s you prefer?</label>
                                  <br>
                                  <input type="checkbox" name="servicepref[]" placeholder="Code" class="blockcheckin" id="chozser" value="House Sitting">
                                  <label class="blockcheck" for="chozser">House Sitting <br><i>- House Sitting: explanatio of what it is</i></label>

                                  <input type="checkbox" name="servicepref[]" placeholder="Code" class="blockcheckin" id="chozser2" value="Pet Sitting">
                                  <label class="blockcheck" for="chozser2">Pet Sitting<br>
                                  <i>- House Sitting: explanatio of what it is</i></label>

                                  <input type="checkbox" name="servicepref[]" placeholder="Code" class="blockcheckin" id="chozser3" value="Pet Boarding">
                                  <label class="blockcheck" for="chozser3">Pet Boarding<br>
                                  <i>- House Sitting: explanatio of what it is</i></label>

                                  <input type="checkbox" name="servicepref[]" placeholder="Code" class="blockcheckin" id="chozser4" value="Dog Walking">
                                  <label class="blockcheck" for="chozser4">Dog Walking<br>
                                  <i>- House Sitting: explanatio of what it is</i></label>

                                  <input type="checkbox" name="servicepref[]" placeholder="Code" class="blockcheckin" id="chozser5" value="Drop in visit">
                                  <label class="blockcheck" for="chozser5">Drop in visit<br>
                                  <i>- House Sitting: explanatio of what it is</i></label>
                  
                                 
                                  
                                </div>

                                <div class="form-group">
                                  <label class="" for="form-twitter">What Is Your Avialability?</label>
                                  <br>
                                  <input type="text" name="avialability" placeholder="I am vialable Mondays and Fridays" class="form-twitter form-control">
                                </div>


                              </div>
                        </fieldset>

                        <button type="submit" name="applynow" class="btn btn-primary btn-block btn-flat">Apply Now</button>

                    

                      </div>
                      </div>
                    </div>
                  </div>

                </div>


                


          </form>


          <br>
          <br>

          <a href="login.html" class="text-center">I already have a membership</a>
          </div>
          <!-- /.form-box -->
          </div>


          <script>


            jQuery(document).ready(function () {

              /*
                  Fullscreen background
              */
              $.backstretch("assets/img/backgrounds/1.jpg");

              $('#top-navbar-1').on('shown.bs.collapse', function () {
                $.backstretch("resize");
              });
              $('#top-navbar-1').on('hidden.bs.collapse', function () {
                $.backstretch("resize");
              });

              /*
                  Form
              */
              $('.registration-form fieldset:first-child').fadeIn('slow');

              $('.registration-form input[type="text"], .registration-form input[type="password"], .registration-form textarea').on('focus', function () {
                $(this).removeClass('input-error');
              });

              // next step
              $('.registration-form .btn-next').on('click', function () {
                var parent_fieldset = $(this).parents('fieldset');
                var next_step = true;



                // MASSSSSS class="first-field"

                function checkRadioVal(name, classNam, fielderr) {
                  var radioName = name;

                  if ($('input[name=' + radioName + ']:checked').length) {
                    // at least one of the radio buttons was checked
                    $(classNam).html("");
                  }
                  else {
                    next_step = false;
                    $(classNam).html("<span class='alert alert-danger'>Please Select one <b class='close'>X</b> </span><br>");
                    $(fielderr).html("<span class='alert alert-danger'>Some info Missing, please scroll up and complete<b class='close'>X</b> </span><br>");
                  }
                }

                function checkTickVal(name2, classNam2, fielderr2) {
                  var radioName = name2;

                  // alert($('input[name="'+ radioName +'"]:checked').length );

                  if ($('input[name="' + radioName + '"]:checked').length > 0) {
                    // at least one of the radio buttons was checked
                    $(classNam2).html("");
                  }
                  else {
                    next_step = false;
                    $(classNam2).html("<span class='alert alert-danger'>Please Select Atleast one <b class='close'>X</b> </span><br>");
                    $(fielderr2).html("<span class='alert alert-danger'>Some info Missing, please scroll up and complete<b class='close'>X</b> </span><br>");
                  }
                }



                if ($(this).hasClass('first-next')) {
                  next_step = true;
                  checkRadioVal('grade', '.gradeerr', '.first-next-err');
                  checkRadioVal('less', '.termerr', '.first-next-err');
                  checkRadioVal('sess', '.sessioneerr', '.first-next-err');
                  checkRadioVal('start', '.starterr', '.first-next-err');

                }

                if ($(this).hasClass('second-next')) {
                  next_step = true;
                  checkRadioVal('gender', '.gendererr', '.second-next-err');
                  checkTickVal('availdate[]', '.dayerr', '.second-next-err');
                  checkTickVal('availtime[]', '.timeerr', '.second-next-err');


                }




                parent_fieldset.find('input[type="text"], input[type="password"], textarea').each(function () {
                  if ($(this).val() == "") {
                    $(this).addClass('input-error');
                    next_step = false;
                  }
                  else {
                    $(this).removeClass('input-error');
                  }
                });


                if (next_step) {
                  parent_fieldset.fadeOut(400, function () {
                    $(this).next().fadeIn();
                  });
                }

              });

              // previous step
              $('.registration-form .btn-previous').on('click', function () {
                $(this).parents('fieldset').fadeOut(400, function () {
                  $(this).prev().fadeIn();
                });
              });

              // submit
              $('.registration-form').on('submit', function (e) {

                $(this).find('input[type="text"]').each(function () {
                  if ($(this).val() == "") {
                    e.preventDefault();
                    $(this).addClass('input-error');
                  }
                  else {
                    $(this).removeClass('input-error');
                  }
                });

              });



              // MASAGWADI

              $('body').on('click', '.close', function () {
                $(this).parent().hide(200).removeClass('alert');
                $(this).hide(600);

              });




              // END MASA




            });



          </script>




          <?php
include('partials/footer.php');
?>