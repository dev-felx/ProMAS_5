<?php

/* 
 * Author: Devid Felix
 * 
 * 
 */

if(isset($this->session->userdata['user_id'])){
    
    $user_id = $this->session->userdata['user_id'];
    $user_type = $this->session->userdata['type'];
}


?>


<div class="container-fluid">
    <div class='col-sm-6 col-sm-offset-3'>
        
        <div class='row'>
        
        <form id="reg_form" method="POST" action="<?php echo site_url(); ?>/manage_users/profile/update_profile/<?php echo $this->session->userdata['user_id']; ?>/<?php echo $this->session->userdata['type'] ?>" role="form">

            <div class="row">       
                    <h4 class="<?php if(isset($message)){ echo 'text-success'; } ?>">&nbsp;Personal details<?php if(isset($message)){ echo $message ; } ?></h4>
                 </div>

            <div class='row' >
                <div class="hr" style="margin-top:-1px"><hr/></div>
            </div>
                        
                <?php if($this->session->userdata['type'] == 'student')  { ?>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="control-label" for="inputReg_no">Registration </label>
                        <input <?php if(isset($form_mode)){ echo $form_mode; } ?> name="reg_no" type="text" class="form-control" id="inputReg_no" value='<?php echo $user_data[0]['registration_no']; ?>'>
                    </div>
                </div>
            </div>
               <?php } else {
                   ?>

            <div class="row">

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="inputSeniority" class="control-label">Seniority</label><?php show_form_error('seniority');  ?>
                        <select name="seniority" class="form-control" <?php if(isset($form_mode)){ echo $form_mode; } ?>>
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
                            <label class="control-label" for="inputFirstName"> First Name: </label><?php show_form_error('fname');  ?>
                            <input <?php if(isset($form_mode)){ echo $form_mode; } ?> name="fname" type="text" class=" form-control" id="inputFirstName" placeholder="First Name" value="<?php echo $user_data[0]['first_name']; ?>">
                        </div>

                </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" for="inputLastName"> Last Name: </label><?php show_form_error('lname');  ?>
                            <input <?php if(isset($form_mode)){ echo $form_mode; } ?> name="lname" type="text" class="form-control" id="inputLastName" placeholder="LastName" value="<?php echo $user_data[0]['last_name']; ?>">
                        </div>
                    </div>
             </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="control-label" for="inputPhoneNumber"> Phone Number: </label><?php show_form_error('phone');  ?>
                        <input <?php if(isset($form_mode)){ echo $form_mode; } ?> name="phone" type="text" class="form-control" id="inputPhoneNumber" value="<?php echo $user_data[0]['phone_no']; ?>">
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group" >
                        <label class="control-label" for="inputEmail"> Email: </label>
                        <p class="form-static"><?php echo $user_data[0]['email']; ?></p>
                    </div>
                </div>
            </div>
            
            <?php if($this->session->userdata['type'] != 'student' ) { ?>
            
            <div class='row '>
                <h4 class=''>&nbsp; Work details</h4>
            </div>
            
            <div class='row' >
               <div class="hr" style="margin-top:-1px"><hr/></div>
            </div>
            
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group" >
                        <label for="inputOfficeLocation" class="control-label">Office Location</label><?php show_form_error('office');  ?>
                        <input <?php if(isset($form_mode)){ echo $form_mode; } ?> name="office" type="text" class="form-control" id="inputOfficeLocation" value="<?php echo $user_data[0]['office_location']; ?>" >
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                            <label for="inputCollege/School" class="control-label">College/School</label><?php show_form_error('college');  ?>
                            <select <?php if(isset($form_mode)){ echo $form_mode; } ?> name="college" class="form-control" >
                              <option></option>
                                    <?php foreach ($college_data as $value){ ?>
                                    <option value="<?php echo $value['college_id'];  ?>"><?php echo $value['shortform']; ?></option>';
                                    <?php }?>
                            </select>
                    </div>
                </div>
                        
                <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputDepartment" class="control-label">Department</label><?php show_form_error('dept');  ?>
                            <select name="dept" class="form-control" <?php if(isset($form_mode)){ echo $form_mode; } ?>>
                                <option ></option>
                                <?php foreach ($depart_data as $value){ ?>
                                <option value="<?php echo $value['department_id'];  ?>"><?php echo $value['name']; ?></option>';
                    
                    <?php }?>
                            </select>
                        </div>
                </div>
            </div>
            
            <?php }
            
            else{ ?>
            
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="control-label" for="inputCourse">Course</label><?php show_form_error('course_id');  ?>
                        <select name="course_id" class="form-control" <?php if(isset($form_mode)){ echo $form_mode; } ?>>
                                <option ></option>
                                <?php foreach ($course_data as $value){ ?>
                                <option value="<?php echo $value['course_id'];  ?>"><?php echo $value['name']; ?></option>';
                                <?php }?>
                            </select>
                    </div>
                </div>
            </div>
            
            
            <?php }?>
            <div class='row'>
                <div class=" form-group col-sm-6">
                    <div class='pull-left'>
                        <?php if(isset($save)){ echo $save;} else {  ?>
                        <a class="btn btn-primary"  role="button" href="<?php echo site_url(); ?>/manage_users/profile/edit_profile/<?php echo $this->session->userdata['user_id']; ?>/<?php echo $this->session->userdata['type']; ?>">Edit</a>
                        <?php } ?>
                        <a class="btn btn-info"  role="button" href=''>Cancel</a>
                     </div>
                </div>
            </div>
            
        </form>
        </div>    
    </div>
</div>
