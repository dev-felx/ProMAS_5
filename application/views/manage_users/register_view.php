<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div id='add_group' class='container-fluid'>
 <?php 
    $this->load->view('manage_users/manage_user_head_view');
           
    if(isset($results) && !isset($exists)){
    ?>
                
    <div class="row">
        <div class="table-responsive col-md-8">
            <table class="table table-striped table-bordered table-condensed">
                <h4>Users registered and email sent</h4>
            <!-- table heading -->
        <tr>
            <?php   
                echo '<th>No</th>';
                foreach ($results[0] as $key => $value) {
                    echo '<th>'.$key.'</th>';
                }
            ?>
        </tr>
            
                <!-- table body -->
        <?php 
        $i=1;
           foreach ($results as $row) {
               echo '<tr>';
               echo '<td>'.$i.'</td>';
               foreach ($row as $value) {
                   echo '<td>'.$value.'</td>';
               }
            
               $i++;
               }
               echo '</tr>';  
           ?>
                
            </table>
        </div>
     </div>
               
 <?php }//end if
 
 elseif(isset($exists) && !isset ($results)){
                    
    ?>           
    
    
    <div class="row">
        <div class="table-responsive col-md-8">
            <table class="table table-striped table-bordered table-condensed">
                <?php if($user == 'student'){ ?>
                <h4>Unregistered students, user(s) with same registration number exists</h4>
                <?php }else{ ?>
                <h4>Unregistered users, user(s) with same email(username) already exists</h4>
                <?php }?>
            <!-- table heading -->
        <tr>
            <?php   
                echo '<th>No</th>';
                foreach ($exists[0] as $key => $value) {
                    echo '<th>'.$key.'</th>';
                }
            ?>
        </tr>
            
                <!-- table body -->
        <?php 
        $j=1;
           foreach($exists as $row) {
               echo '<tr>';
               echo '<td>'.$j.'</td>';
               foreach ($row as $value) {
                   echo '<td>'.$value.'</td>';
               }
               $j++;
               }
               echo '</tr>';  
           ?>
                
            </table>
        </div>
     </div>
    
    <?php }//end if  
    
    elseif( isset($results) && isset($exists)){?>
    
    <div class="row">
        <div class="table-responsive col-md-8">
            <table class="table table-striped table-bordered table-condensed">
                <h4>Users registered and email sent</h4>
            <!-- table heading -->
        <tr>
            <?php   
                echo '<th>No</th>';
                foreach ($results[0] as $key => $value) {
                    echo '<th>'.$key.'</th>';
                }
            ?>
        </tr>
            
                <!-- table body -->
        <?php 
        $i=1;
           foreach ($results as $row) {
               echo '<tr>';
               echo '<td>'.$i.'</td>';
               foreach ($row as $value) {
                   echo '<td>'.$value.'</td>';
               }
            
               $i++;
               }
               echo '</tr>';  
           ?>
                
            </table>
        </div>
     </div>
    
    <div class="row">
        <div class="table-responsive col-md-8">
            <table class="table table-striped table-bordered table-condensed">
                <?php if($user == 'student'){ ?>
                <h4>Unregistered students,user with same registration number exists</h4>
                <?php }else{ ?>
                <h4>Unregistered users, user with same email(username) already exists</h4>
                <?php }?>
                <!-- table heading -->
        <tr>
            <?php   
                echo '<th>No</th>';
                foreach ($exists[0] as $key => $value) {
                    echo '<th>'.$key.'</th>';
                }
            ?>
        </tr>
            
                <!-- table body -->
        <?php 
        $j=1;
           foreach($exists as $row) {
               echo '<tr>';
               echo '<td>'.$j.'</td>';
               foreach ($row as $value) {
                   echo '<td>'.$value.'</td>';
               }
               $j++;
               }
               echo '</tr>';  
           ?>
                
            </table>
        </div>
     </div>
    
    
        
        <?php } ?>
</div>
