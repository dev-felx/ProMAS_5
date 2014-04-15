<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<script src="<?php echo base_url(); ?>assets/jquery/jquery-ui-1.10.3.custom/js/jquery-ui.js"></script>
<link type="text/css" rel="Stylesheet" href="<?php echo base_url(); ?>assets/jquery/jquery-ui-1.10.3.custom/css/jquery-ui.css" media="screen">

<div class="row-fluid col-sm-6 col-sm-offset-3 "  id="add_timeline">
            
    <div class="alert alert-info fade in text-center"><b>Define Timeline</b> </div>
    <div class=" text-center ">
        <div class="radio-inline">
          <label>
            <input type="radio" name="choose" class="myRadio" id="optionsRadios1" value="0" checked>
            Create new
          </label>
        </div>
        <div class="radio-inline">
          <label>
            <input type="radio" name="choose" class="myRadio" id="optionsRadios2" value="1">
            Choose existing
          </label>
        </div>
    </div>
    <div class="hr" style="padding-bottom: 15px"><hr/></div>

<form id="create_form" class="form-horizontal " role="form" action="<?php echo site_url(); ?>/project/project_space/add_space" method="POST">
    
    <div class="form-group">
        <label for="Start Date" class="col-sm-3 control-label">Start Date<?php show_form_error('sdate'); ?></label>
        <div class="col-sm-8">
            <input type="text" id="datepicker1" class=" datepicker form-control" name="sdate" placeholder="Start Date">
       </div>
    </div>

    <div class="form-group">
        <label for="End Date" class="col-sm-3 control-label">End Date<?php show_form_error('edate'); ?> </label>
        <div class="col-sm-8">
            <input type="text" id="datepicker2"  class="datepicker form-control" name="edate" placeholder="End Date">
        </div>
    </div>
   
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-4">
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </div>
        
    </div>
    
    
</form>
    
    
    <form id="choose_form" class="form-horizontal " role="form" action="<?php echo site_url(); ?>/project/project_space/choose_space" method="POST">
        
        <?php if($space_data !== NULL){ ?>
        <div class="form-group container-fluid">
            <label for="" class="control-label">Timeline</label><?php show_form_error('choose_space'); ?>
            <select  name="choose_space" class="form-control">
              <option></option>
              <?php foreach ($space_data as $value){ ?>
              <option value="<?php echo $value['space_id'];  ?>">Academic Year : <?php echo $value['academic_year']; ?>&nbsp; &nbsp;Start :<?php echo $value['start_date']; ?> Ends :<?php echo $value['end_date']; ?></option>';
              <?php }?>
            </select>
        </div>
        
        <div class="form-group">
        <div class="col-sm-3">
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </div>
        <?php } else{ ?>
            <div class=" alert alert-warning text-center">No timeline exist</div>
        <?php } ?>
    </div>
        
    </form>    

</div>
    
    <script>
        $(document).ready(function(){
    // do your checks of the radio buttons here and show/hide what you want to

    $("#choose_form").hide();
     
        $(document).on('click', '.myRadio' , function() {
     if (this.value > 0){ 
        $("#choose_form").show();           
        $("#create_form").hide();
     }
     else {
         
        $("#create_form").show();           
        $("#choose_form").hide();
        }       
  })

});
</script>

<script> $(function() {
    
        $( "#datepicker1" ).datepicker({ minDate: "-1m"});
        $( "#datepicker2" ).datepicker({ maxDate: "+1y" }); 
    });
</script>