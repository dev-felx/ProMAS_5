<style>
    .tab-pane{
        padding-top: 10px;
    }
</style>
<h3>Project Assessment - Setup</h3>
<div><hr/></div>
<div style="border: #ccc solid 1px; border-radius: 5px; padding: 5px;" class="bottom_10" >
<form class="form-horizontal">
    <div class="col-sm-10">
        <h4 class="text-info">Step 1: Choose interval for weekly assessment</h4>
        <hr/>
        <p>You can choose how frequently you will assess your student during the project</p>
        <div class="form-group">
            <div class="form-group">
                <label class="col-sm-3 control-label">After every:</label>
                <div class="col-sm-3">
                  <select class="form-control">
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
        <h4 class="text-info">Step 2: Customize the assessment forms</h4>
        <hr/>
            <ul class="nav nav-tabs nav-justified">
                    <li class="active"><a href="#ind" data-toggle="tab">Individual Student Form (Weekly)</a></li>
                    <li><a href="#grp" data-toggle="tab">Group Form (Project Reports)</a></li>
              </ul>

              <!-- Tab panes -->
              <div class="tab-content">
                  <div class="tab-pane active" id="ind">
                      <?php $this->load->view('assessment/ind_form'); ?>
                  </div>
                  <div class="tab-pane" id="grp">
                      <?php $this->load->view('assessment/grp_form'); ?>
                  </div>
              </div>
    </div> 
    <div class="clearfix"></div>
    
    <div class="col-sm-10">
        <h4 class="text-info">Step 3: Miscellaneous</h4>
        <hr/>
     
            <div class="checkbox  bottom_10">
                <label>
                  Create events on my calender 
                  <input type="checkbox" value="">
                </label>
                
            </div>
            <div class="checkbox">
                <label>
                  <input type="checkbox" value="">
                  Remind me via system notifications
                </label>
            </div>
          
    </div>
    <div class="clearfix"></div>
    <br/>
    <button role="submit" class="btn btn-primary col-sm-2 col-sm-offset-4">Save</button>
     <div class="clearfix"></div>
</form> 
</div>