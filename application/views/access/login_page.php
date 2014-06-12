<?php 
/*Author : Devid Felix , Annastella Kilaja
 * 
 */
?>

<html lang="en">
    <head id="head">
        <title>Login | sProMAS</title>
        
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link type="text/css" rel="Stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css" media="screen">
        <link type="text/css" rel="Stylesheet" href="<?php echo base_url(); ?>assets/css/main.css" media="screen">
        
        <script src="<?php echo base_url(); ?>assets/jquery/jquery-1.11.0.js"></script>
        
    </head>
            
        
    <body data-twttr-rendered="true">
        <div class="container-fluid">
        <?php $this->load->view('templates/header_out'); ?>
    
            <div style="margin-top: 50px">
            <div class="row" >
                 <div style="margin-bottom: px" class="col-sm-10 col-sm-offset-2">
                    
                        <div class="">
                            <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#myOverview">Overview</button>
                            <a href="<?php echo site_url('archive/archive'); ?>" class="btn btn-primary ">Archive Home</a>
                        </div>
                </div>
                
            </div>
                
            <div class="row">
                    
                <div class="col-sm-8 col-sm-offset-2">
                    <hr style="border: none; height: 2px; background:#0093D0;"/>
                </div>
            </div>
                
            <div class="row">
                <div class="col-sm-4 col-sm-offset-4">
                    <div class="text-center ">
                <h3  style="color:#0093D0">ProMAS Login</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                
                <div class="col-sm-4 col-sm-offset-4">
                    
                        
                    <div id="login_box">
                        <div class="container-fluid">                    
                        
                            <?php if(isset($message)){  
                                 echo $message;    
                                }else {?>
                                        <div class="alert alert-info text-center" >Please Login</div>
                                <?php }?>
                        
                            <form role="form" action="<?php echo site_url(); ?>/access/login/verify_user" method="POST">
                                
                                
                                        <div class="col-sm-10 col-sm-offset-1 ">
                                            <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                                <input name="username" type="text" class="form-control" placeholder="Enter username" value="<?php echo set_value('username'); ?>">                
                                            </div>
                                            </div>
                                            <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                                <input name="password" type="password" class="form-control" placeholder="Enter password">
                                            </div>
                                            </div>
                                        </div> 
                                        
                                        <div  class="col-sm-10 col-sm-offset-3">
                                            <div class="form-group">
                                                <div class="checkbox">
                                                    <label class=""><input name="keep_logged" type="checkbox" value="1"  >Keep me logged in</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-10 col-sm-offset-1 ">
                                            <div class="form-group">
                                                <button name="submit" value="submit" type="submit" class="btn btn-primary btn-block">Login</button>
                                            </div>
                                        </div>
                                            
                            </form>
                            
                            <div class="row">
                            <div class="col-sm-12">
                                <h5 class="pull-left" style="color:#0093D0"><a href="<?php  echo site_url(); ?>/access/password">Forgot your password?</a></h5>
                                <h5 class="pull-right" style="color:#0093D0">Cant login<span style="height: 25px;" id="help" data-toggle="tooltip" data-placement="left" title="For students use registration numbers Eg. 2011-04-07679. For other users login with valid email" >&nbsp;<img class="" style="max-height: 20px;" src="<?php echo base_url(); ?>assets/images/help_icon.png"></span></h5>
                            </div>
                            </div>    
                    </div>
                        
                </div>
            </div>
        </div>        
           
        </div>
        <footer class="login_footer" >
            <div class="col-sm-8 col-sm-offset-2">
                    <hr style="border: none; height: 2px; color: blue; background: #0093D0;"/>
                </div>
                <div class="col-sm-8 col-sm-offset-2" style="margin-top: px; color: #0093D0; ">
                    <h5 class="pull-left">UDSM | CoICT | Computer Science and Engineering Department</h5>
                    <h5 class="pull-right">Copyright &COPY; <?php echo date('20y', time()); ?> ProMAS</h5>
                </div>
        </footer>
</div>

        
        
        <div class="modal" role="dialog" id="myOverview" >

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4>Student Project Management And Archiving System(sProMAS)</h4>
            </div>
            <div class="modal-body">
               
                <div class="panel panel-info">
                        <div class="panel-heading">
                            <h4 class="panel-title">Manage final year projects</h4>
                        </div>
                        <div class="panel-body">
                         Monitoring projects progress and by setting and tracking your project timeline and deliverables,
                         Assess both team and individual perfomance. 
                         Communicate with all parties in the project by using announcements.
                         Get working and informed in one place. 
                      </div>
                      
                  </div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                            <h4 class="panel-title">Final year project archive</h4>
                        </div>
                        <div class="panel-body">
                         Find all relevant information on implemented project, when they were done, 
                         by who, what they were all about and where they terminated.
                         Search based on year,tittle, supervisor,coordinator, and so much more! 
                      </div>
                      
                  </div>
            </div> 
        </div>
    </div>
</div>
        

        <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.js"></script>
        <script>$('#help').tooltip();</script>
   
    </body>
    
     
</html>                                                                        