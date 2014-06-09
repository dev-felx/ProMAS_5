<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class='row' style="margin-bottom: -5px; ">
        <div class='pull-left'><h4>Manage Users - <?php echo ucfirst(str_replace('_',' ', $user));   ?></h4></div>
        <div class="btn-group pull-right">
            <?php if(($user == 'student') || ($user =='supervisor') ){ ?>
            <button type="button" class="btn btn-success dropdown-toggle push_right_bit" data-toggle="dropdown" >Add <?php echo ucfirst(str_replace('_',' ', $user));   ?></button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo site_url(); ?>/manage_users/add_user/individual/<?php echo $user; ?>">Single</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo site_url(); ?>/manage_users/add_group/group/<?php echo $user; ?>">Multiple</a></li>
            </ul>
            <?php }else{  ?>
            <a type="button" class="btn btn-success push_right_bit" href="<?php echo site_url(); ?>/manage_users/add_user/individual/<?php echo $user; ?>"  >Add <?php echo ucfirst(str_replace('_',' ', $user));   ?></a>
            <?php } ?>
        </div>
    </div>
<div class="row">
        <div class="">
            <hr style="border: none; height: 2px; background:#0093D0;"/>
        </div>
    </div>