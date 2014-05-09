<?php
/*
 * Author:  Tesha Evance
 * Description: Dynamic side bar creator
 * Comments: Add to configuration only 
*/

/*
 *===========TEMPLATE======
 * $accordion['user'] = array(
 *                          'menu_group' => array(
 *                                              array('menu-item' = 'menu_item_link)
 *                                              .
 *                                              .
 *                                              . 
 *                                          )
 *                          .
 *                          .
 *                          .     
 *                     )
 *                     .
 *                     .
 *                     .
 * Examples:
 *      user = administrator
 *      menu_group = manage users, timeline etc
 *      menu_item =  events,announcements, etc
 *      menu_item_link = manage_user/supervisor, timline/events !NOTE-dont put the leading slash.
 * 
 *  */
//===========CONFIGURATION=============

    //for superuser
    $accordion['superuser'] = array(
        'Manage users' => array(
                                    array('Administrator' => 'manage_users/manage/users/administrator'),
                                    array('Coordinator' => 'manage_users/manage/users/coordinator'),
                                    array('Supervisor' => 'manage_users/manage/users/supervisor'),
                                    array('Student' => 'manage_users/manage/users/student'),
                                    
                               ),
        'Project' => array(
                                    array('Documents' => 'project/file'),
                                    array('Announcements' => 'project/announce'),
                               )
        
    );



    //for administrator 
    $accordion['administrator'] = array(
        'Manage users' => array(
                                    array('Coordinator' => 'manage_users/manage/users/coordinator'),
                                    array('Supervisor' => 'manage_users/manage/users/supervisor'),
                                    array('Student' => 'manage_users/manage/users/student'),
                                    
                               ),
        'Project' => array(
                                    array('Documents' => 'project/file'),
                                    array('Announcements' => 'project/announce'),
                               )
        
    );
    
    //for coordinator
    $accordion['coordinator'] = array(
        'Manage users' => array(
                                    array('Supervisor' => 'manage_users/manage/users/supervisor'),
                                    array('Student' => 'manage_users/manage/users/student'),
                                    
                               ),
        'Project' => array(
                                    array('Documents' => 'project/file'),
                                    array('Announcements' => 'project/announce'),
                               ),
        'Schedule' => array(
                                    array('Event list' => 'timeline/timeline/event'),    // Modified by Minja Junior
                                    array('Calendar' => 'home'),
                               )
        
    );
    
     //for supervisor
    $accordion['supervisor'] = array(
        
        'Schedule' => array(
                                    array('Event list' => 'timeline/timeline/event'),    // Modified by Minja Junior
                                    array('Calendar' => 'home'),
                               ),
        'Project' => array(
                                    array('Documents' => 'project/file'),
                                    array('Announcements' => 'project/announce'),
                               ),
        'Assesment' => array(
                                    array('Weekly Progress' => 'assessment/assess/'),
                                    array('Project Reports' => 'assessment/assess/'),
                                    array('Project Presenations' => 'assessment/assess_panel/')
                        )
        
    );
    
    $accordion['student'] = array(
        
        'Schedule' => array(
                                    array('Event list' => 'timeline/timeline/event'),    // Modified by Minja Junior
                                    array('Calendar' => 'home'),
                               ),
        'Project' => array(
                                    array('Documents' => 'project/file'),
                                    array('Announcements' => 'project/announce'),
                               )
        
    );
    
    //=======ENGINE=========
?>

<div class="col-sm-2" style="padding-left: 4px; padding-right: 5px;">
    <!-- Role Box -->
    <div id="role_box" class="bottom_10" style="background-color: #fafafa">
        <button class="btn btn-circle center-block text-primary"><span class="glyphicon glyphicon-user"></span></button>
        <p id="role_btn" class="text-center text-primary"><?php echo ucfirst($this->session->userdata['type']); ?> <span class="glyphicon glyphicon-chevron-down"></span></p>
        <?php if($this->session->userdata['type'] != 'student' && count($this->session->userdata['roles']) > 1) { $roles = $this->session->userdata['roles'];?>
            <ul class="list-group" id="role_list">
                <p class="text-center">Change your current role</p>
                <?php for($i = 1;$i <= count($roles);$i++){
                    if($roles[($i - 1)] == $this->session->userdata['type']){
                            continue;
                    }else{?>
                <li class="list-group-item"><a href="<?php echo site_url()."/home/change_role/".$roles[($i - 1)];?>"><span class="glyphicon push_right_bit glyphicon-user"></span><?php echo ucfirst($roles[($i - 1)]); ?><span class="glyphicon glyphicon-chevron-right pull-right visible-xs"></span></a></li>
                    <?php }} ?>
            </ul>
        <?php } ?>
              
    </div>
    
    
    <!-- Side Bar view -->
    <div class="panel-group" id="accordion">
        <?php foreach ($accordion[$this->session->userdata['type']] as $key => $value) { ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title text-center" data-toggle="collapse" data-parent="#accordion" href="#<?php echo str_replace(' ', '_', $key) ?>">
                        <a  href="#"><?php echo $key ?></a>
                    </h4>
                </div>
                <div id="<?php echo str_replace(' ', '_', $key) ?>" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul class="list-group">
                            <?php foreach ($value as $sub_value) { 
                                    foreach ($sub_value as $sub_sub_key => $sub_sub_value) {?>
                            <li class="list-group-item"><a href="<?php echo site_url().'/'.$sub_sub_value ?>"><?php echo $sub_sub_key; ?></a></li>
                            <?php   }
                                  } ?>
                        </ul>
                    </div>
                </div>
            </div>
      <?php } ?>
      </div>
      </div>

<?php if(($this->session->userdata['type']=='coordinator') && !isset($this->session->userdata['space_id'])){ ?>
<script>
    $('.panel-title').click(function () {
        return false;
    });
</script>
<?php } ?>
<script>
    $('#role_list').hide();
    $('#role_btn').on('click', function () {
            $('#role_list').slideToggle(500);
            return false;
    });
</script>
