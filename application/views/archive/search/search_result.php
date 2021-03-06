    <?php $this->load->view('archive/search/header'); ?>
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.js"></script>
    <link type="text/css" rel="Stylesheet" href="<?php echo base_url(); ?>assets/jquery/datatable/jquery.bootstrap.datatable.css">
    <script src="<?php echo base_url(); ?>assets/jquery/datatable/jquery.dataTables.js"></script>
    <script src="<?php echo base_url(); ?>assets/jquery/datatable/jquery.bootstrap.datatable.js"></script>

        <div class="container-fluid">
            <div class="row" style="margin-top: 40px;">
                <div id="leftside" class="col-sm-2">
                    <img src="<?php echo base_url(); ?>assets/images/banner.jpg" alt="sProMAS Archive" class="img-rounded col-sm-12">
                </div>
                <div id="maincon" class="col-sm-8">
                    <div class="page-header">
                        <form role="form" action="<?php echo site_url(); ?>/archive/archive/search_result/" method="POST">
                        <div class="input-group">
                            <input type="text" name="search_key" id="search_key" class="form-control">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="submit">Search!</button>
                                </span>
                        </div><!-- /input-group -->
                        <div class="list-group" id="hide_or_show_search_results_box" align="left"><span id="response_brought"></span></div>
                    </form>
                    </div>
                    <h4 style="color: #0076a7">Search Results for <?php echo $this->input->post('search_key');?></h4>
                    <div class="list-group">
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
                                <p class="list-group-item-text"><?php print $v->description ?></p>
                                </a></td>
                            </tr>
                    <?php      
                        }
                    }else {?>
                            <p>No Result Found</p>
                    <?php
                    }
                    ?>
                            </tbody>
                        </table>
                </div>
                </div>
            </div>
        </div>
        <!--footer class="login_footer" >
            <div class="col-sm-8 col-sm-offset-2">
                <hr style="border: none; height: 2px; color: blue; background: #0093D0;"/>
            </div>
            <div class="col-sm-8 col-sm-offset-2" style="margin-top: -20px; color: #0093D0; ">
                <h5 class="pull-left">UDSM | CoICT | Computer Science and Engineering Department</h5>
                <h5 class="pull-right">Copyright &COPY; <?php //echo date('20y', time()); ?> ProMAS</h5>
            </div>
        </footer-->
        <script>
            $('#help').tooltip();
            //data tables
            $('#user_list_table').dataTable();
        </script>
    </body>
</html>                                                      