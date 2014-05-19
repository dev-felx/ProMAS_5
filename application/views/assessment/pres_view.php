<div>
    <h4 class="col-sm-3 pull-left"><?php echo $sub_title; ?></h4> 
</div>
<div class="clearfix"></div>
<hr/>
<div class="col-sm-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title text-center">Project Groups</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label>Search using project name</label>
                    <div class="input-group">
                        <input type="text" class="form-control">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-search text-success"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label>Choose Project</label>
                    <select id="pro" class="form-control">
                        <?php 
                            foreach ($projects as $value){
                                echo '<option value="'.$value['project_id'].'">'.$value['title'].'</option>';
                            }
                        ?>
                      </select>
                </div>
                <div>
                    <label>Students</label>
                    <ul id="stu" class="list-group">
                      </ul>
                </div>
                
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title text-center">Presentation Assessment Form</h3>
            </div>
            <div class="panel-body">
                <?php $this->load->view('assessment/pres_form'); ?>
            </div>
        </div>
    </div>
<script>
    $( "#pro" ).change(function() {
        var id = $(this).val();
        get_stu(id);
    });
    
    $( "#pro" ).trigger('change');   
    function get_stu(id){
            $('#stu').html('<img style="height: 30px;" class="col-sm-offset-3 push_right_bit" src="<?php echo base_url(); ?>/assets/images/ajax-loader.gif">Fetching....');
             setTimeout(function(){
                 var t = "<?php echo site_url(); ?>";
                 var c = t+"/assessment/assess/get_pro_stu";
                 $.post( c, {id: id}).done(function(data) {
                    $('#stu').html('');
                    $('#week').html('');
                    for(var i = 0; i < data['students'].length; i++){
                        var x = data['students'][i].first_name+" "+data['students'][i].last_name +" - "+ data['students'][i].registration_no;
                        $('#stu').append('<li id="'+data['students'][i].registration_no+'" class="stu_btn list-group-item">'+x+'</li>');
                    }
                    
              
                    
                },'json');
             },400);
        }
       
</script>