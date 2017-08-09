
<div class="content">
    <div class="page-title-cont clearfix">
        <h3><span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span> Tableau de bord</h3>
    </div>
    <div class="row dash-stats">
    
    <?php 
        echo form_open('tickets/afficheStatistiques', array('class'=>'form-horizonatal'));
        ?><h3>Sélctionner un opérateur</h3><?php
        foreach ($listOperator as $key) {?>
            <div class="form-group">
            <?php //echo form_label('Sélectionnez un opérateur', "'class'=>'control-label'");
            $optionn = array(
                            'name'=>'operateur',
                            'value'=>$key['id'],
                            'class'=>'form-control');
                            echo form_radio($optionn);
                            echo form_label($key['username'], "'class'=>'control-label'");
               ?>
               </div> <?php
            }
            ?><div class="form-group"><?php
            echo form_label('Sélectionnez la première date', "'class'=>'control-label'");
        $optiion = array(
            'name'=>'dateUne',
            'class'=>'form-control datepicker'
            );
        echo form_input($optiion);
        ?></div>
        <div class="form-group"><?php
           echo form_label('Sélectionnez la deuxième date', "'class'=>'control-label'");
        $opttion = array(
            'name'=>'dateDeux',
            'class'=>'form-control datepicker'
            );
        echo form_input($opttion);
        ?></div>
<?php
            
           // echo form_dropdown('operator', $option, array('class'=>'form-control'));
            /*echo form_submit('stat','Statistique de ticket', 'class="btn btn-primary"');*/
             echo form_submit('stat','Afficher les statistiques','class="btn btn-primary"');
            echo form_close();
    ?>
    </div>
    <canvas id="myChart" width="400" height="130"></canvas>
</div>
<script type="text/javascript" src="<?php echo base_url("assets/js/jquery.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/jquery-ui.js"); ?>"></script>
<script src="<?php echo base_url("/assets/js/tickerr_core.js");?>"></script>

  <script>
  $(function() {
    $( ".datepicker" ).datepicker({ dateFormat: 'dd-mm-yy' }).val();;
  });
  </script>

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
