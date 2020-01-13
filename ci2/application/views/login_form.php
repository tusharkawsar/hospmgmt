<div id='login_form' style="margin: auto; text-align:center">

	<?php echo form_open('login/validate_credentials'); ?>

	<ul style="text-decoration: none;">
		<li>
			<?php 
				echo form_label('Username:	', 'name');
				echo form_input('Username',''); 
			?>
		</li>
		<li>
			<?php 
				echo form_label('Password:	', 'pw');
				echo form_password('Password',''); 
			?>
		</li>
		<?php 
			echo form_submit('Submit','Login'); 
		?>
	</ul>

</div>
