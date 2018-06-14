<body class="hold-transition skin-blue sidebar-mini sidebar-collapse fixed ">

    <header class="main-header">
        <!-- Logo -->
        <a href="/" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini">
                <b>A</b>LT</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">
                <b>Admin</b>LTE</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                    <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope-o btn btn-danger btn-sm"> Conatct Details</i>
                            <!-- <span class="label label-success">!</span> -->
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">Contact Details</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <li>
                                        <!-- start message -->
                                        <a href="#">
                                            <!-- <div class="pull-left">
                                                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                                            </div> -->
                                            <h4>
                                                Email Address
                                               
                                            </h4>
                                            <p>info@minderz.co.za</p>
                                        </a>
                                    </li>
                                    <!-- end message -->
                                    <li>
                                        <a href="#">
                                            <!-- <div class="pull-left">
                                                <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                                            </div> -->
                                            <h4>
                                                Contact number
                                            </h4>
                                            <p>021 025 2525</p>
                                        </a>
                                    </li>
                                    
                           
                                </ul>
                            </li>
                            <!-- <li class="footer">
                                <a href="#">See All Messages</a>
                            </li> -->
                        </ul>
                    </li>
                
      
                    <?php if (isset($_SESSION['masagwadi_tmp'])) {
                    ?>

                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="dist/img/Profile.png" class="user-image" alt="User Image">
                            <span class="hidden-xs"><?php echo $_SESSION['masagwadi_tmp']['name']." ".$_SESSION['masagwadi_tmp']['lastname'];  ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="dist/img/Profile.png" class="img-circle" alt="User Image">

                                <p>
                                <?php echo $_SESSION['masagwadi_tmp']['name']." ".$_SESSION['masagwadi_tmp']['lastname'];  ?>
                                    <small>Member since <?php $date = date_create($_SESSION['masagwadi_tmp']['created_date']); echo date_format($date, 'd-m-Y');  ?></small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <!-- <li class="user-body">
                                <div class="row">
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Followers</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Sales</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Friends</a>
                                    </div>
                                </div>
                                /.row
                            </li> -->
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="/profile" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="/logout" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <?php
                    }
                    ?>


                    <!-- Control Sidebar Toggle Button -->
                    <!-- <li>
                        <a href="#" data-toggle="control-sidebar">
                            <i class="fa fa-gears"></i>
                        </a>
                    </li> -->
                </ul>
            </div>
        </nav>
    </header>
 
   <?php
    include('partials/aside.php');
   ?>