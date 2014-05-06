<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/timeline/css/jquery-ui.min.css" />
<link href="<?php echo base_url(); ?>assets/css/timeline/css/fullcalendar.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/css/timeline/css/fullcalendar.print.css" rel="stylesheet" media="print" />
<script src="<?php echo base_url(); ?>assets/css/timeline/js/jquery-ui.custom.min.js"></script>
<script src="<?php echo base_url(); ?>assets/css/timeline/js/fullcalendar.min.js"></script>
<script>
    
    $(document).ready(function() { 
        $('#calendar').fullCalendar({
            eventRender: function (event, element) {
                element.popover({
                    title: event.title,
                    placement:'top auto',
                    html:true,
                    trigger : 'click',
                    animation : 'true',
                    container: '#calender_cont',
                    content: pop_up(event.desc,event.creator_id)
                });
                
                $('body').on('click', function (e) {
                    if (!element.is(e.target) && element.has(e.target).length === 0 && $('.popover').has(e.target).length === 0)
                        element.popover('hide');
                });
              },
                eventClick: function(event) {
                    curr_event  = event;
                    $('.fc-event').not(this).popover('hide');
                    return false;
                },
                eventSources: [
                // your event source
                    
                    {
                        url: "<?php echo site_url(); ?>/timeline/timeline/c_event", // use the `url` property
                        color: '#5CB85C',    // an option!
                        textColor: 'white'  // an option!
                    },
                    <?php if($this->session->userdata('type') == 'supervisor'){?>
                    {
                        url: "<?php echo site_url(); ?>/timeline/timeline/s_event", // use the `url` property
                        color: '#0093D0',    // an option!
                        textColor: 'white'  // an option!
                    }
                    <?php } 
                    if($this->session->userdata('type') == 'student'){?>
                    {
                        url: "<?php echo site_url(); ?>/timeline/timeline/ss_event", // use the `url` property
                        color: '#0093D0',    // an option!
                        textColor: 'white'  // an option!
                    },
                    {
                        url: "<?php echo site_url(); ?>/timeline/timeline/st_event", // use the `url` property
                        color: '#BCE8F1',    // an option!
                        textColor: '#31708F'  // an option!
                    }
                    <?php } ?>
                ]
        });		
    });
</script>
<div id='calendar'></div>
