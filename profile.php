<?php
session_start();
include('config/functions.php');
include('partials/header.php');

if (!isset($_SESSION['masagwadi_tmp'])) {
  redirect_to("login");
}else {
  // $_SESSION['timestamp'] = time(); //set new timestamp
}

if(time() - $_SESSION['timestamp'] > 10) { //subtract new timestamp from the old one
  unset($_SESSION['masagwadi_tmp'], $_SESSION['timestamp']);
  session_destroy();
  $_SESSION['logged_in'] = false;
  redirect_to("login"); //redirect to index.php
  exit;
}else {
  $_SESSION['timestamp'] = time(); //set new timestamp
}

$userid = $_SESSION['masagwadi_tmp']['userid'];

?>

<!-- <script>
window.setTimeout(function(){

// Move to a new location or you can do something else
window.location.href = "logout";

}, 5000);
</script> -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <!-- <li><a href="#">Examples</a></li> -->
        <li class="active">User profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="../../dist/img/Profile.png" alt="User profile picture">

              <h3 class="profile-username text-center"><?php echo $_SESSION['masagwadi_tmp']['name']." ".$_SESSION['masagwadi_tmp']['lastname'];  ?></h3>

              <p class="text-muted text-center"><?php echo $_SESSION['masagwadi_tmp']['user_type']; ?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b><?php echo $_SESSION['masagwadi_tmp']['email']; ?></b> 
                </li>
                <li class="list-group-item">
                  <b><?php echo $_SESSION['masagwadi_tmp']['cell']; ?></b>
                </li>
                <li class="list-group-item">
                  <b><?php echo $_SESSION['masagwadi_tmp']['created_date']; ?></b> 
                </li>
              </ul>

              <a href="/book" class="btn btn-primary btn-block"><b>Book A Minder</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        

          
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Notices</a></li>
              <li><a href="#timeline" data-toggle="tab">Your Bookings</a></li>
              <li><a href="#settings" data-toggle="tab">Settings</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <!-- Post -->
                <div class="post">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image">
                        <span class="username">
                          <a href="#">Jonathan Burke Jr.</a>
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>
                    <span class="description">Shared publicly - 7:30 PM today</span>
                  </div>
                  <!-- /.user-block -->
                  <p>
                    Lorem ipsum represents a long-held tradition for designers,
                    typographers and the like. Some people hate it and argue for
                    its demise, but others ignore the hate as they create awesome
                    tools to help create filler text for everyone from bacon lovers
                    to Charlie Sheen fans.
                  </p>
                  <!-- <ul class="list-inline">
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
                    </li>
                    <li class="pull-right">
                      <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments
                        (5)</a></li>
                  </ul> -->
                </div>
                <!-- /.post -->

                <!-- Post -->
                <div class="post clearfix">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="../../dist/img/user7-128x128.jpg" alt="User Image">
                        <span class="username">
                          <a href="#">Sarah Ross</a>
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>
                    <span class="description">Sent you a message - 3 days ago</span>
                  </div>
                  <!-- /.user-block -->
                  <p>
                    Lorem ipsum represents a long-held tradition for designers,
                    typographers and the like. Some people hate it and argue for
                    its demise, but others ignore the hate as they create awesome
                    tools to help create filler text for everyone from bacon lovers
                    to Charlie Sheen fans.
                  </p>

              
                </div>
                <!-- /.post -->

              
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                <!-- The timeline -->
                <ul class="timeline timeline-inverse">

                 <?php
                    $sql = "SELECT * FROM bookings WHERE bookerid = $userid ";
                    global $dbConn;
                    $bankResult = $dbConn->query($sql) or die("Could not execute mysqli QUERY090 - I'm at 01 bank");
                    $row = dbFetchAssoc($bankResult);

                    do{
                      if (isset($row)){
                  ?>

                  <!-- timeline time label -->
                  <li class="time-label">
                        <span class="bg-red">
                          <?php echo $row["startdate"]." - ".$row["enddate"]; ?>
                        </span>
                  </li>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-envelope bg-blue"></i>

                    <div class="timeline-item">
                      <!-- <span class="time"><i class="fa fa-clock-o"></i> 12:05</span> -->

                      <h3 class="timeline-header"><a ><?php echo $row["service"]; ?></a>  reference: <?php echo $row["reference"]; ?></h3>

                      <div class="timeline-body">
                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles.
                      </div>
                      <div class="timeline-footer">
                        <a class="btn btn-primary btn-xs">View Booking</a>
                        <a class="btn btn-danger btn-xs">Delete</a>
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->

                <?php
                  }
                }while ($row = mysqli_fetch_assoc($bankResult));
                ?>
                
                </ul>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="settings">
                <form class="form-horizontal">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputName" placeholder="<?php echo $_SESSION['masagwadi_tmp']['name']; ?>" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail" placeholder="<?php echo $_SESSION['masagwadi_tmp']['email']; ?>" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Last Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="<?php echo $_SESSION['masagwadi_tmp']['lastname']; ?>" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Cell</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="<?php echo $_SESSION['masagwadi_tmp']['cell']; ?>" readonly>
                    </div>
                  </div>
                  <!-- <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                    </div>
                  </div> -->
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Password</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputSkills" placeholder="Password">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Confirm Password</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputSkills" placeholder="Password">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Update Profile</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <?php
include('partials/footer.php');
?>