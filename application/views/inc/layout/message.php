<!--------Error Message----------->
<?php if($this->session->flashdata("Err_msg")):?>
	<div class="alert alert-warning">
		<?php echo $this->session->flashdata("Err_msg");?>
	</div>
<?php endif;?>

<?php if($this->session->flashdata("msg")):?>
		<div class="alert alert-success">
			<?php echo $this->session->flashdata("msg");?>
		</div>
<?php endif;?>

<?php echo validation_errors("<div class='alert alert-danger'>","</div>"); ?>




