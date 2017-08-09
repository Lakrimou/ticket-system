<div class="content">
	<div id="content" class="container">
      <div class="page-title-cont clearfix">
            <h3>Recherche solution</h3>
      </div>


		<?php echo form_open("operatorHome/resultatsolution", array('class' => 'form-horizontal'));?>

      <div class="form-group">
          <div class="col-sm-3"><?php $data = array(
              'name'        => 'searchTic',
              'id'          => 'body',
              'value'       => NULL,
              'class'=>'form-control loading',
            ); echo form_input($data);?></div>
          <div class="col-sm-3"><?php echo form_submit('searchTickettt', "Rechercher", 'class="btn btn-primary"');?></div>
      
	</div>

</div>
<script src="<?php echo base_url("assets/js/jquery.js"); ?>"></script>

<script src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/jquery-ui.min.js"); ?>"></script>
<script src="<?php echo base_url("/assets/js/tickerr_core.js");?>"></script>
<script type="text/javascript">
            $('document').ready(function() {
                  $( "#body" ).autocomplete({
                    source: "<?php echo base_url('operatorHome/get_ticketts/?');?>",
                    open: function( event, ui ) {
                      $('#body').removeClass('loading');
                    }
                  });
            });
    </script>
    <script>
      $('document').ready(function() {
          $('input').removeClass('loading');
          $( "#body" ).focus(function() {
              $('#body').addClass('loading');
            });
          $( "#body" ).focusout(function() {
              $('#body').removeClass('loading');
            });
          });
      </script>
          <!--$( "#title" ).focusout(function() {
              $('#title').removeClass('loading');
            });-->

      

   <!-- <script>
      $('document').ready(function() {
                    $('input').removeClass('loading');
                    $('input').focus(function() {
                      $('#title').addClass('loading');
                    });
                    $('input').focusout(function() {
                      $('#title').removeClass('loading');
                    });
                  });
    </script>-->
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
<script type="text/javascript">
function lookup(inputString) {
    if(inputString.length == 0) {
        $('#suggestions').hide();
    } else {
        $.post("<?php echo base_url('operatorHome/autocomplete');?>", {queryString: ""+inputString+""}, function(data){
            if(data.length > 0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
        });
    }
}

function fill(thisValue) {
    $('#id_input').val(thisValue);
    setTimeout("$('#suggestions').hide();", 200);
}  
</script>