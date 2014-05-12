<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<script src="<?php echo base_url(); ?>assets/jquery/jquery-ui-1.10.3.custom/js/jquery-ui.js"></script>
<link type="text/css" rel="Stylesheet" href="<?php echo base_url(); ?>assets/jquery/jquery-ui-1.10.3.custom/css/jquery-ui.css" media="screen">
<script src="<?php echo base_url(); ?>assets/jquery/datatable/jquery.dataTables.js"></script>
<!--<link type="text/css" rel="Stylesheet" href="<?php echo base_url(); ?>assets/jquery/datatable/jquery.dataTables.css">-->

<div class="container-fluid">
    <div class="row" >
        <div class='pull-left'><h4>Project Documents</h4></div>
        <div class="btn-group pull-right">
            <button data-toggle="modal" href="#share_modal" type="button" class="btn btn-success push_right_bit " >Share Document</button>
            <a data-toggle="modal" href="#req_modal" type="button" class="btn btn-success  " >Request Document</a>
        </div>
    </div>
    <div class="row" style="margin-bottom: 15px;">
        <div class="hr"><hr/></div>
    </div>


<div class="row-fluid">
<div class="col-sm-10">
<table id="table_id" class=" table table-bordered table-striped dataTable">
             <!--table heading--> 
            <thead >
            <tr>
                <?php            
                    foreach ($table_head as $key ) {
                        echo '<th class=\'sorting_asc\' role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="'.ucwords(str_replace('_', ' ',$key )). ':activate to sort column descending">'
                        .ucwords(str_replace('_', ' ',$key )).'</th>';
                    }
                    
                    echo '<th>Actions</th>';
                ?>
            </tr>
            </thead>
            
                <?php
                echo '<thead><tr id="filter_global">';
                    foreach ($filter_fields as $key ) {
                        if($key=='#'){
                            echo '<th></th>';
                            continue;
                        }
                        echo '<th>'.$key.'</th>';
                    }
                    echo '</tr></thead>';
                    ?>
                    
             <!--table body--> 
            <tbody>
                 
            <?php $i=1; 
               foreach ($documents as $row ){
                   
                   if($row['doc_status']==4){//skip rows with shared files
                       break;
                   }
                   echo '<tr>';
                   echo '<td>'.$i.'</td>';
                   
                   foreach ($row as $key=> $value) {
                       
                   if(($key == 'name')||($key == 'project_id')||($key == 'due_date')||($key == 'doc_status')){
                   
                       if(($key=='doc_status')&& $value==0){
                            echo '<td>Not Submited</td>';
                            continue;
                        }elseif(($key=='doc_status')&& $value==1){
                            echo '<td>Submited</td>';
                       continue;
                        }elseif(($key=='doc_status')&& $value==2){
                            echo '<td>Approved</td>';
                            continue;
                        }
                       echo '<td>'.$value.'</td>'; 
                   }else{
                       
                       continue;
                   }
                   }
                   echo '<td>';
                   if($row['doc_status']=='1'){ //if document submitted show buttons below 
                       $file_path = $row['rev_file_path'];
                       ?>
            <!--<a type="button" href="<?php //echo site_url(); ?>/project/file/preview/<?php// echo base64_encode($file_path); ?>" class="action_edit btn_edge badge_link btn btn-success btn-xs"><span class="glyphicon glyphicon-zoom-in push_right_bit"></span></a>-->
            <a type="button" href="<?php echo site_url(); ?>/project/file/download/<?php echo base64_encode($file_path);  ?>" class="action_view btn_edge btn btn-primary btn-xs"><span class="glyphicon glyphicon-download push_right_bit"></span>Download</a>
            <a  data-status="<?php echo $row['doc_status']; ?>" data-rev_id="<?php echo $row['rev_id']; ?>" data-rev_status="<?php echo $row['rev_status']; ?>" data-rev_no="<?php echo $row['rev_no']; ?>" data-doc_name="<?php echo $row['name']; ?>" data-doc_id="<?php echo $row['doc_id']; ?>" type="button" class="upload_m action_view btn_edge btn btn-primary btn-xs"><span  href="#upload_modal"class="glyphicon glyphicon-upload push_right_bit"></span>Upload</a> 
                <?php 
                    }else{// if document not submitted
                       echo 'No action';
                   } echo '</td>';
                   echo '</tr>'; 
                   $i++;
                } 
            ?>
            </tbody>
            </table>
    </div>


    
    <div id="req_modal" class=" modal fade in" >
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="req_form"  class="" action="<?php echo site_url(); ?>/project/file/request" method="post">
                   
                        <div class="modal-header">
                            <div id="msg" class="alert alert-info text-center">Request Document</div>
                        </div>
                       <div class="modal-body">
                           <div class="form-group">
                               <label class="control-label" for="title">Document name</label><?php show_form_error('title'); ?>
                              <input class="form-control" type="text" id="title" name="title">
                           </div>

                           <div class="form-group">
                                <label for="receiver">Send to</label><?php show_form_error('receiver'); ?>
                                <?php
                                    if($this->session->userdata['type']=='coordinator'){
                                        echo '<div class="checkbox"><label><input name="group" type="checkbox" value="All groups">All groups</label></div>';
                                        
                                    } else if($this->session->userdata['type']=='supervisor'){

                                        echo '<div class="checkbox"><label><input name="group" type="checkbox" value="All groups">All groups</label></div>';
                                        echo '<div class="checkbox"><label><input name="group" id="choose_group" type="checkbox" value="Choose groups">Choose groups</label></div>';
                                    }
                                    ?>
                            </div>

                           <div id='groups' class="form-group">
                           <?php if($this->session->userdata['type']=='supervisor'){
                                        echo '<select multiple name="groups[]" class="form-control">';
                                        foreach ($groups as $value) { ?>
                                        <option value="<?php echo $value['project_id']; ?>"><?php echo $value['title']; ?></option> 
                                      <?php  }
                                      echo '</select>';
                                    } ?>
                              </div>           
                           <div class="form-group">
                            <label for="Due Date" class=" control-label">Due date</label><?php show_form_error('duedate'); ?>
                            <div class="">
                                <input type="text" id="datepicker" class=" datepicker form-control" name="duedate" placeholder="Due Date">
                           </div>
                        </div>

                           <div class="modal-footer">
                                <button type="submit" class="btn btn-success" id="send_req">Request</button>
                                <a href="#" class="btn" data-dismiss="modal">Close</a>
                            </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div id="share_modal" class=" modal fade in" >
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="share_form" class="" enctype="multipart/form-data" action="<?php echo site_url(); ?>/project/file/share_doc" method="POST">
                <div class="modal-header">
                    <div id="msg_share" class="alert alert-info text-center">Share Document</div>
                </div>
                <div class="modal-body">
                   
                    <div class="form-group">
                       <label class="control-label" for="title">Document name</label><?php show_form_error('name'); ?>
                      <input class="form-control" type="text" name="file_name">
                    </div>
                    <div class="form-group">    
                       <input type="file" name="userfile">
                    </div>
                    <div class="form-group">
                        <label for="receiver">Share with</label><?php show_form_error('receiver'); ?>
                        <?php
                            if($this->session->userdata['type']=='coordinator'){
                                echo '<div class="checkbox"><label><input name="group" type="checkbox" value="All groups">All groups</label></div>';
                                echo '<div class="checkbox"><label><input name="group" type="checkbox" value="All supervisors">All supervisors</label></div>';
                            } else if($this->session->userdata['type']=='supervisor'){
                                echo '<div class="checkbox"><label><input name="group" type="checkbox" value="All groups">All groups</label></div>';
                                echo '<div class="checkbox"><label><input name="group" id="choose_group_share" type="checkbox" value="Choose groups">Choose groups</label></div>';
                            }
                            ?>
                    </div>

                    <div id='groups_share' class="form-group">
                   <?php if($this->session->userdata['type']=='supervisor'){
                                echo '<select multiple name="groups[]" class="form-control">';
                                foreach ($groups as $value) { ?>
                                <option value="<?php echo $value['project_id']; ?>"><?php echo $value['title']; ?></option> 
                              <?php  }
                              echo '</select>';
                            } ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="share_document">Share</button>
                    <a href="#" class="btn" data-dismiss="modal">Close</a>
                </div>
                </form>
            </div>
        </div>
    </div>
    
    <div id="upload_modal" class=" modal fade in" >
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="upload_form" class="" enctype="multipart/form-data" action="<?php echo site_url(); ?>/project/file/upload_document" method="POST">
                    
                    <input name="status" type="hidden">
                    <input name="rev_id" type="hidden">
                    <input name="rev_status" type="hidden">
                    <input name="rev_no" type="hidden">
                    <input name="doc_name" type="hidden">
                    <input name="doc_id" type="hidden">
                <div class="modal-header">
                    <div id="msg_upload" class="alert alert-info text-center">Upload a revised version of this document<span id="msg_upload_span"></span></div>
                </div>
                <div class="modal-body">
                   
                    <div class="form-group">    
                       <input type="file" name="userfile">
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
    </div>
    </div>
<script>
    $( "#groups" ).hide();
    $( "#groups_share" ).hide();
    $(document).ready(function(){
        
        $('.upload_m').click(function() {
        $('[name="status"]','#upload_form').attr('value',$(this).data('status'));
        $('[name="rev_id"]','#upload_form').attr('value',$(this).data('rev_id'));
        $('[name="rev_status"]','#upload_form').attr('value',$(this).data('rev_status'));
        $('[name="rev_no"]','#upload_form').attr('value',$(this).data('rev_no'));
        $('[name="doc_name"]','#upload_form').attr('value',$(this).data('doc_name'));
        $('[name="doc_id"]','#upload_form').attr('value',$(this).data('doc_id'));
        if($('[name="status"]','#upload_form').attr('value') == '0'){
            $('#msg_upload_span').html('<p>Upload new document</p>');
        }else if($('[name="status"]','#upload_form').attr('value') == '1'){
            $('msg_upload_span').html('<p>Upload a new version of the previous document</p>');
        }
        $('#upload_modal').modal();
        return false;
    });
    
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
                        setTimeout(function(){ $('#req_modal').modal('hide'); window.location.reload();},3000);

                    }else if(data.status === 'file_error') {
                      //  $.each(data.file_errors, function(key,val){
                        $('#msg_upload').removeClass('alert-info');
                        $('#msg_upload').addClass('alert-warning');
                        $('#msg_upload').html(data.file_errors);
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
        
        
        $('#send_req').click(function() {
        var url = $("#req_form").attr("action");
        $.post( url, $("#req_form").serialize()).done(function(data) {
        if(data.status === 'not_valid'){
            $('#msg').removeClass('alert-info');
            $('#msg').addClass('alert-warning');
            $('#msg').html('Name, Group or Date can not be empty');
        }else if(data.status === 'success') {
            $('#msg').removeClass('alert-info');
            $('#msg').addClass('alert-success');
            $('#msg').html('Request sent');
            setTimeout(function(){ $('#req_modal').modal('hide'); window.location.reload(); },3000);
        }
        
        },"json");
        return false;
        });
     
     $('#share_document').click(function() {
        $("#share_form").submit(function(){
            var formData = new FormData($(this)[0]);
            var formUrl = $("#share_form").attr("action");
            $.ajax({
                url: formUrl,
                type: 'POST',
                data: formData,
                async: false,
                 success:function(data){
                     if(data.status === 'not_valid'){
                        $('#msg_share').removeClass('alert-info');
                        $('#msg_share').addClass('alert-warning');
                        $('#msg_share').html("Name or Group can not be empty");
                        
                    }else if(data.status === 'success') {
                        $('#msg_share').removeClass('alert-info');
                        $('#msg_share').addClass('alert-success');
                        $('#msg_share').html('Document successfuly shared');
                        setTimeout(function(){ $('#req_modal').modal('hide'); window.location.reload();},3000);

                    }else if(data.status === 'file_error') {
                      //  $.each(data.file_errors, function(key,val){
                        $('#msg_share').removeClass('alert-info');
                        $('#msg_share').addClass('alert-warning');
                        $('#msg_share').html(data.file_errors);
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
      
    var table = $('#table_id').dataTable({
        "sDom":'<"row-fluid"<"pull-left"l><"pull-right"f>>',
        //"order": [[ 3, "desc" ]]
        "bJQueryUI": true
        });
    });
    

    $('#choose_group').change(function() {
        $( "#groups" ).slideToggle(300);
    });
    $('#choose_group_share').change(function() {
        $( "#groups_share" ).slideToggle(300);
    });
    
    $(function(){
        $( "#datepicker" ).datepicker({ maxDate: "+1y"});
    });
    
</script>