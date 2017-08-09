<div class="content" id="ticket" data-id="343" data-access="6xCMzlBEG3">
		<div class="page-title-cont clearfix">
			<h3>Ticket ID  <?php 
				echo $identifiantTicket;?>
			</h3>
			<?php
				if($openTicketsParent){
			?>
			<div class="badge red">OPEN</div>	
			<?php }
			else{ ?>
				<div class="badge green">CLOSED</div>
			<?php } ?>		
					</div>
		
		<div class="row">
			<div class="col margin-top col-md-4">
				<div class="row min-bottom-margin">
					<div class="col col-xs-12">
						<div class="cont">
							<div class="top clearfix">
								<h4 class="pull-left">Ticket Info</h4>
								<div class="btn btn-small btn-red pull-right" name="delete-ticket">DELETE TICKET</div>
							</div>
							
							<table class="ticket-info">
								<tbody>
								<?php
								$titre;
								$body;
								if($openTicketsParent){
									foreach ($openTicketsParent as $key) {
										$titre = $key['title'];
										$body = $key['body'];
										?>

										<tr>
											<td>Nom de client</td>
											<td><?php echo $key['first_name'].' '.$key['last_name'];?></td>
										</tr>
										<tr>
											<td>Username</td>
											<td><?php echo $key['username'];?></td>
										</tr>
										<tr>
											<td>Entreprise</td>
											<td><?php echo $key['company'];?></td>
										</tr>
										<tr>
											<td>Téléphone</td>
											<td><?php echo $key['phone'];?></td>
										</tr>
										<tr>
											<td>Operateur</td>
											<td><?php echo $login_name;?></td>
										</tr>
										<tr>
											<td>Catégorie</td>
											<td><?php echo $key['categorie'];?></td>
										</tr>
										<tr>
											<td>Date de création</td>
											<td><?php echo $key['date_ticket'];?></td>
										</tr>
										<tr>
											<td>Dernière mise à jour</td>
											<td><?php echo $key['date_ticket'];?></td>
										</tr>
									<?php }
								}else {
									foreach ($ClosedTicketsParent as $key) {
										$titre = $key['title'];
										$body = $key['body'];
										?>
										<tr>
											<td>Nom de client</td>
											<td><?php echo $key['first_name'].' '.$key['last_name'];?></td>
										</tr>
										<tr>
											<td>Username</td>
											<td><?php echo $key['username'];?></td>
										</tr>
										<tr>
											<td>Entreprise</td>
											<td><?php echo $key['company'];?></td>
										</tr>
										<tr>
											<td>Téléphone</td>
											<td><?php echo $key['phone'];?></td>
										</tr>
										<tr>
											<td>Operateur</td>
											<td><?php echo $login_name;?></td>
										</tr>
										<tr>
											<td>Catégorie</td>
											<td><?php echo $key['categorie'];?></td>
										</tr>
										<tr>
											<td>Date de création</td>
											<td><?php echo $key['date_ticket'];?></td>
										</tr>
										<tr>
											<td>Dernière mise à jour</td>
											<td><?php echo $key['date_ticket'];?></td>
										</tr>
									<?php }
								}
								?>
								
								</tbody>
							</table>
						</div>
					</div>
				</div>
				
				
			</div>
			
			<div class="col margin-top no-bottom-padding col-md-8 ticket">
				
				

				<div class="row min-bottom-margin">
					<div class="col col-xs-12">
						<div class="cont">
							<div class="top">
								<h4>Titre : <?php echo $titre; ?></h4>
								<p>
									<?php echo $body;?>
								</p>
							</div>
							<div>
								<?php 	
									foreach ($conversation as $key) {
										echo '<div class="tick-response"> <strong>'.$key['username'].'</strong> '.$key['body'].'</div>'; 
									}
								
								?>
							</div>
</div>
							<!--<?php //echo form_open("homeAdmin/conversationTicket", array('class' => 'form-horizontal'));?>

      <div class="form-group">
          <div class="col-lg-12"><?php //echo form_textarea('solution', NULL, 'class="form-control"');?></div>
      </div>
      <div class="form-group">
      <?php //echo form_hidden('id_ticket', $identifiantTicket);?>
  </div>
      <div class="form-group">
          <div class="col-sm-3"><?php //echo form_submit('repondre', "Répondre", 'class="btn btn-primary"');?></div>
      
          <div class="col-offset-sm-9"><?php //echo form_submit('searchTicket', "Note", 'class="btn btn-success"');?></div>
      </div>
      <?php //echo form_close();?>-->

							<!--<form method="POST" action="y" enctype="multipart/form-data" name="new-reply">							
								<textarea name="reply" id="reply" class="nostyle margin-bottom"></textarea>
							</form>-->
						</div>
					</div></div>
				</div>
			</div>
		</div>
	</div>
	
	<div id="tooltip"></div>
	
	
	<script src="http://sglancer.com/Tickerr/assets/js/jquery-1.11.3.min.js"></script>
	<script src="http://sglancer.com/Tickerr/assets/js/tickerr_core.js"></script>
	<script src="http://sglancer.com/Tickerr/assets/js/tinyeditor.min.js"></script>
	<script type="text/javascript">
		$('document').ready(function() {
			// Enable sidebar
			enable_sidebar();
			
			var editor = new TINY.editor.edit('editor', {
				id: 'reply',
				width: '100%',
				height:160,
				cssclass: 'tinyeditor',
				controlclass: 'tinyeditor-control',
				rowclass: 'tinyeditor-header',
				dividerclass: 'tinyeditor-divider',
				controls: ['bold', 'italic', 'underline', 'strikethrough', '|', 'orderedlist',
					'unorderedlist', '|', 'outdent', 'indent', '|', 'leftalign', 'centeralign',
					'rightalign', 'blockjustify', '|', 'link', 'unlink'],
				footer: false,
				xhtml: true,
				cssfile: 'http://sglancer.com/Tickerr/assets/css/tinyeditor.css',
				bodyid: 'editor',
				footerclass: 'tinyeditor-footer',
				toggle: {text: 'source', activetext: 'wysiwyg', cssclass: 'toggle'},
				resize: {cssclass: 'resize'}
			});
			
						
			var all_extensions_allowed = false;
			var allowed_extensions = ['jpg','jpeg','png','gif','zip','pdf'];
			$('button[name=upload_file]').click(function(evt) {
				evt.preventDefault();
				
				var new_file = '<div class="file">';
				new_file += '	<button name="selected_file" class="btn btn-upload-file btn-light-blue">Select file to upload...</button>';
				new_file += '	<button name="delete_file" class="btn btn-upload-file btn-red btn-delete"><i class="fa fa-close"></i></button>';
				new_file += '	<input type="file" name="files[]" style="display:none;" />';
				new_file += '</div>';
				
				$(this).before(new_file);
			});
			
			$(document).delegate('button[name=selected_file]', 'click', function(evt) {
				// Bug fixer
				if(evt.clientX != 0 && evt.clientY != 0) {
					evt.preventDefault();
					$(this).parent().children('input[type=file]').click();
				}
			});
			
			$(document).delegate('input[type=file]', 'change', function(evt) {			
				var val = $(this).val().split('\\').pop();
				
				// Get extension and check if it's allowed...
				var ext = val.toLowerCase().split('.').pop();
				if(all_extensions_allowed == false) {
					if(allowed_extensions.indexOf(ext) == -1) {
						var allowed_ext = allowed_extensions.join(', ');
						alert(ext+' is not a valid file extension. You can only upload the following: '+allowed_ext);
					}
				}
				
				$(this).parent().children('button[name=selected_file]').html(val);
			});
			
			$(document).delegate('button[name=delete_file]', 'click', function(evt) {
				evt.preventDefault();
				$(this).parent().remove();
			});
						
			$('form[name=new-reply]').submit(function(evt) {
				editor.post();
				var message = editor.t.value;
				var transfer_to = $('select[name=transferToDept]').val();
				var close = $('input[type=checkbox][name=close]');
				
				// Message empty? Check other stuff..
				if(message.length <= 10) {
					if(transfer_to == 'none' && !close.is(':checked')) {
						evt.preventDefault();
						error('Ticket message must be more than 10 characters long', '.tinyeditor');
						return false;
					}
				}
				
								// Delete empty files
				var nfiles = $('input[type=file]').length;
				var astr = [];
				for(var i = 1; i <= nfiles; i++) {
					var val = $('.file:nth-child('+i+') input[type=file]').val();
					if(val == '')
						astr.push('.file:nth-child('+i+')');
					else{
						// Get extension and check if it's allowed...
						var ext = val.toLowerCase().split('.').pop();
						if(all_extensions_allowed == false) {
							if(allowed_extensions.indexOf(ext) == -1) {
								var allowed_ext = allowed_extensions.join(', ');
								error('One or more files have an invalid extension. The only allowed extensions are: '+allowed_ext);
								evt.preventDefault();
								return false;
							}
						}
					}
				}
				var str = astr.join(', ');
				$(str).remove();
							});
			
			$('.btn[name=delete-ticket]').click(function(evt) {
				evt.preventDefault();
				alert('This action is disabled for the Demo');
			});
			
			/* Envato verification code */
			$('span.envato-verified').on('mouseover', function(evt) {
				$('#tooltip').html('This Envato Purchase Code has been verified').fadeIn(50);
			});
			$('span.envato-verified').on('mousemove', function(evt) {
				$('#tooltip').css({
					'left': (evt.pageX+8)+'px',
					'top': (evt.pageY-46)+'px'
				});
			});
			$('span.envato-verified').on('mouseout', function(evt) {
				$('#tooltip').html('This Envato Purchase Code has been verified').fadeOut(50);
			});
			
			var e_active = false;
			function error(e, n) {
				if(e_active != false) {
					$(e_active).css('border-color', '#d0d0d0').removeClass('error');
				}
				
				$(n).css('border-color','#ff0000').addClass('error');
				e_active = n;
				
				$('p.bg-danger').slideUp(200, function() {
					$('p.bg-danger').html(e).slideDown(200);
				});
			}
		});
	</script>