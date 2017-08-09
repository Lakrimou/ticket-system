<div id="sidebar" class="sidebar-left">
    <div class="top">
        <span class="big"><?php print_r($login_name);?></span>
        <span class="small">Client</span>
    </div>
    <ul class="navigation">

        <li class="<?php if(isset($title)){if($title == 'Accueil | client'){echo 'active';}}else{echo '';} ?>">
            <a href="<?php echo base_url('userAdmin/index'); ?>">  <span class="glyphicon glyphicon-home" aria-hidden="true"></span> &nbsp Accueil</a></li>
        <li class="<?php if(isset($title)){ if($title == 'Mes tickets | Client'){echo 'active';}}else {echo '';} ?>">
                    <a href="<?php echo base_url('userAdmin/mesTickets');?>">
                        <span class="glyphicon glyphicon-list" aria-hidden="true"></span> &nbsp Mes Tickets
                    </a>
                </li>
                <li class="<?php if(isset($title)){ if($title == 'Les tickets publiques | Client'){echo 'active';}}else {echo '';} ?>">
                    <a href="<?php echo base_url('userAdmin/getTicketsPublic');?>">
                        <span class="glyphicon glyphicon-list" aria-hidden="true"></span> &nbsp Tickets publiques
                    </a>
                </li>

                <li class="<?php if(isset($title)){ if($title == 'Ajouter un ticket | Client'){echo 'active';}}else { echo '';} ?>">
                    <a href="<?php echo base_url('userAdmin/ajouterTicket');?>">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> &nbsp Ajouter Ticket
                     
                    </a>
                </li>

                 <li class="<?php if(isset($title)){ if($title == 'Recherche | Client'){echo 'active';}}else { echo '';} ?>"><a href="<?php echo base_url('userAdmin/recherche_Sol'); ?>">
                        <span class="glyphicon glyphicon-search" aria-hidden="true"> </span>  &nbsp Chercher Solution
                        
                    </a>
                </li>
       
        <li class="<?php if(isset($title)){if($title == 'Edit User'){echo 'active';}}else{echo '';} ?>"><a href="<?php echo base_url('userAdmin/edit_user/'.$user_id); ?>"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> &nbsp Paramètre du compte</a></li>
        <li><a href="<?php echo base_url('auth/logout'); ?>"> <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> &nbsp Déconnexion</a></li>
    </ul>

</div>