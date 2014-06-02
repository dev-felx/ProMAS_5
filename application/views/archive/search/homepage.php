<?php 
/*Author : Minja Junior
 * 
 */
?>

<html lang="en">
    <head id="head">
        <title>ProMAS Archieve</title>
        
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link type="text/css" rel="Stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css" media="screen">
        <link type="text/css" rel="Stylesheet" href="<?php echo base_url(); ?>assets/css/main.css" media="screen">
        
        <script src="<?php echo base_url(); ?>assets/jquery/jquery-1.11.0.js"></script>
        <script src="<?php echo base_url(); ?>assets/jquery/jquery_1.5.2.js" type="text/javascript"></script>
        <script type="text/javascript">
            function clickable(search_term){
                $("#search_term").val('');
                $("#hide_or_show_search_results_box").hide();
                alert('You clicked -- '+search_term);
            }
            $(document).ready(function() {
                $("#search_key").live("keyup",function() {
                    var search_key = $("#search_key").val();
                    var response_brought = $("#response_brought");
                    var dataString = "search_key=" + search_key;
		
                    if(search_key.length > 30) {
			$("#hide_or_show_search_results_box").show();
			$("#search_key").val('');
			$("#response_brought").html('<font color="red">Search term must not be greater than 30 characters.</font>');
                    }
                    else if(search_key.length < 1) {
			$("#hide_or_show_search_results_box").hide();
                    }
                    else if(search_key.length > 0 && search_key.length <= 30) {	
			$.ajax({  
                            type: "POST",  
                            url: '<?php echo site_url(); ?>/archive/archive/suggestions/', 
                            data: dataString,
                            beforeSend: function() {
				$("#hide_or_show_search_results_box").show();
				$("#response_brought").html('<img src="<?php echo base_url(); ?>assets/images/loading.gif" align="absmiddle" alt="Searching '+search_key+'..."> Searching...');
                            },  
                            success: function(response){
				$("#hide_or_show_search_results_box").show();
				$("#response_brought").html(response);
                            }
			}); 
                    }
                    else {
                        $("#response_brought").html('<font color="red">Search term must not be less than 3 or greater than 30 characters.</font>');
                    }
                    return false;
                });
            });
        </script>
    </head>

    <body data-twttr-rendered="true">
        <?php $this->load->view('archive/search/header'); ?>
        <div class="container-fluid">
            <div class="row" style="margin-top: 50px;">
                <img src="<?php echo base_url(); ?>assets/images/pro.jpg" alt="sProMAS Archive" class="img-rounded col-sm-6 col-sm-offset-3">
                <div class="col-sm-6 col-sm-offset-3" style="margin-top: 50px;">
                    <form role="form" action="<?php echo site_url(); ?>/archive/archive/search/" method="POST">
                        <div class="input-group">
                            <input type="text" name="search_key" id="search_key" class="form-control">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit">Search!</button>
                                </span>
                        </div><!-- /input-group -->
                        <div class="list-group" id="hide_or_show_search_results_box" align="left"><span id="response_brought"></span></div>
                    </form>
                </div><!-- /.col-lg-6 -->
            </div>
        </div>
        <!--footer class="login_footer" >
            <div class="col-sm-8 col-sm-offset-2">
                <hr style="border: none; height: 2px; color: blue; background: #0093D0;"/>
            </div>
            <div class="col-sm-8 col-sm-offset-2" style="margin-top: -20px; color: #0093D0; ">
                <h5 class="pull-left">UDSM | CoICT | Computer Science and Engineering Department</h5>
                <h5 class="pull-right">Copyright &COPY; <?php //echo date('20y', time()); ?> ProMAS</h5>
            </div>
        </footer-->
        <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.js"></script>
        <script>$('#help').tooltip();</script>
    </body>
</html>                                                                        
