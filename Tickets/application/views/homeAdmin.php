
<div class="content">
    <div class="page-title-cont clearfix">
        <h3><span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span> Tableau de bord</h3>
    </div>
    <div class="row dash-stats">
        <div class="cl col-xs-6 col-sm-4 col-lg-2">
            <div class="box red">
                <span class="big">5</span>
                <span class="down">Opérateurs</span>
            </div>
        </div>
        <div class="cl col-xs-6 col-sm-4 col-lg-2">
            <div class="box yellow">
                <span class="big"><?php echo $rowNumbb ;?></span>
                <span class="down">Tous les tickets</span>
            </div>
        </div>
        <div class="cl col-xs-6 col-sm-4 col-lg-2">
            <div class="box red">
                <span class="big">3</span>
                <span class="down">Tickets ouvertes</span>
            </div>
        </div>
        <div class="cl col-xs-6 col-sm-4 col-lg-2">
            <div class="box light-blue">
                <span class="big">5</span>
                <span class="down">Clients</span>
            </div>
        </div>
        <div class="cl col-xs-6 col-sm-4 col-lg-2">
            <div class="box green">
                <span class="big">9</span>
                <span class="down">Tickets  fermées</span>
            </div>
        </div>
        <div class="cl col-xs-6 col-sm-4 col-lg-2">
            <div class="box blue">
                <span class="big"><span class="glyphicon glyphicon-signal" aria-hidden="true"></span> </span>
                <span class="down">statistiques</span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col no-bottom-padding col-sm-12">
            <div class="cont">
                <div class="head clearfix">
                    <h4 class="pull-left">Tickets sans opérateur</h4>
                    <div class="pull-right search">
                        <form method="get" action="" name="search-1">
                            <input name="search" placeholder="Enter search query and press enter" type="text">
                        </form>
                    </div>
                </div>

                No tickets				</div>
        </div>
    </div>
    <div class="row padding-fix">
        <div class="col no-bottom-padding col-sm-12">
            <div class="cont">
                <div class="head clearfix">
                    <h4 class="pull-left">Tickets ouvertes</h4>
                    <div class="pull-right search">
                        <form method="get" action="" name="search-2">
                            <input name="search" placeholder="Enter search query and press enter" type="text">
                        </form>
                    </div>
                </div>

                No tickets				</div>
        </div>
    </div>
    <div class="row padding-fix">
        <div class="col no-bottom-padding col-sm-12">
            <div class="cont">
                <div class="head clearfix">
                    <h4 class="pull-left">Tickets fermées</h4>
                    <div class="pull-right search">
                        <form method="get" action="" name="search-2">
                            <input name="search" placeholder="Enter search query and press enter" type="text">
                        </form>
                    </div>
                </div>

                No tickets				</div>
        </div>
    </div>
   <!-- <div class="row">
        <form method="post" action="" class="center">
            <div class="col-md-4 col-md-offset-4 col-lg-8 col-lg-offset-2">
                <div class="form-group">

                    <label for="inputTitrel">Titre de ticket</label>

                    <input type="text" class="form-control" id="inputTitre" placeholder="Titre de ticket">

                </div>

                <div class="form-group">

                    <label for="inputContenu">Contenu de ticket</label>

                    <input type="text" class="form-control" id="inputContenu" placeholder="Contenu">
                    <textarea class="form-control" rows="7" id="inputContenu" placeholder="Contenu de votre ticket"></textarea>

                </div>

                <div class="form-group">

                    <label for="inputDate">Date</label>

                    <input type="date" class="form-control" id="inputDate" placeholder="Date">

                </div>

                <!--<div class="checkbox">

                    <label><input type="checkbox"> Remember me</label>

                </div>

                <button type="submit" class="btn btn-primary">Ajouter le ticket</button>
            </div>
        </form>
    </div>-->
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
