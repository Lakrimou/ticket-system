<!DOCTYPE html>
<html>
<head>
    <title><?php if(isset($title)){echo strip_tags($title);}else {$title = $page_title; echo $title;} ?></title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>" />
    <link rel="stylesheet" href="<?php echo base_url("assets/css/clientHome.css"); ?>" />
    <link rel="stylesheet" href="<?php echo base_url("assets/css/jquery-ui.css"); ?>" />
    <link rel="stylesheet" href="<?php echo base_url("assets/css/style.css"); ?>" />
    
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <div class="navbar-toggle">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </div>

            <a class="navbar-brand"><h3>Tunisie Telecom</h3><!--<img src="#" srcset="" title="Tunisie Telecom" height="25" width="100">--></a>
        </div>

        <div class="navbar-collapse pull-right">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo base_url('auth/logout'); ?>"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Déconnexion</a></li>
            </ul>
        </div>
    </div>
</nav>