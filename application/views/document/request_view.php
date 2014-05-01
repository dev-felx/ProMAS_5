<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<script src="<?php echo base_url(); ?>assets/jquery/jquery-ui-1.10.3.custom/js/jquery-ui.js"></script>
<link type="text/css" rel="Stylesheet" href="<?php echo base_url(); ?>assets/jquery/jquery-ui-1.10.3.custom/css/jquery-ui.css" media="screen">
<script src="<?php echo base_url(); ?>assets/jquery/datatable/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/jquery/jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.min.js"></script>

<div class="container-fluid">
    <div class="row" >
        <div class='pull-left'><h4>Project Documents</h4></div>
<!--        <div class="btn-group pull-right">
            <button type="button" class="btn btn-success pull-right push_right_bit" >Share Document</button>
            <button type="button" class="btn btn-success pull-right push_right_bit " >Request Document</button>
        </div>-->
    </div>
    <div class="row" style="margin-bottom: 15px;">
        <div class="hr"><hr/></div>
    </div>


<div class="row-fluid">
<div class="col-sm-8" >
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
               foreach ($documents as $row ){
                   
                   $file_path = $row['file_path'];
                   
                   echo '<tr>';
                   echo '<td>'.$i.'</td>';
                   
                   foreach ($row as $key=> $value) {
                   if(($key == 'file_id')||($key == 'file_type')||($key == 'file_creator_id')||($key == 'file_path')||($key == 'space_id')){
                       continue;
                   }
                   if(($key=='file_status')&& $value==0){
                       echo '<td>Not Submited</td>';
                       continue;
                   }elseif(($key=='file_status')&& $value==1){
                       echo '<td>Submited</td>';
                       continue;
                   }
                   elseif(($key=='file_status')&& $value==2){
                       echo '<td>Approved</td>';
                       continue;
                   }
                      echo '<td>'.$value.'</td>';
                   }
                   echo '<td>';
                   ?>
                      
            <!--<a type="button" href="<?php //echo site_url(); ?>/project/file/preview/<?php// echo base64_encode($file_path); ?>" class="action_edit btn_edge badge_link btn btn-success btn-xs"><span class="glyphicon glyphicon-zoom-in push_right_bit"></span></a>-->
            <a type="button" href="<?php echo site_url(); ?>/project/file/download/<?php echo base64_encode($file_path);  ?>" class="action_view btn_edge btn btn-primary btn-xs"><span class="glyphicon glyphicon-download push_right_bit">Download</span></a>
                        
                  <?php echo '</td>';
                   echo '</tr>'; 
                   $i++;
                } 
            ?>
            </tbody>
            </table>
    </div>

<div class=" col-sm-4 " >
    
    <div id="doc_form">
    <div id="flip_req" >Request document</div>
    <form id="req_doc" class="" action="<?php echo site_url(); ?>/project/file/request" method="post">
       <div class="container-fluid">
        <?php if(isset($message)){ echo $message;}else {  ?>    
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
 </div>
    
    <div id="doc_form" style="margin-top: 20px">
    <div id="flip_share">Share Document</div>
    <form id="share_doc" class="" enctype="multipart/form-data" action="<?php echo site_url(); ?>/project/file/upload">
       <div class="container-fluid">
        <?php if(isset($message_share)){ echo $message_share;}else {  ?>    
        <?php } ?>
        <div class="form-group">
           <label class="control-label" for="title">Document name</label><?php show_form_error('name'); ?>
          <input class="form-control" type="text" id="title" name="name">
        </div>
       <div class="form-group">    
           <input type="file" name="userfile">
       </div>
       <div class="form-group">
            <label for="receiver">Share with</label><?php show_form_error(''); ?>
            <select id="receiver" class="form-control" name="">
                <option>Coordinator</option>
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
           <button class="btn btn-sm btn-success" type="submit">Share</button>
       </div>

      <div class="clearfix"></div>
</div>
</form>
    </div>
</div>
</div>
</div>
    
<script>
    
    $(document).ready(function(){
        
        $('#table_id').dataTable({
            "bJQueryUI": true,
        });
    });
    
//    $("#flip_req").click(function(){
//        $("#req_doc").slideToggle("slow");
//    });
//    $("#flip_share").click(function(){
//        $("#share_doc").slideToggle("slow");
//    });
    $("#receiver").change(function() {
        if($(this).val() == 'Choose groups'){
            $("#groups").removeClass('hidden');
        }else{
            $("#groups").addClass('hidden');
        }
    });
    
    $(function(){
    
        $( "#datepicker" ).datepicker({ maxDate: "+1y"});
    });
    
</script>