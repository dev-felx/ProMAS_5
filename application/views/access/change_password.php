<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Meta -->  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Title -->
    <title><?php if(isset($title)){ echo $title;}else{echo 'ProMAS';} ?></title>

    <!-- Style-sheets -->
    <link type="text/css" rel="Stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css">
    <link type="text/css" rel="Stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap_tweaks.css" >
    <link type="text/css" rel="Stylesheet" href="<?php echo base_url(); ?>assets/css/main.css" >
        
    <!-- Scripts -->
    <script src="<?php echo base_url(); ?>assets/jquery/jquery-1.11.0.js"></script>
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
  </head>
  <body>
       
          <nav class=" navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">ProMAS</a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" >
                    <ul class="nav navbar-nav navbar-right">                            
                        <li><a href="<?php echo site_url(); ?>/access/login">Sign In</a></li>
                    </ul>
                </div>
            </div>
        
          </nav>
      
      <div class="container">
          
          <div class="row-fluid">
              <div class=" page-header">
                  <h3 class="text-center">Change Password</h3>
              </div>
          </div>    
              
          <div class="row-fluid">
              <?php if (isset($message)){ echo $message; 
              } else { ?>
              <div class="alert alert-info fade in text-center"> Enter your email, a link to reset your password will be sent to you.</div>

                  <?php } ?>
          </div>

          <form class="form-horizontal" action="<?php echo site_url(); ?>/access/password/validate_password/<?php echo $user_type; ?>/<?php echo $user_id; ?>" method="POST" role="form">
          
              <div class="form-group">
                  <label for="inputPassword" class="col-sm-2 control-label">New Password</label>
                  <div class="col-sm-5">
                      <input name="password" type="password" class="form-control" id="inputPassword" placeholder="Password">
                  </div>
              </div>
        
              <div class="form-group">
                  <label for="inputPasswordCon" class="col-sm-2 control-label">Confirm Password</label>
                  <div class="col-sm-5">      
                      <input name="password_con" type="password" class="form-control" id="inputPasswordCon" placeholder="Confirm Password">
                  </div>
              </div>


              <div class="form-group" >
                  <div class="col-sm-offset-2 col-sm-2">  
                  <button name="submit" type="submit" class="btn btn-primary btn-block">Change</button>
                  </div>
              </div>
          
          </form>
          
          <div class="row-fluid">
              <hr>
          </div>

      </div>

                   