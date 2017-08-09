?<div id="sidebar" class="sidebar-left">
    <div class="top">
        <span class="big"><?php echo $login_name; echo '<br/>'.$user_id;?></span>
        <span class="small">Opérateur</span>
    </div>
    <ul class="navigation">

        <li class="<?php if(isset($title)){if($title == 'Accueil | Opérateur'){echo 'active';}}else{echo '';} ?>">
            <a href="<?php echo base_url('operatorHome/homeOperator'); ?>">  <span class="glyphicon glyphicon-home" aria-hidden="true"></span> Accueil</a></li>
         <li>
            <a href="javascript:;">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Rechercher   <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
                <!-- <span class="badge pull-right">0</span -->
                <span class="arrow pull-right"><i class="fa fa-angle-down"></i></span>
            </a>

            <ul style="display: block;" class="dropdown open animated">
                <li class="<?php if(isset($title)){ if($title == 'Recherche Ticket | Opérateur'){echo 'active';}}else {echo '';} ?>">
                    <a href="<?php echo base_url('operatorHome/recherche');?>">
                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Rechercher ticket
                    </a>
                </li>
                <li class="<?php if(isset($title)){ if($title == 'Recherche | Opérateur'){echo 'active';}}else {echo '';} ?>">
                    <a href="<?php echo base_url('operatorHome/recherche_Sol');?>">
                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Rechercher solution
                    </a>
                </li>
            </ul>
            </li>

        <li>
            <a href="javascript:;">
                <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Tickets   <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
                <span class="badge pull-right"></span>
                <span class="arrow pull-right"><i class="fa fa-angle-down"></i></span>
            </a>

            <ul style="display: block;" class="dropdown open animated">
                <li class="<?php if(isset($title)){ if($title == 'Tous les tickets | Opérateur'){echo 'active';}}else { echo '';} ?>"><a href="<?php echo base_url('operatorHome/tousTickets'); ?>">
                        <span class="glyphicon glyphicon-list" aria-hidden="true"> </span>  &nbsp Tous les tickets
                    </a>
                </li>
                <li class="">
                    <a href="<?php echo base_url('operatorHome/nouveauTicket') ?>">
                        <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span> Nouveaux tickets
                        <span class="badge pull-right">0</span>
                    </a>
                </li>
                <li class="<?php if(isset($title)){ if($title == 'Tickets ouverts'){echo 'active';}}else { echo '';} ?>">
                    <a href="<?php echo base_url('operatorHome/getTicketsOpened') ?>">
                        <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> &nbsp Tickets ouverts
                    </a>
                </li>
                <li class="<?php
                if(isset($title)){
                    if($title == 'Tickets Fermées'){
                        echo 'active';
                    }
                }
                else{
                    echo '';
                } ?>">
                    <a href="<?php echo base_url('operatorHome/getTicketsClosed') ?>">
                        <span aria-hidden="true" class="glyphicon glyphicon-lock"></span> &nbsp Tickets fermés
                        
                    </a>
                </li>
                
            </ul>
        </li>
        
        <li class="<?php if(isset($title)){if($title == 'Edit User'){echo 'active';}}else{echo '';} ?>"><a href="<?php echo base_url('operatorHome/edit_user/'.$user_id); ?>"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Paramètre du compte</a></li>
        <li><a href="<?php echo base_url('auth/logout'); ?>"> <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Déconnexion</a></li>
    </ul>

</div>