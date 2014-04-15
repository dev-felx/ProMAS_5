<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
        
<div id='add_group' class='container-fluid'>
 
    <div class='row' style="margin-bottom: -5px; ">
        <div class='pull-left'><h4>Manage Users - <?php echo ucfirst($user);   ?></h4></div>
        <div class="btn-group pull-right">
            <button type="button" class="btn btn-success pull-right push_left_bitdropdown-toggle" data-toggle="dropdown" >Add <?php echo ucfirst($user);   ?></button>
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
            
            <div class='row'>
                <div class="">
                 <?php if(isset($message)) { ?>
                 
                    <h4 class='pull-left text-success'><b><?php echo $message; ?></b></h4>
                    
                 <?php    } else{ ?>
                    <h5 class='pull-left'>To Register <?php echo ucfirst($user); ?>s using a file,<a href='<?php echo site_url(); ?>/manage_users/add_group/download/<?php echo $user; ?>'><b> Click here first to download a Template file</b></a></h5>
                 <?php } ?>
                    <div class='pull-right col-md-2 col-md-offset-3'>
                    <a class="btn btn-success btn-block "  role="button" href='<?php echo site_url(); ?>/manage_users/add_group/upload_file/<?php echo $user; ?>'>Upload a new file</a>
                    </div>
                </div>
           </div>
           
           <div class="row">
               <div>
                   <h4 class="text-left ">List of Uploads</h4>
               </div>
           </div> 
          
            
            <div class='row'>
                
                <div id='file_list' >
                   <?php 
                   if($user == 'supervisor' ){
                       
                       $file_path = get_filenames('./files/uploads/supervisor',TRUE);
                       $files_list = directory_map('./files/uploads/supervisor');

                   }
                   else if ($user == 'student' ){
                       
                       $file_path = get_filenames('./files/uploads/student',TRUE);
                       $files_list = directory_map('./files/uploads/student');

                   }
                   
                   $i=0;

                   if(!empty($files_list)){
                   foreach($files_list as $file){
                           
                    ?>          

                                <div class=" container-fluid list-group-item">
                                    
                                    <div class="pull-left"><?php echo $file; ?></div>
                                    
                                    <form action="<?php echo site_url(); ?>/manage_users/add_group/delete_file/<?php echo $user; ?>" method="POST">
                                        <button type='submit' onclick="return confirm('Are you sure you want to delete <?php echo $file; ?> file')" class="btn_edge btn btn-danger btn-sm pull-right push_left_bit">
                                            <span class="glyphicon glyphicon-trash push_right_bit">
                                            </span>Delete
                                        </button>
                                        <input type="hidden" name="file_path" value="<?php echo $file_path[$i]; ?>">
                                    </form>
                                    
                                    <form method="POST" action="<?php echo site_url(); ?>/manage_users/add_group/register_file/<?php echo $user; ?>">
                                        <button type='submit' href="" class="btn_edge btn btn-primary btn-sm pull-right">
                                            <span class="glyphicon glyphicon-registration-mark push_right_bit">
                                            </span>Register
                                        </button>
                                        <input type="hidden" name="file_path" value="<?php echo $file_path[$i]; ?>">
                                    </form>

                           
                                </div>



                <?php
                $i++;
                }//end for

                   } else {
                       echo '<div  class="alert alert-info text-center">No files have been uploded</div>';
                   }
                ?>
               <p><?php// echo $links; ?></p>

               <!--end upload form-->
                  
               </div>
            </div>
            
            
       </div>
   