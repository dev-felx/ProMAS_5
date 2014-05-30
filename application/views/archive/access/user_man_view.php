<div>
    <h4 class="col-sm-3 pull-left">Archive User Manager</h4> 
    <div class="btn-group pull-right push_left_bit">
        <button type="button" class="btn btn-success dropdown-toggle " data-toggle="dropdown">Add New User<span class="caret push_left_bit"></span></button>
        <ul class="dropdown-menu" role="menu">
          <li><a id="show_single" href="#">Single</a></li>
          <li class="divider"></li>
          <li><a href="#">Multiple</a></li>
        </ul>
    </div>
    <a href="<?php site_url('/assessment/assess/report') ?>" role="button" class="btn btn-success pull-right">Access Requests<span class="badge push_left_bit">0</span></a>
    
</div>
<div class="clearfix"></div>
<hr/>

<!-- Forms for adding users -->
<div class="col-sm-6 col-sm-offset-3" id="add_single">
    <form id="add_single_form" role="form" action="<?php echo site_url('archive/access/user/new'); ?>" method="POST">
        <div class="alert alert-info text-center">Add New User</div>
        <div class="form-group">
            <label for="fname">First Name</label>
            <input type="text" name="fname" class="form-control">
        </div>
        <div class="form-group">
            <label for="lname">Last Name</label>
            <input type="text" name="lname" class="form-control">
        </div>
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="text" name="email" class="form-control">
        </div>
        <div class="form-group">
            <label for="type">User Type</label><br/>
            <label class="radio-inline">
                <input id="stu_radio" name="type" type="radio"  value="1" checked="checked">Student
            </label>
            <label class="radio-inline">
                <input id="non_radio" name="type" type="radio"  value="0">Non Student
            </label>       
        </div>
        <div class="form-group" id="reg">
            <label for="reg">Registration Number</label>
            <input type="text"  name="reg" class="form-control">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success pull-right">Add and Send Email</button>
            <button id="cancel" class="btn btn-warning pull-right push_right_bit">Cancel</button>
        </div>
    </form>
</div>
<script>
    $('#add_single').hide();
    $('#show_single').click(function(){
        $('#add_single').slideDown();
        return false;
    });
    $('#cancel').click(function(){
        $('#add_single').hide();
        return false;
    });
    $('#stu_radio').change(function(){
        $('#reg').show();
    });
    $('#non_radio').change(function(){
        $('#reg').hide();
    });
</script>