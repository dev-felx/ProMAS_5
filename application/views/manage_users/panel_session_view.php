<div>
    <h4 class="col-sm-3 pull-left"><?php echo $sub_title; ?></h4> 
    <a class="btn btn-success pull-right push_left_bit" href="<?php echo site_url('manage_users/manage/users/student'); ?>">Manage Students</a>
    <a class="btn btn-success pull-right push_left_bit" href="<?php echo site_url('manage_users/manage/users/supervisor'); ?>">Manage Supervisors</a>
    <a class="btn btn-success pull-right" href="<?php echo site_url('manage_users/manage/users/panel_head'); ?>">Manage Panel Heads</a>
</div>
<div class="clearfix"></div>
<hr/>
<div class="col-sm-10 col-sm-offset-1">
    <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title text-center">sProMAS Panel Heads</h3>
        </div>
        <div class="panel-body">
            <form>
                <div class="form-group">
                    <label class="control-label">Select Panel head</label>
                    <select class="form-control" name="project" id="project">
                        <option></option>
                        <?php 
                            foreach ($panel_heads as $value) {
                                echo '<option value="'.$value['user_id'].'">';
                                echo $value['first_name'].' '.$value['last_name'] ;
                                echo '</option>';
                            }
                        ?>
                    </select>
                    
                </div>
                <div id='msg_frm'></div>
                <div class="form-group hidden detail" >
                    <label class="control-label">Projects</label>
                    <ul id="projects" class="list-group"></ul>
                    <button id='show_project_add' class="btn btn-primary btn-sm col-sm-2"><span class="glyphicon glyphicon-plus"></span>Add Project group</button>
                    <div class="clearfix bottom_10"></div>
                    <div class="hidden" id='project_add_cont'>
                    <div class="col-sm-7">
                        <select id="project_add_val" class="form-control col-sm-7">
                            <?php
                                foreach ($projects as $value) {
                                   echo '<option value="'.$value['project_id'].'">'.$value['group_no'].' '.$value['title'];
                                   echo '</option>';
                                }
                                ?>
                        </select>  
                    </div>
                    <button id='project_add_now' class="btn btn-success btn-sm col-sm-1">Add</button>
                    <button id="can_project" class="btn btn-warning btn-sm col-sm-1 push_left_bit">Cancel</button>
                    </div>
                </div>
                
                <div class="clearfix"></div>
                <div class="form-group hidden detail">
                    <label>Panel members<span><button id="show_member_add" class="btn btn-link btn-sm"><span class="glyphicon glyphicon-refresh push_right_bit"></span>Change</button></span></label>
                    <p id='members' class="form-control-static"></p>
                    <div class="" id='member_ch_cont'>
                    <div class="col-sm-7">
                        <select class="hidden" id="member_ch" class="form-control col-sm-7">
                            <?php
                                foreach ($all_members as $value) {
                                   echo '<option value="'.$value['panel_member_id'].'">'.$value[first_name].' '.$value['last_name'];
                                   echo '</option>';
                                }
//                            ?>
                        </select>  
                    </div>
                            <button id='member_ch_now' class="btn btn-success btn-sm col-sm-1">Change</button>
                    <button id="can_member" class="btn btn-warning btn-sm col-sm-1 push_left_bit">Cancel</button>
                    </div>
                </div>
                        <div class="clearfix"></div>
                <div class="form-group hidden detail">
                    <label>Venue and Time<span><button id="show_super_add" class="btn btn-link btn-sm"><span class="glyphicon glyphicon-refresh push_right_bit"></span>Change</button></span></label>
                    <p id="venue" class="form-control-static"></p>
                    <div class="hidden" id='super_ch_cont'>
                    <div class="col-sm-7">
                        <select id="super_ch" class="form-control col-sm-7">
                            //<?php
//                                foreach ($supers_add as $value) {
//                                   echo '<option value="'.$value['user_id'].'">'.$value[first_name].' '.$value['last_name'];
//                                   echo '</option>';
//                                }
//                            ?>
                        </select>  
                    </div>
                    <button id='super_ch_now' class="btn btn-success btn-sm col-sm-1">Change</button>
                    <button id="can_super" class="btn btn-warning btn-sm col-sm-1 push_left_bit">Cancel</button>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        //get project Info
        $('#project').change(function(){
            var id = $(this).val();
            $('.detail').addClass('hidden'); 
            $('#msg_frm').show();
            $('#msg_frm').html('<img style="height: 30px;" class="col-sm-offset-5 push_right_bit" src="<?php echo base_url(); ?>/assets/images/ajax-loader.gif">Fetching Details....');
            setTimeout(function(){
                 var t = "<?php echo site_url(); ?>";
                 var c = t+"/manage_users/panel_session/get_session_details";
                 $.post( c, {id: id}).done(function(data) {
                     if(data.status === 'true'){
                        //hide loader
                        $('#msg_frm').hide();
                        //populate students
                        $('#projects').html('');
                        for(var i = 0; i < data['projects'].length; i++){
                            var x = data['projects'][i].group_no+" - "+data['projects'][i].project_name;
                            $('#projects').append('<li id="'+data['projects'][i].project_id+'" class="project_btn list-group-item">'+x+'<span class="remove text-danger glyphicon glyphicon-remove pull-right"><span></li>');
                         }
                         for(var i = 0; i < data['members'].length; i++){
                            var y = data['members'][i].first_name+" "+data['members'][i].last_name;
                            $('#members').append('<li id="'+data['members'][i].panel_member_id+'" class="project_btn list-group-item">'+y+'<span class="remove text-danger glyphicon glyphicon-remove pull-right"><span></li>');
                         }
                         
                         $('#venue').html(data.session_details[0].venue+' '+data.session_details[0].time);      
                         $('.detail').removeClass('hidden');
                     }else{
                        $('#msg_frm').html('<div class="alert alert-danger">Error Fetching Data</div>');
                     }
                 },'json');
             },400);
        });
        
         $('body').on('click', '.remove', function () {
            var id = $(this).parent('li').attr('id');
            if(confirm('Remove project group from current panel head ')){
                var t = "<?php echo site_url(); ?>";
                 var c = t+"/manage_users/panel_session/remove_project";
                 $.post( c, {project_id: id}).done(function(data) {
                     if(data.status === 'true'){
                         $('#project').trigger('change');
                     }
                 },'json');
            }
         });
         
         //buttons
         $('#show_project_add').click(function(){
            $('#project_add_cont').removeClass('hidden');
            return false;
         });
         $('#show_super_add').click(function(){
            $('#super_ch_cont').removeClass('hidden');
            $('#super').hide();
            return false;
         });
         $('#can_super').click(function(){
            $('#super_ch_cont').addClass('hidden');
            $('#super').show();
            return false;
         });
         $('#can_member').click(function(){
            $('#member_ch_cont').addClass('hidden');
            $('#members').show();
            return false;
         });
         $('#show_member_add').click(function(){
            $('#member_ch_cont').removeClass('hidden');
            $('#members').hide();
            return false;
         });
         $('#can_project').click(function(){
           $('#project_add_cont').addClass('hidden');
            return false;
         });
         
         
         //other functions
         $('#project_add_now').click(function(){
             var project_id = $('#project_add_val').val();
             var panel_head_id = $('#project').val();
             if(confirm('Warning: ')){
                 var t = "<?php echo site_url(); ?>";
                 var c = t+"/manage_users/panel_session/add_project";
                 $.post( c, {project_id: project_id, panel_head_id: panel_head_id}).done(function(data) {
                     if(data.status === 'true'){
                         $('#project').trigger('change');
                     }
                 },'json');
             }else{
                $('#msg_frm').html('<div class="alert alert-danger">Error Adding Project</div>');
             }
             return false;
         });
         
         
         $('#super_ch_now').click(function(){
                var pro_id = $('#project').val();
                var user_id = $('#super_ch').val();
                if(confirm('Warning: Supervisor will be added this group')){
                    var t = "<?php echo site_url(); ?>";
                    var c = t+"/manage_users/group/ch_super";
                    $.post( c, {id: user_id, pro_id: pro_id}).done(function(data) {
                        if(data.status === 'true'){
                            $('#project').trigger('change');
                            $('#can_super').trigger('click');
                        }
                    },'json');
                }else{
                   $('#msg_frm').html('<div class="alert alert-danger">Error Changing Supervisor</div>');
                }
                return false;
         });
         
         $('#member_ch_now').click(function(){
                var pro_id = $('#project').val();
                var user_id = $('#member_ch').val();
                if(confirm('Warning: This panel head will be added this group')){
                    var t = "<?php echo site_url(); ?>";
                    var c = t+"/manage_users/group/ch_panel";
                    $.post( c, {id: user_id, pro_id: pro_id}).done(function(data) {
                        if(data.status === 'true'){
                            $('#project').trigger('change');
                            $('#can_member').trigger('click');
                        }
                    },'json');
                }else{
                   $('#msg_frm').html('<div class="alert alert-danger">Error changing panel Head</div>');
                }
                return false;
         });
    });
</script>

