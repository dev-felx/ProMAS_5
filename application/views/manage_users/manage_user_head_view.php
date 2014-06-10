<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class='row' style="margin-bottom: -5px; ">
        <div class='pull-left'><h4>Manage Users - <?php echo ucfirst(str_replace('_',' ', $user));   ?></h4></div>
        <?php if(($user == 'student') || ($user =='supervisor') ){ ?>
            <div class="btn-group pull-right">
            <button type="button" class="btn btn-success dropdown-toggle push_right_bit" data-toggle="dropdown" >Add <?php echo ucfirst(str_replace('_',' ', $user));   ?></button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo site_url(); ?>/manage_users/add_user/individual/<?php echo $user; ?>">Single</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo site_url(); ?>/manage_users/add_group/group/<?php echo $user; ?>">Multiple</a></li>
            </ul>
            </div>
        <?php }else{  ?>
            <div class="btn-group pull-right" >
            <a type="button" class="btn btn-success push_right_bit" href="<?php echo site_url(); ?>/manage_users/add_user/individual/<?php echo $user; ?>"  >Add <?php echo ucfirst(str_replace('_',' ', $user));   ?></a>
            </div>
        <?php } ?>
        
    </div>
<div class="row">
    <div class=""><div class="hr" ><hr/></div></div>
</div>