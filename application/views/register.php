<h2>Register</h2>
<hr>

<!--------Error Message----------->
<?php $this->load->view('inc/layout/message'); ?>


<form method="post" action="<?php base_url("register");?>" enctype="multipart/form-data">
	<div class="form-group">
		<label for="username">Username</label>
		<input id="username" type="text" name="username" class="inpTxt" placeholder="username"
		 value="<?php echo $this->input->post('username');?>" />
	</div>
	
	<div class="form-group">
		<label for="email">Email address</label>
		<input id="email" type="email" name="email" class="inpTxt"  placeholder="Email"
		 value="<?php echo $this->input->post('email');?>">
	</div>
	
	<div class="form-group">
		<label for="password">Password</label>
		<input id="password" name="password" type="password" class="inpTxt" placeholder="password" />
	</div>
	
	<div class="form-group">
		<label for="password2">Confirm Password</label>
		<input id="password2" name="password2" type="password" class="inpTxt" placeholder="confirm password" />
	</div>
	
	<div class="form-group">
		<label for="firstname">Firstname</label>
		<input id="firstname" name="firstname" type="text" class="inpTxt" placeholder="firstname"
		value="<?php echo $this->input->post('firstname');?>" />
	</div>
	
	<div class="form-group">
		<label for="lastname">Lastname</label>
		<input id="lastname" name="lastname" type="text" class="inpTxt"  placeholder="lastname" 
		 value="<?php echo $this->input->post('lastname');?>" />
	</div>
	
	
	
	<div class="form-group">
		<label for="profile-img">Profile Image</label>
		<input id="profile-img" name="profile-img" type="file" />
		<p class="help-block">jpg-gif-png only.</p>
	</div>
	
	<button name="submit" type="submit" class="btn-submit">Submit</button>
</form>