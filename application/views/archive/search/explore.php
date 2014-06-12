<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<html lang="en">
    <head id="head">
        <title>sProMAS Archive</title>
        
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link type="text/css" rel="Stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css" media="screen">
        <link type="text/css" rel="Stylesheet" href="<?php echo base_url(); ?>assets/css/main.css" media="screen">
        
        <script src="<?php echo base_url(); ?>assets/jquery/jquery-1.11.0.js"></script>
        <script type="text/javascript">
            function filter(){
                if($("#filter").val() == "asc"{
                    var dataString = "filter=" + $("#filter").val() + "&action=post";
		
                    $.ajax({  
			type: "POST",  
			url: "<?php echo site_url(); ?>/archive/archive/suggestions/" + $("#filter").val(),  
			data: dataString,
			beforeSend: function() 
			{
				$("#loading").show();
				$("#loading").html('<img src="<?php echo base_url(); ?>assets/images/loading.gif" alt="Loading"> Loading...');
			},  
			success: function(response)
			{
				$("#filter").val('').animate({
						"height": "20px"
				}, "fast" );
				$("#loading").hide();
				$("#maincon").prepend($(response).fadeIn(1000));
			}
		   
                    }); 
                }
            }
        </script>
    </head>
    <body data-twttr-rendered="true">
        <div class="container-fluid">
            <div class="row" style="margin-top: 40px;">
                <div id="leftside" class="col-sm-2">
                    <img src="<?php echo base_url(); ?>assets/images/banner.jpg" alt="sProMAS Archive" class="img-rounded col-sm-12">
                    <div style="margin-top: 120px;" id="login_box" class="container-fluid text-center">
                        <div class="alert alert-info text-center col-sm-offset-1" >Filter by</div>
                        <h5>Alphabetical</h5>
                        <div class="btn-group">
                            <button type="submit" name="filter" value="asc" class="btn btn-primary" id="filter" onclick="filter();">A-Z</button>
                            <button type="submit" name="filter" value="za" class="btn btn-primary" id="filter" onclick="filter();">Z-A</button>
                        </div>
                    </div>
                </div>
                <div id="maincon" class="col-sm-8">
                    <div class="page-header">
                        <h2 style="color: 0076a7;">sProMAS Archive Explorer</h2>
                    </div>
                    <h4 style="color: #0076a7">Latest Project's</h4>
                    <div class="list-group" id="maincon">
                        <div id="loading"></div>
                    <?php
                    if(!empty($res)){
                        foreach($res as $v){?>
                            <a href="<?php echo site_url(); ?>/archive/archive/profile/<?php print $v->project_profile_id ?>" class="list-group-item">
                                <h4 class="list-group-item-heading"><?php print $v->project_name ?></h4>
                                <p class="list-group-item-text">some details about project</p>
                            </a>
                    <?php      
                        }
                    }else {?>
                            <p>No Result Found</p>
                    <?php
                    }
                    ?>
                </div>
                </div>
            </div>
        </div>
        <footer class="login_footer" >
            <div class="col-sm-8 col-sm-offset-2">
                <hr style="border: none; height: 2px; color: blue; background: #0093D0;"/>
            </div>
            <div class="col-sm-8 col-sm-offset-2" style="margin-top: -20px; color: #0093D0; ">
                <h5 class="pull-left">UDSM | CoICT | Computer Science and Engineering Department</h5>
                <h5 class="pull-right">Copyright &COPY; <?php echo date('20y', time()); ?> ProMAS</h5>
            </div>
        </footer>
        <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.js"></script>
        <script>$('#help').tooltip();</script>
    </body>
</html>                                                      