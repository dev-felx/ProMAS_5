<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div class="container-fluid">
    <div class="row">
        <div class='pull-left'><h4>Publish Project to Archive</h4></div>
        
            
        
<!--        <div class="btn-group pull-right">
            <button data-toggle="modal" href="#share_modal" type="button" class="btn btn-success push_right_bit " >Share Document</button>
            <a data-toggle="modal" href="#req_modal" type="button" class="btn btn-success  " >Request Document</a>
        </div>-->
    </div>
    <div class="row" style="margin-bottom: 15px;">
        <div class="hr"><hr/></div>
    </div>
    
    <div class="col-sm-10 col-sm-offset-1">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title text-center">Publish Projects into Archive</h3>
            </div>
            <div class="panel-body">
                <div id="msg_publish"></div>
                <form role="form" action="" method="">
                    <div class="form-group">
                        <label>Choose project</label>
                        <select class="form-control" id="projects" name="projects">
                            <?php foreach ($groups as $group){ 
                             echo "<option value='".$group['project_id']."'>".$group['title']."</option>";   
                            }
                            ?>
                        </select>
                    </div>
                </form>
                <div id="project_details" class=" hide">
                    <div id="abstract" class="row-fluid ">
                        <div class="hr"><hr/></div>
                        <h5 class=" text-success"><strong>Abstract</strong></h5>
                        <textarea class="form-control" rows="3"></textarea>
                    </div>
                    
                    <div id="doc"  class="row-fluid ">
                        <div class="hr"><hr/></div>
                        <h5 class="text-success"><strong>Documents</strong></h5>
                        <div  class=" text-info text-center hide"  id="req_load"></div>
                        <div id="check_box"></div>
                        <a id="request_modal_button" type="button" class="upload_m action_view btn_edge btn btn-success btn-sm"><span  href="#upload_modal"class=" push_right_bit"></span>Request Document</a>
                        <a id="upload_modal_button" data-group_no="" type="button" class=" action_view btn_edge btn btn-primary btn-sm"><span class="glyphicon glyphicon-upload push_right_bit"></span>Upload Document</a>
                    </div>
                    <div id="part"  class="row-fluid ">
                        <div class="hr"><hr/></div>
                        <h5 class="text-success"><strong>Group Names</strong></h5>
                        <ol id="stud_list" class="">
                        </ol>
                    </div>
                    <div class="row-fluid ">
                        <div class="hr"><hr/></div>
                    <div class="form-group">
                        <a name="group_no" id="publish_btn" type="submit" class="btn btn-primary col-sm-4 col-sm-offset-4">Publish</a>
                    </div>
                    </div>
                
            </div>
        </div>
    </div>
    
    
</div>
    </div>

<div id="req_modal" class=" modal fade in" >
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="req_form"  class="" action="<?php echo site_url(); ?>/project/file/request" method="post">
                   
                        <div class="modal-header">
                            <div id="msg" class="alert alert-info text-center"><b>Request Document</b></div>
                        </div>
                       <div class="modal-body">
                           <div class="form-group">
                                <label class="control-label" for="title">Document name</label><?php show_form_error('title'); ?>
                                      
                                <div class="radio"><label>
                                   <input class="req_docs" type="radio" name="req_doc" id="" value="Project Proposal"  checked="">
                                    Project Proposal
                                  </label>
                                </div>
                                <div class="radio">
                                  <label>
                                    <input class="req_docs" type="radio" name="req_doc" id="" value="Final Year Report">
                                    Final Year Report
                                  </label>
                                </div>
                                <div class="radio">
                                  <label>
                                      <input class="req_docs" type="radio" name="req_doc" id="others" value="0">
                                    Others
                                  </label>
                                </div>
                              <input class="form-control hide" placeholder="Name of the document to request" type="text" id="req_title" name="title">
                            </div>
                            </div>

                           <div class="form-group container-fluid">
                            <label for="Due Date" class=" control-label">Due date</label><?php show_form_error('duedate'); ?>
                            <div class="">
                                <input type="text" id="datepicker" class=" datepicker form-control" name="duedate" placeholder="Due Date">
                           </div>
                            </div>

                           <div class="modal-footer">
                                <button type="submit" class="btn btn-success" id="send_req">Request</button>
                                <a href="#" class="btn" data-dismiss="modal">Close</a>
                            </div>
                    </form>
                    </div>
            </div>
        </div>
 

<div id="upload_modal" class=" modal fade in" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div id="msg_upload" class="alert alert-info text-center"><strong>Upload a new Document to publish </strong><span id="msg_upload_span"></span></div>
                <h5 class="text-info"> <b></b></h5>
                </div>
                <form id="upload_form" method="POST" class=" form-horizontal" role="form" enctype="multipart/form-data" action="<?php echo site_url(); ?>/project/publish_project/upload_doc">
                <div class="modal-body">
                        <div class="form-group">
                            <div class='container-fluid'>
                                <label class="control-label" for="friedName">Document Name: <?php show_form_error('fName'); ?> </label>
                                <input type="text" class="form-control"  name="fName">
                                <input name="group_no" type="hidden">
                            </div>
                        </div>

                       <div class="form-group">
                            <div class='col-sm-8 '>
                                <label class="control-label" for="uploadForm_file"> File to Upload: </label>
                                <input type="file" name="userfile">
                            </div>
                        </div>  
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="upload_document">Upload</button>
                    <a href="#" class="btn" data-dismiss="modal">Close</a>
                </div>
                </form>
            </div>
        </div>
    </div>

<script>
    
    $('body').on('click', '#upload_modal_button', function () {
        $('[name="group_no"]','#upload_form').attr('value',$(this).data('group_no'));
        $('#upload_modal').modal();
    });
    $('body').on('click', '#request_modal_button', function () {
        
        $('#req_modal').modal();
    });
    $('#projects').change(function(){
       var group_no =  $(this).val();
       var function_url = "<?php echo site_url(); ?>/project/publish_project/get_project_details/".concat(group_no);
       $('#upload_modal_button').data('group_no',group_no);
    
    $.get( function_url).done(function(data) {
        $('#check_box').html('');
        $('#stud_list').html('');
        $('#req_load').html('');
         for(var i = 0; i < data.students.length; i++){
             $('#stud_list').append('<li>'+data.students[i]['first_name']+' '+data.students[i]['last_name']+' '+data.students[i]['registration_no']+ '</li>');
            
        }
        if(data.documents !==null){
            
            for(var i = 0; i < data.documents.length; i++){
                var button;
                var path = '<?php echo site_url(); ?>/project/file/download/'+data.documents[i][0].rev_file_path;
                if(data.documents[i][0]['req_status']==1){
                    button = '<div  class=""><button type="button" class="btn btn-link btn-xs"><strong>Required..</strong></button><a type="button" href="'+path+'" class="btn btn-primary btn-xs"><span class=" push_right_bit glyphicon glyphicon-download "></span>Download</a>\n\
                                <a type="button" data-rev_id="'+data.documents[i][0].rev_id+'" data-doc_id="'+data.documents[i][0].doc_id+'" data-name="'+data.documents[i][0].name+'" data-group_no="'+data.documents[i][0].group_no+'" class=" req_doc_btn_p btn btn-primary btn-xs"><span  href="#"></span>Request</a></div>\n\
                                ';
                }else{
                    button = '<button type="button" class="btn btn-link btn-xs"><strong>Optional..</strong></button>\n\
                                <a type="button" href="'+path+'" class="btn btn-primary btn-xs"><span class=" push_right_bit glyphicon glyphicon-download "></span>Download</a>';
                }
                    
               $('#check_box').append('<div class=" row-fluid checkbox"><label class="col-sm-6"><input name="chck" class="chk" type="checkbox" value="'+data.documents[i][0]['req_status']+'">'+data.documents[i][0]['name']+'</label>'+button+'</div>');
            }//end for loop
                
            for(var i = 0; i < data.documents.length; i++){
                    $('#select').append('<option class="select_option" value="'+data.documents[i][0].doc_id+'">'+data.documents[i][0].name+'</option>');
                }
        }else{
            $('#check_box').append('<div class="alert alert-warning text-center">No document has been submitted</div>');    
        }
        $('#publish_btn').attr('data-group_no',group_no);
        $('#project_details').removeClass('hide');
    },"json");
    
    });
    $('#projects').trigger('change');
    
    $('body').on('click', '.select_option', function () {
        var doc_name =$(this).text();
        var doc_id =$(this).val();     
        $('#list_doc_option').append('<a data-doc_id_option id="list_doc_option" class="list-group-item list-group-item-success">'+doc_name+'\
            <button class="pull-right" id="remove_option">Remove</button> </a>');
    });
    
    $('body').on('click', '.req_doc_btn_p', function () {
       var grp_no = $(this).data('group_no'); 
       var doc_id = $(this).data('doc_id'); 
       var rev_id = $(this).data('rev_id'); 
       var dc_name = $(this).data('name');
       $('#req_load').removeClass('hide');
       $('#req_load').html('<img style="height: 20px;" class="push_right_bit" src="<?php echo base_url(); ?>/assets/images/ajax-loader.gif"><strong>Sending....</strong>');
       var function_url = "<?php echo site_url(); ?>/project/publish_project/request_doc/".concat(doc_id)+"/".concat(rev_id)+"/".concat(grp_no)+"/".concat(dc_name);
       
    setTimeout(function(){
        $.get( function_url).done(function(data) {
        if(data.status=='success'){
            $('#req_load').removeClass('text-info');
            $('#req_load').addClass('text-success');
            $('#req_load').html('<strong>Request Sent</strong>');
        }else if(data.status=='not valid'){
            $('#req_load').html('Not Sent');
        }
    
    },"json");
    
    },400);

       
    });
    
    $('body').on('click', '#publish_btn', function () {
        var checkd = new Array();
        var i=0;
        $(".chk").each(function() {
            if($(this).is(":checked") && ($(this).val()==1) ){
                 checkd[i] = $(this).val();
            }
            i=i+1;
        });
        var valid_doc= checkd.length;
        
        if(valid_doc >= 2){
            var group_no = $(this).data('group_no');
            var function_url = "<?php echo site_url(); ?>/project/publish_project/publish/".concat(group_no);
            $.get( function_url).done(function(data) {
                if(data.status ==='success'){
                   var proj_id = data.project_profile_id;
                    archive_doc(proj_id);
                }else if(data.status ==='not valid'){
                    $('#msg_publish').addClass('text-center');
                    $('#msg_publish').addClass('text-danger');
                    $('#msg_publish').html('<strong>Not published</strong>');
                }
                });
            
            }else{
                $('#msg_publish').addClass('text-center');
                $('#msg_publish').addClass('text-danger');
                $('#msg_publish').html('<strong>Required documents must be checked</strong>');
            }
            });
    function archive_doc(projct_id){
        $(".chk:checked").each(function() {
            var doc_id = $(this).val();
            
            var function_url = "<?php echo site_url(); ?>/project/publish_project/publish_documents/".concat(doc_id)+"/".concat(projct_id);
            $.get( function_url).done(function(data) {
                if(data.status ==='success'){
                    $('#msg_publish').addClass('text-center');
                    $('#msg_publish').addClass('text-success');
                    $('#msg_publish').html('<strong>Project published successfull</strong>');
                }else if(data.status ==='not valid'){
                    $('#msg_publish').addClass('text-center');
                    $('#msg_publish').addClass('text-danger');
                    $('#msg_publish').html('<strong>Project not published</strong>');
                }

            },"json");
        });
    }
    
    $('#upload_document').click(function() {
        $("#upload_form").submit(function(){
            var formData = new FormData($(this)[0]);
            var formUrl = $("#upload_form").attr("action");
            $.ajax({
                url: formUrl,
                type: 'POST',
                data: formData,
                async: false,
                 success:function(data){
                     if(data.status === 'success') {
                        $('#msg_upload').removeClass('alert-info');
                        $('#msg_upload').addClass('alert-success');
                        $('#msg_upload').html('Document successfuly uploaded');
                        setTimeout(function(){ $('#upload_file_modal').modal('hide'); window.location.reload();},3000);

                    }else if(data.status === 'file_error') {
                      //  $.each(data.file_errors, function(key,val){
                        $('#msg_upload').removeClass('alert-info');
                        $('#msg_upload').addClass('alert-warning');
                        $('#msg_upload').html(data.file_errors);
                    //});
                    }else if(data.status === 'name_required') {
                      //  $.each(data.file_errors, function(key,val){
                        $('#msg_upload').removeClass('alert-info');
                        $('#msg_upload').addClass('alert-warning');
                        $('#msg_upload').html('Name field can not be empty');
                    //});
                    }
                 },
                 cache: false,
                 contentType: false,
                 processData: false
            });
            return false;
        });
        });
 


  
</script>


