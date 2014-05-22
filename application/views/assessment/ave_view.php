<div class="col-sm-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title text-center">Students</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label>Choose Project</label>
                    <select id="pro" class="form-control">
                        <?php 
                            foreach ($projects as $value){
                                echo '<option value="'.$value['project_id'].'">'.$value['title'].'</option>';
                            }
                        ?>
                      </select>
                </div>
                <div>
                    <label>Students</label>
                    <ul id="stu" class="list-group">
                      </ul>
                </div>
                <div class="form-group">
                    <label>Week Number</label>
                    <select id="week" class="form-control">
                        
                     </select>
                </div>
                
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title text-center">Student Assessment Form</h3>
            </div>
            <div id="form_cont" class="panel-body">
                <?php $this->load->view('assessment/ind_form'); ?>
            </div>
        </div>
    </div>