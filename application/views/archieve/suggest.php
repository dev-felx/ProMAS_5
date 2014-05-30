<?php
    if (isset($ajax_req)){
        if(!empty($res)){?>
            <div id="auto_suggest_boxes" class="list-group">
                <?php  foreach($res as $v){?>
                    <a href="<?php echo site_url(); ?>/archieve/archieve/profile/<?php print $v->project_profile_id ?>" class="list-group-item"><?php print $v->name ?></a>
                <?php }?>
            </div>
    <?php 
        }else {?>
            <ul id="auto_suggest_boxes" class="list-group">
                <li class="list-group-item">No Result Found</li>
            </ul>
            <?php
        }
    }
?>