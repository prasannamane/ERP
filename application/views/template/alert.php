<?php 
    if(isset($success))
    { ?>
        <div class="alert alert-success alert-dismissable fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong></strong> <?=$success?>
        </div>
        <?php 
    } 
    if(isset($error))
    { ?>
        <div class="alert alert-danger alert-dismissable fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error!</strong> <?=$error?>
        </div>
        <?php 
    } ?>