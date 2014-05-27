<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
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
    </head>

    <body data-twttr-rendered="true">
        <div style="margin-bottom: 100px;">
            
        </div>
        <div class="container-fluid col-sm-8 col-sm-offset-2">
            <div class="row">
                <div class="page-header">
                    <h2>Search results</h2>
                </div>
            </div>
            <div class="row">
                <div class="list-group">
                    <?php
                    if(!empty($res)){
                        foreach($res as $v){?>
                            <a href="<?php echo site_url(); ?>/archieve/archieve/profile/<?php print $v->project_profile_id ?>" class="list-group-item">
                                <h4 class="list-group-item-heading"><?php print $v->name ?></h4>
                                <p class="list-group-item-text">some details about project</p>
                            </a>
                    <?php      
                        }
                    }else {?>
                        <ul class="list-group">
                            <li class="list-group-item">No Result Found</li>
                        </ul>
                    <?php
                    }
                    ?>
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