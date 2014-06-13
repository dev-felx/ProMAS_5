<div>
    <h4 class="col-sm-3 pull-left"><?php echo $sub_title; ?></h4> 
</div>
<div class="clearfix"></div>
<hr/>
<div class="col-sm-10 col-sm-offset-1">
    <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title text-center">sProMAS Project Groups</h3>
        </div>
        <div class="panel-body">
            <form>
                <div class="form-group">
                    <label class="control-label">Select a project group</label>
                    <select class="form-control" name="project" id="project">
                        <option></option>
                        <?php 
                            foreach ($projects as $value) {
                                echo '<option value="'.$value['project_id'].'">Group ';
                                echo $value['group_no'].' - '.$value['title'];
                                echo '</option>';
                            }
                        ?>
                    </select>
                    
                </div>
                <div id='msg_frm'></div>
                <div class="form-group hidden detail" >
                    <label class="control-label">Students</label>
                    <ul id="stud" class="list-group"></ul>
                    <button id='show_stu_add' class="btn btn-primary btn-sm col-sm-2"><span class="glyphicon glyphicon-plus"></span>Add Student</button>
                    <div class="hidden" id='stu_add_cont'>
                    <div class="col-sm-7">
                        <select id="stu_add_val" class="form-control col-sm-7">
                            <?php
                                foreach ($students_add as $value) {
                                   echo '<option value="'.$value['student_id'].'">'.$value[first_name].' '.$value['last_name'].' Group ';
                                   echo $value['group_no'];
                                   echo '</option>';
                                }
                            ?>
                        </select>  
                    </div>
                    <button id='stu_add_now' class="btn btn-success btn-sm col-sm-2">Add</button>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="form-group hidden detail">
                    <label>Project Supervisor<span><button class="btn btn-link btn-sm"><span class="glyphicon glyphicon-refresh push_right_bit"></span>Change</button></span></label>
                    <p id="super" class="form-control-static"></p>
                </div>
                <div class="form-group hidden detail">
                    <label>Project Assessment Panel Head<span><button class="btn btn-link btn-sm"><span class="glyphicon glyphicon-refresh push_right_bit"></span>Change</button></span></label>
                    <p id='panel' class="form-control-static"></p>
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
                 var c = t+"/manage_users/group/get_grp_details";
                 $.post( c, {id: id}).done(function(data) {
                     if(data.status === 'true'){
                        //hide loader
                        $('#msg_frm').hide();
                        //populate students
                        $('#stud').html('');
                        for(var i = 0; i < data['students'].length; i++){
                            var x = data['students'][i].first_name+" "+data['students'][i].last_name +" - "+ data['students'][i].registration_no;
                            $('#stud').append('<li id="'+data['students'][i].student_id+'" class="stu_btn list-group-item">'+x+'<span class="remove text-danger glyphicon glyphicon-remove pull-right"><span></li>');
                         }
                         $('#panel').html(data.panel[0].first_name+' '+data.panel[0].last_name);
                         $('#super').html(data.panel[0].first_name+' '+data.panel[0].last_name);      
                         $('.detail').removeClass('hidden');   
                     }else{
                        $('#msg_frm').html('<div class="alert alert-danger">Error Fetching Data</div>');
                     }
                 },'json');
             },400);
        });
        
         $('body').on('click', '.remove', function () {
            var id = $(this).parent('li').attr('id');
            if(confirm('Remove student from this project')){
                var t = "<?php echo site_url(); ?>";
                 var c = t+"/manage_users/group/remove_stu";
                 $.post( c, {id: id}).done(function(data) {
                     if(data.status === 'true'){
                         $('#project').trigger('change');
                     }
                 },'json');
            }
         });
         
         
         $('#show_stu_add').click(function(){
            $('#stu_add_cont').removeClass('hidden');
            return false;
         });
         
         $('#')
    });
</script>
