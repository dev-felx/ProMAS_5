<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if($user =='student'){
    $id= 'student_id';
    }else{   $id = 'user_id';
        
        }
?>

<div class="container-fluid">
    
    <div class='row' style="margin-bottom: -5px; ">
        <div class='pull-left'><h4>Manage Users - <?php echo ucfirst($user);   ?></h4></div>
        <div class="btn-group pull-right">
            <button type="button" class="btn btn-success pull-right push_left_bit dropdown-toggle" data-toggle="dropdown" >Add <?php echo ucfirst($user);   ?></button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo site_url(); ?>/manage_users/add_user/individual/<?php echo $user; ?>">Individual</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo site_url(); ?>/manage_users/add_group/group/<?php echo $user; ?>">Group</a></li>
                </ul>

        </div>
    </div>
    
    <div class="row">
        <hr style="border: none; height: 1px; background:#0093D0;"/>
    </div>
    
    <div class='row'>
        <div  id='reg_form' class=" col-sm-10 col-sm-offset-">
        
            <?php if(isset($message)){ echo $message ; } else { ?>
                     <div class="alert alert-info text-center"><b>Edit <?php echo $user_data[0]['first_name']; ?>'s profile</b></div>
                   <?php } ?>
            <form  class="container-fluid" method="POST" action="<?php echo site_url(); ?>/manage_users/manage/update_user/<?php echo $user_data[0][$id]; ?>/<?php echo $user; ?>" role="form">

                 
                        <?php if($user == 'student'){ ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label" for="inputReg_no">Registration </label><?php show_form_error('reg_no'); ?>
                                    <input name="reg_no" type="text" class="form-control" id="inputReg_no" value='<?php echo $user_data[0]['registration_no']; ?>'>
                                </div>
                            </div>
                        </div>
                        <?php }
 
                        else {
                        ?>
                        
                        <?php } ?>

                        <div class="row">
                            <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label" for="inputFirstName"> First Name: </label>
                                        <input name="fname" type="text" class=" form-control" id="inputFirstName"  value="<?php echo $user_data[0]['first_name']; ?>">
                                    </div>
                            </div>
                            </div>
                         <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label" for="inputLastName"> Last Name: </label>
                                        <input name="lname" type="text" class="form-control" id="inputLastName" value="<?php echo $user_data[0]['last_name']; ?>">
                                    </div>
                                </div>
                         </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label" for="inputPhoneNumber"> Phone Number </label>
                                    <input name="phone" type="text" class="form-control" id="inputPhoneNumber" value="<?php echo $user_data[0]['phone_no']; ?>">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group" >
                                    <label class="control-label" for="inputEmail"> Email </label>
                                    <input name="email" type="text" class="form-control" id="inputEmail" value="<?php echo $user_data[0]['email']; ?>">
                                    
                                </div>
                            </div>
                        </div>
                        
                        <?php if($user == 'student'){ ?>
                        
                        <div class='hr'><hr/></div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="" class="control-label">Course</label>
                                        <select  name="course" class="form-control" >
                                          <option value='<?php echo $user_data[0]['course_id']; ?>' ></option>
                                          <?php foreach ($course_data as $value){ ?>
                                          <option value="<?php echo $value['course_id'];  ?>"><?php echo $value['name']; ?></option>';
                                          <?php }?>
                                        </select>
                                </div>
                            </div>
                        </div>
                
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="" class="control-label">Project(Group)</label>
                                        <select  name="project" class="form-control" >
                                            <option value='<?php echo $user_data[0]['project_id']; ?>'></option>
                                          <?php foreach ($project_data as $value){ ?>
                                          <option value="<?php echo $value['project_id'];  ?>"><?php echo $value['group_no'].': '. $value['title']; ?></option>';
                                          <?php }?>
                                        </select>
                                </div>
                            </div>
                        </div>
                        
                <div class='hr'><hr/></div>
                        
                        <?php }  ?>

                        <div class="row">
                            <div class="col-sm-6">
                                <label class="control-label" for="inputUsername">Account Status</label>
                            </div>
                       </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="checkbox-inline">
                                        <input type="hidden" name="reg_status" value="0" />
                                        <label class="checkbox-inline"><input name='reg_status' type="checkbox"<?php  if($user_data[0]['reg_status']==1){ echo 'checked'; } ?>  value="1"  >Registered</label>
                                    </div>
                                    <div class="checkbox-inline">
                                        <input type="hidden" name="acc_status" value="0" />
                                        <label class="checkbox-inline"><input name='acc_status' type="checkbox" <?php if($user_data[0]['acc_status']==1){ echo 'checked'; } ?>  value="1" >Enabled</label>
                                    </div>
                            </div>
                        </div>
                       </div>
                        
                <div class='hr'><hr/></div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label" for="inputUsername">Roles</label>
                                    
                                    <?php if($user == 'student'){ ?>    
                                        <div class="checkbox">
                                        <label><input disabled type="checkbox" <?php echo 'checked'; ?>>Student</label>
                                        </div>
                                    <?php  } else { ?>
                                    <div class="checkbox">
                                        <input type="hidden" name="admin_role" value="0" />
                                        <label><input name="admin_role" type="checkbox"<?php 
                                        
                                        for($i = 0; $i < count($user_data);$i++){
                                            if($user_data[$i]['role']=='administrator')
                                        echo 'checked'; } ?> value="1" name="admin_role">Administrator</label>
                                    </div>
                                    <div class="checkbox">
                                        <input type="hidden" name="coord_role" value="0" />
                                        <label><input type="checkbox"<?php 
  
                                        for($i = 0; $i < count($user_data);$i++){
                                            if($user_data[$i]['role']=='coordinator')
                                        echo 'checked'; } ?> value="1" name="coord_role"  >Coordinator</label>
                                    </div>
                                    <div class="checkbox">
                                        <input type="hidden" name="super_role" value="0" />
                                        <label><input type="checkbox"<?php 
                                        
                                        for($i = 0; $i < count($user_data);$i++){
                                            if($user_data[$i]['role']=='supervisor')
                                        echo 'checked'; }  ?> value="1" name="super_role" >Supervisor</label>
                                    </div>
                                    <?php } ?> 
                                </div>
                            </div>
                       
                        </div>

                <div class='hr'><hr/></div>
                        <div class='row'>
                        <div class=" form-group col-sm-8">
                            <div class='pull-left '>
                                <button class="btn btn-success btn-sm " type='submit' role='button' >Save</button>
                                <a class="btn btn-danger btn-sm "  role="button" onclick="return confirm('Are you sure you want to delete <?php echo ucfirst($user_data[0]['first_name']) .' '.ucfirst($user_data[0]['last_name']); ?>?')" href="<?php echo site_url(); ?>/manage_users/manage/delete/<?php echo $user_data[0][$id]; ?>/<?php echo $user; ?>">Delete</a>
                                <a class="btn btn-sm btn-primary" onclick="" role="button" >Cancel</a>
                             </div>
                         </div>
                         </div>

        </form>

    

  </div>
    </div>
    </div>
</div>