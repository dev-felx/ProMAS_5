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
                <div class="form-group hidden" id="stu_wrap">
                     <label class="control-label">Students</label>
                    <ul id="stud" class="list-group">
                    </ul>
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
            setTimeout(function(){
                 var t = "<?php echo site_url(); ?>";
                 var c = t+"/manage_users/group/get_grp_details";
                 $.post( c, {id: id}).done(function(data) {
                     if(data.status === 'true'){
                        //populate students
                        for(var i = 0; i < data['students'].length; i++){
                            var x = data['students'][i].first_name+" "+data['students'][i].last_name +" - "+ data['students'][i].registration_no;
                            $('#stud').append('<li id="'+data['students'][i].registration_no+'" class="stu_btn list-group-item">'+x+'</li>');
                         }
                         $('#stu_wrap').removeClass('hidden');
                         
                         
                     }
                 },'json');
             },400);
        });
    });
</script>
