<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<script src="<?php echo base_url(); ?>assets/jquery/jquery-ui-1.10.3.custom/js/jquery-ui.js"></script>
<link type="text/css" rel="Stylesheet" href="<?php echo base_url(); ?>assets/jquery/jquery-ui-1.10.3.custom/css/jquery-ui.css" media="screen">


<div class="row-fluid">
<div class=" col-sm-8" >
<div class=" text- text-info" ><b>Submitted Documents</b></div>
<table id="table_id" class=" table table-bordered table-striped dataTable">
             <!--table heading--> 
            <thead >
            <tr>
                <?php            
                    foreach ($table_head as $key ) {
                        echo '<th class=\'sorting_asc\' role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="'.ucwords(str_replace('_', ' ',$key )). ':activate to sort column descending">'
                        .ucwords(str_replace('_', ' ',$key )).'</th>';
                    }
                    echo '<th>Actions</th>';
                ?>
                
            </tr>
            </thead>
             <!--table body--> 
            <tbody>
            <?php $i=1; 
               foreach ($documents as $row){
                   
                   $file_path = $row['file_path'];
                   
                   $row = array_slice($row, 1, 3);
                   
                   echo '<tr>';
                   echo '<td>'.$i.'</td>';
                   foreach ($row as $value) {
                      echo '<td>'.$value.'</td>';
                   }
                   echo '<td>';
                   ?>
                      
            <a type="button" href="<?php echo site_url(); ?>/project/file/preview/<?php echo base64_encode($file_path); ?>" class="action_edit btn_edge badge_link btn btn-success btn-xs"><span class="glyphicon glyphicon-zoom-in push_right_bit"></span>Preview</a>
            <a type="button" href="<?php echo site_url(); ?>/project/file/download/<?php echo base64_encode($file_path);  ?>" class="action_view btn_edge btn btn-primary btn-xs"><span class="glyphicon glyphicon-download push_right_bit"></span>Download</a>
                        
                  <?php echo '</td>';
                   echo '</tr>'; 
                   $i++;
                } 
            ?>
            </tbody>
            </table>
    </div>

<div class="col-sm-4 " >
    <form id="add_timeline" class="" action="<?php echo site_url(); ?>/project/file/request" method="post">
       <div class="container-fluid">
        <?php if(isset($message)){ echo $message;}else {  ?>    
       <div class="alert alert-info text-center">Request document</div>
        <?php } ?>
       
       <div class="form-group">
           <label class="control-label" for="title">Document name</label><?php show_form_error('title'); ?>
          <input class="form-control" type="text" placeholder="Title..." id="title" name="title">
       </div>
       
       <div class="form-group">
            <label for="receiver">Send To</label><?php show_form_error('receiver'); ?>
            <select id="receiver" class="form-control" name="receiver">
                <?php
                    foreach ($receiver as $value) {
                        echo "<option>".$value."</option>";
                    }
                ?>
           </select>
        </div>
       
       <div id='groups' class="form-group hidden">
       <?php if($this->session->userdata['type']=='supervisor'){
                    echo '<select multiple name="groups[]" class="form-control">';
                    foreach ($groups as $value) { ?>
                    <option value="<?php echo $value['project_id']; ?>"><?php echo $value['title']; ?></option> 
                  <?php  }
                  echo '</select>';
                } ?>
          </div>           
       <div class="form-group">
        <label for="Due Date" class=" control-label">Due date</label><?php show_form_error('duedate'); ?>
        <div class="">
            <input type="text" id="datepicker" class=" datepicker form-control" name="duedate" placeholder="Due Date">
       </div>
    </div>
     
       <div class="form-group">
           <button class="btn btn-sm btn-success" type="submit">Submit</button>
       </div>

      <div class="clearfix"></div>
</div>
</form>
</div >
</div>
<script>
$( "#receiver" ).change(function() {
        if($(this).val() == 'Choose groups'){
            $("#groups").removeClass('hidden');
        }else{
            $("#groups").addClass('hidden');
        }
    });
</script>

<script> $(function() {
    
        $( "#datepicker" ).datepicker({ maxDate: "+1y"});
        
    });
</script>