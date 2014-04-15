<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

 

<div class='container-fluid'>
    
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
        <div class="">
            <hr style="border: none; height: 2px; background:#0093D0;"/>
        </div>
    </div>
    
    <div class="row col-sm-7">
         <h4 class="text-left ">Upload a File</h4>
    </div> 

    <div class='row'>
     
       <div class="col-sm-7">

           <div id='upload_file' >
               <div class='container-fluid'>
               <?php if(!isset($message)) { ?>

                   <h5>Note: Uploaded file should adhere format specified on the template,</h5> 
                   <h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                       The maximum size of an uploaded file for this application is 2MB.</h5>

               <?php } else{ echo "<div style='height: 40px' class='alert-danger text-center'><b>". $message. '</b></div>'; }?>

           <!--Upload form-->
           <form method="POST" class=" form-horizontal" role="form" enctype="multipart/form-data" action="<?php echo site_url(); ?>/manage_users/add_group/upload/<?php echo $user; ?>">

               <div class="form-group">
                    <div class='col-sm-8 '>
                        <label class="control-label" for="friedName">Friendly Name: <?php show_form_error('fName'); ?> </label>
                        <input type="text" class="form-control"  name="fName">
                    </div>
                </div>

               <div class="form-group">
                    <div class='col-sm-8 '>
                        <label class="control-label" for="uploadForm_file"> File to Upload: </label>
                        <input type="file" name="userfile">
                    </div>
                </div>  

               <div class="form-group">
                    <div class='col-sm-8 '>
                        <button name="upload" id="upload_button" type="submit" class="btn btn-primary ">Upload</button>
                    </div>
               </div>

            </form>
            </div>
           <!--end upload form-->
           </div>
        </div>
      </div>
    </div>
