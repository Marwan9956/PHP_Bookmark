<!--Login form Home page -->


<div class="login-container register">
	
	<!--------Error Message----------->
	<?php $this->load->view('inc/layout/message'); ?>
	
	
	<h1>Login</h1>
	<hr>
	<form method="post" action="<?php echo base_url("login");?>" >
		<label>Email</label>
		<input name="loginEmail" type="email" class="inpTxt" placeholder="Email">
		
		<label>Password</label>
		<input name="loginPass" type="password" class="inpTxt" placeholder="password">
		
		<br>
		<input type="submit" class="btn-submit btn-login-main" value="Login">
		&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url("register");?>">not a member</a>
	</form>
</div>