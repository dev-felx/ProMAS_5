<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if($user=='student'){
                   $id= 'student_id';
               }
               else{
                   $id = 'user_id';
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
    
    <div class="row">
    <div class="col-sm-10">
    <div class="container-fluid" id="reg_form">
    
        <ul id="myTab" class="nav nav-tabs ">
          <li class="active"><a href="#profile" data-toggle="tab" >Profile details</a></li>
          <?php if(($user=='student') || ($user=='supervisor')) { ?>
          <li><a href="#project" data-toggle="tab" >Project details</a></li>
          <?php } ?>
        </ul>
        
    
        <div class='tab-content'>
            <div id='profile' class="tab-pane fade in active">
                <table class="table table-hover table-bordered ">

                  <?php echo '<tr class=\'info\'>'; ?>
                      <th><strong>Attribute</strong></th>
                      <th><strong>Value</strong></th>

                  <?php echo '</tr>';  
                   foreach ($user_data[0] as $key => $value) {
                      echo '<tr>';
                      
                       if($user != 'student'){
                           
                           if(($key=='user_id')||($key=='role_id')||($key=='department_id')||($key=='shortform')||($key=='college_id'))
                           continue;
                      }
                       if($user == 'student'){
                           
                           if(($key=='student_id')||($key=='project_id')||($key=='group_id')||($key=='course_id')||($key=='department_id'))
                          continue;
                      }
                      
                       if(($key=='password')||($key=='hashed_token')||($key=='token_expire')){
                          continue;
                      }
                      
                      
                       
                       ?>
                      <td><strong><?php echo ucwords(str_replace('_', ' ',$key)).'</strong>'?></td>
                      <td><?php
                      //writting words instead of values
                      if(($key=='acc_status')&& $value==1){
                          echo 'Not Expired';
                          continue;
                      }
                      elseif(($key=='acc_status')&& $value==0){
                          echo 'Expired';
                          continue;
                      }
                      
                      if(($key=='reg_status')&& $value==1){
                          echo 'Registered';
                          continue;
                      }
                      elseif(($key=='reg_status')&& $value==0){
                          echo 'Not Registered';
                          continue;
                      }
                      
                      echo $value; 
                      
                      ?></td>
                  <?php echo '</tr>'; } ?> 

                </table>
            </div>
            
        <?php if($user=='student'){ ?>
        
        <div id='project' class="tab-pane fade">
            <form role="">        
            <div class="form-group">
                        <label for="title">Title</label>
                        <div class="well well-sm"><?php echo $project_data[0]['title']; ?></div>
                        <p class="form-control-static"></p>
                    </div>
                
                    <div class="form-group">
                        <label for="title">Description</label>
                        <div class="well well-sm"><?php echo $project_data[0]['description']; ?></div>
                    <p class="form-control-static"></p>    
                    </div>
                </form>
        </div>
         
            <?php }
         elseif($user= 'supervisor') {
            ?>
        
            <div id='project' class="tab-pane ">
                
                <h4>Group(s) Supervising</h4>

                
                    <div class="panel-group" id="accordion">

                        <?php foreach($project_data as $row){ ?>
                        <div class="panel ">
                              <div class="panel-heading panel-danger">
                                  <h4 class="panel-title ">
                                      <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $row['group_no']; ?>">
                                    <?php echo 'Group no:'.$row['group_no']. ' - Title:'. $row['title']; ?>
                                    </a>
                                  </h4>
                              </div>

                              <div id="<?php echo $row['group_no']; ?>" class="panel-collapse  collapsing">
                                  <div class="panel-body">
                                      <h5><b>Project description</b></h5>
                                   <?php echo $row['description']; ?>
                                  </div>
                              </div>

                        </div>

                    <?php } ?>
                    </div>
                
            </div>
        
        
         <?php   } ?>
    
        </div>
        <div class="hr"><hr/></div>
        <a class="btn btn-primary"  role="button" href='<?php echo site_url(); ?>/manage_users/manage/edit/<?php echo $user_data[0][$id]; ?>/<?php echo $user; ?>'>Edit Profile</a>

    </div>
        
    </div>
</div>
    </div>

<script>    
    $('#myTab a[href="#project"]').click(function (e) {
      e.preventDefault();
    $(this).tab('show');
    });

        $('#myTab a[href="#profile"]').click(function (e) {
      e.preventDefault();
    $(this).tab('show');
    });
</script>