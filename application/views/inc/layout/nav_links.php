<!--Site Navigation Links -->
<div class="logo"><p><a href="<?php echo base_url();?>"> Php bookmark </a> </p></div>
<nav>
	<ul class="nav navbar-nav">
		<?php if(!$this->session->userdata("logged_in")):?>
		<li>
			<a href="<?php echo base_url();?>">Home</a>
		</li>
		<li><a href="<?php echo base_url("register");?>">Sign up</a></li>
		<?php else:?>
		<li>
			<a href="<?php echo base_url('profile');?>">Profile</a>
		</li>
		<li>
			<a href="<?php echo base_url();?>">Bookmark</a>
		</li>
		<li>
			<a href="<?php echo base_url('table/add');?>">Add</a>
		</li>
		<?php endif;?>
	</ul>
</nav>		  
<?php if(!$this->session->userdata("logged_in")):?>
	<!-- Login Form -->
	<div class="search-box">
		<?php $this->load->view("inc/layout/login_form_nav");?>
	</div>
<?php else:?>
	<?php $this->load->view("inc/layout/login_member_nav");?>
<?php endif;?>
	
	
