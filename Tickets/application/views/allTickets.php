<div class="content">
    <div class="page-title-cont clearfix">
        <h3>Tous les tickets</h3>
    </div>
    <?php foreach($allTicketts as $key) { ?>

    <div class="roww">
        <div class="col no-bottom-padding col-sm-12">
            <div class="cont">
                <div class="gravatar left">
                    <h4>Gravatar</h4>
                </div>
                <!--<div class="col-xs-12 col-md-3 my-gravatar" >
                    <?php //echo gravatar_img( '"'.$key['email'].'"', "40", "PG", "mm" ); ?>

                </div>-->
                <div class="center">
                    akrem
                </div>
                <div class="right">
                    Catégorie
                </div>

                <?php echo $key['title'].'&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <span class="glyphicon glyphicon-time " aria-hidden="true">&nbsp'.$key['date_ticket'];?>
                </div>
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