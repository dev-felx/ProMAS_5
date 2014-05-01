<style>
    #add_event_form{
        border: #ccc solid 1px;
        border-radius: 2px;
        padding: 5px;
    }
    #add_event_form > .alert-info{
        cursor: pointer;
        margin-bottom: 0px;
    }
    #form_body{
        margin-top: 10px;
    }
    
    .err::-webkit-input-placeholder { /* WebKit browsers */
    color:  #A94442;
    opacity: 0.7;
    }
    .err:-moz-placeholder { /* Mozilla Firefox 4 to 18 */
        color:  #A94442;
        opacity: 0.7;
    }
    .err::-moz-placeholder { /* Mozilla Firefox 19+ */
        color:  #A94442;
        opacity: 0.7;
    }
    .err:-ms-input-placeholder { /* Internet Explorer 10+ */
        color:  #A94442;
        opacity: 0.7;
    }

</style>
<script src="<?php echo base_url(); ?>assets/jquery/jquery-ui-1.10.3.custom/js/jquery-ui.js"></script>
<link type="text/css" rel="Stylesheet" href="<?php echo base_url(); ?>assets/jquery/jquery-ui-1.10.3.custom/css/jquery-ui.css" media="screen">

<form id="add_event_form" action="#" method="post">   
       <div id="msg" class="alert alert-info text-center">Add New Event or Activity</div>
       <div id="form_body">
       <div class="form-group">
          <input class="form-control" type="text" placeholder="Event Title..." id="title" name="title">
       </div>
       
       <div class="form-group">
            <textarea class="form-control" rows="3" placeholder="Event Description..." id="description" name="description" ></textarea>
       </div>
                  
       <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                <input type="text" id="date_start"  class="datepicker form-control" name="date_start" placeholder="Start Date">                
            </div>
       </div>

        <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    <input type="text" id="date_end"  class="datepicker form-control" name="date_end" placeholder="End Date">                
                </div>
        </div>
        <hr/>
        <div class="checkbox" id="res_qn">
            <label>
                <input type="checkbox" name="output" value="1"> Does this event give output?
            </label>
        </div>
        <div id="res_wrap">
            <div class="form-group">
                <select id="res" name="res" class="form-control">
                    <option value="1">Report Document</option>
                    <option value="2">Presentation Document</option>
                    <option value="3">Picture</option>
                    <option value="4">url</option>
                </select>
            </div>
            <div class="form-group">
                    <input class="form-control" type="text" placeholder="Output Name..." id="res_name" name="res_name">
            </div>
        </div>
        <div class="form-group">
            <button id="add_btn" class=" col-sm-4 btn btn-success pull-right" type="button">Add</button>
            <button class="show_def col-sm-4 btn btn-danger pull-right push_right_bit" type="button">Cancel</button>
        </div>
       </div>
        <div class="clearfix"></div>
</form>
<script>
    $('#res_wrap').hide();
    var ajax_alive = false;
    $(document).ready(function(){
        $( "#date_start" ).datepicker({
                dateFormat: 'yy-mm-dd'
        });
        $( "#date_end" ).datepicker({
                dateFormat: 'yy-mm-dd'
        });
        $('#add_event_form > .alert-info').click(function(){
            $('#form_body').slideToggle(500);
        });
        
        $("#add_btn").click(function(){
            if(ajax_alive === false){
                $('#add_event_form input').parent('div').removeClass('has-error');
                $('#add_event_form textarea').parent('div').removeClass('has-error');
                $('#msg').html('<img style="height: 30px;" class="push_right_bit" src="<?php echo base_url(); ?>assets/images/ajax-loader.gif">Adding....');
                ajax_alive = true;
                setTimeout(function(){
                     $.post( "<?php echo site_url() ?>/timeline/timeline/add_event", $("#add_event_form").serialize() , function( data ) {
                         if(data.status === 'not_valid'){
                            $.each(data.errors, function(key, val) {
                                $('[name="'+ key +'"]', '#add_event_form').attr('placeholder',val);
                                $('[name="'+ key +'"]', '#add_event_form').addClass('err');
                                $('[name="'+ key +'"]', '#add_event_form').parent('div').addClass('has-error');
                                $('#msg').html('We need more data');
                            });
                        }else if(data.status === 'success') {
                            $('#msg').removeClass('alert-info');
                            $('#msg').addClass('alert-success');
                            $('#msg').html('Event created');
                            $('#calendar').fullCalendar( 'refetchEvents' );
                        }
                    
                    },"json");
                    ajax_alive = false;
                 },300);
             }
             return false;
        });
        
        $('#res_qn').change(function() {
                $('#res_wrap').slideToggle(300);
        });
        });
</script>