<div class="content">
    <div class="page-title-cont clearfix">
        <h3>Mes tickets</h3>
    </div>
    <?php foreach($mesTicketss as $key) { ?>

        <div class="roww">
            <div class="col no-bottom-padding col-sm-12"><a href="
                <?php 
                echo base_url('userAdmin/conversationTicketClient?ticket_id='.$key['id_ticket']);?>
                ">
                    <div class="cont">
                        <div class="gravatar left" style="display: inline-block;">
                            <img width="100" height ="70" src="<?php echo base_url('assets/images/user.jpg'); ?> ">
                        </div>
                        <div style="display: inline-block; margin-left: 20px;">
                            <strong>Client</strong><br/>
                            <?php echo $key['username'];?>
                        </div>
                        <div style="display: inline-block; margin-left: 100px; width: 300px;">
                            <?php echo '<strong>Titre de ticket</strong><br/>'.$key['title'];?>
                        </div>
                        <div style="display: inline-block; margin-left: 200px;">
                            <strong>Status</strong><br/> 
                            <?php if($key['statut'] == 0){
                                echo 'Ouvert';
                            }else {
                                echo 'fermé';
                            }

                            ?>
                        </div>
                        <div style="display: block; margin-left: 270px;">
                            <?php echo '<span class="glyphicon glyphicon-time " aria-hidden="true"></span>&nbsp<strong>Date de création </strong>&nbsp'.$key['date_ticket'];?>
                        </div>
                </a>
            </div>
        </div>
    <?php }?>
</div>
<script type="text/javascript" src="<?php echo base_url("assets/js/jquery.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/bootsrap.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/jquery.ui.js"); ?>"></script>
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
</body>
</html>