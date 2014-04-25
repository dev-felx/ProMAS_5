<?php
if(isset($message)){  
    echo $message;
}
?>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/timeline/css/jquery-ui.min.css" />
<link href="<?php echo base_url(); ?>assets/css/timeline/css/fullcalendar.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/css/timeline/css/fullcalendar.print.css" rel="stylesheet" media="print"/>
<script src="<?php echo base_url(); ?>assets/css/timeline/js/jquery-ui.custom.min.js"></script>
<script src="<?php echo base_url(); ?>assets/css/timeline/js/fullcalendar.min.js"></script>
<script>
$(document).ready(function() {
        $('#calendar').fullCalendar({
            eventSources: [
                // your event source
                {
                    url: "<?php echo site_url(); ?>/test/c_event", // use the `url` property
                    type: 'POST',
                    data: {
                        custom_param1: 'something',
                        custom_param2: 'somethingelse'
                    },
                    color: 'yellow',    // an option!
                    textColor: 'black'  // an option!
                },
                {
                    url: "<?php echo site_url(); ?>/test/s_event", // use the `url` property
                    color: 'green',    // an option!
                    textColor: 'black'  // an option!
                }
            ]
        });		
});
</script>
<div id='calendar' class="col-sm-10 bottom_10 col-sm-offset-2"></div>