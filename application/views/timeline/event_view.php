<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* 
 * Author: Minja Junior
 * Desc: This file view events list.
 */
?>
<div class="row">
    <h4>Event list</h4>
    <div class="table-responsive col-sm-9">
        <table id="" class="table table-striped table-bordered">
            <thead>
                <th></th>
                <th>Event Title</th>
                <th>Description</th>
                <th>Status</th>
                <th>Due Date</th>
                <th>Actions</th>
            </thead>
            <tbody>
            <?php   foreach ($test as $row) {?>
                <tr class="row">
                    <td><?php echo $row->title; ?></td>
                    <td><?php echo $row->desc; ?></td>
                    <td><?php echo $row->status; ?></td>
                    <td><?php echo $row->end; ?></td>
                    <td>
                        <!--a type="button" href="#" class="action_view btn_edge btn btn-primary btn-xs"><span class="glyphicon glyphicon-zoom-in push_right_bit"></span>View</a>
                        <a type="button" href="#" class="action_edit btn_edge badge_link btn btn-success btn-xs"><span class="glyphicon glyphicon-pencil push_right_bit"></span>Edit</a-->
                        <a type="button" href="#" class="action_del btn_edge badge_link btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash push_right_bit"></span>Delete</a>
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
            
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <div id="add_new" class="sider"><?php $this->load->view('timeline/add_event_view'); ?></div>
    </div>
</div>