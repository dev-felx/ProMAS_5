<div class="col-sm-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title text-center">Students</h3>
            </div>
            <div class="panel-body">
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
                <h3 class="panel-title text-center">Student Weekly Average Assessment</h3>
            </div>
            <div id="form_cont" class="panel-body">
                <?php $this->load->view('assessment/ind_form'); ?>
            </div>
        </div>
    </div>
<script> 
var forms = <?php echo json_encode($forms); ?>;
$(document).ready(function(){  
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
                for(var i = 0; i < data['students'].length; i++){
                    var x = data['students'][i].first_name+" "+data['students'][i].last_name +" - "+ data['students'][i].registration_no;
                    $('#stu').append('<li id="'+data['students'][i].registration_no+'" class="stu_btn list-group-item">'+x+'</li>');
                }
            },'json');
         },400);
    }
    
    //student functions
        $('body').on('click', '.stu_btn', function () { 
            $('.stu_btn').removeClass('stu_btn_active');
            $(this).addClass('stu_btn_active');
            var curr_stu = $(this).attr('id');
           
            for (var i=0; i < forms.length; i++){
                 if (forms[i]['student_id'] == curr_stu && forms[i]['week_no'] == week){
                     $('#name').html(forms[i].student_name);
                     $('#reg_no').html(forms[i].student);
                     $('#wik').html(forms[i].week_no);
                     $('#pro_name').html(forms[i].project_name);

                     $('[name="init"]', '#ind_form').attr('value',forms[i].initiative);
                     $('[name="init"]', '#ind_form').val(forms[i].initiative);

                     $('[name="gen"]', '#ind_form').attr('value',forms[i].understand);
                     $('[name="gen"]', '#ind_form').val(forms[i].understand);

                     $('#spec').attr('value',forms[i].contribution);
                     $('#spec').val(forms[i].contribution);

                     $('#qn').attr('value',forms[i].qna);
                     $('#qn').val(forms[i].qna);

                     $('#com').html(forms[i].comments);
                     $('#com').val(forms[i].comments);


                     $('[name="form_id"]', '#ind_form').attr('value',forms[i].form_id);
                 }
             }
        });
});
</script>