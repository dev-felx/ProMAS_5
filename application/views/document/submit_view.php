<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<script src="<?php echo base_url(); ?>assets/jquery/datatable/jquery.dataTables.js">

$('body').on('hidden.bs.modal', '.modal', function () {
        $(this).removeData('bs.modal');
      });

</script>

<div class="container-fluid">
<div class="row" >
        <div class='pull-left'><h4>Project Documents</h4></div>
<!--        <div class="btn-group pull-right">
            <button type="button" class="btn btn-success pull-right push_right_bit" >Share Document</button>
            <button type="button" class="btn btn-success pull-right push_right_bit " >Request Document</button>
        </div>-->
    </div>
    <div class="row" style="margin-bottom: 15px;">
        <div class="hr"><hr/></div>
    </div>

<div class=" col-sm-10" >

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
             <!--table body--> 
            <tbody>
            <?php $i=1; 
               foreach ($documents as $row){
                   
                   if($row['doc_status']==2){//skip rows with shared files
                       break;
                   }
                   
                   $doc_id = $row['doc_id'];
                   $file_name = $row['name'];
                   
                   echo '<tr>';
                   echo '<td>'.$i.'</td>';
                   
                   foreach ($row as $key=> $value) {
                   
                       if(($key == 'name')||($key == 'creator_role')||($key == 'due_date')||($key == 'doc_status')){
                   
                           if(($key=='doc_status')&& $value==0){
                               echo '<td>Not Submited</td>';
                               continue;
                           }elseif(($key=='doc_status')&& $value==1){
                               echo '<td>Submited</td>';
                               continue;
                           }
                           elseif(($key=='doc_status')&& $value==2){
                               echo '<td>Approved</td>';
                               continue;
                           }
                           elseif(($key=='doc_status')&& $value==4){
                               echo '<td>Shared</td>';
                               continue;
                           }
                           echo '<td>'.$value.'</td>';
                       }else{
                           
                           continue;
                       }
                   
                      
                   }
                   echo '<td>';
                   if($row['doc_status']=='1'){ ?>
            <a type="button" href="<?php echo site_url(); ?>/project/file/download/<?php echo base64_encode($row['rev_file_path']);  ?>" class="action_view btn_edge btn btn-primary btn-xs"><span class="glyphicon glyphicon-download push_right_bit"></span>Download</a>
                   <?php }
                   ?>
                       <a  data-status="<?php echo $row['doc_status']; ?>" data-rev_status="<?php echo $row['rev_status']; ?>" data-rev_id="<?php echo $row['rev_id']; ?>" data-rev_no="<?php echo $row['rev_no']; ?>" data-doc_name="<?php echo $row['name']; ?>" data-doc_id="<?php echo $row['doc_id']; ?>" type="button" class="upload_m action_view btn_edge btn btn-primary btn-xs"><span  href="#upload_modal"class="glyphicon glyphicon-upload push_right_bit"></span>Upload</a>
                  <?php echo '</td>';
                   echo '</tr>'; 
                   $i++;
                } 
            ?>
            </tbody>
            </table>
           </div>
    
    <div id="calender_left" class="col-sm-2 no_pad no_mag" >
    <div id="flash_info" class="sider">
            <div class="alert-info alert text-center pad_10">Shared Documents</div>
            <div class="col-sm-12 up_event">
                <?php foreach ($documents as $row){
                echo '<div class="up_event_item">';
                
                   if($row['doc_status'] == 2){//skip rows with shared files
                       foreach ($row as $key=> $value) {
                       if($key == 'name'){
                       echo '<div><strong>'.$value.'</strong></div>';
                       }
                   } ?>
                   <a type="button" href="<?php echo site_url(); ?>/project/file/download/<?php echo base64_encode($row['rev_file_path']);  ?>" class="action_view btn_edge btn-link btn btn-primary btn-xs"><span class="glyphicon glyphicon-download push_right_bit"></span>Download</a>
                   <div class="hr"><hr/></div></div>
                   <?php
                   }
                   }
                ?>
                        
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
                    <div id="msg_upload" class="alert alert-info text-center">Upload Document<span id="msg_upload_span"></span></div>
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
<script>
$(document).ready(function(){
    
    $('.upload_m').click(function() {
        $('[name="status"]','#upload_form').attr('value',$(this).data('status'));
        $('[name="rev_id"]','#upload_form').attr('value',$(this).data('rev_id'));
        $('[name="rev_no"]','#upload_form').attr('value',$(this).data('rev_no'));
        $('[name="rev_status"]','#upload_form').attr('value',$(this).data('rev_status'));
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
        
        $('#table_id').dataTable({
            "sDom":'<"row-fluid"<"pull-left"l><"pull-right"f>>',
            //"bJQueryUI": true,
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
        
        });

</script>