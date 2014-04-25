<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div class=" col-sm-7" >
<div class=" text- text-info" ><b>Required Documents</b></div>    
<table id="table_id" class=" table table-bordered table-striped ">
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
                   
                   $row = array_slice($row, 1, 2);
                   
                   echo '<tr>';
                   echo '<td>'.$i.'</td>';
                   foreach ($row as $value) {
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
    