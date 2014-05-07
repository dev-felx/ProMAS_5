<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div id="req_doc">
    <div id="flip_req" >Request document</div>
    <form  class="" action="<?php echo site_url(); ?>/project/file/request" method="post">
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

