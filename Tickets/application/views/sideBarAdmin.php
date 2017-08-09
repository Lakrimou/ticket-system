?<div id="sidebar" class="sidebar-left">
    <div class="top">
        <span class="big"><?php print_r($login_name); ?></span>
        <span class="small">Administrateur</span>
    </div>
    <ul class="navigation">

        <li class="<?php if(isset($title)){if($title == 'Accueil'){echo 'active';}}else{echo '';} ?>">
            <a href="<?php echo base_url('homeAdmin/index'); ?>">  <span class="glyphicon glyphicon-home" aria-hidden="true"></span> Tableau de bord</a></li>
        <li>
            <a href="javascript:;">
                <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Tickets   <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
                <span class="badge pull-right">0</span>
                <span class="arrow pull-right"><i class="fa fa-angle-down"></i></span>
            </a>

            <ul style="display: block;" class="dropdown open animated">
                <li class="<?php if(isset($title)){ if($title == 'Tous les tickets'){echo 'active';}}else {echo '';} ?>">
                    <a href="<?php echo base_url('tickets/getAllTickets');?>">
                        <span class="glyphicon glyphicon-list" aria-hidden="true"></span> Tous les tickets
                    </a>
                </li>
                <li class="">
                    <a href="les nouvelles tickets">
                        <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span> Nouveaux tickets
                        <span class="badge pull-right">0</span>
                    </a>
                </li>
                <li class="<?php if(isset($title)){ if($title == 'Tickets Ouvertes'){echo 'active';}}else { echo '';} ?>"><a href="<?php echo base_url('tickets/getTicketsOpened'); ?>">
                        <span class="glyphicon glyphicon-folder-open" aria-hidden="true"> </span>  &nbsp Tickets ouverts
                        <span class="badge pull-right">3</span>
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
                } ?>"><a href="<?php echo base_url('tickets/getTicketsClosed'); ?>">
                        <span class="glyphicon glyphicon-lock" aria-hidden="true"></span> Tickets fermés
                    </a>
                </li>
                <!--<li>
                    <a href="pending-tickets">
                        <i class="fa fa-mail-forward"></i>Pending
                    </a>
                </li>-->
            </ul>
        </li>
        <li class="<?php if(isset($title)){ if($title == 'Gestion des utilisateurs'){echo 'active';}}else{ echo '';} ?>"><a href="<?php echo base_url('auth/create_user'); ?>"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Gestion des utilisateurs</a></li>
        <li class="<?php if(isset($title)){if($title == 'helpdesk'){echo 'active';}}else{echo '';} ?>"><a href="<?php echo base_url('auth/index'); ?>"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Paramètre du compte</a></li>
        <li><a href="#"> <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Déconnexion</a></li>
    </ul>

</div>