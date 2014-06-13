        <?php $this->load->view('archive/search/header'); ?>
        <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.js"></script>
        <link type="text/css" rel="Stylesheet" href="<?php echo base_url(); ?>assets/jquery/datatable/jquery.bootstrap.datatable.css">
        <script src="<?php echo base_url(); ?>assets/jquery/datatable/jquery.dataTables.js"></script>
        <script src="<?php echo base_url(); ?>assets/jquery/datatable/jquery.bootstrap.datatable.js"></script>
        <div class="container-fluid">
            <div class="row" style="margin-top: 40px;">
                <div id="leftside" class="col-sm-2">
                    <img src="<?php echo base_url(); ?>assets/images/banner.jpg" alt="sProMAS Archive" class="img-rounded col-sm-12">
                    <div style="margin-top: 120px;" id="login_box" class="container-fluid text-center">
                        <div class="alert alert-info text-center col-sm-offset-1" >Filter by</div>
                        <h5>Alphabetical</h5>
                        <div class="btn-group">
                            <button type="submit" name="filter" value="asc" class="btn btn-primary" id="filter" onclick="filter();">A-Z</button>
                            <button type="submit" name="filter" value="za" class="btn btn-primary" id="filter" onclick="filter();">Z-A</button>
                        </div>
                    </div>
                </div>
                <div id="maincon" class="col-sm-8">
                    <div class="page-header">
                        <h2 style="color: 0076a7;">sProMAS Archive Explorer</h2>
                    </div>
                    <h4 style="color: #0076a7">Latest Project's</h4>
                    <div class="list-group" id="maincon">
                        <div id="loading"></div>
                    <?php
                    if(!empty($res)){?>
                        <table id="user_list_table"  width="100%">
                            <thead>
                                <tr>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                        <?php
                        foreach($res as $v){?>
                            <tr>    
                                <td><a href="<?php echo site_url(); ?>/archive/archive/profile/<?php print $v->project_profile_id ?>" class="list-group-item">
                                <h4 class="list-group-item-heading"><?php print $v->project_name ?></h4>
                                <p class="list-group-item-text">some details about project</p>
                                </a></td>
                            </tr>
                    <?php      
                        }
                    }else {?>
                            <p>No Result Found</p>
                    <?php
                    }
                    ?>      </tbody>
                        </table>
                </div>
                </div>
            </div>
        </div>
        <footer class="login_footer" >
            <div class="col-sm-8 col-sm-offset-2">
                <hr style="border: none; height: 2px; color: blue; background: #0093D0;"/>
            </div>
            <div class="col-sm-8 col-sm-offset-2" style="margin-top: -20px; color: #0093D0; ">
                <h5 class="pull-left">UDSM | CoICT | Computer Science and Engineering Department</h5>
                <h5 class="pull-right">Copyright &COPY; <?php echo date('20y', time()); ?> ProMAS</h5>
            </div>
        </footer>
        <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.js"></script>
        <script>
            $('#help').tooltip();
            //data tables
            $('#user_list_table').dataTable();
        </script>
    </body>
</html>                                                      