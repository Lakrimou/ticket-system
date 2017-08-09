<div class="content">
    <div class="page-title-cont clearfix">
        <h3> resultat de recherche de solution</h3>
    </div>
    <div>
    <table class="table table-bordered"style="width: auto;">
    
    <thead>
    <tr>
        <th >Catégorie</th>
        <th>Problème</th>
        <th>Solution</th> 
         
    </tr>
    </thead>
    <tbody>
    <?php foreach($resultatSolutionn as $ke) { ?>
        
        <tr>
                <td><?php echo $ke['categorie'];?></td>
                <td><?php echo $ke['titre_probleme'];?></td>
                <td><?php echo $ke['body_solution'];?></td>
                
                </tr>
                
    <?php }?>
    </tbody>
    </table>
    </div>
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