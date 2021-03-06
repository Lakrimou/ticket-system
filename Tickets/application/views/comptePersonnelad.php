
<div class="content" style="background-image : url(<?php echo base_url('assets/images/client.PNG');?>); background-repeat: no-repeat; background-position: 500px 150px; ">
      <div class="page-title-cont clearfix">
            <h3>Modification des Informations Personnelles</h3>
               <p class="pull-right"><a class="btn btn-default" href="<?php echo base_url('userAdmin/index'); ?>"><span class=" glyphicon glyphicon-arrow-left" aria-hidden="true"></span> </a></p>
      </div>
 



<?php if(!empty($message)) echo '<div id="infoMessage" class="alert alert-warning"><i class="fa fa-warning"></i> '.$message.'</div>';?>

<?php echo form_open(uri_string(), array('class' => 'form-horizontal'));?>

      <div class="form-group">
            <?php echo form_label($this->lang->line('edit_user_fname_label'), 'first_name', array('class' => 'col-sm-2 control-label'));?> 
          <div class="col-sm-3"><?php echo form_input($first_name, NULL, 'class="form-control"');?></div>
      </div>

      <div class="form-group">
            <?php echo form_label($this->lang->line('edit_user_lname_label'), 'last_name', array('class' => 'col-sm-2 control-label'));?>
            <div class="col-sm-3"><?php echo form_input($last_name, NULL, 'class="form-control"');?></div>
      </div>

      <div class="form-group">
            <?php echo form_label($this->lang->line('edit_user_company_label'), 'company', array('class' => 'col-sm-2 control-label'));?>
            <div class="col-sm-3"><?php echo form_input($company, NULL, 'class="form-control"');?></div>
      </div>

      <div class="form-group">
            <?php echo form_label($this->lang->line('edit_user_phone_label'), 'phone', array('class' => 'col-sm-2 control-label'));?> 
            <div class="col-sm-3"><?php echo form_input($phone, NULL, 'class="form-control"');?></div>
      </div>
    
      <div class="form-group">
            <?php echo form_label($this->lang->line('edit_user_email_label'), 'email', array('class' => 'col-sm-2 control-label'));?> 
            <div class="col-sm-3"><?php echo form_input($email, NULL, 'class="form-control"');?></div>
      </div>
    
      <div class="form-group">
            <?php echo form_label($this->lang->line('edit_user_password_label'), 'password', array('class' => 'col-sm-2 control-label'));?> 
            <div class="col-sm-3"><?php echo form_input($password, NULL, 'class="form-control"');?></div>
      </div>

      <div class="form-group">
            <?php echo form_label($this->lang->line('edit_user_password_confirm_label'), 'password_confirm', array('class' => 'col-sm-2 control-label'));?>
            <div class="col-sm-3"><?php echo form_input($password_confirm, NULL, 'class="form-control"');?></div>
      </div>



      <?php echo form_hidden('id', $user->id);?>
      <?php echo form_hidden($csrf); ?>

      <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10"><?php echo form_submit(array('name' => 'submit', 'value' => 'Enregistrer', 'class' => 'btn btn-primary btn-large'));?></div>
      </div>

<?php echo form_close();?>

</div>//
<script type="text/javascript" src="<?php echo base_url("assets/js/jquery.js"); ?>"></script>
<script src="<?php echo base_url("/assets/js/tickerr_core.js");?>"></script>

<script type="text/javascript">
    $('document').ready(function() {
        // Enable sidebar
        enable_sidebar();

        $('thead tr th').on('mouseover', function() {
            $(this).children('i.fa-sort').addClass('active');
            $(this).children('.hid').css('visibility','visible');
        }).on('mouseout', function() {
            $(this).children('i.fa-sort').removeClass('active');
            $(this).children('.hid').css('visibility','hidden');
        });

        $('thead tr th').click(function(evt) {
            if($(this).data('sort') !== undefined)
                location.href = $(this).data('sort');
        });

        $('tr').click(function(evt) {
            if($(this).data('href') !== undefined)
                location.href = $(this).data('href');
        });
    });
</script>