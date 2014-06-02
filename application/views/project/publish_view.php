<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div class="container-fluid">
    <div class="row" >
        <div class='pull-left'><h4>Publish Project to Archive</h4></div>
        
            
        <form class="col-sm-3 pull-right">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search Project">
                <span class="input-group-addon"><span class="glyphicon glyphicon-search text-success"></span></span>
            </div>
        </form>
<!--        <div class="btn-group pull-right">
            <button data-toggle="modal" href="#share_modal" type="button" class="btn btn-success push_right_bit " >Share Document</button>
            <a data-toggle="modal" href="#req_modal" type="button" class="btn btn-success  " >Request Document</a>
        </div>-->
    </div>
    <div class="row" style="margin-bottom: 15px;">
        <div class="hr"><hr/></div>
    </div>
    
    <div class="col-sm-10 col-sm-offset-1">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title text-center">Publish Projects into Archive</h3>
            </div>
            <div class="panel-body">
                <form role="form" action="<?php echo site_url('assessment/assess/gen_csv_sup'); ?>" method="POST">
                    <div class="form-group">
                        <label>Choose project</label>
                        <select class="form-control" id="projects" name="projects">
                            <?php foreach ($groups as $group){ 
                             echo "<option data-super_id=".$group['supervisor_id']." value='".$group['project_id']."'>".$group['title']."</option>";   
                            }
                            ?>
                        </select>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    
</div>

<script>
    $('#projects').change(function(){
        
       var group_no =  $(this).val();
       var super_id = $(this).data('super_id');
       
        alert(super_id);
        var function_url = "<?php echo site_url(); ?>/project/publish_project/get_project_details/".concat(group_no)+"/".concat(super_id);
    
    $.get( function_url).done(function(data) {
        
    });
    
    });
 
});

  
</script>


