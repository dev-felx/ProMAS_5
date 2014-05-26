<style>
    .pad_5{
        padding: 5px;
    }
</style>
<form id="ind_form" class="form-horizontal" role="form" method="POST">
    <div id="msg_frm"></div>
    <input type="hidden" id="form_id" name="form_id" class="form-control ">
    <div class="form-group">
        <label for="inputName" class="col-sm-4 control-label">Student Name.</label>
        <div class="col-sm-6">
            <p id="name" class="form-control-static">Alice Bob</p>
        </div>
        
        <label for="inputrReg.No" class="col-sm-4 control-label">Registration Number.</label>
        <div class="col-sm-6">
            <p id="reg_no" class="form-control-static">Alice Bob</p>
        </div>

        <label for="inputEnd Date" class="col-sm-4 control-label">Project Title.</label>
        <div class="col-sm-6">
            <p id="pro_name" class="form-control-static">Project Management and archiving system</p>
        </div>

        <label for="inputAssessment Week" class="col-sm-4 control-label">Week No.</label>
            <div class="col-sm-6">
                  <p id="wik" class="form-control-static">Project Management and archiving system</p>
            </div>
    </div>
    <div class="col-sm-10 col-sm-offset-1 bottom_10"><hr/></div>
    <div class="clearfix"></div>
    
    <div class="form-group">
        <label for="inputInitiative" class="col-sm-4 control-label">Initiative</label>
        <div class="col-sm-6">
            <input type="text" id="init" name="init" class="form-control" placeholder="Initiative(Attendance,Preparedness)/5 ">
        </div>
    </div>
    
    <div class="form-group">
        <label for="inputGeneral Project Understanding" class="col-sm-4 control-label">General Project Understanding</label>
        <div class="col-sm-6">
            <input type="text" id="gen" name="gen" class="form-control" placeholder="(General Project Understanding) /5">
        </div>
    </div>
    
    <div class="form-group">
        <label for="inputSpecific Contribution" class="col-sm-4 control-label">Specific Contribution</label>
        <div class="col-sm-6">
            <input type="text" id="spec" name="spec" class="form-control" placeholder="(Specific Contribution) /10">
        </div>
    </div>
    
    <div class="form-group">
        <label for="inputQuestions and Answers" class="col-sm-4 control-label">Questions and Answers</label>
        <div class="col-sm-6">
            <input type="text" id="qn" name="qn" class="form-control" placeholder="(Questions and Answers) /5" >
        </div>
    </div>
    
    <div class="form-group">
        <label for="inputComments" class="col-sm-4 control-label">Comments</label>
        <div class="col-sm-6">
            <textarea id="com" name="com" class="form-control" rows="3"></textarea>
        </div>
    </div>
    
    <div class="form-group">
        <div class="col-sm-2 col-sm-offset-8">
            <button id="sav_form" type="Submit" class="btn btn-success pull-right">Save</button>
        </div>
    </div>
</form>