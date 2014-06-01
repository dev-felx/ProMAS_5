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
                            foreach ($forms as $value){
                                echo '<option value="'.$value['project_id'].'">'.$value['project_name'].'</option>';
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
    var forms = <?php echo json_encode($forms); ?>;
    var curr_form;
    
    $(document).ready(function(){ 
        $( "#pro" ).change(function() {
            var id = $(this).val();
            get_stu(id);
            show_form(id);
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

            function show_form(id){
                $('#pres_form').slideDown();
                $('#msg_grp').html('');
                for (var i=0; i < forms.length; i++){
                    if (forms[i]['project_id'] == id){
                        $('[name="title"]', '#pres_form').html(forms[i].project_name);
                        $('[name="title"]', '#pres_form').val(forms[i].project_name);
                        
                        $('[name="im"]', '#pres_form').attr('value',forms[i].im);
                        $('[name="im"]', '#pres_form').val(forms[i].im);
                        
                        $('[name="sf"]', '#pres_form').attr('value',forms[i].sf);
                        $('[name="sf"]', '#pres_form').val(forms[i].sf);
                        
                        $('[name="sc"]', '#pres_form').attr('value',forms[i].sc);
                        $('[name="sc"]', '#pres_form').val(forms[i].sc);
                        
                        $('[name="pq"]', '#pres_form').attr('value',forms[i].pq);
                        $('[name="pq"]', '#pres_form').val(forms[i].pq);
                        
                        $('[name="ptc"]', '#pres_form').attr('value',forms[i].ptc);
                        $('[name="ptc"]', '#pres_form').val(forms[i].ptc);
                        
                        $('[name="com"]', '#pres_form').attr('value',forms[i].com);
                        $('[name="com"]', '#pres_form').val(forms[i].com);
                        
                        $('[name="form_id"]', '#pres_form').attr('value',forms[i].form_id);
                    }
                }
            }
            
            <?php if($this->session->userdata('type') == 'panel_head'){ ?>
                $('#sav_form').click(function(){
                $('#msg_grp').html('<img style="height: 30px;" class="col-sm-offset-5 push_right_bit" src="<?php echo base_url(); ?>/assets/images/ajax-loader.gif">Fetching....');
                 setTimeout(function(){
                     var t = "<?php echo site_url(); ?>";
                     var c = t+"/assessment/assess_panel/save_form";
                     $.post( c, $("#pres_form").serialize()).done(function(data) {
                         if(data.status == 'cool'){
                             $('#msg_grp').html('<div class="alert alert-success text-center">Saved</div>');
                             forms = data.forms;
                         }else{
                             $('#msg_grp').html('<div class="alert alert-danger text-center">'+data+'</div>');
                         }
                     },'json');
                 },400);
                 return false;
            });
           <?php }else{ ?>
                $('#sav_form').click(function(){
                $('#msg_grp').html('<div class="alert alert-danger text-center">You do not have access to edit these data</div>');
                    return false;
                });
            <?php } ?>
    });
       
</script>