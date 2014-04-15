<?php

echo 'welcome coordinator';

if(isset($message)){
    
    echo $message;
}
?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/timeline/css/jquery-ui.min.css" />"
<link href="<?php echo base_url(); ?>assets/css/timeline/css/fullcalendar.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/css/timeline/css/fullcalendar.print.css" rel="stylesheet" media="print" />
<script src="<?php echo base_url(); ?>assets/css/timeline/js/jquery-ui.custom.min.js"></script>
<script src="<?php echo base_url(); ?>assets/css/timeline/js/fullcalendar.min.js"></script>
<script>
	$(document).ready(function() {
	
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		
		$('#calendar').fullCalendar({
                        theme: true,
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek,basicDay'
			},
			editable: false,
			events: [
				{
					title: 'All Day Event',
					start: new Date(y, m, 1)
				},
				{
					title: 'Long Event',
					start: new Date(y, m, d-5),
					end: new Date(y, m, d-2)
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: new Date(y, m, d-3, 16, 0),
					allDay: false
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: new Date(y, m, d+4, 16, 0),
					allDay: false
				},
				{
					title: 'Meeting',
					start: new Date(y, m, d, 10, 30),
					allDay: false
				},
				{
					title: 'Lunch',
					start: new Date(y, m, d, 12, 0),
					end: new Date(y, m, d, 14, 0),
					allDay: false
				},
				{
					title: 'Birthday Party',
					start: new Date(y, m, d+1, 19, 0),
					end: new Date(y, m, d+1, 22, 30),
					allDay: false
				},
				{
					title: 'Click for Google',
					start: new Date(y, m, 28),
					end: new Date(y, m, 29),
					url: 'http://google.com/'
				}
			]
		});
		
	});
</script>
<style>
	#calendar {
		width: 900px;
		margin: 0 auto;
		}
</style>
<div id='calendar'></div>