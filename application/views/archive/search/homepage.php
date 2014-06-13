
        <?php $this->load->view('archive/search/header'); ?>
        <div class="container-fluid" style="z-index: 10">
            <div class="row" style="margin-top: 50px;">
                <div class="jumbotron" style="background-color: #007AAC; color: white; //#006F9D; #BCE8F1;">
                    <div class="container">
                        <h1 style="//color: #0093D0;">sProMAS Archive</h1>
                        <p >Welcome to students Project Management and Archiving System (sProMAS) Archive.<br>
                        You can look up and explore projects done by final year students at the College of Informatics and Communication Technology (CoICT)
                        of the University of Dar es Salaam. All information about projects participants and related documents is available here.</p>
                        <p><a href="<?php echo site_url('archive/archive/explore'); ?>" class="btn btn-primary btn-lg" role="button">Explore Projects</a>
                            <a href="<?php echo site_url('archive/archive/search');?>" class="btn btn-primary btn-lg pull-right" role="button">Search Projects</a></p>
                    </div>
                </div>
            </div>
        </div>
        <footer class="login_footer navbar-fixed-bottom" >
            <div class="col-sm-8 col-sm-offset-2">
                <hr style="border: none; height: 2px; color: blue; background: #0093D0;"/>
            </div>
            <div class="col-sm-8 col-sm-offset-2" style="margin-top: -20px; color: #0093D0; ">
                <h5 class="pull-left">UDSM | CoICT | Computer Science and Engineering Department</h5>
                <h5 class="pull-right">Copyright &COPY; <?php echo date('20y', time()); ?> ProMAS</h5>
            </div>
        </footer>
        <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.js"></script>
        <script>$('#help').tooltip();</script>
    </body>
</html>