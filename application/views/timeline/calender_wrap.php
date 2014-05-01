<style>
    .popover{
        z-index: 1001 !important;
        width: 400px;
    }
</style>
<!-- Calender wrap header -->
<div>
    <h4 class="col-sm-3 pull-left">Project Schedule</h4> 
    <button class="btn btn-success pull-right push_left_bit glyph_big"><span class="glyphicon glyphicon-cog"></span></button>
    <a href="<?php echo site_url(); ?>/timeline/timeline/event" class="btn btn-success pull-right push_left_bit" role="button"><span class="glyphicon glyphicon-list push_right_bit"></span>View Event List</a>
    <button id='new_btn' class="btn btn-success pull-right "><span class="glyphicon glyphicon-plus push_right_bit"></span>New Event - Activity</button>
</div>
<div class="clearfix"></div>
<hr style="border: none; height: 1px; background:#0093D0;">

<!-- Calender wrap side bar -->
<div id="calender_left" class="col-sm-2 no_pad no_mag" style="margin-top: 44px;">
    <div id="flash_info" class="sider">
        <div id="msg" class="alert alert-info text-center">Upcoming Events</div>
    </div>
    <div id="add_new" class="sider hidden">
        <?php $this->load->view('timeline/add_event_view'); ?>
    </div>
    <div id="edit_event" class="sider hidden">
        <?php $this->load->view('timeline/edit_event_view'); ?>
    </div>
</div>

<!-- Calender Itself -->
<div id="calender_cont" class="col-sm-10 bottom_10">
    <?php 
    if($this->session->userdata('type') == 'coordinator'){
        $this->load->view('timeline/coor_calender');  
    }else if($this->session->userdata('type') == 'supervisor'){
        $this->load->view('timeline/svisor_calender');
    }
    ?>
</div>
<div id="popover_content_wrapper" class="hidden"><div class="clearfix"></div><a id="edit_btn" href="#" class="pull-left">Edit</a><a id="del_event" href="#" class="pull-right">Delete</a><br/></div>
<script>   
    //wrapper js
    function pop_up(desc){
        return $("<div class='text-center'>"+desc+"</div>").html() + $('#popover_content_wrapper').html();
    }
    
    //Header button click functions
    $(document).ready(function() {
        $("#new_btn").click(function(){
            $('.sider').hide();
            $('#calender_left').switchClass('col-sm-2','col-sm-3',700,show_new);
            $('#calender_cont').switchClass('col-sm-10','col-sm-9',10,render_calender);
            function render_calender(){ 
                $('#calendar').fullCalendar('render');
            }
            function show_new(){
                $('#add_new').fadeIn(1000).removeClass('hidden');
            }
            
        });
        
        $(".show_def").click(function(){
           $('.sider').hide();
            $('#calender_cont').switchClass('col-sm-9','col-sm-10',10,render_calender);
            $('#calender_left').switchClass('col-sm-3','col-sm-2',10,show_new);
            function render_calender(){ 
                $('#calendar').fullCalendar('render');
            }
            function show_new(){
                $('#flash_info').fadeIn(700);
            }
        });
        
        $('body').on('click', '#edit_btn', function () {
            $('.sider').hide();
            $('#calender_left').switchClass('col-sm-2','col-sm-3',700,show_edit);
            $('#calender_cont').switchClass('col-sm-10','col-sm-9',10,render_calender);
            function render_calender(){ 
                $('#calendar').fullCalendar('render');
            }
            function show_edit(){
                $.post( "<?php echo site_url() ?>/timeline/timeline/get_for_edit" , function( data ) {
                     $('#etitle').attr('value',data.name);
                },"json");
                $('#edit_event').fadeIn(1000).removeClass('hidden');
            }       
             return false;
        });
    });
</script>