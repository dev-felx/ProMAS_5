<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<html lang="en">
    <head id="head">
        <title>ProMAS Archive</title>
        
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link type="text/css" rel="Stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css" media="screen">
        <link type="text/css" rel="Stylesheet" href="<?php echo base_url(); ?>assets/css/main.css" media="screen">
        
        <script src="<?php echo base_url(); ?>assets/jquery/jquery-1.11.0.js"></script>
    </head>

    <body data-twttr-rendered="true">
        <div style="margin-bottom: 70px;">
            
        </div>
        <div class="container-fluid">
            <?php
            foreach($res as $v){?>
            <div class="row">
                <div id="leftside" class="col-sm-2">
                    <img src="<?php echo base_url(); ?>assets/images/banner.jpg" alt="sProMAS Archive" class="img-rounded col-sm-12">
                </div>
                <div id="maincon" class="col-sm-8">
                    <div class="page-header">
                        <h2 style="color: 0076a7;"><?php print $v->name ?></h2>
                    </div>
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#abstract" data-toggle="tab">Abstract</a></li>
                        <li><a href="#details" data-toggle="tab">Details</a></li>
                        <li><a href="#documents" data-toggle="tab">Documents</a></li>
                        <li><a href="#participants" data-toggle="tab">Participants</a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="abstract">
                            <p><?php print $v->abstract?></p>
                        </div>
                        <div class="tab-pane" id="details">
                            <p>Project details like academic year an department which it belongs goes here</p>
                        </div>
                        <div class="tab-pane" id="documents">
                            <p>List of Assosiated documents goes Here</p>
                        </div>
                        <div class="tab-pane" id="participants">
                            <p>Participants are:<br/>
                                
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <?php      
            }
            ?>
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
</html>                                                                        