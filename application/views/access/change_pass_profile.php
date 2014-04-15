<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

if(isset($this->session->userdata['user_id'])){
    
    $user_id = $this->session->userdata['user_id'];
    $user_type = $this->session->userdata['type'];
}

?>

<div class="container-fluid">
   
    <div class='row'>
    <div class="col-sm-6 col-sm-offset-3">
    
        <div class='' style="margin-bottom: -15px; ">
            <h4 class='text-center'>Change Password</h4>
            <hr style="border: none; height: 1px; background:#0093D0;"/>
        </div>
    <form id="reg_form" class="" action="<?php echo site_url(); ?>/access/password/validate_pass_profile" method="POST" role="form">


        <input name="user_id" type="hidden" value="<?php if(isset($user_id)) echo $user_id; ?>">
        <input name="user_type" type="hidden" value="<?php if(isset($user_type)) echo $user_type; ?>">

         <span><?php if (isset($message)){ echo "<h4 class=' text-center text-success'><b>".$message."</b></h4>"; }?>
         </span>   

        <?php if(isset($user_id) && isset($user_type)) { ?>
       
        <div class="row">
            <div class="col-sm-10">
                    <div class="form-group">
                        <label for="currPassword" class=" control-label">Current Password:&nbsp;<?php echo show_form_error('curr_password'); ?></label>
                        <input name="curr_password" type="password" class="form-control" id="currPassword" placeholder="Current Password">
                    </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-10">
                    <div class="form-group">
                        <label for="inputPassword" class=" control-label">New Password:&nbsp;<?php echo show_form_error('password'); ?></label>
                        <input name="password" type="password" class="form-control" id="inputPassword" placeholder="Password" value="<?php echo set_value('password');?>">
                    </div>
            </div>
            </div>

        <div class="row">
                <div class="col-sm-10">
                    <div class="form-group">
                        <label for="inputPasswordCon" class="control-label">Confirm Password:&nbsp;<?php echo show_form_error('password_con'); ?></label>
                        <input name="password_con" type="password" class="form-control" id="inputPasswordCon" placeholder="Confirm Password" value="<?php echo set_value('password_con');?>">
                    </div>
                </div>

        </div>

        <div class="row">
            <div class="col-sm-offset-0 col-sm-3">
                <div class="form-group" >
                    <button name="submit" type="submit" class="btn btn-primary btn-block">Change</button>
                </div>
            </div>
        </div>

    <?php } ?>
    </form>
        
    </div>
    </div>
</div>

                   