   <div class="col-sm-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title text-center">Students</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label>Search using student name or number</label>
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
                <div class="form-group">
                    <label>Week Number</label>
                    <select id="week" class="form-control">
                        
                     </select>
                </div>
                
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title text-center">Student Assessment Form</h3>
            </div>
            <div class="panel-body">
                <?php $this->load->view('assessment/ind_form'); ?>
            </div>
        </div>
    </div>
<script>
    var forms = <?php echo json_encode($forms); ?>;
    $('#ind_form').hide();
    $(document).ready(function(){  
        var curr_stu;
        //defaults
        get_stu($( "#pro" ).val());
        $('#name').html(forms[0].student_name);
        
        //clicks
        $( "#pro" ).change(function() {
            var id = $(this).val();
            get_stu(id);
        });
        
        $( "#week" ).change(function() {
            var week = $(this).val(); 
            $('#ind_form').slideDown();
            $('#msg_frm').html('');
            for (var i=0; i < forms.length; i++){
                     if (forms[i]['student'] == curr_stu && forms[i]['week_no'] == week){
                         $('#name').html(forms[i].student_name);
                         $('#reg_no').html(forms[i].student);
                         $('#wik').html(forms[i].week_no);
                         $('#pro_name').html(forms[i].project_name);
                         $('[name="init"]', '#ind_form').attr('value',forms[i].initiative);
                         $('[name="gen"]', '#ind_form').attr('value',forms[i].understand);
                         $('#spec').attr('value',forms[i].contribution);
                         $('#qn').attr('value',forms[i].qna);
                         $('#com').html(forms[i].comments);
                     }
                 }
        });
        
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
                    //activate first student
                    curr_stu = $('#'+data['students'][0].registration_no).attr('id');
                    $('#'+data['students'][0].registration_no).addClass('stu_btn_active');
                    
                    $('#week').html('');
                    $('#week').html('<option></option>');
                    for(var i = 0; i < data['week'].length; i++){
                        $('#week').append('<option>'+data['week'][i].week_no+'</option>');
                    }
                },'json');
             },400);
        }
        
        $('#sav_form').click(function(){
            $('#msg_frm').html('<img style="height: 30px;" class="col-sm-offset-5 push_right_bit" src="<?php echo base_url(); ?>/assets/images/ajax-loader.gif">Fetching....');
             setTimeout(function(){
                 var t = "<?php echo site_url(); ?>";
                 var c = t+"/assessment/assess/save_form";
                 $.post( c, $("#ind_form").serialize()).done(function(data) {
                     if(data.status == 'cool'){
                         $('#msg_frm').html('<div class="alert alert-success text-center">Saved</div>');
                     }
                 },'json');
             },400);
             return false;
        });
        
        //student functions
        $('body').on('click', '.stu_btn', function () { 
            $('.stu_btn').removeClass('stu_btn_active');
            $(this).addClass('stu_btn_active');
            curr_stu = $(this).attr('id');
        });

    });
</script>
