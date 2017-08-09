<div class="content">
    <div class="row">

<div class="container">
    <div class="page-title-cont clearfix">
        <h3><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo $login_name; ?></h3>
    </div>
    <?php echo form_open("userAdmin/ticketAjouter", array('class' => 'form-horizontal'));?>
<div class="form-group">
    <?php
    echo form_label('Titre de ticket', 'title', array('class'=>'control-label col-sm-2'));
    ?>
    <div class="col-sm-8 col-md-8">
        <?php echo form_input('titre','titre',array('class'=>'form-control')); ?>
    </div>
</div>
<div class="form-group">
    <?php
        echo form_label('Visibilité', 'visibility', array('class'=>'control-label col-sm-2'));
        ?>
        <div class="col-sm-8 col-md-8">
        <!-- 'id'          => 'toggle-one', -->
            <?php
        $data = array(
        'name'        => 'visibility',
        'id'          => 'toggle-one',
        'checked'     => TRUE,
        'style'       => 'margin:10px',
        'data-width'=> 100,
        'data-on'=>"publique",
        'data-off'=>"privé"
        );

        echo form_checkbox($data);
        ?>
    </div>
</div>
    <div class="form-group">
        <?php
        echo form_label('Contenu de ticket', 'body', array('class'=>'control-label col-sm-2'));
        ?>
        <div class="col-sm-8 col-md-8">
            <?php echo form_textarea('body','contenu',array('class'=>'form-control')); ?>
        </div>
    </div>
    <div class="form-group">
        <?php
            echo form_label('Catégorie', 'category', array('class'=>'control-label col-sm-2')); 
        ?>
        <div class="col-sm-8 col-md-8">
            <?php
                $option = array(1 => 'Materiel',
                                            2=>'Réseau' );
                echo form_dropdown('category', $option, 1, array('class'=>'form-control'));
            ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8 col-md-8 "><?php echo form_submit(array('name' => 'submit', 'value' => 'Ajouter', 'class' => 'btn btn-primary btn-large'));?></div>
    </div>

    <?php echo form_close();?>
</div>
</div>
</div>
</div>
<script>

</script>
<script type="text/javascript" src="<?php echo base_url("assets/js/jquery.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/jquery-ui.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap-toggle.min.js"); ?>"></script>
<script>
  $(function() {
    $('#toggle-one').bootstrapToggle();
  })
</script>
</body>
</html>