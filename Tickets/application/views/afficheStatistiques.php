<div class="content">
      <div id="content" class="container">
      <div class="page-title-cont clearfix">
      <h3>Statistiques</h3>
<?php
	echo $nobreTicketsOperateur; 
?>
</div>
	Nombre Total de tickets  : 60
	<br/>
	Nombre de ticket de l'opérateur : 15
	<canvas id="myPieChart" width="50" height="50"></canvas>

</div></div>
<script type="text/javascript" src="<?php echo base_url("assets/js/jquery.js"); ?>"></script>
<!--<script type="text/javascript" src="<?php //echo base_url("assets/js/bootsrap.js"); ?>"></script>-->
<!--<script type="text/javascript" src="<?php //echo base_url("assets/js/jquery.ui.js"); ?>"></script>-->
<script src="<?php echo base_url("/assets/js/tickerr_core.js");?>"></script>
<script src="<?php echo base_url("assets/js/Chart.js-master/dist/Chart.js"); ?>"></script>
<script type="text/javascript">

var ctx = document.getElementById("myPieChart");
var data = {
    labels: [
        "Red",
        "Blue",
    ],
    datasets: [
        {
            data: [300, 100],
            backgroundColor: [
                "#FF6384",
                "#36A2EB",
            ],
            hoverBackgroundColor: [
                "#FF6384",
                "#36A2EB",
            ]
        }]
};
	var myPieChart = new Chart(ctx,{
    type: 'pie',
    data: data
});

</script>