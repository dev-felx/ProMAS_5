<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*Author : Devid Felix
 * 
 * 
 */
?>


<script src="<?php echo base_url(); ?>assets/jquery/datatable/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/jquery/jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.min.js"></script>
   
<div id="manage_users" class="col-sm-12">            
    <div class='row' style="margin-bottom: -5px; ">
        <div class='pull-left'><h4>Manage Users - <?php echo ucfirst($user);   ?></h4></div>
        <div class="btn-group pull-right">
            <button type="button" class="btn btn-success pull-right push_left_bit dropdown-toggle" data-toggle="dropdown" >Add <?php echo ucfirst($user);   ?></button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo site_url(); ?>/manage_users/add_user/individual/<?php echo $user; ?>">Individual</a></li>
                <li class="divider"></li>
                <?php if(($user == 'student') || ($user =='supervisor') ){ ?>
                <li><a href="<?php echo site_url(); ?>/manage_users/add_group/group/<?php echo $user; ?>">Group</a></li>
                <?php }?>
            </ul>

        </div>
    </div>

    <div class="row">
        <hr style="border: none; height: 1px; background:#0093D0;"/>
    </div>
    
    <div class="row-fluid col-sm-12">
        <?php if(isset($message)){ ?>
        
        <h4 class="text-center text-success"><strong><?php echo $message; ?></strong></h4>
        <?php } ?>
    </div>
    <h4 class="pull-">Current <?php echo ucfirst($user); ?>s</h4>
    
<!--    <div class="row-fluid">        
    <form class="form-horizontal" role="form">
            <div class="form-group ">
            <label for="filter" class="control-label col-sm-1 ">Filter by</label>
                <div class="col-sm-2">
                    <select id="filter" class="form-control ">
                        <option>All</option>
                        <option>Groups</option>
                        <option>Supervisors</option>
                    </select>
                </div>
            
            <button type="submit" class=" col-sm-1 col-sm-offset-0 col-xs-10 col-xs-offset-1 btn btn-primary btn-sm"><span class="glyphicon glyphicon-cog push_right_bit"></span>Filter</button>
            
            <a type="button" onclick="return confirm('Are you sure you want to delete all <?php echo ucfirst($user); ?>s')" href="<?php echo site_url(); ?>/manage_users/manage/delete_all/" class="col-sm-1 col-sm-offset-1 col-xs-10 col-xs-offset-1 action_del btn_edge badge_link btn btn-danger btn-sm">
                <span class="glyphicon glyphicon-trash push_right_bit"></span>Delete all</a>
            
        
            </div>
    </form>
        </div>
    -->

    <div class="row">
        <div id='user_list' class="table-responsive col-sm-12">
            <table id="table_id" class=" table table-bordered table-striped dataTable">
            <!-- table heading -->
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
            <!-- table body -->
            <tbody>
            <?php 
               foreach ($table_data as $row) {
                   if($user=='student'){
                       $id= 'student_id';
                   }
                   else{
                       $id = 'user_id';
                   }
                   //settting user id
                   $user_id = $row[$id];

                   $row = array_slice($row, 1, 4);
                   echo '<tr>';  
                   foreach ($row as $value) {
                      echo '<td>'.$value.'</td>';
                   }
                   echo '<td>';
                   ?>
                      <a type="button" href="<?php echo site_url(); ?>/manage_users/manage/view/<?php echo $user_id; ?>/<?php echo $user; ?>" class="action_view btn_edge btn btn-primary btn-xs"><span class="glyphicon glyphicon-zoom-in push_right_bit"></span>View</a>
                        <a type="button" href="<?php echo site_url(); ?>/manage_users/manage/edit/<?php echo $user_id; ?>/<?php echo $user; ?>" class="action_edit btn_edge badge_link btn btn-success btn-xs"><span class="glyphicon glyphicon-pencil push_right_bit"></span>Edit</a>
                        <a type="button" onclick="return confirm('Are you sure you want to delete <?php echo ucfirst($row['first_name']) .' '.ucfirst($row['last_name']); ?>?')" href="<?php echo site_url(); ?>/manage_users/manage/delete/<?php echo $this->uri->segment(5,0); ?>/<?php echo $user_id; ?>/<?php echo $user; ?>" class="action_del btn_edge badge_link btn btn-danger btn-xs">
                            <span class="glyphicon glyphicon-trash push_right_bit"></span>Delete</a>
                  <?php echo '</td>';
                   echo '</tr>';  
                } 
            ?>
            </tbody>
            </table>
    </div>
    </div>
    <div class="row">
        <div style="text-align:center"><?php// echo $links; ?></div>
    </div>
    
</div>
  <script>
    
    $(document).ready(function(){
        
        $('#table_id').dataTable({
            //"sDom": '<"H"lfrT>t<"F"ip>T', // this adds TableTool in the center of the header and after the footer
//                "oLanguage": { "sSearch": "Search the Features:" },
//                "iDisplayLength": 25,
                //"bJQueryUI": true,
//                "sPaginationType": "full_numbers",
//                "aaSorting": [[0, "asc"]],
//                "bProcessing": true,
//                "aoColumns": [
//                /* 1st column hidden*/{"bVisible": false },
//                /* show 2nd column */null,
//                /* show 3rd column*/null,
//                /* show 4th column*/null
//                ]
            });
    });
    
    </script>