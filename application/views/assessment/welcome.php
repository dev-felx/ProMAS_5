<style>
    .tab-pane{
        padding-top: 10px;
    }
</style>
<h3 class="text-center">Welcome to Assessment.</h3>
<hr/>
<div class="alert alert-info col-sm-8 col-sm-offset-2 text-center">
    <h5><strong>Hello!</strong>  You have not yet setup assessment for this project.</h5>
    <h4>To setup in 2 steps click setup below to begin</h4>
    <button id="setup_btn" role="button" class="btn btn-success">Begin Setup</button>
</div>
<div class="clearfix"></div>
<div id="setup" class="col-sm-10 col-sm-offset-1">
<h4 class="text-center">Project Assessment - Setup</h4>
<div><hr/></div>
<div style="border: #ccc solid 1px; border-radius: 5px; padding: 5px;" class="bottom_10" >
    <form class="form-horizontal" action="<?php echo site_url('/assessment/assess/setup'); ?>" method="POST">
    <div class="col-sm-10">
        <h4 class="text-info">Step 1: Choose interval for weekly assessment</h4>
        <hr/>
        <p>You can choose how frequently you will assess your student during the project</p>
        <div class="form-group">
            <div class="form-group">
                <label class="col-sm-3 control-label">After every:</label>
                <div class="col-sm-3">
                  <select class="form-control" name="interval">
                      <option value="1">1 week</option>
                      <option value="2">2 weeks</option>
                      <option value="3">3 weeks</option>
                  </select>
                </div>
                <span class="help-block text-warning">Note: default is 1 week</span>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>

    
    <div class="col-sm-10">
        <h4 class="text-info">Step 2: Miscellaneous</h4>
        <hr/>
     
            <div class="checkbox  bottom_10">
                <label>
                  Create events on my calender 
                  <input type="checkbox" name="event" value="1">
                </label>
                
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="notif" value="1">
                  Remind me via system notifications
                </label>
            </div>
          
    </div>
    <div class="clearfix"></div>
    <br/>
    <button id="save" class="btn btn-primary col-sm-2 col-sm-offset-5">Save</button>
     <div class="clearfix"></div>
</form> 
</div>
</div>

<script> 
    $('#setup').hide();
    $(document).ready(function(){
        $('#setup_btn').click( function(){
            $('#setup').slideDown();
        });
    });
</script>
