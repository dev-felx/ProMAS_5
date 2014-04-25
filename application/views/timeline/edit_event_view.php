<style>
    #edit_event_form{
        border: #ccc solid 1px;
        border-radius: 2px;
        padding: 5px;
    }
    #edit_event_form > .alert-info{
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

<form id="edit_event_form" action="#" method="post">   
       <div id="msg" class="alert alert-info text-center">Edit Event or Activity</div>
       <div id="form_body">
       <div class="form-group">
          <input class="form-control" type="text" placeholder="Event Title..." id="etitle" name="title">
       </div>
       
       <div class="form-group">
            <textarea class="form-control" rows="3" placeholder="Event Description..." id="edescription" name="description" ></textarea>
       </div>
                  
       <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                <input type="text" id="edate_start"  class="datepicker form-control" name="date_start" placeholder="Start Date">                
            </div>
       </div>

        <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    <input type="text" id="edate_end"  class="datepicker form-control" name="date_end" placeholder="End Date">                
                </div>
        </div>
        <hr/>
        <div class="checkbox" id="eres_qn">
            <label>
                <input type="checkbox"> Does this event/activity give output?
            </label>
        </div>
        <div class="form-group">
            <select id="eres" name="res" class="form-control">
                <option>Choose type of output</option>
                <option>Report Document</option>
                <option>Presentation Document</option>
                <option>Picture</option>
                <option>url</option>
            </select>
        </div>
        <div class="form-group">
            <button id="save_btn" class=" col-sm-4 btn btn-success pull-right" type="button">Add</button>
            <button class="show_def col-sm-4 btn btn-warning pull-right push_right_bit" type="button">Cancel</button>
        </div>
       </div>
        <div class="clearfix"></div>
</form>
<script>
    $('#res').hide();
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
        
        $("#save_btn").click(function(){
            alert('heelo');
            if(ajax_alive === false){
                $('#add_event_form input').parent('div').removeClass('has-error');
                $('#add_event_form textarea').parent('div').removeClass('has-error');
                $('#msg').html('<img style="height: 30px;" class="push_right_bit" src="<?php echo base_url(); ?>assets/images/ajax-loader.gif">Adding....');
                ajax_alive = true;
                setTimeout(function(){
                     $.post( "<?php echo site_url() ?>/timeline/events/add_event", $("#add_event_form").serialize() , function( data ) {
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
                        }
                    
                    },"json");
                    ajax_alive = false;
                 },300);
             }
             return false;
        });
        
        $('#res_qn').change(function() {
                $('#res').slideToggle(300);
        });
        });
</script>