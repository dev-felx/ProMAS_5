<div class="col-sm-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title text-center">Project Groups</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label>Search using project name</label>
                    <div class="input-group">
                        <input type="text" class="form-control">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-search text-success"></span></span>
                    </div>
                </div>
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
                <div class="form-group">
                    <label>Report type</label>
                    <select id="type" class="form-control">
                        <?php 
                            echo '<option></option>';
                            foreach ($forms as $value){
                                echo '<option value="'.$value['form_id'].'">'.$value['type'].'</option>';
                            }
                        ?>
                     </select>
                </div>
                
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title text-center">Report Assessment Form</h3>
            </div>
            <div class="panel-body">
                <?php $this->load->view('assessment/grp_form'); ?>
            </div>
        </div>
    </div>
<script>
    var forms = <?php echo json_encode($forms); ?>;
    var curr_form;
    $(document).ready(function(){ 
        $( "#pro" ).change(function() {
            curr_form = $(this).val();
            
        });
        
        $( "#pro" ).change(function() {
            var id = $(this).val();   
        });
    }); 
</script>