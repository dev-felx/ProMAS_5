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
    
    <div>
        
        <div class="panel-group" id="accordion">
            
            <?php 
            $i=0;
            foreach ($groups as $group){ ?>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a class="project_title" data-toggle="collapse" data-super_id="<?php echo $group['supervisor_id']; ?>" data-group_no="<?php echo $group['group_no']; ?>" data-parent="#accordion" href="#collapse<?php echo $i; ?>">
                     <?php echo $group['title']; ?>
                    </a>
                  </h4>
                </div>
                <div id="collapse<?php echo $i; ?>" class="panel-collapse collapse ">
                    <div class="panel-body">
                        <?php echo $group['description']; ?>
                    </div>
                </div>
              </div>
            <?php
            $i++;
            } ?>
            </div>
    </div>
    
</div>

<script>
 
//$('.project_details').hide();
$('body').on('click', '.project_title', function () {
    var group_no = $(this).data('group_no');
    var super_id = $(this).data('super_id');
    alert(group_id);
//    var function_url = "<?php echo site_url(); ?>/project/publish_project/get_project_details/".concat(group_no)+"/".concat(super_id);
//    
//    $.get( function_url).done(function(data) {
//        
//    });
});

  
</script>


