<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div class='container-fluid'>
 <?php 
    $this->load->view('manage_users/manage_user_head_view');
           
    if(isset($results) && !isset($exists)){
    ?>
    <div class="row">
        <div class="table-responsive col-md-8">
            <table class="table table-striped table-bordered table-condensed">
                <p class="text-center alert alert-success"><b>The following users registered and email sent</b></p>
            <!-- table heading -->
        <tr>
            <?php   
                echo '<th>No</th>';
                foreach ($results[0] as $key => $value) {
                    echo '<th>'.$key.'</th>';
                }
            ?>
        </tr><!-- table body -->
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
 elseif(isset($exists) && !isset($results)){
    ?>           
    <div class="row">
        <div class="table-responsive col-md-8" >
            <?php if($user == 'student'){ ?>
            <p class="alert alert-warning text-center"><b>The following students were not registered, registration number already exists</b></p>
            <?php }else{ ?>
            <p class="alert alert-warning text-center"><b>The following users were not registered, email(username) already exists</b></p>
            <?php }?>
            <table class="table table-striped table-bordered table-condensed">
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
           ?></table>
        </div>
     </div>
    <?php }elseif( isset($results) && isset($exists)){?>
    <div class="row">
        <div class="table-responsive col-md-8">
            <table class="table table-striped table-bordered table-condensed">
                <p class="text-center alert alert-success"><b>The following users registered and email sent</b></p>
            <!-- table heading -->
        <tr>
            <?php   
                echo '<th>No</th>';
                foreach ($results[0] as $key => $value) {
                    echo '<th>'.$key.'</th>';
                }?>
        </tr><!-- table body -->
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
            <?php if($user == 'student'){ ?>
                <p class="alert alert-warning text-center"><b>The following students were not registered, registration number already exists</b></p>
                <?php }else{ ?>
                <p class="alert alert-warning text-center"><b>The following users were not registered, email(username) already exists</b></p>
                <?php }?>
                <table class="table table-striped table-bordered table-condensed">
                <!-- table heading -->
        <tr><?php   
                echo '<th>No</th>';
                foreach ($exists[0] as $key => $value) {
                    echo '<th>'.$key.'</th>';
                }
            ?>
        </tr><!-- table body -->
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
           ?></table>
        </div>
     </div>
    <?php } ?>
</div>