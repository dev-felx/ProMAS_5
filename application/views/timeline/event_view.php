<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div class="row">
      
    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">

        <div class="boxed no-padding">

            <h4>Event list</h4>
            
          <div class="table-holder">

            <table id="" class="table table-striped table-bordered table-condensed">
              
                <thead>
                <th class="id hidden-xs">#</th>
                <th>Project Title</th>
                <th class="hidden-sm hidden-xs">Description</th>
                <th>Status</th>
                <th class="hidden-sm hidden-xs">Due Date</th>
                <th>Actions</th>
              </thead>
              
              <tbody>
                
                  <tr>
                  <td class="id hidden-xs">1</td>
                  <td>Agile Team Project</td>
                  <td class="hidden-sm hidden-xs">This is demo event 1</td>
                  <td>
                      <div class="progress progress-striped active">
                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                            45% Complete
                        </div>
                      </div>
                  </td>
                  <td class="hidden-sm hidden-xs">24/01/2015</td>
                  <td>
                    <a href="#" class="edit"><i class="fa fa-pencil"></i></a>
                    <a href="#" class="remove"><i class="fa fa-times"></i></a>
                  </td>
                
                  </tr>
                
                  <tr>
                  <td class="id hidden-xs">2</td>
                  <td>Bug Tracking Project</td>
                  <td class="hidden-sm hidden-xs">This is demo event 2.</td>
                  <td>
                      <div class="progress progress-striped active">
                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                            Delayed
                        </div>
                      </div>
                  </td>
                  <td class="hidden-sm hidden-xs">24/01/2014</td>
                  <td>
                    <a href="#" class="edit"><i class="fa fa-pencil"></i></a>
                    <a href="#" class="remove"><i class="fa fa-times"></i></a>
                  </td>
                 </tr>
                 
                 <tr>
                   <td class="id hidden-xs">3</td>
                   <td>Mango Project</td>
                   <td class="hidden-sm hidden-xs">This is demo event 3.</td>
                   <td>
                       <div class="progress progress-striped active">
                           <div class="progress-bar"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                               On Hold
                           </div>
                       </div>
                   </td>
                   <td class="hidden-sm hidden-xs">24/02/2014</td>
                   
                   <td>
                       pp
                   </td>
                 </tr>
              
              </tbody>
            </table>
          </div>
          <!-- Table Holder End -->
          </div>

        </div>
     

      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
              <!-- Title Bart Start -->
              <!-- Title Bart End -->
   <form id="add_timeline" class="" action="#" method="post">
       <div class="container-fluid">
           
       <div class="alert alert-info text-center">Add new event</div>
              
       
       <div class="form-group">
          <label class="control-label" for="title">Event Title</label>
          <input class="form-control" type="text" placeholder="Title..." id="title" name="title">
       </div>
       <div class="form-group">
            <label class="control-label" for="description">Event Description</label>
            <textarea class="form-control" rows="3" placeholder="Description..." id="description" name="description"></textarea>
       </div>
                  
       <div class="form-group">
        <label for="Start Date" class=" control-label">Start Date</label>
        <div class="">
            <input type="text" id="datepicker1" class=" datepicker form-control" name="sdate" placeholder="Start Date">
       </div>
    </div>

    <div class="form-group">
        <label for="End Date" class=" control-label">End Date</label>
        <div class="">
            <input type="text" id="datepicker2"  class="datepicker form-control" name="edate" placeholder="End Date">
        </div>
    </div>
     
       <div class="form-group">
   
           <button class="btn btn-sm btn-success" type="button">Create</button>
           
       </div>

      <div class="clearfix"></div>
</div>
</form>
                <!-- New Project Form End -->
      </div>
       
            

            </div>

        <!-- Row End -->

