    <div id="arch_head" class="col-sm-12">
        <div class="container-fluid">
            <div id="login_cont" class="col-sm-2 pull-right" >
                <?php if($this->session->userdata('user_id_arch') == ''){ ?>
                    <span id="arch_name" class="pull-right push_left_bit">Login</span>
                <?php }else{ ?>
                    <span id="arch_name" class="pull-right push_left_bit"><?php echo $this->session->userdata('fname').' '.$this->session->userdata('fname'); ?></span>
                <?php } ?>    
                <button class="btn btn-cyc pull-right " ><span class="glyphicon glyphicon-user"></span></button>
                
            </div>
        </div>
    </div>
    <div id="slide_box" class="col-sm-3 col-sm-offset-9">
        <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title text-center">sProMAS Archive Login</h3>
            </div>
            <div class="panel-body">
                <?php if($this->session->userdata('user_id_arch') == ''){ ?>
                <form id="login_form" role="form" action="<?php echo site_url('/archive/access/login'); ?>" method="POST">
                    <div id="msg_log"></div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                            <input name="username" type="text" class="form-control" placeholder="Enter email">                
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            <input name="pass" type="text" class="form-control" placeholder="Enter your password">                
                        </div>
                    </div>
                    <div class="form-group">
                        <button id="login_btn" class="btn btn-info btn-block">Login</button>
                    </div>
                </form> 
                <?php }else { ?>
                <a href="<?php echo site_url('/archive/access/logout') ?>" class="btn btn-primary btn-block">Logout</a>
                <?php } ?>
            </div>
            <div class="panel-footer">
                
                <a href="<?php echo site_url('/access/login'); ?>" class="pull-left">Use Management Account</a>
                <?php if($this->session->userdata('user_id_arch') == ''){ ?>
                    <a href="#" class="pull-right">Recover Password</a>
                <?php }else{ ?>
                    <a href="#" class="pull-right">Change Password</a>
                <?php } ?>
                <div class="clearfix"></div>
            </div>
          </div> 
    </div>
<script>
    $('#slide_box').hide();
    $('#login_cont').click(function(){
        $('#slide_box').slideToggle();
    });
    $(document).ready(function(){
        $('#login_btn').click(function(){
            $('#msg_log').html('<div class="alert alert-info"><img style="height: 30px;" class="col-sm-offset-4 push_right_bit" src="<?php echo base_url(); ?>/assets/images/ajax-loader.gif">Logging in...</div>');
                 setTimeout(function(){
                     var t = "<?php echo site_url(); ?>";
                     var c = t+"/archive/access/login";
                     $.post( c, $("#login_form").serialize()).done(function(data) {
                          if(data.status == 'false'){
                              $('#msg_log').html('<div class="alert alert-danger">'+data.data+'</div>');
                          }else if(data.status == 'true'){
                              window.location.reload();
                          }
                    },'json');
                 },400);
                 return false;
         });
     });
</script>
    
