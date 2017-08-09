
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
                <span class="big"><?php print_r($rowNumbb);?></span>
                <span class="down">Tous les tickets</span>
            </div>
        </div>
        <div class="cl col-xs-6 col-sm-4 col-lg-2">
            <div class="box red">
                <span class="big">3</span>
                <span class="down">Tickets ouverts</span>
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
                <span class="big">7</span>
                <span class="down">Mes tickets</span>
            </div>
        </div>
    </div>
    <canvas id="myChart" width="400" height="130"></canvas>
</div>
<script type="text/javascript" src="<?php echo base_url("assets/js/jquery.js"); ?>"></script>
<!--<script type="text/javascript" src="<?php //echo base_url("assets/js/bootsrap.js"); ?>"></script>-->
<!--<script type="text/javascript" src="<?php //echo base_url("assets/js/jquery.ui.js"); ?>"></script>-->
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
<script src="<?php echo base_url("assets/js/Chart.js-master/dist/Chart.js"); ?>"></script>
<script type="text/javascript">
    //var ctx = document.getElementById("myChart");  
    var ctx = document.getElementById("myChart").getContext("2d"); 
    
    var data = {
    labels: ["Semaine1", "Semaine2", "Semaine3", "Semaine4 "],
    datasets: [
        {
            label: "Tickets faits",
            backgroundColor: "rgba(255,99,132,0.2)",
            borderColor: "rgba(255,99,132,1)",
            borderWidth: 1,
            hoverBackgroundColor: "rgba(255,99,132,0.4)",
            hoverBorderColor: "rgba(255,99,132,1)",
            data: [47, 45, 40, 49, 39, 40, 0],
        }
    ]
};
var myBarChart = new Chart(ctx, {
    type: 'bar',
    data: data
});
</script>

</body>
</html>
