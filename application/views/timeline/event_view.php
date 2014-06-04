<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* 
 * Author: Minja Junior
 * Desc: This file view events list.
 */
?>
<div class="row">
    <h4>Event list</h4>
    <div class="col-sm-9">
        <table id="" class="table table-striped">
            <thead>
                <th></th>
                <th>Event Title</th>
                <th>Description</th>
                <th>Start Date</th>
                <th>Due Date</th>
            </thead>
            <tbody>
            <?php   foreach ($test as $row) {?>
                <tr class="row">
                    <td><?php echo $row->title; ?></td>
                    <td><?php echo $row->desc; ?></td>
                    <td><?php echo $row->start; ?></td>
                    <td><?php echo $row->end; ?></td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
            
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <div id="add_new" class="sider"><?php $this->load->view('timeline/add_event_view'); ?></div>
    </div>
</div>