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

                
            </div>
        
          </nav>
      
      <div class="container">
          
          <div class="row-fluid">
              <div class=" page-header">
                  <h3 class="text-center">User Registration</h3>
              </div>
          </div>    
              
          <div class="row-fluid">
              <?php if (isset($message)){ echo $message; 
              } else { ?>
              <div class="alert alert-info fade in text-center">Hello <?php echo $this->session->userdata['fname']; ?> , In order to login you must complete registration</div>

                  <?php } ?>
          </div>
      

          <form id="reg_form" class="col-sm-8 col-sm-offset-2 " action="<?php echo site_url(); ?>/manage_users/register_user/register" method="POST" role="form">

                <h4 style="font-family:Adobe Ming Std L"> Personal Details</h4>

                <div class="hr"><hr></div>
    
                <?php if($this->session->userdata['type'] != 'student'){ ?>  
                <div class="row">

                  <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputSeniority" class="control-label">Seniority</label><?php show_form_error('seniority'); ?>
                            <select value="<?php echo $userdata[0]['seniority']; ?>" name="seniority" class="form-control">
                            }
                                <option></option>
                                <option>Professor</option>
                                <option>Associate Professor</option>
                                <option>Doctor</option>
                                <option>Senior Lecturer</option>
                                <option>Lecturer</option>
                                <option>Assistant Lecturer</option>
                                <option>Tutorial Assistant</option>
                            </select>
                        </div>
                    </div>
                 </div>
              <?php } ?>
                
                <div class="row">
                    <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label" for="inputFirstName"> First Name</label><?php show_form_error('fname'); ?>
                                <input name="fname" type="text" class=" form-control" id="inputFirstName" value="<?php echo $userdata[0]['first_name']; ?>">
                            </div>
                        
                    </div>

                 </div>
                    
                <div class="row">
                    
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label" for="inputLastName"> Last Name </label><?php show_form_error('lname'); ?>
                                <input name="lname" type="text" class="form-control" id="inputLastName" placeholder="LastName" value="<?php echo $userdata[0]['last_name']; ?>">
                            </div>
                        </div>
                
                    <?php if($this->session->userdata['type'] == 'student'){  ?>
                     
                        </div>
                        <div class="row">   
                     <?php } ?>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" for="inputPhoneNumber"> Phone Number</label><?php show_form_error('phone'); ?>
                            <input name="phone" type="text" class="form-control" id="inputPhoneNumber" placeholder="PhoneNumber" value="<?php echo $userdata[0]['phone_no']; ?>">
                        </div>
                    </div>
                <?php if($this->session->userdata['type'] != 'student') echo '</div>'; ?>
                
                
                <?php if($this->session->userdata['type'] == 'student'){  ?>
                
                <div class="col-sm-6">
                        <div class="form-group">
                                <label for="" class="control-label">Course</label><?php show_form_error('course'); ?>
                                <select name="course" class="form-control" >
                                  <option></option>
                                    <?php foreach ($course_data as $value){ ?>
                                    <option value="<?php echo $value['course_id'];  ?>"><?php echo $value['name']; ?></option>';
                                    <?php }?>
                                </select>
                        </div>
                    </div>
                    </div>        
                <?php } ?>
                
                <?php if($this->session->userdata['type'] !=='student'){ ?>
                <h4 style="font-family:Adobe Ming Std L"> Work Details</h4>
                <div class="hr"><hr></div>
                
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                                <label for="inputCollege/School" class="control-label">College/School</label><?php show_form_error('college'); ?>
                                <select name="college" onChange="updateDept(this.form);" class="form-control" >
                                  <option></option>
                                    <?php foreach ($college_data as $value){ ?>
                                    <option value="<?php echo $value['college_id'];  ?>"><?php echo $value['shortform']; ?></option>';
                                    <?php }?>
                                </select>
                        </div>
                    </div>
                 
                </div>
                
                <div class="row">
                    
                    <div class="col-sm-6">
                            <div class="form-group">
                                <label for="inputDepartment" class="control-label">Department</label><?php show_form_error('dept'); ?>
                                <select name="dept" class="form-control">
                                    <option></option>
                                    <?php foreach ($depart_data as $value){ ?>
                                    <option value="<?php echo $value['department_id'];  ?>"><?php echo $value['name']; ?></option>';
                                    <?php }?>
                                </select>
                            </div>
                    </div>
                    
                    <div class="col-sm-6">
                        <div class="form-group" >
                            <label for="inputOfficeLocation" class="control-label">Office Location</label><?php show_form_error('office'); ?>
                            <input name="office" type="text" class="form-control" id="inputOfficeLocation" placeholder="Office Location" value="<?php echo $userdata[0]['office_location']; ?>">
                        </div>
                    </div>
                </div>
                <?php } ?>
                <h4 style="font-family:Adobe Ming Std L"> New Password</h4>
                <div class="hr"><hr></div>
                
                <div class="row">
                    <div class="col-sm-6">
                            <div class="form-group">
                                <label for="inputPassword" class=" control-label">Password</label><?php show_form_error('password'); ?>
                                <input name="password" type="password" class="form-control" id="inputPassword" placeholder="Password">
                            </div>
                    </div>
                </div>
                
                <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="inputPasswordCon" class="control-label">Confirm Password</label><?php show_form_error('password_con'); ?>
                                <input name="password_con" type="password" class="form-control" id="inputPasswordCon" placeholder="Confirm Password">
                            </div>
                        </div>
                 </div>
                
                <div class="row">
                    <div class="col-sm-offset-0 col-sm-3">
                        <div class="form-group" >
                            <button name="submit" type="submit" class="btn btn-primary btn-block">Save</button>
                        </div>
                    </div>
                </div>
                
            </form>
          
          <script>
              
            document.myForm.mySelect.length = firstList.length;
            document.myForm.mySelect.options = firstList;
          </script>
            
      </div>
 
        </body>
       
</html>

