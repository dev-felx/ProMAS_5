<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<script src="<?php echo base_url(); ?>assets/jquery/datatable/jquery.dataTables.js"></script>

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

<div class=" col-sm-8" >

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
                   
                   $doc_id = $row['file_id'];
                   $file_name = $row['file_name'];
                   
                   echo '<tr>';
                   echo '<td>'.$i.'</td>';
                   
                   foreach ($row as $key=> $value) {
                   if(($key == 'file_id')||($key == 'file_type')||($key == 'file_creator_id')||($key == 'file_path')||($key == 'space_id')||($key == 'file_owner_id')){
                       continue;
                   }
                   if(($key=='file_status')&& $value==0){
                       echo '<td>Not Submited</td>';
                       continue;
                   }elseif(($key=='file_status')&& $value==1){
                       echo '<td>Submited</td>';
                       continue;
                   }
                   elseif(($key=='file_status')&& $value==2){
                       echo '<td>Approved</td>';
                       continue;
                   }
                      echo '<td>'.$value.'</td>';
                   }
                   echo '<td>';
                   ?>
                      <a type="button" href="<?php echo site_url(); ?>/project/file/upload_view/<?php echo $doc_id; ?>/<?php echo $file_name; ?>" class="action_view btn_edge btn btn-primary btn-xs"><span class="glyphicon glyphicon-upload push_right_bit"></span>Upload</a>
                        
                  <?php echo '</td>';
                   echo '</tr>'; 
                   $i++;
                } 
            ?>
            </tbody>
            </table>
           </div>
    </div>
<script>
$(document).ready(function(){
        
        $('#table_id').dataTable({
            "sDom":'<"row-fluid"<"pull-left"l><"pull-right"f>>',
            "bJQueryUI": true,
        });
    });

</script>